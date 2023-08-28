<?php

namespace App\Http\Controllers\Api\Request;

use App\Constants;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;
use App\Models\Attendance\UserShiftRequest;
use App\Models\Employee\UserEmployment;

class ShiftController extends Controller
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

    public function getRequestById(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required'
            ]);

            $userShiftRequest = UserShiftRequest::where('user_id', $request->user()->id)
                ->whereId($request->id)
                ->with(['workingShift', 'approvalLine'])
                ->first();

            if (!$userShiftRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            return response()->json([
                "status" => "success",
                "data" => $userShiftRequest
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
                "working_shift_id" => "required",
                "notes" => "nullable|string"
            ]);

            $userShiftId = UserEmployment::where('user_id', $request->user()->id)->first()->workingScheduleShift->workingShift->id;

            if ($userShiftId == $request->working_shift_id) {
                throw new InvariantError("Tidak dapat melakukan request shift terhadap shift yang sama");
            }

            UserShiftRequest::create([
                "user_id" => $request->user()->id,
                "working_shift_id" => $request->working_shift_id,
                "date" => $request->date,
                "notes" => $request->notes,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan request shift"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
