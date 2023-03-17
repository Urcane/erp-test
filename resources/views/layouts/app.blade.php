<!DOCTYPE html>
<html lang="en">
<head>
	<base href="../"/>
	<title>@yield('title','Comtelindo Apps') | by Comtelindo ODS</title>
	<meta charset="utf-8" />
	<meta name="description" content="Comtelindo Apps DESC" />
	<meta name="keywords" content="Comtelindo Apps" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Comtelindo Apps by ODS" />
	<meta property="og:url" content="https://app.comtelindo.com" />
	<meta property="og:site_name" content="Comtelindo | Comtelindo Apps" />
	{{-- <link rel="canonical" href="https://preview.keenthemes.com/metronic8" /> --}}
	<link rel="canonical" href="https://app.comtelindo.com" />
	<link rel="shortcut icon" href="{{asset('sense')}}/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="{{asset('sense')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
	
	<link href="{{asset('sense')}}/plugins/custom/signaturejs/css/jquery.signature.css" rel="stylesheet" type="text/css" />
	
	@stack('css')
	
	<link href="{{asset('sense')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="{{asset('sense')}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
	
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	
	<script type="text/javascript" src="{{asset('sense')}}/plugins/custom/touchjs/jquery.ui.touch-punch.min.js"></script>
	<script src="{{asset('sense')}}/plugins/custom/signaturejs/js/jquery.signature.js"></script>
	
</head>
<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="@yield('navbar-status','true')" 
data-kt-app-toolbar-fixed="@yield('toolbar-status','false')" data-kt-app-toolbar-enabled="@yield('toolbar-status','true')" 
data-kt-app-sidebar-enabled="@yield('sidebar-status','false')" data-kt-app-sidebar-fixed="@yield('sidebar-status','false')" data-kt-app-sidebar-hoverable="@yield('sidebar-status','false')" data-kt-app-sidebar-push-header="@yield('sidebar-status2','false')" data-kt-app-sidebar-push-toolbar="@yield('sidebar-status2','false')" data-kt-app-sidebar-push-footer="@yield('sidebar-status','false')" 
class="app-default page-loading-enabled page-loading">

<script>
	var defaultThemeMode = "system"; 
	var themeMode; 
	if ( document.documentElement ) { 
		if ( document.documentElement.hasAttribute("data-theme-mode")) { 
			themeMode = document.documentElement.getAttribute("data-theme-mode"); 
		} else { 
			if ( localStorage.getItem("data-theme") !== null ) { 
				themeMode = localStorage.getItem("data-theme"); 
			} else { 
				themeMode = defaultThemeMode; 
			} 
		} if (themeMode === "system") { 
			themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; 
		} 
		document.documentElement.setAttribute("data-theme", themeMode); 
	}
</script>

@php
$today = Carbon\Carbon::now();
@endphp

<div class="page-loader">
	<span class="spinner-border text-primary" role="status"></span>
</div>			

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
	<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
		@yield('navbar')
		<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
			@yield('sidebar')
			<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
				<div class="d-flex flex-column flex-column-fluid">
					@yield('toolbar')
					<div id="kt_app_content" class="app-content flex-column-fluid">
						<div id="kt_app_content_container" class="app-container container-xxl h-100">
							@yield('content')
						</div>
					</div>
				</div>
				@yield('footer')
			</div>
		</div>
	</div>
</div>

<div id="kt_scrolltop" class="scrolltop bg-primary" data-kt-scrolltop="true">
	<i class="fa-solid fa-arrow-up text-white"></i>
</div>

<script>var hostUrl = "{{asset('sense')}}/";</script>
<script src="{{asset('sense')}}/plugins/global/plugins.bundle.js"></script>
<script src="{{asset('sense')}}/js/scripts.bundle.js"></script>
<script src="{{asset('sense')}}/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

@stack('js')

</body>
</html>