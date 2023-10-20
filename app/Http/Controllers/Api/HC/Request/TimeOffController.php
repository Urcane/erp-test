<?php

namespace App\Http\Controllers\Api\HC\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use App\Models\Employee\UserCurrentShift;
use App\Models\Employee\UserEmployment;
use App\Models\Employee\WorkingScheduleShift;
use App\Models\Leave\LeaveRequestCategory;
use App\Models\Leave\UserLeaveCategoryQuota;
use App\Models\Leave\UserLeaveHistory;
use App\Models\Leave\UserLeaveQuota;
use App\Models\Leave\UserLeaveRequest;
use App\Models\User;
use App\Utils\ErrorHandler;
use Carbon\Carbon;

use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\DB;

class TimeOffController extends RequestController
{
    // get user shift after cycle with date
    private function _getWorkingScheduleShift($userId, $startDate) {
        $userCurrentShift = UserCurrentShift::where('user_id', $userId)->with("workingScheduleShift")->first();
        $workingScheduleShifts = WorkingScheduleShift::where('working_schedule_id', $userCurrentShift->workingScheduleShift->working_schedule_id)->get();

        Carbon::setLocale($this->constants->locale);
        $requestDate = Carbon::parse($startDate);
        $now = Carbon::now();
        $diff = $now->diffInDays($requestDate);
        $countOfSchedule = $workingScheduleShifts->count();
        $distance = $diff - (floor($diff/$countOfSchedule) * $countOfSchedule);

        $workingScheduleShift = $workingScheduleShifts->find($userCurrentShift->working_schedule_shift_id);
        for ($i=0; $i < $distance; $i++) {
            if ($requestDate > $now) {
                $workingScheduleShift = $workingScheduleShifts->find($workingScheduleShift->next);
            } else {
                $workingScheduleShift = $workingScheduleShifts->filter(function ($scheduleShift) use ($workingScheduleShift){
                    return $scheduleShift->next == $workingScheduleShift->id;
                })->first();
            }
        }

        return $workingScheduleShift;
    }

    //update schedule section
    private function _getGlobalDayOff($startDate, $endDate)
    {
        $globalDayOffs = GlobalDayOff::where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)->get();

        $holidayDates = collect();

        foreach ($globalDayOffs as $globalDayOff) {
            $currentStartDate = max($globalDayOff->start_date, $startDate);
            $currentEndDate = min($globalDayOff->end_date, $endDate);

            $period = new DatePeriod(
                new DateTime($currentStartDate),
                new DateInterval('P1D'),
                (new DateTime($currentEndDate))->modify('+1 day')  // To include the end_date
            );

            foreach ($period as $date) {
                $holidayDates->push($date->format('Y-m-d'));
            }
        }

        return $holidayDates->unique()->toArray();
    }

    private function _updateAttendance($userId, $date, $attendanceCode, $leaveCategoryCode = null)
    {
        UserAttendance::updateOrCreate([
            "user_id" => $userId,
            "date" => $date
        ], [
            "attendance_code" => $attendanceCode,
            "day_off_code" => $leaveCategoryCode
        ]);
    }

    private function _getSchedule($workingScheduleShift, $start_date, $end_date)
    {
        Carbon::setLocale($this->constants->locale);

        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        $takenDates = [];
        $dayOffDates = [];

        $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);

        while ($startDate <= $endDate) {
            $currentDate = $startDate->copy();

            if (!in_array($currentDate->toDateString(), $holidayDates)) {
                if (!$workingScheduleShift->workingShift->is_working) {
                    array_push($dayOffDates, $currentDate->format('Y-m-d'));
                } else {
                    array_push($takenDates, $currentDate->format('Y-m-d'));
                }
            }

            $workingScheduleShift = $workingScheduleShift->nextSchedule;
            $startDate->addDay();
        }

        return [
            "workingScheduleShift" => $workingScheduleShift,
            "takenDates" => $takenDates,
            "dayOffDates" => $dayOffDates,
            "holidayDates" => $holidayDates
        ];
    }

    private function _updateSchedule(mixed $leaveRequest)
    {
        $userId = $leaveRequest->user->id;


        if ($leaveRequest->leaveRequestCategory->half_day) {
            $workingScheduleShift = $this->_getWorkingScheduleShift($userId, $leaveRequest->date);
            $schedule = $this->_getSchedule(
                $workingScheduleShift,
                $leaveRequest->date,
                $leaveRequest->date
            );

            if ($schedule["takenDates"] && $schedule["takenDates"][0] == $leaveRequest->date) {
                $userAttendance = UserAttendance::where('user_id', $userId)->where('date', $leaveRequest->date)->first();

                if (!$userAttendance) {
                    $workingShift = $schedule['workingScheduleShift']->workingShift;
                    // $workingShift = UserEmployment::where('user_id', $userId)->first()->workingScheduleShift->workingShift;

                    UserAttendance::create([
                        'user_id' => $userId,
                        'date' => $leaveRequest->date,
                        'attendance_code' => $this->constants->attendance_code[0],
                        'shift_name' => $workingShift->name,
                        'working_start' => $leaveRequest->working_start ?? $workingShift->working_start,
                        'working_end' => $leaveRequest->working_end ?? $workingShift->working_end,
                        'overtime_before' => $workingShift->overtime_before,
                        'overtime_after' => $workingShift->overtime_after,
                        'late_check_in' => $workingShift->late_check_in,
                        'late_check_out' => $workingShift->late_check_out,
                        'start_attend' => $workingShift->start_attend,
                        'end_attend' => $workingShift->end_attend,
                    ]);
                } else {
                    $userAttendance->update([
                        "working_start" => $leaveRequest->working_start,
                        "working_end" => $leaveRequest->working_end
                    ]);
                }

                return 1;
            } else {
                throw new InvariantError("Pegawai Tidak dapat request pada hari libur!");
            }
        }

        $workingScheduleShift = $this->_getWorkingScheduleShift($userId, $leaveRequest->date);
        $schedule = $this->_getSchedule(
            $workingScheduleShift,
            $leaveRequest->start_date,
            $leaveRequest->end_date
        );

        if ($leaveRequest->taken != count($schedule["takenDates"])) {
            $leaveRequest->update([
                "taken" => count($schedule["takenDates"]),
            ]);
        }

        $leaveCategoryCode = $leaveRequest->leaveRequestCategory->code;

        collect($schedule["takenDates"])->map(function ($data) use (
            $userId,
            $leaveCategoryCode,
        ) {
            $this->_updateAttendance(
                $userId,
                $data,
                $this->constants->attendance_code[1],
                $leaveCategoryCode
            );
        });

        collect($schedule["dayOffDates"])->map(function ($data) use ($userId) {
            $this->_updateAttendance(
                $userId,
                $data,
                $this->constants->attendance_code[2],
            );
        });

        collect($schedule["holidayDates"])->map(function ($data) use ($userId) {
            $this->_updateAttendance(
                $userId,
                $data,
                $this->constants->attendance_code[3],
            );
        });
    }

    //quota management section
    private function _getTakenDays($startDate, $endDate, User $user)
    {
        Carbon::setLocale($this->constants->locale);

        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $workingScheduleShift = $this->_getWorkingScheduleShift($user->id, $startDate);
        $taken = 0;
        $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);
        while ($startDate <= $endDate) {
            $currentDate = $startDate->copy();

            if (!in_array($currentDate->toDateString(), $holidayDates) && $workingScheduleShift->workingShift->is_working) {
                $taken += 1;
            }
            $workingScheduleShift = $workingScheduleShift->nextSchedule;
            $startDate->addDay();
        }

        return $taken;
    }

    // this also updating the UserLeaveCategoryQuota
    private function _validateAndMakeQuery(UserLeaveRequest $request)
    {
        $user = $request->user;
        $today = Carbon::now()->format('Y-m-d');

        $query = [
            "user_leave_category_quotas" => null,
            "user_leave_quotas" => null
        ];

        $leaveCategory = LeaveRequestCategory::whereId($request->leave_request_category_id)->first();

        if (!$leaveCategory) {
            throw new NotFoundError("Kategori Request Tidak ditemukan");
        }

        if (!$user->userEmployment) {
            throw new InvariantError("User tidak memiliki data pegawai");
        }

        $balanceTaken = 1;

        if (!$leaveCategory->half_day) {
            $balanceTaken = $leaveCategory->duration
                ? ($leaveCategory->minus_amount ?? $leaveCategory->duration)
                : $this->_getTakenDays($request->start_date, $request->end_date, $user);
        }

        if (!$leaveCategory->unlimited_balance) {
            $adjustmentMonth = $leaveCategory->balance_type == $this->constants->balance_type[0] ? 12 : 1;

            $userCategoryQuota = UserLeaveCategoryQuota::where("leave_request_category_id", $leaveCategory->id)
                ->where("user_id", $user->id)
                ->orderBy("expired_date", "desc")
                ->first();

            if ($leaveCategory->expired) {
                if ($userCategoryQuota) {
                    if ($userCategoryQuota->expired_date > $today) {
                        if ($leaveCategory->balance_type == $this->constants->balance_type[0]) {
                            $expireDate = Carbon::parse($userCategoryQuota->expired_date)->addMonths(12);
                        } else {
                            $expireDate = Carbon::parse($userCategoryQuota->expired_date)->addMonth();
                        }

                        if ($leaveCategory->carry_amount && $userCategoryQuota->quotas > 0) {
                            if ($expireDate->lt($today)) {
                                $carryExpireDate = $expireDate;

                                while ($expireDate->lt($today)) {
                                    $carryExpireDate = $expireDate;
                                    $expireDate = $expireDate->addMonths($adjustmentMonth);
                                }

                                $carryAmount = $leaveCategory->carry_amount;
                                $carryExpireDate = $carryExpireDate->addMonth($leaveCategory->carry_expired);
                            } else {
                                $carryExpireDate = Carbon::parse($userCategoryQuota->expired_date)->addMonth($leaveCategory->carry_expired);
                                $carryAmount = min($userCategoryQuota->quotas, $leaveCategory->carry_amount);

                                $userCategoryQuota->update([
                                    "quotas" => $userCategoryQuota->quotas - $carryAmount
                                ]);
                            }

                            $newUserLeaveCategoryQuota = UserLeaveCategoryQuota::create([
                                "user_id" => $user->id,
                                "leave_request_category_id" => $leaveCategory->id,
                                "quotas" => $leaveCategory->balance,
                                "expired_date" => $expireDate,
                                "carry_quotas" => $carryAmount,
                                "carry_expired" => $carryExpireDate
                            ]);

                            if ($leaveCategory->balance + $carryAmount < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name pegawai tidak mencukupi!");
                            }

                            if ($carryAmount > $balanceTaken) {
                                $query["user_leave_category_quotas"] = [
                                    "id" => $newUserLeaveCategoryQuota->id,
                                    "carry_quotas" => $carryAmount - $balanceTaken
                                ];
                            } else if ($carryAmount = $balanceTaken) {
                                $query["user_leave_category_quotas"] = [
                                    "id" => $newUserLeaveCategoryQuota->id,
                                    "carry_quotas" => 0
                                ];
                            } else {
                                $query["user_leave_category_quotas"] = [
                                    "id" => $newUserLeaveCategoryQuota->id,
                                    "quotas" => $leaveCategory->balance - ($balanceTaken - $carryAmount),
                                    "carry_quotas" => 0
                                ];
                            }
                        } else {
                            $newUserLeaveCategoryQuota = UserLeaveCategoryQuota::create([
                                "user_id" => $user->id,
                                "leave_request_category_id" => $leaveCategory->id,
                                "quotas" => $leaveCategory->balance,
                                "expired_date" => $expireDate,
                            ]);

                            if ($leaveCategory->balance < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name pegawai tidak mencukupi!");
                            }

                            $query["user_leave_category_quotas"] = [
                                "id" => $newUserLeaveCategoryQuota->id,
                                "quotas" => $leaveCategory->balance - $balanceTaken,
                            ];
                        }
                    } else {
                        if (
                            $userCategoryQuota->carry_quotas
                            && $userCategoryQuota->carry_quotas > 0
                            && $userCategoryQuota->carry_expired < $today
                        ) {
                            if ($userCategoryQuota->quotas + $userCategoryQuota->carry_quotas < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name pegawai tidak mencukupi!");
                            }

                            if ($userCategoryQuota->carry_quotas > $balanceTaken) {
                                $query["user_leave_category_quotas"] = [
                                    "id" => $userCategoryQuota->id,
                                    "carry_quotas" => $userCategoryQuota->carry_quotas - $balanceTaken
                                ];
                            } else if ($userCategoryQuota->carry_quotas == $balanceTaken) {
                                $query["user_leave_category_quotas"] = [
                                    "id" => $userCategoryQuota->id,
                                    "carry_quotas" => 0
                                ];
                            } else {
                                $query["user_leave_category_quotas"] = [
                                    "id" => $userCategoryQuota->id,
                                    "quotas" => $leaveCategory->balance - ($balanceTaken - $userCategoryQuota->carry_quotas),
                                    "carry_quotas" => 0
                                ];
                            }
                        } else {
                            if ($userCategoryQuota->quotas < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name pegawai tidak mencukupi!");
                            }

                            $query["user_leave_category_quotas"] = [
                                "id" => $userCategoryQuota->id,
                                "quotas" => $leaveCategory->balance - $balanceTaken,
                            ];
                        }
                    }
                } else {
                    if (
                        Carbon::parse($user->userEmployment->join_date)
                        ->addMonths($leaveCategory->min_works)
                        ->gt($today)
                    ) {
                        throw new InvariantError("Pegawai tidak memiliki kuota $leaveCategory->name!");
                    }

                    $expireDate = Carbon::parse($user->userEmployment->join_date)->addMonths($leaveCategory->min_works);
                    $carryAmount = 0;
                    $carryExpireDate = $expireDate;

                    if ($expireDate->lt($today)) {
                        $carryAmount = $leaveCategory->carry_amount;
                        while ($expireDate->lt($today)) {
                            $carryExpireDate = $expireDate;
                            $expireDate = $expireDate->addMonths($adjustmentMonth);
                        }
                    }

                    $newUserLeaveCategoryQuota = UserLeaveCategoryQuota::create([
                        "user_id" => $user->id,
                        "leave_request_category_id" => $leaveCategory->id,
                        "quotas" => $leaveCategory->balance,
                        "expired_date" => $expireDate,
                        "carry_quotas" => $carryAmount,
                        "carry_expired" => $carryExpireDate
                    ]);

                    if ($carryAmount + $leaveCategory->balance < $balanceTaken) {
                        throw new InvariantError("Kuota $leaveCategory->name pegawai tidak mencukupi!");
                    }

                    if ($carryAmount > $balanceTaken) {
                        $query["user_leave_category_quotas"] = [
                            "id" => $newUserLeaveCategoryQuota->id,
                            "carry_quotas" => $carryAmount - $balanceTaken
                        ];
                    } else if ($carryAmount = $balanceTaken) {
                        $query["user_leave_category_quotas"] = [
                            "id" => $newUserLeaveCategoryQuota->id,
                            "carry_quotas" => 0
                        ];
                    } else {
                        $query["user_leave_category_quotas"] = [
                            "id" => $newUserLeaveCategoryQuota->id,
                            "quotas" => $leaveCategory->balance - ($balanceTaken - $carryAmount),
                            "carry_quotas" => 0
                        ];
                    }
                }
            } else {
                if (
                    Carbon::parse($user->userEmployment->join_date)
                    ->addMonths($leaveCategory->min_works)
                    ->gt($today)
                ) {
                    throw new InvariantError("Pegawai tidak memiliki kuota $leaveCategory->name!");
                }

                if ($userCategoryQuota) {
                    if ($userCategoryQuota->expired_date < $today) {
                        $newQuota = $leaveCategory->balance;
                        $expireDate = Carbon::parse($userCategoryQuota->expired_date)->addMonths($adjustmentMonth);

                        $newUserLeaveCategoryQuota = UserLeaveCategoryQuota::create([
                            "user_id" => $user->id,
                            "leave_request_category_id" => $leaveCategory->id,
                            "quotas" => $newQuota + $userCategoryQuota->quotas,
                            "expired_date" => $expireDate,
                        ]);

                        $userCategoryQuota->update([
                            "quotas" => 0,
                        ]);

                        if ($newQuota + $userCategoryQuota->quotas < $balanceTaken) {
                            throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                        }

                        $query["user_leave_category_quotas"] = [
                            "id" => $newUserLeaveCategoryQuota->id,
                            "quotas" => $newQuota + $userCategoryQuota->quotas - $balanceTaken,
                        ];
                    } else {
                        if ($userCategoryQuota->quotas < $balanceTaken) {
                            throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                        }

                        $query["user_leave_category_quotas"] = [
                            "id" => $userCategoryQuota->id,
                            "quotas" => $userCategoryQuota->quotas - $balanceTaken,
                        ];
                    }
                } else {
                    $newQuota = $leaveCategory->balance;
                    $expireDate = Carbon::parse($user->userEmployment->join_date)->addMonths($leaveCategory->min_works);

                    if ($expireDate->lt($today)) {
                        while ($expireDate->lt($today)) {
                            $newQuota += $leaveCategory->balance;
                            $expireDate = $expireDate->addMonths($adjustmentMonth);
                        }
                    }

                    $newUserLeaveCategoryQuota = UserLeaveCategoryQuota::create([
                        "user_id" => $user->id,
                        "leave_request_category_id" => $leaveCategory->id,
                        "quotas" => $newQuota,
                        "expired_date" => $expireDate,
                    ]);

                    if ($newQuota < $balanceTaken) {
                        throw new InvariantError("Kuota $leaveCategory->name pegawai tidak mencukupi!");
                    }

                    $query["user_leave_category_quotas"] = [
                        "id" => $newUserLeaveCategoryQuota->id,
                        "quotas" => $newQuota - $balanceTaken,
                    ];
                }
            }
        }

        if ($leaveCategory->use_quota) {
            $userLeaveQuotas = UserLeaveQuota::where("user_id", $user->id)
                ->where('quotas', '>', 0)
                ->whereDate("expired_date", ">=", $today)
                ->orderBy("expired_date", "asc")
                ->get();

            if (!$userLeaveQuotas) {
                throw new InvariantError("Kuota Cuti habis/tidak ditemukan, Cobalah perbaharui di profile pegawai!");
            }

            if ($userLeaveQuotas->sum("quotas") < $balanceTaken) {
                throw new InvariantError("Kuota cuti pegawai tidak mencukupi, membutuhkan ($balanceTaken) hari");
            }

            $leaveQuotaTaken = $balanceTaken;

            $query["user_leave_quotas"] = [];

            foreach ($userLeaveQuotas as $userLeaveQuota) {
                if ($leaveQuotaTaken <= 0) {
                    break;
                }

                if ($userLeaveQuota->quotas >= $leaveQuotaTaken) {
                    $query["user_leave_quotas"][] = [
                        "id" => $userLeaveQuota->id,
                        "quotas" => $userLeaveQuota->quotas - $leaveQuotaTaken
                    ];
                    $leaveQuotaTaken = 0;
                } else {
                    $query["user_leave_quotas"][] = [
                        "id" => $userLeaveQuota->id,
                        "quotas" => 0
                    ];
                    $leaveQuotaTaken -= $userLeaveQuota->quotas;
                }
            }
        } else {
            $balanceTaken = 0;
        }

        return [
            "query" => $query,
            "quota_taken" => $balanceTaken
        ];
    }

    private function _updateQuota($query)
    {
        if ($query["user_leave_category_quotas"]) {
            $userLeaveCategoryQuota = UserLeaveCategoryQuota::whereId($query["user_leave_category_quotas"]["id"])->first();

            if (!$userLeaveCategoryQuota) {
                throw new InvariantError("Kuota Request Tidak ditemukan! [SYSTEM ERROR]");
            }

            unset($query["user_leave_category_quotas"]["id"]);
            $userLeaveCategoryQuota->update($query["user_leave_category_quotas"]);
        }

        if ($query["user_leave_quotas"]) {
            foreach ($query["user_leave_quotas"] as $data) {
                $userLeaveQuota = UserLeaveQuota::whereId($data["id"])->first();

                if (!$userLeaveQuota) {
                    throw new InvariantError("Kuota Cuti Tidak ditemukan! [SYSTEM ERROR]");
                }

                unset($data["id"]);
                $userLeaveQuota->update($data);
            }
        }
    }

    // public function section

    public function updateRequestStatusById(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                "id" => "required",
                "status" => ["required", Rule::in(array_slice($this->constants->approve_status, 0, 3))],
                "comment" => "nullable"
            ]);

            $leaveRequest = UserLeaveRequest::whereId($request->id)->first();

            if (!$leaveRequest) {
                throw new NotFoundError("Time Off Request tidak ditemukan");
            }

            /** @var \App\Models\User $user */
            $user = $request->user();

            if ($user->hasPermissionTo('HC:change-all-status-request')) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $query = $this->_validateAndMakeQuery($leaveRequest);
                    $this->_updateSchedule($leaveRequest, $user);
                    $this->_updateQuota($query["query"]);

                    $leaveRequestCategory = LeaveRequestCategory::whereId($leaveRequest->leave_request_category_id)->first();

                    $date = $leaveRequestCategory->half_day ?
                        Carbon::createFromFormat('Y-m-d', $leaveRequest->date)->format('d/m/Y')
                        : Carbon::createFromFormat('Y-m-d', $leaveRequest->start_date)->format('d/m/Y')
                            . " - " . Carbon::createFromFormat('Y-m-d', $leaveRequest->end_date)->format('d/m/Y');

                    UserLeaveHistory::create([
                        "type" => $this->constants->leave_quota_history_type[0],
                        "user_id" => $leaveRequest->user->id,
                        "name" => "$leaveRequestCategory->name ($leaveRequestCategory->code)",
                        "approval_name" => $user->name,
                        "date" => $date,
                        "quota_change" => $query["quota_taken"]
                    ]);

                    $leaveRequest->update([
                        "approval_line" => $user->id,
                        "status" => $request->status,
                        "comment" => $request->comment,
                        "taken" => $query["quota_taken"]
                    ]);

                    DB::commit();

                    return response()->json([
                        "status" => "success",
                        "message" => "berhasil melakukan approve request time off"
                    ]);
                }

                $leaveRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                DB::commit();

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan reject request time off"
                ]);
            }

            $approvalLine = $leaveRequest->user->userEmployment->approvalLine;

            if ($approvalLine->id != $user->id || !$user->hasPermissionTo('Approval:change-status-request')) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($leaveRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
            }

            if ($leaveRequest->status == $this->constants->approve_status[2]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di reject");
            }

            if ($request->status == $this->constants->approve_status[1]) {
                $query = $this->_validateAndMakeQuery($leaveRequest);
                $this->_updateSchedule($leaveRequest, $user);
                $this->_updateQuota($query["query"]);

                $leaveRequestCategory = LeaveRequestCategory::whereId($leaveRequest->leave_request_category_id)->first();

                $date = $leaveRequestCategory->half_day ?
                    Carbon::createFromFormat('Y-m-d', $leaveRequest->date)->format('d/m/Y')
                    : Carbon::createFromFormat('Y-m-d', $leaveRequest->start_date)->format('d/m/Y')
                        . " - " . Carbon::createFromFormat('Y-m-d', $leaveRequest->end_date)->format('d/m/Y');

                UserLeaveHistory::create([
                    "type" => $this->constants->leave_quota_history_type[0],
                    "user_id" => $leaveRequest->user->id,
                    "name" => "$leaveRequestCategory->name ($leaveRequestCategory->code)",
                    "approval_name" => $user->name,
                    "date" => $date,
                    "quota_change" => $query["quota_taken"]
                ]);

                $leaveRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment,
                    "taken" => $query["quota_taken"]
                ]);

                DB::commit();

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan approve request time off"
                ]);
            }

            $leaveRequest->update([
                "approval_line" => $user->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan reject request time off"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getRequests(Request $request)
    {
        try {
            $user = $request->user();

            $userRequests = null;
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            if ($user->hasPermissionTo('HC:view-all-request')) {
                $userRequests = UserLeaveRequest::whereIn('status', array_slice($this->constants->approve_status, 0, 3))
                    ->with(['user.division', 'user.department'])
                    ->paginate($itemCount, ['*'], 'page', $page);
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $userRequests = UserLeaveRequest::where(function ($query) use ($user) {
                    $query->where(function ($query) use ($user) {
                        $query->where('status', $this->constants->approve_status[0])
                            ->whereHas('user.userEmployment', function ($query) use ($user) {
                                $query->where('approval_line', $user->id);
                            });
                    })->orWhere('approval_line', $user->id);
                })->with(['user.division', 'user.department'])
                    ->paginate($itemCount, ['*'], 'page', $page);
            } else {
                throw new AuthorizationError("Anda tidak berhak mengakses ini");
            }

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $userRequests->currentPage(),
                    "itemCount" => $itemCount,
                    "userTimeOffRequest" => $userRequests->items(),
                ],
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getRequestById(Request $request)
    {
        try {
            $userRequest = UserLeaveRequest::whereId($request->id)
                ->with([
                    'user.division',
                    'user.department',
                    'user.userEmployment.approvalLine'
                ])
                ->first();

            if (!$userRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            $user = $request->user();

            if ($user->hasPermissionTo('HC:view-all-request')) {
                return response()->json([
                    "status" => "success",
                    "data" => $userRequest
                ]);
            }

            if (
                ($userRequest->approvalLine && $userRequest->approvalLine->id != $user->id)
                || $userRequest->user->userEmployment->approvalLine->id != $user->id
            ) {
                throw new AuthorizationError("Anda tidak berhak mengakses ini!");
            }

            return response()->json([
                "status" => "success",
                "data" => $userRequest
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
