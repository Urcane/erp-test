<a href="#edit_quota_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal"
    onclick="onEditQuotaClick({
        id: '{{ $query->id }}',
        quotas: '{{ $query->quotas }}',
        received_at: '{{ $query->received_at }}',
        expired_date: '{{ $query->expired_date }}'
    })">
    <i class="fa-solid fa-pen-to-square"></i> Edit
</a>
