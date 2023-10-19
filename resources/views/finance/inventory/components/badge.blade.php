@php
    $class = '';

    switch ($status) {
        case $statusEnum[0]:
            $class = 'badge-light-success';
            break;
        case $statusEnum[1]:
            $class = 'badge-light-primary';
            break;
        case $statusEnum[2]:
            $class = 'badge-light-danger';
            break;
        case $statusEnum[3]:
            $class = 'badge-light-warning';
            break;
    }
@endphp

<span class="badge px-3 py-2 mw-150px {{ $class }}">
    {{ $status }}
</span>
