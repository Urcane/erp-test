@can('FIN:crud-masterdata-inventory')
    <a href="#edit_unit_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
        data-bs-toggle="modal"
        onclick="onUnitModalOpen({
        id: '{{ $query->id }}',
        name: '{{ $query->name }}',
        code: '{{ $query->code }}'
    })">
        <i class="fa-solid fa-pen-to-square"></i> Edit
    </a>
@else
    <div class="btn btn-sm btn-outline btn-outline-muted d-inline-flex align-items-center cursor-not-allowed">
        <i class="fa-solid fa-pen-to-square"></i> Edit
    </div>
@endcan
