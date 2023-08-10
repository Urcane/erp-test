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

    public function getAttendanceToday(Request $request)
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

            if (!$attendanceToday) {
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

    public function getAttendanceHistory(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $attendance = UserAttendance::where('user_id', $request->user()->id)->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $attendance->currentPage(),
                    "itemCount" => $itemCount,
                    "attendance" => $attendance->items(),
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
                    'working_start' => $workingShift->working_start,
                    'working_end' => $workingShift->working_end,
                    'late_check_in' => $workingSchedule->late_check_in,
                    'late_check_out' => $workingSchedule->late_check_out,
                    'check_in' => $timestamp,
                    'check_out' => null,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check in ($now)"
                ], 201);
            } else {
                if ($attendanceToday->check_in && $attendanceToday->check_out) {
                    throw new InvariantError("Anda sudah melakukan check in dan check out, Hubungi Admin jika ini kesalahan");
                } elseif ($attendanceToday->check_in) {
                    $overtime = null;
                    $now->format('H:i:s');

                    if ($now->format('H:i:s') > $attendanceToday->working_end) {
                        $overtime = Carbon::parse($attendanceToday->working_end)->diffInMinutes($now->format('H:i:s'));
                    }

                    $attendanceToday->update([
                        'check_out' => $timestamp,
                        'overtime' => $overtime
                    ]);

                    return response()->json([
                        "status" => "success",
                        "message" => "Berhasil Melakukan Check Out ($now)"
                    ], 201);
                } else {
                    $attendanceToday->update(['check_in' => $timestamp]);

                    return response()->json([
                        "status" => "success",
                        "message" => "Berhasil Melakukan Check in ($now)"
                    ], 201);
                }
            }
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
