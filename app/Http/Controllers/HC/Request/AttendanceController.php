<?php

namespace App\Http\Controllers\HC\Request;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

use App\Utils\ErrorHandler;
use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\AttendanceChangeLog;
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Attendance\UserAttendance;

class AttendanceController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    private function _updateAttendance($userId, $date, $checkIn, $checkOut)
    {
        $userAttendance = UserAttendance::where('user_id', $userId)->where('date', $date)->first();

        $userAttendance->update([
            "check_in" => $checkIn ?? $userAttendance->check_in,
            "check_out" => $checkOut ?? $userAttendance->check_out
        ]);

        AttendanceChangeLog::create([
            "user_id" => Auth::user()->id,
            "attendance_id" => $userAttendance->id,
            "date" => $userAttendance->date,
            "action" => "SYSTEM EDIT",
            "old_check_in" => $userAttendance->check_in,
            "old_check_out" => $userAttendance->check_out,
            "new_check_in" => $checkIn ?? $userAttendance->check_in,
            "new_check_out" => $checkOut ?? $userAttendance->check_out,
            "reason" => "[CHANGED FROM USER REQUEST --SYSTEM]"
        ]);
    }

    public function updateRequestStatus(Request $request)
    {
        try {
            $request->validate([
                "attendance_request_id" => "required",
                "status" => ["required", Rule::in($this->constants->approve_status)],
            ]);

            $attendanceRequest = UserAttendanceRequest::whereId($request->attendance_request_id)->first();

            if (!$attendanceRequest) {
                throw new NotFoundError("Attendance Request tidak ditemukan");
            }

            if (!$attendanceRequest->approval_line) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $this->_updateAttendance(
                        $attendanceRequest->user_id,
                        $attendanceRequest->date,
                        $attendanceRequest->check_in,
                        $attendanceRequest->check_out
                    );
                }

                $attendanceRequest->update([
                    "status" => $request->status,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request attendance"
                ]);
            }

            if ($attendanceRequest->approval_line != Auth::user()->id) {
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
                    $attendanceRequest->check_out
                );
            }

            $attendanceRequest->update([
                "status" => $request->status,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan update status request attendance"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $userId = Auth::user()->id;

            $query = UserAttendanceRequest::where(function ($query) use ($userId) {
                    $query->where('approval_line', $userId)
                        ->orWhere(function ($query) use ($userId) {
                            $query->whereId($userId)
                                    ->whereNull('approval_line');
                        });
                })
                ->with(['user.division', 'user.department', 'user.userEmployment.subBranch']);

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $query = $query->whereBetween('date', $range_date)->orderBy('date', 'desc');
            } else {
                $query = $query->orderBy('date', 'desc');
            }

            return DataTables::of($query)
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="emergency_contact_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addColumn('name', function ($query) {
                    return $query->user->name;
                })
                ->addColumn('nip', function ($query) {
                    return $query->user->userEmployment->employee_id;
                })
                ->addColumn('date', function ($query) {
                    return $query->date;
                })
                ->addColumn('branch', function ($query) {
                    return $query->user->userEmployment->subBranch->name;
                })
                ->addColumn('organization', function ($query) {
                    return $query->user->department->department_name;
                })
                ->addColumn('job_level', function ($query) {
                    return $query->user->getRoleNames()[0];
                })
                ->addColumn('job_position', function ($query) {
                    return $query->user->division->divisi_name;
                })
                ->addColumn('action', function ($query) {
                    return view('hc.cmt-request.attendance.menu', compact([]));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
