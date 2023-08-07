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

class EmployeeSeeder extends Seeder
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
            ["Default", 8, 17, 12, 13, null, null]
        ])->map(function ($data) {
            WorkingSchedule::create([
                "name" => $data[0],
                "working_start_time" => Carbon::createFromTime($data[1], 0),
                "working_end_time" => Carbon::createFromTime($data[2], 0),
                "break_start_time" => Carbon::createFromTime($data[3], 0),
                "break_end_time" => Carbon::createFromTime($data[4], 0),
                "overtime_before" => Carbon::createFromTime($data[5], 0) ?? null,
                "overtime_after" => Carbon::createFromTime($data[6], 0) ?? null,
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
                "payment_type" => $this->constants->paymentType[$data[1]],
                "payroll_date" => $data[2],
                "tax_with_salary" => $data[3]
            ] + $additionalData);
        });

        collect([
            "Permanent", "Internship"
        ])->map(function ($data) {
            EmploymentStatus::create([
                "name" => $data
            ]);
        });

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
                    1,
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
                    1,
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
                    1,
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
                    1,
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
            ],
        ])->map(function ($data) {
            UserBank::create($data["user_bank"] + $data["user_id"]);
            UserBpjs::create($data["user_bpjs"] + $data["user_id"]);
            UserEmployment::create($data["user_employment"] + $data["user_id"]);
            UserIdentity::create($data["user_identity"] + $data["user_id"]);
            UserPersonalData::create($data["user_personal_data"] + $data["user_id"]);
            UserSalary::create($data["user_salary"] + $data["user_id"]);
            UserTax::create($data["user_tax"] + $data["user_id"]);
        });
    }

    private function makePersonalData($birthdate, $place, $marital, $gender, $blood, $religion)
    {
        return [
            "birthdate" => date('Y-m-d', strtotime($birthdate)),
            "place_of_birth" => $place,
            "marital_status" => $this->constants->maritalStatus[$marital],
            "gender" => $this->constants->gender[$gender],
            "blood_type" => $this->constants->bloodType[$blood] ?? null,
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

    private function makeEmployment($employee, $status, $join, $end, $resign, $branch, $jobPosition, $jobLevel, $grade, $class, $schedule, $approval, $barcode)
    {
        return [
            "employee_id" => $employee,
            "employment_status_id" => $status,
            "join_date" => date('Y-m-d', strtotime($join)),
            "end_date" => date('Y-m-d', strtotime($end)) ?? null,
            "resign_date" => date('Y-m-d', strtotime($resign)) ?? null,
            "branch_id" => $branch,
            "job_position_id" => $jobPosition,
            "job_level_id" => $jobLevel,
            "grade" => $grade,
            "class" => $class,
            "working_schedule_id" => $schedule,
            "approval_line" => $approval,
            "barcode" => $barcode
        ];
    }

    private function makeSalary($basic, $type, $schedule, $prorate, $allow, $workingDay, $dayOff, $holiday)
    {
        return [
            "basic_salary" => $basic,
            "salary_type" => $this->constants->salaryType[$type] ?? null,
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
            "name" => $this->constants->bankName[$name],
            "number" => $number,
            "holder_name" => $holder
        ];
    }

    private function makeTax($npwp, $pktp, $method, $salary, $taxable, $status, $beginning, $pph21)
    {
        return [
            "npwp" => $npwp,
            "pktp_status" => $pktp,
            "tax_method" => $this->constants->taxMethod[$method] ?? null,
            "tax_salary" =>  $this->constants->taxSalary[$salary] ?? null,
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
            "jaminan_pensiun_cost" => $this->constants->jaminanPensiunCost[$cost3] ?? null,
            "jaminan_pensiun_date" => date('Y-m-d', strtotime($date3)) ?? null
        ];
    }
}
