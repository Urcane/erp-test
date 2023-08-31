<div class="menu menu-column menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

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
            <a class="menu-link fw-semibold @if($selected_side_bar_content == 'main') text-primary @else text-dark @endif" href="{{route('com.quotation.index')}}">
                <span class="menu-icon">
                     <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="menu-title">Quotation Internet</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link fw-semibold @if($selected_side_bar_content == 'main') text-primary @else text-dark @endif" href="{{route('com.quotation.perangkat.index')}}">
                <span class="menu-icon">
                     <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="menu-title">Quotation Perangkat</span>
            </a>
        </div> 
    </div>
</div>