<a href="{{ $params }}" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onShiftModalOpen({
        id: '{{$query->id}}',
        name: '{{$query->user->name}}',
        nip: '{{$query->user->userEmployment->employee_id}}',
        branch: '{{$query->user->userEmployment->subBranch->name}}',
        org: '{{$query->user->department->department_name}}',
        position: '{{$query->user->division->divisi_name}}',
        level: '{{$query->user->getRoleNames()[0]}}',
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
    <i class="fas fa-eye mr-1"></i> Details
</a>
