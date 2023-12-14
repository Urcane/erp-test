<button class="btn btn-sm btn btn-info d-inline-flex align-items-center"
    onclick="onAddItemClick({
        'id': '{{ $query->id }}',
        'itemName': '{{ $query->warehouseGood->inventoryGood->good_name }}',
        'itemStock': '{{ $query->stock }}',
        'category': '{{ $query->warehouseGood->inventoryGood->inventoryGoodCategory->name }}',
        'unit': '{{ $query->inventoryUnitMaster->code }}',
        'condition': '{{ $query->inventoryGoodCondition->name }}',
        'status': '{{ $query->inventoryGoodStatus->name }}',
    })">
    <i class="fa-solid fa-add"></i> Add
</button>
