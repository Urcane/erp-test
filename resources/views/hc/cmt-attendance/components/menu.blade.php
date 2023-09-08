<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li><a href="{{ route('hc.att.detail', ['id' => $userAttendances->user->id]) }}" class="dropdown-item py-2">
            <i class="fa-solid fa-eye me-3"></i>Detail</a>
    </li>
    @cannot('HC:edit-delete-attendance')
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
                    <i class="fa-solid fa-pencil me-3"></i>Edit</a>
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
                    <i class="fa-solid fa-trash me-3"></i>Hapus</a>
            </div>
        </li>
    @endcannot
</ul>
