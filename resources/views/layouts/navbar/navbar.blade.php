<div id="kt_app_header" class="app-header">
    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none ms-n3" title="Show header menu">
            <div class="btn btn-icon btn-light ms-2 btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
            <a href="{{route('dashboard')}}">
                <img alt="Logo" src="{{asset('sense')}}/media/logos/logo-comtel.png" class="h-35px d-sm-none ms-4" />
                <img alt="Logo" src="{{asset('sense')}}/media/logos/logo-full-30.png" class="h-35px d-none d-sm-inline" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-500 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <span class="menu-link">
                            <span class="menu-title">Spaces</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                            <div class="menu-active-bg px-4 px-lg-0">
                                <div class="d-flex w-100 overflow-auto">
                                    <ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                                        <li class="nav-item mx-lg-1">
                                            <a class="nav-link py-3 py-lg-6 active text-active-info border-active-info border-hover-info" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_app_commercial">Commercial</a>
                                        </li>
                                        <li class="nav-item mx-lg-1">
                                            <a class="nav-link py-3 py-lg-6 text-active-warning border-active-warning border-hover-warning" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_app_operation">Operation</a>
                                        </li>
                                        <li class="nav-item mx-lg-1">
                                            <a class="nav-link py-3 py-lg-6 text-active-success border-active-success border-hover-success" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_app_finance">Finance</a>
                                        </li>
                                        <li class="nav-item mx-lg-1">
                                            <a class="nav-link py-3 py-lg-6 text-active-primary border-active-primary border-hover-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_app_hclegal">HC & Legal</a>
                                        </li>
                                        <li class="nav-item mx-lg-1">
                                            <a class="nav-link py-3 py-lg-6 text-active-dark border-active-dark border-hover-dark" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_app_direksi">BoD</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content py-4 py-lg-8 px-lg-7">
                                    <div class="tab-pane w-lg-600px active show" id="kt_app_header_app_commercial">
                                        <div class="row">
                                            <div class="col-lg-12 mb-6 mb-lg-0">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        @canany(['Leap:manage-lead', 'Leap:manage-prospect'])                                                            
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="{{route('com.lead.index-lead')}}" class="menu-link">
                                                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                    <i class="fa-solid fa-paper-plane text-info fs-3"></i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-dark">CMT-LEAP</span>
                                                                    <span class="fs-7 fw-semibold text-gray-500">Lead Dulu Prospek Kemudian</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        @endcanany
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-item p-0 m-0" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start" data-kt-menu-offset="10px, 10px">
                                                            <a class="menu-link">
                                                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                    <i class="fa-solid fa-hand-holding-dollar text-info fs-3"></i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-dark">CMT-OPPOR</span>
                                                                    <span class="fs-7 fw-semibold text-gray-500">Opportunity</span>
                                                                </span>
                                                                <span class="menu-title"></span>
                                                                <span class="svg-icon fs-3 rotate-180 ms-3 me-0">
                                                                    <i class="fa-solid fa-chevron-down text-gray-600"></i>
                                                                </span>
                                                            </a>
                                                            <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                                                                @canany([
                                                                    'Approval:survey-work-order',
                                                                    'Survey:manage-survey-request',
                                                                    'Survey:create-work-order',
                                                                    'Survey:manage-soft-survey',
                                                                    'Survey:manage-site-survey'
                                                                ])
                                                                <div class="menu-item">
                                                                    <a href="{{route('com.survey.index')}}" class="menu-link" >
                                                                        <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-20px h-20px me-4 bg-light">
                                                                            <i class="fa-solid fa-file-signature text-info fs-3"></i>
                                                                        </span>
                                                                        <span class="d-flex flex-column">
                                                                            <span class="fs-7 fw-semibold text-gray-800">Survey</span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                @endcanany
                                                                @canany([
                                                                    'Approval:view-boq-review',
                                                                    'Approval:update-boq-review',
                                                                    'Boq:create-draft-boq',
                                                                    'Boq:view-draft-boq',
                                                                    'Boq:manage-price-request-boq',
                                                                    'Boq:view-only-price-request-boq',
                                                                    'Boq:publish-finalize-boq',
                                                                    'Boq:markup-price-boq'
                                                                ])
                                                                <div class="menu-item">
                                                                    <a href="{{route('com.boq.index')}}" class="menu-link" >
                                                                        <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-20px h-20px me-4 bg-light">
                                                                            <i class="fa-solid fa-clipboard-list text-info fs-3"></i>
                                                                        </span>
                                                                        <span class="d-flex flex-column">
                                                                            <span class="fs-7 fw-semibold text-gray-800">BOQ</span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                @endcanany
                                                                @canany([
                                                                    'Quot:manage-quot',
                                                                    'Quot:view-only-quot',
                                                                    'Quot:upload-attachment-quot',
                                                                    'Quot:print-quot'
                                                                ])
                                                                <div class="menu-item">
                                                                    <a href="{{route('com.quotation.index')}}" class="menu-link" >
                                                                        <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-20px h-20px me-4 bg-light">
                                                                            <i class="fa-solid fa-file-invoice-dollar text-info fs-3"></i>
                                                                        </span>
                                                                        <span class="d-flex flex-column">
                                                                            <span class="fs-7 fw-semibold text-gray-800">Quotation</span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                @endcanany
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="{{route('com.procurement.index')}}" class="menu-link">
                                                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                    <i class="fa-solid fa-box-open text-info fs-3"></i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-dark">Procurement</span>
                                                                    <span class="fs-7 fw-semibold text-gray-500">Pengadaan dulu kerja kemudian</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane w-lg-600px" id="kt_app_header_app_operation">
                                    </div>
                                    <div class="tab-pane w-lg-600px" id="kt_app_header_app_finance">
                                    </div>
                                    <div class="tab-pane w-lg-600px" id="kt_app_header_app_commercial">
                                    </div>
                                    <div class="tab-pane w-lg-600px" id="kt_app_header_app_hclegal">
                                        <div class="row">
                                            <div class="col-lg-12 mb-6 mb-lg-0">
                                                <div class="row">
                                                    @can('HC:view-employee')
                                                        <div class="col-lg-6">
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="{{route('hc.emp.index')}}" class="menu-link">
                                                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                        <i class="fa-solid fa-users text-primary fs-3"></i>
                                                                    </span>
                                                                    <span class="d-flex flex-column">
                                                                        <span class="fs-6 fw-bold text-dark">CMT-EMP</span>
                                                                        <span class="fs-7 fw-semibold text-gray-500">Database Pegawai Comtelindo</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                    @can("HC:view-attendance")
                                                        <div class="col-lg-6">
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="{{route('hc.att.index')}}" class="menu-link">
                                                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                        <i class="fa-solid fa-calendar-days text-primary fs-3"></i>
                                                                    </span>
                                                                    <span class="d-flex flex-column">
                                                                        <span class="fs-6 fw-bold text-dark">CMT-Attendance</span>
                                                                        <span class="fs-7 fw-semibold text-gray-500">Catatan Daftar Hadir Karyawan</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                    <div class="col-lg-6">
                                                        <div class="menu-item p-0 m-0">
                                                            <a href="{{route('hc.request.index')}}" class="menu-link">
                                                                <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                    <i class="fa-solid fa-handshake text-primary fs-3"></i>
                                                                </span>
                                                                <span class="d-flex flex-column">
                                                                    <span class="fs-6 fw-bold text-dark">CMT-Request</span>
                                                                    <span class="fs-7 fw-semibold text-gray-500">Catatan Daftar Request Karyawan</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @can('HC:setting')
                                                        <div class="col-lg-6">
                                                            <div class="menu-item p-0 m-0">
                                                                <a href="{{route('hc.setting.company-info.index')}}" class="menu-link">
                                                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-35px h-35px me-4 bg-light">
                                                                        <i class="fa-solid fa-gear text-primary fs-3"></i>
                                                                    </span>
                                                                    <span class="d-flex flex-column">
                                                                        <span class="fs-6 fw-bold text-dark">CMT-Settings</span>
                                                                        <span class="fs-7 fw-semibold text-gray-500">Setting jadwal sampai payroll</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane w-lg-600px" id="kt_app_header_app_direksi">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <span class="menu-link">
                            <span class="menu-title">Help</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item px-3">
                                <span class="menu-link">
                                    <span class="menu-icon"><i class="fa-solid fa-book fs-5"></i></span>
                                    <span class="menu-title">Documentation</span>
                                </span>
                            </div>
                            <div class="menu-item px-3">
                                <span class="menu-link">
                                    <span class="menu-icon"><i class="fa-solid fa-code fs-5"></i></span>
                                    <span class="menu-title">Changelog</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-4">
                    <div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px w-md-45px h-md-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                        <i class="fa-solid fa-bell fs-2"></i>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px" data-kt-menu="true">
                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                            <span class="fs-6 text-dark fw-bolder px-9 mt-6 mb-3">Notifications</span>
                        </div>
                        <div class="scroll-y mh-325px px-8">
                            @for ($i=0;$i<3;$i++)
                            <div class="d-flex flex-stack py-2">
                                <div class="d-flex align-items-center me-2">
                                    <span class="badge badge-light-success me-4 px-3 py-2">2023/23/2 18:09</span>
                                    <span class="fs-7 text-dark fw-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit..</span>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="text-center border-top mt-6">
                            <a href="#!" class="fs-8 btn btn-color-gray-500 btn-active-color-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item ms-4">
                    <a href="#" class="btn btn-icon btn-color-gray-500 w-35px h-35px w-md-45px h-md-45px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <span class="theme-light-show">
                            <i class="fs-2 fa-solid fa-sun text-warning"></i>
                        </span>
                        <span class="theme-dark-show ">
                            <i class="fs-2 fa-solid fa-moon text-white"></i>
                        </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-500 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="fa-solid fa-sun"></i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="fa-solid fa-moon"></i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="fa-solid fa-desktop"></i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item ms-4" id="kt_header_user_menu_toggle">
                    @auth
                    <div class="cursor-pointer symbol symbol-circle symbol-35px symbol-md-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{asset('sense')}}/media/avatars/blank.png" alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-500 menu-state-bg menu-state-color fw-semibold py-4 fs-base w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-circle symbol-45px me-5">
                                    <img alt="Logo" src="{{asset('sense')}}/media/avatars/blank.png" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-6">{{auth()->user()->name}}
                                    </div>
                                    <span class="text-gray-500 fs-8">{{auth()->user()->email}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5 my-0">
                            <a href="{{route('hc.emp.profile',['id'=>auth()->user()->id])}}" class="menu-link px-5 py-2">
                                <span class="menu-title position-relative">Profile
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-5 my-0">
                            <a href="#!" class="menu-link px-5 py-2">
                                <span class="menu-title position-relative">Setting
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-5 my-0">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5 py-2">
                                <span class="menu-title position-relative text-danger">Logout
                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        <i class="fas fa-arrow-right text-danger"></i>
                                    </span>
                                </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
                @yield('right-mobile-button')
            </div>
        </div>
    </div>
</div>
