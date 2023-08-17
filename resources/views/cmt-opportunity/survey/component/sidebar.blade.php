<div class="menu menu-column menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
    {{-- <div class="menu-item pb-5 fs-3 text-center">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Survey</span>
        </div>
    </div> --}}

    @php
    if (!isset($selected_side_bar_content)) {
        $selected_side_bar_content = '';
    }
    @endphp
    <div class="scroll-y me-n7 pe-7" id="kt_arc_scroll_menu_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_arc_scroll_menu_header" data-kt-scroll-wrappers="#kt_arc_scroll_menu_scroll" data-kt-scroll-offset="300px" style="max-height: 616px;">
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Main Flow</span>
            </div>
        </div>
        <div class="menu-item">
            <a class="menu-link fw-semibold @if($selected_side_bar_content == 'main') text-primary @else text-dark @endif" href="{{route('com.survey.index')}}">
                <span class="menu-icon">
                    <i class="fas fa-home"></i>
                </span>
                <span class="menu-title">Survey Request</span>
            </a>
        </div>
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">On Desk Flow</span>
            </div>
        </div>
        <div class="menu-item">
            <a class="menu-link fw-semibold @if($selected_side_bar_content == 'soft-survey') text-primary @else text-dark @endif" href="{{route('com.soft-survey.index')}}">
                <span class="menu-icon">
                    <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="menu-title fw-semibold menu-BP-001">Soft Survey</span>
            </a>
        </div>
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">On Site Flow</span>
            </div>
        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion tab-site-survey">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="menu-title fw-semibold menu-site-survey">Site Survey</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link fw-semibold menu-site-survey @if($selected_side_bar_content == 'site-survey-internet') text-primary @else text-dark @endif" href="{{route('com.site-survey.internet.index')}}">
                        <span class="menu-icon">
                            <i class="bullet bullet-dot"></i>
                        </span>
                        <span class="menu-title">Site Survey Internet</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link fw-semibold menu-site-survey @if($selected_side_bar_content == 'site-survey-cctv') text-primary @else text-dark @endif" href="{{route('com.site-survey.cctv.index')}}">
                        <span class="menu-icon">
                            <i class="bullet bullet-dot"></i>
                        </span>
                        <span class="menu-title">Site Survey CCTV</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link fw-semibold menu-site-survey @if($selected_side_bar_content == 'site-survey-gsm-booster') text-primary @else text-dark @endif" href="{{route('com.site-survey.gb.index')}}">
                        <span class="menu-icon">
                            <i class="bullet bullet-dot"></i>
                        </span>
                        <span class="menu-title">Site Survey GSM Booster</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>