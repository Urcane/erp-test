<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Bank Account</h4>
        <span class="fs-7 fw-semibold text-gray-500">The employee's bank account is used for payroll</span>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="bank_name">
            <span class="fw-bold">Bank Name</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="bank_name" name="bank_name" id="bank_name" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Bank Name</option>
            <option value="Bank Name 1" >Bank Name 1</option>
            <option value="Bank Name 2" >Bank Name 2</option>
            <option value="Bank Name 3" >Bank Name 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="account_number">
            <span class="fw-bold">Account Number</span>
        </label>
        <input type="number" class="form-control form-control-solid" placeholder="account_number" name="account_number" id="account_number" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="account_holder_name">
            <span class="fw-bold">Account Holder Name</span>
        </label>
        <input type="text" class="form-control form-control-solid" placeholder="account_holder_name" name="account_holder_name" id="account_holder_name" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
