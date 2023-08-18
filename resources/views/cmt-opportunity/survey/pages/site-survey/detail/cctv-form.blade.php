@extends('layouts.app')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Survey, Survey, Survey Luar biasa!')
@section('icon-apps','fa-solid fa-briefcase')

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
                        <h3 class="card-title">🌟⭐✨</h3>
                        <div class="card-toolbar">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-12 align-items-center">
                            <div class="col-lg-12 gap-3 d-flex align-items-center">
                                <div class="d-flex align-items-center gap-2 mb-8 mb-md-0 w-100">
                                    <div class="align-items-center w-100">
                                        <h3 class="fs-3 text-uppercase m-auto fw-bolder text-dark d-md-block w-100 align-items-center text-center"><span>{{ $surveyRequest->no_survey }}</span></h3>
                                        <h4 class="fs-6 m-auto text-dark d-md-block w-100 align-items-center text-center">No. Work Order: {{ $workOrder->no_wo }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6 px-12">
                            <div class="col-lg-12">
                                <form id="kt_modal_confirm_survey_result_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="">
                                    <input type="hidden" name="service_type_id" value="{{$surveyRequest->service_type_id}}">
                                    <input type="hidden" name="survey_request_id" value="{{$surveyRequest->id}}">
                                    <input type="hidden" name="customer_id" value="{{$surveyRequest->customerProspect->customer->id}}">
                                    <input type="hidden" name="customer_contact_id" value="{{$surveyRequest->customerProspect->customer->customerContact->id}}">
                                    <input type="hidden" name="work_order_id" value="{{$workOrder->id}}">
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Nama Perusahaan : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" disabled="disabled" class="form-control form-control-solid" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customer_name}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Alamat : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" disabled="disabled" class="form-control form-control-solid" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customer_address}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Kontak Person : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" disabled="disabled" class="form-control form-control-solid" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_name}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Kontak Point : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-text border-0" id="kontak">+62</span>
                                                <input type="number" disabled="disabled" class="form-control form-control-solid" minlength="8" name="kontak" value="{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_phone}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Jenis Layanan : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($siteSurveyServiceTypes as $siteSurveyServiceType)                                                
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input type="radio" class="form-check-input my-auto" placeholder="" name="site_survey_service_type_id" value="{{$siteSurveyServiceType->id}}">
                                                        <label class="fs-6 form-check-label" for="site_survey_service_type_id">
                                                            <span class="fw-bold">{{$siteSurveyServiceType->name}}</span>
                                                        </label>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Quantity : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" class="form-control form-control-solid" placeholder="" name="closest_site_range" value="{{$surveyRequest->customerProspect->customer->customer_address}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Lokal Akses : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="local_access" value="{{old('local_access')}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Durasi Record : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($cctvRecordDurations as $cctvRecordDuration)
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input type="radio" class="form-check-input" placeholder="" name="cctv_record_duration_id" value="{{$cctvRecordDuration->id}}">
                                                        <label class="fs-6 form-check-label" for="cctv_record_duration_id">
                                                            <span class="fw-bold">{{$cctvRecordDuration->name}}</span>
                                                        </label>
                                                        {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Kapasitas Penyimpanan : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($cctvStorageCapacities as $cctvStorageCapacity)
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input type="radio" class="form-check-input" placeholder="" name="cctv_storage_capacity_id" value="{{$cctvStorageCapacity->id}}">
                                                        <label class="fs-6 form-check-label" for="cctv_storage_capacity_id">
                                                            <span class="fw-bold">{{$cctvStorageCapacity->name}}</span>
                                                        </label>
                                                        {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Interface : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($siteSurveyInterfaces as $siteSurveyInterface)
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input type="radio" class="form-check-input" placeholder="" name="site_survey_interface_id" value="{{$siteSurveyInterface->id}}">
                                                        <label class="fs-6 form-check-label" for="site_survey_interface_id">
                                                            <span class="fw-bold">{{$siteSurveyInterface->name}}</span>
                                                        </label>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Tanggal Survey : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                							<input type="date" class="form-control form-control-solid" name="survey_date">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="separator mb-6"></div>
                                    @include('cmt-opportunity.survey.component.outdoor-form')
                                    <div class="separator mb-6"></div>
                                    @include('cmt-opportunity.survey.component.indoor-form')
                                    <div class="separator mb-6"></div>
                                    @include('cmt-opportunity.survey.component.other-form')
                                    <div class="position-fixed bottom-0 end-0 rounded-circle m-5">
                                        <a href="#kt_modal_confirm_survey_result" class="btn btn-primary btn-md" data-bs-toggle="modal">
                                            <i class="fa-solid fa-save fs-3"></i>
                                        </a>
                                    </div>
                                    @include('cmt-opportunity.survey.modal.modal-confirm-survey-result')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        submitModal({
            modalName: 'kt_modal_confirm_survey_result',
            ajaxLink: "{{route('com.survey-result.store')}}",
            // validationMessages: workOrderValidationMessages,
        })

        $('#kt_modal_confirm_survey_result_draft').click(function (e) {
            e.preventDefault()

            const formData = new FormData(kt_modal_confirm_survey_result_form);
            $(`#kt_modal_confirm_survey_result_draft`).attr('disabled', 'disabled');
            $.ajax({
                data: formData,
                processData: false,
                contentType: false, 
                url: "{{route('com.survey-result.draft')}}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $(`#kt_modal_confirm_survey_result_cancel`).click();
                    $(`#kt_modal_confirm_survey_result_draft`).removeAttr('disabled','disabled');
                    toastr.success(data.status,'Selamat 🚀 !');
                },
                error: function (xhr, status, errorThrown) {
                    $(`#kt_modal_confirm_survey_result_draft`).removeAttr('disabled','disabled');
                    const data = JSON.parse(xhr.responseText);
                    toastr.error(errorThrown ,'Opps!');
                }
            });
        })
    })
</script>
@endsection