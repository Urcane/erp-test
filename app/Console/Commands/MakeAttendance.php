<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

use App\Constants;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use App\Models\Employee\UserEmployment;
use App\Models\Employee\WorkingSchedule;

class MakeAttendance extends Command
{
    protected $constants;
    protected $today;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->constants = new Constants();
        Carbon::setLocale($this->constants->locale);
        $this->today = Carbon::now()->toDateString();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->isGlobalDayOff()) {
            $this->processGlobalDayOff();
            return 0;
        }

        $this->processWorkingSchedules();
        return 0;
    }

    protected function isGlobalDayOff()
    {
        return GlobalDayOff::where('date', $this->today)->exists();
    }

    protected function processGlobalDayOff()
    {
        $allUserIds = UserEmployment::has('user')->has('workingScheduleShift')
            ->pluck('user_id')
            ->toArray();

        $existingAttendanceUserIds = UserAttendance::whereDate('date', $this->today)
            ->pluck('user_id')
            ->toArray();

        $usersWithoutAttendance = array_diff($allUserIds, $existingAttendanceUserIds);

        $newAttendances = [];
        foreach ($usersWithoutAttendance as $userId) {
            $newAttendances[] = [
                'user_id' => $userId,
                'date' => $this->today,
                'attendance_code' => $this->constants->attendance_code[3]
            ];
        }
        UserAttendance::insert($newAttendances);

        UserAttendance::whereDate('date', $this->today)
            ->whereIn('user_id', $existingAttendanceUserIds)
            ->update(['attendance_code' => $this->constants->attendance_code[3]]);
    }

    protected function processWorkingSchedules()
    {
        $workingSchedules = WorkingSchedule::with('workingScheduleShifts.workingShift', 'dayOffs')->get();
        $userIdsWithAttendance = UserAttendance::whereDate('date', $this->today)->pluck('user_id')->toArray();

        foreach ($workingSchedules as $workingSchedule) {
            $dayOffs = $workingSchedule->dayOffs->pluck('day')->toArray();
            $isDayOff = in_array(Carbon::now()->dayName, $dayOffs);

            $code = $isDayOff ? $this->constants->attendance_code[2] : $this->constants->attendance_code[0];

            $userEmployments = UserEmployment::whereHas('workingScheduleShift', function ($query) use ($workingSchedule) {
                $query->where('working_schedule_id', $workingSchedule->id);
            })
                ->with('workingScheduleShift.workingShift', 'user')
                ->get();

            foreach ($userEmployments as $userEmployment) {
                $userId = $userEmployment->user->id;

                if (in_array($userId, $userIdsWithAttendance)) {
                    if (!$isDayOff) {
                        continue;
                    }
                    $this->updateAttendance($userId, $code);
                } else {
                    $data = [
                        'user_id' => $userId,
                        'date' => $this->today,
                        'attendance_code' => $code
                    ];

                    if (!$isDayOff) {
                        $workingShift = $userEmployment->workingScheduleShift->workingShift;
                        $data = array_merge($data, [
                            'shift_name' => $workingShift->name,
                            'working_start' => $workingShift->working_start,
                            'working_end' => $workingShift->working_end,
                            'overtime_before' => $workingShift->overtime_before,
                            'overtime_after' => $workingShift->overtime_after,
                            'late_check_in' => $workingShift->late_check_in,
                            'late_check_out' => $workingShift->late_check_out,
                            'start_attend' => $workingShift->start_attend,
                            'end_attend' => $workingShift->end_attend,
                        ]);
                    }

                    UserAttendance::create($data);
                }
            }
        }
    }

    protected function updateAttendance($userId, $code)
    {
        UserAttendance::whereDate('date', $this->today)
            ->where('user_id', $userId)
            ->update(['attendance_code' => $code]);
    }

    protected function createAttendance($userId, $code, $additionalData = [])
    {
        $data = array_merge([
            'user_id' => $userId,
            'date' => $this->today,
            'attendance_code' => $code
        ], $additionalData);

        UserAttendance::create($data);
    }
}
