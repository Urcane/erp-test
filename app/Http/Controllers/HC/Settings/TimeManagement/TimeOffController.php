<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance\LeaveRequestCategory;
use App\Models\Employee\WorkingShift;
use Yajra\DataTables\Facades\DataTables;

class TimeOffController extends Controller
{
    public function index() {
        return view("hc.cmt-settings.time-management.time-off");
    }

    public function getTableTimeOff(Request $request) {
        if (request()->ajax()) {
            $query = LeaveRequestCategory::all();

            // dd($query);
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $shift = $action->workingShifts;

                $edit = '
                <li>
                    <div class="btn-edit" onclick=\'fillInput(
                            "'. $action->id.'",
                            "'. $action->show_in_request.'",
                            "'. $action->name.'",
                            "'. $action->working_start.'",
                            "'. $action->working_end.'",
                            "'. $action->break_start.'",
                            "'. $action->break_end.'",
                            "'. $action->start_attend.'",
                            "'. $action->end_attend.'",
                            "'. $action->late_check_in.'",
                            "'. $action->late_check_out.'",
                            "'. $action->overtime_before.'",
                            "'. $action->overtime_after.'"
                        )\'>
                        <a href="#modal_create_shift" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                ';


                $delete = '<li><button onclick="deleteTimeOf(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('assigned_to', function($data) {
                $count = $data->users->count();
                return $count;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function createUpdateTimeOff(Request $request) {

        $request->validate([
            "name" => "required",
            "working_start" => "required",
            "working_end" => "required",
            "break_start" => "required",
            "break_end" => "required",
        ]);

        // DB::transaction(function () use ($request) {
            $workingShift = WorkingShift::updateOrCreate([
                "id" => $request->id,
            ], [
                'show_in_request' => $request->show_in_request ?? "0",
                'name' => $request->name,
                'working_start' => $request->working_start,
                'working_end' => $request->working_end,
                'break_start' => $request->break_start,
                'break_end' => $request->break_end,
                'start_attend' => $request->start_attend,
                'end_attend' => $request->end_attend,
                'late_check_in' => $request->late_check_in ?? "5" ,
                'late_check_out' => $request->late_check_out ?? "5" ,
                'overtime_before' => $request->overtime_before,
                'overtime_after' => $request->overtime_after,
            ]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        // });
    }

    public function deleteTimeOff(Request $request) {

        WorkingShift::whereId($request->id)->delete();

        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil dihapus",
        ], 200);
    }
}
