@extends('layouts.app')
@section('title-apps', 'BOQ')
@section('sub-title-apps-2', 'Commercial')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Bill Of Quantity')
@section('icon-apps', 'fa-solid fa-briefcase')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Create Bill of Quantity</span>
                            </h3> 
                        </div> 
                        <div class="card-body">  
                            {{-- header company --}}
                            <div class="row">
                                <form class="col-lg-12" id="kt_create_draft_boq_form">
                                    @csrf
                                    {{-- Company --}}
                                    <div class="col-lg-12 mb-5 mt-3 border-dashed border-gray-100">

                                        {{-- baris Rilll --}}
                                        <div class="my-8 d-flex justify-content-around flex-wrap col-lg-12">
                                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                                            <input type="hidden" name="boq_id" value="">
                                            
                                            <div class="col-lg-4 col-8 col-sm-4 col-md-4  mb-3">
                                                <label for="prospect_id" class="d-flex align-items-center fs-6 form-label mb-2 required" >
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>

                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-url="{{ route('com.boq.create-draft-boq') }}"
                                                    data-control="select2" required name="prospect_id" id="prospect_id">
                                                    <option value="{{ $dataCompany->id ?? null }}" selected>
                                                        {{ $dataCompany->prospect_title ?? 'Pilih Prospect' }}
                                                        {{ $dataCompany->customer->customer_name ?? null }}</option>
                                                    @foreach ($dataProspect as $prospect)
                                                        <option value="{{ $prospect->id ?? null }}">
                                                            {{ $prospect->prospect_title ?? null }}
                                                            {{ $prospect->customer->customer_name ?? null }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="error-prospect"></div> 
                                                {{-- <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataCompany->prospect_title ?? null }} {{ $dataCompany->customer->customer_name ?? null }}">

                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $dataCompany->id ?? null }}"> --}} 
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-4 col-8 col-sm-4 col-md-4  mb-3">
                                                <label for="survey_request_id" class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="survey_request_id" id="survey_request_id">
                                                    <option disabled selected>Pilih Survey</option>
                                                    @if (isset($dataSurvey))
                                                        @foreach ($dataSurvey as $survey)
                                                            @if ($selectedDataSurvey == $survey->id)
                                                            <option value="{{ $survey->id ?? null }}" selected>
                                                                {{ $survey->no_survey ?? null }}
                                                            </option>
                                                            @else
                                                            <option value="{{ $survey->id ?? null }}">
                                                                {{ $survey->no_survey ?? null }}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-sm-2 col-md-2  mb-3">
                                                <label for="boq_type" class="d-flex align-items-center fs-6 form-label mb-2 required" >
                                                    <span class="fw-bold">Tipe BOQ</span>
                                                </label>
                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" required name="boq_type" id="boq_type">
                                                    <option selected disabled value="">Pilih</option>
                                                    <option value="perangkat">Perangkat</option>
                                                    <option value="internet">Internet</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- baris Rilll --}}
                                        <div class="my-8 d-flex justify-content-around flex-wrap col-lg-12">

                                            <div class="col-lg-2 col-8 col-sm-5 col-md-5 mb-3">
                                                <label for="customer_name" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="customer_name" id="customer_name"
                                                    value="{{ $dataCompany->customer->customer_name ?? null }}">
                                            </div>

                                            <div class="col-lg-2 col-8 col-sm-5 col-md-5 mb-3">
                                                <label for="customer_contact_name" class=" form-label">Nama Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_name ?? null }}"
                                                    name="">
                                            </div>

                                            <div class="col-lg-2 col-8 col-sm-5 col-md-5 mb-3">
                                                <label for="customer_contact_phone" class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataCompany->customer->customerContact->customer_contact_phone ?? null }}"
                                                        name="" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-sm-5 col-md-5 mb-3">
                                                <label for="type_name" class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataCompany->customer->bussinesType->type_name ?? null }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--  item --}}
                                    <div class="col-lg-12 mb-6 border-dashed border-gray-100">

                                        <div class="MultipleItem col-lg-12">

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

                                    {{-- akhir total amount --}}
                                    <div>
                                        {{-- <div class="d-flex justify-content-end mx-20">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : Rp.<span id="totalsum"></span></span>
                                            </div>
                                        </div> --}}

                                        <div class="d-flex justify-content-center mt-6">
                                            <div class=" me-5">
                                                <a href="{{route('com.boq.index')}}" class="btn btn-light-info">Discard</a>
                                            </div>

                                            <div class="me-5">
                                                <button type="button" id="submit-all-items" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
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
        $(document).ready(function() {
            // function SUBMIT FORM
            $('#submit-all-items').on('click', function(event) {
                // event.preventDefault();

                // Get Prospect ID and Survey ID from the HTML elements
                var prospect_id = $('#prospect_id').val();
                var survey_request_id = $('#survey_request_id').val();
                var boq_type = $('#boq_type').val();

                // Validate the prospect_id
                if (!prospect_id) {
                    event.preventDefault(); 
                    const errorMessageProspect = "<span class='fw-semibold fs-8 text-danger'>Pilih Prospect Terlebih Dahulu.</span>";
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
                    boq_type: boq_type,
                };

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
                    // var purchase_price = $(item).find(
                    //     'input[name="content[][purchase_price]"]').val();
                    // var purchase_delivery = $(item).find(
                    //     'input[name="content[][purchase_delivery]"]').val();
                    // var purchase_reference = $(item).find(
                    //     'input[name="content[][purchase_reference]"]').val();
                    var total_price = $(item).find(
                        'input[name="content[][total_price]"]').val();
                    var unit = $(item).find(
                        'input[name="content[][unit]"]').val();

                    // Create an object to store the data for the specific item
                    var itemData = {
                        id: id,
                        item_inventory_id: item_inventory_id,
                        item_detail: item_detail,
                        quantity: quantity,
                        // purchase_price: purchase_price,
                        // purchase_delivery: purchase_delivery,
                        // purchase_reference: purchase_reference,
                        total_price: total_price,
                        unit: unit
                    };

                    // Push the itemData object to the items array
                    items.push(itemData);
                    console.log(items)
                });

                // Check if there is at least one item in the 'items' array
                if (items.length === 0) {     
                    // Show an error message
                    event.preventDefault();
                    var errorMessageItem =
                        "<span class='fw-semibold fs-8 text-danger'>Please add at least one Item.</span>";
                    $('#error-item').html(errorMessageItem);
                    return;
                } else {
                    $('#error-item').empty();
                }
                // Send the data to the server using AJAX
                $.ajax({
                    url: "{{ route('com.boq.store.boq') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        boq: boq,
                        items: items
                    },
                    success: function(response) {
                        // Handle the response from the server, e.g., show a success message
                        window.location = "{{route('com.boq.index')}}";
                    },
                    error: function(error) {
                        // Handle errors if the request fails
                        toastr.error(error.responseJSON.error);
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
                    },
                    dataType: 'json', // Mengharapkan respons dalam format JSON
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Set header X-Requested-With
                    },
                    success: function(response) { 
                        // console.log(response);
                        const survey = response.dataSurvey;
                        const dataCompany = response.dataCompany;  

                        $('#survey_request_id').empty();
                        $('#survey_request_id').append($(
                            '<option>', {
                                selected: true,
                                disabled: 'disabled',
                                value: '',
                                text: 'Pilih Survey'
                            })).trigger('change');
                            
                        if (survey.length >= 1) {
                            survey.forEach((item) => {
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

                    },
                    error: function(error) {
                        console.error(error);
                    }

                });
            });



            // Handler untuk peristiwa "change" pada select item Update
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
                        $('#good_type_update').val(response.good_type).prop('disabled', true);
                        $('#merk_update').val(response.merk).prop('disabled', true);
                        $('#detail_update').val(response.description).prop('disabled', true);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
            // Funcion Submit Update BOQ 
            $("#kt_modal_update_boq_form").validate({
                messages: {
                    good_name: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Pilih Item Terlebih Dahulu</span>",
                    },
                    // purchase_price: {
                    //     required: "<span class='fw-semibold fs-8 text-danger'>Harga Barang wajib diisi</span>",
                    //     minlength: "<span class='fw-semibold fs-8 text-danger'>Harga minimal memiliki 3 Angka</span>",
                    // },
                    quantity: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Quantity wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Quantity minimal memiliki 1 angka</span>",
                    },
                    // purchase_delivery: {
                    //     required: "<span class='fw-semibold fs-8 text-danger'>Jasa antar wajib diisi</span>",
                    //     minlength: "<span class='fw-semibold fs-8 text-danger'>Jasa Antar minimal memiliki 3 Angka</span>",
                    // },
                },
                submitHandler: function(form) { 

                    // Menggunakan jQuery untuk mendapatkan inputan nama dan merk
                    var selectedItemId = $('#good_name_update').val();
                    var itemName = $('#good_name_update option:selected').text();
                    var itemMerk = $('#merk_update').val();

                    // Membuat elemen input tersembunyi untuk nama barang
                    var itemNameInput = $('<input>').attr({
                        type: 'hidden',
                        name: 'content[][good_name]',
                        value: itemName
                    });

                    // Menambahkan elemen input tersembunyi ke dalam form
                    $(form).append(itemNameInput); 

                    var formData = new FormData(form);

                    const uniq_id = formData.get('uniq_id');

                    const item = document.querySelectorAll(
                        `.MultipleItem .file-soft-boq-item-${uniq_id}`); 
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
                    $('[name="content[][unit]"]', item).val(formData.get('unit_update'));
                    $('[name="content[][item_inventory_id]"]', item).val(formData.get('good_name'));

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
                        $('#good_type').val(response.good_type).prop('disabled',
                            true);
                        $('#merk').val(response.merk).prop('disabled', true);
                        $('#detail').val(response.description).prop('disabled',
                            true);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

            // Function Submit Tambah BOQ modal
            $("#kt_modal_tambah_boq_form").validate({
                messages: {
                    good_name: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Pilih Item Terlebih Dahulu</span>",
                    },
                    // purchase_price: {
                    //     required: "<span class='fw-semibold fs-8 text-danger'>Harga Barang wajib diisi</span>",
                    //     minlength: "<span class='fw-semibold fs-8 text-danger'>Harga minimal memiliki 3 Angka</span>",
                    // },
                    quantity: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Quantity wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Quantity minimal memiliki 1 angka</span>",
                    },
                    // purchase_delivery: {
                    //     required: "<span class='fw-semibold fs-8 text-danger'>Jasa antar wajib diisi</span>",
                    //     minlength: "<span class='fw-semibold fs-8 text-danger'>Jasa Antar minimal memiliki 3 Angka</span>",
                    // },
                },
                submitHandler: function(form) {
                    // event.preventDefault();

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
                    <div class="file-soft-boq-item-${random_string} d-flex justify-content-around flex-wrap col-12 mb-5 mt-10">
                        <div class="col-lg-2 col-md-2 col-sm-5 col-8">
                            <label for="good_name_${random_string}"  class="form-label">Item</label>
                            <input id="good_name_${random_string}" disabled="disabled" type="text" class="form-control form-control-solid" name="content[][good_name]" value="${itemName}" />
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-5 col-8">
                            <label for="good_merk_${random_string}"  class="form-label">Merk</label> 
                                <div class=" top-0"></div>
                                <input id="good_merk_${random_string}" disabled="disabled" type="text" class="form-control form-control-solid" name="content[][good_merk]" value="${itemMerk}" />
                             
                        </div>
                        `+
                        // <div class="col-lg-2 col-8">
                        //     <label for="${random_string}"  class="form-label">Price</label>
                        //     
                        //         <div class="position-absolute top-0"></div>
                        //         <input id="purchase_price_${random_string}" disabled="disabled" type="number" class="form-control form-control-solid" name="content[][purchase_price]" value="${formData.get('purchase_price_tambah')}" />
                        //      
                        // </div>
                        `

                        <div class="col-lg-2 col-md-2 col-sm-5 col-8">
                            <label for="quantity_${random_string}"  class="form-label">Qty</label> 
                                <div class=" top-0"></div>
                                <input id="quantity_${random_string}" disabled="disabled" type="number" class="form-control form-control-solid" name="content[][quantity]" value="${formData.get('quantity_tambah')}" />
                             
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-nowrap col-lg-2 col-md-2 col-sm-5 col-8">
                             
                                <div class="col-lg-9 col-md-9 col-sm-9 col-9"> 
                                    <label for="unit_${random_string}"  class="form-label">Unit</label>  
                                    <input id="unit_${random_string}" disabled="disabled" type="text" class="form-control form-control-solid" name="content[][unit]" value="${formData.get('unit')}" />
                                </div>
                                `+ 
                                    // <div class="col-lg-2 col-8">
                                    //     <label for="${random_string}"  class="form-label">Jasa Antar</label>
                                    //     <div class="">
                                    //         <div class=" top-0"></div>
                                    //         <input id="purchase_delivery_${random_string}" disabled="disabled" type="number" class="form-control form-control-solid" name="content[][purchase_delivery]" value="${formData.get('purchase_delivery_tambah')}" />
                                    //         </div>
                                    // </div>
                                    // <div style="flex-basis: 80%; min-width: 120px;">
                                    //     <label for="${random_string}"  class="form-label">Total Price</label>
                                    //     <div class="">
                                    //         <div class=" top-0"></div>
                                    //         <input id="total_price_${random_string}" disabled="disabled" type="number" class="form-control form-control-solid" name="content[][total_price]" value="${formData.get('total_tambah')}" />
                                    //     </div>
                                    // </div>
                                    `  
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2" > 
                                        <div class="h-25px"></div> 
                                        <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li type="button" class="btn-update-boq-modal" 
                                                data-random-string="${random_string}" 
                                                data-item-id="${formData.get('good_name')}"

                                                data-quantity="${formData.get('quantity_tambah')}"
                                                data-total_price="${formData.get('total_tambah')}"
                                                data-unit="${formData.get('unit')}"`+
                                                // data-purchase_delivery_charge="${formData.get('purchase_delivery_tambah')}"
                                                // data-purchase_price="${formData.get('purchase_price_tambah')}"
                                                // data-purchase_reference="${formData.get('purchase_reference')}"
                                                `
                                                data-item_detail="${formData.get('item_detail')}">                                            
                                                
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
                        <input disabled="disabled" type="hidden" name="content[][item_inventory_id]" value="${formData.get('good_name')}" disabled>
                        <input disabled="disabled" type="hidden" name="content[][purchase_reference]" value="${formData.get('purchase_reference')}" disabled>
                        <input disabled="disabled" type="hidden" name="content[][item_detail]" value="${formData.get('item_detail')}" disabled>
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
                        var unit = $(this).data('unit');
                        // var purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                        // var purchase_price = $(this).data('purchase_price');
                        // var purchase_reference = $(this).data('purchase_reference');
                        var item_detail = $(this).data('item_detail');

                        // console.log(randomString, itemId, quantity, total_price,
                        //     purchase_delivery_charge,
                        //     purchase_price, purchase_reference, item_detail);

                        $('#good_name_update').val(itemId).trigger('change');

                        $('#kt_modal_update_boq').modal('show');

                        $('#uniq_id').val(randomString);

                        $('#item_detail_update').val(item_detail);
                        // $('#purchase_reference_update').val(purchase_reference);
                        // $('#purchase_price_update').val(purchase_price);
                        // $('#purchase_delivery_charge_update').val(purchase_delivery_charge);
                        $('#total_price_update').val(total_price);
                        $('#unit_update').val(unit).trigger('change');
                        $('#quantity_update').val(quantity);
                        // document.getElementById('total_update').textContent = total_price;
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
        });
    </script>

@endsection
