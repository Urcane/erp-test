<?php

namespace App\Exports\Attendance;

use App\Constants;
use App\Models\Attendance\UserAttendance;
use App\Utils\ErrorHandler;
use Carbon\Carbon;

class Attendance
{
    protected $constants;
    protected $rangeDate;

    protected $userId;

    protected $filterDivisi;
    protected $filterDepartment;
    protected $divisiName;
    protected $departmentName;

    public function __construct($rangeDate)
    {
        $this->constants = new Constants();
        $this->rangeDate = $rangeDate;
    }

    private function _primaryQuery()
    {
        $userAttendances = null;

        $range_date = collect(explode('-', $this->rangeDate))->map(function ($item, $key) {
            $date = Carbon::parse($item);
            if ($key === 0) {
                return $date->startOfDay()->toDateTimeString();
            } else {
                return $date->endOfDay()->toDateTimeString();
            }
        })->toArray();

        if ($this->userId) {
            return UserAttendance::where('user_id', $this->userId)
                ->whereBetween('date', $range_date)
                ->has('user.userEmployment')->with('user.userEmployment');
        }

        $userAttendances = UserAttendance::has('user.userEmployment')->with('user.userEmployment');
        $userAttendances = $userAttendances->whereBetween('date', $range_date);

        if (!empty($this->filterDivisi) && $this->filterDivisi !== '*') {
            $userAttendances = $userAttendances->whereHas('user', function ($query) {
                $query->where('division_id', $this->filterDivisi);
            });
        }

        if (!empty($this->filterDepartment) && $this->filterDepartment !== '*') {
            $userAttendances = $userAttendances->whereHas('user', function ($query) {
                $query->where('department_id', $this->filterDepartment);
            });
        }

        return $userAttendances;
    }

    private function _summariesQuery($query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8, $query9, $query10)
    {
        $now = now();

        return response()->json([
            $this->constants->summaries_attendance[0] => $query1->where('attendance_code', '=', $this->constants->attendance_code[0])
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

            $this->constants->summaries_attendance[1] => $query2->whereDate('date', '<=', $now)
                ->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereNotNull('check_in')
                ->whereRaw('TIME(check_in) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))')
                ->count(),

            $this->constants->summaries_attendance[2] => $query3->whereDate('date', '<=', $now)
                ->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereNotNull('check_out')
                ->whereRaw('TIME(check_out) < TIME(DATE_SUB(working_end, INTERVAL late_check_out MINUTE))')
                ->count(),

            $this->constants->summaries_attendance[3] => $query4->where('attendance_code', '=', $this->constants->attendance_code[0])
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

            $this->constants->summaries_attendance[4] => $query5->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereNull('check_in')
                ->where(function ($query) use ($now) {
                    $query->whereDate('date', '<', $now)->orWhere(function ($query) use ($now) {
                        $query->whereDate('date', '=', $now)
                        ->whereRaw('TIME(?) > TIME(DATE_ADD(working_start, INTERVAL late_check_in MINUTE))', [$now]);
                    });
                })
                ->count(),

            $this->constants->summaries_attendance[5] => $query6->where('attendance_code', '=', $this->constants->attendance_code[0])
                ->whereDate('date', '<', $now)
                ->whereNull('check_out')
                ->count(),

            $this->constants->summaries_attendance[6] => $query7->where(function($query) {
                    $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                    ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
                })
                ->count(),

            $this->constants->summaries_attendance[7] => $query8->where('attendance_code', '=', $this->constants->attendance_code[1])
                ->count(),

            $this->constants->summaries_attendance[8] => $query9->where('attendance_code', '=', $this->constants->attendance_code[4])
                ->whereDate('date', '<=', $now)
                ->where(function ($query) {
                    $query->whereNotNull('check_in')
                        ->orWhereNotNull('check_out');
                })->count(),

            $this->constants->summaries_attendance[9] => $query10->where('attendance_code', '=', $this->constants->attendance_code[4])
                ->whereDate('date', '<', $now)
                ->whereNull('check_in')
                ->whereNull('check_out')
                ->count(),
        ]);
    }

    protected function _getSummaries()
    {
        try {
            $userAttendances = $this->_primaryQuery();

            return $this->_summariesQuery(
                clone $userAttendances,
                clone $userAttendances,
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
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    protected function _getAttendances()
    {
        try {
            $userAttendances = $this->_primaryQuery();

            return $userAttendances->orderBy('date', 'desc')->get();
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
