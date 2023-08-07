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
            @if (($user->userBank->name ?? old('bank_name')) == null)
                <option value="" selected hidden disabled>Select bank name</option>
            @endif
            @foreach ($allOptions->bank_name as $option)
                <option value="{{$option}}" @if (($user->userBank->name ?? old('bank_name')) == $option) selected @endif>{{$option}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="bank_number">
            <span class="fw-bold">Account Number</span>
        </label>
        <input type="number" value="{{$user->userBank->number ?? old('bank_number')}}" class="form-control form-control-solid" placeholder="Nomor rekening" name="bank_number" id="bank_number" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="bank_holder_name">
            <span class="fw-bold">Account Holder Name</span>
        </label>
        <input type="text" value="{{$user->userBank->holder_name ?? old('bank_holder_name')}}" class="form-control form-control-solid" placeholder="Pemilik rekening" name="bank_holder_name" id="bank_holder_name" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
