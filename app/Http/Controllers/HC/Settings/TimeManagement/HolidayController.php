<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Models\Attendance\GlobalDayOff;
use App\Utils\ErrorHandler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HolidayController extends TimeManagementController
{
    public function index() {
        return view("hc.cmt-settings.time-management.holiday");
    }

    public function getTable(Request $request) {
        if (request()->ajax()) {
            $query = new GlobalDayOff;

            if ($request->range_date) {
                $range_date = collect(explode('-', $request->range_date))->map(function ($item, $key) {
                    $date = Carbon::parse($item);
                    if ($key === 0) {
                        return $date->startOfDay()->toDateTimeString();
                    } else {
                        return $date->endOfDay()->toDateTimeString();
                    }
                })->toArray();

                $query = $query->whereBetween('start_date', $range_date)->orderBy('start_date', 'asc');
            } else {
                $query = $query->orderBy('start_date', 'asc');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    return view("hc.cmt-settings.time-management.menu-holiday", compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function createUpdate(Request $request) {
        try {
            $request->validate([
                "name" => 'required',
                "start_date" => 'required',
                "end_date" => 'required'
            ]);

            GlobalDayOff::create([
                "name" => $request->name,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan Hari Libur"
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function destroy(Request $request) {

    }

}
