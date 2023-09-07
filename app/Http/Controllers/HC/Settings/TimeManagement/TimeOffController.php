<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use Illuminate\Http\Request;
use App\Models\Attendance\LeaveRequestCategory;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TimeOffController extends TimeManagementController
{
    public function index()
    {
        return view("hc.cmt-settings.time-management.time-off");
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = LeaveRequestCategory::orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    return "-";
                })
                ->addColumn('effective_date', function ($query) {
                    $date = Carbon::createFromFormat('Y-m-d', $query->effective_date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('expired_date', function ($query) {
                    $expiredDate = $query->expired_date;

                    if (!$expiredDate) {
                        return "Permanent";
                    }

                    $date = Carbon::createFromFormat('Y-m-d', $expiredDate);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                // ->addColumn('assigned_to', function($data) {
                //     $count = $data->users->count();
                //     return $count;
                // })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function createUpdate(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "code" => "required",
                "effective_date" => "required",
                "expired_date" => "nullable"
            ]);

            LeaveRequestCategory::create([
                "name" => $request->name,
                "code" => $request->code,
                "effective_date" => $request->effective_date,
                "expired_date" => $request->expired_date
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambah kategori time off"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
