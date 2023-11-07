<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AuthenticationError;
use App\Exceptions\InvariantError;
use App\Http\Controllers\Controller;
use App\Models\Leave\UserLeaveHistory;
use App\Models\Leave\UserLeaveQuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Utils\ErrorHandler;
use Carbon\Carbon;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|min:8',
            ]);

            if (!$request->user()->is_new) {
                throw new InvariantError("Password sudah pernah diubah");
            }

            $request->user()->update([
                'password' => bcrypt($request->password),
                'is_new' => false,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Password berhasil diubah"
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
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
                    "is_new" => $request->user()->is_new,
                    "token" => $token
                ]
            ]);

        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

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
            $data = ErrorHandler::handle($th);

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
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserEmploymentData(Request $request){
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->userEmployment->load(['user.team', 'user.roles', 'user.division', 'user.department', 'approvalLine', 'subBranch', 'workingSchedule','employmentStatus','workingSchedule.workingShift']),
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserSalary(Request $request) {
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->userSalary->load(['paymentSchedule','prorateSetting']),
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserBank(Request $request) {
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->userBank,
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserTax(Request $request) {
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->userTax->load(['taxStatus']),
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserBpjs(Request $request) {
        try {
            return response()->json([
                "status" => "success",
                "data" => $request->user()->userBpjs,
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserAvailableLeaveQuotas(Request $request)
    {
        try {
            $userQuotas = UserLeaveQuota::where('user_id', $request->user()->id)
                ->where('expired_date', '>=', Carbon::now())->sum("quotas");

            return response()->json([
                "status" => "success",
                "data" => $userQuotas
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserLeaveQuotaDetail(Request $request)
    {
        try {
            $query = UserLeaveQuota::where('user_id', $request->user()->id)->orderBy('expired_date', 'desc')->get();

            return response()->json([
                "status" => "success",
                "data" => $query
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserLeaveQuotaHistory(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $query = UserLeaveHistory::where('user_id', $request->user()->id)->orderBy('created_at', 'desc')
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $query->currentPage(),
                    "itemCount" => $itemCount,
                    "history" => $query->items(),
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
