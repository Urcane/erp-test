<div class="col-lg-12 mt-3 mb-9">
    <span class="fs-3 fw-bold text-dark d-block mb-1">Setting Leave Quota</span>
</div>

<div class="col-lg-12" id="sett-info">
    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Received Quota</span>
        </label>
        <div class="form-control form-control-solid">
            {{ $leaveSetting->quotas }}
        </div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Minimum Works (Months)</span>
        </label>
        <div class="form-control form-control-solid">
            {{ $leaveSetting->min_works }} Months
        </div>
    </div>

    <div class="col-lg-12 mb-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Expired (Months)</span>
        </label>
        <div class="form-control form-control-solid">
            {{ $leaveSetting->expired }} Months
        </div>
    </div>

    <div class="col-lg-12 mb-3 d-flex justify-content-end">
        <button id="sett-editbtn" class="btn btn-sm btn-info px-10">Edit</button>
    </div>
</div>

<div class="col-lg-12" id="sett-edit">
    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Received Quota</span>
        </label>
        <input type="number" min="0" max="100" class="form-control form-control-solid border border-info" required
            name="quotas" value="{{ $leaveSetting->quotas }}">
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Minimum Works (Months)</span>
        </label>
        <input type="number" min="0" max="100" class="form-control form-control-solid border border-info" required
            name="min_works" value="{{ $leaveSetting->min_works }}">
    </div>

    <div class="col-lg-12 mb-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Expired (Months)</span>
        </label>
        <input type="number" min="6" max="24" class="form-control form-control-solid border border-info" required
            name="expired" value="{{ $leaveSetting->expired }}">
    </div>

    <div class="col-lg-12 mb-3 d-flex justify-content-end">
        <button id="sett-cancelbtn" class="btn btn-outline btn-sm btn-outline-danger px-10 me-4">Cancel</button>
        <button id="sett-confirmbtn" class="btn btn-sm btn-success px-10">Confirm</button>
    </div>
</div>
