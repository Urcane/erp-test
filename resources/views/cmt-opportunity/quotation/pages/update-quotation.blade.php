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
    {{-- @dd($dataQuotation['boqFinalData'][0])   --}}
    {{-- @dd($dataQuotation['boqFinalData']) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-md-lh-l">Update Internet
                                    Quotation</span>
                            </h3>
                            <div class="card-toolbar p-3">
                                <a href="#kt_modal_create_purchase_order"
                                    class="btn_create_purchase_order p- btn btn-md btn-info w-lg-180px"
                                    data-id="{{ $dataQuotation['quotationData']->id }}" data-bs-toggle="modal"><i
                                        class="fa-solid fa-file me-3"></i>Purchase Order</a>


                                {{-- <button class="btn btn-md btn-info w-lg-150px purchase_order_file"
                                    onclick="myFunction()">Input File</button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">

                                    {{-- divv Company --}}
                                    <div
                                        class="d-flex justify-content-around flex-wrap col-lg-12 mb-5 border-dashed border-gray-100">
                                        {{-- baris prospect company --}}
                                        <div class="my-8 d-flex justify-content-around flex-wrap col-12"> 

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-8 ">
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

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-8 ">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataQuotation['boqFinalData'][0]->surveyRequest->no_survey ?? 'Survey Tidak ada' }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->survey_request_id }}">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-sm-2 col-md-2 ">
                                                <label for="boq_type" class="d-flex align-items-center fs-6 form-label mb-2 required" >
                                                    <span class="fw-bold">Tipe BOQ</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataQuotation['boqFinalData'][0]->boq_type }}">
                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="boq_type" id="boq_type"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->boq_type }}">
                                                <div id="error-prospect"></div> 
                                            </div>
                                        </div>

                                        {{-- baris company contact --}}
                                        <div class="my-8 d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- sales & gpm  --}}
                                    <div class="mb-6 border-dashed border-gray-100">
                                        <div class="d-flex justify-content-around flex-wrap my-8 row">

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                                <label class="form-label ">Sales</label>
                                                {{-- <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="sales_id" id="sales_id">
                                                    <option
                                                        value="{{ $dataQuotation['dataSalesSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $dataQuotation['dataSalesSelected']->name ?? 'Pilih Sales' }}
                                                    </option>
                                                    @if (isset($dataQuotation['dataSales']))
                                                        @foreach ($dataQuotation['dataSales'] as $sales)
                                                            <option value="{{ $sales->id ?? null }}">
                                                                {{ $sales->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif 
                                                </select> --}}

                                                <input type="text" disabled class="form-control form-control-solid "
                                                    id="sales_id" name="sales_id"
                                                    value="{{ $dataQuotation['dataSalesSelected']->name ?? 'Sales tidak ada ' }}" />
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                                <label class="form-label ">Technician</label>
                                                {{-- <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="technician_id" id="technician_id">
                                                    <option
                                                        value="{{ $dataQuotation['dataTechnicianSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $dataQuotation['dataTechnicianSelected']->name ?? 'Pilih Technician' }}
                                                    </option>
                                                    @if (isset($dataQuotation['dataTechnician']))
                                                        @foreach ($dataQuotation['dataTechnician'] as $Technician)
                                                            <option value="{{ $Technician->id ?? null }}">
                                                                {{ $Technician->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select> --}}
                                                <input type="text" disabled class="form-control form-control-solid "
                                                    id="technician_id" name="technician_id"
                                                    value="{{ $dataQuotation['dataTechnicianSelected']->name ?? 'Technician tidak ada ' }}" />
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                                <label class="form-label ">Procurement</label>
                                                {{-- <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="procurement_id" id="procurement_id">
                                                    <option
                                                        value="{{ $dataQuotation['dataProcurementSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $dataQuotation['dataProcurementSelected']->name ?? 'Pilih Procurement' }}
                                                    </option>
                                                    @if (isset($dataQuotation['dataProcurement']))
                                                        @foreach ($dataQuotation['dataProcurement'] as $procurement)
                                                            <option value="{{ $procurement->id ?? null }}">
                                                                {{ $procurement->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select> --}}

                                                <input type="text" disabled class="form-control form-control-solid "
                                                    id="procurement_id" name="procurement_id"
                                                    value="{{ $dataQuotation['dataProcurementSelected']->name ?? 'Procurement tidak ada ' }}" />
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-around flex-wrap my-8">
                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled
                                                        class="form-control form-control-solid " id="modal"
                                                        name="modal"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">GPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled
                                                        class="form-control form-control-solid " id="gpm"
                                                        name="gpm"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled
                                                        class="form-control form-control-solid " id="npm"
                                                        name="npm"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled
                                                        class="form-control form-control-solid " id="percentage"
                                                        name="percentage"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->percentage ?? null }}" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tempat Items --}}
                                    <div class="mb-6 border-dashed border-gray-100">

                                        <div class="MultipleItem justify-content-center mx-10 mt-5 mb-8 row">
                                            @if (isset($dataQuotation['boqFinalData'][0]->itemable))
                                                @foreach ($dataQuotation['boqFinalData'][0]->itemable as $relatedItem)
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <div
                                                        class="file-soft-boq-item-{{ $random_string }} mb-5 mt-10 col-12">
                                                        <div class="row d-flex justify-content-between ">
                                                            <div class="col-12 col-lg-3">
                                                                <label class="form-label">Item</label>
                                                                <input type="text"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][good_name]"
                                                                    value="{{ $relatedItem->inventoryGood->good_name ?? null }} - {{ $relatedItem->inventoryGood->merk ?? null }}" />
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-2">
                                                                <div class="row justify-content-between">
                                                                    <div class="col-7">
                                                                        <label class="form-label">Qty</label>
                                                                        <div class="position-relative">
                                                                            <div class="position-absolute top-0"></div>
                                                                            <input type="number"
                                                                                class="form-control form-control-solid"
                                                                                disabled name="content[][quantity]"
                                                                                value="{{ $relatedItem->quantity ?? null }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <label class="form-label"> Unit</label>
                                                                        <div class="position-relative">
                                                                            <div class="position-absolute top-0"></div>
                                                                            <input disabled="disabled" type="text"
                                                                                class="form-control form-control-solid"
                                                                                name="content[][unit]"
                                                                                value="{{ $relatedItem->unit ?? null }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-2 col-md-6">
                                                                <label class="form-label">Price</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="number"
                                                                        class="form-control form-control-solid" disabled
                                                                        name="content[][purchase_price]"
                                                                        value="{{ $relatedItem->purchase_price ?? null }}" />
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-2 col-md-6">
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

                                                            <div class="col-12 col-lg-3 col-md-6">
                                                                <div
                                                                    class="row justify-content-between align-items-center">
                                                                    <div class="@if($dataQuotation['boqFinalData'][0]->boq_type == "perangkat") col-lg-5 col-md-5 col-5 col-sm-5 @else col-lg-10 col-md-10 col-10 col-sm-10 @endif">
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
                                                                    @if($dataQuotation['boqFinalData'][0]->boq_type == "perangkat")
                                                                    <div class="col-lg-5 col-md-5 col-5 col-sm-5">
                                                                        <label class="form-label">Markup Price</label>
                                                                        <div class="position-relative">
                                                                            <div class="position-absolute top-0"></div>
                                                                            <input type="number"
                                                                                class="form-control form-control-solid" disabled
                                                                                name="content[][markup_price]"
                                                                                value="{{ $relatedItem->markup_price ?? 0 }}" />
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    <div class="col-lg-2 col-md-2 col-2 col-sm-2">
                                                                        <div class="h-25px"></div>
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-icon btn-md"
                                                                            data-kt-menu-placement="bottom-end"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li type="button"
                                                                                class="btn-item-detail-modal"
                                                                                data-description="{{ $relatedItem->inventoryGood->description }}"
                                                                                data-good_name="{{ $relatedItem->inventoryGood->good_name }}"
                                                                                data-merk="{{ $relatedItem->inventoryGood->merk }}"
                                                                                data-good_type="{{ $relatedItem->inventoryGood->good_type }}"
                                                                                data-random-string="{{ $random_string }}"
                                                                                data-item-id="{{ $relatedItem->inventory_good_id }}"
                                                                                data-quantity="{{ $relatedItem->quantity }}"
                                                                                data-unit="{{ $relatedItem->unit }}"
                                                                                data-total_price="{{ $relatedItem->total_price }}"
                                                                                data-purchase_delivery_charge="{{ $relatedItem->purchase_delivery_charge }}"
                                                                                data-purchase_price="{{ $relatedItem->purchase_price }}"
                                                                                data-purchase_reference="{{ $relatedItem->purchase_reference }}"
                                                                                data-item_detail="{{ $relatedItem->item_detail }}"
                                                                                data-delivery_route="{{ $relatedItem->delivery_route }}"
                                                                                data-delivery_type="{{ $relatedItem->delivery_type }}"
                                                                                data-purchase_from="{{ $relatedItem->purchase_from }}"
                                                                                data-payment_type="{{ $relatedItem->payment_type }}"
                                                                                data-purchase_validity="{{ $relatedItem->purchase_validity }}">
                                                                                <a class="dropdown-item py-2">
                                                                                    <i
                                                                                        class="fa-solid fa-edit me-3"></i>Detail
                                                                                    Item</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="content[][id]" disabled
                                                                value="{{ $relatedItem->id ?? null }}" />
                                                            <input type="hidden" name="content[][item_inventory_id]"
                                                                disabled
                                                                value="{{ $relatedItem->inventory_good_id ?? null }}" />
                                                            <input type="hidden" name="content[][purchase_reference]"
                                                                disabled
                                                                value="{{ $relatedItem->purchase_reference ?? null }}" />
                                                            <input type="hidden" name="content[][delivery_route]"
                                                                disabled
                                                                value="{{ $relatedItem->delivery_route ?? null }}" />
                                                            <input type="hidden" name="content[][delivery_type]" disabled
                                                                value="{{ $relatedItem->delivery_type ?? null }}" />
                                                            <input type="hidden" name="content[][purchase_from]" disabled
                                                                value="{{ $relatedItem->purchase_from ?? null }}" />
                                                            <input type="hidden" name="content[][payment_type]" disabled
                                                                value="{{ $relatedItem->payment_type ?? null }}" />
                                                            <input type="hidden" name="content[][purchase_validity]"
                                                                disabled
                                                                value="{{ $relatedItem->purchase_validity ?? null }}" />
                                                            <input type="hidden" name="content[][item_detail]" disabled
                                                                value="{{ $relatedItem->item_detail ?? null }}" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        @role('administrator')
                                            <div class="d-flex justify-content-end mt-5">
                                                <div class="w-20 me-10">
                                                    <span class="fw-bold">Total Amount : Rp<span
                                                            id="total_item_price"></span></span>
                                                </div>
                                            </div> 
                                            @if ($dataQuotation['boqFinalData'][0]->boq_type == "perangkat")
                                            <div class="d-flex justify-content-end mt-5">
                                                <div class="w-20 me-10">
                                                    <span class="fw-bold">Total Markup : Rp<span
                                                            id="total_markup_price"></span></span>
                                                </div>
                                            </div>
                                            @endif
                                        @endrole

                                    </div>
                                </div>


                                <form id="kt_create_quotation_internet_form"
                                    class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                                    @csrf
                                    {{--  divv No Quota & Description --}} 
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">
                                        <div class="d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-3 col-md-4 col-8 mb-3">
                                                <label for="no_quotation" class="form-label">
                                                    <span class="fw-bold required">NO Quotation</span> </label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="text" class="form-control form-control-solid required"
                                                        required id="no_quotation" name="no_quotation"
                                                        value="{{ $dataQuotation['quotationData']->no_quotation }}"
                                                        placeholder="No Quotation Wajib Di isi" />
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6 col-8 mb-3">
                                                <label for="description" class="form-label">
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

                                    @if ($dataQuotation['boqFinalData'][0]->boq_type == "internet")
                                    {{--  divv BUNDLE INTERNET --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="BundleItem justify-content-center mx-10 mt-5 mb-8 row">
                                            @if (isset($dataQuotation['quotationItem']))

                                                @foreach ($dataQuotation['quotationItem'] as $relatedItem)
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <div
                                                        class="file-soft-quotation-bundle-{{ $random_string }} col-12 mb-5 mt-10">
                                                        <div class="row d-flex justify-content-between">

                                                            <!-- Internet Bundle -->
                                                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                                <label
                                                                    class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class=" fw-bold">Internet
                                                                        Bundle</span>
                                                                </label>
                                                                {{-- <select class="form-select form-select-solid drop-data" 
                                                                    data-control="select2" disabled
                                                                    name="good_name_bundle_{{ $random_string }}"
                                                                    id="good_name_bundle_{{ $random_string }}">

                                                                    @foreach ($dataQuotation['inventoryGoodInet'] as $item)
                                                                        @if ($relatedItem->inventory_good_id == $item->id)
                                                                            <option selected value="{{ $item->id }}">
                                                                                {{ $item->good_name }}
                                                                            </option> 
                                                                        @endif
                                                                    @endforeach

                                                                </select> --}}

                                                                <input type="hidden" name="bundle_inventory_id" disabled
                                                                    value="{{ $relatedItem->inventory_good_id ?? null }}" />
                                                                @foreach ($dataQuotation['inventoryGoodInet'] as $item)
                                                                    @if ($relatedItem->inventory_good_id == $item->id)
                                                                        <input class="form-control form-control-solid"
                                                                            type="text" disabled
                                                                            value="{{ $item->good_name }}">
                                                                    @endif
                                                                @endforeach


                                                            </div>

                                                            <!-- Quantity -->
                                                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                                <div class="row d-flex justify-content-between ">
                                                                    <div class="col-7 col-md-6">
                                                                        <label for="quantity_{{ $random_string }}"
                                                                            class="d-flex align-items-center fs-6 form-label mb-2">
                                                                            <span class="fw-bold ">Quantity</span>
                                                                        </label>
                                                                        <input class="form-control form-control-solid"
                                                                            type="text" min="1" minlength="1"
                                                                            disabled
                                                                            oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                            name="quantity_{{ $random_string }}"
                                                                            id="quantity_{{ $random_string }}"
                                                                            value="{{ $relatedItem->quantity }}">
                                                                    </div>
                                                                    <div class="col-5 col-md-6">
                                                                        <label
                                                                            class="d-flex align-items-center fs-6 form-label mb-2">
                                                                            <span class=" fw-bold">Unit</span>
                                                                        </label>
                                                                        {{-- <select
                                                                            class="form-select form-select-solid drop-data" 
                                                                            data-control="select2"  disabled
                                                                            name="unit_${random_string}"
                                                                            id="unit_${random_string}">
                                                                            @foreach ($dataUnit as $unit)
                                                                                @if ($relatedItem->unit == $unit->code)
                                                                                    <option selected
                                                                                        value="{{ $unit->code }}">
                                                                                        {{ $unit->name }}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{ $unit->code }}">
                                                                                        {{ $unit->name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select> --}}
                                                                        @foreach ($dataUnit as $unit)
                                                                            @if ($relatedItem->unit == $unit->code)
                                                                                {{-- <option selected
                                                                                value="{{ $unit->code }}">
                                                                                {{ $unit->name }}
                                                                            </option>  --}}
                                                                                <input
                                                                                    class="form-control form-control-solid"
                                                                                    name="unit_code" type="text"
                                                                                    disabled
                                                                                    placeholder="{{ $unit->code }} - {{ $unit->name }}"
                                                                                    value="{{ $unit->code }}">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Purchase Price -->
                                                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                                <label
                                                                    class="d-flex align-items-center fs-6 form-label mb-2"
                                                                    for="purchase_price_{{ $random_string }}">
                                                                    <span class="fw-bold ">Purchase Price</span>
                                                                </label>
                                                                <input class="form-control form-control-solid"
                                                                    type="text" min="1" minlength="1" disabled
                                                                    oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                    name="purchase_price_{{ $random_string }}"
                                                                    value="{{ $relatedItem->purchase_price }}"
                                                                    id="purchase_price_{{ $random_string }}">
                                                            </div>

                                                            <!-- Total Price -->
                                                            <div class="col-lg-3 col-md-6 col-12 mb-3">

                                                                <label
                                                                    class="d-flex align-items-center fs-6 form-label mb-2"
                                                                    for="total_price_{{ $random_string }}">
                                                                    <span class="fw-bold">Total Price</span>
                                                                </label>
                                                                <input class="form-control form-control-solid"
                                                                    type="text" min="1" minlength="1" disabled
                                                                    oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                    name="total_price_{{ $random_string }}"
                                                                    id="total_price_{{ $random_string }}"
                                                                    value="{{ $relatedItem->total_price }}">

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                        <div class="d-flex justify-content-end mt-5">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : Rp<span
                                                        id="total_bundle_price"></span></span>
                                            </div>
                                        </div>
 


                                    </div>
                                    @endif

                                    {{-- SUBMIT DAN TOTAL AMOUNT INTERNET BUNDLE --}}
                                    <div>
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

                                    {{-- input hidden --}} 
                                    <input type="hidden" id="boq_id" name="boq_id"
                                    value="{{ $dataQuotation['boqFinalData'][0]->id }}">
                                    <input type="hidden" id="id" name="id"
                                    value="{{ $dataQuotation['quotationData']->id }}">
                                    <input type="hidden" name="total_price_bundle" id="total_price_bundle">

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
    @include('cmt-opportunity.quotation.add.modal-item-detail', array('boq_type' => $dataQuotation['boqFinalData'][0]->boq_type))
    @include('cmt-opportunity.quotation.add.modal-create-purchase-order')

    <script>
        function updateTotalSumBundle() {
            let totalSumBundle = 0;

            $('.BundleItem input[name^="total_price"]').each(function() {
                let totalPriceBundleValue = $(this).val();

                if (totalPriceBundleValue !== "") {
                    totalSumBundle += parseInt(totalPriceBundleValue);
                }
            });

            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSumBundle);

            $('#total_bundle_price').text(totalPriceWithCommas);
            $('#total_price_bundle').val(totalSumBundle);
        }
        
        function updateTotalSum() {
            let totalSum = 0;
            let totalMarkup = 0;
            
            $('.MultipleItem input[name="content[][total_price]"]').each(function() {
                let totalPriceValue = $(this).val();
                
                if (totalPriceValue !== "") {
                    totalSum += parseInt(totalPriceValue);
                }
            });
            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSum);
            
            $('#total_item_price').text(totalPriceWithCommas);
            
            @if ($dataQuotation['boqFinalData'][0]->boq_type == "perangkat")
            $('.MultipleItem input[name="content[][markup_price]"]').each(function() {
                let totalPriceValue = $(this).val();
                
                if (totalPriceValue !== "") {
                    totalMarkup += parseInt(totalPriceValue);
                }
            });
            
            const totalMarkupWithCommas = new Intl.NumberFormat("id").format(totalMarkup);
            
            $('#total_markup_price').text(totalMarkupWithCommas);
            $('#total_price_bundle').val(totalMarkup);
            @endif
            
        }

        $(document).ready(function() {
 
            $('.btn-item-detail-modal').on('click', function() {
                let randomString = $(this).data('random-string');
                let itemId = parseInt($(this).data('itemId'));
                // console.log($(this).data('itemId'));

                let good_name = $(this).data('good_name');
                let good_type = $(this).data('good_type');
                let merk = $(this).data('merk');
                let description = $(this).data('description');

                // console.log(good_name,good_type,merk); 
                let quantity = $(this).data('quantity');
                let unit = $(this).data('unit');
                let total_price = ($(this).data('total_price'));
                let purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                let purchase_price = ($(this).data('purchase_price'));
                let purchase_reference = $(this).data('purchase_reference');
                let item_detail = ($(this).data('item_detail'));
                let delivery_route = ($(this).data('delivery_route'));
                let delivery_type = ($(this).data('delivery_type'));
                let purchase_from = ($(this).data('purchase_from'));
                let payment_type = ($(this).data('payment_type'));
                let purchase_validity = ($(this).data('purchase_validity'));

                // console.log(randomString, itemId, quantity, total_price, purchase_delivery_charge,
                //     purchase_price, purchase_reference, item_detail);

                $('#kt_modal_item_detail').modal('show');


                $('#detail_item_detail').val(description);
                $('#good_name_item_detail').val(good_name);
                $('#merk_item_detail').val(merk);
                $('#good_type_item_detail').val(good_type);


                $('#uniq_id_price').val(randomString);

                $('#purchase_from_item_detail').val(purchase_from);
                $('#delivery_route_item_detail').val(delivery_route);
                $('#delivery_type_item_detail').val(delivery_type);
                $('#payment_type_item_detail').val(payment_type);
                $('#purchase_validity_item_detail').val(purchase_validity);
                $('#purchase_reference_item_detail').val(purchase_reference);
                $('#purchase_price_item_detail').val(purchase_price);
                $('#purchase_delivery_charge_item_detail').val(purchase_delivery_charge);
                // $('#total_price_item_detail').val(total_price);

                $('#item_detail_item_detail').val(item_detail);
                $('#quantity_item_detail').val(quantity);
                $('#unit_item_detail').val(unit);
                // $('#unit_item_detail').val(unit).trigger('change');
                document.getElementById('total_item_detail').textContent = total_price;
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
                    // event.preventDefault(); 

                    // Get Prospect ID and Survey ID from the HTML elements
                    let id = $('#id').val();
                    let boq_id = $('#boq_id').val();
                    let total_price = $('#total_price_bundle').val();
                    let no_quotation = $('#no_quotation').val();
                    let description = $('#description').val();
                    // Array to store all item data
                    let bundle = [];
                    // Create an object to store prospect_id and survey_request_id
                    let quotation = {
                        id: id,
                        boq_id: boq_id,
                        no_quotation: no_quotation,
                        description: description,
                        total_price: total_price
                    };

                    @if($dataQuotation['boqFinalData'][0]->boq_type == "perangkat")
                    $('.MultipleItem [class^="file-soft-boq-item"]').each(function(index, item) {
                        // Extract data for the specific item
                        let id = $(item).find(
                            'input[name="content[][id]"]').val();
                        let item_inventory_id = $(item).find(
                            'input[name="content[][item_inventory_id]"]').val();
                        let item_detail = $(item).find(
                            'input[name="content[][item_detail]"]').val();
                        let quantity = $(item).find('input[name="content[][quantity]"]').val();
                        let unit = $(item).find('input[name="content[][unit]"]').val();
                        let purchase_price = $(item).find(
                            'input[name="content[][purchase_price]"]').val();
                        let purchase_delivery = $(item).find(
                            'input[name="content[][purchase_delivery]"]').val();
                        let purchase_reference = $(item).find(
                            'input[name="content[][purchase_reference]"]').val();
                        let delivery_route = $(item).find(
                            'input[name="content[][delivery_route]"]').val();
                        let delivery_type = $(item).find(
                            'input[name="content[][delivery_type]"]').val();
                        let purchase_from = $(item).find(
                            'input[name="content[][purchase_from]"]').val();
                        let payment_type = $(item).find(
                            'input[name="content[][payment_type]"]').val();
                        let purchase_validity = $(item).find(
                            'input[name="content[][purchase_validity]"]').val();
                        let total_price = $(item).find(
                            'input[name="content[][total_price]"]').val();
                        let markup_price = $(item).find(
                            'input[name="content[][markup_price]"]').val();

                        // Create an object to store the data for the specific item
                        let itemData = {
                            id: item_inventory_id,
                            item_detail: item_detail,
                            quantity: quantity,
                            unit: unit,
                            purchase_price: purchase_price,
                            purchase_delivery: purchase_delivery,
                            purchase_reference: purchase_reference,
                            delivery_route: delivery_route,
                            delivery_type: delivery_type,
                            purchase_from: purchase_from,
                            payment_type: payment_type,
                            purchase_validity: purchase_validity,
                            total_price: total_price,
                            markup_price: markup_price,
                        };
                        // Push the itemData object to the items array
                        bundle.push(itemData);
                    });
                    @endif

                    console.log(quotation);

                    // // Loop through each .file-soft-boq-item div to get the data for each item
                    // $('.BundleItem [class^="file-soft-quotation-bundle"]').each(function(index, item) {
                    //     // Extract data for the specific item
                    //     let id = $(item).find('input[name^="bundle_inventory_id"]').val();
                    //     let unit = $(item).find('input[name^="unit_code"]').val();

                    //     let purchase_price = $(item).find('input[id^="purchase_price"]').val();
                    //     let quantity = $(item).find('input[id^="quantity"]').val();
                    //     // let total_price = $(item).find('input[name^=""]').val();


                    //     // Create an object to store the data for the specific item
                    //     let itemData = {
                    //         id: id,
                    //         unit: unit,
                    //         quantity: quantity,
                    //         purchase_price: purchase_price
                    //         // total_price: total_price
                    //     };

                    //     // Push the itemData object to the items array
                    //     bundle.push(itemData);
                    // });
                    // console.log(bundle);

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
                            toastr.success(response.message);
                            console.log(response);
                            setTimeout(() => {
                                window.location.href =
                                    `cmt-quotation/update-quotation?quotation_id=${response.data.id}&quotation=internet`;
                            }, 800);
                        },
                        error: function(error) {
                            // Handle errors if the request fails
                            toastr.error(error.responseJSON.error);
                            console.error('Error submitting all item data: ', error);
                        }
                    });

                }
            });

            $('body').on('click', '.btn_create_purchase_order', function() {

                $('.drop-data').val("").trigger("change")
                $('#kt_modal_create_purchase_order_form').trigger("reset")
                $('#kt_modal_create_purchase_order_submit').removeAttr('disabled', 'disabled');

                var quo_id = $(this).data('id');
                $('#quotation_id').val(quo_id);

                $(`.file-purchase-order-item-initial`).change(function() {
                    imageReadURL(this);
                });

                submitModal({
                    modalName: 'kt_modal_create_purchase_order',
                    tableName: 'kt_table_purchase_order',
                    anotherTableName: 'tableOnProgressPurchaseOrder',
                    ajaxLink: "{{ route('com.quotation.store.po') }}",
                    successCallback: function(response) {
                        // Redirect ke halaman yang sesuai setelah operasi berhasil
                        window.location.href = `{!! url("cmt-quotation/review-done-quotation?quotation_id=". $dataQuotation['quotationData']->id ."&quotation=internet") !!}`;
                    }
                })

            }); 

            //  Calculate and update total sum on page load
            updateTotalSum();
            @if ($dataQuotation['boqFinalData'][0]->boq_type == "internet")
            updateTotalSumBundle();
            @endif
        });
    </script>
@endsection
