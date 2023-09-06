<?php

namespace App\Http\Controllers\HC\Attendance;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Utils\ErrorHandler;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Exports\Attendance\AllAttendance;
use App\Exports\Attendance\PersonalAttendance;
use App\Models\User;
use App\Models\Attendance\AttendanceChangeLog;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use App\Models\Division;
use App\Models\Department;

class AttendanceController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    private function _summariesQuery($query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8)
    {
        $now = now();

        return response()->json([
            "onTimeCount" => $query1->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->where(function ($query) use ($now) {
                    $query->where(function ($query) use ($now) {
                        $query->whereDate('date', '=', $now)
                            ->whereNotNull('check_in')
                            ->where(function ($query) {
                                $query->where(function ($query) {
                                    $query->whereNull('check_out')
                                        ->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                                })->orWhere(function ($query) {
                                    $query->whereNotNull('check_out')
                                        ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                });
                            });
                    })->orWhere(function($query) use ($now) {
                        $query->whereDate('date', '<', $now)
                            ->where('attendance_code', '=', $this->constants->attendance_code[0])
                            ->whereNotNull('check_in')
                            ->whereNotNull('check_out')
                            ->where(function($query) {
                                $query->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                                    ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                            });
                    });
            })->count(),

            "lateCheckInCount" => $query2->whereDate('date', '<=', $now)
                ->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereNotNull('check_in')
                ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                ->count(),

            "earlyCheckOutCount" => $query3->whereDate('date', '<=', $now)
                ->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereNotNull('check_out')
                ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))')
                ->count(),

            "absent" => $query4->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->where(function ($query) use ($now) {
                    $query->where(function ($query) use ($now) {
                        $query->whereDate('date', '<', $now)
                            ->where(function ($query) {
                                $query->whereNull('check_in')
                                ->orWhereNull('check_out');
                            });
                    })->orWhere(function ($query) use ($now) {
                        $query->whereDate('date', '=', $now)
                            ->whereNull('check_in')
                            ->whereRaw('TIME(?) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))', [$now]);
                    });
                })
                ->count(),

            "noCheckInCount" => $query5->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereNull('check_in')
                ->where(function ($query) use ($now) {
                    $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                        $query->whereDate('date', '=', $now)
                        ->whereRaw('TIME(?) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))', [$now]);
                    });
                })
                ->count(),

            "noCheckOutCount" => $query6->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereDate('date', '<', $now)
                ->whereNull('check_out')
                ->count(),

            "dayOffCount" => $query7->where(function($query) {
                    $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                    ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                })
                ->count(),

            "timeOffCount" => $query8->where('attendance_code', '=', $this->constants->attendance_code[1])
                ->count(),
        ]);
    }

    public function index()
    {
        $constants = $this->constants;
        $dataDivision = Division::all();
        $dataDepartment = Department::all();

        return view('hc.cmt-attendance.index', compact(['constants', 'dataDivision', 'dataDepartment']));
    }

    public function show(string $id)
    {
        /** @var App\Models\User $authUser */
        $authUser = Auth::user();

        if (!($authUser->id == $id || $authUser->hasPermissionTo('HC:view-attendance'))) {
            abort(403);
        }

        $user = User::has('userEmployment')->has('userAttendances')->whereId($id)->first();
        $constants = $this->constants;

        if (!$user) {
            abort(404);
        }

        return view('hc.cmt-attendance.detail', compact(['user', 'constants']));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "check_in" => "nullable",
                "check_out" => "nullable",
                "reason" => "nullable"
            ]);

            $checkIn = $request->check_in ? Carbon::parse($request->check_in) : null;
            $checkOut = $request->check_out ? Carbon::parse($request->check_out) : null;

            $userAttendance = UserAttendance::whereId($request->id)->first();

            AttendanceChangeLog::create([
                "user_id" => Auth::user()->id,
                "attendance_id" => $request->id,
                "date" => $userAttendance->date,
                "action" => "USER EDIT",
                "old_check_in" => $userAttendance->check_in,
                "old_check_out" => $userAttendance->check_out,
                "new_check_in" => $checkIn,
                "new_check_out" => $checkOut,
                "reason" => $request->reason
            ]);

            $userAttendance->update([
                "check_in" => $checkIn,
                "check_out" => $checkOut
            ]);

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Data Attendance berhasil diupdate"
            ], 200);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "reason" => "nullable"
            ]);

            $userAttendance = UserAttendance::whereId($request->id)->first();

            AttendanceChangeLog::create([
                "user_id" => Auth::user()->id,
                "attendance_id" => $request->id,
                "date" => $userAttendance->date,
                "action" => "USER DELETE",
                "old_check_in" => $userAttendance->check_in,
                "old_check_out" => $userAttendance->check_out,
                "new_check_in" => null,
                "new_check_out" => null,
                "reason" => $request->reason
            ]);

            $userAttendance->update([
                "check_in" => null,
                "check_out" => null
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menghapus attendance"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getAttendanceSummaries(Request $request)
    {
        try {
            $userAttendances = UserAttendance::has('user.userEmployment')->with('user.userEmployment');

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date);
            }

            $search = $request->filters['search'];
            if (!empty($search)) {
                $userAttendances = $userAttendances->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('user.userEmployment', function ($query) use ($search) {
                        $query->where('employee_id', 'LIKE', '%' . $search . '%');
                    })->orWhere('shift_name', 'LIKE', '%' . $search . '%');
                });
            }

            $filterDivisi = $request->filters['filterDivisi'];
            if (!empty($filterDivisi) && $filterDivisi !== '*') {
                $userAttendances = $userAttendances->whereHas('user', function ($query) use ($filterDivisi) {
                    $query->where('division_id', $filterDivisi);
                });
            }

            $filterDepartment = $request->filters['filterDepartment'];
            if (!empty($filterDepartment) && $filterDepartment !== '*') {
                $userAttendances = $userAttendances->whereHas('user', function ($query) use ($filterDepartment) {
                    $query->where('department_id', $filterDepartment);
                });
            }

            return $this->_summariesQuery(
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances
            );
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getAttendanceSummariesTable(Request $request)
    {
        if (request()->ajax()) {
            $userAttendances = UserAttendance::has('user.userEmployment')->with('user.userEmployment');

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date);
            }

            $search = $request->filters['search'];
            if (!empty($search)) {
                $userAttendances = $userAttendances->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('user.userEmployment', function ($query) use ($search) {
                        $query->where('employee_id', 'LIKE', '%' . $search . '%');
                    })->orWhere('shift_name', 'LIKE', '%' . $search . '%');
                });
            }

            $filterDivisi = $request->filters['filterDivisi'];
            if (!empty($filterDivisi) && $filterDivisi !== '*') {
                $userAttendances = $userAttendances->whereHas('user', function ($query) use ($filterDivisi) {
                    $query->where('division_id', $filterDivisi);
                });
            }

            $filterDepartment = $request->filters['filterDepartment'];
            if (!empty($filterDepartment) && $filterDepartment !== '*') {
                $userAttendances = $userAttendances->whereHas('user', function ($query) use ($filterDepartment) {
                    $query->where('department_id', $filterDepartment);
                });
            }

            $now = now();

            switch ($request->param) {
                case "on-time":
                    $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) use ($now) {
                            $query->where(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                    ->where(function ($query) {
                                        $query->where(function ($query) {
                                            $query->whereNotNull('check_in')
                                                ->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                                        })->orWhere(function ($query) {
                                            $query->whereNotNull('check_out')
                                                ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                        });
                                    });
                            })->orWhere(function($query) use ($now) {
                                $query->whereDate('date', '<', $now)
                                    ->where('attendance_code', '=', $this->constants->attendance_code[0])
                                    ->whereNotNull('check_in')
                                    ->whereNotNull('check_out')
                                    ->where(function($q) {
                                        $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                                            ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                    });
                            });
                        });
                    break;

                case "late-clock-in":
                    $userAttendances->whereDate('date', '<=', $now)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                    break;

                case "early-clock-out":
                    $userAttendances->whereDate('date', '<=', $now)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_out')
                        ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                    break;

                case "absent":
                    $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->where(function ($query) use ($now) {
                            $query->where(function ($query) use ($now) {
                                $query->whereDate('date', '<', $now)
                                    ->whereNull('check_in')
                                    ->orWhereNull('check_out');
                            })->orWhere(function ($query) use ($now) {
                                $query->where('date', '=', $now)
                                    ->where(function ($query) {
                                        $query->whereNull('check_out')
                                            ->orWhereNull('check_in');
                                    })
                                    ->whereRaw('TIME(?) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))', [$now]);
                            });
                        });
                    break;

                case "no-clock-in":
                    $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_in')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))', [$now]);
                            });
                        });
                    break;

                case "no-clock-out":
                    $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_out')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))', [$now]);
                            });
                        });
                    break;

                case "no-clock-out":
                    $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_out')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))', [$now]);
                            });
                        });
                    break;

                case "day-off":
                    $userAttendances->where(function($query) {
                        $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                        ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                    });
                    break;

                case "time-off":
                    $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[1]);
                    break;
            }

            return DataTables::of($userAttendances)
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
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function getAttendanceSummariesById(Request $request)
    {
        try {
            /** @var App\Models\User $user */
            $user = Auth::user();

            if (!($user->id == $request->userId || $user->hasPermissionTo('HC:view-attendance'))) {
                abort(403);
            }

            $userAttendances = UserAttendance::where('user_id', $request->userId)
                ->has('user.userEmployment')->with('user.userEmployment');

            if ($request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date);
            }

            return $this->_summariesQuery(
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances
            );
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableAttendance(Request $request)
    {
        if (request()->ajax()) {
            $userAttendances = UserAttendance::has('user.userEmployment')->with('user.userEmployment');

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date)->orderBy('date', 'desc');
            } else {
                $userAttendances = $userAttendances->orderBy('date', 'desc');
            }

            $search = $request->filters['search'];
            if (!empty($search)) {
                $userAttendances = $userAttendances->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('user.userEmployment', function ($query) use ($search) {
                        $query->where('employee_id', 'LIKE', '%' . $search . '%');
                    })->orWhere('shift_name', 'LIKE', '%' . $search . '%');
                });
            }

            $filterDivisi = $request->filters['filterDivisi'];
            if (!empty($filterDivisi) && $filterDivisi !== '*') {
                $userAttendances = $userAttendances->whereHas('user', function ($query) use ($filterDivisi) {
                    $query->where('division_id', $filterDivisi);
                });
            }

            $filterDepartment = $request->filters['filterDepartment'];
            if (!empty($filterDepartment) && $filterDepartment !== '*') {
                $userAttendances = $userAttendances->whereHas('user', function ($query) use ($filterDepartment) {
                    $query->where('department_id', $filterDepartment);
                });
            }

            $now = now();

            switch ($request->filters['filterStatus']) {
                case $this->constants->filter_status_attendance[0]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) use ($now) {
                        $query->where(function ($query) use ($now) {
                            $query->whereDate('date', '=', $now)
                                ->where(function ($query) {
                                    $query->where(function ($query) {
                                        $query->whereNotNull('check_in')
                                            ->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                                    })->orWhere(function ($query) {
                                        $query->whereNotNull('check_out')
                                            ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                    });
                                });
                        })->orWhere(function($query) use ($now) {
                            $query->whereDate('date', '<', $now)
                                ->where('attendance_code', '=', $this->constants->attendance_code[0])
                                ->whereNotNull('check_in')
                                ->whereNotNull('check_out')
                                ->where(function($q) {
                                    $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                                        ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                });
                        });
                });
                    break;
                case $this->constants->filter_status_attendance[1]:
                    $userAttendances = $userAttendances->whereDate('date', '<=', $now)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                    break;
                case $this->constants->filter_status_attendance[2]:
                    $userAttendances = $userAttendances->whereDate('date', '<=', $now)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_out')
                        ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                    break;
                case $this->constants->filter_status_attendance[3]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_in')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))', [$now]);
                            });
                        });
                    break;
                case $this->constants->filter_status_attendance[4]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_out')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))', [$now]);
                            });
                        });
                    break;
                case $this->constants->filter_status_attendance[5]:
                    $userAttendances = $userAttendances->where(function($query) {
                            $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                            ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                        });
                    break;
                case $this->constants->filter_status_attendance[6]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[1]);
                    break;
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
                    return $userAttendances->shift_name ?? "-";
                })
                ->addColumn('schedule_in', function ($userAttendances) {
                    return $userAttendances->working_start ?? "-";
                })
                ->addColumn('schedule_out', function ($userAttendances) {
                    return $userAttendances->working_end ?? "-";
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
                    return $userAttendances->overtime != 0 ? $userAttendances->overtime : "-";
                })
                ->addColumn('attendance_code', function ($userAttendances) {
                    return $this->constants->attendanceCodeTranslator($userAttendances->attendance_code) ?? "-";
                })
                ->addColumn('time_off_code', function ($userAttendances) {
                    return $userAttendances->day_off_code ?? "-";
                })
                ->addColumn('action', function ($userAttendances) {
                    $checkIn = $userAttendances->check_in ? date('H:i', strtotime($userAttendances->check_in)) : null;
                    $checkOut = $userAttendances->check_out ? date('H:i', strtotime($userAttendances->check_out)) : null;

                    return view('hc.cmt-attendance.components.menu', compact(['checkIn', 'checkOut', 'userAttendances']));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function getTableAttendanceDetail(Request $request)
    {
        if (request()->ajax()) {
            /** @var App\Models\User $user */
            $user = Auth::user();

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses ini!");
            }

            $userAttendances = UserAttendance::where('user_id', $request->user_id)
                ->has('user.userEmployment')->with('user.userEmployment');;

            if ($range_date = $request->dateFilter) {
                $range_date = collect(explode('-', $request->dateFilter))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $userAttendances = $userAttendances->whereBetween('date', $range_date)->orderBy('date', 'desc');
            } else {
                $userAttendances = $userAttendances->orderBy('date', 'desc');
            }

            $now = now();

            switch ($request->filterStatus) {
                case $this->constants->filter_status_attendance[0]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                    ->where(function ($query) use ($now) {
                        $query->where(function ($query) use ($now) {
                            $query->whereDate('date', '=', $now)
                                ->where(function ($query) {
                                    $query->where(function ($query) {
                                        $query->whereNotNull('check_in')
                                            ->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                                    })->orWhere(function ($query) {
                                        $query->whereNotNull('check_out')
                                            ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                    });
                                });
                        })->orWhere(function($query) use ($now) {
                            $query->whereDate('date', '<', $now)
                                ->where('attendance_code', '=', $this->constants->attendance_code[0])
                                ->whereNotNull('check_in')
                                ->whereNotNull('check_out')
                                ->where(function($q) {
                                    $q->whereRaw('TIME(check_in) <= TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                                        ->whereRaw('TIME(check_out) >= TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                                });
                        });
                });
                    break;
                case $this->constants->filter_status_attendance[1]:
                    $userAttendances = $userAttendances->whereDate('date', '<=', $now)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_in')
                        ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))');
                    break;
                case $this->constants->filter_status_attendance[2]:
                    $userAttendances = $userAttendances->whereDate('date', '<=', $now)
                        ->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNotNull('check_out')
                        ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))');
                    break;
                case $this->constants->filter_status_attendance[3]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_in')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))', [$now]);
                            });
                        });
                    break;
                case $this->constants->filter_status_attendance[4]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[0])
                        ->whereNull('check_out')
                        ->where(function ($query) use ($now) {
                            $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                ->whereRaw('TIME(?) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))', [$now]);
                            });
                        });
                    break;
                case $this->constants->filter_status_attendance[5]:
                    $userAttendances = $userAttendances->where(function($query) {
                            $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                            ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                        });
                    break;
                case $this->constants->filter_status_attendance[6]:
                    $userAttendances = $userAttendances->where('attendance_code', '=', $this->constants->attendance_code[1]);
                    break;
            }

            return DataTables::of($userAttendances)
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="emergency_contact_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addColumn('date', function ($userAttendances) {
                    return $userAttendances->date;
                })
                ->addColumn('shift', function ($userAttendances) {
                    return $userAttendances->shift_name ?? "-";
                })
                ->addColumn('schedule_in', function ($userAttendances) {
                    return $userAttendances->working_start ?? "-";
                })
                ->addColumn('schedule_out', function ($userAttendances) {
                    return $userAttendances->working_end ?? "-";
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
                    return $userAttendances->overtime != 0 ? $userAttendances->overtime : "-";
                })
                ->addColumn('attendance_code', function ($userAttendances) {
                    return $this->constants->attendanceCodeTranslator($userAttendances->attendance_code) ?? "-";
                })
                ->addColumn('time_off_code', function ($userAttendances) {
                    return $userAttendances->day_off_code ?? "-";
                })
                ->addColumn('action', function ($userAttendances) {
                    $checkIn = $userAttendances->check_in ? date('H:i', strtotime($userAttendances->check_in)) : null;
                    $checkOut = $userAttendances->check_out ? date('H:i', strtotime($userAttendances->check_out)) : null;

                    return view('hc.cmt-attendance.components.menu', compact(['checkIn', 'checkOut', 'userAttendances']));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function exportAllAttendance(Request $request)
    {
        try {
            return Excel::download(new AllAttendance(
                $request->rangeDate,
                $request->filterDivisi,
                $request->filterDepartment
            ), 'Data Absen Pegawai.xlsx');
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function exportPersonalAttendance(Request $request)
    {
        try {
            /** @var App\Models\User $user */
            $user = Auth::user();

            if (!($user->id == $request->userId || $user->hasPermissionTo('HC:view-attendance'))) {
                abort(403);
            }

            return Excel::download(new PersonalAttendance(
                $request->userId,
                $request->rangeDate,
            ), 'Data Absen Pegawai.xlsx');
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
