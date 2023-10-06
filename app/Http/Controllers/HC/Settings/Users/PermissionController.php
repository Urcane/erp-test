<?php

namespace App\Http\Controllers\HC\Settings\Users;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\User;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use App\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
    }

    function index()
    {
        return view('hc.cmt-settings.users.permission.permission');
    }
    function getTableSchedule()
    {
        if (request()->ajax()) {
            $query = User::query();

            // dd($query);
            return DataTables::of($query)
                ->addColumn('branch', function ($data) {
                    if ($data->userEmployment == null) {
                        return "-";
                    }
                    return $data->userEmployment->subBranch->name;
                })
                ->addColumn('department', function ($data) {
                    return $data->department->department_name;
                })
                ->addColumn('job_position', function ($data) {
                    return $data->division->divisi_name;
                })
                ->addColumn('action', function ($data) {
                    return '
                    <a href="' . route('hc.setting.permission.detailUser', ['user' => $data->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-gear"></i> Set Permission</a>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    function detailUserPermission(User $user)
    {
        $userPermission = $user->permissions->pluck('id');
        $allFeature = Feature::withCount('permissions')->orderByDesc('permissions_count')->get();

        return view('hc.cmt-settings.users.permission.detail-user-permission', compact(['user', 'userPermission', 'allFeature']));
    }

    function assignPermission(User $user, Request $request)
    {
        try {
            $user->revokePermissionTo(Permission::all());
            $user->givePermissionTo($request->permissions);
            return response()->json([
                'status' => "success",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
