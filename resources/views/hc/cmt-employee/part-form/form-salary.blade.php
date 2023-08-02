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
            <input type="number" class="form-control form-control-solid" required placeholder="0" name="basic_salary" id="basic_salary" @unlessrole("administrator") disabled @endunlessrole>
        </div><br>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="salary_type">
            <span class="fw-bold">Salary Type</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="salary_type" name="salary_type" id="salary_type" @unlessrole("administrator") disabled @endunlessrole>
            <option value="Monthly" >Monthly</option>
            <option value="Yearly" >Yearly</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="payment_schedule">
            <span class="fw-bold">Payment Schedule</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="payment_schedule" name="payment_schedule" id="payment_schedule" @unlessrole("administrator") disabled @endunlessrole>
            <option value="Payment Schedule 1" >Payment Schedule 1</option>
            <option value="Payment Schedule 2" >Payment Schedule 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="prorate_setting">
            <span class="fw-bold">Prorate Setting</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="prorate_setting" name="prorate_setting" id="prorate_setting" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Prorate Setting</option>
            <option value="Prorate Setting 1" >Prorate Setting 1</option>
            <option value="Prorate Setting 2" >Prorate Setting 2</option>
            <option value="Prorate Setting 3" >Prorate Setting 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="allowed_for_overtime">
            <span class="fw-bold">Allowed for Overtime</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="allowed_for_overtime" name="allowed_for_overtime" id="allowed_for_overtime" @unlessrole("administrator") disabled @endunlessrole>
            <option value="1" >Iya</option>
            <option value="0" >Tidak</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_working_day">
            <span class="fw-bold">Overtime Working Day Default</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="overtime_working_day" name="overtime_working_day" id="overtime_working_day" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Overtime Working Day Default</option>
            <option value="Overtime Working Day Default 1" >Overtime Working Day Default 1</option>
            <option value="Overtime Working Day Default 2" >Overtime Working Day Default 2</option>
            <option value="Overtime Working Day Default 3" >Overtime Working Day Default 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_day_off">
            <span class="fw-bold">Overtime Day Off Default</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="overtime_day_off" name="overtime_day_off" id="overtime_day_off" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Overtime Day Off Default</option>
            <option value="Overtime Day Off Default 1" >Overtime Day Off Default 1</option>
            <option value="Overtime Day Off Default 2" >Overtime Day Off Default 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_national_holiday">
            <span class="fw-bold">Overtime National Holiday Default</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="overtime_national_holiday" name="overtime_national_holiday" id="overtime_national_holiday" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Overtime National Holiday Default</option>
            <option value="Overtime National Holiday Default 1" >Overtime National Holiday Default 1</option>
            <option value="Overtime National Holiday Default 2" >Overtime National Holiday Default 2</option>
            <option value="Overtime National Holiday Default 3" >Overtime National Holiday Default 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
