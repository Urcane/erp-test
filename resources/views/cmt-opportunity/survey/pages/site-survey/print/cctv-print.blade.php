@extends('layouts.print')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Survey, Survey, Survey Luar biasa!')
@section('icon-apps','fa-solid fa-briefcase')
@section('print-title', 'Hasil Survey Internet')

@section('content')
<div class="row my-4 align-items-center">
    <div class="col-12 gap-3 d-flex align-items-center">
        <div class="d-flex align-items-center gap-2 mt-4 mb-md-0 w-100">
            <div class="align-items-center w-100">
                <h3 class="fs-9 text-uppercase m-auto fw-bolder text-dark d-md-block w-100 align-items-center text-center"><span>{{ $surveyRequest->no_survey }}</span></h3>
                <h4 class="fs-8 m-auto text-dark d-md-block w-100 align-items-center text-center">No. Work Order: {{ $workOrder->no_wo }}</h4>
            </div>
        </div>
    </div>
</div>
<div id="kt_modal_confirm_survey_result_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
    <div class="row">
        <div class="border border-solid col-2">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Nama Perusahaan</span>
            </label>
        </div>
        <div class="border border-solid col-10">
            <input type="text" disabled="disabled" class="form-control form-control-transparent h-30px fs-9" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customer_name}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="border border-solid col-2">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Alamat</span>
            </label>
        </div>
        <div class="border border-solid col-10">
            <input type="text" disabled="disabled" class="form-control form-control-transparent h-30px fs-9" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customer_address}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="border border-solid col-2">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Kontak Person</span>
            </label>
        </div>
        <div class="border border-solid col-10">
            <input type="text" disabled="disabled" class="form-control form-control-transparent h-30px fs-9" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_name}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="border border-solid col-2">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Kontak Point</span>
            </label>
        </div>
        <div class="border border-solid col-10">
            <div class="input-group">
                <input type="text" disabled="disabled" class="form-control form-control-transparent h-30px fs-9" minlength="8" name="kontak" value="+62{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_phone}}"/>
            </div>
        </div>
    </div>
    <div class="real-form">
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Jenis Layanan : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($siteSurveyServiceTypes as $siteSurveyServiceType)                                                
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->site_survey_service_type_id == $siteSurveyServiceType->id) checked="checked" @endif @endif 
                                type="radio" class="my-auto" placeholder="" name="site_survey_service_type_id" value="{{$siteSurveyServiceType->id}}">
                            <label class="fs-9 form-check-label" for="site_survey_service_type_id">
                                <span class="fw-bold">{{$siteSurveyServiceType->name}}</span>
                            </label>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Quantity : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-transparent fs-9" placeholder="" name="quantity" value="{{isset($surveyResult) ? old('quantity', $surveyResult->quantity) : ''}}">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Lokal Akses : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <input @if (isset($surveyResult)) disabled="disabled" @endif type="text" class="form-control form-control-transparent fs-9" placeholder="" name="local_access" value="{{isset($surveyResult) ? old('local_acceses', $surveyResult->local_acceses) : ''}}">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Durasi Record : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($cctvRecordDurations as $cctvRecordDuration)
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->cctv_record_duration_id == $cctvRecordDuration->id) checked="checked" @endif @endif 
                            type="radio" class=" placeholder="" name="cctv_record_duration_id" value="{{$cctvRecordDuration->id}}">
                            <label class="fs-9 form-check-label" for="cctv_record_duration_id">
                                <span class="fw-bold">{{$cctvRecordDuration->name}}</span>
                            </label>
                            {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Kapasitas Penyimpanan : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($cctvStorageCapacities as $cctvStorageCapacity)
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->cctv_storage_capacity_id == $cctvStorageCapacity->id) checked="checked" @endif @endif 
                            type="radio" class=" placeholder="" name="cctv_storage_capacity_id" value="{{$cctvStorageCapacity->id}}">
                            <label class="fs-9 form-check-label" for="cctv_storage_capacity_id">
                                <span class="fw-bold">{{$cctvStorageCapacity->name}}</span>
                            </label>
                            {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Interface : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($siteSurveyInterfaces as $siteSurveyInterface)
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->site_survey_interface_id == $siteSurveyInterface->id) checked="checked" @endif @endif 
                                type="radio" class=" placeholder="" name="site_survey_interface_id" 
                                value="{{$siteSurveyInterface->id}}">
                            <label class="fs-9 form-check-label" for="site_survey_interface_id">
                                <span class="fw-bold">{{$siteSurveyInterface->name}}</span>
                            </label>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Tanggal Survey : </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <input @if (isset($surveyResult)) disabled="disabled" @endif type="date" class="form-control form-control-transparent fs-9" name="survey_date" value="{{isset($surveyResult) ? old('survey_date', $surveyResult->survey_date) : ''}}">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <div class="separator mb-6"></div>
        @include('cmt-opportunity.survey.component.print.outdoor-print')
        <div class="separator mb-6"></div>
        @include('cmt-opportunity.survey.component.print.indoor-print')
        <div class="separator mb-6"></div>
        @include('cmt-opportunity.survey.component.print.other-print')
        <div class="row">
            <div class="border border-solid col-6 mb-8 ps-0">
                <div class="p-4">
                    <div class="row">
                        <div class="col-12">
                            <label class="d-flex align-items-center fs-9 form-label mb-2">
                                <span class="fw-bold text-dark mx-auto">Tanda Tangan Pelaksana Survey</span>
                            </label>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center fs-9">
                                <img src="{{asset('filestorage' . '/' . $surveyResult->customerSignFile->path)}}" height="100" alt="customer-sign" class="mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-solid col-6 mb-8 ps-0">
                <div class="p-4">
                    <div class="row">
                        <div class="col-12">
                            <label class="d-flex align-items-center fs-9 form-label mb-2">
                                <span class="fw-bold text-dark mx-auto">Tanda Tangan Pelaksana Survey</span>
                            </label>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center fs-9">
                                <img src="{{asset('filestorage' . '/' . $surveyResult->customerSignFile->path)}}" height="100" alt="customer-sign" class="mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.real-form input').removeAttr('disabled');
    $('.real-form textarea').removeAttr('disabled');
</script>
@endsection
