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

    public function show(string $id)
    {
        $user = User::has('userEmployment')->has('userAttendances')->whereId($id)->first();
        $attendanceCode = $this->constants->attendance_code_view;

        if (!$user) {
            abort(404);
        }

        return view('hc.cmt-attendance.detail', compact(['user', 'attendanceCode']));
    }

    public function getAttendanceSummaries(Request $request)
    {
        try {
            if ($request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                return response()->json([
                    "onTimeCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereNotNull('check_out')
                        ->where(function($q) {
                            $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                            ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                        })
                        ->count(),

                    "lateCheckInCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                        ->count(),

                    "earlyCheckOutCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_out')
                        ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))')
                        ->count(),

                    "absent" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) {
                            $query->whereNull('check_in')
                                ->orWhereNull('check_out');
                        })
                        ->count(),

                    "noCheckInCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) {
                            $query->whereNull('check_in');
                        })
                        ->count(),

                    "noCheckOutCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) {
                            $query->WhereNull('check_out');
                        })
                        ->count(),

                    "dayOffCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where(function($query) {
                            $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                            ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                        })
                        ->count(),

                    "timeOffCount" => UserAttendance::whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[1])
                        ->count(),
                ]);
            }

            return response()->json([
                "onTimeCount" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereNotNull('check_in')
                    ->whereNotNull('check_out')
                    ->where(function($q) {
                        $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                        ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                    })
                    ->count(),

                "lateCheckInCount" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereNotNull('check_in')
                    ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                    ->count(),

                "earlyCheckOutCount" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereNotNull('check_out')
                    ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))')
                    ->count(),

                "absent" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) {
                        $query->whereNull('check_in')
                            ->orWhereNull('check_out');
                    })
                    ->count(),

                "noCheckInCount" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) {
                        $query->whereNull('check_in');
                    })
                    ->count(),

                "noCheckOutCount" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) {
                        $query->WhereNull('check_out');
                    })
                    ->count(),

                "dayOffCount" => UserAttendance::whereDate('date', '<', now())
                    ->where(function($query) {
                        $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                        ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                    })
                    ->count(),

                "timeOffCount" => UserAttendance::whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[1])
                    ->count(),
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getAttendanceSummariesById(Request $request)
    {
        try {
            $userId = $request->userId;

            if ($request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                return response()->json([
                    "onTimeCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereNotNull('check_out')
                        ->where(function($q) {
                            $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                            ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                        })
                        ->count(),

                    "lateCheckInCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                        ->count(),

                    "earlyCheckOutCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_out')
                        ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))')
                        ->count(),

                    "absent" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) {
                            $query->whereNull('check_in')
                                ->orWhereNull('check_out');
                        })
                        ->count(),

                    "noCheckInCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) {
                            $query->whereNull('check_in');
                        })
                        ->count(),

                    "noCheckOutCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) {
                            $query->WhereNull('check_out');
                        })
                        ->count(),

                    "dayOffCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where(function($query) {
                            $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                            ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                        })
                        ->count(),

                    "timeOffCount" => UserAttendance::where('user_id', $userId)
                        ->whereDate('date', '<', now())->whereBetween('date', $range_date)
                        ->where('attendance_code', '=', $this->constants->attendance_code[1])
                        ->count(),
                ]);
            }

            return response()->json([
                "onTimeCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereNotNull('check_in')
                    ->whereNotNull('check_out')
                    ->where(function($q) {
                        $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                        ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                    })
                    ->count(),

                "lateCheckInCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereNotNull('check_in')
                    ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                    ->count(),

                "earlyCheckOutCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereNotNull('check_out')
                    ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))')
                    ->count(),

                "absent" => UserAttendance::where('user_id', $userId)
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->whereDate('date', '<', now())
                    ->where(function ($query) {
                        $query->whereNull('check_in')
                            ->orWhereNull('check_out');
                    })
                    ->count(),

                "noCheckInCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) {
                        $query->whereNull('check_in');
                    })
                    ->count(),

                "noCheckOutCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) {
                        $query->WhereNull('check_out');
                    })
                    ->count(),

                "dayOffCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where(function($query) {
                        $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                        ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                    })
                    ->count(),

                "timeOffCount" => UserAttendance::where('user_id', $userId)
                    ->whereDate('date', '<', now())
                    ->where('attendance_code', '=', $this->constants->attendance_code[1])
                    ->count(),
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableAttendance(Request $request)
    {
        if (request()->ajax()) {
            $userAttendances = UserAttendance::has('user.userEmployment')->with('user.userEmployment');

            if ($request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function ($item) {
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
                    return $userAttendances->shift_name;
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

    public function getTableAttendanceDetail(Request $request)
    {
        if (request()->ajax()) {
            $userAttendances = UserAttendance::where('user_id', $request->user_id);

            if ($range_date = $request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function ($item) {
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
