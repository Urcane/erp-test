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

                                        <div class="d-flex justify-content-start flex-wrap mx-20 my-8">
                                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Judul Prospect</span>
                                                </label>
                                                <select class="drop-data form-select form-select-solid"
                                                    data-control="select2" required name="prospect_id" id="prospect_id" 
                                                    {{-- data-url="{{ route('get.survey.company') }}" --}}
                                                    >
                                                    <option value="" selected hidden disabled>Pilih Dulu</option>
                                                    {{-- @foreach ($dataProspect as $gp)
                                                        <option value="{{ $gp->id }}">{{ $gig->prospect_title }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-6 col-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input class="form-control" type="text" name="survey_id" id="survey_id"
                                                    disabled>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris Rilll --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    value="{{ $dataCompany->customer->customer_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_name }}"
                                                    name="">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class="form-label">No Kontak
                                                    Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8"
                                                        value="{{ $dataCompany->customer->customerContact->customer_contact_phone }}"
                                                        name="" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label for="" class="form-label">Jenis
                                                    Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>

                                        {{-- baris 1 --}}
                                        {{-- <div class="d-flex justify-content-between mx-20 my-8">
                                            <div class="w-75">
                                                <label for="" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    value="{{ $dataCompany->customer->customer_name }}">
                                            </div>

                                            <div class="ms-10 w-25">
                                                <label for="" class="form-label">Tenggat
                                                    Waktu</label>
                                                <div class="position-relative">
                                                    <div class=" position-absolute top-0"></div>
                                                    <input type="date" class="form-control form-control-solid" />
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- baris2 --}}
                                        {{-- <div class="d-flex justify-content-between mx-20 my-8">
                                            <div class="w-50">
                                                <label for="" class="form-label">Alamat Perusahaan</label>
                                                <textarea class="form-control form-control-solid" disabled rows="2" required style="resize:none">{{ $dataCompany->customer->customer_address }}</textarea>
                                            </div>

                                            <div class="w-25">
                                                <label for="" class="form-label">Jenis
                                                    Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->bussinesType->type_name }}">
                                            </div>
                                        </div> --}}

                                        {{-- baris 3 lat lng --}}
                                        {{-- <div class="d-flex justify-content-around mx-15 my-8">
                                            <div class="w-25">
                                                <label for="" class=" form-label">Lat</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->lat }}" name=" ">
                                            </div>

                                            <div class="w-25">
                                                <label for="" class="form-label">Lng</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->lng }}" name="">
                                            </div>
                                        </div> --}}

                                        {{-- baris 4 contatct --}}
                                        {{-- <div class="d-flex justify-content-around mx-20 my-8">
                                            <div class="w-9vw">
                                                <label for="" class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_name }}"
                                                    name="">
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="form-label">Jabatan
                                                    Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_job }}"
                                                    name="">
                                            </div>
                                            <div class="w-9vw">
                                                <label for="" class=" form-label">Email Customer</label>
                                                <input type="email" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_email }}"
                                                    name="">
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="form-label">No Kontak
                                                    Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8"
                                                        value="{{ $dataCompany->customer->customerContact->customer_contact_phone }}"
                                                        name="" />
                                                </div>
                                            </div>

                                           <div class="w-9vw">
                                                <label for=""
                                                    class="required form-label">Manpower</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="manpower"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span class="input-group-text border-0">Orang</span>
                                                </div>
                                            </div> 

                                        </div> --}}

                                        {{-- baris pengadaan --}}
                                        {{-- <div class="d-flex justify-content-between mx-20 my-8 mt-10px">
                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Lama
                                                    Pengadaan Barang</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="pengadaan_barang"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Hari</span>
                                                </div>
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Lama
                                                    Pengiriman Barang</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="pengiriman_barang"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Hari</span>
                                                </div>
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Lama
                                                    Perjalanan Tim</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="perjalanan_tim"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Hari</span>
                                                </div>
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Manpower</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="manpower"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Orang</span>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>


                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            {{-- inputan dari modal masuk kesni --}}

                                        </div>

                                        @role('administrator')
                                            <div class="ms-15 w-20 mt-3 ">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
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
                                                <a href="#" id="submit-all-items" class="btn btn-info">Submit RILL</a>
                                            </div>

                                            <div class="me-5">
                                                <button type="submit" id="submit-button" class="btn btn-info">Submit
                                                    Console</button>
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

            // Melakukan perhitungan total
            const totalAmount = purchasePrice * quantity + purchaseDelivery;

            // Menampilkan total dalam format dengan tanda titik setiap 3 digit dari kanan
            const formattedTotal = new Intl.NumberFormat().format(totalAmount);

            // Mengatur nilai total pada elemen dengan id 'totalDisplay'
            document.getElementById('total').textContent = formattedTotal;

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

                var itemInventory = $(item).find('input[name="content[][item_inventry_id]"]').val();
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
            // function Submit BOQ page CONSOLE
            $('#submit-button').on('click', function() {
                // Call the function to process and display the data
                processItemsData();

            });

            // function Submit BOQ page BENERAN wkwkw
            $('#submit-all-items').on('click', function(event) {
                event.preventDefault();

                // Array to store all item data
                var items = [];

                // Loop through each .file-soft-boq-item div to get the data for each item
                $('.MultipleItem [class^="file-soft-boq-item"]').each(function(index, item) {
                    // Extract data for the specific item
                    var item_inventry_id = $(item).find(
                        'input[name="content[][item_inventry_id]"]').val();
                    var item_detail = $(item).find(
                        'input[name="content[][item_detail]"]').val();
                    var quantity = $(item).find('input[name="content[][quantity]"]')
                        .val();
                    var purchase_price = $(item).find(
                        'input[name="content[][purchase_price]"]').val();
                    var purchase_delivery = $(item).find(
                        'input[name="content[][purchase_delivery]"]').val();
                    var purchase_reference = $(item).find(
                        'input[name="content[][purchase_reference]"]').val();

                    // Create an object to store the data for the specific item
                    var itemData = {
                        item_inventry_id: item_inventry_id,
                        item_detail: item_detail,
                        quantity: quantity,
                        purchase_price: purchase_price,
                        purchase_delivery: purchase_delivery,
                        purchase_reference: purchase_reference
                    };

                    // Push the itemData object to the items array
                    items.push(itemData);

                    console.log(items);
                });

                // Send the data to the server using AJAX
                // $.ajax({
                //     url: '/api/submit_all_items', // Replace this with your server-side API endpoint
                //     method: 'POST',
                //     data: {
                //         // boq: boq,
                //         items: items,

                //     },
                //     success: function(response) {
                //         // Handle the response from the server, e.g., show a success message
                //         console.log(
                //             'All item data successfully submitted to the server.'
                //             );
                //     },
                //     error: function(error) {
                //         // Handle errors if the request fails
                //         console.error('Error submitting all item data: ', error);
                //     }
                // });
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
                        $('#good_type').val(response.good_type).prop('disabled', true);
                        $('#merk').val(response.merk).prop('disabled', true);
                        $('#detail').val(response.description).prop('disabled', true);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Function Tambah BOQ modal
            $('body').on('click', '.btn_tambah_boq', function() {
                $('.drop-data').val("").trigger("change");
                $('#kt_modal_tambah_boq_form').trigger("reset");
                $('#kt_modal_tambah_boq_submit').removeAttr('disabled', 'disabled');
            });

            // Function Submit BOQ modal
            $("#kt_modal_tambah_boq_form").validate({
                messages: {
                    good_name: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Pilih Item Terlebih Dahulu</span>",
                    },
                    purchase_price: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Harga wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Harga minimal memiliki 3 Angka</span>",
                    },
                    quantity: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Nomor wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Quantity minimal memiliki 1 angka</span>",
                    },
                    purchase_delivery: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Nomor wajib diisi</span>",
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
                                    <input type="number" class="form-control form-control-solid" name="content[][total]" value="${formData.get('total')}" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="flex-basis: 14%; min-width: 30px;">
                                <button type="button" class="btn btn-sm btn-icon btn-danger clear-soft-survey-item-${random_string}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>  
                        <div>
                            <input type="hidden" name="content[][item_inventry_id]" value="${formData.get('good_name')}">
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
                }
            });

        });
    </script>

@endsection
