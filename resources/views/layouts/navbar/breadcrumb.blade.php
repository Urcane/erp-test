<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-8">
<li class="breadcrumb-item text-white fw-bold lh-1">
<a href="{{route('dashboard')}}" class="text-white">
<i class="fa-solid fa-home text-white fs-8"></i>
</a>
</li>
@hasSection('sub-title-apps-2')
<li class="breadcrumb-item">
<i class="fa-solid fa-chevron-right text-white fs-8"></i>
</li>
<li class="breadcrumb-item text-white fw-bold lh-1">@yield('sub-title-apps-2')</li>
@endif
@hasSection('sub-title-apps')
<li class="breadcrumb-item">
<i class="fa-solid fa-chevron-right text-white fs-8"></i>
</li>
<li class="breadcrumb-item text-white fw-bold lh-1">@yield('sub-title-apps')</li>
@endif
<li class="breadcrumb-item">
<i class="fa-solid fa-chevron-right text-white fs-8"></i>
</li>
<li class="breadcrumb-item text-white fw-bold lh-1">@yield('title-apps')</li>
</ul>