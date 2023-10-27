<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Tax Configuration</h4>
        <span class="fs-7 fw-semibold text-gray-500">Select the tax calculation type to your company</span>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="npwp">
            <span class=fw-bold">NPWP</span>
        </label>
        <input type="text" value="{{ $user->userTax->npwp ?? old('npwp') }}" class="form-control form-control-solid"
            placeholder="00.000.000.0-000.000" name="npwp" id="npwp"
            @cannot('HC:update-profile') disabled @endcannot>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="pktp">
            <span class="required fw-bold">PTKP Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="pktp" required name="pktp"
            id="pktp" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->userTax->pktp_status ?? old('pktp')) == null)
                <option value="" selected hidden disabled>Select PTKP Status</option>
            @endif
            @foreach ($constants->pktp as $pktp)
                <option value="{{ $pktp }}" @if (($user->userTax->pktp_status ?? old('pktp')) == $pktp) selected @endif>
                    {{ $pktp }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_method">
            <span class="fw-bold">TAX Method</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="tax_method" name="tax_method"
            id="tax_method" @cannot('HC:update-profile') disabled @endcannot>
            @foreach ($constants->tax_method as $tax_method)
                <option value="{{ $tax_method }}" @if (($user->userTax->tax_method ?? old('tax_method')) == $tax_method) selected @endif>
                    {{ $tax_method }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_salary">
            <span class="fw-bold">Tax Salary</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="tax_salary" name="tax_salary"
            id="tax_salary" @cannot('HC:update-profile') disabled @endcannot>
            @foreach ($constants->tax_salary as $tax_salary)
                <option value="{{ $tax_salary }}" @if (($user->userTax->tax_salary ?? old('tax_salary')) == $tax_salary) selected @endif>
                    {{ $tax_salary }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="taxable_date">
            <span class=fw-bold">Taxable Date</span>
        </label>
        <input type="date" value="{{ $user->userTax->taxable_date ?? old('taxable_date') }}"
            class="form-control form-control-solid" placeholder="Select Date" name="taxable_date" id="taxable_date"
            @cannot('HC:update-profile') disabled @endcannot>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_status_id">
            <span class="fw-bold">Employment TAX Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="tax_status_id" name="tax_status_id"
            id="tax_status_id" @cannot('HC:update-profile') disabled @endcannot>
            @foreach ($dataTaxStatus as $option)
                <option value="{{ $option->id }}" @if ($user->userTax->tax_status_id ?? old('tax_status_id') == $option->id) selected @endif>
                    {{ $option->name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="beginning_netto">
            <span class="fw-bold">Beginning Netto</span>
        </label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
            </div>
            <input type="number" value="{{ $user->userTax->beginning_netto ?? old('beginning_netto') }}"
                class="form-control form-control-solid" placeholder="0" name="beginning_netto" id="beginning_netto"
                @cannot('HC:update-profile') disabled @endcannot>
        </div>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="pph21_paid">
            <span class="fw-bold">PPH21 Paid</span>
        </label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
            </div>
            <input type="number" value="{{ $user->userTax->pph21_paid ?? old('pph21_paid') }}"
                class="form-control form-control-solid" placeholder="0" name="pph21_paid" id="pph21_paid"
                @cannot('HC:update-profile') disabled @endcannot>
        </div>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
