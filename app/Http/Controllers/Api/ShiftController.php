<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee\WorkingShift;

class ShiftController extends Controller
{
    public function getAllWorkingShift() {
        try {
            return response()->json([
                "status" => "success",
                "data" => WorkingShift::all(),
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
