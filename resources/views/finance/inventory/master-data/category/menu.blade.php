<a href="#edit_category_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onCategoryModalOpen({
        id: '{{$query->id}}',
        name: '{{$query->name}}',
        description: '{{$query->description}}',
        code_name: '{{$query->code_name}}',
    })">
    <i class="fa-solid fa-pen-to-square"></i> Edit
</a>
