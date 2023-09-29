@extends('layouts.app')
@section('title-apps', 'BOQ')
@section('sub-title-apps-2', 'Review Done')
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
    {{-- @dd($dataReviewBoq['dataCompanyItem'][0]->itemable) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Review Done Bill of Quantity: <b>{{$dataReviewBoq['dataCompanyItem'][0]->id}}</b></span>
                            </h3>

                            {{-- <div class="card-toolbar p-3">
                                @if (!isset($dataReviewBoq['dataCompanyItem'][0]->approval_director))
                                    <a href="#kt_modal_review_director_boq_commercial"
                                        data-boq-id="{{ $dataReviewBoq['dataCompanyItem'][0]->id }}"
                                        data-remark="{{ $dataReviewBoq['dataCompanyItem'][0]->remark }}"
                                        class="btn btn-md btn-info w-lg-150px btn_review_director_boq_commercial"
                                        data-bs-toggle="modal"><i class="fa-solid fa-edit"></i>Review Director</a>
                                @endif
                            </div>

                            <div class="card-toolbar p-3">
                                @if (!isset($dataReviewBoq['dataCompanyItem'][0]->approval_manager_sales))
                                    <a href="#kt_modal_review_manager_sales_boq_commercial"
                                        data-boq-id="{{ $dataReviewBoq['dataCompanyItem'][0]->id }}"
                                        data-remark="{{ $dataReviewBoq['dataCompanyItem'][0]->remark }}"
                                        class="btn btn-md btn-info w-lg-150px btn_review_manager_sales_boq_commercial"
                                        data-bs-toggle="modal"><i class="fa-solid fa-edit"></i>Review Manager Sales</a>
                                @endif
                            </div>

                            <div class="card-toolbar p-3">
                                @if (!isset($dataReviewBoq['dataCompanyItem'][0]->approval_manager_operation))
                                    <a href="#kt_modal_review_manager_operation_boq_commercial"
                                        data-boq-id="{{ $dataReviewBoq['dataCompanyItem'][0]->id }}"
                                        data-remark="{{ $dataReviewBoq['dataCompanyItem'][0]->remark }}"
                                        class="btn btn-md btn-info w-lg-150px btn_review_manager_operation_boq_commercial"
                                        data-bs-toggle="modal"><i class="fa-solid fa-edit"></i>Review Manager Operation</a>
                                @endif
                            </div>

                            <div class="card-toolbar p-3">
                                @if (!isset($dataReviewBoq['dataCompanyItem'][0]->approval_finman))
                                    <a href="#kt_modal_review_finman_boq_commercial"
                                        data-boq-id="{{ $dataReviewBoq['dataCompanyItem'][0]->id }}"
                                        data-remark="{{ $dataReviewBoq['dataCompanyItem'][0]->remark }}"
                                        class="btn btn-md btn-info w-lg-150px btn_review_finman_boq_commercial"
                                        data-bs-toggle="modal"><i class="fa-solid fa-edit"></i>Review Finman</a>
                                @endif
                            </div> --}}

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

                                            <input type="hidden" id="boq_id" name="boq_id"
                                                value="{{ $dataReviewBoq['dataCompanyItem'][0]->id }}">

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-8 ">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->prospect_title }} - {{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->prospect_id }}">
                                                <div id="error-prospect"></div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-8 ">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataReviewBoq['dataCompanyItem'][0]->surveyRequest->no_survey ?? 'Survey Tidak ada' }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->survey_request_id }}">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-sm-2 col-md-2 ">
                                                <label for="boq_type" class="d-flex align-items-center fs-6 form-label mb-2 required" >
                                                    <span class="fw-bold">Tipe BOQ</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataReviewBoq['dataCompanyItem'][0]->boq_type }}">
                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="boq_type" id="boq_type"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->boq_type }}">
                                                <div id="error-prospect"></div> 
                                            </div>
                                        </div>

                                        {{-- baris company contact --}}
                                        <div class="my-8 d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->bussinesType->type_name }}">
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
                                                        value="{{ $dataReviewBoq['dataSalesSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $dataReviewBoq['dataSalesSelected']->name ?? 'Pilih Sales' }}
                                                    </option>
                                                    @if (isset($dataReviewBoq['dataSales']))
                                                        @foreach ($dataReviewBoq['dataSales'] as $sales)
                                                            <option value="{{ $sales->id ?? null }}">
                                                                {{ $sales->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select> --}}

                                                <input type="text" disabled class="form-control form-control-solid "
                                                    id="sales_id" name="sales_id"
                                                    value="{{ $dataReviewBoq['dataSalesSelected']->name ?? 'Sales tidak ada ' }}" />
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                                <label class="form-label ">Technician</label>
                                                {{-- <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="technician_id" id="technician_id">
                                                    <option
                                                        value="{{ $dataReviewBoq['dataTechnicianSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $dataReviewBoq['dataTechnicianSelected']->name ?? 'Pilih Technician' }}
                                                    </option>
                                                    @if (isset($dataReviewBoq['dataTechnician']))
                                                        @foreach ($dataReviewBoq['dataTechnician'] as $Technician)
                                                            <option value="{{ $Technician->id ?? null }}">
                                                                {{ $Technician->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select> --}}
                                                <input type="text" disabled class="form-control form-control-solid "
                                                    id="technician_id" name="technician_id"
                                                    value="{{ $dataReviewBoq['dataTechnicianSelected']->name ?? 'Technician tidak ada ' }}" />
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                                <label class="form-label ">Procurement</label>
                                                {{-- <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="procurement_id" id="procurement_id">
                                                    <option
                                                        value="{{ $dataReviewBoq['dataProcurementSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $dataReviewBoq['dataProcurementSelected']->name ?? 'Pilih Procurement' }}
                                                    </option>
                                                    @if (isset($dataReviewBoq['dataProcurement']))
                                                        @foreach ($dataReviewBoq['dataProcurement'] as $procurement)
                                                            <option value="{{ $procurement->id ?? null }}">
                                                                {{ $procurement->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select> --}}

                                                <input type="text" disabled class="form-control form-control-solid "
                                                    id="procurement_id" name="procurement_id"
                                                    value="{{ $dataReviewBoq['dataProcurementSelected']->name ?? 'Procurement tidak ada ' }}" />
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
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">Markup</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled
                                                        class="form-control form-control-solid " id="gpm"
                                                        name="gpm"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">Profit</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled
                                                        class="form-control form-control-solid " id="npm"
                                                        name="npm"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                                <label class="form-label ">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <div class="input-group">
                                                        <input type="number" disabled
                                                            class="form-control form-control-solid " id="percentage"
                                                            name="percentage"
                                                            value="{{ $dataReviewBoq['dataCompanyItem'][0]->percentage ?? null }}" />
                                                        <span class="input-group-text border-0">%</span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tempat Items --}}
                                    <div class="mb-6 border-dashed border-gray-100">

                                        <div class="MultipleItem justify-content-center mx-10 mt-5 mb-8 row">
                                            @if (isset($dataReviewBoq['dataCompanyItem'][0]->itemable))
                                                @foreach ($dataReviewBoq['dataCompanyItem'][0]->itemable as $relatedItem)
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
                                                                    <div class="@if($dataReviewBoq['dataCompanyItem'][0]->boq_type == "perangkat") col-lg-5 col-md-5 col-5 col-sm-5 @else col-lg-10 col-md-10 col-10 col-sm-10 @endif">
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
                                                                    @if($dataReviewBoq['dataCompanyItem'][0]->boq_type == "perangkat")
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
                                                                                data-markup_price="{{ $relatedItem->markup_price }}"
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
                                            @if ($dataReviewBoq['dataCompanyItem'][0]->boq_type == "perangkat")
                                            <div class="d-flex justify-content-end mt-5">
                                                <div class="w-20 me-10">
                                                    <span class="fw-bold">Total Markup : Rp<span
                                                            id="total_markup_price"></span></span>
                                                </div>
                                            </div>
                                            @endif

                                            {{-- <div class="d-flex justify-content-start mx-20 mb-5">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm mx-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div> --}}
                                        @endrole

                                    </div>

                                    {{--  divv BUNDLE INTERNET --}}
                                    @if ($dataReviewBoq['dataCompanyItem'][0]->boq_type == "internet")
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="BundleItem justify-content-center mx-10 mt-5 mb-8 row">
                                            @if (isset($dataReviewBoq['quotationItem']))

                                                @foreach ($dataReviewBoq['quotationItem'] as $relatedItem)
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <input type="hidden" name="bundle_id" disabled
                                                        value="{{ $relatedItem->id ?? null }}" />
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

                                                                    @foreach ($dataReviewBoq['inventoryGoodInet'] as $item)
                                                                        @if ($relatedItem->inventory_good_id == $item->id)
                                                                            <option selected value="{{ $item->id }}">
                                                                                {{ $item->good_name }}
                                                                            </option> 
                                                                        @endif
                                                                    @endforeach

                                                                </select> --}}

                                                                @foreach ($dataReviewBoq['inventoryGoodInet'] as $item)
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
                                                                                    type="text" disabled
                                                                                    value="{{ $unit->code }} - {{ $unit->name }}">
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

                                        {{-- <div class="d-flex justify-content-start mx-20 mb-5">
                                            <div class="w-20 me-10">
                                                <button class="btn btn-light-info btn-sm me-3 btn_bundle" id="btn-bundle">
                                                    <i class="fa-solid fa-plus"></i>Tambah Bundle Internet
                                                </button>
                                            </div>
                                            <div class="w-20 me-10">
                                                <a href="#kt_modal_tambah_bundle_internet" data-bs-toggle="modal"
                                                    id="btn-bundle-internet"
                                                    class="btn btn-light-info btn-sm btn_bundle_internet">
                                                    <i class="fa-solid fa-plus"></i>Tambah Bundle Baru</a>
                                            </div>
                                        </div> --}}


                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        @include('cmt-opportunity.boq.add.modal-review-director-boq-commercial')
        @include('cmt-opportunity.boq.add.modal-review-manager-sales-boq-commercial')
        @include('cmt-opportunity.boq.add.modal-review-manager-operation-boq-commercial')
        @include('cmt-opportunity.boq.add.modal-review-finman-boq-commercial')
        @include('cmt-opportunity.boq.add.modal-item-detail', array('boq_type' => $dataReviewBoq['dataCompanyItem'][0]->boq_type))

        <script>

            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.id.startsWith('approve')) {
                        const rejectCheckbox = document.querySelector(`#reject${this.id.substr(7)}`);
                        if (rejectCheckbox) {
                            rejectCheckbox.checked = false;
                        }
                    } else if (this.id.startsWith('reject')) {
                        const approveCheckbox = document.querySelector(`#approve${this.id.substr(6)}`);
                        if (approveCheckbox) {
                            approveCheckbox.checked = false;
                        }
                    }
                });
            });

            let dataUnit = @json($dataUnit);

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

                @if ($dataReviewBoq['dataCompanyItem'][0]->boq_type == "perangkat")
                $('.MultipleItem input[name="content[][markup_price]"]').each(function() {
                    let totalPriceValue = $(this).val();

                    if (totalPriceValue !== "") {
                        totalMarkup += parseInt(totalPriceValue);
                    }
                });

                const totalMarkupWithCommas = new Intl.NumberFormat("id").format(totalMarkup);

                $('#total_markup_price').text(totalMarkupWithCommas);
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
                    let markup_price = ($(this).data('markup_price'));
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
                    $('#markup_item_detail').val(markup_price);
                    // $('#total_price_item_detail').val(total_price);

                    $('#item_detail_item_detail').val(item_detail);
                    $('#quantity_item_detail').val(quantity);
                    $('#unit_item_detail').val(unit);
                    // $('#unit_item_detail').val(unit).trigger('change');
                    document.getElementById('total_item_detail').textContent = total_price;
                });




                $('.btn_review_director_boq_commercial').on('click', function() {
                    var boq_id = $(this).data('boq-id');
                    $('#itemableBillOfQuantity_id').val(boq_id);
                    var remark = $(this).data('remark');
                    $('#remark_director').val(remark);
                    // console.log(boq_id, remark); 
                });

                $('#kt_modal_review_director_boq_commercial_approve').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_director"]');
                    isApprovalInput.val('1');

                    var is_approval = $('input[name="is_approval_director"]');
                    var is_approval_director = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id').value;
                    var remark = document.getElementById('remark_director').value;
                    // console.log(boq_id, is_approval_director, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_director: is_approval_director,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');
                    $('#kt_modal_review_director_boq_commercial').modal('hide');
                });

                $('#kt_modal_review_director_boq_commercial_decline').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_director"]');
                    isApprovalInput.val('0');

                    var is_approval = $('input[name="is_approval_director"]');
                    var is_approval_director = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id').value;
                    var remark = document.getElementById('remark_director').value;
                    // console.log(boq_id, is_approval_director, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_director: is_approval_director,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');

                    // Tutup modal
                    $('#kt_modal_review_director_boq_commercial').modal('hide');
                });



                $('.btn_review_finman_boq_commercial').on('click', function() {
                    var boq_id = $(this).data('boq-id');
                    $('#itemableBillOfQuantity_id_finman').val(boq_id);
                    var remark = $(this).data('remark');
                    $('#remark_finman').val(remark);
                    // console.log(boq_id, remark); 
                });

                $('#kt_modal_review_finman_boq_commercial_approve').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_finman"]');
                    isApprovalInput.val('1');

                    var is_approval = $('input[name="is_approval_finman"]');
                    var is_approval_finman = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id_finman').value;
                    var remark = document.getElementById('remark_finman').value;
                    // console.log(boq_id, is_approval_finman, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_finman: is_approval_finman,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');
                    // Tutup modal
                    $('#kt_modal_review_finman_boq_commercial').modal('hide');
                });

                $('#kt_modal_review_finman_boq_commercial_decline').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_finman"]');
                    isApprovalInput.val('0');

                    var is_approval = $('input[name="is_approval_finman"]');
                    var is_approval_finman = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id_finman').value;
                    var remark = document.getElementById('remark_finman').value;
                    // console.log(boq_id, is_approval_finman, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_finman: is_approval_finman,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');

                    // Tutup modal
                    $('#kt_modal_review_finman_boq_commercial').modal('hide');
                });



                $('.btn_review_manager_sales_boq_commercial').on('click', function() {
                    var boq_id = $(this).data('boq-id');
                    $('#itemableBillOfQuantity_id_manager_sales').val(boq_id);
                    var remark = $(this).data('remark');
                    $('#remark_manager_sales').val(remark);
                    // console.log(boq_id, remark); 
                });

                $('.btn_review_manager_operation_boq_commercial').on('click', function() {
                    var boq_id = $(this).data('boq-id');
                    $('#itemableBillOfQuantity_id_manager_operation').val(boq_id);
                    var remark = $(this).data('remark');
                    $('#remark_manager_operation').val(remark);
                    // console.log(boq_id, remark); 
                });

                $('#kt_modal_review_manager_sales_boq_commercial_approve').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_manager_sales"]');
                    isApprovalInput.val('1');

                    var is_approval = $('input[name="is_approval_manager_sales"]');
                    var is_approval_manager_sales = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id_manager_sales').value;
                    var remark = document.getElementById('remark_manager_sales').value;
                    // console.log(boq_id, is_approval_manager_sales, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_manager_sales: is_approval_manager_sales,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');
                    // Tutup modal
                    $('#kt_modal_review_manager_sales_boq_commercial').modal('hide');
                });

                $('#kt_modal_review_manager_operation_boq_commercial_approve').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_manager_operation"]');
                    isApprovalInput.val('1');

                    var is_approval = $('input[name="is_approval_manager_operation"]');
                    var is_approval_manager_operation = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id_manager_operation').value;
                    var remark = document.getElementById('remark_manager_operation').value;
                    // console.log(boq_id, is_approval_manager_operation, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_manager_operation: is_approval_manager_operation,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');
                    // Tutup modal
                    $('#kt_modal_review_manager_operation_boq_commercial').modal('hide');
                });

                $('#kt_modal_review_manager_sales_boq_commercial_decline').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_manager_sales"]');
                    isApprovalInput.val('0');

                    var is_approval = $('input[name="is_approval_manager_sales"]');
                    var is_approval_manager_sales = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id_manager_sales').value;
                    var remark = document.getElementById('remark_manager_sales').value;
                    // console.log(boq_id, is_approval_manager_sales, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_manager_sales: is_approval_manager_sales,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');

                    // Tutup modal
                    $('#kt_modal_review_manager_sales_boq_commercial').modal('hide');
                });

                $('#kt_modal_review_manager_operation_boq_commercial_decline').on('click', function() {
                    var isApprovalInput = $('input[name="is_approval_manager_operation"]');
                    isApprovalInput.val('0');

                    var is_approval = $('input[name="is_approval_manager_operation"]');
                    var is_approval_manager_operation = is_approval.val();
                    var boq_id = document.getElementById('itemableBillOfQuantity_id_manager_operation').value;
                    var remark = document.getElementById('remark_manager_operation').value;
                    // console.log(boq_id, is_approval_manager_operation, remark);

                    $.ajax({
                        url: "{{ route('com.boq.store.approval.boq') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_approval_manager_operation: is_approval_manager_operation,
                            boq_id: boq_id,
                            remark: remark
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
                    is_approval.val('');

                    // Tutup modal
                    $('#kt_modal_review_manager_operation_boq_commercial').modal('hide');
                });

                updateTotalSum();
                updateTotalSumBundle();
            });
        </script>

    @endsection
