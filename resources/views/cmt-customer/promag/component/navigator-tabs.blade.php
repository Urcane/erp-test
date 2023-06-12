<ul
    class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold"
>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.detail') ? 'active' : ''}}"
            href="{{route('com.promag.detail')}}"
        >
            Overview
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.detail.task-lists') ? 'active' : ''}}"
            href="{{route('com.promag.detail.task-lists')}}"
        >
            Task Lists
        </a>
    </li>
    {{-- <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6"
            href="https://preview.keenthemes.com/metronic8/demo30/../demo30/apps/projects/budget.html"
        >
            Budget
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6"
            href="https://preview.keenthemes.com/metronic8/demo30/../demo30/apps/projects/users.html"
        >
            Users
        </a>
    </li> --}}
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6 {{url()->current() == route('com.promag.detail.files') ? 'active' : ''}}"
            href="{{route('com.promag.detail.files')}}"
        >
            Files
        </a>
    </li>
    {{-- <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6"
            href="https://preview.keenthemes.com/metronic8/demo30/../demo30/apps/projects/activity.html"
        >
            Activity
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link text-active-primary py-5 me-6"
            href="https://preview.keenthemes.com/metronic8/demo30/../demo30/apps/projects/settings.html"
        >
            Settings
        </a>
    </li> --}}
</ul>