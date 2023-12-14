@can('FIN:crud-masterdata-inventory')
    <a href="#edit_category_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
        data-bs-toggle="modal" onclick="onCategoryModalOpen({
            id: '{{$query->id}}',
            name: '{{$query->name}}',
            description: '{{$query->description}}',
            code_name: '{{$query->code_name}}',
        })">
        <i class="fa-solid fa-pen-to-square"></i> Edit
    </a>
@else
    <div class="btn btn-sm btn-outline btn-outline-muted d-inline-flex align-items-center cursor-not-allowed">
        <i class="fa-solid fa-pen-to-square"></i> Edit
    </div>
@endcan
