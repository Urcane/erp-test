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
                                    <input type="hidden" name="id" value="{{isset($surveyResult) ? $surveyResult->id : ''}}">
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
                                                <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" disabled="disabled" class="form-control form-control-solid" minlength="8" name="kontak" value="{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_phone}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Natural Frequency : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($gbNaturalFrequencies as $gbNaturalFrequency)
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->gb_natural_frequency_id == $gbNaturalFrequency->id) checked="checked" @endif @endif 
                                                        type="radio" class="form-check-input" placeholder="" name="gb_natural_frequency_id" value="{{$gbNaturalFrequency->id}}">
                                                        <label class="fs-6 form-check-label" for="gb_natural_frequency_id">
                                                            <span class="fw-bold">{{$gbNaturalFrequency->name}}</span>
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
                                                <span class="fw-bold my-auto">Natural Signal RSRP : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-solid" placeholder="" name="natural_signal_rsrp" value="{{isset($surveyResult) ? old('natural_signal_rsrp', $surveyResult->natural_signal_rsrp) : ''}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Natural Signal RSRQ : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-solid" placeholder="" name="natural_signal_rsrq" value="{{isset($surveyResult) ? old('natural_signal_rsrq', $surveyResult->natural_signal_rsrq) : ''}}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Repeater : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($gbRepeaterTypes as $gbRepeaterType)
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->gb_repeater_type_id == $gbRepeaterType->id) checked="checked" @endif @endif 
                                                        type="radio" class="form-check-input" placeholder="" name="gb_repeater_type_id" value="{{$gbRepeaterType->id}}">
                                                        <label class="fs-6 form-check-label" for="gb_repeater_type_id">
                                                            <span class="fw-bold">{{$gbRepeaterType->name}}</span>
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
                                                <span class="fw-bold my-auto">Anthena Donor : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_donor_type == "PERIODIK") checked="checked" @endif @endif 
                                                    type="radio" class="form-check-input" placeholder="" name="anthena_donor_type" value="PERIODIK">
                                                    <label class="fs-6 form-check-label" for="anthena_donor_type">
                                                        <span class="fw-bold">Periodik</span>
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_donor_type == "GRID") checked="checked" @endif @endif 
                                                    type="radio" class="form-check-input" placeholder="" name="anthena_donor_type" value="GRID">
                                                    <label class="fs-6 form-check-label" for="anthena_donor_type">
                                                        <span class="fw-bold">Grid</span>
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_donor_type == "OMNI") checked="checked" @endif @endif 
                                                    type="radio" class="form-check-input" placeholder="" name="anthena_donor_type" value="OMNI">
                                                    <label class="fs-6 form-check-label" for="anthena_donor_type">
                                                        <span class="fw-bold">OMNI</span>
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Anthena Service : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_service == "OMNI") checked="checked" @endif @endif 
                                                    type="radio" class="form-check-input" placeholder="" name="anthena_service" value="OMNI">
                                                    <label class="fs-6 form-check-label" for="anthena_service">
                                                        <span class="fw-bold">OMNI</span>
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_service == "SECTORAL") checked="checked" @endif @endif 
                                                    type="radio" class="form-check-input" placeholder="" name="anthena_service" value="SECTORAL">
                                                    <label class="fs-6 form-check-label" for="anthena_service">
                                                        <span class="fw-bold">Sectoral</span>
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->anthena_service == "PLANNER") checked="checked" @endif @endif 
                                                    type="radio" class="form-check-input" placeholder="" name="anthena_service" value="PLANNER">
                                                    <label class="fs-6 form-check-label" for="anthena_service">
                                                        <span class="fw-bold">Planner</span>
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <label class="d-flex align-items-center fs-6 form-label h-100">
                                                <span class="fw-bold my-auto">Konektivitas Data : </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row mt-3 h-min-50px">
                                                @foreach ($gbConnectivityDatas as $gbConnectivityData)
                                                <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                    <div class="my-auto">
                                                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->gb_connectivity_data_id == $gbConnectivityData->id) checked="checked" @endif @endif 
                                                        type="radio" class="form-check-input" placeholder="" name="gb_connectivity_data_id" value="{{$gbConnectivityData->id}}">
                                                        <label class="fs-6 form-check-label" for="gb_connectivity_data_id">
                                                            <span class="fw-bold">{{$gbConnectivityData->name}}</span>
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