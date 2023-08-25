<?php

namespace App\Http\Controllers\Api\Request;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;
use App\Models\Attendance\UserShiftRequest;

class ShiftController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function getRequestShift(Request $request) {

        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $userShiftRequest = UserShiftRequest::where('user_id', $request->user()->id)
                ->orderBy('date', 'desc')
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
}
