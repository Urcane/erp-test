<?php

namespace App\Exports\Attendance;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use App\Models\User;
use Carbon\Carbon;

class PersonalAttendance extends Attendance implements FromView, WithEvents
{
    public function __construct($userId, $rangeDate)
    {
        parent::__construct($rangeDate);

        $this->userId = $userId;
    }

    public function view(): View
    {
        $constants = $this->constants;
        $rangeDate = $this->rangeDate;

        $summaries = $this->_getSummaries();
        $summaries = json_decode(substr($summaries, strpos($summaries, '{')), true);

        $userAttendances = $this->_getAttendances();

        $user = User::whereId($this->userId)->with([
            'division', 'department'
        ])->first();

        return view('exports.attendance.personalAttendance', compact([
            'user',
            'constants',
            'summaries',
            'rangeDate',
            'userAttendances'
        ]));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(20);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(10);
                $event->sheet->getColumnDimension('F')->setWidth(10);
                $event->sheet->getColumnDimension('G')->setWidth(10);
                $event->sheet->getColumnDimension('H')->setWidth(15);
                $event->sheet->getColumnDimension('I')->setWidth(10);

                $data = $this->_getAttendances();
                $rowIndex = 23;

                foreach ($data as $row) {
                    $attendanceCodeEnum = $this->constants->attendance_code;

                    if ($row->attendance_code != $attendanceCodeEnum[0]) {
                        $bgColor = 'FFFF00'; // Yellow

                        $event->sheet->getStyle('A' . $rowIndex . ':K' . $rowIndex)
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setRGB($bgColor);
                    } else if ($row->attendance_code != $attendanceCodeEnum[0]) {
                        $bgColor = 'C0C0C0'; // Light gray

                        $event->sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setRGB($bgColor);
                    } else {
                        $bgColor = 'FF0000';

                        if (!$row->check_in) {
                            $event->sheet->getStyle('E' . $rowIndex)
                                ->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($bgColor);
                        } else {
                            $scheduleIn = Carbon::parse($row->working_start)->addMinutes($row->late_check_in);
                            $clockIn = Carbon::createFromFormat('Y-m-d H:i:s', $row->check_in);

                            $scheduleHour = $scheduleIn->hour;
                            $scheduleMinute = $scheduleIn->minute;

                            $clockInHour = $clockIn->hour;
                            $clockInMinute = $clockIn->minute;

                            if ($clockInHour > $scheduleHour || ($clockInHour === $scheduleHour && $clockInMinute > $scheduleMinute)) {
                                $event->sheet->getStyle('E' . $rowIndex)
                                ->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($bgColor);
                            }
                        }

                        if (!$row->check_out) {
                            $event->sheet->getStyle('F' . $rowIndex)
                                ->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($bgColor);
                        } else {
                            $scheduleOut = Carbon::parse($row->working_end)->subMinutes($row->late_check_out);
                            $clockOut = Carbon::createFromFormat('Y-m-d H:i:s', $row->check_out);

                            $scheduleHour = $scheduleOut->hour;
                            $scheduleMinute = $scheduleOut->minute;

                            $clockOutHour = $clockOut->hour;
                            $clockOutMinute = $clockOut->minute;

                            if ($clockOutHour < $scheduleHour || ($clockOutHour === $scheduleHour && $clockOutMinute < $scheduleMinute)) {
                                $event->sheet->getStyle('F' . $rowIndex)
                                ->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($bgColor);
                            }
                        }
                    }

                    $rowIndex++;
                }
            },
        ];
    }
}
