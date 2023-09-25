<?php

namespace App\Http\Controllers\Profile;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Leave\UserLeaveHistory;
use App\Models\Leave\UserLeaveQuota;
use App\Utils\ErrorHandler;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class LeaveController extends Controller
{
    protected $errorHandler;
    protected $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function getUserLeaveQuotas()
    {
        try {
            $userQuotas = UserLeaveQuota::where('user_id', Auth::user()->id)->where('expired_date', '>=', Carbon::now())->get();

            return response()->json([
                "status" => "success",
                "data" => $userQuotas
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableLeaveHistory(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            // $user = Auth::user();

            // if (!($user->id == $request->user_id|| $user->hasPermissionTo('HC:view-attendance'))) {
            //     abort(403);
            // }

            $query = UserLeaveHistory::where('user_id', $request->user_id)->orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
