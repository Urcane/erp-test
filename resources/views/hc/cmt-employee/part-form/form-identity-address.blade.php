<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Identity & Address</h4>
        <span class="fs-7 fw-semibold text-gray-500">Employee identity address information</span>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Identity Type</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="indentity_type" name="indentity_type">
            <option value="" selected hidden disabled>Identity Type</option>
            <option value="Type 1" >Type 1</option>
            <option value="Type 2" >Type 2</option>
            <option value="TYpe 3" >TYpe 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Identity Number</span>
        </label>
        <input type="number" value="{{$user->userIdentity->number ?? "" }}" class="form-control form-control-solid" placeholder="Identity Number" name="identity_number">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Identity Expiry Date</span>
        </label>
        <input type="date" value="{{$user->userIdentity->expire_date ?? "" }}"class="form-control form-control-solid" placeholder="Select Date" name="identity_expiry_date">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Postal Code</span>
        </label>
        <input type="number" value="{{$user->userIdentity->postal_code ?? "" }}"class="form-control form-control-solid" placeholder="Postal Code" name="postal_code">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="permanent" id="permanent">
        <label class="fs-6 form-check-label mb-2" for="permanent">
            <span class="fw-bold">Permanent</span>
        </label>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="citizen_id_address">
            <span class="fw-bold">Citizen ID Address</span>
        </label>
        <textarea name="citizen_id_address" id="citizen_id_address" class="form-control form-control-solid" placeholder="Citizen ID Address">{{$user->userIdentity->citizen_id_address ?? "" }}</textarea>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="use_as_residential" id="use_as_residential">
        <label class="fs-6 form-check-label mb-2" for="use_as_residential">
            <span class="fw-bold">Use as residential address</span>
        </label>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="residential_address">
            <span class="fw-bold">Residential Address</span>
        </label>
        <textarea name="residential_address" id="residential_address" class="form-control form-control-solid" placeholder="Residential Address">{{$user->userIdentity->residential_address ?? "" }}</textarea>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

</section>
