<!DOCTYPE html>
<html lang="en">
<head>
	<base href="../"/>
	<title>@yield('title-apps','ERP Comtelindo') | ERP Comtelindo</title>
	<meta charset="utf-8" />
	<meta name="description" content="ERP Comtelindo DESC" />
	<meta name="keywords" content="ERP Comtelindo" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ERP Comtelindo by ODS" />
	<meta property="og:url" content="https://app.comtelindo.com" />
	<meta property="og:site_name" content="Comtelindo | ERP Comtelindo" />
	<link rel="canonical" href="https://app.comtelindo.com" />
	<link rel="canonical" href="https://app.comtelindo.com" />
	<link rel="shortcut icon" href="{{asset('sense')}}/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" />
	<link href="{{asset('sense')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
	<link href="{{asset('sense')}}/plugins/custom/signaturejs/css/jquery.signature.css" rel="stylesheet" type="text/css" />
	
	@stack('css')
	
	<link href="{{asset('sense')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="{{asset('sense')}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
	
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	
	<script type="text/javascript" src="{{asset('sense')}}/plugins/custom/touchjs/jquery.ui.touch-punch.min.js"></script>
	<script src="{{asset('sense')}}/plugins/custom/signaturejs/js/jquery.signature.js"></script>
	
</head>
<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="@yield('navbar-status','true')" 
data-kt-app-toolbar-fixed="@yield('toolbar-status','true')" data-kt-app-toolbar-enabled="@yield('toolbar-status','true')" 
data-kt-app-sidebar-enabled="@yield('sidebar-status','false')" data-kt-app-sidebar-fixed="@yield('sidebar-status','false')" data-kt-app-sidebar-hoverable="@yield('sidebar-status','false')" data-kt-app-sidebar-push-header="@yield('sidebar-status2','false')" data-kt-app-sidebar-push-toolbar="@yield('sidebar-status2','false')" data-kt-app-sidebar-push-footer="@yield('sidebar-status','false')" 
class="app-default page-loading-enabled page-loading">

<style>
	.kbw-signature { 
		width: 100%; 
		height: 260px; 
		border-radius:.475rem;
	}

    .form-check-input {
        
    }
</style>

<style type="text/css" media="print">
    @page 
    {
        size: auto;
        margin-top: 0mm;
        margin-bottom: 0mm;
    }
    @media print {
        body {-webkit-print-color-adjust: exact;}
    }
</style>

<script>
	var defaultThemeMode = "light"; 
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
			themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "light" : "light"; 
		} 
		document.documentElement.setAttribute("data-theme", themeMode); 
	}
</script>

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
	<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
		<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
			<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
				<div class="d-flex flex-column flex-column-fluid">
					<div id="kt_app_content" class="app-content flex-column-fluid">
						<div id="kt_app_content_container" class="app-container container-xxl h-100">
							<div class="row align-items-center mt-16">
								@include('layouts.print.kop-berlangganan')
							</div>
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>