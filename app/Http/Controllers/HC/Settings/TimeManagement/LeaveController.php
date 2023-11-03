<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Http\Controllers\Controller;
use App\Models\Leave\LeaveQuota;
use App\Models\User;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{
    public function index()
    {
        $leaveSetting = LeaveQuota::first();

        return view('hc.cmt-settings.time-management.leave.index', compact([
            'leaveSetting'
        ]));
    }

    public function detail()
    {
        return view('hc.cmt-settings.time-management.leave.user.detail.index');
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
}
