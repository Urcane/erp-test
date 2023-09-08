<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Constants;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use App\Utils\ErrorHandler;

use App\Models\Employee\WorkingSchedule;
use App\Models\Employee\WorkingShift;
use App\Models\Employee\WorkingScheduleShift;

class AttendanceController extends Controller
{
    protected $errorHandler;
    protected $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function index() {
        $dataWorkingShift = WorkingShift::all();

        return view("hc.cmt-settings.time-management.attendance", compact(["dataWorkingShift"]));
    }

    public function getTableSchedule(Request $request) {
        if (request()->ajax()) {
            $query = WorkingSchedule::query();

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

    public function createUpdateSchedule(Request $request) {

        $request->validate([
            "name" => "required",
            "effective_date" => "required",
            "shift_id" => "required",
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

    public function deleteSchedule(Request $request) {
        try {
            $workingSchedule = WorkingSchedule::whereId($request->id);

            if (!$workingSchedule) {
                throw new NotFoundError("working schedule tidak ditemukan");
            }

            $workingSchedule->delete();

            return response()->json([
                'status' => "success",
                'message' => "Working schedule berhasil dihapus",
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }

    }

    public function getTableShift(Request $request) {
        if (request()->ajax()) {
            $query = WorkingShift::query();

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


                $delete = '<li><button onclick="deleteShift(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('working_hour', function($data) {

                return substr($data->working_start, 0, -3). "-" .substr($data->working_end, 0, -3);
            })
            ->addColumn('break_hour', function($data) {

                return substr($data->break_start, 0, -3). "-" .substr($data->break_end, 0, -3);
            })

            ->addColumn('show_in_request', function($data) {
                $check = $data->show_in_request == "1" ? "checked" : "";

                return '<div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="show_id_request_table_'.$data->id.'" '. $check .' onclick="updateShowInRequest(\''.$data->id.'\')">
                    <label class="form-check-label" for="show_id_request_table"></label>
                </div>';
            })
            ->addColumn('assigned_to', function($data) {
                $count = 0;
                foreach ($data->workingScheduleShifts as $scheduleShift) {
                    $count += $scheduleShift->userEmployments->count();
                }
                return $count;
            })
            ->addIndexColumn()
            ->rawColumns(['action','working_hour','break_hour','show_in_request'])
            ->make(true);
        }
    }

    public function createUpdateShift(Request $request) {

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

    function udpateShowInRequest(Request $request, ErrorHandler $errorHandler) {
        try {
            $workingShift = WorkingShift::whereId($request->id)->first();
            $workingShift->update([
                'show_in_request' => $workingShift->show_in_request == "1" ? "0" : "1",
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {
            $data = $errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function deleteShift(Request $request) {

        WorkingShift::whereId($request->id)->delete();

        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil dihapus",
        ], 200);
    }
}
