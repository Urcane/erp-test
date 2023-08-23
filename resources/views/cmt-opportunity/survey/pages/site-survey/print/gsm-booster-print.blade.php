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
                    <span class="fw-bold my-auto">Natural Frequency </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($gbNaturalFrequencies as $gbNaturalFrequency)
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->gb_natural_frequency_id == $gbNaturalFrequency->id) checked="checked" @endif @endif 
                            type="radio" class="my-auto" placeholder="" name="gb_natural_frequency_id" value="{{$gbNaturalFrequency->id}}">
                            <label class="fs-9 form-check-label" for="gb_natural_frequency_id">
                                <span class="fw-bold">{{$gbNaturalFrequency->name}}</span>
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
                    <span class="fw-bold my-auto">Natural Signal RSRP </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-transparent fs-9" placeholder="" name="natural_signal_rsrp" value="{{isset($surveyResult) ? old('natural_signal_rsrp', $surveyResult->natural_signal_rsrp) : ''}}">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Natural Signal RSRQ </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-transparent fs-9" placeholder="" name="natural_signal_rsrq" value="{{isset($surveyResult) ? old('natural_signal_rsrq', $surveyResult->natural_signal_rsrq) : ''}}">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Repeater </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($gbRepeaterTypes as $gbRepeaterType)
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->gb_repeater_type_id == $gbRepeaterType->id) checked="checked" @endif @endif 
                            type="radio" class="my-auto" placeholder="" name="gb_repeater_type_id" value="{{$gbRepeaterType->id}}">
                            <label class="fs-9 form-check-label" for="gb_repeater_type_id">
                                <span class="fw-bold">{{$gbRepeaterType->name}}</span>
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
                    <span class="fw-bold my-auto">Anthena Donor </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_donor_type == "PERIODIK") checked="checked" @endif @endif 
                        type="radio" class="my-auto" placeholder="" name="anthena_donor_type" value="PERIODIK">
                        <label class="fs-9 form-check-label" for="anthena_donor_type">
                            <span class="fw-bold">Periodik</span>
                        </label>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_donor_type == "GRID") checked="checked" @endif @endif 
                        type="radio" class="my-auto" placeholder="" name="anthena_donor_type" value="GRID">
                        <label class="fs-9 form-check-label" for="anthena_donor_type">
                            <span class="fw-bold">Grid</span>
                        </label>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_donor_type == "OMNI") checked="checked" @endif @endif 
                        type="radio" class="my-auto" placeholder="" name="anthena_donor_type" value="OMNI">
                        <label class="fs-9 form-check-label" for="anthena_donor_type">
                            <span class="fw-bold">OMNI</span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Anthena Service </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_service == "OMNI") checked="checked" @endif @endif 
                        type="radio" class="my-auto" placeholder="" name="anthena_service" value="OMNI">
                        <label class="fs-9 form-check-label" for="anthena_service">
                            <span class="fw-bold">OMNI</span>
                        </label>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_service == "SECTORAL") checked="checked" @endif @endif 
                        type="radio" class="my-auto" placeholder="" name="anthena_service" value="SECTORAL">
                        <label class="fs-9 form-check-label" for="anthena_service">
                            <span class="fw-bold">Sectoral</span>
                        </label>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_service == "PLANNER") checked="checked" @endif @endif 
                        type="radio" class="my-auto" placeholder="" name="anthena_service" value="PLANNER">
                        <label class="fs-9 form-check-label" for="anthena_service">
                            <span class="fw-bold">Planner</span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 border border-solid">
                <label class="d-flex align-items-center fs-9 form-label h-100">
                    <span class="fw-bold my-auto">Konektivitas Data </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <div class="row mt-3 h-min-50px">
                    @foreach ($gbConnectivityDatas as $gbConnectivityData)
                    <div class="col-2 d-flex align-items-center">
                        <div class="my-auto">
                            <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->gb_connectivity_data_id == $gbConnectivityData->id) checked="checked" @endif @endif 
                            type="radio" class="my-auto" placeholder="" name="gb_connectivity_data_id" value="{{$gbConnectivityData->id}}">
                            <label class="fs-9 form-check-label" for="gb_connectivity_data_id">
                                <span class="fw-bold">{{$gbConnectivityData->name}}</span>
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
                    <span class="fw-bold my-auto">Tanggal Survey </span>
                </label>
            </div>
            <div class="col-10 border border-solid">
                <input @if (isset($surveyResult)) disabled="disabled" type="date" @endif class="form-control form-control-transparent fs-9" name="survey_date" value="{{isset($surveyResult) ? old('survey_date', $surveyResult->survey_date) : ''}}">
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
