<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance\LeaveRequestCategory;
use App\Models\Employee\WorkingShift;
use App\Utils\ErrorHandler;
use Yajra\DataTables\Facades\DataTables;

class TimeOffController extends Controller
{
    protected $errorHandler;
    protected $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function index() {
        return view("hc.cmt-settings.time-management.time-off");
    }

    public function getTableTimeOff(Request $request) {
        if (request()->ajax()) {
            $query = LeaveRequestCategory::orderBy('created_at', 'desc');

            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                return "-";
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

    public function createUpdateTimeOff(Request $request) {
        try {
            $request->validate([
                "name" => "required",
                "code" => "required"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function deleteTimeOff(Request $request) {
        try {
            //code...
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
