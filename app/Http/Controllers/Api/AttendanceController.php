<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;

use App\Constants;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;

class AttendanceController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    private function _summariesQuery($query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8)
    {
        $now = now();

        return [
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
                    })->orWhere(function ($query) use ($now) {
                        $query->whereDate('date', '<', $now)
                            ->where('attendance_code', '=', $this->constants->attendance_code[0])
                            ->whereNotNull('check_in')
                            ->whereNotNull('check_out')
                            ->where(function ($query) {
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

            "dayOffCount" => $query7->where(function ($query) {
                $query->where('attendance_code', '=', $this->constants->attendance_code[2])
                    ->orWhere('attendance_code', '=', $this->constants->attendance_code[3]);
            })
                ->count(),

            "timeOffCount" => $query8->where('attendance_code', '=', $this->constants->attendance_code[1])
                ->count(),
        ];
    }

    public function getAttendanceByDate(Request $request)
    {
        try {
            $today = Carbon::now()->toDateString();
            $attendance = $request->user()->userAttendances()->whereDate('date', $request->date ?? Carbon::now()->format('Y-m-d'))->first();

            if (!$attendance) {
                return response()->json([
                    "status" => "success",
                    "data" => [
                        "date" => $today,
                        "attendance_code" => null,
                        "attendance_code_view" => null,
                        "check_in" => null,
                        "check_out" => null
                    ]
                ]);
            }

            $attendance["check_in_file"] = $attendance->check_in_file ? asset("storage/attendance/checkin/$attendance->check_in_file") : null;
            $attendance["check_out_file"] = $attendance->check_out_file ? asset("storage/attendance/checkout/$attendance->check_out_file") : null;

            return response()->json([
                "status" => "success",
                "data" => $attendance
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getAttendanceHistory(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            // $filterMonth = $request->filterMonth ?? Carbon::now()->format('m');

            $filterMonth = $request->input('filterMonth', Carbon::now()->format('m'));
            $filterYear = $request->input('filterYear', Carbon::now()->format('Y'));

            if (!is_numeric($filterMonth) || $filterMonth < 1 || $filterMonth > 12) {
                $filterMonth = Carbon::now()->format('m');
            }

            if (!is_numeric($filterYear) || $filterYear < 2020 || $filterYear > Carbon::now()->format('Y')) {
                $filterYear = Carbon::now()->format('Y');
            }

            $startDate = Carbon::create($filterYear, $filterMonth, 26)->subMonth();

            $endDate = ($filterMonth == 12)
                ? Carbon::create($filterYear + 1, 12, 26)->subMonth()
                : Carbon::create($filterYear, $filterMonth + 1, 27)->subMonth();

            $attendance = $request->user()->userAttendances()
                ->whereBetween('date', [$startDate, $endDate])
                ->orderBy('date', 'desc')
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $attendance->currentPage(),
                    "itemCount" => $itemCount,
                    "attendance" => $attendance->items(),
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getPersonalAttendanceSummaries(Request $request)
    {
        try {
            $userAttendances = $request->user()->userAttendances();
            $rangeDate = [$request->startDate ?? Carbon::now()->subMonth()->format('Y-m-d'), $request->endDate ?? Carbon::now()->format('Y-m-d')];

            $userAttendances = $userAttendances->whereBetween('date', $rangeDate);

            $summaries = $this->_summariesQuery(
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances,
                clone $userAttendances
            );

            return response()->json([
                "status" => "success",
                "data" => [
                    "rangeDate" => $rangeDate,
                    "summaries" => $summaries
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function validateLocation(Request $request)
    {
        try {
            $request->validate([
                "latitude" => "required",
                "longitude" => "required"
            ]);

            $userInLocation = $request->user()->userEmployment->subBranch->branchLocations()
                ->selectRaw(
                    "branch_locations.*,
                    (6371000 * acos(cos(radians(?))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(?))
                    + sin(radians(?))
                    * sin(radians(latitude)))) AS distance",
                    [$request->latitude, $request->longitude, $request->latitude]
                )
                ->orderBy('distance')->first();

            if ($userInLocation->distance > $userInLocation->radius) {
                throw new InvariantError("Anda diluar radius kantor ($userInLocation->distance meter)");
            }

            return response()->json([
                "status" => "success",
                "message" => "Anda berada dalam radius kantor ($userInLocation->distance meter)"
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function checkIn(Request $request)
    {
        try {
            $request->validate([
                "file" => "required",
                "latitude" => "required",
                "longitude" => "required"
            ]);

            Carbon::setLocale($this->constants->locale);
            $timestamp = now();
            $now = Carbon::now();
            $today = $now->toDateString();

            $attendanceToday = UserAttendance::where('date', $today)->where('user_id', $request->user()->id)->first();

            if ($attendanceToday && $attendanceToday->attendance_code == $this->constants->attendance_code[4]) {
                if ($attendanceToday->checkIn) {
                    throw new InvariantError("Anda sudah melakukan check in, Hubungi Admin jika ini kesalahan");
                }

                $userInLocation = $request->user()->userAssignments()
                    ->where(function ($query) use ($today) {
                        $query->where('start_date', '<=', $today)
                            ->where('end_date', '>=', $today);
                    })
                    ->where('status', $this->constants->assignment_status[1])
                    ->selectRaw(
                        "assignments.radius,
                        (6371000 * acos(cos(radians(?))
                        * cos(radians(latitude))
                        * cos(radians(longitude) - radians(?))
                        + sin(radians(?))
                        * sin(radians(latitude)))) AS distance",
                        [$request->latitude, $request->longitude, $request->latitude]
                    )->orderBy('distance')->first();

                if ($userInLocation->distance > $userInLocation->radius) {
                    throw new InvariantError("Anda diluar radius wilayah dinas ($userInLocation->distance meter)");
                }

                $file = $request->file('file');
                $filename = time() . "_" . $request->user()->name . "." . $file->getClientOriginalExtension();
                $file->storeAs('attendance/checkin', $filename, 'public');

                $attendanceToday->update([
                    'check_in' => $timestamp,
                    'check_in_latitude' => $request->latitude,
                    'check_in_longitude' => $request->longitude,
                    'check_in_file' => $filename,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check in ($now)"
                ], 201);
            }

            if ($attendanceToday && $attendanceToday->attendance_code != $this->constants->attendance_code[0]) {
                throw new InvariantError("Hari ini bukan hari kerja");
            }

            // global checkup
            $globalDayOff = GlobalDayOff::where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat absen pada hari libur ($globalDayOff->name)");
            }

            // user handler
            $user = $request->user()->load([
                'userEmployment.workingSchedule.workingScheduleShifts',
                'userEmployment.subBranch.branchLocations'
            ]);

            if (!$user) {
                throw new NotFoundError("User tidak ditemukan");
            }

            $employmentData = $user->userEmployment;

            if (!$employmentData) {
                throw new InvariantError("User belum memiliki data karyawan");
            }

            $workingShift = $user->userCurrentShift->workingScheduleShift->workingShift;

            if (!$workingShift->is_working) {
                throw new InvariantError("Tidak dapat absen pada hari libur (Working Schedule)");
            }

            // get attendance today
            $attendanceToday = $user->userAttendances->where('date', $today)->first();

            // attendance validation
            if (!$attendanceToday) {
                if ($workingShift->start_attend) {
                    if (!($now->isAfter(Carbon::parse($workingShift->working_start)->subMinutes($workingShift->start_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen belum dimulai");
                    }
                }

                if ($workingShift->end_attend) {
                    if (!($now->isBefore(Carbon::parse($workingShift->working_end)->addMinutes($workingShift->end_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen sudah selesai");
                    }
                }
            } else {
                if ($attendanceToday->start_attend) {
                    if (!($now->isAfter(Carbon::parse($attendanceToday->working_start)->subMinutes($attendanceToday->start_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen belum dimulai");
                    }
                }

                if ($attendanceToday->end_attend) {
                    if (!($now->isBefore(Carbon::parse($attendanceToday->working_end)->addMinutes($attendanceToday->end_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen sudah selesai");
                    }
                }
            }

            // check location
            $userInLocation = $employmentData->subBranch->branchLocations()
                ->selectRaw(
                    "branch_locations.*,
                    (6371000 * acos(cos(radians(?))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(?))
                    + sin(radians(?))
                    * sin(radians(latitude)))) AS distance",
                    [$request->latitude, $request->longitude, $request->latitude]
                )
                ->orderBy('distance')->first();

            if ($userInLocation->distance > $userInLocation->radius) {
                throw new InvariantError("Anda diluar radius kantor ($userInLocation->distance meter)");
            }

            // save the file
            $file = $request->file('file');
            $filename = time() . "_" . $user->name . "." . $file->getClientOriginalExtension();
            $file->storeAs('attendance/checkin', $filename, 'public');

            if (!$attendanceToday) {
                $overtime = 0;

                if ($workingShift->overtime_before) {
                    $adjustedNow = $now->copy()->setDate(2000, 1, 1);
                    $overtimeStartTime = Carbon::parse($workingShift->overtime_before)->setDate(2000, 1, 1);
                    $workingStartTime = Carbon::parse($workingShift->workingStart)->setDate(2000, 1, 1);

                    if ($adjustedNow->gt($overtimeStartTime) && $adjustedNow->lt($workingStartTime)) {
                        $overtime = $overtimeStartTime->diffInMinutes($adjustedNow);
                    }
                }

                UserAttendance::create([
                    'user_id' => $request->user()->id,
                    'date' => $today,
                    'attendance_code' => $this->constants->attendance_code[0],
                    'shift_name' => $workingShift->name,
                    'working_start' => $workingShift->working_start,
                    'working_end' => $workingShift->working_end,
                    'overtime_before' => $workingShift->overtime_before,
                    'overtime_after' => $workingShift->overtime_after,
                    'late_check_in' => $workingShift->late_check_in,
                    'late_check_out' => $workingShift->late_check_out,
                    'start_attend' => $workingShift->start_attend,
                    'end_attend' => $workingShift->end_attend,
                    'check_in' => $timestamp,
                    'overtime' => ($attendanceToday->overtime ?? 0) + $overtime,
                    'check_in_latitude' => $request->latitude,
                    'check_in_longitude' => $request->longitude,
                    'check_in_file' => $filename,
                    'check_out' => null,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check in ($now)"
                ], 201);
            } else if ($attendanceToday->check_in) {
                throw new InvariantError("Anda sudah melakukan check in, Hubungi Admin jika ini kesalahan");
            } else {
                $overtime = 0;

                if ($attendanceToday->overtime_before) {
                    $adjustedNow = $now->copy()->setDate(2000, 1, 1);
                    $overtimeStartTime = Carbon::parse($attendanceToday->overtime_before)->setDate(2000, 1, 1);
                    $workingStartTime = Carbon::parse($attendanceToday->workingStart)->setDate(2000, 1, 1);

                    if ($adjustedNow->gt($overtimeStartTime) && $adjustedNow->lt($workingStartTime)) {
                        $overtime = $overtimeStartTime->diffInMinutes($adjustedNow);
                    }
                }

                $attendanceToday->update([
                    'check_in' => $timestamp,
                    'overtime' => ($attendanceToday->overtime ?? 0) + $overtime,
                    'check_in_latitude' => $request->latitude,
                    'check_in_longitude' => $request->longitude,
                    'check_in_file' => $filename,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check in ($now)"
                ], 201);
            }
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $request->validate([
                "file" => "required",
                "latitude" => "required",
                "longitude" => "required"
            ]);

            Carbon::setLocale($this->constants->locale);
            $timestamp = now();
            $now = Carbon::now();
            $today = $now->toDateString();

            $attendanceToday = UserAttendance::where('date', $today)->where('user_id', $request->user()->id)->first();

            if ($attendanceToday && $attendanceToday->attendance_code == $this->constants->attendance_code[4]) {
                $userInLocation = $request->user()->userAssignments->whereBetween('start_date', [$today, $today])
                    ->whereBetween('end_date', [$today, $today])
                    ->where('status', $this->constants->assignment_status[1])
                    ->selectRaw(
                        "user_assignments.*,
                        (6371000 * acos(cos(radians(?))
                        * cos(radians(latitude))
                        * cos(radians(longitude) - radians(?))
                        + sin(radians(?))
                        * sin(radians(latitude)))) AS distance",
                        [$request->latitude, $request->longitude, $request->latitude]
                    )->orderBy('distance')->first();

                if ($userInLocation->distance > $userInLocation->radius) {
                    throw new InvariantError("Anda diluar radius wilayah dinas ($userInLocation->distance meter)");
                }

                $file = $request->file('file');
                $filename = time() . "_" . $request->user()->name . "." . $file->getClientOriginalExtension();
                $file->storeAs('attendance/checkin', $filename, 'public');

                $attendanceToday->update([
                    'check_out' => $timestamp,
                    'check_out_latitude' => $request->latitude,
                    'check_out_longitude' => $request->longitude,
                    'check_out_file' => $filename,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check Out ($now)"
                ], 201);
            }

            if ($attendanceToday && $attendanceToday->attendance_code != $this->constants->attendance_code[0]) {
                throw new InvariantError("Hari ini bukan hari kerja");
            }

            // global checkup
            $globalDayOff = GlobalDayOff::where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat absen pada hari libur ($globalDayOff->name)");
            }

            // user handler
            $user = $request->user()->load([
                'userEmployment.workingSchedule.workingScheduleShifts',
                'userEmployment.subBranch.branchLocations'
            ]);

            if (!$user) {
                throw new NotFoundError("User tidak ditemukan");
            }

            $employmentData = $user->userEmployment;

            if (!$employmentData) {
                throw new InvariantError("User belum memiliki data karyawan");
            }

            $workingShift = $user->userCurrentShift->workingScheduleShift->workingShift;

            if (!$workingShift->is_working) {
                throw new InvariantError("Tidak dapat absen pada hari libur (Working Schedule)");
            }

            // data user checking
            $attendanceToday = $user->userAttendances->where('date', $today)->first();

            // attendance validation
            if (!$attendanceToday) {
                if ($workingShift->start_attend) {
                    if (!($now->isAfter(Carbon::parse($workingShift->working_start)->subMinutes($workingShift->start_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen belum dimulai");
                    }
                }

                if ($workingShift->end_attend) {
                    if (!($now->isBefore(Carbon::parse($workingShift->working_end)->addMinutes($workingShift->end_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen sudah selesai");
                    }
                }
            } else {
                if ($attendanceToday->start_attend) {
                    if (!($now->isAfter(Carbon::parse($attendanceToday->working_start)->subMinutes($attendanceToday->start_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen belum dimulai");
                    }
                }

                if ($attendanceToday->end_attend) {
                    if (!($now->isBefore(Carbon::parse($attendanceToday->working_end)->addMinutes($attendanceToday->end_attend)))) {
                        throw new InvariantError("Tidak dapat absen, Waktu absen sudah selesai");
                    }
                }
            }

            // check location
            $userInLocation = $employmentData->subBranch->branchLocations()
                ->selectRaw(
                    "branch_locations.*,
                    (6371000 * acos(cos(radians(?))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(?))
                    + sin(radians(?))
                    * sin(radians(latitude)))) AS distance",
                    [$request->latitude, $request->longitude, $request->latitude]
                )
                ->orderBy('distance')->first();

            if ($userInLocation->distance > $userInLocation->radius) {
                throw new InvariantError("Anda diluar radius kantor ($userInLocation->distance meter)");
            }

            // save the file
            $file = $request->file('file');
            $filename = time() . "_" . $user->name . "." . $file->getClientOriginalExtension();
            $file->storeAs('attendance/checkout', $filename, 'public');

            if (!$attendanceToday) {
                $overtime = 0;

                if ($workingShift->overtime_after) {
                    $adjustedNow = $now->copy()->setDate(2000, 1, 1);
                    $overtimeStartTime = Carbon::parse($workingShift->overtime_after)->setDate(2000, 1, 1);

                    if ($adjustedNow->gt($overtimeStartTime)) {
                        $overtime = $overtimeStartTime->diffInMinutes($adjustedNow);
                    }
                }

                UserAttendance::create([
                    'user_id' => $request->user()->id,
                    'date' => $today,
                    'attendance_code' => $this->constants->attendance_code[0],
                    'shift_name' => $workingShift->name,
                    'working_start' => $workingShift->working_start,
                    'working_end' => $workingShift->working_end,
                    'overtime_before' => $workingShift->overtime_before,
                    'overtime_after' => $workingShift->overtime_after,
                    'late_check_in' => $workingShift->late_check_in,
                    'late_check_out' => $workingShift->late_check_out,
                    'start_attend' => $workingShift->start_attend,
                    'end_attend' => $workingShift->end_attend,
                    'check_in' => null,
                    'check_out' => $timestamp,
                    'overtime' => ($attendanceToday->overtime ?? 0) + $overtime,
                    'check_out_latitude' => $request->latitude,
                    'check_out_longitude' => $request->longitude,
                    'check_out_file' => $filename,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check Out ($now)"
                ], 201);
            } else if ($attendanceToday->check_out) {
                throw new InvariantError("Anda sudah melakukan check out, Hubungi Admin jika ini kesalahan");
            } else {
                $overtime = 0;

                if ($attendanceToday->overtime_after) {
                    $adjustedNow = $now->copy()->setDate(2000, 1, 1);
                    $overtimeStartTime = Carbon::parse($attendanceToday->overtime_after)->setDate(2000, 1, 1);

                    if ($adjustedNow->gt($overtimeStartTime)) {
                        $overtime = $overtimeStartTime->diffInMinutes($adjustedNow);
                    }
                }

                $attendanceToday->update([
                    'check_out' => $timestamp,
                    'overtime' => ($attendanceToday->overtime ?? 0) + $overtime,
                    'check_out_latitude' => $request->latitude,
                    'check_out_longitude' => $request->longitude,
                    'check_out_file' => $filename,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check out($now)"
                ], 201);
            }
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
