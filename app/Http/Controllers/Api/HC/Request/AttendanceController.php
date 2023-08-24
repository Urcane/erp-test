<?php

namespace App\Http\Controllers\Api\HC\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;
use App\Models\Attendance\UserAttendanceRequest;

class AttendanceController extends Controller
{
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
    }

    public function getApprovalAttendance(Request $request) {

        try {
            $userAttendanceRequest = UserAttendanceRequest::where('approval_line', $request->user()->id)->orderBy('created_at', 'desc')->with("user")->get();
            return response()->json([
                "status" => "success",
                "data" => $userAttendanceRequest,
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
