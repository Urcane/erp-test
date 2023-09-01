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
    {{-- @dd($dataBoq['boqFinalData'][0]->customerProspect->customer->customer_name)   --}}
    {{-- @dd($dataBoq['boqFinalData']->customerProspect->customer->customer_name)   --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-6 align-items-center">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Create Internet
                                        Quotation</span>
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
                                                    placeholder="{{ $dataBoq['boqFinalData'][0]->customerProspect->prospect_title }} - {{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customer_name }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $dataBoq['boqFinalData'][0]->prospect_id }}">

                                                <div id="error-prospect"></div>
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-5 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $dataBoq['boqFinalData'][0]->survey_request_id }}"
                                                    {{ $dataBoq['boqFinalData'][0]->survey_request_id ?? 'Survey Tidak ada' }}>
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
                                                    value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--  divv ITEM --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            @if (isset($dataBoq['boqFinalData'][0]->itemable))

                                                @foreach ($dataBoq['boqFinalData'][0]->itemable as $relatedItem)
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


                                            <div class="d-flex justify-content-between mx-20 mb-5 mt-10">

                                                <div class="d-flex justify-content-around align-items-center"
                                                    style="flex-basis: 40%; min-width: 200px;">
                                                    <div class="" style="flex-basis: 85%;">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            required>
                                                            <span class="required fw-bold">Internet Bundle</span>
                                                        </label>
                                                        <select class="form-select form-select-solid drop-data" required
                                                            data-control="select2" name="good_name_bundle"
                                                            id="good_name_bundle">
                                                            <option value="">Select Internet Bundle</option>
                                                        </select>
                                                    </div>
                                                    <div class="d-flex justify-content-center align-items-end"
                                                        style="flex-basis: 10%;">
                                                        <a href="#kt_modal_tambah_bundle_internet" data-bs-toggle="modal"
                                                            id="btn-bundle-internet"
                                                            class="btn btn-light-info btn-sm btn_bundle_internet"
                                                            style="flex-basis: 10%; width: 90%;">
                                                            <i class="fa-solid fa-plus"></i></a>
                                                        <div id="error-item"></div>
                                                    </div>
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
                    // console.log(response);
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
            $('#btn-bundle-internet').on('click', '.btn_bundle_internet', function() {
                $('.drop-data').val("").trigger("change");
                $('#kt_modal_tambah_bundle_internet_form').trigger("reset");
                $('#kt_modal_tambah_bundle_internet_submit').removeAttr('disabled', 'disabled');
            });

            // Function Submit Modal
            $("#kt_modal_tambah_bundle_internet_form").validate({
                messages: {
                    good_name_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Wajib Mengisi Nama Item</span>",
                    },
                    code_name_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Code Barang wajib diisi</span>",
                    },
                    merk_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Merk Barang wajib diisi</span>",
                    },
                    good_type_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Tipe Barang wajib diisi</span>",
                    },
                    description_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Deskripsi Barang wajib diisi</span>",
                    }
                },
                submitHandler: function() {
                    event.preventDefault();
                    // Dapatkan referensi ke elemen form
                    var form = document.getElementById("kt_modal_tambah_bundle_internet_form");

                    // Dapatkan nilai dari input berdasarkan nama (name)
                    var goodName = form.querySelector('input[name="good_name_update"]').value;
                    var codeName = form.querySelector('input[name="code_name_update"]').value;
                    var merk = form.querySelector('input[name="merk_update"]').value;
                    var goodType = form.querySelector('input[name="good_type_update"]').value;
                    var description = form.querySelector('textarea[name="description_update"]').value;
                    var goodCategoryId = form.querySelector('input[name="good_category_id_update"]')
                        .value;

                    // Sekarang, Anda memiliki nilai dari masing-masing input berdasarkan nama (name)
                    // console.log("Nama Inventory Item:", goodName);
                    // console.log("Code Item:", codeName);
                    // console.log("Merk:", merk);
                    // console.log("Tipe Barang:", goodType);
                    // console.log("Detail Item Inventory:", description);
                    // console.log("Good Category ID:", goodCategoryId);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('com.quotation.update.internet.bundling') }}", // Ganti dengan URL yang sesuai
                        data: {
                            _token: '{{ csrf_token() }}',
                            good_category_id: goodCategoryId,
                            good_name: goodName,
                            code_name: codeName,
                            merk: merk,
                            good_type: goodType,
                            description: description
                        },
                        success: function(response) {
                            console.log("Data berhasil disimpan:", response);
                            form.reset();

                            $('#kt_modal_tambah_bundle_internet').modal('hide');
                            // Hapus semua nilai dari dataFromFirstResponse
                            dataFromFirstResponse = null;

                            $.ajax({
                                url: "{{ route('com.quotation.get.internet.bundling') }}",
                                type: 'GET',
                                success: function(response) {
                                    console.log(response);
                                    dataFromFirstResponse =
                                        response; // Simpan data dari respons pertama
                                    $('#good_name_bundle')
                                        .empty(); // Hapus opsi yang ada sebelumnya
                                    $('#good_name_bundle').append($(
                                        '<option>', {
                                            value: '',
                                            text: 'Select Internet Bundle'
                                        }));
                                    $.each(response, function(index, item) {
                                        $('#good_name_bundle').append($(
                                            '<option>', {
                                                value: item.id,
                                                text: item
                                                    .good_name
                                            }));
                                    });
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });

                            $('#error-item').empty();
                        },
                        error: function(error) {
                            console.error("Terjadi kesalahan:", error);
                        },
                    });
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
