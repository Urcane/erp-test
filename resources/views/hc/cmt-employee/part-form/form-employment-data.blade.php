<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Employment Data</h4>
        <span class="fs-7 fw-semibold text-gray-500">All employment data information relate to company</span>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="employee_id">
            <span class="required fw-bold">Employee ID</span>
        </label>
        <input type="text" value="{{$user->userEmployment->employee_id ?? old('employee_id') }}" class="form-control form-control-solid" name="employee_id" required placeholder="Employee ID" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Employment Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="employment_status_id" required name="employment_status_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userEmployment->employment_status_id ?? "") == "" && old('employment_status_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataEmploymentStatus as $option)
                <option value="{{$option->id}}" @if (($user->userEmployment->employment_status_id ?? old('employment_status_id')) == $option->id) selected @endif>{{$option->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="join_date">
            <span class="required fw-bold">Join Date</span>
        </label>
        <input type="date" value="{{$user->userEmployment->join_date ?? old('join_date') }}" class="form-control form-control-solid" required name="join_date" id="join_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="end_date">
            <span class="required fw-bold">End Status Date</span>
        </label>
        <input type="date" value="{{$user->userEmployment->end_date ?? old('end_date') }}" class="form-control form-control-solid" required name="end_date" id="end_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="team_id">
            <span class="required fw-bold">Team</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="team_id" required name="team_id" id="team_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->team_id ?? "") == "" && old('team_id') == null)
                <option value="" selected hidden disabled>Select employment team</option>
            @endif
            @foreach ($dataTeam as $option)
                <option value="{{$option->id}}" @if (($user->team_id ?? old('team_id')) == $option->id) selected @endif>{{$option->team_name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="branch_id">
            <span class="required fw-bold">Branch</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="branch_id" required name="branch_id" id="branch_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userEmployment->branch_id ?? "") == "" && old('branch_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataBranch as $option)
                <option value="{{$option->id}}" @if (($user->userEmployment->branch_id ?? old('branch_id')) == $option->id) selected @endif>{{$option->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="department_id">
            <span class="required fw-bold">Organization</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="department_id" required name="department_id" id="department_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->department_id ?? "") == "" && old('department_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataDepartment as $option)
                <option value="{{$option->id}}" @if (($user->department_id ?? old('department_id')) == $option->id) selected @endif>{{$option->department_name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="division_id">
            <span class="required fw-bold">Job Position</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="division_id" required name="division_id" id="division_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->division_id ?? "") == "" && old('division_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataDivision as $option)
                <option value="{{$option->id}}" @if (($user->division_id ?? old('division_id')) == $option->name) selected @endif>{{$option->divisi_name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="role_id">
            <span class="required fw-bold">Job Level</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="role_id" required name="role_id" id="role_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user ?? "") == "" && old('role_id') == null)
                <option value="" selected hidden disabled>Select job level</option>
            @endif
            @foreach ($dataRole as $option)
                <option value="{{$option->id}}" @if (!is_null($user) && $user->getRoleNames()[0] == $option->name || old('role_id') == $option->id) selected @endif>{{$option->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="grade">
            <span class="required fw-bold">Grade</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="grade" required name="grade" id="grade" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userEmployment->grade ?? old('grade')) == null)
            <option value="" selected hidden disabled>Select Grade</option>
            @endif
            @foreach ($allOptions->grade as $grade)
                <option value="{{$grade}}" @if (($user->userEmployment->grade ?? old('grade')) == $grade) selected @endif>{{$grade}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="class">
            <span class="required fw-bold">Class</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="class" required name="class" id="class" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userEmployment->class ?? old('class')) == null)
            <option value="" selected hidden disabled>Select Class</option>
            @endif
            @foreach ($allOptions->class as $class)
                <option value="{{$class}}" @if (($user->userEmployment->class ?? old('class')) == $class) selected @endif>{{$class}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="working_schedule_id">
            <span class="required fw-bold">Schedule</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="working_schedule_id" required name="working_schedule_id" id="working_schedule_id" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userEmployment->workingSchedule->name ?? old('working_schedule_id')) == null)
                <option value="" selected hidden disabled>Select job level</option>
            @endif
            @foreach ($dataWorkingSchedule as $option)
                <option value="{{$option->id}}" @if (($user->userEmployment->working_schedule_id ?? old('working_schedule_id')) == $option->id) selected @endif>{{$option->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="approval_line">
            <span class="required fw-bold">Approval Line</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="approval_line" required name="approval_line" id="approval_line" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userEmployment->approval_line ?? old('approval_line')) == null)
            <option value="" selected hidden disabled>Select Approval Line</option>
            @endif
            @foreach ($users as $approval_line)
                <option value="{{$approval_line->id}}" @if (($user->userEmployment->approval_line ?? old('approval_line')) == $approval_line->id) selected @endif>{{$approval_line->name}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="barcode">
            <span class="fw-bold">Barcode</span>
        </label>
        <input type="text" class="form-control form-control-solid" value="{{$user->userEmployment->barcode ?? old('barcode') }}" placeholder="barcode" name="barcode" id="barcode" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
