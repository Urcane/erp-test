<?php

namespace App\Http\Controllers\Request;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Leave\LeaveQuota;
use App\Models\Leave\LeaveRequestCategory;
use App\Models\Leave\UserLeaveCategoryQuota;
use App\Models\Leave\UserLeaveQuota;
use App\Models\Leave\UserLeaveRequest;
use App\Models\User;
use Carbon\Carbon;

use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Validation\Rule;

class TimeOffController extends RequestController
{
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

    private function _getTakenDays($startDate, $endDate)
    {
        Carbon::setLocale($this->constants->locale);

        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $taken = 0;
        $workingDayOff = Auth::user()->userEmployment->workingScheduleShift->workingSchedule->dayOffs->pluck('day')->toArray();

        $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);

        while ($startDate <= $endDate) {
            $currentDate = $startDate->copy();
            $dayName = $currentDate->translatedFormat('l');

            if (!in_array($currentDate->toDateString(), $holidayDates) && !in_array($dayName, $workingDayOff)) {
                $taken += 1;
            }

            $startDate->addDay();
        }

        return $taken;
    }

    // this also updating the UserLeaveCategoryQuota
    private function _validateAndMakeQuery(User $user, Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');

        $leaveCategory = LeaveRequestCategory::whereId($request->leave_request_category_id)->first();

        if (!$leaveCategory) {
            throw new NotFoundError("Kategori Request Tidak ditemukan");
        }

        if ($leaveCategory->attachment && !$request->file) {
            throw new InvariantError("Attachment Required!");
        }

        if (!$user->userEmployment) {
            throw new InvariantError("Anda tidak memiliki data pegawai");
        }

        $requestDuration = 1;
        $balanceTaken = 1;

        if (!$leaveCategory->half_day) {
            $requestDuration = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;

            $balanceTaken = $leaveCategory->duration
                ? ($leaveCategory->minus_amount ?? $leaveCategory->duration)
                : $this->_getTakenDays($request->start_date, $request->end_date);
        }

        if ($leaveCategory->min_notice) {
            if (Carbon::parse($request->start_date)->gt(Carbon::now()->addDays($leaveCategory->min_notice))) {
                throw new InvariantError("Request anda dibawah minimal pengajuan, Cobalah kontak admin!");
            }
        }

        if ($leaveCategory->max_request) {
            // TO DO : Get History Request
            if ($leaveCategory->duration && $leaveCategory->duration * $leaveCategory->max_request > $requestDuration) {
                throw new InvariantError("Request $leaveCategory->name melebihi batas $leaveCategory->max_request");
            }
            if ($requestDuration > $leaveCategory->max_request) {
                throw new InvariantError("Request $leaveCategory->name melebihi batas $leaveCategory->max_request");
            }
        }

        if (!$leaveCategory->unlimited_balance) {
            $adjustmentMonth = $leaveCategory->balance_type == $this->constants->balance_type[0] ? 12 : 1;

            if ($leaveCategory->expire_date) {
                $userCategoryQuota = UserLeaveCategoryQuota::where("leave_request_category_id", $leaveCategory->id)
                    ->where("user_id", $user->id)
                    ->orderBy("expire_date", "desc")
                    ->first();

                if ($userCategoryQuota) {
                    if ($userCategoryQuota->expire_date > $today) {
                        if ($leaveCategory->balance_type == $this->constants->balance_type[0]) {
                            $expireDate = Carbon::parse($userCategoryQuota->expire_date)->addMonths(12);
                        } else {
                            $expireDate = Carbon::parse($userCategoryQuota->expire_date)->addMonth();
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
                                $carryExpireDate = Carbon::parse($userCategoryQuota->expire_date)->addMonth($leaveCategory->carry_expired);
                                $carryAmount = min($userCategoryQuota->quotas, $leaveCategory->carry_amount);

                                $userCategoryQuota->update([
                                    "quotas" => $userCategoryQuota->quotas - $carryAmount
                                ]);
                            }

                            UserLeaveCategoryQuota::create([
                                "user_id" => $user->id,
                                "leave_request_category_id" => $leaveCategory->id,
                                "quotas" => $leaveCategory->balance,
                                "expired_date" => $expireDate,
                                "carry_quotas" => $carryAmount,
                                "carry_expired" => $carryExpireDate
                            ]);

                            if ($leaveCategory->balance + $carryAmount < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                            }
                        } else {
                            UserLeaveCategoryQuota::create([
                                "user_id" => $user->id,
                                "leave_request_category_id" => $leaveCategory->id,
                                "quotas" => $leaveCategory->balance,
                                "expired_date" => $expireDate,
                            ]);

                            if ($leaveCategory->balance < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                            }
                        }
                    } else {
                        if ($userCategoryQuota->carry_quotas
                            && $userCategoryQuota->carry_quotas > 0
                            && $userCategoryQuota->carry_expired < $today
                        ) {
                            if ($userCategoryQuota->quotas + $userCategoryQuota->carry_quotas < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                            }
                        } else {
                            if ($userCategoryQuota->quotas < $balanceTaken) {
                                throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                            }
                        }
                    }
                } else {
                    if (
                        Carbon::parse($user->userEmployment->join_date)
                            ->addMonths($leaveCategory->min_works)
                            ->gt($today)
                    ) {
                        throw new InvariantError("Anda tidak memiliki kuota $leaveCategory->name!");
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

                    UserLeaveCategoryQuota::create([
                        "user_id" => $user->id,
                        "leave_request_category_id" => $leaveCategory->id,
                        "quotas" => $leaveCategory->balance,
                        "expired_date" => $expireDate,
                        "carry_quotas" => $carryAmount,
                        "carry_expired" => $carryExpireDate
                    ]);

                    if ($carryAmount + $leaveCategory->balance < $balanceTaken) {
                        throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                    }
                }
            } else {
                if (
                    Carbon::parse($user->userEmployment->join_date)
                        ->addMonths($leaveCategory->min_works)
                        ->gt($today)
                ) {
                    throw new InvariantError("Anda tidak memiliki kuota $leaveCategory->name!");
                }

                $newQuota = $leaveCategory->balance;
                $expireDate = Carbon::parse($user->userEmployment->join_date)->addMonths($leaveCategory->min_works);

                if ($expireDate->lt($today)) {
                    while ($expireDate->lt($today)) {
                        $newQuota += $leaveCategory->balance;
                        $expireDate = $expireDate->addMonths($adjustmentMonth);
                    }
                }

                UserLeaveCategoryQuota::create([
                    "user_id" => $user->id,
                    "leave_request_category_id" => $leaveCategory->id,
                    "quotas" => $newQuota,
                    "expired_date" => $expireDate,
                ]);

                if ($newQuota < $balanceTaken) {
                    throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                }
            }
        }

        if ($leaveCategory->use_quota) {
            $userLeaveQuotas = UserLeaveQuota::where("user_id", $user->id)
                ->whereNot("quotas", 0)
                ->whereDate("expire_date", ">=", $today)
                ->orderBy("expired_date", "asc")
                ->get();

            if (!$userLeaveQuotas) {
                throw new InvariantError("Kuota Cuti habis/tidak ditemukan, Cobalah perbaharui di profile anda!");
            }

            if ($userLeaveQuotas->sum("quotas") < $balanceTaken) {
                throw new InvariantError("Kuota cuti anda tidak mencukupi, membutuhkan ($balanceTaken) hari");
            }
        }

        if ($leaveCategory->half_day) {
            return [
                "date" => $request->date,
                "working_start" => $request->working_start,
                "working_end" => $request->working_end,
            ];
        } else {
            return [
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "taken" => $balanceTaken,
            ];
        }
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "leave_request_category_id" => "required",
                "file" => "nullable",
                "notes" => "nullable|string",
                "start_date" => [
                    "nullable",
                    "date",
                    "before_or_equal:end_date",
                    "required_if:date,!=,null"
                ],
                "end_date" => [
                    "nullable",
                    "date",
                    "after_or_equal:start_date",
                    "required_if:date,!=,null"
                ],
                "date" => [
                    "nullable",
                    "date",
                    "required_if:start_date,=,null",
                    "required_if:end_date,=,null"
                ],
                'working_start' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return !empty($request->date) && empty($request->working_end);
                    }),
                ],
                'working_end' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return !empty($request->date) && empty($request->working_start);
                    }),
                ],
            ]);

            $user = Auth::user();

            $query = $this->_validateAndMakeQuery($user, $request);

            if ($request->file) {
                $file = $request->file('file');
                $filename = time() . "_" . $user->name . "." . $file->getClientOriginalExtension();
                $file->storeAs('request/timeoff/', $filename, 'public');
            }

            $query += [
                "user_id" => $user->id,
                "leave_request_category_id" => $request->leave_request_category_id,
                "file" => $filename ?? null,
                "notes" => $request->notes,
            ];

            UserLeaveRequest::create($query);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan request time off"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function cancelRequest(Request $request)
    {
        try {
            $timeoffRequest = UserLeaveRequest::whereId($request->id)->first();

            if (!$timeoffRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            if ($timeoffRequest->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan ini");
            }

            if ($timeoffRequest->status != $this->constants->approve_status[0]) {
                throw new InvariantError("Tidak bisa melakukan cancel pada request");
            }

            $timeoffRequest->update([
                "status" => $this->constants->approve_status[3]
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil cancel request attendance"
            ],);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            if (!($user->id == $request->user_id|| $user->hasPermissionTo('HC:view-attendance'))) {
                abort(403);
            }

            $leaveRequest = UserLeaveRequest::where('user_id', $request->user_id)
                ->orderBy('created_at', 'desc')
                ->with(['user.userEmployment', 'approvalLine', 'leaveRequestCategory']);

            return DataTables::of($leaveRequest)
                ->addColumn('action', function ($query) {
                    $constants = $this->constants;

                    $fileName = $query->file;
                    $fileLink = asset("/storage/request/timeoff/$fileName");
                    return view('profile.part-profile.time-management-part.timeoff.menu', compact([
                        'query', 'constants', 'fileName', 'fileLink'
                    ]));
                })
                ->addColumn('created_at', function ($leaveRequest) {
                    $date = explode(" ", explode("T", $leaveRequest->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('approval_line', function ($leaveRequest) {
                    if ($leaveRequest->status != $this->constants->approve_status[0]) {
                        return $leaveRequest->approvalLine->name ?? "-";
                    }

                    return $leaveRequest->user->userEmployment->approvalLine->name ?? "-";
                })
                ->addColumn('name', function ($leaveRequest) {
                    return $leaveRequest->leaveRequestCategory->name;
                })
                ->addColumn('code', function ($leaveRequest) {
                    return $leaveRequest->leaveRequestCategory->code;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
