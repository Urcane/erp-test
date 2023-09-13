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
    {{-- @dd($updateDraftBoqData['inventoryGoodInet']) --}}
    {{-- @dd($updateDraftBoqData['quotationItem']) --}}
    {{-- @dd($updateDraftBoqData['quotationItem']); --}}

    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-md-lh-sm">Commercial Bill of Quantity</span>
                            </h3>
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

                                        <input type="hidden" id="boq_id" name="boq_id"
                                            value="{{ $updateDraftBoqData['dataCompanyItem'][0]->id }}">

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-8 ">
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

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-8 ">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class=" fw-bold">Survey ID</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" disabled
                                                placeholder="{{ $updateDraftBoqData['dataCompanyItem'][0]->surveyRequest->no_survey ?? 'Survey Tidak ada' }}">

                                            <input type="hidden" class="form-control form-control-solid" disabled
                                                name="survey_request_id" id="survey_request_id"
                                                value="{{ $updateDraftBoqData['dataCompanyItem'][0]->survey_request_id }}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    {{-- baris company contact --}}
                                    <div class="my-8 d-flex justify-content-around flex-wrap col-12">

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label">Nama Perusahaan</label>
                                            <input type="text" class="form-control form-control-solid" disabled
                                                id="customer_name"
                                                value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class=" form-label">Nama Kontak Customer</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                disabled name="customer_contact_name" id="customer_contact_name"
                                                value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label">No Kontak Customer</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-0" id="">+62</span>
                                                <input type="number" class="form-control form-control-solid" disabled
                                                    minlength="8" name="customer_contact_phone" id="customer_contact_phone"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label">Jenis Project</label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                disabled name="type_name" id="type_name"
                                                value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->bussinesType->type_name }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- sales & gpm required --}}
                                <div class="mb-6 border-dashed border-gray-100">
                                    <div class="d-flex justify-content-around flex-wrap my-8 row">

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                            <label class="form-label required">Sales</label>
                                            <select class="form-select-solid form-select form-select-solid"
                                                data-control="select2" name="sales_id" id="sales_id">
                                                {{-- <option value="{{ $updateDraftBoqData['dataSalesSelected']->id ?? null }}"
                                                    selected disabled>
                                                    {{ $updateDraftBoqData['dataSalesSelected']->name ?? 'Pilih Sales' }}
                                                </option> --}}

                                                @if (isset($updateDraftBoqData['dataSales']))
                                                    @foreach ($updateDraftBoqData['dataSales'] as $sales)
                                                        @if ($updateDraftBoqData['dataSalesSelected']->id && $updateDraftBoqData['dataSalesSelected']->id == $sales->id)
                                                            <option value="{{ $sales->id }}" selected>
                                                                {{ $sales->name }} </option>
                                                        @else
                                                            <option value="{{ $sales->id }}">
                                                                {{ $sales->name }} </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option
                                                        value="{{ $updateDraftBoqData['dataSalesSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $updateDraftBoqData['dataSalesSelected']->name ?? 'Pilih Sales' }}
                                                    </option>
                                                @endif 
                                            </select>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                            <label class="form-label required">Technician</label>
                                            <select class="form-select-solid form-select form-select-solid"
                                                    data-control="select2" name="technician_id" id="technician_id">
                                                    {{-- <option
                                                        value="{{ $updateDraftBoqData['dataTechnicianSelected']->id ?? null }}"
                                                        selected disabled>
                                                        {{ $updateDraftBoqData['dataTechnicianSelected']->name ?? 'Pilih Technician' }}
                                                    </option>
                                                    @if (isset($updateDraftBoqData['dataTechnician']))
                                                        @foreach ($updateDraftBoqData['dataTechnician'] as $Technician)
                                                            <option value="{{ $Technician->id ?? null }}">
                                                                {{ $Technician->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    @endif --}}

                                                    @if (isset($updateDraftBoqData['dataTechnician']))
                                                        @foreach ($updateDraftBoqData['dataTechnician'] as $Technician)
                                                            @if ($updateDraftBoqData['dataTechnicianSelected'] && $updateDraftBoqData['dataTechnicianSelected']->id == $Technician->id)
                                                                <option value="{{ $Technician->id }}" selected>
                                                                    {{ $Technician->name }} </option>
                                                            @else
                                                                <option value="{{ $Technician->id }}">
                                                                    {{ $Technician->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @if ($updateDraftBoqData['dataTechnicianSelected']) 
                                                            <option
                                                                value="{{ $updateDraftBoqData['dataTechnicianSelected']->id ?? null }}"
                                                                selected disabled>
                                                                {{ $updateDraftBoqData['dataTechnicianSelected']->name ?? 'Pilih Technician' }}
                                                            </option> 
                                                        @else
                                                            <option value="">Technician Tidak Ada</option>
                                                        @endif
                                                    @endif 
                                            </select>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-8">
                                            <label class="form-label required">Procurement</label>
                                            <select class="form-select-solid form-select form-select-solid"
                                                data-control="select2" name="procurement_id" id="procurement_id">
                                                {{-- <option
                                                    value="{{ $updateDraftBoqData['dataProcurementSelected']->id ?? null }}"
                                                    selected disabled>
                                                    {{ $updateDraftBoqData['dataProcurementSelected']->name ?? 'Pilih Procurement' }}
                                                </option>
                                                @if (isset($updateDraftBoqData['dataProcurement']))
                                                    @foreach ($updateDraftBoqData['dataProcurement'] as $procurement)
                                                        <option value="{{ $procurement->id ?? null }}">
                                                            {{ $procurement->name ?? null }}
                                                        </option>
                                                    @endforeach
                                                @endif --}}
                                                @if (isset($updateDraftBoqData['dataProcurement']))
                                                        @foreach ($updateDraftBoqData['dataProcurement'] as $procurement)
                                                            @if ($updateDraftBoqData['dataProcurementSelected'] &&  $updateDraftBoqData['dataProcurementSelected']->id == $procurement->id)
                                                                <option value="{{ $procurement->id }}" selected>
                                                                    {{ $procurement->name }} </option>
                                                            @else
                                                                <option value="{{ $procurement->id }}">
                                                                    {{ $procurement->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option
                                                            value="{{ $updateDraftBoqData['dataProcurementSelected']->id ?? null }}"
                                                            selected disabled>
                                                            {{ $updateDraftBoqData['dataProcurementSelected']->name ?? 'Pilih Technician' }}
                                                        </option>
                                                    @endif 

                                            </select>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-around flex-wrap my-8">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label required">Modal</label>
                                            <div class="position-relative">
                                                <div class="position-absolute top-0"></div>
                                                <input type="number" disabled
                                                    class="form-control form-control-solid required" id="modal"
                                                    name="modal"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->modal ?? null }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label required">GPM</label>
                                            <div class="position-relative">
                                                <div class="position-absolute top-0"></div>
                                                <input type="number" disabled
                                                    class="form-control form-control-solid required" id="gpm"
                                                    name="gpm"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->gpm ?? null }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label required">NPM</label>
                                            <div class="position-relative">
                                                <div class="position-absolute top-0"></div>
                                                <input type="number" disabled
                                                    class="form-control form-control-solid required" id="npm"
                                                    name="npm"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->npm ?? null }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-5 col-sm-5 col-8 mt-2 mb-3">
                                            <label class="form-label required">Percentage</label>
                                            <div class="position-relative">
                                                <div class="position-absolute top-0"></div>
                                                <input type="number" disabled
                                                    class="form-control form-control-solid required" id="percentage"
                                                    name="percentage"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->percentage ?? null }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- Tempat Items --}}
                                <div class="mb-6 border-dashed border-gray-100">

                                    <div class="MultipleItem justify-content-center mx-10 mt-5 mb-8 row">
                                        @if (isset($updateDraftBoqData['dataCompanyItem'][0]->itemable))
                                            @foreach ($updateDraftBoqData['dataCompanyItem'][0]->itemable as $relatedItem)
                                                @php
                                                    $random_string = \Illuminate\Support\Str::random(4);
                                                @endphp
                                                <div class="file-soft-boq-item-{{ $random_string }} mb-5 mt-10 col-12">
                                                    <div class="row d-flex justify-content-between ">
                                                        <div class="col-12 col-lg-3">
                                                            <label class="form-label">Item</label>
                                                            <input type="text" class="form-control form-control-solid"
                                                                disabled name="content[][good_name]"
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
                                                            <div class="row justify-content-between align-items-center">
                                                                <div class="col-lg-10 col-md-10 col-10 col-sm-10">
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
                                                                <div class="col-lg-2 col-md-2 col-2 col-sm-2">
                                                                    <div class="h-25px"></div>
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-icon btn-md"
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
                                                                        <li type="button" class="btn-update-price-modal"
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
                                                                                <i class="fa-solid fa-edit me-3"></i>Edit
                                                                                Harga
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

                                                        <input type="hidden" name="content[][id]" disabled
                                                            value="{{ $relatedItem->id ?? null }}" />
                                                        <input type="hidden" name="content[][item_inventory_id]" disabled
                                                            value="{{ $relatedItem->inventory_good_id ?? null }}" />
                                                        <input type="hidden" name="content[][purchase_reference]"
                                                            disabled
                                                            value="{{ $relatedItem->purchase_reference ?? null }}" />
                                                        <input type="hidden" name="content[][delivery_route]" disabled
                                                            value="{{ $relatedItem->delivery_route ?? null }}" />
                                                        <input type="hidden" name="content[][delivery_type]" disabled
                                                            value="{{ $relatedItem->delivery_type ?? null }}" />
                                                        <input type="hidden" name="content[][purchase_from]" disabled
                                                            value="{{ $relatedItem->purchase_from ?? null }}" />
                                                        <input type="hidden" name="content[][payment_type]" disabled
                                                            value="{{ $relatedItem->payment_type ?? null }}" />
                                                        <input type="hidden" name="content[][purchase_validity]" disabled
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
                                        <div class="d-flex justify-content-start mx-20 mb-5">
                                            <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                class="btn btn-light-info btn-sm mx-3 btn_tambah_boq">
                                                <i class="fa-solid fa-plus"></i>Item Baru</a>
                                            <div id="error-item"></div>
                                        </div>
                                    @endrole

                                </div>

                                {{--  divv BUNDLE INTERNET --}}
                                <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                    <div class="BundleItem justify-content-center mx-10 mt-5 mb-8 row">
                                        @if (isset($updateDraftBoqData['quotationItem']))

                                            @foreach ($updateDraftBoqData['quotationItem'] as $relatedItem)
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
                                                            <label for="good_name_bundle_{{ $random_string }}"
                                                                class="d-flex align-items-center fs-6 form-label mb-2">
                                                                <span class="required fw-bold">Internet
                                                                    Bundle</span>
                                                            </label>
                                                            <select class="form-select form-select-solid drop-data"
                                                                data-control="select2"required
                                                                name="good_name_bundle_{{ $random_string }}"
                                                                id="good_name_bundle_{{ $random_string }}">

                                                                @foreach ($updateDraftBoqData['inventoryGoodInet'] as $item)
                                                                    @if ($relatedItem->item_inventory_id == $item->id)
                                                                        <option selected value="{{ $item->id }}">
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

                                                        <!-- Quantity -->
                                                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                            <div class="row d-flex justify-content-between ">
                                                                <div class="col-7 col-md-6">
                                                                    <label for="quantity_{{ $random_string }}"
                                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                                        <span class="fw-bold required">Quantity</span>
                                                                    </label>
                                                                    <input class="form-control" type="text" required
                                                                        min="1" minlength="1"
                                                                        oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                        name="quantity_{{ $random_string }}"
                                                                        id="quantity_{{ $random_string }}"
                                                                        value="{{ $relatedItem->quantity }}">
                                                                </div>
                                                                <div class="col-5 col-md-6">
                                                                    <label for="unit_${random_string}"
                                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                                        <span class="required fw-bold">Unit</span>
                                                                    </label>
                                                                    <select class="form-select form-select-solid drop-data"
                                                                        data-control="select2" required
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
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Purchase Price -->
                                                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                                for="purchase_price_{{ $random_string }}">
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
                                                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                            <div class="row d-flex justify-content-between ">

                                                                <div class="col-10">
                                                                    <label
                                                                        class="d-flex align-items-center fs-6 form-label mb-2"
                                                                        for="total_price_{{ $random_string }}">
                                                                        <span class="fw-bold">Total Price</span>
                                                                    </label>
                                                                    <input class="form-control" type="text"
                                                                        min="1" minlength="1" disabled
                                                                        oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                                        name="total_price_{{ $random_string }}"
                                                                        id="total_price_{{ $random_string }}"
                                                                        value="{{ $relatedItem->total_price }}">
                                                                </div>

                                                                <div class="col-2">
                                                                    <div>
                                                                        <div class="h-25px"></div>
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-icon btn-md h-44px"
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
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    @role('administrator')
                                        <div class="d-flex justify-content-end mt-5">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : Rp<span
                                                        id="total_bundle_price"></span></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-start mx-20 mb-5">
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
                                        </div>
                                    @endrole

                                </div>

                                {{-- layer total dan submit --}}
                                <div>
                                    <input class="form-check-input" type="hidden" id="is_draft" name="is_draft"
                                        value="0" />
                                    <input class="form-check-input" type="hidden" id="is_final" name="is_final"
                                        value="0" />
                                    <div class="d-flex justify-content-center mt-6">
                                        <div class=" me-5">
                                            <a href="" class="btn btn-light-danger">Discard</a>
                                        </div>
                                        <div class="me-5">
                                            <button id="submit-all-items" type="button"
                                                class="btn btn-light-info">Update</button>
                                        </div>
                                        <div class="me-5">
                                            <button id="finalize-all-items" type="button"
                                                class="btn btn-info">Final</button>
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

        @include('cmt-opportunity.boq.add.modal-tambah-boq')
        @include('cmt-opportunity.boq.add.modal-update-boq')
        @include('cmt-opportunity.boq.add.modal-update-price')
    @endrole

    <script>
        let dataUnit = @json($dataUnit);

        function updateTotalSumBundle() {
            let totalSumBundle = 0;
            const modalVal = parseInt(document.querySelector(`[name='modal']`).value);

            $('.BundleItem input[name^="total_price"]').each(function() {
                let totalPriceBundleValue = $(this).val();

                if (totalPriceBundleValue !== "") {
                    totalSumBundle += parseInt(totalPriceBundleValue);
                }
            });

            if (modalVal >= totalSumBundle) {
                return document.getElementById("total_bundle_price").textContent = "   KURANG MODAL";
            }

            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSumBundle);

            $('#total_bundle_price').text(totalPriceWithCommas);
            $('#gpm').val(totalSumBundle);

            // const hiddenTotalInput = document.querySelector(`[name='total_price_bundle']`);
            // hiddenTotalInput.value = totalSumBundle; // Set the hidden input value to empty string 


            // Ambil nilai gpm dan modal
            let gpm = parseFloat($('#gpm').val()); // gunakan parseFloat untuk memastikan nilai numerik
            let modal = parseFloat($('#modal').val()); // gunakan parseFloat untuk memastikan nilai numerik

            if (!isNaN(gpm) && !isNaN(modal)) {
                let npm = gpm - modal;
                let percentage = (npm / gpm) * 100;

                $('#npm').val(npm);
                $('#percentage').val(percentage.toFixed(2));
            }
        }

        function calculateTotalBundle(uniq_id) {
            const purchasePrice = parseFloat(document.querySelector(`[name='purchase_price_${uniq_id}']`)
                .value);
            const quantity = parseInt(document.querySelector(`[name='quantity_${uniq_id}']`).value);

            if (isNaN(purchasePrice) || isNaN(quantity)) {
                return document.getElementById("total_price_" + uniq_id).value = "null";
            }

            let totalAmount = purchasePrice * quantity;

            document.getElementById("total_price_" + uniq_id).value = totalAmount;
            updateTotalSumBundle()
        }

        function updateTotalSum() {
            let totalSum = 0;

            // Loop through each item's total price input field and sum up the values
            $('.MultipleItem input[name="content[][total_price]"]').each(function() {
                let totalPriceValue = $(this).val();

                if (totalPriceValue !== "") {
                    totalSum += parseInt(totalPriceValue);
                }
            });
            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSum);

            $('#total_item_price').text(totalPriceWithCommas);
            $('#modal').val(totalSum);

            // Ambil nilai gpm dan modal
            let gpm = parseFloat($('#gpm').val()); // gunakan parseFloat untuk memastikan nilai numerik
            let modal = parseFloat($('#modal').val()); // gunakan parseFloat untuk memastikan nilai numerik

            if (!isNaN(gpm) && !isNaN(modal)) {
                let npm = gpm - modal;
                let percentage = (npm / gpm) * 100;

                $('#npm').val(npm);
                $('#percentage').val(percentage.toFixed(2));
            }
        }


        $(document).ready(function() {
            //  FINAL COMERCIAL
            $('#finalize-all-items').on('click', function(e) {
                e.preventDefault();

                $('input[name="is_final"]').val(1);

                $('#submit-all-items').trigger('click');
            })

            // UPDATE COMERCIAL
            $('#submit-all-items').on('click', function(event) {
                event.preventDefault();

                // let survey_request_id = $('#survey_request_id').val();
                let boq_id = $('#boq_id').val();
                let prospect_id = $('#prospect_id').val();
                let is_draft = $('#is_draft').val();

                let sales_id = $('#sales_id').val();
                let technician_id = $('#technician_id').val();
                let procurement_id = $('#procurement_id').val();

                let modal = $('#modal').val();
                let gpm = $('#gpm').val();
                let npm = $('#npm').val();
                let percentage = $('#percentage').val();

                let is_final = $('#is_final').val();


                let items = [];
                // let bundle = [];

                let boq = {
                    boq_id: boq_id,
                    prospect_id: prospect_id,
                    is_draft: is_draft,
                    is_final: is_final,
                    // survey_request_id: survey_request_id,

                    sales_id: sales_id,
                    technician_id: technician_id,
                    procurement_id,
                    procurement_id,

                    modal: modal,
                    gpm: gpm,
                    npm: npm,
                    percentage: percentage
                };

                console.log(boq);

                // Loop through each .file-soft-boq-item div to get the data for each item
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

                    // Create an object to store the data for the specific item
                    let itemData = {
                        id: id,
                        item_inventory_id: item_inventory_id,
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
                        total_price: total_price
                    };

                    // Push the itemData object to the items array
                    items.push(itemData);
                });

                // Loop through each .file-soft-boq-item div to get the data for each item
                $('.BundleItem [class^="file-soft-quotation-bundle"]').each(function(index, item) {
                    // Extract data for the specific item
                    let id = $(item).find('input[name^="bundle_id"]').val();
                    let item_inventory_id = $(item).find('select[name^="good_name_bundle"]').val();
                    let purchase_price = $(item).find('input[id^="purchase_price"]').val();
                    let quantity = $(item).find('input[id^="quantity"]').val();
                    let unit = $(item).find('select[id^="unit"]').val();
                    let total_price = $(item).find('input[name^="total_price"]').val();

                    // Create an object to store the data for the specific item
                    let itemData = {
                        id: id,
                        item_inventory_id: item_inventory_id,
                        quantity: quantity,
                        unit: unit,
                        purchase_price: purchase_price,
                        total_price: total_price
                    };

                    // Push the itemData object to the items array
                    items.push(itemData);
                });

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

                        // if (response.data.is_final == 1) {
                        //     setTimeout(() => {
                        //         window.location.href =
                        //             `cmt-boq/on-review-boq?boq_id=${response.data.id}`;
                        //     }, 800);
                        // } else {
                        //     setTimeout(() => {
                        //         window.location.reload();
                        //     }, 800);
                        // } 

                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.error);
                        console.error('Error submitting all item data: ', error);
                    }
                });
            });


            // Function Update ITEM BOQ YANG SUDAH ADA 
            $('.btn-update-boq-modal').on('click', function() {
                let randomString = $(this).data('random-string');
                let itemId = parseInt($(this).data('itemId'));

                let quantity = $(this).data('quantity');
                let unit = $(this).data('unit');
                let item_detail = ($(this).data('item_detail'));

                // console.log(randomString, itemId, quantity, total_price, purchase_delivery_charge,
                //     purchase_price, purchase_reference, item_detail);

                $('#good_name_update').val(itemId).trigger('change');

                $('#kt_modal_update_boq').modal('show');

                $('#uniq_id').val(randomString);


                $('#item_detail_update').val(item_detail);
                $('#quantity_update').val(quantity);
                $('#unit_update').val(unit).trigger('change');
                // document.getElementById('total_update').textContent = total_price;
            });

            $('.btn-update-price-modal').on('click', function() {
                let randomString = $(this).data('random-string');
                let itemId = parseInt($(this).data('itemId'));
                console.log($(this).data('itemId'));

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

                $('#good_name_update_price').val(itemId).trigger('change');

                $('#kt_modal_update_price').modal('show');

                $('#uniq_id_price').val(randomString);

                $('#purchase_from_update_price').val(purchase_from);
                $('#delivery_route_update_price').val(delivery_route);
                $('#delivery_type_update_price').val(delivery_type);
                $('#payment_type_update_price').val(payment_type);
                $('#purchase_validity_update_price').val(purchase_validity);
                $('#purchase_reference_update_price').val(purchase_reference);
                $('#purchase_price_update_price').val(purchase_price);
                $('#purchase_delivery_charge_update_price').val(purchase_delivery_charge);
                $('#total_price_update_price').val(total_price);

                $('#item_detail_update_price').val(item_detail);
                $('#quantity_update_price').val(quantity);
                $('#unit_update_price').val(unit).trigger('change');
                // document.getElementById('total_update_price').textContent = total_price;
            });

            // Handler untuk peristiwa "change" pada select item
            $('#good_name_update').on('change', function() {
                let selectedItemId = $(this).val();
                let url = $(this).data('url');

                // Mengirim permintaan asinkron menggunakan AJAX untuk mendapatkan data jenis dan merek item
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        item_id: selectedItemId
                    }, // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
                    success: function(response) {
                        // console.log(response);
                        $('#good_type_update').val(response.good_type).prop('disabled', true);
                        $('#merk_update').val(response.merk).prop('disabled', true);
                        $('#detail_update').val(response.description).prop('disabled', true);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $('#good_name_update_price').on('change', function() {
                let selectedItemId = $(this).val();
                let url = $(this).data('url');

                // Mengirim permintaan asinkron menggunakan AJAX untuk mendapatkan data jenis dan merek item
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        item_id: selectedItemId
                    }, // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
                    success: function(response) {
                        // console.log(response);
                        $('#good_type_update_price').val(response.good_type).prop('disabled',
                            true);
                        $('#merk_update_price').val(response.merk).prop('disabled', true);
                        $('#detail_update_price').val(response.description).prop('disabled',
                            true);
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
                    quantity: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Quantity wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'>Quantity minimal memiliki 1 angka</span>",
                    },
                    unit: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Unit wajib diisi</span>",
                    },
                },
                submitHandler: function(form) {
                    event.preventDefault();

                    // Menggunakan jQuery untuk mendapatkan inputan nama dan merk
                    let selectedItemId = $('#good_name_update').val();
                    let itemName = $('#good_name_update option:selected').text();
                    let itemMerk = $('#merk_update').val();

                    // Membuat elemen input tersembunyi untuk nama barang
                    let itemNameInput = $('<input>').attr({
                        type: 'text',
                        name: 'content[][good_name]',
                        value: itemName
                    });

                    // Menambahkan elemen input tersembunyi ke dalam form
                    $(form).append(itemNameInput);

                    let formData = new FormData(form);

                    const uniq_id = formData.get('uniq_id');

                    const item = document.querySelectorAll(
                        `.MultipleItem .file-soft-boq-item-${uniq_id}`);

                    let data = $(`.btn-update-boq-modal[data-random-string="${uniq_id}"]`);

                    // Mengatur ulang atribut-atribut elemen <li> berdasarkan formData
                    data.attr({
                        'data-item-id': selectedItemId,
                        'data-quantity': formData.get('quantity_update'),
                        'data-unit': formData.get('unit_update'),
                        'data-item_detail': formData.get('item_detail')
                    });

                    data.data({
                        'item-id': selectedItemId,
                        'quantity': formData.get('quantity_update'),
                        'unit': formData.get('unit_update'),
                        'item_detail': formData.get('item_detail')
                    });

                    $('[name="content[][item_inventory_id]"]', item).val(formData.get('good_name'));
                    $('[name="content[][good_name]"]', item).val(itemName);
                    $('[name="content[][good_merk]"]', item).val(itemMerk);

                    $('[name="content[][quantity]"]', item).val(formData.get('quantity_update'));
                    $('[name="content[][unit]"]', item).val(formData.get('unit_update'));
                    $('[name="content[][item_detail]"]', item).val(formData.get('item_detail'));


                    // Hapus elemen itemNameInput dari formulir
                    itemNameInput.remove();

                    // Bersihkan input setelah item ditambahkan
                    form.reset();

                    // // Tutup modal
                    $('#kt_modal_update_boq').modal('hide');

                    updateTotalSum();
                }
            });


            $("#kt_modal_update_price_form").validate({
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
                },
                submitHandler: function(form) {
                    event.preventDefault();

                    // Menggunakan jQuery untuk mendapatkan inputan nama dan merk
                    let selectedItemId = $('#good_name_update_price').val();
                    let itemName = $('#good_name_update_price option:selected').text();
                    let itemMerk = $('#merk_update_price').val();

                    // Membuat elemen input tersembunyi untuk nama barang
                    let itemNameInput = $('<input>').attr({
                        type: 'text',
                        name: 'content[][good_name]',
                        value: itemName
                    });

                    // Menambahkan elemen input tersembunyi ke dalam form
                    $(form).append(itemNameInput);

                    let formData = new FormData(form);

                    const uniq_id = formData.get('uniq_id_price');

                    const item = document.querySelectorAll(
                        `.MultipleItem .file-soft-boq-item-${uniq_id}`);

                    let data = $(`.btn-update-price-modal[data-random-string="${uniq_id}"]`);

                    // Mengatur ulang atribut-atribut elemen <li> berdasarkan formData
                    data.attr({
                        'data-item-id': selectedItemId,
                        'data-quantity': formData.get('quantity_update_price'),
                        'data-unit': formData.get('unit_update_price'),
                        'data-total_price': formData.get('total_update_price'),
                        'data-purchase_delivery_charge': formData.get(
                            'purchase_delivery_update_price'),
                        'data-purchase_price': formData.get('purchase_price_update_price'),
                        'data-purchase_reference': formData.get('purchase_reference'),
                        'data-item_detail': formData.get('item_detail'),
                        'data-delivery_route': formData.get('delivery_route'),
                        'data-delivery_type': formData.get('delivery_type'),
                        'data-purchase_from': formData.get('purchase_from'),
                        'data-payment_type': formData.get('payment_type'),
                        'data-purchase_validity': formData.get('purchase_validity'),
                    });

                    data.data({
                        'item-id': selectedItemId,
                        'quantity': formData.get('quantity_update_price'),
                        'unit': formData.get('unit_update_price'),
                        'total_price': formData.get('total_update_price'),
                        'purchase_delivery_charge': formData.get(
                            'purchase_delivery_update_price'),
                        'purchase_price': formData.get('purchase_price_update_price'),
                        'purchase_reference': formData.get('purchase_reference'),
                        'item_detail': formData.get('item_detail'),
                        'delivery_route': formData.get('delivery_route'),
                        'delivery_type': formData.get('delivery_type'),
                        'purchase_from': formData.get('purchase_from'),
                        'payment_type': formData.get('payment_type'),
                        'purchase_validity': formData.get('purchase_validity'),
                    });

                    $('[name="content[][good_name]"]', item).val(itemName);
                    $('[name="content[][good_merk]"]', item).val(itemMerk);
                    $('[name="content[][purchase_price]"]', item).val(formData.get(
                        'purchase_price_update_price'));
                    $('[name="content[][quantity]"]', item).val(formData.get('quantity_update_price'));
                    $('[name="content[][unit]"]', item).val(formData.get('unit_update_price'));
                    $('[name="content[][purchase_delivery]"]', item).val(formData.get(
                        'purchase_delivery_update_price'));
                    $('[name="content[][purchase_reference]"]', item).val(formData.get(
                        'purchase_reference'));

                    $('[name="content[][delivery_route]"]', item).val(formData.get('delivery_route'));
                    $('[name="content[][delivery_type]"]', item).val(formData.get('delivery_type'));
                    $('[name="content[][purchase_from]"]', item).val(formData.get('purchase_from'));
                    $('[name="content[][payment_type]"]', item).val(formData.get('payment_type'));
                    $('[name="content[][purchase_validity]"]', item).val(formData.get(
                        'purchase_validity'));

                    $('[name="content[][item_detail]"]', item).val(formData.get('item_detail'));
                    $('[name="content[][total_price]"]', item).val(formData.get('total_update_price'));
                    $('[name="content[][item_inventory_id]"]', item).val(formData.get('good_name'));

                    // Hapus elemen itemNameInput dari formulir
                    itemNameInput.remove();

                    // Bersihkan input setelah item ditambahkan
                    form.reset();

                    // // Tutup modal
                    $('#kt_modal_update_price').modal('hide');
                    updateTotalSum();
                }
            });


            // Function Tambah BOQ modal
            $('#btn-tambah-boq').on('click', '.btn_tambah_boq', function() {
                $('.drop-data').val("").trigger("change");
                $('#kt_modal_tambah_boq_form').trigger("reset");
                $('#kt_modal_tambah_boq_submit').removeAttr('disabled', 'disabled');
            });

            $('#good_name').on('change', function() {
                let selectedItemId = $(this).val();
                let url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        item_id: selectedItemId
                    }, // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
                    success: function(response) {
                        // console.log(response);
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
                let random_string = $(this).data('random-string');
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
                },
                submitHandler: function(form) {
                    event.preventDefault();

                    // ngambil inputan nama dan merk
                    let selectedItemId = $('#good_name').val();
                    let itemName = $('#good_name option:selected').text();
                    let itemMerk = $('#merk').val();

                    // Create a hidden input to pass the selected item's name
                    let itemNameInput = $('<input>').attr({
                        type: 'hidden',
                        name: 'content[][good_name]',
                        value: itemName
                    });

                    // Append the hidden input to the form
                    $(form).append(itemNameInput);
                    // console.log(form);
                    let random_string = generateRandomString(4);
                    let formData = new FormData(form);

                    let newItem = `
                    <div class="file-soft-boq-item-${random_string} mb-5 mt-10 col-12"> 
                        <div class="row justify-content-between">
                        
                            <div class="col-lg-3 col-12">
                                <label class="form-label">Item</label>
                                <input type="text" class="form-control form-control-solid" name="content[][good_name]" value="${itemName} - ${itemMerk}" />
                            </div>

                            
                            <div class="col-lg-2 col-12 col-md-6"> 
                                <div class="row justify-content-between">
                                    <div class="col-7"> 
                                        <label class="form-label">Qty</label>
                                        <div class="position-relative">
                                            <div class="position-absolute top-0"></div>
                                            <input type="number" class="form-control form-control-solid" name="content[][quantity]" value="${formData.get('quantity_tambah')}" />
                                        </div>
                                    </div> 
                                    <div class="col-5">
                                        <label class="form-label">Unit</label>
                                        <div class="position-relative">
                                            <div class="position-absolute top-0"></div>
                                            <input type="text" class="form-control form-control-solid" name="content[][unit]" value="${formData.get('unit')}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-12 col-md-6">
                                <label class="form-label">Price</label>
                                <div class="position-relative">
                                    <div class="position-absolute top-0"></div>
                                    <input type="number" class="form-control form-control-solid" name="content[][purchase_price]" value="${formData.get('purchase_price_tambah')}" />
                                </div>
                            </div>

                            <div class="col-lg-2 col-12 col-md-6">
                                <label class="form-label">Jasa Antar</label>
                                <div class="position-relative">
                                    <div class="position-absolute top-0"></div>
                                    <input type="number" class="form-control form-control-solid" name="content[][purchase_delivery]" value="${formData.get('purchase_delivery_tambah')}" />
                                    </div>
                            </div>
                            
                            <div class="col-lg-3 col-12 col-md-6">
                                <div class="row justify-content-between">
                                    <div class="col-10">
                                        <label class="form-label">Total
                                            Price</label>
                                        <div class="position-relative">
                                            <div class="position-absolute top-0"></div>
                                            <input type="number" class="form-control form-control-solid" name="content[][total_price]" value="${formData.get('total_tambah')}" />
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="h-30px"></div>
                                        <button type="button" class="btn btn-secondary btn-icon btn-md" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                <li type="button" class="btn-update-price-modal" 
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
                                                    <i class="fa-solid fa-edit me-3"></i>Edit Harga Item</a>                                       
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
                                <input type="hidden" name="content[][delivery_route]" value="${formData.get('delivery_route')}" disabled>
                                <input type="hidden" name="content[][delivery_type]" value="${formData.get('delivery_type')}" disabled>
                                <input type="hidden" name="content[][purchase_from]" value="${formData.get('purchase_from')}" disabled>
                                <input type="hidden" name="content[][payment_type]" value="${formData.get('payment_type')}" disabled>
                                <input type="hidden" name="content[][purchase_validity]" value="${formData.get('purchase_validity')}" disabled>
                                <input type="hidden" name="content[][item_detail]" value="${formData.get('item_detail')}" disabled>
                            </div>
                            
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

                        let randomString = $(this).data('random-string');
                        let itemId = parseInt($(this).data('item-id'));
                        let quantity = $(this).data('quantity');
                        let unit = $(this).data('unit');
                        let total_price = $(this).data('total_price');
                        let purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                        let purchase_price = $(this).data('purchase_price');
                        let purchase_reference = $(this).data('purchase_reference');
                        let item_detail = $(this).data('item_detail');

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

                    $('.MultipleItem').on('click', '.btn-update-price-modal', function() {

                        let randomString = $(this).data('random-string');
                        let itemId = parseInt($(this).data('item-id'));
                        let quantity = $(this).data('quantity');
                        let unit = $(this).data('unit');
                        let total_price = $(this).data('total_price');
                        let purchase_delivery_charge = $(this).data('purchase_delivery_charge');
                        let purchase_price = $(this).data('purchase_price');
                        let purchase_reference = $(this).data('purchase_reference');
                        let item_detail = $(this).data('item_detail');

                        console.log(randomString, itemId, quantity, total_price,
                            purchase_delivery_charge,
                            purchase_price, purchase_reference, item_detail);

                        $('#good_name_update_price').val(itemId).trigger('change');

                        $('#kt_modal_update_price').modal('show');

                        $('#uniq_id_price').val(randomString);

                        $('#item_detail_update_price').val(item_detail);
                        $('#purchase_reference_update_price').val(purchase_reference);
                        $('#purchase_price_update_price').val(purchase_price);
                        $('#purchase_delivery_charge_update_price').val(
                            purchase_delivery_charge);
                        $('#total_price_update_price').val(total_price);
                        $('#quantity_update_price').val(quantity);
                        $('#unit_update_price').val(unit).trigger('change');
                        document.getElementById('total_update_price').textContent = total_price;
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



            // Function Tambah Bundling Internet 
            $('#btn-bundle').on('click', function() {
                []
                // Find the parent container where you want to append new divs
                const parentContainer = document.querySelector(".BundleItem");

                // Create a new div element
                const newDiv = document.createElement("div");
                newDiv.className =
                    "file-soft-quotation-bundle mt-10 mb-5 col-12";

                const random_string = generateRandomString(4);
                // Define the HTML structure as a string literal
                const htmlStructure = `    
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <label for="good_name_bundle_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Internet Bundle</span>
                            </label>
                            <select class="form-select form-select-solid drop-data" required
                                data-control="select2" name="good_name_bundle_${random_string}"
                                id="good_name_bundle_${random_string}">
                                <option selected>Select Internet Bundle</option>
                            </select> 
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3"> 
                            <div class="row d-flex justify-content-between ">
                                <div class="col-7 col-md-6">
                                    <label for="quantity_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold required">Quantity</span>
                                    </label>
                                    <input class="form-control required" type="text" required min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="quantity_${random_string}" id="quantity_${random_string}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div> 
                                </div> 
                                <div class="col-5 col-md-6"> 
                                    <label for="unit_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Unit</span>
                                                </label>
                                                <select class="form-select form-select-solid drop-data" data-control="select2" required name="unit_${random_string}" id="unit_${random_string}">
                                                    <option selected disabled></option>
                                                </select>
                                </div>   
                            </div> 
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <label for="purchase_price_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold required">Purchase Price</span>
                            </label>
                            <input class="form-control required" type="text" required min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="purchase_price_${random_string}" id="purchase_price_${random_string}">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="row d-flex justify-content-between ">
                                <div class="col-10" >
                                    <label for="total_price_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Total Price</span>
                                    </label>
                                    <input class="form-control" type="text" min="1" minlength="1" disabled  name="total_price_${random_string}" id="total_price_${random_string}">
                                </div>
                                <div class="col-2">
                                    <div>
                                        <div class="h-25px"></div> 
                                        <button type="button" class="btn btn-secondary btn-icon btn-md h-44px" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
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

                        </div>

                    </div>

                `;

                // Set the HTML content of the new div to the HTML structure
                newDiv.innerHTML = htmlStructure;

                $(newDiv).find('#unit_' + random_string).select2();

                $(newDiv).find('#unit_' + random_string).empty();

                $(newDiv).find('#unit_' + random_string).append($(
                    '<option>', {
                        value: '',
                        text: 'Pilih',
                        disabled: 'disabled',
                        selected: 'selected'
                    }));

                $.each(dataUnit, function(index, item) {
                    $(newDiv).find('#unit_' + random_string).append(
                        $(
                            '<option>', {
                                value: item.code,
                                text: item.name
                            }));
                });

                $.ajax({
                    url: "{{ route('com.quotation.get.internet.bundling') }}",
                    type: 'GET',
                    success: function(response) {
                        // console.log(response);
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
                        $(this).parent().parent().parent().parent().parent().parent().parent().remove();
                        updateTotalSumBundle();
                    });

            });

            // Function Hapus Bundle Frontend
            $('.BundleItem').on('click', '.clear-soft-quotation-bundle', function() {
                let random_string = $(this).data('random-string');
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
                    good_name_update_bundle: {
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
                    let form = document.getElementById("kt_modal_tambah_bundle_internet_form");

                    let goodName = form.querySelector('input[name="good_name_update_bundle"]').value;
                    let codeName = form.querySelector('input[name="code_name_update"]').value;
                    let merk = form.querySelector('input[name="merk_update"]').value;
                    let goodType = form.querySelector('input[name="good_type_update"]').value;
                    let description = form.querySelector('textarea[name="description_update"]').value;
                    let goodCategoryId = form.querySelector('input[name="good_category_id_update"]')
                        .value;

                    console.log("Nama Inventory Item:", goodName);
                    console.log("Code Item:", codeName);
                    console.log("Merk:", merk);
                    console.log("Tipe Barang:", goodType);
                    console.log("Detail Item Inventory:", description);
                    console.log("Good Category ID:", goodCategoryId);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('com.quotation.update.internet.bundling') }}",
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

                    let boq_id = $('#id').val();
                    let total_price_bundle = $('#total_price_bundle').val();
                    let no_quotation = $('#no_quotation').val();
                    let description = $('#description').val();

                    let bundle = [];

                    let quotation = {
                        boq_id: boq_id,
                        no_quotation: no_quotation,
                        description: description,
                        total_price: total_price_bundle
                    };

                    console.log(quotation);

                    // Loop through each .file-soft-boq-item div to get the data for each item
                    $('.BundleItem [class^="file-soft-quotation-bundle"]').each(function(index, item) {
                        // Extract data for the specific item
                        let id = $(item).find('select[name^="good_name_bundle"]').val();
                        let purchase_price = $(item).find('input[id^="purchase_price"]').val();
                        let quantity = $(item).find('input[id^="quantity"]').val();
                        let total_price = $(item).find('input[name^="total_price"]').val();

                        // Create an object to store the data for the specific item
                        let itemData = {
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
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href =
                                    `cmt-quotation/update-quotation?quotation_id=${response.data.id}&quotation=internet`;
                            }, 800);
                        },
                        error: function(error) {
                            // Handle errors if the request fails
                            toastr.error(error);
                            console.error('Error submitting all item data: ', error);
                        }
                    });

                }
            });


            $('body').on('click', '.btn_create_purchase_order', function() {

                $('.drop-data').val("").trigger("change")
                $('#kt_modal_create_purchase_order_form').trigger("reset")
                $('#kt_modal_create_purchase_order_submit').removeAttr('disabled', 'disabled');

                let quo_id = $(this).data('id');
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
                        window.location.reload();
                    }
                })

            });

            updateTotalSum();
            updateTotalSumBundle();
        });
    </script>

@endsection
