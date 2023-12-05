<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end"
    data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu">
    <li>
        <a href="{{ route('opt.asign.detail', ['id' => $query->id]) }}" class="dropdown-item py-2">
            <i class="fa-solid fa-eye me-3"></i>
            View
        </a>
        @if ($query->user_id == Auth::user()->id && $query->status == $statusEnum[0])
            <a href="{{ route('req.assignment.edit', ['id' => $query->id]) }}" class="dropdown-item py-2">
                <i class="fa-solid fa-pencil me-3"></i>
                Edit
            </a>
        @endif
        @if ($query->user_id == Auth::user()->id && $query->status == $statusEnum[0])
            <button onclick="cancelRequest({{ $query->id }})" class="dropdown-item py-2">
                <i class="fa-solid fa-ban me-3"></i>
                Cancel
            </button>
        @endif
    </li>
</ul>
