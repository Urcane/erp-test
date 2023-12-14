<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Constants;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use App\Models\Leave\LeaveQuota;
use App\Models\Leave\UserLeaveHistory;
use App\Models\Leave\UserLeaveQuota;
use App\Models\User;
use App\Utils\ErrorHandler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{
    protected $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function index()
    {
        $leaveSetting = LeaveQuota::first();

        return view('hc.cmt-settings.time-management.leave.index', compact([
            'leaveSetting'
        ]));
    }

    public function detail(string $id)
    {
        $user = User::find($id);
        $constants = $this->constants;

        return view('hc.cmt-settings.time-management.leave.user.detail.index', compact([
            'user', 'constants'
        ]));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                "quotas" => "required|integer|max:100|min:0",
                "min_works" => "required|integer|max:100|min:0",
                "expired" => "required|integer|max:24|min:6",
            ]);

            $leaveSetting = LeaveQuota::first();

            if ($leaveSetting) {
                $leaveSetting->update([
                    "quotas" => $request->quotas,
                    "min_works" => $request->min_works,
                    "expired" => $request->expired,
                ]);
            } else {
                LeaveQuota::create([
                    "quotas" => $request->quotas,
                    "min_works" => $request->min_works,
                    "expired" => $request->expired,
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil Update Setting Cuti"
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function editUserQuota(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "name" => "required",
                "quota_change" => "required|integer",
                "expired_date" => "nullable|date",
                "received_at" => "nullable|date",
            ]);

            $userQuota = UserLeaveQuota::whereId($request->id)->first();

            if (!$userQuota) {
                throw new NotFoundError("Kuota tidak ditemukan");
            }

            $userQuota->update([
                "quotas" => $userQuota->quotas + $request->quota_change,
                "expired_date" => $request->expired_date,
                "received_at" => $request->received_at,
            ]);

            if ($request->quota_change != 0) {
                UserLeaveHistory::create([
                    "type" => $this->constants->leave_quota_history_type[$request->quota_change > 0 ? 1 : 0],
                    "user_id" => $userQuota->user_id,
                    "name" => $request->name,
                    "approval_name" => Auth::user()->name,
                    "date" => Carbon::now()->toDateString(),
                    "quota_change" => $request->quota_change > 0 ? $request->quota_change : $request->quota_change * -1,
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil Update Kuota Cuti"
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getUserLeaveQuotas(Request $request)
    {
        try {
            $request->validate([
                "user_id" => "required",
            ]);

            $userQuotas = UserLeaveQuota::where('user_id', $request->user_id)
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

    public function getTableLeaveQuotas(Request $request)
    {
        if (request()->ajax()) {
            $query = User::has('userEmployment')->with('userLeaveQuotas');

            $search = $request->search;
            if ($search) {
                $query = $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('userEmployment', function ($query) use ($search) {
                            $query->where('employee_id', 'LIKE', '%' . $search . '%');
                        });
                });
            }

            return DataTables::of($query)
                ->addColumn('employee_id', function ($query) {
                    return $query->userEmployment->employee_id;
                })
                ->addColumn('name', function ($query) {
                    return $query->name;
                })
                ->addColumn('email', function ($query) {
                    return $query->email;
                })
                ->addColumn('quotas', function ($query) {
                    return $query->userLeaveQuotas->sum('quotas') . " Hari";
                })
                ->addColumn('action', function ($query) {
                    return view('hc.cmt-settings.time-management.leave.user.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getTableLeaveHistory(Request $request)
    {
        if (request()->ajax()) {
            $query = UserLeaveHistory::where('user_id', $request->user_id)->orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function getTableQuotaLeaveHistory(Request $request)
    {
        if (request()->ajax()) {
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
                ->addColumn('quotas', function ($query) {
                    return $query->quotas . " Hari";
                })
                ->addColumn('action', function ($query) {
                    return view('hc.cmt-settings.time-management.leave.user.detail.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
