<?php

namespace App\Http\Controllers\Api\Request;

use App\Constants;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;
use App\Models\Attendance\UserAttendanceRequest;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function getRequest(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $userAttendanceRequest = UserAttendanceRequest::where('user_id', $request->user()->id)
                ->orderBy('date', 'desc')
                ->with(['approvalLine'])
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $userAttendanceRequest->currentPage(),
                    "itemCount" => $itemCount,
                    "userAttendanceRequest" => $userAttendanceRequest->items(),
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
            $request->validate([
                'id' => 'required'
            ]);

            $userAttendanceRequest = UserAttendanceRequest::where('user_id', $request->user()->id)
                ->whereId($request->id)
                ->with(['approvalLine'])
                ->first();

            if (!$userAttendanceRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            $shift = null;

            $userAttendance = $request->user()
                ->userAttendances()
                ->whereDate('date', $userAttendanceRequest->date)
                ->first();

            if ($userAttendance) {
                $shift = [
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
                $workingShift = $request->user()->userEmployment->workingScheduleShift->workingShift;

                $shift = [
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

            $userAttendanceRequest["shift"] = $shift;

            return response()->json([
                "status" => "success",
                "data" => $userAttendanceRequest
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
                "notes" => "nullable|string",
                "file" => "nullable",
                "check_in" => "nullable|date_format:H:i|required_without_all:check_out",
                "check_out" => "nullable|date_format:H:i|required_without_all:check_in",
            ]);

            $userEmployment = $request->user()->userEmployment->load([
                'workingScheduleShift.workingSchedule.dayOffs',
                'subBranch.branchLocations'
            ]);

            if (!$userEmployment) {
                throw new InvariantError("User belum memiliki data karyawan");
            }

            Carbon::setLocale($this->constants->locale);
            $now = Carbon::now();
            $today = $now->toDateString();
            $globalDayOff = GlobalDayOff::where('date', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat request absen pada hari libur ($globalDayOff->name)");
            }

            $workingDayOff = $userEmployment->workingScheduleShift->workingSchedule->dayOffs->pluck('name')->toArray();

            if (in_array($now->dayName, $workingDayOff)) {
                throw new InvariantError("Tidak dapat request absen pada hari libur (Working Schedule)");
            }

            // save the file
            if ($request->file) {
                $file = $request->file('file');
                $filename = time() . $file->getClientOriginalName();
                $file->storeAs('request/attendance/', $filename, 'public');
            }

            UserAttendanceRequest::create([
                "user_id" => $request->user()->id,
                "date" => $request->date,
                "notes" => $request->notes,
                "file" => $filename ?? null,
                "check_in" => $request->check_in ? date('Y-m-d H:i:s', strtotime(date('Y-m-d') . ' ' . $request->check_in)): null,
                "check_out" => $request->check_out ? date('Y-m-d H:i:s', strtotime(date('Y-m-d') . ' ' . $request->check_out)) : null,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan request attendance"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
