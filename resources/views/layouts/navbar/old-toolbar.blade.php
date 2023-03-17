<div id="kt_app_toolbar" class="app-toolbar py-lg-20 py-6 mb-10 bg-primary">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-white fw-bolder fs-3 flex-column justify-content-center my-0" contenteditable="true">@yield('title')</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 ">
                <li class="breadcrumb-item text-white">
                    <a href="{{route('dashboard')}}" class="text-white text-hover-warning"><i class="fa-solid fa-home fs-7"></i></a>
                </li>
                @hasSection('title-sub')
                <li class="breadcrumb-item">
                    <span class="bullet bg-warning w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item">
                    <li class="breadcrumb-item text-white">@yield('title-sub')</li>
                </li>
                @endif
                @hasSection('title')
                <li class="breadcrumb-item">
                    <span class="bullet bg-warning w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-white">@yield('title')</li>
                @endif
                @hasSection('title-subsub')
                <li class="breadcrumb-item">
                    <span class="bullet bg-warning w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-white">@yield('title-subsub')</li>
                @endif
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            @yield('button-action')
        </div>
        {{-- <div class="page-title d-flex align-items-center me-3 mb-4 pt-9 pt-lg-17 mb-lg-15">
            <div class="btn btn-icon btn-custom h-65px w-65px me-6">
                <img alt="Logo" src="{{asset('sense')}}/media/logos/logo-comtel.png" class="h-40px">
            </div>    
            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0">
                Metronic - Multi-platform  Framewok
                <span class="page-desc fs-6 fw-bold pt-4">
                    <i class="bi bi-star-fill icon-custom fs-6 me-2 lh-0"></i> <span class="custom-text me-3 lh-0">4.89</span> <span class="d-flex align-items-center lh-0 fs-7">7,834 Reviews <span class="bullet h-6px w-6px mx-3"></span> #1 Admin Dashboard Template</span>            </span>
                </h1>
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px overflow-hidden me-7">
                        <div class="symbol-label fs-3 bg-black bg-opacity-25">
                            <i class="fa-solid fa-users fs-3 text-white"></i>
                        </div>
                    </div>
                    <div>
                        <span class="mb-0 fw-bolder fs-2 d-block text-white">@yield('title')</span>
                        <a href="mailto:admin@gmai.com" class="text-white"><i class="fa-solid fa-envelope me-2 text-white d-none d-md-inline"></i>admin@gmail.com</a>
                        <span class="text-white mx-3 d-none d-md-inline">|</span>
                        <span class="text-white d-none d-md-inline"><i class="fa-solid fa-id-card me-2 text-white"></i>424115131</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>