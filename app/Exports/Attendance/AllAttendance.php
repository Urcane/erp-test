<?php

namespace App\Exports\Attendance;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use App\Models\Department;
use App\Models\Division;
use Carbon\Carbon;

class AllAttendance extends Attendance implements FromView, WithEvents
{
    public function __construct($rangeDate, $filterDivisi, $filterDepartment)
    {
        parent::__construct($rangeDate);

        $this->filterDivisi = $filterDivisi;
        $this->filterDepartment = $filterDepartment;

        if ($filterDivisi != "*") {
            $this->divisiName = Division::whereId($filterDivisi)->first()->divisi_name;
        } else {
            $this->divisiName = "Semua Divisi";
        }

        if ($filterDepartment != "*") {
            $this->departmentName = Department::whereId($filterDepartment)->first()->department_name;
        } else {
            $this->departmentName = "Semua Department";
        }
    }

    public function view(): View
    {
        $constants = $this->constants;
        $rangeDate = $this->rangeDate;
        $divisiName = $this->divisiName;
        $departmentName = $this->departmentName;

        $summaries = $this->_getSummaries();
        $summaries = json_decode(substr($summaries, strpos($summaries, '{')), true);

        $userAttendances = $this->_getAttendances();

        return view('exports.attendance.allAttendance', compact([
            'constants',
            'summaries',
            'rangeDate',
            'divisiName',
            'departmentName',
            'userAttendances'
        ]));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(15);
                $event->sheet->getColumnDimension('F')->setWidth(15);
                $event->sheet->getColumnDimension('G')->setWidth(10);
                $event->sheet->getColumnDimension('H')->setWidth(10);
                $event->sheet->getColumnDimension('I')->setWidth(10);
                $event->sheet->getColumnDimension('J')->setWidth(15);
                $event->sheet->getColumnDimension('K')->setWidth(10);

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

                        $event->sheet->getStyle('A' . $rowIndex . ':K' . $rowIndex)
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setRGB($bgColor);
                    } else {
                        $bgColor = 'FF0000';

                        if (!$row->check_in) {
                            $event->sheet->getStyle('G' . $rowIndex)
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
                                $event->sheet->getStyle('G' . $rowIndex)
                                ->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($bgColor);
                            }
                        }

                        if (!$row->check_out) {
                            $event->sheet->getStyle('H' . $rowIndex)
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
                                $event->sheet->getStyle('H' . $rowIndex)
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
