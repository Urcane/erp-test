<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee\UserBank;
use App\Models\Employee\UserBpjs;
use App\Models\Employee\UserEmployment;
use App\Models\Employee\UserIdentity;
use App\Models\Employee\UserPersonalData;
use App\Models\Employee\UserSalary;
use App\Models\Employee\UserTax;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                "user_personal_data" => $this->makePersonalData(
                    1,
                    "1999-08-01",
                    "Balikpapan",
                    "Belum Kawin",
                    "Laki-laki",
                    "A"
                ),
                "user_identity" => $this->makeIdentity(
                    1,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    1,
                    1234567,
                    "Karyawan Tetap",
                    "2021-09-09",
                    null,
                    null,
                    "Pusat",
                    "Comtel",
                    "Software Engineer",
                    "Karyawan",
                    "AAA",
                    "AAA",
                    "AAA",
                    null,
                    null

                ),
                "user_salary" => $this->makeSalary(
                    1,
                    5000000,
                    "Monthly",
                    null,
                    null,
                    False,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    1,
                    "BCA",
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    1,
                    "1234567890123456",
                    "Wajib Pajak Kawin",
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
                "user_personal_data" => $this->makePersonalData(
                    2,
                    "1999-08-01",
                    "Balikpapan",
                    "Belum Kawin",
                    "Laki-laki",
                    "A"
                ),
                "user_identity" => $this->makeIdentity(
                    2,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    2,
                    1234567,
                    "Karyawan Tetap",
                    "2021-09-09",
                    null,
                    null,
                    "Pusat",
                    "Comtel",
                    "Software Engineer",
                    "Karyawan",
                    "AAA",
                    "AAA",
                    "AAA",
                    null,
                    null

                ),
                "user_salary" => $this->makeSalary(
                    2,
                    5000000,
                    "Monthly",
                    null,
                    null,
                    False,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    2,
                    "BCA",
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    2,
                    "1234567890123456",
                    "Wajib Pajak Kawin",
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
                "user_bpjs" => $this->makeBpjs(
                    2,
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
                "user_personal_data" => $this->makePersonalData(
                    3,
                    "1999-08-01",
                    "Balikpapan",
                    "Belum Kawin",
                    "Laki-laki",
                    "A"
                ),
                "user_identity" => $this->makeIdentity(
                    3,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    3,
                    1234567,
                    "Karyawan Tetap",
                    "2021-09-09",
                    null,
                    null,
                    "Pusat",
                    "Comtel",
                    "Software Engineer",
                    "Karyawan",
                    "AAA",
                    "AAA",
                    "AAA",
                    null,
                    null

                ),
                "user_salary" => $this->makeSalary(
                    3,
                    5000000,
                    "Monthly",
                    null,
                    null,
                    False,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    3,
                    "BCA",
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    3,
                    "1234567890123456",
                    "Wajib Pajak Kawin",
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
                "user_bpjs" => $this->makeBpjs(
                    3,
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
                "user_personal_data" => $this->makePersonalData(
                    4,
                    "1999-08-01",
                    "Balikpapan",
                    "Belum Kawin",
                    "Laki-laki",
                    "A"
                ),
                "user_identity" => $this->makeIdentity(
                    4,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                ),
                "user_employment" => $this->makeEmployment(
                    4,
                    1234567,
                    "Karyawan Tetap",
                    "2021-09-09",
                    null,
                    null,
                    "Pusat",
                    "Comtel",
                    "Software Engineer",
                    "Karyawan",
                    "AAA",
                    "AAA",
                    "AAA",
                    null,
                    null

                ),
                "user_salary" => $this->makeSalary(
                    4,
                    5000000,
                    "Monthly",
                    null,
                    null,
                    False,
                    null,
                    null,
                    null
                ),
                "user_bank" => $this->makeBank(
                    4,
                    "BCA",
                    1274517631,
                    "Agus Pramudia Perwitasari"
                ),
                "user_tax" => $this->makeTax(
                    4,
                    "1234567890123456",
                    "Wajib Pajak Kawin",
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
                "user_bpjs" => $this->makeBpjs(
                    4,
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
            ]
        ];

        collect($data)->map(function($data) {
            UserBank::create($data["user_bank"]);
            UserBpjs::create($data["user_bpjs"]);
            UserEmployment::create($data["user_employment"]);
            UserIdentity::create($data["user_identity"]);
            UserPersonalData::create($data["user_personal_data"]);
            UserSalary::create($data["user_salary"]);
            UserTax::create($data["user_tax"]);
        });
    }

    private function makePersonalData($user, $birthdate, $place, $marital, $gender, $blood)
    {
        return [
            "user_id" => $user,
            "birthdate" => date('Y-m-d', strtotime($birthdate)),
            "place_of_birth" => $place,
            "marital_status" => $marital,
            "gender" => $gender,
            "blood_type" => $blood,
        ];
    }

    private function makeIdentity($user, $type, $number, $expire, $postal, $citizenAddress, $residentialAddress)
    {
        return [
            "user_id" => $user,
            "type" => $type,
            "number" => $number,
            "expire_date" => $expire,
            "postal_code" => $postal,
            "citizen_id_address" => $citizenAddress,
            "residential_address" => $residentialAddress,
        ];
    }

    private function makeEmployment($user, $employee, $status, $join, $end, $resign, $branch, $organization, $jobPosition, $jobLevel, $grade, $class, $schedule, $approval, $barcode) {
        return [
            "user_id" => $user,
            "employee_id" => $employee,
            "status" => $status,
            "join_date" => date('Y-m-d', strtotime($join)),
            "end_date" => date('Y-m-d', strtotime($end)) ?? null,
            "resign_date" => date('Y-m-d', strtotime($resign)) ?? null,
            "branch" => $branch,
            "organization" => $organization,
            "job_position" => $jobPosition,
            "job_level" => $jobLevel,
            "grade" => $grade,
            "class" => $class,
            "schedule" => $schedule,
            "approval_line" => $approval,
            "barcode" => $barcode
        ];
    }

    private function makeSalary($user, $basic, $type, $schedule, $prorate, $allow, $workingDay, $dayOff, $holiday)
    {
        return [
            "user_id" => $user,
            "basic_salary" => $basic,
            "salary_type" => $type,
            "payment_schedule" => $schedule,
            "prorate_setting" => $prorate,
            "allow_for_overtime" => $allow,
            "overtime_working_day" => $workingDay,
            "overtime_day_off" => $dayOff,
            "overtime_national_holiday" => $holiday
        ];
    }

    private function makeBank($user, $name, $number, $holder)
    {
        return [
            "user_id" => $user,
            "name" => $name,
            "number" => $number,
            "holder_name" => $holder
        ];
    }

    private function makeTax($user, $npwp, $pktp, $method, $salary, $taxable, $status, $beginning, $pph21)
    {
        return [
            "user_id" => $user,
            "npwp" => $npwp,
            "pktp_status" => $pktp,
            "tax_method" => $method,
            "tax_salary" => $salary,
            "taxable_date" => date('Y-m-d', strtotime($taxable)) ?? null,
            "tax_status" => $status,
            "beginning_netto" => $beginning,
            "pph21_paid" => $pph21
        ];
    }

    private function makeBpjs($user, $number1, $npp, $date1, $number2, $family, $date2, $cost1, $cost2, $cost3, $date3)
    {
        return [
            "user_id" => $user,
            "ketenagakerjaan_number" => $number1,
            "ketenagakerjaan_npp" => $npp,
            "ketenagakerjaan_date" => date('Y-m-d', strtotime($date1)) ?? null,
            "kesehatan_number" => $number2,
            "kesehatan_family" => $family,
            "kesehatan_date" => date('Y-m-d', strtotime($date2)) ?? null,
            "kesehatan_cost" => $cost1,
            "jht_cost" => $cost2,
            "jaminan_pensiun_cost" => $cost3,
            "jaminan_pensiun_date" => date('Y-m-d', strtotime($date3)) ?? null
        ];
    }
}
