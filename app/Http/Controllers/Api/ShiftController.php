<?php

namespace App\Http\Controllers\Api;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee\WorkingShift;
use App\Utils\ErrorHandler;

class ShiftController extends Controller
{

    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }
    public function getAllWorkingShift() {
        try {
            return response()->json([
                "status" => "success",
                "data" => WorkingShift::all(),
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
