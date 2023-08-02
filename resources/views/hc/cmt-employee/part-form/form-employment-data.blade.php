<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Employment Data</h4>
        <span class="fs-7 fw-semibold text-gray-500">All employment data information relate to company</span>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="employee_id">
            <span class="required fw-bold">Employee ID</span>
        </label>
        <input type="text" value="{{$user->userEmployment->employee_id ?? ""}}" class="form-control form-control-solid" name="employee_id" required placeholder="Employee ID" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Employment Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="employment_status" required name="employment_status" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Employment Status</option>
            <option value="Status 1" >Status 1</option>
            <option value="Status 2" >Status 2</option>
            <option value="Status 3" >Status 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="join_date">
            <span class="required fw-bold">Join Date</span>
        </label>
        <input type="date" value="{{$user->userEmployment->join_date ?? ""}}" class="form-control form-control-solid" required name="join_date" id="join_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="end_status_date">
            <span class="required fw-bold">End Status Date</span>
        </label>
        <input type="date" value="{{$user->userEmployment->end_date ?? ""}}" class="form-control form-control-solid" required name="end_status_date" id="end_status_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="branch">
            <span class="required fw-bold">Branch</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="branch" required name="branch" id="branch" @unlessrole("administrator") disabled @endunlessrole>
            <option value="Pusat" >Pusat</option>
            <option value="Cabang" >Cabang</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="organization">
            <span class="required fw-bold">Organization</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="organization" required name="organization" id="organization" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Organization</option>
            <option value="Organization 1" >Organization 1</option>
            <option value="Organization 2" >Organization 2</option>
            <option value="Organization 3" >Organization 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="job_position">
            <span class="required fw-bold">Job Position</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="job_position" required name="job_position" id="job_position" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Job Position</option>
            <option value="Job Position 1" >Job Position 1</option>
            <option value="Job Position 2" >Job Position 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="job_level">
            <span class="required fw-bold">Job Level</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="job_level" required name="job_level" id="job_level" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Job Level</option>
            <option value="Job Level 1" >Job Level 1</option>
            <option value="Job Level 2" >Job Level 2</option>
            <option value="Job Level 3" >Job Level 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="grade">
            <span class="required fw-bold">Grade</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="grade" required name="grade" id="grade" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Grade</option>
            <option value="Grade 1" >Grade 1</option>
            <option value="Grade 2" >Grade 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="class">
            <span class="required fw-bold">Class</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="class" required name="class" id="class" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Class</option>
            <option value="Class 1" >Class 1</option>
            <option value="Class 2" >Class 2</option>
            <option value="Class 3" >Class 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="schedule">
            <span class="required fw-bold">Schedule</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="schedule" required name="schedule" id="schedule" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Schedule</option>
            <option value="Schedule 1" >Schedule 1</option>
            <option value="Schedule 2" >Schedule 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="approval_line">
            <span class="required fw-bold">Approval Line</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="approval_line" required name="approval_line" id="approval_line" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select Approval Line</option>
            <option value="Approval Line 1" >Approval Line 1</option>
            <option value="Approval Line 2" >Approval Line 2</option>
            <option value="Approval Line 3" >Approval Line 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="Barcode">
            <span class="fw-bold">Barcode</span>
        </label>
        <input type="text" class="form-control form-control-solid" value="{{$user->userEmployment->barcode ?? ""}}" placeholder="Barcode" name="Barcode" id="Barcode" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
