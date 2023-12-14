<ul
    class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold"
>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.detail', ['work_list_id' => $work_list_id]) ? 'active' : ''}}"
            href="{{route('com.promag.detail', ['work_list_id' => $work_list_id])}}"
        >
            Overview
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.task-lists', ['work_list_id' => $work_list_id]) ? 'active' : ''}}"
            href="{{route('com.promag.task-lists', ['work_list_id' => $work_list_id])}}"
        >
            Task Lists
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route("com.promag.procurement", ['work_list_id' => $work_list_id]) ? 'active' : ''}}""
            href="{{route("com.promag.procurement", ['work_list_id' => $work_list_id])}}"
        >
            Procurement
        </a>
    </li>
    {{-- <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6"
            href="https://preview.keenthemes.com/metronic8/demo30/../demo30/apps/projects/users.html"
        >
            Users
        </a>
    </li> --}}
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.file', ['work_list_id' => $work_list_id]) ? 'active' : ''}}"
            href="{{route('com.promag.file', ['work_list_id' => $work_list_id])}}"
        >
            Files
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.activity', ['work_list_id' => $work_list_id]) ? 'active' : ''}}"
            href="{{route('com.promag.activity', ['work_list_id' => $work_list_id])}}"
        >
            Activity
        </a>
    </li>
    {{-- <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6"
            href="https://preview.keenthemes.com/metronic8/demo30/../demo30/apps/projects/settings.html"
        >
            Settings
        </a>
    </li> --}}
</ul>
