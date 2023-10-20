<a href="{{ $params }}" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onTimeOffModalOpen({
        id: '{{$query->id}}',
        name: '{{$query->user->name}}',
        nip: '{{$query->user->userEmployment->employee_id}}',
        branch: '{{$query->user->userEmployment->subBranch->name}}',
        org: '{{$query->user->department->department_name}}',
        position: '{{$query->user->division->divisi_name}}',
        level: '{{$query->user->getRoleNames()->first()}}',
        taken: '{{$query->taken}}',
        file: '{{$query->file}}',
        created: '{{$query->created_at}}',
        notes: '{{$query->notes ?? '-'}}',
        status: '{{$query->status}}',
        startDate: '{{$query->start_date}}',
        endDate: '{{$query->end_date}}',
        date: '{{$query->date}}',
        fileName: '{{$fileName ?? '-'}}',
        fileLink: '{{$fileLink}}',
        comment: '{{$query->comment}}',
        leaveRequestCategory: {
            name: '{{$query->leaveRequestCategory->name}}',
            useQuota: '{{$query->leaveRequestCategory->use_quota}}',
            halfday: '{{$query->leaveRequestCategory->half_day}}',
            code: '{{$query->leaveRequestCategory->code}}',
            working: {
                start: '{{$query->working_start ?? '-'}}',
                end: '{{$query->working_end ?? '-'}}',
            }
        }
    })">
    <i class="fas fa-eye mr-1"></i> Details
</a>
