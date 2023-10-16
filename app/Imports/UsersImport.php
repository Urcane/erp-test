<?php

namespace App\Imports;

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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class UsersImport implements OnEachRow
{

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        if ($row[0] == "name") {
            return;
        }

        // dd($row);
        DB::transaction(function () use ($row) {
            $department_id = Department::where("department_name", $row[5])->first()->id;
            $division_id = Division::where("divisi_name", $row[6])->first()->id;
            $team_id = Team::where("team_name", $row[7])->first()->id;

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
            $user->assignRole($row[8]);

            UserPersonalData::create([
                'user_id' => $user->id,
                'birthdate' => $row[9],
                'place_of_birth' => $row[10],
                'marital_status' => $row[11],
                'gender' => $row[12],
                'blood_type' => $row[13],
                'religion' => $row[14],
            ]);

            UserIdentity::create([
                'user_id' => $user->id,
                'type' => $row[15],
                'number' => $row[16],
                'expire_date' => $row[17],
                'postal_code' => $row[18],
                'citizen_id_address' => $row[19],
                'residential_address' => $row[20],
            ]);

            $sub_branch_id = SubBranch::where("name", $row[25])->first()->id;
            $working_schedule_id = WorkingSchedule::where("name", $row[26])->first()->id;
            $start_shift = WorkingScheduleShift::where("working_schedule_id", $working_schedule_id)->get()[$row[27]-1]->id;

            $approval_line = User::where("name", $row[28])->first()->id;
            $employment_status_id = EmploymentStatus::where("name", $row[22])->first()->id;

            UserEmployment::create([
                'user_id' => $user->id,
                'employee_id' => $row[21],
                'employment_status_id' => $employment_status_id,
                'join_date' => $row[23],
                'end_date' => $row[24],
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
