<?php

namespace App\Http\Controllers\Api\HC;

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
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    private function _haversineDistance($lat1, $lon1, $lat2, $lon2, $radius) {
        $R = 6371000; // Radius of the Earth in meters

        // Convert degrees to radians
        $lat1 = deg2rad(floatval($lat1));
        $lon1 = deg2rad(floatval($lon1));
        $lat2 = deg2rad(floatval($lat2));
        $lon2 = deg2rad(floatval($lon2));

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        $distance = $R * $c;

        if ($distance > $radius) {
            throw new InvariantError("Anda diluar radius kantor ($distance meter)");
        }

        return $distance;
    }

    public function getAttendanceToday(Request $request)
    {
        try {
            $today = Carbon::now()->toDateString();
            $attendanceToday = UserAttendance::where('user_id', $request->user()->id)->where('date', $today)->first();

            if ($attendanceToday->attendance_code != $this->constants->attendance_code[0]) {
                return response()->json([
                    "status" => "success",
                    "message" => "Hari ini bukan hari kerja"
                ]);
            }

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

            $attendance = $request->user()->userAttendances()->paginate($itemCount, ['*'], 'page', $page);

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

    public function validateLocation(Request $request)
    {
        try {
            $request->validate([
                "latitude" => "required",
                "longitude" => "required"
            ]);

            $subBranch = $request->user()->userEmployment->subBranch;

            $distance =  $this->_haversineDistance(
                $subBranch->latitude,
                $subBranch->longitude,
                $request->latitude,
                $request->longitude,
                $subBranch->coordinate_radius
            );

            return response()->json([
                "status" => "success",
                "message" => "Anda berada dalam radius kantor ($distance meter)"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

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

            // global checkup
            $globalDayOff = GlobalDayOff::where('date', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat absen pada hari libur ($globalDayOff->name)");
            }

            // user handler
            $user = $request->user()->load('userEmployment.workingScheduleShift.workingSchedule.dayOffs');;

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

            $this->_haversineDistance(
                $employmentData->subBranch->latitude,
                $employmentData->subBranch->longitude,
                $request->latitude,
                $request->longitude,
                $employmentData->subBranch->coordinate_radius
            );

            // save the file
            $file = $request->file('file');
            $filename = time() . '_checkIn_' . $file->getClientOriginalName();
            $file->storeAs('attendance', $filename, 'public');

            if (!$attendanceToday) {
                UserAttendance::create([
                    'user_id' => $request->user()->id,
                    'date' => $today,
                    'attendance_code' => $this->constants->attendance_code[0],
                    'shift_name' => $workingShift->name,
                    'working_start' => $workingShift->working_start,
                    'working_end' => $workingShift->working_end,
                    'late_check_in' => $workingShift->late_check_in,
                    'late_check_out' => $workingShift->late_check_out,
                    'check_in' => $timestamp,
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
                    'overtime' => ($attendanceToday->overtime ?? 0) + $overtime
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check in ($now)"
                ], 201);
            }
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $request->validate([
                "file" => "required",
                "coordinate" => "required"
            ]);

            Carbon::setLocale($this->constants->locale);
            $timestamp = now();
            $now = Carbon::now();
            $today = $now->toDateString();

            // global checkup
            $globalDayOff = GlobalDayOff::where('date', $today)->first();

            if ($globalDayOff) {
                throw new InvariantError("Tidak dapat absen pada hari libur ($globalDayOff->name)");
            }

            // user handler
            $user = $request->user()->load('userEmployment.workingScheduleShift.workingSchedule.dayOffs');;

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

            $this->_haversineDistance(
                $employmentData->subBranch->latitude,
                $employmentData->subBranch->longitude,
                $request->latitude,
                $request->longitude,
                $employmentData->subBranch->coordinate_radius
            );

            // save the file
            $file = $request->file('file');
            $filename = time() . '_checkOut_' . $file->getClientOriginalName();
            $file->storeAs('attendance', $filename, 'public');

            if (!$attendanceToday) {
                UserAttendance::create([
                    'user_id' => $request->user()->id,
                    'date' => $today,
                    'attendance_code' => $this->constants->attendance_code[0],
                    'shift_name' => $workingShift->name,
                    'working_start' => $workingShift->working_start,
                    'working_end' => $workingShift->working_end,
                    'late_check_in' => $workingShift->late_check_in,
                    'late_check_out' => $workingShift->late_check_out,
                    'check_in' => null,
                    'check_out' => $timestamp,
                    'check_out_file' => $filename
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
                    'overtime' => ($attendanceToday->overtime ?? 0) + $overtime
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Berhasil Melakukan Check out($now)"
                ], 201);
            }
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
