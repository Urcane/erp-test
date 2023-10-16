<a href="#edit_item_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onItemModalOpen({
        id: '{{$query->id}}',
        good_category_id: '{{$query->good_category_id}}',
        good_name: '{{$query->good_name}}',
        good_type: '{{$query->good_type}}',
        code_name: '{{$query->code_name}}',
        spesification: '{{$query->spesification}}',
        merk: '{{$query->merk}}',
        description: '{{$query->description}}',
    })">
    <i class="fa-solid fa-pen-to-square"></i> Edit
</a>
