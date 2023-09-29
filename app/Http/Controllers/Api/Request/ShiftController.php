<?php

namespace App\Http\Controllers\Api\Request;

use App\Exceptions\AuthorizationError;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;

use App\Models\Attendance\UserShiftRequest;
use App\Models\Employee\UserEmployment;
use App\Models\Attendance\UserAttendance;
use App\Models\Employee\UserCurrentShift;
use App\Models\Employee\WorkingScheduleShift;
use Illuminate\Support\Facades\Auth;

class ShiftController extends RequestController
{
    public function getRequest(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $userShiftRequest = UserShiftRequest::where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->with(['workingShift', 'approvalLine'])
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $userShiftRequest->currentPage(),
                    "itemCount" => $itemCount,
                    "userShiftRequest" => $userShiftRequest->items(),
                ],
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getCurrentShift(Request $request)
    {
        try {
            $currentShift = null;

            $userAttendance = UserAttendance::where('user_id', $request->user()->id)
            ->whereDate('date', Carbon::now()->format('Y-m-d'))
            ->first();

            if ($userAttendance) {
                $currentShift = [
                    "name" => $userAttendance->shift_name,
                    "working_start" => $userAttendance->working_start,
                    "working_end" => $userAttendance->working_end,
                    "break_start" => $userAttendance->break_start,
                    "break_end" => $userAttendance->break_end,
                    "late_check_in" => $userAttendance->late_check_in,
                    "late_check_out" => $userAttendance->late_check_out,
                    "start_attend" => $userAttendance->start_attend,
                    "end_attend" => $userAttendance->end_attend,
                    "overtime_before" => $userAttendance->overtime_before,
                    "overtime_after" => $userAttendance->overtime_after,
                ];
            } else {
                $workingShift = $request->user()->userCurrentShift->workingScheduleShift->workingShift;

                $currentShift = [
                    "name" => $workingShift->name,
                    "working_start" => $workingShift->working_start,
                    "working_end" => $workingShift->working_end,
                    "break_start" => $workingShift->break_start,
                    "break_end" => $workingShift->break_end,
                    "late_check_in" => $workingShift->late_check_in,
                    "late_check_out" => $workingShift->late_check_out,
                    "start_attend" => $workingShift->start_attend,
                    "end_attend" => $workingShift->end_attend,
                    "overtime_before" => $workingShift->overtime_before,
                    "overtime_after" => $workingShift->overtime_after,
                ];
            }

            return response()->json([
                "status" => "success",
                "data" => $currentShift,
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getRequestById(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required'
            ]);

            $userShiftRequest = UserShiftRequest::where('user_id', $request->user()->id)
                ->whereId($request->id)
                ->with(['workingShift', 'approvalLine'])
                ->first();

            if (!$userShiftRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            return response()->json([
                "status" => "success",
                "data" => $userShiftRequest
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "working_shift_id" => "required",
                "notes" => "nullable|string"
            ]);

            $userCurrentShift = UserCurrentShift::where('user_id', $request->user()->id)->with("workingScheduleShift")->first();
            $workingScheduleShift = WorkingScheduleShift::where('working_schedule_id', $userCurrentShift->workingScheduleShift->working_schedule_id)->get();

            Carbon::setLocale($this->constants->locale);
            $requestDate = Carbon::parse($request->date);
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

            $userShiftId = $primaryScheduleShift->workingShift->id;

            if ($userShiftId == $request->working_shift_id) {
                throw new InvariantError("Tidak dapat melakukan request shift terhadap shift yang sama");
            }

            UserShiftRequest::create([
                "user_id" => $request->user()->id,
                "working_shift_id" => $request->working_shift_id,
                "date" => $request->date,
                "notes" => $request->notes,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan request shift"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function cancelRequest(Request $request)
    {
        try {
            $shiftRequest = UserShiftRequest::whereId($request->id)->first();

            if (!$shiftRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            if ($shiftRequest->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan ini");
            }

            if ($shiftRequest->status != $this->constants->approve_status[0]) {
                throw new InvariantError("Tidak bisa melakukan cancel pada request");
            }

            $shiftRequest->update([
                "status" => $this->constants->approve_status[3]
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil cancel request shift"
            ],);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
