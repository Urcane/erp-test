<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Salary</h4>
        <span class="fs-7 fw-semibold text-gray-500">Input employment salary information</span>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="basic_salary">
            <span class="required fw-bold">Basic Salary</span>
        </label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
            </div>
            <input type="number" value="{{$user->userSalary->basic_salary ?? old('basic_salary') }}" class="form-control form-control-solid" required placeholder="0" name="basic_salary" id="basic_salary" @unlessrole("administrator") disabled @endunlessrole>
        </div><br>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="salary_type">
            <span class="fw-bold">Salary Type</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="salary_type" name="salary_type" id="salary_type" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userSalary->salary_type ?? old('salary_type')) == null)
                <option value="" selected hidden disabled>Select salary type</option>
            @endif
            @foreach ($allOptions->salary_type as $option)
                <option value="{{$option}}" @if (($user->userSalary->salary_type ?? old('salary_type')) == $option) selected @endif>{{$option}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="payment_schedule_id">
            <span class="fw-bold">Payment Schedule</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="payment_schedule_id" name="payment_schedule_id" id="payment_schedule_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userSalary->salary_type ?? old('payment_schedule_id')) == null)
                <option value="" selected hidden disabled>Select peyment schedule</option>
            @endif
            @foreach ($dataPaymentSchedule as $option)
                <option value="{{$option->id}}" @if ($user->userSalary->payment_schedule_id ?? old('payment_schedule_id') == $option->id) selected @endif>{{$option->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="prorate_setting_id">
            <span class="fw-bold">Prorate Setting</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="prorate_setting_id" name="prorate_setting_id" id="prorate_setting_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userSalary->salary_type ?? old('prorate_setting_id')) == null)
                <option value="" selected hidden disabled>Select prorate setting</option>
            @endif
            @foreach ($dataProrateSetting as $option)
                <option value="{{$option->id}}" @if ($user->userSalary->prorate_setting_id ?? old('prorate_setting_id') == $option->id) selected @endif>{{$option->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="allow_for_overtime">
            <span class="fw-bold">Allowed for Overtime</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="allow_for_overtime" name="allow_for_overtime" id="allow_for_overtime" @unlessrole("administrator") disabled @endunlessrole>
            <option value="1" @if (($user->userSalary->allow_for_overtime ?? old('allow_for_overtime')) == "1") selected @endif>Iya</option>
            <option value="0" @if (($user->userSalary->allow_for_overtime ?? old('allow_for_overtime')) == "0") selected @endif>Tidak</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_working_day">
            <span class="fw-bold">Overtime Working Day Default</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="overtime_working_day" name="overtime_working_day" id="overtime_working_day" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userSalary->overtime_working_day ?? old('overtime_working_day')) == null)
            <option value="" selected hidden disabled>Select Overtime Working Day Default</option>
            @endif
            @foreach ($allOptions->overtime_working_day as $overtime_working_day)
                <option value="{{$overtime_working_day}}" @if (($user->userSalary->overtime_working_day ?? old('overtime_working_day')) == $overtime_working_day) selected @endif>{{$overtime_working_day}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_day_off">
            <span class="fw-bold">Overtime Day Off Default</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="overtime_day_off" name="overtime_day_off" id="overtime_day_off" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userSalary->overtime_day_off ?? old('overtime_day_off')) == null)
            <option value="" selected hidden disabled>Select Overtime Day Off Default</option>
            @endif
            @foreach ($allOptions->overtime_day_off as $overtime_day_off)
                <option value="{{$overtime_day_off}}" @if (($user->userSalary->overtime_day_off ?? old('overtime_day_off')) == $overtime_day_off) selected @endif>{{$overtime_day_off}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_national_holiday">
            <span class="fw-bold">Overtime National Holiday Default</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="overtime_national_holiday" name="overtime_national_holiday" id="overtime_national_holiday" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userSalary->overtime_national_holiday ?? old('overtime_national_holiday')) == null)
            <option value="" selected hidden disabled>Select Overtime National Holiday Default</option>
            @endif
            @foreach ($allOptions->overtime_national_holiday as $overtime_national_holiday)
                <option value="{{$overtime_national_holiday}}" @if (($user->userSalary->overtime_national_holiday ?? old('overtime_national_holiday')) == $overtime_national_holiday) selected @endif>{{$overtime_national_holiday}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
