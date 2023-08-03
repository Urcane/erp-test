
<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Tax Configuration</h4>
        <span class="fs-7 fw-semibold text-gray-500">Select the tax calculation type to your company</span>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="npwp">
            <span class= fw-bold">NPWP</span>
        </label>
        <input type="text" value="{{$user->userTax->npwp ?? ""}}" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}.[0-9]{1}-[0-9]{3}.[0-9]{3}" class="form-control form-control-solid" placeholder="00.000.000.0-000.000" name="npwp" id="npwp" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ptkp_status">
            <span class="required fw-bold">PTKP Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="ptkp_status" required name="ptkp_status" id="ptkp_status" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select PTKP Status</option>
            <option value="PTKP Status 1" >PTKP Status 1</option>
            <option value="PTKP Status 2" >PTKP Status 2</option>
            <option value="PTKP Status 3" >PTKP Status 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_method">
            <span class="fw-bold">TAX Method</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="tax_method" name="tax_method" id="tax_method" @unlessrole("administrator") disabled @endunlessrole>
            <option value="TAX Method 1" >Gross</option>
            <option value="TAX Method 2" >TAX Method 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_salary">
            <span class="fw-bold">Tax Salary</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="tax_salary" name="tax_salary" id="tax_salary" @unlessrole("administrator") disabled @endunlessrole>
            <option value="Tax Salary 1" >Tax Salary 1</option>
            <option value="Tax Salary 2" >Taxable</option>
            <option value="Tax Salary 3" >Tax Salary 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="taxable_date">
            <span class= fw-bold">Taxable Date</span>
        </label>
        <input type="date" value="{{$user->userTax->taxable_date ?? ""}}" class="form-control form-control-solid" placeholder="Select Date" name="taxable_date" id="taxable_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ptkp_status">
            <span class="fw-bold">Employment TAX Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="ptkp_status" name="ptkp_status" id="ptkp_status" @unlessrole("administrator") disabled @endunlessrole>
            <option value="Pegawai Tetap" >Pegawai Tetap</option>
            <option value="Pegawai Sementara" >Pegawai Sementara</option>
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
            <input type="number" value="{{$user->userTax->beginning_netto ?? ""}}" class="form-control form-control-solid" placeholder="0" name="beginning_netto" id="beginning_netto" @unlessrole("administrator") disabled @endunlessrole>
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
            <input type="number" value="{{$user->userTax->pph21_paid ?? ""}}" class="form-control form-control-solid" placeholder="0" name="pph21_paid" id="pph21_paid" @unlessrole("administrator") disabled @endunlessrole>
        </div>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
