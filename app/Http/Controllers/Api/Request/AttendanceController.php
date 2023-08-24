<?php

namespace App\Http\Controllers\Api\Request;

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

    public function getRequestAttendance(Request $request) {

        try {
            $userAttendanceRequest = UserAttendanceRequest::where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->with("approvalLine")->get();
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
