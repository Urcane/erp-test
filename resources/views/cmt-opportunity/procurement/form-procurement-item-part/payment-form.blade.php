<div class="row">
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="nominal">
            <span class="required fw-bold">Nominal</span>
        </label>
        <input type="number" id="nominal" value="" class="form-control form-control-solid" @if ($required) required @endif name="nominal">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="payment_date">
            <span class="required fw-bold">Payment Date</span>
        </label>
        <input type="date" id="payment_date" value="" class="form-control form-control-solid" @if ($required) required @endif name="payment_date">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="payment_method">
            <span class="required fw-bold">Payment Method</span>
        </label>
        <input type="text" id="payment_method" value="" class="form-control form-control-solid" @if ($required) required @endif name="payment_method">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="file">
            <span class="required fw-bold">Payment Recipe</span>
        </label>
        <input type="file" id="file" class="form-control form-control-solid" @if ($required) required @endif name="file">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</div>
