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
    {{-- @dd($dataQuotation['quotationData'])   --}}
    {{-- @dd($dataQuotation['quotationItem']) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Update Internet
                                    Quotation</span>
                            </h3> 
                            <div class="card-toolbar p-3">
                                <a href="#kt_modal_create_purchase_order" class="btn_create_purchase_order p- btn btn-md btn-info w-lg-180px" 
                                data-id="{{ $dataQuotation['quotationData']->id }}"
                                data-bs-toggle="modal"><i class="fa-solid fa-file me-3"></i>Purchase Order</a>


                                {{-- <button class="btn btn-md btn-info w-lg-150px purchase_order_file"
                                    onclick="myFunction()">Input File</button> --}}
                            </div>
                        </div>
                        <div class="card-body">
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

                                    {{--  divv GPM --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">GPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="gpm" disabled
                                                        name="gpm"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"disabled
                                                        oninput="validateAndFormatNumber(this);" id="modal"
                                                        name="modal"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="npm"disabled
                                                        name="npm"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Manpower</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="manpower"
                                                        name="manpower"disabled
                                                        value="{{ $dataQuotation['boqFinalData'][0]->manpower ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 10%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="percentage"
                                                        name="percentage"disabled
                                                        value="{{ $dataQuotation['boqFinalData'][0]->percentage ?? null }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  divv ITEM --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            @if (isset($dataQuotation['boqFinalData'][0]->itemable))

                                                @foreach ($dataQuotation['boqFinalData'][0]->itemable as $relatedItem)
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
                                        <div>
                                            <div class="d-flex justify-content-end mx-20">
                                                <div class="w-20 me-10">
                                                    <span class="fw-bold">Total Price Item : Rp<span
                                                            id="totalsum"></span></span>
                                                </div>
                                            </div>
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


                                    <form id="kt_create_quotation_internet_form"
                                        class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                        enctype="multipart/form-data">

                                        @csrf
                                        {{--  divv No Quota & Description --}}
                                        <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                            <div class="d-flex justify-content-around flex-wrap mx-20 my-8">
                                                <div class=""
                                                    style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                    <label class="form-label">
                                                        <span class="fw-bold required">NO Quotation</span> </label>
                                                    <div class="position-relative">
                                                        <div class="position-absolute top-0"></div>
                                                        <input type="text"
                                                            class="form-control form-control-solid required" required
                                                            id="no_quotation" name="no_quotation"
                                                            value="{{ $dataQuotation['quotationData']->no_quotation }}"
                                                            placeholder="No Quotation Wajib Di isi" />
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>

                                                <div class=""
                                                    style="flex-basis: 75%; min-width: 200px; margin-bottom: 15px;">
                                                    <label class="form-label">
                                                        <span class="fw-bold required">Description</span></label>
                                                    <div class="position-relative">
                                                        <div class="position-absolute top-0"></div>
                                                        <textarea class="form-control form-control-solid required"
                                                            placeholder="{{ $dataQuotation['quotationData']->description ?? 'Description Wajib Di isi' }}" required
                                                            name="description" id="description" cols="" rows="2">{{ $dataQuotation['quotationData']->description }}</textarea>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{--  divv BUNDLE INTERNET --}}
                                        <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                            <div class="BundleItem">
                                                @if (isset($dataQuotation['quotationItem']))

                                                    @foreach ($dataQuotation['quotationItem'] as $relatedItem)
                                                        @php
                                                            $random_string = \Illuminate\Support\Str::random(4);
                                                        @endphp

                                                        <div
                                                            class="file-soft-quotation-bundle-{{ $random_string }} d-flex justify-content-around flex-wrap mx-20 my-8">
                                                            <!-- Internet Bundle -->
                                                            <div class="d-flex justify-content-around align-items-center"
                                                                style="flex-basis: 35%; min-width: 200px;">
                                                                <div class="" style="flex-basis: 100%;">
                                                                    <label
                                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                                        <span class="required fw-bold">Internet
                                                                            Bundle</span>
                                                                    </label>
                                                                    <select class="form-select form-select-solid drop-data"
                                                                        data-control="select2"required
                                                                        name="good_name_bundle_{{ $random_string }}"
                                                                        id="good_name_bundle_{{ $random_string }}">

                                                                        @foreach ($dataQuotation['inventoryGoodInet'] as $item)
                                                                            @if ($relatedItem->item_inventory_id == $item->id)
                                                                                <option selected
                                                                                    value="{{ $item->id }}">
                                                                                    {{ $item->good_name }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $item->good_name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Quantity -->
                                                            <div style="flex-basis: 14%; min-width: 150px;">
                                                                <label
                                                                    class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold required">Quantity</span>
                                                                </label>
                                                                <input class="form-control" type="text" required
                                                                    min="1" minlength="1"
                                                                    oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                    name="quantity_{{ $random_string }}" id="quantity_{{ $random_string }}"
                                                                    value="{{ $relatedItem->quantity }}">
                                                            </div>

                                                            <!-- Purchase Price -->
                                                            <div style="flex-basis: 14%; min-width: 150px;">
                                                                <label
                                                                    class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold required">Purchase Price</span>
                                                                </label>
                                                                <input class="form-control" type="text" required
                                                                    min="1" minlength="1"
                                                                    oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                    name="purchase_price_{{ $random_string }}"
                                                                    value="{{ $relatedItem->purchase_price }}"
                                                                    id="purchase_price_{{ $random_string }}">
                                                            </div>

                                                            <!-- Total Price -->
                                                            <div class="d-flex justify-content-around align-items-center flex-nowrap"
                                                                style="flex-basis: 20%; min-width: 180px;">
                                                                <div class="" style="flex-basis: 80%;">
                                                                    <label
                                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                                        <span class="fw-bold">Total Price</span>
                                                                    </label>
                                                                    <input class="form-control" type="text"
                                                                        min="1" minlength="1" disabled
                                                                        oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                        name="total_price_{{ $random_string }}"
                                                                        id="total_price_{{ $random_string }}"
                                                                        value="{{ $relatedItem->total_price }}">
                                                                </div>
                                                                <div class="" style="flex-basis: 15%;">
                                                                    <div>
                                                                        <div class="h-25px"></div>
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-icon btn-sm h-44px"
                                                                            data-kt-menu-placement="bottom-end"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li type="button"
                                                                                class="clear-soft-quotation-bundle"
                                                                                data-random-string="{{ $random_string }}">
                                                                                <a class="dropdown-item py-2">
                                                                                    <i
                                                                                        class="fa-solid fa-trash me-3"></i>Hapus
                                                                                    Item
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif





                                                {{-- <div class="ms-15 w-20 mt-6 mb-5 ">
                                                <button class="btn btn-light-info btn-sm me-3 btn_bundle" id="btn-bundle">
                                                    <i class="fa-solid fa-plus"></i>Tambah Bundle Internet
                                                </button> 
                                            </div> --}}
                                            </div>

                                        </div>

                                        {{-- divv TAMBAH, SUBMIT DAN TOTAL AMOUNT INTERNET BUNDLE --}}
                                        <div>
                                            <div class="d-flex justify-content-start mx-20">
                                                <div class="w-20 me-10">
                                                    <button class="btn btn-light-info btn-sm me-3 btn_bundle"
                                                        id="btn-bundle">
                                                        <i class="fa-solid fa-plus"></i>Tambah Bundle Internet
                                                    </button>
                                                </div>
                                                <div class="w-20 me-10">
                                                    <a href="#kt_modal_tambah_bundle_internet" data-bs-toggle="modal"
                                                        id="btn-bundle-internet"
                                                        class="btn btn-light-info btn-sm btn_bundle_internet">
                                                        <i class="fa-solid fa-plus"></i>Tambah Bundle Baru</a>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end mx-20">
                                                {{-- <div class="w-20 me-10">
                                                <button class="btn btn-light-info btn-sm me-3 btn_bundle" id="btn-bundle">
                                                    <i class="fa-solid fa-plus"></i>Tambah Bundle Internet
                                                </button> 
                                            </div> --}}
                                                <div class="w-20 me-10">
                                                    <span class="fw-bold">Total Price Bundle : Rp<span
                                                            id="totalsumbundle"></span></span>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center mt-6">

                                                <div class=" me-5">
                                                    <button type="reset" id="kt_modal_tambah_boq_cancel"
                                                        class="btn btn-sm btn-light-info me-3 w-lg-200px"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                                <div class="me-5">

                                                    <button type="submit" id="kt_modal_tambah_boq_submit"
                                                        class="btn btn-sm btn-info w-lg-200px">
                                                        <span class="indicator-label">Submit</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- div input hidden --}}
                                        <div>
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $dataQuotation['boqFinalData'][0]->id }}">
                                            <input type="hidden" name="total_price_bundle" id="total_price_bundle">
                                        </div>

                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    @include('cmt-opportunity.quotation.add.modal-tambah-bundle-internet')
    @include('cmt-opportunity.quotation.add.modal-create-purchase-order') 

    <script>
        function myFunction() {
            var x = document.getElementById("fileInput");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
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

            updateTotalSumBundle();
        };


        function updateTotalSum() {
            var totalSum = 0;

            // Loop through each item's total price input field and sum up the values
            $('.MultipleItem input[name^="content[][total_price]"]').each(function() {
                var totalPriceValue = $(this).val();

                if (totalPriceValue !== "") {
                    totalSum += parseInt(totalPriceValue);
                }
            });
            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSum);
            // Update the total sum element with the calculated value
            $('#totalsum').text(totalPriceWithCommas);
        }

        function updateTotalSumBundle() {
            var totalSumBundle = 0;

            const gpmVal = parseInt(document.querySelector(`[name='gpm']`).value);

            // Loop through each item's total price input field and sum up the values
            $('.BundleItem input[name^="total_price"]').each(function() {
                var totalPriceBundleValue = $(this).val();

                if (totalPriceBundleValue !== "") {
                    totalSumBundle += parseInt(totalPriceBundleValue);
                }
            });

            if (gpmVal <= totalSumBundle) {
                return document.getElementById("totalsumbundle").textContent = "   MELEBIHI LIMIT GPM";
            }
            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSumBundle);
            // Update the total sum element with the calculated value
            $('#totalsumbundle').text(totalPriceWithCommas);

            const hiddenTotalInput = document.querySelector(`[name='total_price_bundle']`);
            hiddenTotalInput.value = totalSumBundle; // Set the hidden input value to empty string
        }


        function calculateTotalBundle(uniq_id) {
            const purchasePrice = parseFloat(document.querySelector(`[name='purchase_price_${uniq_id}']`).value);
            const quantity = parseInt(document.querySelector(`[name='quantity_${uniq_id}']`).value);

            if (isNaN(purchasePrice) || isNaN(quantity)) {
                return document.getElementById("total_price_" + uniq_id).value = "null";
            }

            let totalAmount = purchasePrice * quantity;

            if (totalAmount.toString().length > 15) {
                return document.getElementById("total_price_" + uniq_id).value = "Melewati limit angka";
            }

            // const totalAmountWithCommas = new Intl.NumberFormat("id").format(totalAmount);

            document.getElementById("total_price_" + uniq_id).value = totalAmount;
            updateTotalSumBundle()
        }

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

            // Render opsi pertama saat halaman dimuat
            $.ajax({
                url: "{{ route('com.quotation.get.internet.bundling') }}",
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // dataFromFirstResponse = response; // Simpan data dari respons pertama
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

            // Function Tambah Modal Bundling Internet
            $('#btn-bundle').on('click', function() {
                // Find the parent container where you want to append new divs
                const parentContainer = document.querySelector(".BundleItem");

                // Create a new div element
                const newDiv = document.createElement("div");
                newDiv.className =
                    "file-soft-quotation-bundle d-flex justify-content-between mx-20 mb-5 mt-10";

                const random_string = generateRandomString(4);
                // Define the HTML structure as a string literal
                const htmlStructure = `  
                    <div class="d-flex justify-content-around align-items-center" style="flex-basis: 35%; min-width: 200px;"> 
                        <div class="" style="flex-basis: 100%;">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Internet Bundle</span>
                            </label>
                            <select class="form-select form-select-solid drop-data" required
                                data-control="select2" name="good_name_bundle_${random_string}"
                                id="good_name_bundle_${random_string}">
                                <option selected>Select Internet Bundle</option>
                            </select>
                        </div> 
                    </div>
                    <div style="flex-basis: 14%; min-width: 150px;">
                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                            <span class="fw-bold required">Quantity</span>
                        </label>
                        <input class="form-control required" type="text" required min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="quantity_${random_string}" id="quantity_${random_string}">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    <div style="flex-basis: 14%; min-width: 150px;">
                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                            <span class="fw-bold required">Purchase Price</span>
                        </label>
                        <input class="form-control required" type="text" required min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="purchase_price_${random_string}" id="purchase_price_${random_string}">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    <div class="d-flex justify-content-around align-items-center flex-nowrap"  style="flex-basis: 20%; min-width: 180px;">
                        <div class="" style="flex-basis: 80%;">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Total Price</span>
                            </label>
                            <input class="form-control" type="text" min="1" minlength="1" disabled oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="total_price_${random_string}" id="total_price_${random_string}">
                        </div>
                        <div class="" style="flex-basis: 15%;">
                            <div>
                                <div class="h-25px"></div> 
                                <button type="button" class="btn btn-secondary btn-icon btn-sm h-44px" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button> 
                                <ul class="dropdown-menu"> 
                                    <li type="button" class="clear-purchase-order-item-${random_string}"
                                        data-random-string="${random_string}">
                                        <a class="dropdown-item py-2">
                                        <i class="fa-solid fa-trash me-3"></i>Hapus Item</a>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                `;

                // Set the HTML content of the new div to the HTML structure
                newDiv.innerHTML = htmlStructure;

                $.ajax({
                    url: "{{ route('com.quotation.get.internet.bundling') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        dataFromFirstResponse = response; // Simpan data dari respons pertama
                        $(newDiv).find('#good_name_bundle_' + random_string)
                            .empty(); // Hapus opsi yang ada sebelumnya
                        $(newDiv).find('#good_name_bundle_' + random_string).append($(
                            '<option>', {
                                value: '',
                                text: 'Select Internet Bundle'
                            }));
                        $.each(response, function(index, item) {
                            $(newDiv).find('#good_name_bundle_' + random_string).append(
                                $(
                                    '<option>', {
                                        value: item.id,
                                        text: item.good_name
                                    }));
                        });

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                // Append the new div to the parent container
                parentContainer.appendChild(newDiv);

                $(`select[name="good_name_bundle_${random_string}"]`).select2({
                    dropdownAutoWidth: true
                });

                // Function Hapus per Item
                $('.BundleItem').on('click', `.clear-purchase-order-item-${random_string}`,
                    function() {
                        $(this).parent().parent().parent().parent().parent().remove();
                        updateTotalSumBundle();
                    });


            });

            // Function Hapus Bundle Frontend
            $('.BundleItem').on('click', '.clear-soft-quotation-bundle', function() {
                var random_string = $(this).data('random-string');
                $(this).closest('.file-soft-quotation-bundle-' + random_string).remove();
                updateTotalSumBundle();
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
                    console.log("Nama Inventory Item:", goodName);
                    console.log("Code Item:", codeName);
                    console.log("Merk:", merk);
                    console.log("Tipe Barang:", goodType);
                    console.log("Detail Item Inventory:", description);
                    console.log("Good Category ID:", goodCategoryId);

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
                            console.log("Data berhasil disimpan:", response.message);
                            form.reset();

                            $('#kt_modal_tambah_bundle_internet').modal('hide');
                            // Hapus semua nilai dari dataFromFirstResponse
                            dataFromFirstResponse = null;

                            $('#error-item').empty();

                            $(`select[name^="good_name_bundle"]`).append($(
                                '<option>', {
                                    value: response.item.id,
                                    text: response.item.good_name
                                }));
                        },
                        error: function(error) {
                            console.error("Terjadi kesalahan:", error);
                        },
                    });
                }
            });

            // Function Submit Modal
            $("#kt_create_quotation_internet_form").validate({
                messages: {
                    no_quotation: {
                        required: "<span class='fw-semibold fs-8 text-danger'>NO QUOTATION Wajib diisi</span>",
                    },
                    description: {
                        required: "<span class='fw-semibold fs-8 text-danger'>DESRCIPTION Wajib diisi</span>",
                    }
                },

                submitHandler: function() {

                    event.preventDefault();

                    // Get Prospect ID and Survey ID from the HTML elements
                    var boq_id = $('#id').val();
                    var total_price_bundle = $('#total_price_bundle').val();
                    var no_quotation = $('#no_quotation').val();
                    var description = $('#description').val();

                    // Array to store all item data
                    var bundle = [];
                    // Create an object to store prospect_id and survey_request_id
                    var quotation = {
                        boq_id: boq_id,
                        no_quotation: no_quotation,
                        description: description,
                        total_price: total_price_bundle
                    };

                    console.log(quotation);

                    // Loop through each .file-soft-boq-item div to get the data for each item
                    $('.BundleItem [class^="file-soft-quotation-bundle"]').each(function(index, item) {
                        // Extract data for the specific item
                        var id = $(item).find('select[name^="good_name_bundle"]').val();
                        var purchase_price = $(item).find('input[id^="purchase_price"]').val();
                        var quantity = $(item).find('input[id^="quantity"]').val();
                        var total_price = $(item).find('input[name^="total_price"]').val();

                        // Create an object to store the data for the specific item
                        var itemData = {
                            id: id,
                            quantity: quantity,
                            purchase_price: purchase_price,
                            total_price: total_price
                        };

                        // Push the itemData object to the items array
                        bundle.push(itemData);
                    });
                    console.log(bundle);

                    $.ajax({
                        url: "{{ route('com.quotation.store.quotation') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            quotation: quotation,
                            bundle: bundle
                        },
                        success: function(response) {
                            // Handle the response from the server, e.g., show a success message
                            console.log(response);
                        },
                        error: function(error) {
                            // Handle errors if the request fails
                            console.error('Error submitting all bundle data: ', error);
                        }
                    });

                }
            });


            $('body').on('click', '.btn_create_purchase_order', function() {
                let random_string = generateRandomString(4);

                const form_edit = $('#kt_modal_create_purchase_order_form');
                form_edit.find('#containerSelectedSurveyRequests').html('');
                $('.drop-data').val("").trigger("change")
                $('#kt_modal_create_purchase_order_form').trigger("reset")
                $('#kt_modal_create_purchase_order_submit').removeAttr('disabled', 'disabled');

                surveyRequestIds = [];
                const surveyRequestId = $(this).data('id');
                surveyRequestIds.push(surveyRequestId);

                $.each(surveyRequestIds.filter(onlyUnique), function(index, rowId) {
                    form_edit.find('#containerSelectedSurveyRequests').append(
                        $('<input>')
                        .attr('type', 'text')
                        .attr('name', 'survey_request_id[]')
                        .val(rowId)
                    );
                });

                $(`.file-purchase-order-item-initial`).change(function() {
                    imageReadURL(this);
                });

                form_edit.on('click', '.btn_add_more_purchase_order_item', function() {
                    form_edit.find('#containerSoftSurveyItems').append(
                        `
                    <div class="row purchase-order-item mt-2">
                        <div class="col-lg-12 mb-3">
                            <div class="separator my-3 text-center text-gray-800"></div>
                        </div>
                        <div class="col-lg-10 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Lampiran</span>
                            </label>
                            <input type="file" class="form-control form-control-solid file-purchase-order-item-${random_string}" placeholder="" required accept="image/*" name="content[][file_purchase_order_internet]">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            <img id="containerImage" class="img-fluid m-5" src="#" alt="File Image" hidden="hidden"/>
                        </div>
                        <div class="col-lg-2 my-9">
                            <button type="button" class="btn btn-sm btn-icon btn-danger clear-purchase-order-item-${random_string}"><i class="fa-solid fa-eraser"></i></button>
                        </div>
                    </div>
                    `
                    )

                    $(`.file-purchase-order-item-${random_string}`).change(function() {
                        imageReadURL(this);
                    });

                    $(`.clear-purchase-order-item-${random_string}`).click(function() {
                        $(this).parent().parent().remove();
                        console.log(random_string)
                        random_string = generateRandomString(4);

                        $('#countable_purchase_order_items').html($('.purchase-order-item')
                            .length + 1);
                    })

                    $('#countable_purchase_order_items').html($('.purchase-order-item').length + 1);
                    random_string = generateRandomString(4);
                })
                submitModal({
                    modalName: 'kt_modal_create_purchase_order',
                    tableName: 'kt_table_purchase_order',
                    anotherTableName: 'tableOnProgressPurchaseOrder',
                    ajaxLink: "{{route('com.quotation.store.quotation')}}",
                    // validationMessages: softSurveyValidationMessages,
                   })
            });


            //  Calculate and update total sum on page load
            updateTotalSum();
            updateTotalSumBundle();
        });
    </script>
@endsection
