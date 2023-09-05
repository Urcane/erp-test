<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
<ul class="dropdown-menu">
    <li>
        <a href="#shift_info_modal" class="dropdown-item py-2 cancel" data-bs-toggle="modal"
                onclick="onShiftModalOpen({
                    id: '{{$query->id}}',
                    currshift: '{{$shift}}',
                    currwork: '{{$workHour}}',
                    created: '{{$query->created_at}}',
                    date: '{{$query->date}}',
                    newshift: '{{$query->workingShift->name}}',
                    newwork: '{{$query->workingShift->working_start}} - {{$query->workingShift->working_end}}',
                    notes: '{{$query->notes ?? '-'}}',
                    status: '{{$query->status}}',
                    changed: '{{$shiftChanged}}',
                    prmshift: '{{$prmshift}}',
                    prmworkHour: '{{$prmworkHour}}'
            })">
            <i class="fa-solid fa-eye me-3"></i>
            View
        </a>
    </li>
</ul>
