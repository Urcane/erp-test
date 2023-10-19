<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Constants;
use App\Exceptions\InvariantError;
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
        $this->constants = new Constants();
    }
    public function index() {
        $dataWorkingShift = WorkingShift::all();
        $dataDays = $this->constants->day;

        return view("hc.cmt-settings.time-management.attendance", compact(["dataWorkingShift", "dataDays"]));
    }

    public function getTableSchedule(Request $request) {
        if (request()->ajax()) {
            $query = WorkingSchedule::query();

            // dd($query);
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $workingScheduleShifts = $action->workingScheduleShifts->load("workingShift");
                // dd($shift);

                $edit = '
                <li>
                    <div class="btn-edit" onclick=\'fillInputSchedule(
                            "'. $action->id .'",
                            "'. $action->name .'",
                            "'. $action->effective_date .'",
                            "'. $action->override_national_holiday .'",
                            "'. $action->override_company_holiday .'",
                            "'. $action->override_special_holiday .'",
                            '. $workingScheduleShifts .',
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
                return $data->userEmployments->count() . " User";
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

        DB::transaction(function () use ($request) {
            $workingSchedule = WorkingSchedule::updateOrCreate([
                "id" => $request->id,
            ], [
                'name' => $request->name,
                "effective_date" => $request->effective_date,
                "override_national_holiday" => $request->override_national_holiday,
                "override_company_holiday" => $request->override_company_holiday,
                "override_special_holiday" => $request->override_special_holiday,
            ]);


            $count = WorkingScheduleShift::orderBy('id','desc')->first()->id;
            $next = $count + 2;

            if ($request->shift_id && $request->id == null) {

                foreach ($request->shift_id as $shift) {
                    WorkingScheduleShift::create([
                        'working_schedule_id' => $workingSchedule->id,
                        'working_shift_id' => $shift["shift_id"],
                        "next" => $next,
                    ]);

                    $next++;
                    if($next > $count + count($request->shift_id)) $next = $count+1;
                }
            }

            $workingScheduleShifts = $workingSchedule->workingScheduleShifts;
            $workingScheduleShiftCount = $workingScheduleShifts->count();
            if (count($request->shift_id) > $workingScheduleShiftCount) {
                $workingScheduleShifts->last()->update([
                    "next" => $next - 1
                ]);

                $newShift = array_slice($request->shift_id, $workingScheduleShiftCount);
                foreach ($newShift as $shift) {
                    if($next > $count + count($newShift)) $next = $workingScheduleShifts->first()->id;

                    WorkingScheduleShift::create([
                        'working_schedule_id' => $workingSchedule->id,
                        'working_shift_id' => $shift["shift_id"],
                        "next" => $next,
                    ]);

                    $next++;
                }
            }

            return response()->json([
                'status' => "success",
                'message' => "Data berhasil disimpan",
            ], 200);
        });
    }

    public function updateShiftFromSchedule(Request $request) {
        try {
            $workingScheduleShift = WorkingScheduleShift::where("id", $request->id)->first();

            if (!$workingScheduleShift) {
                throw new NotFoundError("Shift tidak ditemukan");
            }

            if ($workingScheduleShift->userCurrentShifts->count() > 0) {
                throw new InvariantError("Masih ada user yang menggunakan shift");
            }

            $workingScheduleShift->update([
                'working_shift_id' => $request->working_shift_id,
            ]);

            return response()->json([
                'status' => "success",
                'shift' => $workingScheduleShift->workingShift,
                'message' => "Working schedule berhasil diperharui",
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function deleteShiftFromSchedule(Request $request) {
        try {
            $workingScheduleShift = WorkingScheduleShift::where("working_shift_id", $request->shift_id)->where("working_schedule_id", $request->working_schedule_id)->first();

            if (!$workingScheduleShift) {
                throw new NotFoundError("working schedule tidak ditemukan");
            }

            if ($workingScheduleShift->userCurrentShifts->count() > 0) {
                throw new InvariantError("Masih ada user yang menggunakan shift");
            }

            $workingScheduleShift->delete();

            return response()->json([
                'status' => "success",
                'message' => "Working schedule berhasil dihapus",
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
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
            $data = ErrorHandler::handle($th);

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
                return $data->workingScheduleShifts->count() . " Schedule";
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
        try {
            $workingShift = WorkingShift::whereId($request->id)->first();

            if (!$workingShift) {
                throw new NotFoundError("working schedule tidak ditemukan");
            }

            if ($workingShift->workingScheduleShifts->count() > 0) {
                throw new InvariantError("Masih ada schedule yang menggunakan shift");
            }
            $workingShift->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
