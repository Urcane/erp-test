<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Utils\ErrorHandler;
use App\Constants;
use App\Models\Attendance\AttendanceChangeLog;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserAttendanceRequest;

class AttendanceController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "notes" => "nullable|string",
                "check_in" => "nullable|date_format:H:i|required_without_all:check_out",
                "check_out" => "nullable|date_format:H:i|required_without_all:check_in",
            ]);

            if (!Auth::user()->approval_line) {
                $userAttendance = UserAttendance::where('user_id', Auth::user()->id)->where('date', $request->date)->first();

                $userAttendance->update([
                    "check_in" => $checkIn ?? $userAttendance->check_in,
                    "check_out" => $checkOut ?? $userAttendance->check_out
                ]);

                AttendanceChangeLog::create([
                    "user_id" => Auth::user()->id,
                    "attendance_id" => Auth::user()->id,
                    "date" => $userAttendance->date,
                    "action" => "SYSTEM EDIT",
                    "old_check_in" => $userAttendance->check_in,
                    "old_check_out" => $userAttendance->check_out,
                    "new_check_in" => $checkIn ?? $userAttendance->check_in,
                    "new_check_out" => $checkOut ?? $userAttendance->check_out,
                    "reason" => "[CHANGED FROM USER REQUEST --SYSTEM] [SELF APPROVAL]"
                ]);
            }

            UserAttendanceRequest::create([
                "user_id" => Auth::user()->id,
                "approval_line" => Auth::user()->approval_line,
                "date" => $request->date,
                "notes" => $request->notes,
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

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            $attendanceRequests = UserAttendanceRequest::where('user_id', $request->user_id)->orderBy('created_at', 'desc');

            return DataTables::of($attendanceRequests)
                ->addColumn('action', function ($action) {
                    $menu = '<li><a href="'.route('hc.emp.profile',['id'=>$action->id]).'" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$menu.'
                    </ul>
                    ';
                })
                ->addColumn('approval_line', function ($attendanceRequest) {
                    return $attendanceRequest->approvalLine->name ?? "-";
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
