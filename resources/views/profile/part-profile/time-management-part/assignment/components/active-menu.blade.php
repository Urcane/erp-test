<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <a href="{{ route('req.assignment.detail', ['id' => $query->id]) }}" class="dropdown-item py-2">
            <i class="fa-solid fa-eye me-3"></i>
            View
        </a>
    </li>
</ul>
