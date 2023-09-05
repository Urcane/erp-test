<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
<ul class="dropdown-menu">
    <li>
        <a href="#timeoff_info_modal" class="dropdown-item py-2 cancel" data-bs-toggle="modal"
                onclick="onTimeOffModalOpen({
                    id: '{{$query->id}}',
                    taken: '{{$query->taken}}',
                    file: '{{$query->file}}',
                    type: '{{$query->leaveRequestCategory->name}} ({{$query->leaveRequestCategory->code}})',
                    created: '{{$query->created_at}}',
                    notes: '{{$query->notes ?? '-'}}',
                    status: '{{$query->status}}',
                    startDate: '{{$query->start_date}}',
                    endDate: '{{$query->end_date}}',
                    fileName: '{{$fileName}}',
                    fileLink: '{{$fileLink}}'
                })">
            <i class="fa-solid fa-eye me-3"></i>
            View
        </a>
    </li>
</ul>
