<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AuthenticationError;
use App\Exceptions\InvariantError;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Utils\ErrorHandler;

class UserController extends Controller
{
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                throw new InvariantError($validator->errors());
            }

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                throw new AuthenticationError("Email atau Password salah");
            }

            $token = $request->user()->createToken("API_TOKEN")->plainTextToken;

            return response()->json([
                "status" => "success",
                "data" => [
                    "token" => $token
                ]
            ]);

        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserPersonalData(Request $request){
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->load('userPersonalData'),
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserProfile(Request $request)
    {
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->load('userEmployment')
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserEmploymentData(Request $request){
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->userEmployment->load(['user.team', 'user.roles', 'user.division', 'user.department', 'approvalLine', 'subBranch', 'workingScheduleShift','employmentStatus','workingScheduleShift.workingSchedule','workingScheduleShift.workingShift']),
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
