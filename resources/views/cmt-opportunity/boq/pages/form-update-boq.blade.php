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
    {{-- @dd($updateDraftBoqData["dataForm"])   --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-6 align-items-center">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Update Bill of Quantity</span>
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
                                                    placeholder="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->prospect_title }} - {{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->prospect_id }}">

                                                <div id="error-prospect"></div>
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-5 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->survey_request_id }}"
                                                    {{ $updateDraftBoqData['dataCompanyItem'][0]->survey_request_id ?? 'Survey Tidak ada' }}>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris Rilll --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            {{-- Cek Dari db items jika ada masukkan di sni
                                            {{-- inputan dari modal masuk kesni --}}
                                            @if (isset($updateDraftBoqData['dataCompanyItem'][0]->itemable))

                                                @foreach ($updateDraftBoqData['dataCompanyItem'][0]->itemable as $relatedItem)
                                                    <!-- Display data from $relatedItem -->
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <div
                                                        class="file-soft-boq-item-{{ $random_string }} d-flex justify-content-between mx-20 mb-5 mt-10">
                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Item</label>
                                                            <input type="text" class="form-control form-control-solid"
                                                                disabled name="content[][good_name]"
                                                                value="{{ $relatedItem->inventoryGood->good_name ?? null }}" />
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Merk</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="text"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][good_merk]"
                                                                    value="{{ $relatedItem->inventoryGood->merk ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Price</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][purchase_price]"
                                                                    value="{{ $relatedItem->purchase_price ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Qty</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][quantity]"
                                                                    value="{{ $relatedItem->quantity ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Jasa
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
                                                                <label class="form-label">Total
                                                                    Price</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="number"
                                                                        class="total-price form-control form-control-solid"
                                                                        disabled name="content[][total_price]"
                                                                        value="{{ $relatedItem->total_price ?? null }}" />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-center align-items-center"
                                                                style="flex-basis: 14%; min-width: 30px;">
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-icon btn-sm"
                                                                    data-kt-menu-placement="bottom-end"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li type="button" class="btn-update-boq-modal"
                                                                        data-random-string="{{ $random_string }}"
                                                                        data-item-id="{{ $relatedItem->item_inventory_id }}"
                                                                        data-quantity="{{ $relatedItem->quantity }}"
                                                                        data-total_price="{{ $relatedItem->total_price }}"
                                                                        data-purchase_delivery_charge="{{ $relatedItem->purchase_delivery_charge }}"
                                                                        data-purchase_price="{{ $relatedItem->purchase_price }}"
                                                                        data-purchase_refrence="{{ $relatedItem->purchase_refrence }}"
                                                                        data-item_detail="{{ $relatedItem->item_detail }}">
                                                                        <a class="dropdown-item py-2">
                                                                            <i class="fa-solid fa-edit me-3"></i>Edit
                                                                            Item</a>
                                                                    </li>
                                                                    <li type="button" class="clear-soft-survey-item"
                                                                        data-random-string="{{ $random_string }}">
                                                                        <a class="dropdown-item py-2">
                                                                            <i class="fa-solid fa-trash me-3"></i>Hapus
                                                                            Item</a>
                                                                    </li>
                                                                </ul>
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
                                                            <input type="hidden" name="content[][item_detail]" disabled
                                                                value="{{ $relatedItem->item_detail ?? null }}" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>

                                        @role('administrator')
                                            <div class="ms-15 w-20 mt-3 mb-3 ">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal" id="btn-tambah-boq"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div>
                                        @endrole
                                    </div>

                                    <div>
                                        <div class="d-flex justify-content-between mx-20">
                                            <div class="form-check form-check-custom form-check-success form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="0"
                                                    id="is_draft" name="is_draft" />
                                                <label class="form-check-label" for="is_draft">Next to Commercial</label>
                                            </div>
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : <span id="totalsum"></span></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-6">
                                            <div class=" me-5">
                                                <a href="" class="btn btn-light-info">Discard</a>
                                            </div>

                                            <div class="me-5">
                                                <a href="cmt-boq" id="submit-all-items" class="btn btn-info">Submit</a>
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
        @include('cmt-opportunity.boq.add.modal-update-boq')
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

        $(document).ready(function() {
            // function Submit BOQ page BENERAN wkwkw
            $('#submit-all-items').on('click', function(event) {
                // event.preventDefault();

                // Get Prospect ID and Survey ID from the HTML elements
                var prospect_id = $('#prospect_id').val();
                var survey_request_id = $('#survey_request_id').val();
                var is_draft = $('#is_draft').is(':checked') ? 0 : 1;

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
                    survey_request_id: survey_request_id,
                    is_draft: is_draft
                };

                // console.log(boq);

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

            // Function Update BOQ modal
            $('.btn-update-boq-modal').on('click', function() {
                var randomString = $(this).data('random-string');
                var itemId = parseInt($(this).data('itemId'));
                console.log($(this).data('itemId'));

                var quantity = $(this).data('quantity');
                var total_price = ($(this).data('total_price'));
                var purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                var purchase_price = ($(this).data('purchase_price'));
                var purchase_refrence = $(this).data('purchase_refrence');
                var item_detail = ($(this).data('item_detail'));
                // console.log(randomString, itemId, quantity, total_price, purchase_delivery_charge,
                //     purchase_price, purchase_refrence, item_detail);

                $('#good_name_update').val(itemId).trigger('change');

                $('#kt_modal_update_boq').modal('show');

                $('#uniq_id').val(randomString);

                $('#item_detail_update').val(item_detail);
                $('#purchase_refrence_update').val(purchase_refrence);
                $('#purchase_price_update').val(purchase_price);
                $('#purchase_delivery_charge_update').val(purchase_delivery_charge);
                $('#total_price_update').val(total_price);
                $('#quantity_update').val(quantity);
                document.getElementById('total_update').textContent = total_price;
            });

            // Handler untuk peristiwa "change" pada select item
            $('#good_name_update').on('change', function() {
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
                        $('#good_type_update').val(response.good_type).prop('disabled', true);
                        $('#merk_update').val(response.merk).prop('disabled', true);
                        $('#detail_update').val(response.description).prop('disabled', true);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Funcion Submit Update BOQ 
            $("#kt_modal_update_boq_form").validate({
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

                    // Menggunakan jQuery untuk mendapatkan inputan nama dan merk
                    var selectedItemId = $('#good_name_update').val();
                    var itemName = $('#good_name_update option:selected').text();
                    var itemMerk = $('#merk_update').val();

                    // Membuat elemen input tersembunyi untuk nama barang
                    var itemNameInput = $('<input>').attr({
                        type: 'text',
                        name: 'content[][good_name]',
                        value: itemName
                    });

                    // Menambahkan elemen input tersembunyi ke dalam form
                    $(form).append(itemNameInput);

                    var formData = new FormData(form);

                    const uniq_id = formData.get('uniq_id');

                    const item = document.querySelectorAll(
                        `.MultipleItem .file-soft-boq-item-${uniq_id}`);

                    let data = $(`.btn-update-boq-modal[data-random-string="${uniq_id}"]`); 

                    // Mengatur ulang atribut-atribut elemen <li> berdasarkan formData
                    data.attr({
                        'data-item-id': selectedItemId,
                        'data-quantity': formData.get('quantity_update'),
                        'data-total_price': formData.get('total_update'),
                        'data-purchase_delivery_charge': formData.get('purchase_delivery_update'),
                        'data-purchase_price': formData.get('purchase_price_update'),
                        'data-purchase_refrence': formData.get('purchase_reference'),
                        'data-item_detail': formData.get('item_detail')
                    });
                    
                    data.data({
                        'item-id': selectedItemId,
                        'quantity': formData.get('quantity_update'),
                        'total_price': formData.get('total_update'),
                        'purchase_delivery_charge': formData.get('purchase_delivery_update'),
                        'purchase_price': formData.get('purchase_price_update'),
                        'purchase_refrence': formData.get('purchase_reference'),
                        'item_detail': formData.get('item_detail')
                    }); 

                    $('[name="content[][good_name]"]', item).val(itemName);
                    $('[name="content[][good_merk]"]', item).val(itemMerk);
                    $('[name="content[][purchase_price]"]', item).val(formData.get(
                        'purchase_price_update'));
                    $('[name="content[][quantity]"]', item).val(formData.get('quantity_update'));
                    $('[name="content[][purchase_delivery]"]', item).val(formData.get(
                        'purchase_delivery_update'));
                    $('[name="content[][purchase_reference]"]', item).val(formData.get(
                        'purchase_reference'));
                    $('[name="content[][item_detail]"]', item).val(formData.get('item_detail'));
                    $('[name="content[][total_price]"]', item).val(formData.get('total_update'));
                    $('[name="content[][item_inventory_id]"]', item).val(formData.get('good_name'));

                    // Hapus elemen itemNameInput dari formulir
                    itemNameInput.remove();

                    // Bersihkan input setelah item ditambahkan
                    form.reset();

                    // // Tutup modal
                    $('#kt_modal_update_boq').modal('hide');

                    updateTotalSum();
                }
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
                        $('#good_type').val(response.good_type).prop('disabled', true);
                        $('#merk').val(response.merk).prop('disabled', true);
                        $('#detail').val(response.description).prop('disabled', true);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Function Hapus Item Frontend
            $('.MultipleItem').on('click', '.clear-soft-survey-item', function() {
                var random_string = $(this).data('random-string');
                $(this).closest('.file-soft-boq-item-' + random_string).remove();
                updateTotalSum();
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
                                <input type="number" class="form-control form-control-solid" name="content[][purchase_price]" value="${formData.get('purchase_price_tambah')}" />
                            </div>
                        </div>

                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Qty</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][quantity]" value="${formData.get('quantity_tambah')}" />
                            </div>
                        </div>

                        <div class="" style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                            <label for="" class="form-label">Jasa Antar</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][purchase_delivery]" value="${formData.get('purchase_delivery_tambah')}" />
                                </div>
                        </div>
                        
                        <div class="d-flex justify-content-between" style="flex-basis: 28%; min-width: 150px; margin: 10px;">
                            <div style="flex-basis: 80%; min-width: 120px;">
                                <label for="" class="form-label">Total Price</label>
                                <div class="position-relative">
                                    <div class="position-absolute top-0"></div>
                                    <input type="number" class="form-control form-control-solid" name="content[][total_price]" value="${formData.get('total_tambah')}" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="flex-basis: 14%; min-width: 30px;">
                
                                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                
                                    <ul class="dropdown-menu">
                                        <li type="button" class="btn-update-boq-modal" 
                                            data-random-string="${random_string}" 
                                            data-item-id="${formData.get('good_name')}"

                                            data-quantity="${formData.get('quantity_tambah')}"
                                            data-total_price="${formData.get('total_tambah')}"
                                            data-purchase_delivery_charge="${formData.get('purchase_delivery_tambah')}"
                                            data-purchase_price="${formData.get('purchase_price_tambah')}"
                                            data-purchase_refrence="${formData.get('purchase_reference')}"
                                            data-item_detail="${formData.get('item_detail')}"">                                            
                                            
                                            <a class="dropdown-item py-2">
                                            <i class="fa-solid fa-edit me-3"></i>Edit Item</a>                                       
                                        </li>
                                        <li type="button" class="clear-soft-survey-item-${random_string}"
                                            data-random-string="${random_string}">
                                            <a class="dropdown-item py-2">
                                            <i class="fa-solid fa-trash me-3"></i>Hapus Item</a>
                                        </li>
                                </ul>
                            </div>
                        </div>  
                        <div>
                            <input type="hidden" name="content[][item_inventory_id]" value="${formData.get('good_name')}" disabled>
                            <input type="hidden" name="content[][purchase_reference]" value="${formData.get('purchase_reference')}" disabled>
                            <input type="hidden" name="content[][item_detail]" value="${formData.get('item_detail')}" disabled>
                        </div>
                    </div>`;


                    // Function Hapus per Item
                    $('.MultipleItem').on('click', `.clear-soft-survey-item-${random_string}`,
                        function() {
                            $(this).parent().parent().parent().parent().remove();
                            updateTotalSum();
                        });

                    // Function Update BOQ modal
                    $('.MultipleItem').on('click', '.btn-update-boq-modal', function() {

                        var randomString = $(this).data('random-string');
                        var itemId = parseInt($(this).data('item-id'));
                        var quantity = $(this).data('quantity');
                        var total_price = $(this).data('total_price');
                        var purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                        var purchase_price = $(this).data('purchase_price');
                        var purchase_refrence = $(this).data('purchase_refrence');
                        var item_detail = $(this).data('item_detail');

                        console.log(randomString, itemId, quantity, total_price,
                            purchase_delivery_charge,
                            purchase_price, purchase_refrence, item_detail);

                        $('#good_name_update').val(itemId).trigger('change');

                        $('#kt_modal_update_boq').modal('show');

                        $('#uniq_id').val(randomString);

                        $('#item_detail_update').val(item_detail);
                        $('#purchase_refrence_update').val(purchase_refrence);
                        $('#purchase_price_update').val(purchase_price);
                        $('#purchase_delivery_charge_update').val(purchase_delivery_charge);
                        $('#total_price_update').val(total_price);
                        $('#quantity_update').val(quantity);
                        document.getElementById('total_update').textContent = total_price;
                    });

                    // Tambahkan item baru ke div "MultipleItem"
                    $('.MultipleItem').append(newItem);

                    // Bersihkan input setelah item ditambahkan
                    form.reset();

                    // Tutup modal
                    $('#kt_modal_tambah_boq').modal('hide');

                    // Clear any previous error message if items are present
                    $('#error-item').empty();
                    updateTotalSum();
                }
            });

            //  Calculate and update total sum on page load
            updateTotalSum();

            function updateTotalSum() {
                var totalSum = 0;

                // Loop through each item's total price input field and sum up the values
                $('.MultipleItem input[name="content[][total_price]"]').each(function() {
                    var totalPriceValue = $(this).val();

                    if (totalPriceValue !== "") {
                        totalSum += parseInt(totalPriceValue);
                    }
                });
                const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSum);
                // Update the total sum element with the calculated value
                $('#totalsum').text(totalPriceWithCommas);
            }
        });
    </script>
@endsection
