<?php

namespace App\Http\Controllers\Api\HC\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;

use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserShiftRequest;
use App\Models\Employee\UserEmployment;

class ShiftController extends RequestController
{
    private function _updateAttendance($userId, $date, $workingShift)
    {
        $userAttendance = UserAttendance::where('user_id', $userId)->where('date', $date)->first();

        if (!$userAttendance) {
            $primaryShift = UserEmployment::where('user_id', $userId)->first()->workingScheduleShift->workingShift;

            UserAttendance::create([
                'user_id' => $userId,
                'date' => $date,
                'attendance_code' => $this->constants->attendance_code[0],
                'primary_shift_name' => $primaryShift->name,
                'primary_working_start' => $primaryShift->working_start,
                'primary_working_end' => $primaryShift->working_end,
                'shift_changed' => true,
                'shift_name' => $workingShift->name,
                'working_start' => $workingShift->working_start,
                'working_end' => $workingShift->working_end,
                'overtime_before' => $workingShift->overtime_before,
                'overtime_after' => $workingShift->overtime_after,
                'late_check_in' => $workingShift->late_check_in,
                'late_check_out' => $workingShift->late_check_out,
                'start_attend' => $workingShift->start_attend,
                'end_attend' => $workingShift->end_attend,
            ]);
        } else {
            $userAttendance->update([
                'shift_changed' => true,
                'shift_name' => $workingShift->name,
                'working_start' => $workingShift->working_start,
                'working_end' => $workingShift->working_end,
                'overtime_before' => $workingShift->overtime_before,
                'overtime_after' => $workingShift->overtime_after,
                'late_check_in' => $workingShift->late_check_in,
                'late_check_out' => $workingShift->late_check_out,
                'start_attend' => $workingShift->start_attend,
                'end_attend' => $workingShift->end_attend,
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
                $userRequests = new UserShiftRequest;
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $userRequests = UserShiftRequest::where(function ($query) use ($user) {
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
                    "userShiftRequest" => $userRequests->items(),
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
            $userRequest = UserShiftRequest::whereId($request->id)
                ->with([
                    'user.division',
                    'user.department',
                    'workingShift',
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

            $shiftRequest = UserShiftRequest::whereId($request->id)
                ->with('workingShift')->first();

            if (!$shiftRequest) {
                throw new NotFoundError("Shift Request tidak ditemukan");
            }

            $user = $request->user();

            if ($user->hasPermissionTo('HC:change-all-status-request')) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $this->_updateAttendance(
                        $shiftRequest->user_id,
                        $shiftRequest->date,
                        $shiftRequest->workingShift
                    );
                }

                $shiftRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request shift"
                ]);
            }

            $approvalLine = $shiftRequest->user->userEmployment->approvalLine;

            if ($approvalLine->id != $user->id || !$user->hasPermissionTo('Approval:change-status-request')) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($shiftRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
            }

            if ($shiftRequest->status == $this->constants->approve_status[2]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di reject");
            }

            if ($request->status == $this->constants->approve_status[1]) {
                $this->_updateAttendance(
                    $shiftRequest->user_id,
                    $shiftRequest->date,
                    $shiftRequest->workingShift
                );
            }

            $shiftRequest->update([
                "approval_line" =>  $user->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            return response()->json([
                "status" => "success",
                "approval_line" =>  $user->id,
                "message" => "berhasil melakukan update status request shift"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
