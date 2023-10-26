<!DOCTYPE html>
<html lang="en">
<head>
	<base href="../"/>
	<title>@yield('title-apps','ERP Comtelindo') | ERP Comtelindo</title>
	<meta charset="utf-8" />
	<meta name="description" content="ERP Comtelindo DESC" />
	<meta name="keywords" content="ERP Comtelindo" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
   -webkit-appearance: none;
   margin: 0;
 }

 input[type="number"] {
   -moz-appearance: textfield; /* Firefox */
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

{{-- <div id="kt_scrolltop" class="scrolltop bg-info" data-kt-scrolltop="true">
    <i class="fa-solid fa-arrow-up text-white"></i>
</div> --}}

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

	function submitModal({modalName, tableName = null, ajaxLink, anotherTableName = null , validationMessages = {}, successCallback = () => {}, customData = {}}) {
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

                        successCallback(data);
                    },
                    error: function (xhr, status, errorThrown) {
                        $(`#${modalName}_submit`).removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');

                        if (data.errors == null) {
                            toastr.error(data.message ,'Opps!');
                            return;
                        }

                        if (Object.keys(data.errors).length >= 1) {
                            Object.keys(data.errors).forEach(keyError => {
                                const error = data.errors[keyError];

                                error.forEach(msg => {
                                    toastr.error(msg, data.message);
                                });
                            });
                            return;
                        }
                    }
                });
            }
        });
    }

    function submitForm({formId, ajaxLink, validationMessages = {}, successCallback = () => {}, failCallback = () => {}}) {
        $(`#${formId}_form`).validate({
            messages: validationMessages,
            submitHandler: function(form) {
                const formData = new FormData(form);
                $(`#${formId}_submit`).attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    url: ajaxLink,
                    type: "POST",
                    success: function (data) {
                        $(`#${formId}_cancel`).click();
                        toastr.success(data.status,'Selamat 🚀 !');

                        successCallback(data);
                    },
                    error: function (xhr, status, errorThrown) {
                        $(`#${formId}_submit`).removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');

                        if (data.errors == null) {
                            toastr.error(data.message ,'Opps!');
                            return;
                        }

                        if (Object.keys(data.errors).length >= 1) {
                            Object.keys(data.errors).forEach(keyError => {
                                const error = data.errors[keyError];

                                error.forEach(msg => {
                                    toastr.error(msg, data.message);
                                });
                            });
                            return;
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


    function generateRandomString(length) {
        const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        const charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        return result;
    }

    function imageReadURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $(input).parent().find('#containerImage').attr('src', e.target.result);
                $(input).parent().find('#containerImage').removeAttr('hidden');
                console.log($(input).parent().find('#containerImage'));
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function validateAndFormatNumber(input) {
        // Mengambil nilai input tanpa karakter non-digit
        let inputValue = input.value.replace(/\D/g, '');

        // Pastikan nilai input tidak kosong
        if (inputValue.length > 0) {
            // Pastikan nilai input tidak diawali dengan angka 0
            if (inputValue[0] === '0') {
                // Jika nilai input diawali dengan angka 0, hapus angka 0 di awal
                inputValue = inputValue.slice(1);
            }
        }

        // Mengatur nilai input kembali dengan angka yang telah diformat
        input.value = inputValue;
    };

    //  function kalkulasi total di Modal
    function calculateTotalAmount(totalElementId, modal) {
        // Mengambil nilai dari masing-masing input menggunakan querySelector
        const purchasePrice = parseFloat(document.querySelector(`[name='purchase_price_${modal}']`).value);
        const quantity = parseInt(document.querySelector(`[name='quantity_${modal}']`).value);
        const purchaseDelivery = parseFloat(document.querySelector(`[name='purchase_delivery_${modal}']`).value);


        // Cek jika nilai purchasePrice dan quantity adalah angka
        if (isNaN(purchasePrice) || isNaN(quantity)) {
            // Jika ada input yang belum diisi atau bukan angka, tampilkan hasil kosong dan return
            document.getElementById(totalElementId).textContent = "";
            const hiddenTotalInput = document.querySelector(`[name='${totalElementId}']`);
            hiddenTotalInput.value = ""; // Set the hidden input value to empty string
            return;
        }

        // Melakukan perhitungan total
        let totalAmount = purchasePrice * quantity;

        // Tambahkan purchaseDelivery ke totalAmount jika nilai purchaseDelivery adalah angka
        if (!isNaN(purchaseDelivery)) {
            totalAmount += purchaseDelivery;
        }

        // Cek jika totalAmount melebihi 12 karakter
        // 9,007,199,254,740,991 maksimal karakter number
        if (totalAmount.toString().length > 15) {
            document.getElementById(totalElementId).textContent = "Melewati limit angka";
            const hiddenTotalInput = document.querySelector(`[name='${totalElementId}']`);
            hiddenTotalInput.value = ""; // Set the hidden input value to empty string
            return;
        }

        // Menampilkan total dalam format dengan tanda titik setiap 3 digit dari kanan
        const totalAmountWithCommas = new Intl.NumberFormat("id").format(totalAmount);

        // Mengatur nilai total pada elemen dengan id 'totalDisplay'
        document.getElementById(totalElementId).textContent = totalAmountWithCommas;

        // Mengatur nilai total pada elemen dengan class 'total' (hidden input)
        const hiddenTotalInput = document.querySelector(`[name='${totalElementId}']`);
        hiddenTotalInput.value = totalAmount; // Store the numerical value for passing to the main page.
    }

    // function updateTotalSumBundle() {
    //     let totalSumBundle = 0;
    //     const modalVal = parseInt(document.querySelector(`[name='modal']`).value);

    //     $('.BundleItem input[name^="total_price"]').each(function() {
    //         let totalPriceBundleValue = $(this).val();

    //         if (totalPriceBundleValue !== "") {
    //             totalSumBundle += parseInt(totalPriceBundleValue);
    //         }
    //     });

    //     if (modalVal >= totalSumBundle) {
    //         return document.getElementById("total_bundle_price").textContent = "   KURANG MODAL";
    //     }

    //     const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSumBundle);

    //     $('#total_bundle_price').text(totalPriceWithCommas);
    //     $('#gpm').val(totalSumBundle);

    //     // const hiddenTotalInput = document.querySelector(`[name='total_price_bundle']`);
    //     // hiddenTotalInput.value = totalSumBundle; // Set the hidden input value to empty string


    //     // Ambil nilai gpm dan modal
    //     let gpm = parseFloat($('#gpm').val()); // gunakan parseFloat untuk memastikan nilai numerik
    //     let modal = parseFloat($('#modal').val()); // gunakan parseFloat untuk memastikan nilai numerik

    //     if (!isNaN(gpm) && !isNaN(modal)) {
    //         let npm = gpm - modal;
    //         let percentage = (npm / gpm) * 100;

    //         $('#npm').val(npm);
    //         $('#percentage').val(percentage.toFixed(2));
    //     }
    // }

    // function calculateTotalBundle(uniq_id) {
    //     const purchasePrice = parseFloat(document.querySelector(`[name='purchase_price_${uniq_id}']`)
    //         .value);
    //     const quantity = parseInt(document.querySelector(`[name='quantity_${uniq_id}']`).value);

    //     if (isNaN(purchasePrice) || isNaN(quantity)) {
    //         return document.getElementById("total_price_" + uniq_id).value = "null";
    //     }

    //     let totalAmount = purchasePrice * quantity;

    //     document.getElementById("total_price_" + uniq_id).value = totalAmount;
    //     updateTotalSumBundle()
    // }

</script>
</body>
</html>
