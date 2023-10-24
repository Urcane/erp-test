<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <div
            onclick="onEditModalOpen({
            id: '{{ $query->id }}',
            name: '{{ $query->name }}',
            start_date: '{{ $query->start_date }}',
            end_date: '{{ $query->end_date }}',
        })">
            <a href="#modal_edit_holiday" data-bs-toggle="modal" class="dropdown-item py-2">
                <i class="fa-solid fa-pen me-3"></i>
                Edit
            </a>
        </div>
    </li>
    <li>
        <div
            onclick="onDeleteModalOpen({
            id: '{{ $query->id }}',
            name: '{{ $query->name }}',
            start_date: '{{ $query->start_date }}',
            end_date: '{{ $query->end_date }}',
        })">
            <a href="#modal_delete_holiday" data-bs-toggle="modal" class="dropdown-item py-2">
                <i class="fa-solid fa-trash me-3"></i>
                Delete
            </a>
        </div>
    </li>
</ul>
