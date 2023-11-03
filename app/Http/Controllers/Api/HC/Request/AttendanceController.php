<?php

namespace App\Http\Controllers\Api\HC\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;

use App\Models\Attendance\AttendanceChangeLog;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Employee\UserCurrentShift;
use App\Models\Employee\WorkingScheduleShift;
use App\Utils\ErrorHandler;
use Illuminate\Support\Carbon;

class AttendanceController extends RequestController
{
    private function _updateAttendance($userId, $date, $checkIn, $checkOut, $approvalLineId)
    {
        $userAttendance = UserAttendance::where('user_id', $userId)->where('date', $date)->first();

        if (!$userAttendance) {
            $userCurrentShift = UserCurrentShift::where('user_id', $userId)->with("workingScheduleShift")->first();
            $workingScheduleShift = WorkingScheduleShift::where('working_schedule_id', $userCurrentShift->workingScheduleShift->working_schedule_id)->get();

            Carbon::setLocale($this->constants->locale);
            $requestDate = Carbon::parse($date);
            $now = Carbon::now();
            $diff = $now->diffInDays($requestDate);
            $countOfSchedule = $workingScheduleShift->count();
            $distance = $diff - (floor($diff/$countOfSchedule) * $countOfSchedule);

            $primaryScheduleShift = $workingScheduleShift->find($userCurrentShift->working_schedule_shift_id);
            for ($i=0; $i < $distance; $i++) {
                if ($requestDate > $now) {
                    $primaryScheduleShift = $workingScheduleShift->find($primaryScheduleShift->next);
                } else {
                    $primaryScheduleShift = $workingScheduleShift->filter(function ($scheduleShift) use ($primaryScheduleShift){
                        return $scheduleShift->next == $primaryScheduleShift->id;
                    })->first();
                }
            }

            $workingShift = $primaryScheduleShift->workingShift;

            $attendance = UserAttendance::create([
                'user_id' => $userId,
                'date' => $date,
                'attendance_code' => $this->constants->attendance_code[0],
                'shift_name' => $workingShift->name,
                'working_start' => $workingShift->working_start,
                'working_end' => $workingShift->working_end,
                'overtime_before' => $workingShift->overtime_before,
                'overtime_after' => $workingShift->overtime_after,
                'late_check_in' => $workingShift->late_check_in,
                'late_check_out' => $workingShift->late_check_out,
                'start_attend' => $workingShift->start_attend,
                'end_attend' => $workingShift->end_attend,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ]);

            AttendanceChangeLog::create([
                "user_id" => $approvalLineId,
                "attendance_id" => $attendance->id,
                "date" => $date,
                "action" => "SYSTEM EDIT",
                "old_attendance_code" => null,
                "new_attendance_code" => $this->constants->attendance_code[0],
                "old_working_start" => null,
                "old_working_end" => null,
                "new_working_start" => $workingShift->working_start,
                "new_working_end" => $workingShift->working_end,
                "old_check_in" => null,
                "old_check_out" => null,
                "new_check_in" => $checkIn ?? null,
                "new_check_out" => $checkOut ?? null,
                "reason" => "[CHANGED FROM USER REQUEST --SYSTEM]"
            ]);
        } else {
            $userAttendance->update([
                "check_in" => $checkIn ?? $userAttendance->check_in,
                "check_out" => $checkOut ?? $userAttendance->check_out
            ]);

            AttendanceChangeLog::create([
                "user_id" => $approvalLineId,
                "attendance_id" => $userAttendance->id,
                "date" => $userAttendance->date,
                "action" => "SYSTEM EDIT",
                "old_attendance_code" => $userAttendance->attendance_code,
                "new_attendance_code" => $userAttendance->attendance_code,
                "old_working_start" => $userAttendance->working_start,
                "old_working_end" => $userAttendance->working_end,
                "new_working_start" => null,
                "new_working_end" => null,
                "old_check_in" => $userAttendance->check_in,
                "old_check_out" => $userAttendance->check_out,
                "new_check_in" => $checkIn ?? $userAttendance->check_in,
                "new_check_out" => $checkOut ?? $userAttendance->check_out,
                "reason" => "[CHANGED FROM USER REQUEST --SYSTEM]"
            ]);
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
                $userRequests = UserAttendanceRequest::whereIn('status', array_slice($this->constants->approve_status, 0, 3))
                    ->with(['user.division', 'user.department'])
                    ->paginate($itemCount, ['*'], 'page', $page);
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $userRequests = UserAttendanceRequest::where(function ($query) use ($user) {
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
                    "userAttendanceRequest" => $userRequests->items(),
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
            $request->validate([
                "id" => 'required'
            ]);

            $userRequest = UserAttendanceRequest::whereId($request->id)
                ->with([
                    'approvalLine',
                    'user.userEmployment.workingSchedule.workingShifts'
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

    public function updateRequestStatusById(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "status" => ["required", Rule::in($this->constants->approve_status)],
                "comment" => "nullable"
            ]);

            $attendanceRequest = UserAttendanceRequest::whereId($request->id)->first();

            if (!$attendanceRequest) {
                throw new NotFoundError("Attendance Request tidak ditemukan");
            }

            $user = $request->user();

            if ($user->hasPermissionTo('HC:change-all-status-request')) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $this->_updateAttendance(
                        $attendanceRequest->user_id,
                        $attendanceRequest->date,
                        $attendanceRequest->check_in,
                        $attendanceRequest->check_out,
                        $request->user()->id
                    );
                }

                $attendanceRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request attendance"
                ]);
            }

            $approvalLine = $attendanceRequest->user->userEmployment->approvalLine;

            if ($approvalLine->id != $user->id || !$user->hasPermissionTo('Approval:change-status-request')) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($attendanceRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
            }

            if ($attendanceRequest->status == $this->constants->approve_status[2]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di reject");
            }

            if ($request->status == $this->constants->approve_status[1]) {
                $this->_updateAttendance(
                    $attendanceRequest->user_id,
                    $attendanceRequest->date,
                    $attendanceRequest->check_in,
                    $attendanceRequest->check_out,
                    $user->id
                );
            }

            $attendanceRequest->update([
                "approval_line" => $user->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan update status request attendance"
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
