<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Attendance\UserAttendanceRequest;
use Illuminate\Validation\Rule;

use App\Utils\ErrorHandler;
use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
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
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "notes" => "nullable|string",
                "check_in" => "nullable|timestamp",
                "check_out" => "nullable|timestamp",
            ]);

            UserAttendanceRequest::create([
                "user_id" => Auth::user()->id,
                "approval_line" => Auth::user()->approval_line,
                "date" => $request->date,
                "notes" => $request->notes,
                "check_in" => $request->check_in,
                "check_out" => $request->check_out,
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

            if (!$attendanceRequest->approval_line != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($attendanceRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
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

    public function showAllRequestTable(Request $request)
    {
        //
    }

    public function showWaitingRequestTable(Request $request)
    {
        //
    }
}
