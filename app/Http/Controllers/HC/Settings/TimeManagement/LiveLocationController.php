<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Http\Controllers\Controller;
use App\Models\Employee\Branch;
use App\Models\Employee\BranchLocation;
use App\Models\Employee\SubBranch;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LiveLocationController extends Controller
{
    function index()
    {
        return view('hc.cmt-settings.time-management.live-location.live-location');
    }

    function getTable()
    {
        if (request()->ajax()) {
            $query = SubBranch::query();

            return DataTables::of($query)
                ->addColumn('branch', function ($data) {
                    return $data->name;
                })
                ->addColumn('location', function ($data) {
                    return $data->branchLocations->count() . " Location";
                })
                ->addColumn('action', function ($data) {
                    return '
                    <a href="' . route('hc.setting.live-location.detailBranchLocation', ['branch' => $data->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-gear"></i> Assign Location</a>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    function detailBranchLocation(SubBranch $branch)
    {
        $branch = $branch;

        return view('hc.cmt-settings.time-management.live-location.detail-branch-locaiton', compact(['branch']));
    }

    public function getTableLocation($branchId) {
        if (request()->ajax()) {
            $branchLocation = BranchLocation::where('sub_branch_id', $branchId);

            return DataTables::of($branchLocation)
                ->addColumn('action', function ($data) {
                    return view('hc.cmt-settings.time-management.live-location.menu', compact([
                        'data'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function createUpdate( $branchId, Request $request) {
        try {
            $request->validate([
                "name" => "required",
                "latitude" => "required",
                "longitude" => "required",
                "radius" => "required",
            ]);

            BranchLocation::updateOrCreate([
                "id" => $request->id,
            ], [
                "name" => $request->name,
                "sub_branch_id" => $branchId,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "radius" => $request->radius,
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

}
