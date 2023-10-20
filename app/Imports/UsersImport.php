<?php

namespace App\Imports;

use App\Constants;
use App\Models\Department;
use App\Models\Division;
use App\Models\Employee\EmploymentStatus;
use App\Models\Employee\SubBranch;
use App\Models\Employee\UserBank;
use App\Models\Employee\UserBpjs;
use App\Models\Employee\UserEmployment;
use App\Models\Employee\UserIdentity;
use App\Models\Employee\UserPersonalData;
use App\Models\Employee\UserSalary;
use App\Models\Employee\UserTax;
use App\Models\Employee\WorkingSchedule;
use App\Models\Employee\WorkingScheduleShift;
use App\Models\Team\Team;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements OnEachRow
{

    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        if ($row[0] == "name") {
            return;
        }

        if (User::where("email", $row[1])->first()) {
            return;
        }

        // dd($row);
        DB::transaction(function () use ($row) {
            $department_id = Department::where("department_name", $row[5])->first()->id ?? null;
            $division_id = Division::where("divisi_name", $row[6])->first()->id ?? null;
            $team_id = Team::where("team_name", $row[7])->first()->id ?? null;
            $user = User::create([
                "name" => $row[0],
                "email" => $row[1],
                "password" => Hash::make("12345678"),
                "kontak" => $row[2],
                "nip" => $row[3],
                "nik" => $row[4],
                "department_id" => $department_id,
                "division_id" => $division_id,
                "team_id" => $team_id,
            ]);
            // if ($user->id == 73) {
                # code...
                // dd($user);
            // }
            // $user->assignRole($row[8]);

            UserPersonalData::create([
                'user_id' => $user->id,
                'birthdate' => Carbon::parse(Date::excelToDateTimeObject($row[9]))->format('Y-m-d'),
                'place_of_birth' => $row[10],
                'marital_status' => $row[11],
                'gender' => $row[12],
                'blood_type' => in_array($row[13], $this->constants->blood_type) ? $row[13] : null,
                'religion' => $row[14],
            ]);

            UserIdentity::create([
                'user_id' => $user->id,
                'type' => $row[15],
                'number' => $row[16],
                'expire_date' => $row[17] ? Carbon::parse(Date::excelToDateTimeObject($row[17]))->format('Y-m-d') : null,
                'postal_code' => $row[18],
                'citizen_id_address' => $row[19],
                'residential_address' => $row[20],
            ]);

            $sub_branch_id = SubBranch::where("name", $row[25])->first()->id ?? null;
            $working_schedule_id = WorkingSchedule::where("name", $row[26])->first()->id ?? null;
            $start_shift = WorkingScheduleShift::where("working_schedule_id", $working_schedule_id)->get()[$row[27]-1]->id ?? null;

            $approval_line = User::where("name", $row[28])->first()->id ?? null;
            $employment_status_id = EmploymentStatus::where("name", $row[22])->first()->id ?? null;

            UserEmployment::create([
                'user_id' => $user->id,
                'employee_id' => $row[21],
                'employment_status_id' => $employment_status_id,
                'join_date' => Carbon::parse(Date::excelToDateTimeObject($row[23]))->format('Y-m-d'),
                'end_date' => $row[24] ? Carbon::parse(Date::excelToDateTimeObject($row[24]))->format('Y-m-d') : null,
                'sub_branch_id' => $sub_branch_id,
                'working_schedule_id' => $working_schedule_id,
                'start_shift' => $start_shift,
                'approval_line' => $approval_line,
                'barcode' => $row[29],
            ]);

            UserSalary::create([
                'user_id' => $user->id,
                'basic_salary' => $row[30],
            ]);

            UserBank::create([
                'user_id' => $user->id,
                'name' => $row[31],
                'number' => $row[32],
                'holder_name' => $row[33],
            ]);

            UserTax::create([
                'user_id' => $user->id,
            ]);

            UserBpjs::create([
                'user_id' => $user->id,
            ]);
        });
    }
}
