<?php

namespace App\Http\Controllers\Request;

use App\Exceptions\AuthorizationError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Employee\UserCurrentShift;
use App\Models\Employee\WorkingScheduleShift;
use App\Utils\ErrorHandler;
use Carbon\Carbon;

class AttendanceController extends RequestController
{
    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "notes" => "nullable|string",
                "file" => "nullable",
                "check_in" => "nullable|date_format:H:i|required_without_all:check_out",
                "check_out" => "nullable|date_format:H:i|required_without_all:check_in",
            ], [
                "check_in.required_without_all" => "Check in atau check out harus diisi",
                "check_out.required_without_all" => "Check in atau check out harus diisi",
            ]);

            $userEmployment = Auth::user()->userEmployment;

            if (!$userEmployment) {
                throw new InvariantError("User belum memiliki data karyawan");
            }

            Carbon::setLocale($this->constants->locale);
            $now = Carbon::now();
            $today = $now->toDateString();
            $globalDayOff = GlobalDayOff::where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat request absen pada hari libur ($globalDayOff->name)");
            }

            // save the file
            if ($request->file) {
                $file = $request->file('file');
                $filename = time() . "_" . Auth::user()->name . "." . $file->getClientOriginalExtension();
                $file->storeAs('request/attendance/', $filename, 'public');
            }

            UserAttendanceRequest::create([
                "user_id" => Auth::user()->id,
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
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function cancelRequest(Request $request)
    {
        try {
            $attendanceRequest = UserAttendanceRequest::whereId($request->id)->first();

            if (!$attendanceRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            if ($attendanceRequest->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan ini");
            }

            if ($attendanceRequest->status != $this->constants->approve_status[0]) {
                throw new InvariantError("Tidak bisa melakukan cancel pada request");
            }

            $attendanceRequest->update([
                "status" => $this->constants->approve_status[3]
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil cancel request attendance"
            ],);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $attendanceRequests = UserAttendanceRequest::where('user_id', $request->user_id)
                ->orderBy('created_at', 'desc')
                ->with(['user.userEmployment', 'approvalLine']);

            $userCurrentShift = UserCurrentShift::where('user_id', $request->user_id)->with("workingScheduleShift")->first();
            $workingScheduleShift = WorkingScheduleShift::where('working_schedule_id', $userCurrentShift->workingScheduleShift->working_schedule_id)->get();

            return DataTables::of($attendanceRequests)
                ->addColumn('action', function ($query) use ($workingScheduleShift, $userCurrentShift) {
                    $constants = $this->constants;

                    $shift = "-";
                    $workHour = "-";

                    $userAttendance = UserAttendance::where('user_id', $query->user->id)
                        ->whereDate('date', $query->date)->first();

                    if (!$userAttendance) {
                        Carbon::setLocale($this->constants->locale);
                        $requestDate = Carbon::parse($query->date);
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

                        $shift = $workingShift->name;
                        $workHour = "$workingShift->working_start - $workingShift->working_end";
                    } else {
                        $shift = $userAttendance->shift_name;
                        $workHour = "$userAttendance->working_start - $userAttendance->working_end";
                    }

                    $fileName = $query->file;
                    $fileLink = asset("/storage/request/attendance/$fileName");

                    return view('profile.part-profile.time-management-part.attendance.menu', compact([
                        'query', 'constants', 'shift', 'workHour', 'fileName', 'fileLink'
                    ]));
                })
                ->addColumn('approval_line', function ($attendanceRequest) {
                    if ($attendanceRequest->status != $this->constants->approve_status[0]) {
                        return $attendanceRequest->approvalLine->name ?? "-";
                    }

                    return $attendanceRequest->user->userEmployment->approvalLine->name ?? "-";
                })
                ->addColumn('created_at', function ($attendanceRequest) {
                    $date = explode(" ", explode("T", $attendanceRequest->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('date', function ($attendanceRequest) {
                    $date = Carbon::createFromFormat('Y-m-d', $attendanceRequest->date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('check_in', function ($attendanceRequest) {
                    $checkIn = $attendanceRequest->check_in;

                    if ($checkIn) {
                        return date('H:i', strtotime($checkIn));
                    }
                    return "-";
                })
                ->addColumn('check_out', function ($attendanceRequest) {
                    $checkOut = $attendanceRequest->check_out;

                    if ($checkOut) {
                        return date('H:i', strtotime($checkOut));
                    }
                    return "-";
                })
                ->addIndexColumn()
                ->rawColumns(['action','DT_RowChecklist'])
                ->make(true);
        }
    }
}
