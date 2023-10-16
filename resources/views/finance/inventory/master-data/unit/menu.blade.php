<a href="#edit_unit_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onUnitModalOpen({
        id: '{{$query->id}}',
        name: '{{$query->name}}',
        code: '{{$query->code}}'
    })">
    <i class="fa-solid fa-pen-to-square"></i> Edit
</a>
