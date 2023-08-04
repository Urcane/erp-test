<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Constants;

class EmployeeController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function store(Request $request)
    {
        $request->validate([
            // user
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'kontak' => 'nullable|string',
            // 'division_id' =>
            //  departement_id
            // employee_placement_id

            // user_personal_data
            'birthdate' => 'required|date',
            'place_of_birth' => 'nullable|string|max:35',
            'marital_status' => ['required', Rule::in($this->constants->maritalStatus)],
            'gender' => ['required', Rule::in($this->constants->gender)],
            'blood_type' => ['nullable', Rule::in($this->constants->bloodType)],
            'religion' => ['required', Rule::in($this->constants->religion)],

            // user_identity
            'identitiy_type' => 'nullable|string|max:10',
            'identitiy_number' => 'nullable|string|max:25',
            'identitiy_expire_date' => 'nullable|date',
            'postal_code' => 'nullable|string|max:6',
            'citizen_id_address' => 'nullable|string|max:100',
            'residential_address' => 'nullable|string|max:100',

            // user_employment
            'employee_id' => 'required|string|max:35',
            'employment_status_id' => 'required|exists:employment_statuses,id',
            'join_date' => 'required|date',
            'end_date' => 'nullable|date',
            'resign_date' => 'nullable|date',
            'branch_id' => 'nullable|exists:branches,id',
            'job_position_id' => 'required|exists:job_positions,id',
            'job_level_id' => 'required|exists:job_levels,id',
            'grade' => 'required|string|max:40',
            'class' => 'required|string|max:40',
            'working_schedule_id' => 'required|exists:working_schedules,id',
            'approval_line' => 'nullable|exists:users,id',
            'barcode' => 'nullable|string|max:255',

            // user_salary
            'basic_salary' => 'required|integer',
            'salary_type' => ['nullable', Rule::in($this->constants->salaryType)],
            'payment_schedule_id' => 'nullable|exists:payment_schedules,id',
            'prorate_setting_id' => 'nullable|exists:prorate_settings,id',
            'allow_for_overtime' => 'boolean',
            'overtime_working_day' => 'nullable|string|max:10',
            'overtime_day_off' => 'nullable|string|max:10',
            'overtime_national_holiday' => 'nullable|string|max:10',

            // user_bank
            'bank_name' => 'nullable|string|max:55',
            'bank_number' => 'nullable|string|max:20',
            'bank_holder_name' => 'nullable|string|max:35',

            // user_tax
            'npwp' => 'nullable|string|max:18',
            'pktp_status' => 'required|string|max:25',
            'tax_method' => ['nullable', Rule::in($this->constants->taxMethod)],
            'tax_salary' => ['nullable', Rule::in($this->constants->taxSalary)],
            'taxable_date' => 'nullable|date',
            'tax_status_id' => 'nullable|exists:tax_statuses,id',
            'beginning_netto' => 'nullable|integer',
            'pph21_paid' => 'nullable|integer',

            // user_bpjs
            'ketenagakerjaan_number' => 'nullable|string|max:12',
            'ketenagakerjaan_npp' => 'nullable|string|max:15',
            'ketenagakerjaan_date' => 'nullable|date',
            'kesehatan_number' => 'nullable|string|max:14',
            'kesehatan_family' => 'nullable|string|max:20',
            'kesehatan_date' => 'nullable|date',
            'kesehatan_cost' => 'nullable|string|max:20',
            'jht_cost' => 'nullable|string|max:20',
            'jaminan_pensiun_cost' => ['nullable', Rule::in($this->constants->jaminanPensiunCost)],
            'jaminan_pensiun_date' => 'nullable|date',
        ]);

        return response()->json([
            "status" => "success",
            "message" => "berhasil menambahkan employee"
        ], 201);
    }
}
