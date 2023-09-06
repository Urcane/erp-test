<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
<ul class="dropdown-menu">
    <li>
        <a href="#attendances_info_modal" class="dropdown-item py-2 cancel" data-bs-toggle="modal"
            onclick="onAttendanceModalOpen({
                id: '{{$query->id}}',
                shift: '{{$shift}}',
                work: '{{$workHour}}',
                created: '{{$query->created_at}}',
                checkin: '{{$query->check_in ?? '-'}}',
                checkout: '{{$query->check_out ?? '-'}}',
                notes: '{{$query->notes ?? '-'}}',
                status: '{{$query->status}}',
                fileName: '{{$fileName ?? '-'}}',
                fileLink: '{{$fileLink}}',
                comment: '{{$query->comment}}'
        })">
            <i class="fa-solid fa-eye me-3"></i>
            View
        </a>
    </li>
</ul>
