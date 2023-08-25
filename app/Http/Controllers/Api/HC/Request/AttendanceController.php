<?php

namespace App\Http\Controllers\Api\HC\Request;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance\UserAttendanceRequest;
use App\Utils\ErrorHandler;


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
            $userId = $request->user()->id;

            $userRequest = UserAttendanceRequest::where(function ($query) use ($userId) {
                $query->where(function ($query) use ($userId) {
                    $query->where('status', $this->constants->approve_status[0])
                        ->whereHas('user.userEmployment', function ($query) use ($userId) {
                            $query->where('approval_line', $userId);
                        });
                })->orWhere('approval_line', $userId);
            })->with(['user.division', 'user.department', 'user.userEmployment.subBranch'])
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $userRequest->currentPage(),
                    "itemCount" => $itemCount,
                    "userAttendanceRequest" => $userRequest->items(),
                ],
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
