<?php

namespace App\Http\Controllers\Api\HC;

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

    public function checkAttendance(Request $request)
    {
        try {
            $today = Carbon::now()->toDateString();
            $attendanceToday = UserAttendance::where('user_id', $request->user()->id)->where('date', $today)->first();

            // if ($attendanceToday->attendance_code != $this->constants->attendance_code[0]) {
            //     return response()->json([
            //         "status" => "success",
            //         "data" => [
            //             "date" => $attendanceToday->date,
            //             "attendance_code" => $attendanceToday->attendance_code,
            //             "check_in" => $attendanceToday->check_in,
            //             "check_out" => $attendanceToday->check_out
            //         ]
            //     ]);
            // }

            return response()->json([
                "status" => "success",
                "data" => [
                    "date" => $attendanceToday->date,
                    "attendance_code" => $attendanceToday->attendance_code,
                    "attendance_code_view" => $this->constants->attendanceCodeTranslator($attendanceToday->attendance_code),
                    "check_in" => $attendanceToday->check_in,
                    "check_out" => $attendanceToday->check_out
                ]
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function makeAttend(Request $request)
    {
        try {
            Carbon::setLocale('id');
            $timestamp = now();
            $now = Carbon::now();
            $today = $now->toDateString();

            // global checkup
            $globalDayOff = GlobalDayOff::where('date', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat absen pada hari libur ($globalDayOff->name)");
            }

            // user handler
            $user = User::whereId($request->user()->id)->first();

            if (!$user) {
                throw new NotFoundError("User tidak ditemukan");
            }

            $employmentData = $user->userEmployment;

            if (!$employmentData) {
                throw new InvariantError("User belum memiliki data karyawan");
            }

            $workingDayOff = $employmentData->workingScheduleShift->workingSchedule->dayOffs->pluck('name')->toArray();

            if (in_array($now->dayName, $workingDayOff)) {
                throw new InvariantError("Tidak dapat absen pada hari libur (Working Schedule)");
            }

            // make attend
            $workingSchedule = $employmentData->workingScheduleShift->workingSchedule;
            $workingShift = $employmentData->workingScheduleShift->workingShift;
            $attendanceToday = $user->userAttendances->where('date', $today)->first();

            if (!$attendanceToday) {
                UserAttendance::create([
                    'user_id' => $request->user()->id,
                    'date' => $today,
                    'attendance_code' => $this->constants->attendance_code[0],
                    'working_start_time' => $workingShift->working_start,
                    'working_end_time' => $workingShift->working_end,
                    'late_check_in' => $workingSchedule->late_check_in,
                    'late_check_out' => $workingSchedule->late_check_out,
                    'check_in' => $timestamp,
                    'check_out' => null,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check in"
                ], 201);
            } else {
                if ($attendanceToday->check_in && $attendanceToday->check_out) {
                    throw new InvariantError("Anda sudah melakukan check in dan check out, Hubungi Admin jika ini kesalahan");
                } elseif ($attendanceToday->check_in) {
                    $overtime = $attendanceToday->working_end_time;

                    $attendanceToday->update([
                        'check_out' => $timestamp,
                        'overtime' => Carbon::parse($overtime)->diffInMinutes($today)
                    ]);

                    return response()->json([
                        "status" => "success",
                        "message" => "Berhasil Melakukan Check Out"
                    ], 201);
                } else {
                    $attendanceToday->update(['check_in' => $timestamp]);

                    return response()->json([
                        "status" => "success",
                        "message" => "Berhasil Melakukan Check in"
                    ], 201);
                }
            }
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
