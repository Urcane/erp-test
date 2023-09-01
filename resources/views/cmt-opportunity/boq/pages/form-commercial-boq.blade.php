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
    {{-- BOQ  COMMERCIAL --}}
    {{-- @dd($dataSurvey) --}}
    {{-- @dd($dataProspect) --}}
    {{-- @dd($updateDraftBoqData['dataSalesSelected']) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="card-body">
                            @csrf
                            <div class="mb-6 d-flex justify-content-between">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Commercial Bill of Quantity</span>
                                </div>
                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_final"
                                        name="is_final" />
                                    <label class="form-check-label" for="is_final">Finalisasi</label>
                                </div>
                            </div>

                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">
                                 
                                    {{-- divv Company --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        {{-- baris prospect company --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8 row">

                                            <input type="hidden" id="boq_id" name="boq_id"  value="{{$updateDraftBoqData['dataCompanyItem'][0]->id}}">
                                            
                                            <div class="col-lg-6">
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

                                            <div class="col-lg-6">
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

                                        {{-- baris company contact --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8 row">

                                            <div class="col-lg-3">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class="col-lg-3">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class="col-lg-3">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone" id="customer_contact_phone"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- sales & gpm required --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8 row">

                                            <div class="col-lg-4">
                                                <label class="form-label required">Sales</label>
                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="sales_id" id="sales_id">
                                                    <option value="{{ $updateDraftBoqData['dataSalesSelected']->id ?? null}}" selected disabled>{{ $updateDraftBoqData['dataSalesSelected']->name ?? "Pilih Sales"  }}</option>
                                                    @if (isset($updateDraftBoqData['dataSales']))
                                                        @foreach ($updateDraftBoqData['dataSales'] as $sales)
                                                            <option value="{{ $sales->id ?? null }}">
                                                                {{ $sales->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label class="form-label required">Technician</label>
                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="technician_id" id="technician_id">
                                                    <option value="{{ $updateDraftBoqData['dataTechnicianSelected']->id ?? null}}" selected disabled>{{ $updateDraftBoqData['dataTechnicianSelected']->name ?? "Pilih Technician"  }}</option>
                                                    @if (isset($updateDraftBoqData['dataTechnician']))
                                                        @foreach ($updateDraftBoqData['dataTechnician'] as $Technician)
                                                            <option value="{{ $Technician->id ?? null }}">
                                                                {{ $Technician->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label class="form-label required">Procurement</label>
                                                <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="procurement_id" id="procurement_id">
                                                    <option value="{{ $updateDraftBoqData['dataProcurementSelected']->id ?? null}}" selected disabled>{{ $updateDraftBoqData['dataProcurementSelected']->name ?? "Pilih Procurement"  }}</option>
                                                   @if (isset($updateDraftBoqData['dataProcurement']))
                                                        @foreach ($updateDraftBoqData['dataProcurement'] as $procurement)
                                                            <option value="{{ $procurement->id ?? null }}">
                                                                {{ $procurement->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class="col-lg-2">
                                                <label class="form-label required">GPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid required"
                                                        oninput="validateAndFormatNumber(this);" id="gpm"
                                                        name="gpm" value="{{ $updateDraftBoqData['dataCompanyItem'][0]->gpm ?? null}}"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <label class="form-label required">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid required"
                                                        oninput="validateAndFormatNumber(this);" id="modal"
                                                        name="modal" value="{{ $updateDraftBoqData['dataCompanyItem'][0]->modal ?? null}}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <label class="form-label required">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid required"
                                                        oninput="validateAndFormatNumber(this);" id="npm"
                                                        name="npm" value="{{ $updateDraftBoqData['dataCompanyItem'][0]->npm ?? null}}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <label class="form-label required">Manpower</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid required"
                                                        oninput="validateAndFormatNumber(this);" id="manpower"
                                                        name="manpower" value="{{ $updateDraftBoqData['dataCompanyItem'][0]->manpower ?? null}}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <label class="form-label required">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid required"
                                                        oninput="validateAndFormatNumber(this);" id="percentage"
                                                        name="percentage" value="{{ $updateDraftBoqData['dataCompanyItem'][0]->percentage ?? null}}" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tempat Items --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            @if (isset($updateDraftBoqData['dataCompanyItem'][0]->itemable))
                                                @foreach ($updateDraftBoqData['dataCompanyItem'][0]->itemable as $relatedItem)
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <div
                                                        class="file-soft-boq-item-{{ $random_string }} d-flex justify-content-between mx-20 mb-5 mt-10 row">
                                                        <div class="col-lg-3">
                                                            <label class="form-label">Item</label>
                                                            <input type="text" class="form-control form-control-solid"
                                                                disabled name="content[][good_name]"
                                                                value="{{ $relatedItem->inventoryGood->good_name ?? null }} - {{ $relatedItem->inventoryGood->merk ?? null }}" />
                                                        </div>

                                                        <div class="col-lg-2">
                                                            <label class="form-label">Price</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][purchase_price]"
                                                                    value="{{ $relatedItem->purchase_price ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label class="form-label">Qty</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][quantity]"
                                                                    value="{{ $relatedItem->quantity ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="" class="form-label">Tipe Unit</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input disabled="disabled" type="text" class="form-control form-control-solid" name="content[][unit]" value="{{ $relatedItem->unit ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2">
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

                                                        <div class="col-lg-2">
                                                            <div class="row">
                                                                <div class="col-lg-10">
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
                                                                <div class="col-lg-2">
                                                                    <div class="h-30px"></div>
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-icon btn-sm"
                                                                        data-kt-menu-placement="bottom-end"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li type="button" class="btn-update-boq-modal"
                                                                            data-random-string="{{ $random_string }}"
                                                                            data-item-id="{{ $relatedItem->inventory_good_id }}"
                                                                            data-quantity="{{ $relatedItem->quantity }}"
                                                                            data-unit="{{ $relatedItem->unit }}"
                                                                            data-total_price="{{ $relatedItem->total_price }}"
                                                                            data-purchase_delivery_charge="{{ $relatedItem->purchase_delivery_charge }}"
                                                                            data-purchase_price="{{ $relatedItem->purchase_price }}"
                                                                            data-purchase_reference="{{ $relatedItem->purchase_reference }}"
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
                                                        </div>

                                                        <div>
                                                            <input type="hidden" name="content[][id]" disabled
                                                                value="{{ $relatedItem->id ?? null }}" />
                                                            <input type="hidden" name="content[][item_inventory_id]"
                                                                disabled
                                                                value="{{ $relatedItem->inventory_good_id ?? null }}" />
                                                            <input type="hidden" name="content[][purchase_reference]"
                                                                disabled
                                                                value="{{ $relatedItem->purchase_reference ?? null }}" />
                                                            <input type="hidden" name="content[][item_detail]" disabled
                                                                value="{{ $relatedItem->item_detail ?? null }}" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        @role('administrator')
                                            <div class="mx-20 my-10 col-lg-2">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm mx-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div>
                                        @endrole

                                    </div>

                                    {{-- layer total dan submit --}}
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
                                                <button type="button" id="submit-all-items" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
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
                // function Submit BOQ page BENERAN wkwkw
                $('#submit-all-items').on('click', function(event) {
                    // event.preventDefault();

                    // Get Prospect ID and Survey ID from the HTML elements
                    // var survey_request_id = $('#survey_request_id').val();
                    var boq_id = $('#boq_id').val();
                    var prospect_id = $('#prospect_id').val();

                    var sales_id = $('#sales_id').val();
                    var technician_id = $('#technician_id').val();
                    var procurement_id = $('#procurement_id').val();

                    var modal = $('#modal').val();
                    var gpm = $('#gpm').val();
                    var npm = $('#npm').val();
                    var manpower = $('#manpower').val();
                    var percentage = $('#percentage').val();

                    var is_final = $('#is_final').is(':checked') ? 1 : 0;
                     
                    // Validate the prospect_id
                    // if (!prospect_id) {
                    //     var errorMessageProspect =
                    //         "<span class='fw-semibold fs-8 text-danger'>Pilih Prospect Terlebih Dahulu.</span>";
                    //     $('#error-prospect').html(errorMessageProspect);
                    //     return;
                    // } else {
                    //     $('#error-prospect').empty();
                    // }


                    // Array to store all item data
                    var items = [];
                    // Create an object to store prospect_id and survey_request_id
                    var boq = {
                        boq_id: boq_id,
                        prospect_id: prospect_id,
                        is_final: is_final,

                        sales_id: sales_id,
                        technician_id: technician_id,
                        procurement_id,
                        procurement_id,

                        modal: modal,
                        gpm: gpm,
                        npm: npm,
                        manpower: manpower,
                        percentage: percentage
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
                        var unit = $(item).find('input[name="content[][unit]"]').val();
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
                            unit: unit,
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
                        url: "{{ route('com.boq.store.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            boq: boq,
                            items: items
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 800);
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.error);
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
                    var unit = $(this).data('unit');
                    var total_price = ($(this).data('total_price'));
                    var purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                    var purchase_price = ($(this).data('purchase_price'));
                    var purchase_reference = $(this).data('purchase_reference');
                    var item_detail = ($(this).data('item_detail'));
                    // console.log(randomString, itemId, quantity, total_price, purchase_delivery_charge,
                    //     purchase_price, purchase_reference, item_detail);

                    $('#good_name_update').val(itemId).trigger('change');

                    $('#kt_modal_update_boq').modal('show');

                    $('#uniq_id').val(randomString);

                    $('#item_detail_update').val(item_detail);
                    $('#purchase_reference_update').val(purchase_reference);
                    $('#purchase_price_update').val(purchase_price);
                    $('#purchase_delivery_charge_update').val(purchase_delivery_charge);
                    $('#total_price_update').val(total_price);
                    $('#quantity_update').val(quantity);
                    $('#unit_update').val(unit).trigger('change');
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
                        unit: {
                            required: "<span class='fw-semibold fs-8 text-danger'>Unit wajib diisi</span>",
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
                            'data-unit': formData.get('unit_update'),
                            'data-total_price': formData.get('total_update'),
                            'data-purchase_delivery_charge': formData.get(
                                'purchase_delivery_update'),
                            'data-purchase_price': formData.get('purchase_price_update'),
                            'data-purchase_reference': formData.get('purchase_reference'),
                            'data-item_detail': formData.get('item_detail')
                        });

                        data.data({
                            'item-id': selectedItemId,
                            'quantity': formData.get('quantity_update'),
                            'unit': formData.get('unit_update'),
                            'total_price': formData.get('total_update'),
                            'purchase_delivery_charge': formData.get('purchase_delivery_update'),
                            'purchase_price': formData.get('purchase_price_update'),
                            'purchase_reference': formData.get('purchase_reference'),
                            'item_detail': formData.get('item_detail')
                        });

                        $('[name="content[][good_name]"]', item).val(itemName);
                        $('[name="content[][good_merk]"]', item).val(itemMerk);
                        $('[name="content[][purchase_price]"]', item).val(formData.get(
                            'purchase_price_update'));
                        $('[name="content[][quantity]"]', item).val(formData.get('quantity_update'));
                        $('[name="content[][unit]"]', item).val(formData.get('unit_update'));
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
                        unit: {
                            required: "<span class='fw-semibold fs-8 text-danger'>unit wajib diisi</span>",
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
                    <div class="file-soft-boq-item-${random_string} d-flex justify-content-between mx-20 mb-5 mt-10 row">
                        <div class="col-lg-3">
                            <label for="" class="form-label">Item</label>
                            <input type="text" class="form-control form-control-solid" name="content[][good_name]" value="${itemName} - ${itemMerk}" />
                        </div>

                        <div class="col-lg-2">
                            <label for="" class="form-label">Price</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][purchase_price]" value="${formData.get('purchase_price_tambah')}" />
                            </div>
                        </div>

                        <div class="col-lg-1">
                            <label for="" class="form-label">Qty</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][quantity]" value="${formData.get('quantity_tambah')}" />
                            </div>
                        </div>

                        <div class="col-lg-1">
                            <label for="" class="form-label">Tipe Unit</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="text" class="form-control form-control-solid" name="content[][unit]" value="${formData.get('unit')}" />
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <label for="" class="form-label">Jasa Antar</label>
                            <div class="position-relative">
                                <div class="position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid" name="content[][purchase_delivery]" value="${formData.get('purchase_delivery_tambah')}" />
                                </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col-lg-10">
                                    <label class="form-label">Total
                                        Price</label>
                                    <div class="position-relative">
                                        <div class="position-absolute top-0"></div>
                                        <input type="number" class="form-control form-control-solid" name="content[][total_price]" value="${formData.get('total_tambah')}" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="h-30px"></div>
                                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    
                                        <ul class="dropdown-menu">
                                            <li type="button" class="btn-update-boq-modal" 
                                                data-random-string="${random_string}" 
                                                data-item-id="${formData.get('good_name')}"

                                                data-quantity="${formData.get('quantity_tambah')}"
                                                data-unit="${formData.get('unit')}"
                                                data-total_price="${formData.get('total_tambah')}"
                                                data-purchase_delivery_charge="${formData.get('purchase_delivery_tambah')}"
                                                data-purchase_price="${formData.get('purchase_price_tambah')}"
                                                data-purchase_reference="${formData.get('purchase_reference')}"
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
                            var unit = $(this).data('unit');
                            var total_price = $(this).data('total_price');
                            var purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                            var purchase_price = $(this).data('purchase_price');
                            var purchase_reference = $(this).data('purchase_reference');
                            var item_detail = $(this).data('item_detail');

                            console.log(randomString, itemId, quantity, total_price,
                                purchase_delivery_charge,
                                purchase_price, purchase_reference, item_detail);

                            $('#good_name_update').val(itemId).trigger('change');

                            $('#kt_modal_update_boq').modal('show');

                            $('#uniq_id').val(randomString);

                            $('#item_detail_update').val(item_detail);
                            $('#purchase_reference_update').val(purchase_reference);
                            $('#purchase_price_update').val(purchase_price);
                            $('#purchase_delivery_charge_update').val(purchase_delivery_charge);
                            $('#total_price_update').val(total_price);
                            $('#quantity_update').val(quantity);
                            $('#unit_update').val(unit).trigger('change');
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
