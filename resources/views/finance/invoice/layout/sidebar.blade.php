@php
    $currentUrl = request()->url();
@endphp

<div class="card bgi-no-repeat mb-6"
    style="background-position: bottom 0 right 0; background-size: 125px; background-image:url('{{ asset('sense') }}/media/svg/general/rhone.svg')">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 text-left">
                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block mb-5 mt-4">Menu</span>
                <a class="mb-3 d-flex p-4 rounded
                    {{ $currentUrl == route('fin.invc.dashboard') ? 'bg-light-info text-info' : 'text-dark bg-hover-light-info text-hover-info' }}"
                    href="{{ route('fin.invc.dashboard') }}">
                    <i
                        class="fa-solid fa-border-all ms-1 fs-3
                        {{ $currentUrl == route('fin.invc.dashboard') ? 'text-info' : '' }}"></i>
                    <span class="fs-7 fw-bold ms-3 text-center">Dashboard</span>
                </a>
                <a class="mb-3 d-flex p-4 rounded
                    {{ $currentUrl == route('fin.invc.invoice') ? 'bg-light-info text-info' : 'text-dark bg-hover-light-info text-hover-info' }}"
                    href="{{ route('fin.invc.invoice') }}">
                    <i
                        class="fa-solid fa-receipt ms-1 fs-3
                        {{ $currentUrl == route('fin.invc.invoice') ? 'text-info' : '' }}"></i>
                    <span class="fs-7 fw-bold ms-3 text-center">Invoice</span>
                </a>
                <a class="mb-3 d-flex p-4 rounded
                    {{ $currentUrl == route('fin.invc.journal') ? 'bg-light-info text-info' : 'text-dark bg-hover-light-info text-hover-info' }}"
                    href="{{ route('fin.invc.journal') }}">
                    <i
                        class="fa-solid fa-book-journal-whills ms-1 fs-3
                        {{ $currentUrl == route('fin.invc.journal') ? 'text-info' : '' }}"></i>
                    <span class="fs-7 fw-bold ms-3 text-center">Jurnal / Laporan</span>
                </a>
                <a class="mb-3 d-flex p-4 rounded
                    {{ $currentUrl == route('fin.invc.master-data') ? 'bg-light-info text-info' : 'text-dark bg-hover-light-info text-hover-info' }}"
                    href="{{ route('fin.invc.master-data') }}">
                    <i
                        class="fa-solid fa-database ms-1 fs-3
                        {{ $currentUrl == route('fin.invc.master-data') ? 'text-info' : '' }}"></i>
                    <span class="fs-7 fw-bold ms-3 text-center">Master Data</span>
                </a>
                <a class="mb-3 d-flex p-4 rounded
                    {{ $currentUrl == route('fin.invc.logs') ? 'bg-light-info text-info' : 'text-dark bg-hover-light-info text-hover-info' }}"
                    href="{{ route('fin.invc.logs') }}">
                    <i
                        class="fa-solid fa-file-contract ms-1 fs-3
                        {{ $currentUrl == route('fin.invc.logs') ? 'text-info' : '' }}"></i>
                    <span class="fs-7 fw-bold ms-3 text-center">Logs</span>
                </a>
            </div>
        </div>
    </div>
</div>
