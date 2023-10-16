<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Division;
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
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $department_id = Department::where("name", $row[5])->first()->id;
        $division_id = Division::where("name", $row[6])->first()->id;
        $team_id = Team::where("name", $row[7])->first()->id;

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

        UserPersonalData::create([
            'user_id' => $user->id,
            'birthdate' => $row[8],
            'place_of_birth' => $row[7],
            'marital_status' => $row[9],
            'gender' => $row[10],
            'blood_type' => $row[11],
            'religion' => $row[12],
        ]);

        UserIdentity::create([
            'user_id' => $user->id,
            'type' => $row[13],
            'number' => $row[14],
            'expire_date' => $row[15],
            'postal_code' => $row[16],
            'citizen_id_address' => $row[17],
            'residential_address' => $row[18],
        ]);

        $user->assignRole($row[24]);
        $sub_branch_id = SubBranch::where("name", $row[23])->first()->id;
        $working_schedule_id = WorkingSchedule::where("name", $row[24])->first()->id;
        $start_shift = WorkingScheduleShift::where("working_schedule_id", $working_schedule_id)->whereHas("workingShift", function($query) use ($row) {
            $query->where("name", $row[25]);
        })->first()->id;

        UserEmployment::create([
            'user_id' => $user->id,
            'employee_id' => $row[19],
            'employment_status_id' => $row[20],
            'join_date' => $row[21],
            'end_date' => $row[22],
            'sub_branch_id' => $sub_branch_id,
            'working_schedule_id' => $working_schedule_id,
            'start_shift' => $start_shift,
            'approval_line' => $row[26],
            'barcode' => $row[27],
        ]);

        UserSalary::create([
            'user_id' => $user->id,
            'basic_salary' => $row[28],
        ]);

        UserBank::create([
            'user_id' => $user->id,
            'name' => $row[29],
            'number' => $row[30],
            'holder_name' => $row[31],
        ]);

        UserTax::create([
            'user_id' => $user->id,
        ]);

        UserBpjs::create([
            'user_id' => $user->id,
        ]);

        return true;
    }
}
