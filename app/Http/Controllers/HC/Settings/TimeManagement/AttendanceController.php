<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use App\Models\Employee\WorkingSchedule;
use App\Models\Employee\WorkingShift;
use App\Models\Employee\WorkingScheduleShift;

class AttendanceController extends Controller
{
    public function index() {
        $dataWorkingShift = WorkingShift::all();

        return view("hc.cmt-settings.time-management.attendance", compact(["dataWorkingShift"]));
    }

    public function getTableSchedule(Request $request) {
        if (request()->ajax()) {
            $query = WorkingSchedule::all();

            // dd($query);
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $shift = $action->workingShifts;

                $edit = '
                <li>
                    <div class="btn-edit" onclick=\'fillInput(
                            "'. $action->id .'",
                            "'. $action->name .'",
                            "'. $action->effective_date .'",
                            "'. $action->override_national_holiday .'",
                            "'. $action->override_company_holiday .'",
                            "'. $action->override_special_holiday .'",
                            "'. $action->flexible .'",
                            "'. $action->late_check_in .'",
                            "'. $action->late_check_out .'",
                            '. $shift .',
                        )\'>
                        <a href="#modal_create_schedule" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                ';


                $delete = '<li><button onclick="deleteJobLevel(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="job_level_ids" type="checkbox" value="'.$check->id.'"></div>';
            })
            ->addColumn('shift', function($data) {
                return $data->workingShifts->count();
            })
            ->addColumn('assigned_to', function($data) {
                $count = 0;
                foreach ($data->workingScheduleShifts as $scheduleShift) {
                    $count += $scheduleShift->userEmployments->count();
                }
                return $count;
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getShift(Request $request) {
        $data = WorkingShift::whereId($request->id)->first();

        return response()->json($data, 200);
    }

    public function createUpdate(Request $request) {

        $request->validate([
            "name" => "required",
            "effective_date" => "required",
            "shift_id" => "required",
            "late_check_in" => "required",
            "late_check_out" => "required",
        ]);

        // DB::transaction(function () use ($request) {
            $workingSchedule = WorkingSchedule::updateOrCreate([
                "id" => $request->id,
            ], [
                'name' => $request->name,
                "effective_date" => $request->effective_date,
                "override_national_holiday" => $request->override_national_holiday,
                "override_company_holiday" => $request->override_company_holiday,
                "override_special_holiday" => $request->override_special_holiday,
                "flexible" => $request->flexible,
                "late_check_in" => $request->late_check_in,
                "late_check_out" => $request->late_check_out,
            ]);

            foreach ($workingSchedule->workingScheduleShifts as $data) {
                $data->delete();
            }

            foreach ($request->shift_id as $shift) {
                WorkingScheduleShift::create([
                    'working_schedule_id' => $workingSchedule->id,
                    'working_shift_id' => $shift["shift_id"],
                ]);
            }

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        // });
    }

    public function delete(Request $request) {

        WorkingSchedule::whereId($request->id)->delete();

        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil dihapus",
        ], 200);
    }
}
