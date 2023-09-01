@extends('layouts.app')
@section('title-apps', 'Quotation')
@section('sub-title-apps-2', 'Quotation')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Quotation')
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
    {{-- @dd($dataQuotation['boqFinalData'][0]->customerProspect->customer->customer_name)   --}}
    {{-- @dd($dataQuotation['boqFinalData']->customerProspect->customer->customer_name)   --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-6 align-items-center">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Update Quotation Internet</span>
                                </div>
                            </div>

                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    @csrf
                                    {{-- divv Company --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        {{-- baris prospect company --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">
                                            <div class="col-lg-5 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataQuotation['boqFinalData'][0]->customerProspect->prospect_title }} - {{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customer_name }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->prospect_id }}">

                                                <div id="error-prospect"></div>
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-5 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->survey_request_id }}"
                                                    {{ $dataQuotation['boqFinalData'][0]->survey_request_id ?? 'Survey Tidak ada' }}>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris company contact --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--  divv ITEM --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            @if (isset($dataQuotation['boqFinalData'][0]->itemable))

                                                @foreach ($dataQuotation['boqFinalData'][0]->itemable as $relatedItem)
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

                                                        <div class=""
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
                                        {{-- @role('administrator')
                                            <div class="ms-15 w-20 mt-3 mb-3 ">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal" id="btn-tambah-boq"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div>
                                        @endrole --}}
                                    </div>

                                    {{--  divv BUNDLE INTERNET --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="BundleItem">


                                            <div
                                                class="file-soft-quotation-bundle-{{ $random_string }} d-flex justify-content-between mx-20 mb-5 mt-10">

                                                <div class="" style="flex-basis: 35%; min-width: 200px;  ">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" required>
                                                        <span class="required fw-bold">Internet Bundle</span>
                                                    </label>
                                                    <select class="form-select form-select-solid drop-data" required
                                                        data-control="select2" name="good_name_bundle" id="good_name_bundle">
                                                        <option value="">Select Internet Bundle</option>
                                                    </select>
                                                </div>

                                                <div class="" style="flex-basis: 14%; min-width: 150px;  ">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class=" fw-bold">Jenis Item</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="good_type_bundle"
                                                        id="good_type_bundle" disabled>
                                                </div>

                                                <div class="" style="flex-basis: 14%; min-width: 150px;  ">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class=" fw-bold">Merek</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="merk_bundle"
                                                        id="merk_bundle" disabled>
                                                </div>

                                                <div class="" style="flex-basis: 20%; min-width: 200px;  ">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class=" fw-bold">Detail Item inventory</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="detail_bundle"
                                                        id="detail_bundle" disabled>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- divv SUBMIT DAN TOTAL AMOUNT --}}
                                    <div>
                                        <div class="d-flex justify-content-end mx-20">                                    
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : Rp<span id="totalsum"></span></span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-6">
                                            
                                            <div class=" me-5">
                                                <a href="" class="btn btn-light-info">Discard</a>
                                            </div>
                                            <div class="me-5">
                                                <a href="cmt-boq" id="submit-all-items" class="btn btn-danger">Print PDF</a>
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
        @include('cmt-opportunity.quotation.add.modal-tambah-bundle-internet')
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

            var dataFromFirstResponse = null; // Variabel untuk menyimpan data dari respons pertama

            // Handler untuk peristiwa "change" pada select item
            $('#good_name_bundle').on('change', function() {
                var selectedItemId = $(this).val();

                // Cek apakah data dari respons pertama sudah ada
                if (dataFromFirstResponse) {
                    // Cari item dengan ID yang sesuai dalam data pertama
                    var selectedItem = dataFromFirstResponse.find(function(item) {
                        return item.id == selectedItemId;
                    });

                    // Isi input dengan data dari item yang sesuai
                    if (selectedItem) {
                        $('#good_type_bundle').val(selectedItem.good_type).prop('disabled', true);
                        $('#merk_bundle').val(selectedItem.merk).prop('disabled', true);
                        $('#detail_bundle').val(selectedItem.description).prop('disabled', true);
                    }
                }
            });

            // Render opsi pertama saat halaman dimuat
            $.ajax({
                url: "{{ route('com.quotation.get.internet.bundling') }}",
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    dataFromFirstResponse = response; // Simpan data dari respons pertama
                    $('#good_name_bundle').empty(); // Hapus opsi yang ada sebelumnya
                    $('#good_name_bundle').append($('<option>', {
                        value: '',
                        text: 'Select Internet Bundle'
                    }));
                    $.each(response, function(index, item) {
                        $('#good_name_bundle').append($('<option>', {
                            value: item.id,
                            text: item.good_name
                        }));
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });



            // Function Tambah Modal Bundling Internet
            $('#btn-bundle-internet').on('click', '.btn_tambah_boq', function() {
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

            // Function Submit Modal
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
            //  Calculate and update total sum on page load
            updateTotalSum();
        });
    </script>
@endsection
