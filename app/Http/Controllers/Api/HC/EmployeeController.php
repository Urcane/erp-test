<?php

namespace App\Http\Controllers\Api\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;
use App\Models\User;

class EmployeeController extends Controller
{
    function getAllEmployee(Request $request) {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $employee = User::paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $employee->currentPage(),
                    "itemCount" => $itemCount,
                    "employee" => $employee->items(),
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
