<div class="row p-6 m-1 rounded border border-2 border-secondary">
    <div class="d-grid">
        <ul class="nav nav-tabs flex-nowrap text-nowrap">
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="attendance" href="#attendance_content">Attendance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="shift" href="#shift_content">Shift</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0" data-bs-toggle="tab" id="time_off" href="#time_off_content">Time Off</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-danger rounded-bottom-0" data-bs-toggle="tab" id="assignment" href="#assignment_content">Assignment</a>
            </li>
        </ul>
    </div>
    <div class="tab-content mt-5" id="myTabContent">

        @include('profile.part-profile.time-management-part.attendance.index')

        @include('profile.part-profile.time-management-part.shift.index')

        @include('profile.part-profile.time-management-part.timeoff.index')

        @include('profile.part-profile.time-management-part.assignment.index')

    </div>
</div>

<script>
    const formatDate = (date) => {
        const [year, month, day] = date.split("-");
        return `${day}/${month}/${year}`;
    }

    const formatDateTime = (dateTime) => {
        return dateTime === "-" ? "-" : dateTime.replace(" ", " at ");
    }

    const approveStatusEnum = @json($constants->approve_status);
</script>
