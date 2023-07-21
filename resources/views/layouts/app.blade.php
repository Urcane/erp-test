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
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="@yield('navbar-status','false')" 
data-kt-app-toolbar-fixed="@yield('toolbar-status','false')" data-kt-app-toolbar-enabled="@yield('toolbar-status','true')" 
data-kt-app-sidebar-enabled="@yield('sidebar-status','false')" data-kt-app-sidebar-fixed="@yield('sidebar-status','false')" data-kt-app-sidebar-hoverable="@yield('sidebar-status','false')" data-kt-app-sidebar-push-header="@yield('sidebar-push','false')" data-kt-app-sidebar-push-toolbar="@yield('sidebar-push','false')" data-kt-app-sidebar-push-footer="@yield('sidebar-status','false')" 
class="app-default page-loading-enabled page-loading">

<style>
	.kbw-signature { 
		width: 100%; 
		height: 260px; 
		border-radius:.475rem;
	}
</style>

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

<div id="kt_scrolltop" class="scrolltop bg-info" data-kt-scrolltop="true">
	<i class="fa-solid fa-arrow-up text-white"></i>
</div>

<script>
	var hostUrl = "{{asset('sense')}}/";
</script>
<script src="{{asset('sense')}}/plugins/global/plugins.bundle.js"></script>
<script src="{{asset('sense')}}/js/scripts.bundle.js"></script>
<script src="{{asset('sense')}}/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<script>
	function generateDatatable({tableName, ajaxLink, columnData = [], elementName, functionCallback = () => {}, filters = null}) {
        window[tableName]  = $(elementName)
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            drawCallback: functionCallback,
            ajax: {
                url : ajaxLink,
                data: function(data) {
                    data.filters = filters
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +
            
            "<'table-responsive'tr>" +
            
            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",
            
            columns: columnData,  
            columnDefs: [
            {
                targets: 0,
                className: 'text-center',
            },
            {
                targets: -1,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
    }

	function submitModal({modalName, tableName, ajaxLink, anotherTableName = null,validationMessages = {}}) {
        $(`#${modalName}_form`).validate({
            messages: validationMessages,
            submitHandler: function(form) {
                var formData = new FormData(form);
                $(`#${modalName}_submit`).attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: ajaxLink,
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $(`#${modalName}_cancel`).click();
                        var oTable = $(`#${tableName}`).dataTable();
                        oTable.fnDraw(false);

                        if (typeof window[anotherTableName] !== 'undefined') {
                            window[anotherTableName].draw();
                        }

                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $(`#${modalName}_submit`).removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                        
                        if (Object.keys(data.errors).length >= 1) {
                            Object.keys(data.errors).forEach(keyError => {
                                const error = data.errors[keyError];

                                error.forEach(msg => {
                                    toastr.error(msg, data.message);
                                });
                            });
                            return
                        }
                    }
                });
            }
        });
    }

	function onlyUnique(value, index, array) {
		return array.indexOf(value) === index;
	}

    $(".checkbox-real").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', 1);
        } else {
            $(this).attr('value', 0);
        }        
    });

    function getFormattedDate(date) {
        const month = ("0" + (date.getMonth() + 1)).slice(-2);
        const day  = ("0" + (date.getDate())).slice(-2);
        const year = date.getFullYear();
        const hour =  ("0" + (date.getHours())).slice(-2);
        const min =  ("0" + (date.getMinutes())).slice(-2);
        const seg = ("0" + (date.getSeconds())).slice(-2);
        return [year + "-" + month + "-" + day, hour + ":" +  min];
    }
</script>
</body>
</html>