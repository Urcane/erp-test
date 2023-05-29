<div id="kt_app_toolbar" class="app-toolbar pt-10 pb-20 bg-info bgi-no-repeat bgi-size-cover bgi-position-x-end" style="background-image:url('{{asset('sense')}}/media/svg/shapes/wave-bg-purple.svg');">
    <div id="kt_app_toolbar_container" class="app-container container-xxl">
        <div class="row pb-20">
            @hasSection('desc-apps')
            <div class="col-lg-12 mb-20">
                <div class="d-flex align-items-center">
                    @include('layouts.navbar.breadcrumb')
                </div>
            </div>
            @else
            <div class="col-lg-12 mb-7">
                <div class="d-flex align-items-center">
                    @include('layouts.navbar.breadcrumb')
                </div>
            </div>
            @endif
            <div class="col-lg-12 mb-md-20 mb-10">
                <div class="row">
                    @hasSection('desc-apps')
                    <div class="col-lg-7 mb-9 mb-md-0">
                        <div class="d-flex">
                            <div class="symbol symbol-45px overflow-hidden me-5">
                                <div class="symbol-label bg-light-info"><i class="@yield('icon-apps') text-info fs-1"></i></div>
                            </div>
                            <div>
                                <span class="mb-0 fs-4 fw-bolder d-block text-white">@yield('title-apps')</span>
                                <p class="mb-0 fs-6 fw-bold" style="color:#ad87ff">@yield('desc-apps')</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-7 mb-9 mb-md-20 pb-7"></div>
                    @endif
                    <div class="col-lg-5">
                        <div class="row align-items-center justify-content-end">
                            @yield('summary-page')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>