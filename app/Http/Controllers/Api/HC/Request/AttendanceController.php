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

            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $userAttendanceRequest = UserAttendanceRequest::where('approval_line', $request->user()->id)->orderBy('created_at', 'desc')->with("user")->with("approvalLine")->paginate($itemCount, ['*'], 'page', $page);
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
}
