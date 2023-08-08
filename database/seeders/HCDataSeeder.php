<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Employee\UserBank;
use App\Models\Employee\UserBpjs;
use App\Models\Employee\UserEmployment;
use App\Models\Employee\UserIdentity;
use App\Models\Employee\UserPersonalData;
use App\Models\Employee\UserSalary;
use App\Models\Employee\UserTax;
use App\Models\Employee\Branch;
use App\Models\Employee\PaymentSchedule;
use App\Models\Employee\ProrateSetting;
use App\Models\Employee\TaxStatus;
use App\Models\Employee\WorkingSchedule;
use App\Models\Employee\EmploymentStatus;
use App\Constants;
use App\Models\Attendance\UserAttendance;
use App\Models\Employee\WorkingScheduleShift;
use App\Models\Employee\WorkingShift;

class HCDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function run()
    {
        collect([
            "Pusat", "Cabang"
        ])->map(function ($data) {
            Branch::create([
                "name" => $data
            ]);
        });

        collect([
            ["Default", 12345, 0]
        ])->map(function ($data) {
            ProrateSetting::create([
                "name" => $data[0],
                "custom_number" => $data[1],
                "holiday_as_working_day" => $data[2]
            ]);
        });

        collect([
            "Pegawai Tetap", "Pegawai Tidak Tetap"
        ])->map(function ($data) {
            TaxStatus::create([
                "name" => $data
            ]);
        });


        collect([
            ["Default", 0, 31, 0, 1, 31, 1, 31, 0]
        ])->map(function ($data) {
            $additionalData = $data[1] === 0 ? [
                "attendance_date_start" => $data[4],
                "attendance_date_end" => $data[5],
                "payroll_date_start" => $data[6],
                "payroll_date_end" => $data[7],
                "pay_last_month" => $data[8]
            ] : [
                "start_date" => $data[4],
                "cutoff_day" => $this->constants->day[$data[5]],
            ];

            PaymentSchedule::create([
                "parent_id" => null,
                "name" => $data[0],
                "payment_type" => $this->constants->payment_type[$data[1]],
                "payroll_date" => $data[2],
                "tax_with_salary" => $data[3]
            ] + $additionalData);
        });

        collect([
            "Permanent", "Internship"
        ])->map(function ($data) {
            EmploymentStatus::create([
                "name" => $data,
            ]);
        });

        collect([
            ["Shift1", "08:00:00", "17:00:00", "12:00:00", "13:00:00"]
        ])->map(function ($data) {
            WorkingShift::create([
                "name" => $data[0],
                "working_start" => Carbon::createFromFormat('H:i:s', $data[1]),
                "working_end" => Carbon::createFromFormat('H:i:s', $data[2]),
                "break_start" => Carbon::createFromFormat('H:i:s', $data[3]),
                "break_end" => Carbon::createFromFormat('H:i:s', $data[4]),
            ]);
        });

        collect([
            ["Default", 5, 5]
        ])->map(function ($data) {
            WorkingSchedule::create([
                "name" => $data[0],
                "late_check_in" => $data[1],
                "late_check_out" => $data[2],
            ]);
        });

        WorkingScheduleShift::create([
            "working_schedule_id" => 1,
            "working_shift_id" => 1
        ]);

        collect([
            [
                "user_id" => [
                    "user_id" => 1,
                ],
                "user_personal_data" => $this->makePersonalData(
                    "1999-08-01",
                    "Balikpapan",
                    0,
                    0,
                    0,
                    0,
                ),
                "user_identity" => $this->makeIdentity(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    1234567,
                    1,
                    "2021-09-09",
                    null,
                    null,
                    1,
                    "AAA",
                    "AAA",
                    1,
                    null,
                    null
                ),
                "user_salary" => $this->makeSalary(
                    5000000,
                    0,
                    1,
                    1,
                    0,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    0,
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    "1234567890123456",
                    "Wajib Pajak Kawin",
                    0,
                    0,
                    null,
                    null,
                    null,
                    null
                ),
                "user_bpjs" => $this->makeBpjs(
                    1,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_attendance" => $this->makeAttendance(
                    "2023-07-01",
                    now(),
                    "08:00:00",
                    "17:00:00"
                )
            ],
            [
                "user_id" => [
                    "user_id" => 2,
                ],
                "user_personal_data" => $this->makePersonalData(
                    "1999-08-01",
                    "Balikpapan",
                    0,
                    0,
                    0,
                    0,
                ),
                "user_identity" => $this->makeIdentity(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    1234567,
                    1,
                    "2021-09-09",
                    null,
                    null,
                    1,
                    "AAA",
                    "AAA",
                    1,
                    null,
                    null
                ),
                "user_salary" => $this->makeSalary(
                    5000000,
                    0,
                    1,
                    1,
                    0,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    0,
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    "1234567890123456",
                    "Wajib Pajak Kawin",
                    0,
                    0,
                    null,
                    null,
                    null,
                    null
                ),
                "user_bpjs" => $this->makeBpjs(
                    1,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_attendance" => $this->makeAttendance(
                    "2023-07-01",
                    now(),
                    "08:00:00",
                    "17:00:00"
                )
            ],
            [
                "user_id" => [
                    "user_id" => 4,
                ],
                "user_personal_data" => $this->makePersonalData(
                    "1999-08-01",
                    "Balikpapan",
                    0,
                    0,
                    0,
                    0,
                ),
                "user_identity" => $this->makeIdentity(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    1234567,
                    1,
                    "2021-09-09",
                    null,
                    null,
                    1,
                    "AAA",
                    "AAA",
                    1,
                    null,
                    null
                ),
                "user_salary" => $this->makeSalary(
                    5000000,
                    0,
                    1,
                    1,
                    0,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    0,
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    "1234567890123456",
                    "Wajib Pajak Kawin",
                    0,
                    0,
                    null,
                    null,
                    null,
                    null
                ),
                "user_bpjs" => $this->makeBpjs(
                    1,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_attendance" => $this->makeAttendance(
                    "2023-07-01",
                    now(),
                    "08:00:00",
                    "17:00:00"
                )
            ],
            [
                "user_id" => [
                    "user_id" => 3,
                ],
                "user_personal_data" => $this->makePersonalData(
                    "1999-08-01",
                    "Balikpapan",
                    0,
                    0,
                    0,
                    0,
                ),
                "user_identity" => $this->makeIdentity(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    1234567,
                    1,
                    "2021-09-09",
                    null,
                    null,
                    1,
                    "AAA",
                    "AAA",
                    1,
                    null,
                    null
                ),
                "user_salary" => $this->makeSalary(
                    5000000,
                    0,
                    1,
                    1,
                    0,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    0,
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    "1234567890123456",
                    "Wajib Pajak Kawin",
                    0,
                    0,
                    null,
                    null,
                    null,
                    null
                ),
                "user_bpjs" => $this->makeBpjs(
                    1,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_attendance" => $this->makeAttendance(
                    "2023-07-01",
                    now(),
                    "08:00:00",
                    "17:00:00"
                )
            ],
        ])->map(function ($data) {
            UserBank::create($data["user_bank"] + $data["user_id"]);
            UserBpjs::create($data["user_bpjs"] + $data["user_id"]);
            UserEmployment::create($data["user_employment"] + $data["user_id"]);
            UserIdentity::create($data["user_identity"] + $data["user_id"]);
            UserPersonalData::create($data["user_personal_data"] + $data["user_id"]);
            UserSalary::create($data["user_salary"] + $data["user_id"]);
            UserTax::create($data["user_tax"] + $data["user_id"]);

            foreach ($data["user_attendance"] as $attendance) {
                UserAttendance::create($attendance + $data["user_id"]);
            }

        });
    }

    private function makePersonalData($birthdate, $place, $marital, $gender, $blood, $religion)
    {
        return [
            "birthdate" => date('Y-m-d', strtotime($birthdate)),
            "place_of_birth" => $place,
            "marital_status" => $this->constants->marital_status[$marital],
            "gender" => $this->constants->gender[$gender],
            "blood_type" => $this->constants->blood_type[$blood] ?? null,
            "religion" => $this->constants->religion[$religion]
        ];
    }

    private function makeIdentity($type, $number, $expire, $postal, $citizenAddress, $residentialAddress)
    {
        return [
            "type" => $type,
            "number" => $number,
            "expire_date" => $expire,
            "postal_code" => $postal,
            "citizen_id_address" => $citizenAddress,
            "residential_address" => $residentialAddress,
        ];
    }

    private function makeEmployment($employee, $status, $join, $end, $resign, $branch, $grade, $class, $schedule, $approval, $barcode)
    {
        return [
            "employee_id" => $employee,
            "employment_status_id" => $status,
            "join_date" => date('Y-m-d', strtotime($join)),
            "end_date" => date('Y-m-d', strtotime($end)) ?? null,
            "resign_date" => date('Y-m-d', strtotime($resign)) ?? null,
            "branch_id" => $branch,
            "grade" => $grade,
            "class" => $class,
            "working_schedule_shift_id" => $schedule,
            "approval_line" => $approval,
            "barcode" => $barcode
        ];
    }

    private function makeSalary($basic, $type, $schedule, $prorate, $allow, $workingDay, $dayOff, $holiday)
    {
        return [
            "basic_salary" => $basic,
            "salary_type" => $this->constants->salary_type[$type] ?? null,
            "payment_schedule_id" => $schedule,
            "prorate_setting_id" => $prorate,
            "allow_for_overtime" => $allow,
            "overtime_working_day" => $workingDay,
            "overtime_day_off" => $dayOff,
            "overtime_national_holiday" => $holiday
        ];
    }

    private function makeBank($name, $number, $holder)
    {
        return [
            "name" => $this->constants->bank_name[$name],
            "number" => $number,
            "holder_name" => $holder
        ];
    }

    private function makeTax($npwp, $pktp, $method, $salary, $taxable, $status, $beginning, $pph21)
    {
        return [
            "npwp" => $npwp,
            "pktp_status" => $pktp,
            "tax_method" => $this->constants->tax_method[$method] ?? null,
            "tax_salary" =>  $this->constants->tax_salary[$salary] ?? null,
            "taxable_date" => date('Y-m-d', strtotime($taxable)) ?? null,
            "tax_status_id" => $status,
            "beginning_netto" => $beginning,
            "pph21_paid" => $pph21
        ];
    }

    private function makeBpjs($number1, $npp, $date1, $number2, $family, $date2, $cost1, $cost2, $cost3, $date3)
    {
        return [
            "ketenagakerjaan_number" => $number1,
            "ketenagakerjaan_npp" => $npp,
            "ketenagakerjaan_date" => date('Y-m-d', strtotime($date1)) ?? null,
            "kesehatan_number" => $number2,
            "kesehatan_family" => $family,
            "kesehatan_date" => date('Y-m-d', strtotime($date2)) ?? null,
            "kesehatan_cost" => $cost1,
            "jht_cost" => $cost2,
            "jaminan_pensiun_cost" => $this->constants->jaminan_pensiun_cost[$cost3] ?? null,
            "jaminan_pensiun_date" => date('Y-m-d', strtotime($date3)) ?? null
        ];
    }

    private function makeAttendance($start, $end, $workingStartTime, $workingEndTime)
    {
        $data = [];
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            array_push($data, [
                'date' => $currentDate->format('Y-m-d'),
                'status' => $this->constants->attendanceStatus[0],
                'working_start_time' => $workingStartTime,
                'working_end_time' => $workingEndTime,
                'check_in' => Carbon::create($currentDate->year, $currentDate->month, $currentDate->day, 8, random_int(0, 10), 0),
                'check_out' => Carbon::create($currentDate->year, $currentDate->month, $currentDate->day, 17, random_int(0, 10), 0),
            ]);

            $currentDate->addDay();
        }

        return $data;
    }
}
