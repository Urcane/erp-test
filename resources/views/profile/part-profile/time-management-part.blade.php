<div class="row p-6 m-1 rounded border border-2 border-secondary">
    <div class="d-grid">
        <ul class="nav nav-tabs flex-nowrap text-nowrap">
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="attendance" href="#attendance_content">Attendance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="shift" href="#shift_content">Shift</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="overtime" href="#overtime_content">Overtime</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="time_off" href="#time_off_content">Time Off</a>
            </li>
        </ul>
    </div>
    <div class="tab-content mt-5" id="myTabContent">

        @include('profile.part-profile.time-management-part.attendance')

        @include('profile.part-profile.time-management-part.shift')

        {{-- @include('profile.part-profile.time-management-part.overtime') --}}

        @include('profile.part-profile.time-management-part.time-off')

    </div>
</div>
