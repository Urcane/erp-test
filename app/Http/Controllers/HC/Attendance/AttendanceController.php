<?php

namespace App\Http\Controllers\HC\Attendance;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;

use App\Constants;

use App\Models\User;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;

class AttendanceController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function index()
    {
        $attendanceCode = $this->constants->attendance_code_view;

        return view('hc.cmt-attendance.index', compact(['attendanceCode']));
    }

    public function getTableAttendance(Request $request)
    {
        if (request()->ajax()) {
            $userAttendances = UserAttendance::has('user.userEmployment');

            if ($range_date = $request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date)->orderBy('date', 'desc');
            } else {
                $userAttendances = $userAttendances->orderBy('date', 'desc');
            }

            return DataTables::of($userAttendances)
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="emergency_contact_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addColumn('name', function ($userAttendances) {
                    return $userAttendances->user->name;
                })
                ->addColumn('nip', function ($userAttendances) {
                    return $userAttendances->user->userEmployment->employee_id;
                })
                ->addColumn('date', function ($userAttendances) {
                    return $userAttendances->date;
                })
                ->addColumn('shift', function ($userAttendances) {
                    return $userAttendances->user->userEmployment->workingScheduleShift->workingShift->name;
                })
                ->addColumn('schedule_in', function ($userAttendances) {
                    return $userAttendances->working_start;
                })
                ->addColumn('schedule_out', function ($userAttendances) {
                    return $userAttendances->working_end;
                })
                ->addColumn('clock_in', function ($userAttendances) {
                    $checkIn = $userAttendances->check_in;

                    if ($checkIn) {
                        return date('H:i', strtotime($checkIn));
                    }
                    return "-";
                })
                ->addColumn('clock_out', function ($userAttendances) {
                    $checkOut = $userAttendances->check_out;

                    if ($checkOut) {
                        return date('H:i', strtotime($checkOut));
                    }
                    return "-";
                })
                ->addColumn('overtime', function ($userAttendances) {
                    return $userAttendances->overtime ?? "-";
                })
                ->addColumn('attendance_code', function ($userAttendances) {
                    return $this->constants->attendanceCodeTranslator($userAttendances->attendance_code) ?? "-";
                })
                ->addColumn('time_off_code', function ($userAttendances) {
                    return $userAttendances->day_off_code ?? "-";
                })
                ->addColumn('action', function ($userAttendances) {
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                        <li><a href="' . route('hc.att.detail', ['id' => $userAttendances->user->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a></li>
                        <li><a href="' . route('hc.emp.profile', ['id' => $userAttendances->user->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-pencil me-3"></i>Edit</a></li>
                        <li><a href="' . route('hc.emp.profile', ['id' => $userAttendances->user->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Hapus</a></li>
                    </ul>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function show(string $id)
    {
        $user = User::has('userEmployment')->has('userAttendances')->whereId($id)->first();
        $attendanceCode = $this->constants->attendance_code_view;

        if (!$user) {
            abort(404);
        }

        return view('hc.cmt-attendance.detail', compact(['user', 'attendanceCode']));
    }

    public function getTableAttendanceDetail(Request $request)
    {
        if (request()->ajax()) {
            $userAttendances = UserAttendance::where('user_id', $request->user_id);

            if ($range_date = $request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date)->orderBy('date', 'desc');
            } else {
                $userAttendances = $userAttendances->orderBy('date', 'desc');
            }

            return DataTables::of($userAttendances)
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="emergency_contact_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addColumn('date', function ($userAttendances) {
                    return $userAttendances->date;
                })
                ->addColumn('shift', function ($userAttendances) {
                    return $userAttendances->user->userEmployment->workingScheduleShift->workingShift->name;
                })
                ->addColumn('schedule_in', function ($userAttendances) {
                    return $userAttendances->user->userEmployment->workingScheduleShift->workingShift->working_start;
                })
                ->addColumn('schedule_out', function ($userAttendances) {
                    return $userAttendances->user->userEmployment->workingScheduleShift->workingShift->working_end;
                })
                ->addColumn('clock_in', function ($userAttendances) {
                    $checkIn = $userAttendances->check_in;

                    if ($checkIn) {
                        return date('H:i', strtotime($checkIn));
                    }
                    return "-";
                })
                ->addColumn('clock_out', function ($userAttendances) {
                    $checkOut = $userAttendances->check_out;

                    if ($checkOut) {
                        return date('H:i', strtotime($checkOut));
                    }
                    return "-";
                })
                ->addColumn('overtime', function ($userAttendances) {
                    return $userAttendances->overtime ?? "-";
                })
                ->addColumn('attendance_code', function ($userAttendances) {
                    return $this->constants->attendanceCodeTranslator($userAttendances->attendance_code) ?? "-";
                })
                ->addColumn('time_off_code', function ($userAttendances) {
                    return $userAttendances->day_off_code ?? "-";
                })
                ->addColumn('action', function ($userAttendances) {
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                        <li><a href="' . route('hc.emp.profile', ['id' => $userAttendances->user->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a></li>
                        <li><a href="' . route('hc.emp.profile', ['id' => $userAttendances->user->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-pencil me-3"></i>Edit</a></li>
                        <li><a href="' . route('hc.emp.profile', ['id' => $userAttendances->user->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Hapus</a></li>
                    </ul>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }


}
