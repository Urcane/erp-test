@extends('layouts.app')
@section('title-apps', 'BOQ')
@section('sub-title-apps-2', 'Commercial')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Bill Of Quantity')
@section('icon-apps', 'fa-solid fa-briefcase')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('summary-page')
    {{-- <div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataUser->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Pegawai</span>
</div>
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataDivision->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Divisi</span>
</div> --}}
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    {{-- FORM BOQ --}}
    {{-- @dd($dataCompany) --}}
    {{-- @dd($dataProspect)  --}}
    {{-- @dd($dataItems) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-6 align-items-center">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Bill of Quantity</span>
                                </div>
                            </div>

                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        {{-- baris Rilll --}}

                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">
                                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                                            @csrf
                                            <div class="col-lg-5 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataCompany->prospect_title ?? null}} {{ $dataCompany->customer->customer_name ?? null }}">

                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id" value="{{ $dataCompany->id ?? null }}">

                                                <div id="error-prospect"></div>
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-5 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" required name="survey_request_id"
                                                    id="survey_request_id">
                                                    <option value="" selected disabled>Pilih Survey</option>
                                                    @foreach ($dataSurvey as $survey)
                                                        <option value="{{$survey->id}}">{{$survey->customerProspect->prospect_title}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris Rilll --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="customer_name" id="customer_name"
                                                    value="{{ $dataCompany->customer->customer_name ?? null }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_name ?? null }}"
                                                    name="">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class="form-label">No Kontak
                                                    Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataCompany->customer->customerContact->customer_contact_phone ?? null }}"
                                                        name="" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataCompany->customer->bussinesType->type_name ?? null }}">
                                            </div>
                                        </div>
                                    </div>




                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            {{-- Cek Dari db items jika ada masukkan di sni
                                            {{-- inputan dari modal masuk kesni --}}
                                            @if (isset($dataItems))

                                                @foreach ($dataItems as $itemableBillOfQuantities)
                                                    <!-- Display data from $itemableBillOfQuantities -->

                                                    @foreach ($itemableBillOfQuantities->itemableBillOfQuantities as $relatedItem)
                                                        <!-- Display data from $relatedItem -->
                                                        @php
                                                            $random_string = \Illuminate\Support\Str::random(4);
                                                        @endphp
                                                        <div
                                                            class="file-soft-boq-item-{{ $random_string }} d-flex justify-content-between mx-20 mb-5 mt-10">
                                                            <div class=""
                                                                style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                                <label for="" class="form-label">Item</label>
                                                                <input type="text"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][good_name]"
                                                                    value="{{ $relatedItem->inventoryGood->good_name ?? null }}" />
                                                            </div>

                                                            <div class=""
                                                                style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                                <label for="" class="form-label">Merk</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid" disabled
                                                                        name="content[][good_merk]"
                                                                        value="{{ $relatedItem->inventoryGood->merk ?? null }}" />
                                                                </div>
                                                            </div>

                                                            <div class=""
                                                                style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                                <label for="" class="form-label">Price</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="number"
                                                                        class="form-control form-control-solid" disabled
                                                                        name="content[][purchase_price]"
                                                                        value="{{ $relatedItem->purchase_price ?? null }}" />
                                                                </div>
                                                            </div>

                                                            <div class=""
                                                                style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                                <label for="" class="form-label">Qty</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="number"
                                                                        class="form-control form-control-solid" disabled
                                                                        name="content[][quantity]"
                                                                        value="{{ $relatedItem->purchase_price ?? null }}" />
                                                                </div>
                                                            </div>

                                                            <div class=""
                                                                style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                                <label for="" class="form-label">Jasa
                                                                    Antar</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="number"
                                                                        class="form-control form-control-solid" disabled
                                                                        name="content[][purchase_delivery]"
                                                                        value="{{ $relatedItem->purchase_delivery_charge ?? null }}" />
                                                                </div>
                                                            </div>

                                                            <div class="d-flex justify-content-between"
                                                                style="flex-basis: 28%; min-width: 150px; margin: 10px;">
                                                                <div style="flex-basis: 80%; min-width: 120px;">
                                                                    <label for="" class="form-label">Total
                                                                        Price</label>
                                                                    <div class="position-relative">
                                                                        <div class="position-absolute top-0"></div>
                                                                        <input type="number"
                                                                            class="form-control form-control-solid"
                                                                            disabled name="content[][total_price]"
                                                                            value="{{ $relatedItem->total_price ?? null }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-center align-items-center"
                                                                    style="flex-basis: 14%; min-width: 30px;">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-icon btn-danger clear-soft-survey-item"
                                                                        data-random-string="{{ $random_string }}">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <input type="hidden" name="content[][id]" disabled
                                                                    value="{{ $relatedItem->id ?? null }}" />
                                                                <input type="hidden" name="content[][item_inventory_id]"
                                                                    disabled
                                                                    value="{{ $relatedItem->item_inventory_id ?? null }}" />
                                                                <input type="hidden" name="content[][purchase_reference]"
                                                                    disabled
                                                                    value="{{ $relatedItem->purchase_refrence ?? null }}" />
                                                                <input type="hidden" name="content[][item_detail]"
                                                                    disabled
                                                                    value="{{ $relatedItem->item_detail ?? null }}" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </div>
                                        @role('administrator')
                                            <div class="ms-15 w-20 mt-3 mb-3 ">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div>
                                        @endrole
                                    </div>

                                    <div>
                                        <div class="d-flex justify-content-end mx-20">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : <span></span></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-6">
                                            <div class=" me-5">
                                                <a href="" class="btn btn-light-info">Discard</a>
                                            </div>

                                            <div class="me-5">
                                                <a href="#" id="submit-all-items" class="btn btn-info">Submit</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @role('administrator')
        @include('cmt-opportunity.boq.add.modal-tambah-boq')
        {{-- @include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv') --}}
    @endrole


    <script>
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
        function calculateTotalAmount() {
            // Mengambil nilai dari masing-masing input
            const purchasePrice = parseFloat(document.getElementsByName('purchase_price')[0].value);
            const quantity = parseInt(document.getElementsByName('quantity')[0].value);
            const purchaseDelivery = parseFloat(document.getElementsByName('purchase_delivery')[0].value);

            // Cek jika nilai purchasePrice dan quantity adalah angka
            if (isNaN(purchasePrice) || isNaN(quantity)) {
                // Jika ada input yang belum diisi atau bukan angka, tampilkan hasil kosong dan return
                document.getElementById('total').textContent = "";
                const hiddenTotalInput = document.querySelector('.total');
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
                document.getElementById('total').textContent = "Melewati limit angka";
                const hiddenTotalInput = document.querySelector('.total');
                hiddenTotalInput.value = ""; // Set the hidden input value to empty string
                return;
            }

            // Menampilkan total dalam format dengan tanda titik setiap 3 digit dari kanan
            const totalAmountWithCommas = new Intl.NumberFormat().format(totalAmount);

            // Mengatur nilai total pada elemen dengan id 'totalDisplay'
            document.getElementById('total').textContent = totalAmountWithCommas;

            // Mengatur nilai total pada elemen dengan class 'total' (hidden input)
            const hiddenTotalInput = document.querySelector('.total');
            hiddenTotalInput.value = totalAmount; // Store the numerical value for passing to the main page.
        }

        //  function cek object dari masing2 item console
        function processItemsData() {
            $('.MultipleItem [class^="file-soft-boq-item"]').each(function(index, item) {
                // Extract data for each item
                var itemName = $(item).find('input[name="content[][good_name]"]').val();
                var itemMerk = $(item).find('input[name="content[][good_merk]"]').val();
                var itemPrice = $(item).find('input[name="content[][purchase_price]"]').val();
                var itemQty = $(item).find('input[name="content[][quantity]"]').val();
                var itemDelivery = $(item).find('input[name="content[][purchase_delivery]"]').val();
                var itemTotal = $(item).find('input[name="content[][total]"]').val();

                var itemInventory = $(item).find('input[name="content[][item_inventory_id]"]').val();
                var itemReference = $(item).find('input[name="content[][purchase_reference]"]').val();
                var itemDetail = $(item).find('input[name="content[][item_detail]"]').val();

                // Console log the data for each item
                console.log('Item ' + (index + 1) + ':');
                console.log('Item Name      : ' + itemName);
                console.log('Item Merk      : ' + itemMerk);
                console.log('Item Price     : ' + itemPrice);
                console.log('Item Quantity  : ' + itemQty);
                console.log('Item Delivery  : ' + itemDelivery);
                console.log('Item Total     : ' + itemTotal);

                console.log('Item Inventory : ' + itemInventory);
                console.log('Item Reference : ' + itemReference);
                console.log('Item Detail    : ' + itemDetail);
                console.log('--------------------------');
            });
        }

        $(document).ready(function() {
            // function Submit BOQ page BENERAN wkwkw
            $('#submit-all-items').on('click', function(event) {
                event.preventDefault();

                // Get Prospect ID and Survey ID from the HTML elements
                var prospect_id = $('#prospect_id').val();
                var survey_request_id = $('#survey_request_id').val();

                // Validate the prospect_id
                if (!prospect_id) {
                    var errorMessageProspect =
                        "<span class='fw-semibold fs-8 text-danger'>Pilih Prospect Terlebih Dahulu.</span>";
                    $('#error-prospect').html(errorMessageProspect);
                    return;
                } else {
                    $('#error-prospect').empty();

                }


                // Array to store all item data
                var items = [];
                // Create an object to store prospect_id and survey_request_id
                var boq = {
                    prospect_id: prospect_id,
                    survey_request_id: survey_request_id
                };

                console.log(boq);

                // Loop through each .file-soft-boq-item div to get the data for each item
                $('.MultipleItem [class^="file-soft-boq-item"]').each(function(index, item) {
                    // Extract data for the specific item
                    var id = $(item).find(
                        'input[name="content[][id]"]').val();
                    var item_inventory_id = $(item).find(
                        'input[name="content[][item_inventory_id]"]').val();
                    var item_detail = $(item).find(
                        'input[name="content[][item_detail]"]').val();
                    var quantity = $(item).find('input[name="content[][quantity]"]').val();
                    var purchase_price = $(item).find(
                        'input[name="content[][purchase_price]"]').val();
                    var purchase_delivery = $(item).find(
                        'input[name="content[][purchase_delivery]"]').val();
                    var purchase_reference = $(item).find(
                        'input[name="content[][purchase_reference]"]').val();
                    var total_price = $(item).find(
                        'input[name="content[][total_price]"]').val();

                    // Create an object to store the data for the specific item
                    var itemData = {
                        id: id,
                        item_inventory_id: item_inventory_id,
                        item_detail: item_detail,
                        quantity: quantity,
                        purchase_price: purchase_price,
                        purchase_delivery: purchase_delivery,
                        purchase_reference: purchase_reference,
                        total_price: total_price
                    };

                    // Push the itemData object to the items array
                    items.push(itemData);
                });

                // Check if there is at least one item in the 'items' array
                if (items.length === 0) {
                    // Show an error message
                    var errorMessageItem =
                        "<span class='fw-semibold fs-8 text-danger'>Please add at least one Item.</span>";
                    $('#error-item').html(errorMessageItem);
                    return;
                } else {
                    $('#error-item').empty();
                }
                console.log(items);
                // Send the data to the server using AJAX
                $.ajax({
                    url: "{{ route('com.boq.save.boq') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        boq: boq,
                        items: items
                    },
                    success: function(response) {
                        // Handle the response from the server, e.g., show a success message
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle errors if the request fails
                        console.error('Error submitting all item data: ', error);
                    }
                });
            });

            // Handler untuk peristiwa "change" pada Prospect id di Title prospect
            $('#prospect_id').on('change', function() {

                var prospect_id = $(this).val();
                var url = $(this).data('url');
                $('.MultipleItem').empty();
                // Mengirim permintaan asinkron menggunakan AJAX untuk mendapatkan data jenis dan merek item
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        prospect_id: prospect_id
                    }, // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
                    success: function(response) {



                        console.log(response);
                        const survey = response.survey;
                        const dataCompany = response.dataCompany;

                        if (survey.length >= 1) {
                            survey.foreach((item) => {
                                $('#survey_request_id').append(new Option(item
                                    .no_survey, item.id, false, false)).trigger(
                                    'change');
                            });
                        }

                        if (dataCompany && dataCompany.customer) {
                            $('#customer_name').val(dataCompany.customer.customer_name)
                                .prop(
                                    'disabled', true);
                            $('#customer_contact_name').val(dataCompany.customer
                                .customer_contact.customer_contact_name).prop(
                                'disabled',
                                true);
                            $('#customer_contact_phone').val(dataCompany.customer
                                .customer_contact.customer_contact_phone).prop(
                                'disabled',
                                true);
                            $('#type_name').val(dataCompany.customer.bussines_type
                                    .type_name)
                                .prop('disabled', true);
                        } else {
                            // Set the input values to blank if dataCompany or customer object is empty
                            $('#customer_name').val("").prop('disabled', true);
                            $('#customer_contact_name').val("").prop('disabled', true);
                            $('#customer_contact_phone').val("").prop('disabled', true);
                            $('#type_name').val("").prop('disabled', true);
                        }

                        // const dataItems = response.dataItems;

                        // ... your existing code for survey and dataCompany ...

                        // Clear previous items in the .MultipleItem class

                        //                     if (dataItems && dataItems.length > 0) {
                        //                         // If dataItems is not null and has data, access the first element in the outer collection
                        //                         const itemableBillOfQuantities = dataItems[0];

                        //                         // Access the 'itemableBillOfQuantities' relationship on the 'ItemableBillOfQuantities' object
                        //                         const relatedItems = itemableBillOfQuantities.itemableBillOfQuantities;

                        //                         // Iterate through the collection of 'Items' objects within the 'itemableBillOfQuantities' relationship
                        //                         relatedItems.forEach((relatedItem) => {
                        //                             const randomString = generateRandomString(4);

                        //                             // Your code to access the properties within each 'relatedItem'
                        //                             const goodName = relatedItem.inventoryGood.good_name;
                        //                             const goodMerk = relatedItem.inventoryGood.merk;
                        //                             const purchasePrice = relatedItem.purchase_price;
                        //                             const quantity = relatedItem.quantity;
                        //                             const purchaseDelivery = relatedItem
                        //                                 .purchase_delivery_charge;
                        //                             const totalPrice = relatedItem.total_price;
                        //                             const id = relatedItem.id;
                        //                             const itemInventoryId = relatedItem.item_inventory_id;
                        //                             const purchaseReference = relatedItem.purchase_refrence;
                        //                             const itemDetail = relatedItem.item_detail;

                        //                             // Append the HTML template using the extracted data
                        //                             $('.MultipleItem').append(`
                    //   <!-- Display data from itemableBillOfQuantities -->
                    //   <!-- Display data from relatedItem -->
                    //   <div class="file-soft-boq-item-${randomString} d-flex justify-content-between mx-20 mb-5 mt-10">
                    //       <!-- Your existing HTML template -->
                    //       <!-- Use the extracted data here -->
                    //       <input type="text" class="form-control form-control-solid" disabled name="content[][good_name]"
                    //           value="${goodName}" />
                    //       <input type="text" class="form-control form-control-solid" disabled name="content[][good_merk]"
                    //           value="${goodMerk}" />
                    //       <input type="number" class="form-control form-control-solid" disabled name="content[][purchase_price]"
                    //           value="${purchasePrice}" />
                    //       <input type="number" class="form-control form-control-solid" disabled name="content[][quantity]"
                    //           value="${quantity}" />
                    //       <input type="number" class="form-control form-control-solid" disabled name="content[][purchase_delivery]"
                    //           value="${purchaseDelivery}" />
                    //       <input type="number" class="form-control form-control-solid" disabled name="content[][total_price]"
                    //           value="${totalPrice}" />
                    //       <input type="hidden" name="content[][id]" disabled value="${id}" />
                    //       <input type="hidden" name="content[][item_inventory_id]" disabled value="${itemInventoryId}" />
                    //       <input type="hidden" name="content[][purchase_reference]" disabled value="${purchaseReference}" />
                    //       <input type="hidden" name="content[][item_detail]" disabled value="${itemDetail}" />
                    //   </div>
                    // `);
                        //         });
                        //     }
                    },
                    error: function(error) {
                        console.log(error);
                    }





                });
            });

            // Function hapis item frontend
            $('.MultipleItem').on('click', '.clear-soft-survey-item', function() {
                var random_string = $(this).data('random-string');
                console.log(random_string);
                $(this).closest('.file-soft-boq-item-' + random_string).remove();
            });

            // Function Tambah BOQ modal
            $('#btn-tambah-boq').on('click', '.btn_tambah_boq', function() {
                $('.drop-data').val("").trigger("change");
                $('#kt_modal_tambah_boq_form').trigger("reset");
                $('#kt_modal_tambah_boq_submit').removeAttr('disabled', 'disabled');
            });

            // Handler untuk peristiwa "change" pada select item
            $('#good_name').on('change', function() {
                var selectedItemId = $(this).val();
                var url = $(this).data('url');
                // Mengirim permintaan asinkron menggunakan AJAX untuk mendapatkan data jenis dan merek item
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        item_id: selectedItemId
                    }, // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
                    success: function(response) {
                        console.log(response);
                        $('#good_type').val(response.good_type).prop('disabled',
                            true);
                        $('#merk').val(response.merk).prop('disabled', true);
                        $('#detail').val(response.description).prop('disabled',
                            true);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Function Submit BOQ modal
            $("#kt_modal_tambah_boq_form").validate({
                messages: {
                    good_name: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Pilih Item Terlebih Dahulu</span>",
                    },
                    purchase_price: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Harga Barang wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Harga minimal memiliki 3 Angka</span>",
                    },
                    quantity: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Quantity wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Quantity minimal memiliki 1 angka</span>",
                    },
                    purchase_delivery: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Jasa antar wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Jasa Antar minimal memiliki 3 Angka</span>",
                    },
                },
                submitHandler: function(form) {
                    event.preventDefault();

                    // ngambil inputan nama dan merk
                    var selectedItemId = $('#good_name').val();
                    var itemName = $('#good_name option:selected').text();
                    var itemMerk = $('#merk').val();

                    // Create a hidden input to pass the selected item's name
                    var itemNameInput = $('<input>').attr({
                        type: 'hidden',
                        name: 'content[][good_name]',
                        value: itemName
                    });

                    // Append the hidden input to the form
                    $(form).append(itemNameInput);
                    // console.log(form);
                    let random_string = generateRandomString(4);
                    var formData = new FormData(form);

                    var newItem = `
                    <div class="file-soft-boq-item-${random_string} d-flex justify-content-between mx-20 mb-5 mt-10">
                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Item</label>
                            <input type="text" class="form-control form-control-solid" name="content[][good_name]" value="${itemName}" />
                        </div>

                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Merk</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="text" class="form-control form-control-solid" name="content[][good_merk]" value="${itemMerk}" />
                            </div>
                        </div>

                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Price</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][purchase_price]" value="${formData.get('purchase_price')}" />
                            </div>
                        </div>

                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Qty</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][quantity]" value="${formData.get('quantity')}" />
                            </div>
                        </div>

                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Jasa Antar</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][purchase_delivery]" value="${formData.get('purchase_delivery')}" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-between" style="flex-basis: 28%; min-width: 150px; margin: 10px;">
                            <div style="flex-basis: 80%; min-width: 120px;">
                                <label for="" class="form-label">Total Price</label>
                                <div class="position-relative">
                                    <div class="position-absolute top-0"></div>
                                    <input type="number" class="form-control form-control-solid" name="content[][total_price]" value="${formData.get('total')}" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="flex-basis: 14%; min-width: 30px;">
                                <button type="button" class="btn btn-sm btn-icon btn-danger clear-soft-survey-item-${random_string}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>  
                        <div>
                            <input type="hidden" name="content[][item_inventory_id]" value="${formData.get('good_name')}">
                            <input type="hidden" name="content[][purchase_reference]" value="${formData.get('purchase_reference')}">
                            <input type="hidden" name="content[][item_detail]" value="${formData.get('item_detail')}">
                        </div>
                    </div>`;


                    // Function Hapus per Item
                    $('.MultipleItem').on('click', `.clear-soft-survey-item-${random_string}`,
                        function() {
                            console.log(random_string);
                            $(this).parent().parent().parent().remove();
                        });


                    // Tambahkan item baru ke div "MultipleItem"
                    $('.MultipleItem').append(newItem);

                    // Bersihkan input setelah item ditambahkan
                    form.reset();

                    // Tutup modal
                    $('#kt_modal_tambah_boq').modal('hide');

                    // Clear any previous error message if items are present
                    $('#error-item').empty();
                }
            });

        });
    </script>

@endsection
