<?php

namespace App\Http\Controllers\Api\HC\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\LeaveRequestCategory;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserLeaveHistory;
use App\Models\Attendance\UserLeaveRequest;
use Carbon\Carbon;

use DateTime;
use DateInterval;
use DatePeriod;

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

    private function _createHistory($userId, $date, $approvalLine, $leaveCategoryName, $leaveCategoryCode)
    {
        UserLeaveHistory::create([
            "user_id" => $userId,
            "leave_category" => $leaveCategoryName,
            "code" => $leaveCategoryCode,
            "date" => $date,
            "approval_line" => $approvalLine
        ]);
    }

    private function _getSchedule($workingDayOff, $start_date, $end_date)
    {
        Carbon::setLocale($this->constants->locale);

        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        $takenDates = [];
        $dayOffDates = [];

        $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);

        while ($startDate <= $endDate) {
            $currentDate = $startDate->copy();
            $dayName = $currentDate->translatedFormat('l');

            if (!in_array($currentDate->toDateString(), $holidayDates)) {
                if (in_array($dayName, $workingDayOff)) {
                    array_push($dayOffDates, $currentDate->format('Y-m-d'));
                } else {
                    array_push($takenDates, $currentDate->format('Y-m-d'));
                }
            }

            $startDate->addDay();
        }

        return [
            "takenDates" => $takenDates,
            "dayOffDates" => $dayOffDates,
            "holidayDates" => $holidayDates
        ];
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
            $data = $this->errorHandler->handle($th);

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
                    'user.userEmployment.workingScheduleShift.workingShift'
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
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateRequestStatusById(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "status" => ["required", Rule::in($this->constants->approve_status)],
                "comment" => "nullable"
            ]);

            $leaveRequest = UserLeaveRequest::whereId($request->id)->first();

            if (!$leaveRequest) {
                throw new NotFoundError("Time Off Request tidak ditemukan");
            }

            $user = $request->user();
            $userId = $leaveRequest->user->id;

            if ($user->hasPermissionTo('HC:change-all-status-request')) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $workingDayOff = $leaveRequest
                        ->user
                        ->userEmployment
                        ->workingScheduleShift
                        ->workingSchedule
                        ->dayOffs
                        ->pluck('day')->toArray();

                    $leaveCategoryName = $leaveRequest->leaveRequestCategory->name;
                    $leaveCategoryCode = $leaveRequest->leaveRequestCategory->code;

                    $schedule = $this->_getSchedule(
                        $workingDayOff,
                        $leaveRequest->start_date,
                        $leaveRequest->end_date
                    );

                    if ($leaveRequest->taken != count($schedule["takenDates"])) {
                        $leaveRequest->update([
                            "taken" => count($schedule["takenDates"]),
                        ]);
                    }

                    collect($schedule["takenDates"])->map(function ($data) use (
                        $userId,
                        $leaveCategoryName,
                        $leaveCategoryCode,
                        $user
                    ) {
                        $this->_updateAttendance(
                            $userId,
                            $data,
                            $this->constants->attendance_code[1],
                            $leaveCategoryCode
                        );

                        $this->_createHistory(
                            $userId,
                            $data,
                            $user->id,
                            $leaveCategoryName,
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

                $leaveRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request time off"
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
                $workingDayOff = $leaveRequest
                    ->user
                    ->userEmployment
                    ->workingScheduleShift
                    ->workingSchedule
                    ->dayOffs
                    ->pluck('day')->toArray();

                $leaveCategoryName = $leaveRequest->leaveRequestCategory->name;
                $leaveCategoryCode = $leaveRequest->leaveRequestCategory->code;

                $schedule = $this->_getSchedule(
                    $workingDayOff,
                    $leaveRequest->start_date,
                    $leaveRequest->end_date
                );

                if ($leaveRequest->taken != count($schedule["takenDates"])) {
                    $leaveRequest->update([
                        "taken" => count($schedule["takenDates"]),
                    ]);
                }

                collect($schedule["takenDates"])->map(function ($data) use (
                    $userId,
                    $leaveCategoryName,
                    $leaveCategoryCode,
                    $user
                ) {
                    $this->_updateAttendance(
                        $userId,
                        $data,
                        $this->constants->attendance_code[1],
                        $leaveCategoryCode
                    );

                    $this->_createHistory(
                        $userId,
                        $data,
                        $user->name,
                        $leaveCategoryName,
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

            $leaveRequest->update([
                "approval_line" => $user->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan update status request time off"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
