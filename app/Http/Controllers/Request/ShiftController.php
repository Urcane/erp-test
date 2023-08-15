<?php

namespace App\Http\Controllers\Request;

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
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Attendance\UserAttendance;
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

    public function makeShift(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "working_shift_id" => "required",
                "notes" => "nullable|string"
            ]);

            UserShiftRequest::create([
                "user_id" => Auth::user()->id,
                "approval_line" => Auth::user()->approve_line,
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
