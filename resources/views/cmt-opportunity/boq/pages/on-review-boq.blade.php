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
    {{-- @dd($dataReviewBoq['dataCompanyItem'][0]) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Review Bill of Quantity</span>
                            </h3>

                            <div class="card-toolbar p-3">
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
                            </div>

                        </div>
                        <div class="card-body">
                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">

                                    {{-- divv Company --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        {{-- baris prospect company --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 450px; margin-bottom: 15px;">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->prospect_title }} - {{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="boq_id"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->id }}">
                                                <div id="error-prospect"></div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 450px; margin-bottom: 15px;">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $dataReviewBoq['dataCompanyItem'][0]->surveyRequest->no_survey ?? 'Survey Tidak ada' }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->survey_request_id}}">
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
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataReviewBoq['dataCompanyItem'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- sales & gpm required --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Sales</label>
                                                <input type="number" class="form-control form-control-solid disabled"
                                                    oninput="validateAndFormatNumber(this);" id="sales_id"
                                                    name="sales_id"
                                                    placeholder="{{ $dataReviewBoq['dataSalesSelected']->name ?? 'Sales Tidak Ada' }}" />
                                            </div>

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Technician</label>
                                                <input type="number" class="form-control form-control-solid disabled"
                                                    oninput="validateAndFormatNumber(this);" id="technician_id"
                                                    name="technician_id"
                                                    placeholder="{{ $dataReviewBoq['dataTechnicianSelected']->name ?? 'Technician Tidak Ada' }}" />
                                            </div>

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Procurement</label>
                                                <input type="number" class="form-control form-control-solid disabled"
                                                    oninput="validateAndFormatNumber(this);" id="procurement_id"
                                                    name="procurement_id"
                                                    placeholder="{{ $dataReviewBoq['dataProcurementSelected']->name ?? 'Procurement Tidak Ada' }}" />
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">GPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="gpm"
                                                        name="gpm"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="modal"
                                                        name="modal"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="npm"
                                                        name="npm"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Manpower</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="manpower"
                                                        name="manpower"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->manpower ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 10%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="percentage"
                                                        name="percentage"
                                                        value="{{ $dataReviewBoq['dataCompanyItem'][0]->percentage ?? null }}" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tempat Items --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            @if (isset($dataReviewBoq['dataCompanyItem'][0]->itemable))
                                                @foreach ($dataReviewBoq['dataCompanyItem'][0]->itemable as $relatedItem)
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
                                                        </div>

                                                        <div>
                                                            <input type="hidden" name="content[][id]" disabled
                                                                value="{{ $relatedItem->id ?? null }}" />
                                                            <input type="hidden" name="content[][item_inventory_id]"
                                                                disabled
                                                                value="{{ $relatedItem->item_inventory_id ?? null }}" />
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
                                            {{-- <div class="ms-15 w-20 mt-3 mb-3 ">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div> --}}
                                        @endrole

                                    </div>

                                    {{-- layer total dan submit --}}
                                    {{-- <div>
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
                                    </div> --}}

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

        <script>
            // Mengambil semua elemen checkbox dengan class "form-check-input"
            const checkboxes = document.querySelectorAll('.form-check-input');
            // Mendaftar event listener untuk setiap checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Jika checkbox yang dipilih adalah checkbox "Approve" di dalam grupnya
                    if (this.id.startsWith('approve')) {
                        // Matikan checkbox "Reject" di grup yang sama
                        const rejectCheckbox = document.querySelector(`#reject${this.id.substr(7)}`);
                        if (rejectCheckbox) {
                            rejectCheckbox.checked = false;
                        }
                    }
                    // Jika checkbox yang dipilih adalah checkbox "Reject" di dalam grupnya
                    else if (this.id.startsWith('reject')) {
                        // Matikan checkbox "Approve" di grup yang sama
                        const approveCheckbox = document.querySelector(`#approve${this.id.substr(6)}`);
                        if (approveCheckbox) {
                            approveCheckbox.checked = false;
                        }
                    }
                });
            });

            $(document).ready(function() {
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
                            remark : remark
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
                            remark : remark
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
                            remark : remark
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
                            remark : remark
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
                            remark : remark
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
                            remark : remark
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
                            remark : remark
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
                            remark : remark
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

                updateTotalSum();
            });
        </script>

    @endsection
