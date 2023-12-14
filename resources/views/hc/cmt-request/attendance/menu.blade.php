<a href="{{ $params }}" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onAttendanceModalOpen({
        id: '{{$query->id}}',
        name: '{{$query->user->name}}',
        nip: '{{$query->user->userEmployment->employee_id}}',
        branch: '{{$query->user->userEmployment->subBranch->name}}',
        org: '{{$query->user->department->department_name}}',
        position: '{{$query->user->division->divisi_name}}',
        level: '{{$query->user->getRoleNames()->first()}}',
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
    <i class="fas fa-eye mr-1"></i> Details
</a>
