<a href="#edit_warehouse_modal" class="btn btn-sm btn-outline btn-outline-info d-inline-flex align-items-center"
    data-bs-toggle="modal" onclick="onWarehouseModalOpen({
        id: '{{$query->id}}',
        name: '{{$query->name}}',
        latitude: '{{$query->latitude}}',
        longitude: '{{$query->longitude}}'
    })">
    <i class="fa-solid fa-pen-to-square"></i> Edit
</a>
