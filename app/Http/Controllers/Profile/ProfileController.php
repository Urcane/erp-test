<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

use App\Constants;
use App\Models\Leave\LeaveRequestCategory;
use App\Models\User;
use App\Models\Department;
use App\Models\Division;
use App\Models\Team\Team;
use App\Models\Employee\UserBank;
use App\Models\Employee\UserBpjs;
use App\Models\Employee\UserEmployment;
use App\Models\Employee\UserIdentity;
use App\Models\Employee\UserPersonalData;
use App\Models\Employee\UserSalary;
use App\Models\Employee\UserTax;
use App\Models\Employee\EmploymentStatus;
use App\Models\Employee\SubBranch;
use App\Models\Employee\WorkingScheduleShift;
use App\Models\Employee\PaymentSchedule;
use App\Models\Employee\ProrateSetting;
use App\Models\Employee\TaxStatus;
use App\Models\PersonalInfo\NonFormalEducationCategory;
use App\Models\PersonalInfo\UserFileCategory;

use App\Models\Employee\WorkingSchedule;
use App\Models\Employee\WorkingShift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\ErrorHandler;

class ProfileController extends Controller
{
    private $constants;
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function profile($id) {
        /** @var \App\Models\User $auth */
        $auth = Auth::user();
        if (!($auth->hasPermissionTo("HC:view-employee") || $id == $auth->id)) {
            abort(403);
        }

        $user = User::whereId($id)->first();
        if (!$user) {
            abort(404);
        }

        $dataDepartment = Department::all();
        $dataDivision = Division::all();

        $dataRole = Role::all();
        $constants = new Constants();
        $users = User::all();
        $dataTeam = Team::all();
        $dataEmploymentStatus = EmploymentStatus::all();
        $dataSubBranch = SubBranch::all();
        $dataTaxStatus = TaxStatus::all();
        $dataWorkingScheduleShift = WorkingScheduleShift::all();
        $dataShift = WorkingShift::where('show_in_request', true)->get();

        $dataNonFormalEducationCategory = NonFormalEducationCategory::all();
        $dataPaymentSchedule = PaymentSchedule::all();
        $dataProrateSetting = ProrateSetting::all();
        $dataCategory = UserFileCategory::all();

        $leaveRequestCategory = LeaveRequestCategory::where("show_in_request", true)
            ->whereDate('effective_date', "<=", now())
            ->get();

        return view('profile.index', compact(
            'user',
            'users',
            'dataNonFormalEducationCategory',
            'dataRole',
            'dataTeam',
            'dataTaxStatus',
            'dataDepartment',
            'dataDivision',
            'constants',
            'dataEmploymentStatus',
            'dataSubBranch',
            'dataWorkingScheduleShift',
            'dataPaymentSchedule',
            'dataProrateSetting',
            'dataShift',
            'dataCategory',
            'leaveRequestCategory'
        ));

    }

    public function updateEmployment(Request $request)
    {
        try {
            $request->validate([
                // update on table user
                "department_id" => 'required|exists:departments,id',
                'division_id' => 'required|exists:divisions,id',
                'role_id' => 'required|exists:roles,id',
                'team_id' => 'nullable|exists:teams,id',

                // update on table user employement
                'employee_id' => 'required|string|max:35',
                'employment_status_id' => 'required|exists:employment_statuses,id',
                'join_date' => 'required|date',
                'end_date' => 'nullable|date',
                'sub_branch_id' => 'nullable|exists:sub_branches,id',
                'working_schedule_shift_id' => 'required|exists:working_schedules,id',
                'approval_line' => 'nullable|exists:users,id',
                'barcode' => 'nullable|string|max:255',
            ]);

            $user = User::whereId($request->user_id);

            $user->update([
                "department_id" => $request->department_id,
                'division_id' => $request->division_id,
                'team_id' => $request->team_id,
            ]);

            $user->first()->assignRole($request->role_id);

            UserEmployment::where('user_id', $request->user_id)->update([
                'employee_id' => $request->employee_id,
                'employment_status_id' => $request->employment_status_id,
                'join_date' => $request->join_date,
                'end_date' => $request->end_date,
                'sub_branch_id' => $request->sub_branch_id,
                'working_schedule_shift_id' => $request->working_schedule_shift_id,
                'approval_line' => $request->approval_line,
                'barcode' => $request->barcode,
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateSalary(Request $request)
    {
        try {
            $request->validate([
                'basic_salary' => 'required|integer',
                'salary_type' => ['nullable', Rule::in($this->constants->salary_type)],
                'payment_schedule_id' => 'nullable|exists:payment_schedules,id',
                'prorate_setting_id' => 'nullable|exists:prorate_settings,id',
                'allow_for_overtime' => 'required|boolean',
                'overtime_working_day' => 'nullable|string|max:10',
                'overtime_day_off' => 'nullable|string|max:10',
                'overtime_national_holiday' => 'nullable|string|max:10',
            ]);

            UserSalary::where('user_id', $request->user_id)->update([
                'basic_salary' => $request->basic_salary,
                'salary_type' => $request->salary_type,
                'payment_schedule_id' => $request->payment_schedule_id,
                'prorate_setting_id' => $request->prorate_setting_id,
                'allow_for_overtime' => $request->allow_for_overtime,
                'overtime_working_day' => $request->overtime_working_day,
                'overtime_day_off' => $request->overtime_day_off,
                'overtime_national_holiday' => $request->overtime_national_holiday,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil disimpan"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateBank(Request $request)
    {
        try {
            $request->validate([
                'bank_name' => 'nullable|string|max:55',
                'bank_number' => 'nullable|string|max:20',
                'bank_holder_name' => 'nullable|string|max:35',
            ]);

            UserBank::where('user_id', $request->user_id)->update([
                'name' => $request->bank_name,
                'number' => $request->bank_number,
                'holder_name' => $request->bank_holder_name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil disimpan"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateTax(Request $request)
    {
        try {
            $request->validate([
                'npwp' => 'nullable|string|max:18',
                'pktp' => 'required|string|max:25',
                'tax_method' => ['nullable', Rule::in($this->constants->tax_method)],
                'tax_salary' => ['nullable', Rule::in($this->constants->tax_salary)],
                'taxable_date' => 'nullable|date',
                'tax_status_id' => 'nullable|exists:tax_statuses,id',
                'beginning_netto' => 'nullable|integer',
                'pph21_paid' => 'nullable|integer',
            ]);

            UserTax::where('user_id', $request->user_id)->update([
                'npwp' => $request->npwp,
                'pktp_status' => $request->pktp,
                'tax_method' => $request->tax_method,
                'tax_salary' => $request->tax_salary,
                'taxable_date' => $request->taxable_date,
                'tax_status_id' => $request->tax_status_id,
                'beginning_netto' => $request->beginning_netto,
                'pph21_paid' => $request->pph21_paid,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil disimpan"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateBpjs(Request $request)
    {
        try {
            $request->validate([
                'ketenagakerjaan_number' => 'nullable|string|max:12',
                'ketenagakerjaan_npp' => 'nullable|string|max:15',
                'ketenagakerjaan_date' => 'nullable|date',
                'kesehatan_number' => 'nullable|string|max:14',
                'kesehatan_family' => 'nullable|string|max:20',
                'kesehatan_date' => 'nullable|date',
                'kesehatan_cost' => 'nullable|string|max:20',
                'jht_cost' => 'nullable|string|max:20',
                'jaminan_pensiun_cost' => ['nullable', Rule::in($this->constants->jaminan_pensiun_cost)],
                'jaminan_pensiun_date' => 'nullable|date',
            ]);

            UserBpjs::where('user_id', $request->user_id)->update([
                'ketenagakerjaan_number' => $request->ketenagakerjaan_number,
                'ketenagakerjaan_npp' => $request->ketenagakerjaan_npp,
                'ketenagakerjaan_date' => $request->ketenagakerjaan_date,
                'kesehatan_number' => $request->kesehatan_number,
                'kesehatan_family' => $request->kesehatan_family,
                'kesehatan_date' => $request->kesehatan_date,
                'kesehatan_cost' => $request->kesehatan_cost,
                'jht_cost' => $request->jht_cost,
                'jaminan_pensiun_cost' => $request->jaminan_pensiun_cost,
                'jaminan_pensiun_date' => $request->jaminan_pensiun_date,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil disimpan"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
