<?php

namespace App\Http\Controllers\attendance;

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
        return view('hc.cmt-attendance.index');
    }

    public function getTableAttendance()
    {
        // $user = User::with('userEmployment')->get();

        // dd($user->last()->userEmployment->employee_id);
        if (request()->ajax()) {
            $userAttendances = UserAttendance::has('user.userEmployment')->get()->sortByDesc('date');

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

    public function attend($id)
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
            $user = User::whereId($id)->first();

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
                    'date' => $today,
                    'status' => $this->constants->attendance_code[0],
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
                dd(Carbon::parse($attendanceToday->working_end_time)->diffInMinutes($today));
                if ($attendanceToday->check_in && $attendanceToday->check_out) {
                    throw new InvariantError("Anda sudah melakukan check in dan check out, Hubungi Admin jika ini kesalahan");
                } elseif ($attendanceToday->check_in) {
                    $overtime = $attendanceToday->working_end_time;

                    $attendanceToday->update([
                        'check_out' => $timestamp,
                        'overtime' => Carbon::parse($attendanceToday->working_end_time)->diffInMinutes($today)
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
