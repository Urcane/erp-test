<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <div
            onclick='onDetailButtonClick({
        checkIn: {
            time: "{{ $checkIn }}",
            lattitude: "{{ $userAttendances->check_in_latitude ?? "" }}",
            longitude: "{{ $userAttendances->check_in_longitude ?? "" }}",
            file: "{{ $userAttendances->check_in_file ? asset("storage/attendance/checkin/$userAttendances->check_in_file") : "#" }}"
        },
        checkOut: {
            time: "{{ $checkOut }}",
            lattitude: "{{ $userAttendances->check_out_latitude ?? "" }}",
            longitude: "{{ $userAttendances->check_out_longitude ?? "" }}",
            file: "{{ $userAttendances->check_out_file ? asset("storage/attendance/checkout/$userAttendances->check_out_file") : "#" }}"
        },
        shift: "{{ $userAttendances->shift_name ?? "-" }}",
        attendanceCode: "{{ $attendanceCode }}"
    })'>
            <a href="#detail_attendance" class="dropdown-item py-2" data-bs-toggle="modal">
                <i class="fa-solid fa-eye me-3"></i>
                View
            </a>
        </div>
    </li>
    @can('HC:edit-delete-attendance')
        <li>
            <div
                onclick="onEditButtonClick({
            id: {{ $userAttendances->id }},
            name: '{{ $userAttendances->user->name }}',
            date: '{{ $userAttendances->date }}',
            checkIn: '{{ $checkIn }}',
            checkOut: '{{ $checkOut }}',
        })">
                <a href="#attendance_edit_modal" class="dropdown-item py-2" data-bs-toggle="modal">
                    <i class="fa-solid fa-pencil me-3"></i>
                    Edit
                </a>
            </div>
        </li>
        <li>
            <div
                onclick="onDeleteButtonClick({
            id: {{ $userAttendances->id }},
            name: '{{ $userAttendances->user->name }}',
            date: '{{ $userAttendances->date }}',
            checkIn: '{{ $checkIn }}',
            checkOut: '{{ $checkOut }}',
        })">
                <a href="#attendance_delete_modal" class="dropdown-item py-2" data-bs-toggle="modal">
                    <i class="fa-solid fa-trash me-3"></i>
                    Hapus
                </a>
            </div>
        </li>
    @endcan
</ul>
