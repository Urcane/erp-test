<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Employment Data</h4>
        <span class="fs-7 fw-semibold text-gray-500">All employment data information relate to company</span>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="employee_id">
            <span class="required fw-bold">Employee ID</span>
        </label>
        <input type="text" value="{{ $user->userEmployment->employee_id ?? old('employee_id') }}"
            class="form-control form-control-solid" name="employee_id" required placeholder="Employee ID"
            @cannot('HC:update-profile') disabled @endcannot>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Employment Status</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="employment_status_id" required id="employment_status_id"
            name="employment_status_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->userEmployment->employment_status_id ?? '') == '' && old('employment_status_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataEmploymentStatus as $option)
                <option value="{{ $option->id }}" data-end="{{$option->have_end_date}}" @if (($user->userEmployment->employment_status_id ?? old('employment_status_id')) == $option->id) selected @endif>
                    {{ $option->name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="join_date">
            <span class="required fw-bold">Join Date</span>
        </label>
        <input type="date" value="{{ $user->userEmployment->join_date ?? old('join_date') }}"
            class="form-control form-control-solid" required name="join_date" id="join_date"
            @cannot('HC:update-profile') disabled @endcannot>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="end_date">
            <span class="fw-bold" id="end_date_label">End Status Date</span>
        </label>
        <input type="date" value="{{ $user->userEmployment->end_date ?? old('end_date') }}"
            class="form-control form-control-solid" name="end_date" id="end_date"
            @cannot('HC:update-profile') disabled @endcannot>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="team_id">
            <span class="required fw-bold">Team</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="team_id" required name="team_id"
            id="team_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->team_id ?? '') == '' && old('team_id') == null)
                <option value="" selected hidden disabled>Select employment team</option>
            @endif
            @foreach ($dataTeam as $option)
                <option value="{{ $option->id }}" @if (($user->team_id ?? old('team_id')) == $option->id) selected @endif>
                    {{ $option->team_name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="sub_branch_id">
            <span class="required fw-bold">Branch</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="sub_branch_id" required
            name="sub_branch_id" id="sub_branch_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->userEmployment->sub_branch_id ?? '') == '' && old('sub_branch_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataSubBranch as $option)
                <option value="{{ $option->id }}" @if (($user->userEmployment->sub_branch_id ?? old('sub_branch_id')) == $option->id) selected @endif>
                    {{ $option->name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="department_id">
            <span class="required fw-bold">Organization</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="department_id" required
            name="department_id" id="department_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->department_id ?? '') == '' && old('department_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataDepartment as $option)
                <option value="{{ $option->id }}" @if (($user->department_id ?? old('department_id')) == $option->id) selected @endif>
                    {{ $option->department_name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="division_id">
            <span class="required fw-bold">Job Position</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="division_id" required name="division_id"
            id="division_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->division_id ?? '') == '' && old('division_id') == null)
                <option value="" selected hidden disabled>Select employment status</option>
            @endif
            @foreach ($dataDivision as $option)
                <option value="{{ $option->id }}" @if (($user->division_id ?? old('division_id')) == $option->name) selected @endif>
                    {{ $option->divisi_name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="role_id">
            <span class="required fw-bold">Job Level</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="role_id" required name="role_id"
            id="role_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user ?? '') == '' && old('role_id') == null)
                <option value="" selected hidden disabled>Select job level</option>
            @endif
            @foreach ($dataRole as $option)
                <option value="{{ $option->id }}" @if ((!is_null($user) && $user->getRoleNames()[0] == $option->name) || old('role_id') == $option->id) selected @endif>
                    {{ $option->name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="working_schedule_id">
            <span class="required fw-bold">Schedule</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="working_schedule_id" required
            name="working_schedule_id" id="working_schedule_id" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->userEmployment->workingSchedule->name ?? old('working_schedule_id')) == null)
                <option value="" selected hidden disabled>Select job level</option>
            @endif
            @foreach ($dataWorkingSchedule as $option)
                <option value="{{ $option->id }}" @if (($user->userEmployment->working_schedule_id ?? old('working_schedule_id')) == $option->id) selected @endif>
                    {{ $option->name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-12 row mb-3 ps-6" id="scheduleShift">

    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="approval_line">
            <span class="required fw-bold">Approval Line</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="approval_line"
            name="approval_line" id="approval_line" @cannot('HC:update-profile') disabled @endcannot>
            @if (($user->userEmployment->approval_line ?? old('approval_line')) == null)
                <option value="" selected hidden disabled>Select Approval Line</option>
            @endif
            @foreach ($users as $approval_line)
                <option value="{{ $approval_line->id }}" @if (($user->userEmployment->approval_line ?? old('approval_line')) == $approval_line->id) selected @endif>
                    {{ $approval_line->name }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="barcode">
            <span class="fw-bold">Barcode</span>
        </label>
        <input type="text" class="form-control form-control-solid"
            value="{{ $user->userEmployment->barcode ?? old('barcode') }}" placeholder="barcode" name="barcode"
            id="barcode" @cannot('HC:update-profile') disabled @endcannot>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>

<script>
    $("#employment_status_id").change(function() {
        console.log($(this).find(':selected').data('end'));
        $("#end_date").prop('required', $(this).find(':selected').data('end') == 1);
        $(this).find(':selected').data('end') == 1 ? $("#end_date_label").addClass('required') : $("#end_date_label").removeClass('required')
    })

    $("#working_schedule_id").change(function() {
        const working_schedule_id = $(this).val()
        $.ajax({
            url: "{{ route('hc.emp.get.schedule.shift') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            data: {
                working_schedule_id: working_schedule_id
            },
            success: function(data) {
                $("#scheduleShift").empty();
                $("#scheduleShift").append(`
                <label class="d-flex align-items-center fs-6 form-label mb-2">
                    <span class="required fw-bold">Start Shift</span>
                </label>
                `);
                const workingScheduleShift = data.workingScheduleShift.map(function(data) {
                    const shift = data.working_shift;
                    $("#scheduleShift").append(`
                        <div class="form-check col-lg-3 col-md-4 mb-3">
                            <input class="form-check-input" type="radio" name="start_shift" value="${data.id}" required>
                            <label class="form-check-label" for="flexRadioDefault1">
                            ${shift.name}, ${(shift.working_start ?? "").split(":").slice(0, 2).join(":")} - ${(shift.working_end ?? "").split(":").slice(0, 2).join(":")}
                            </label>
                        </div>
                    `)
                })

            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });

    $(document).ready(function() {
        console.log($("#employment_status_id").find(':selected').data('end'));
        $("#end_date").prop('required', $("#employment_status_id").find(':selected').data('end') == 1);
        $("#employment_status_id").find(':selected').data('end') == 1 ? $("#end_date_label").addClass('required') : $("#end_date_label").removeClass('required')


        const working_schedule_id = $("#working_schedule_id").val()
        $.ajax({
            url: "{{ route('hc.emp.get.schedule.shift') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            data: {
                working_schedule_id: working_schedule_id
            },
            success: function(data) {
                if ("{{$user->userEmployment->start_shift ?? ""}}" != "") {
                    console.log(data);
                    $("#scheduleShift").empty();
                    $("#scheduleShift").append(`
                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                        <span class="required fw-bold">Start Shift</span>
                    </label>
                    `);
                    const workingScheduleShift = data.workingScheduleShift.map(function(data) {
                            const shift = data.working_shift;
                            const checked = "{{$user->userEmployment->start_shift ?? ""}}" == data.id ? "checked" : ""
                            $("#scheduleShift").append(`
                            <div class="form-check col-lg-3 col-md-4 mb-3">
                                <input class="form-check-input" type="radio" name="start_shift" value="${data.id}" required ${checked}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                    ${shift.name}, ${(shift.working_start ?? "").split(":").slice(0, 2).join(":")} - ${(shift.working_end ?? "").split(":").slice(0, 2).join(":")}
                                    </label>
                                </div>
                            `)
                    })

                }
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    })
</script>
