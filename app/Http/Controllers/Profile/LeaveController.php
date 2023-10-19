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
        $this->constants = new Constants();
    }
    public function getUserLeaveQuotas()
    {
        try {
            $userQuotas = UserLeaveQuota::where('user_id', Auth::user()->id)->where('expired_date', '>=', Carbon::now())->sum("quotas");

            return response()->json([
                "status" => "success",
                "data" => $userQuotas
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

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

    public function getTableQuotaLeaveHistory(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            // $user = Auth::user();

            // if (!($user->id == $request->user_id|| $user->hasPermissionTo('HC:view-attendance'))) {
            //     abort(403);
            // }

            $query = UserLeaveQuota::where('user_id', $request->user_id)->orderBy('expired_date', 'desc');

            return DataTables::of($query)
                ->addColumn('expired_date', function ($query) {
                    $date = explode(" ", explode("T", $query->expired_date)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('received_at', function ($query) {
                    $date = explode(" ", explode("T", $query->received_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->make(true);
        }
    }
}
