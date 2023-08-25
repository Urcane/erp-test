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
                            @if (isset($surveyResult))
                            <button type="button" class="btn btn-md btn-light me-3 print-form">
                                <i class="fa-solid fa-print fs-6"></i>Print
                            </button>
                            <button type="button" class="btn btn-md btn-info edit-form">
                                <i class="fa-solid fa-pen-to-square fs-6"></i>Edit
                            </button>
                            @endif
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
                                    <div class="real-form">
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
                                            <div class="col-lg-4">
                                                <input  type="date" @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" name="survey_date" value="{{isset($surveyResult) ? old('survey_date', $surveyResult->survey_date) : ''}}">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        @include('cmt-opportunity.survey.component.outdoor-form')
                                        <div class="separator mb-6"></div>
                                        @include('cmt-opportunity.survey.component.indoor-form')
                                        <div class="separator mb-6"></div>
                                        @include('cmt-opportunity.survey.component.other-form')
                                        <div class="row mb-3">
                                            <div class="col-lg-6 mb-8 ps-0">
                                                <div class="p-9">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                <span class="fw-bold text-dark">Tanda Tangan Pelaksana Survey</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div id="employee_sig" class="border border-gray-500 rounded"></div>
                                                            <textarea id="survey_person_sign_url" name="survey_person_sign_url" style="display: none"></textarea>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="btn btn-md btn-icon btn-danger clear-sign-emp"><i class="fa-solid fa-eraser"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-8 pe-0">
                                                <div class="p-9">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                <span class="fw-bold text-dark">Tanda Tangan Customer</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div id="customer_sig" class="border border-gray-500 rounded"></div>
                                                            @php
                                                                if (isset($surveyResult->customerSignFile)) {
                                                                    $test = file_get_contents(public_path('filestorage/' . $surveyResult->customerSignFile->path));
                                                                    $base64 = base64_encode($test);
                                                                }
                                                            @endphp
                                                            <textarea id="customer_sign_url" name="customer_sign_url" style="display: none">{{ isset($surveyResult->customerSignFile) ? 'data:image/png;base64,' . $base64 : ''}}</textarea>
                                                        </div>
                                                        @if (!isset($surveyResult->customerSignFile))
                                                            <div class="col-lg-2">
                                                                <button type="button" class="btn btn-md btn-icon btn-danger clear-sign-cust"><i class="fa-solid fa-eraser"></i></button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-fixed bottom-0 end-0 rounded-circle mx-12 my-8" id="floating-button-container">
                                            @if (!isset($surveyResult))
                                            <a href="#kt_modal_confirm_survey_result" class="btn btn-primary btn-md" data-bs-toggle="modal">
                                                <i class="fa-solid fa-save fs-3"></i>Save
                                            </a>
                                            @endif
                                        </div>
                                        @include('cmt-opportunity.survey.modal.modal-confirm-survey-result')
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
<div id="printerDiv" style="display:none"></div>
<script>
    const employee_sig = $('#employee_sig').signature({syncField: '#survey_person_sign_url', syncFormat: 'PNG', disabled: true});
    const customer_sig = $('#customer_sig').signature({syncField: '#customer_sign_url', syncFormat: 'PNG'});

    @if (isset($surveyResult->customerSignFile) || isset($surveyResult)) customer_sig.signature('disable'); @endif

    @if (isset($surveyResult->customerSignFile)) customer_sig.signature('enable').signature('draw', $('#customer_sign_url').html()).signature('disable'); @endif

    console.log($('#customer_sign_url').html());

    $('.clear-sign-emp').click(function() {
        employee_sig.signature('clear');
        $("#survey_person_sign_url").val('');
    });
    $('.clear-sign-cust').click(function() {
        customer_sig.signature('clear');
        $("#customer_sign_url").val('');
    });

    $(document).ready(function () {
        let editStatus = false;


        submitModal({
            modalName: 'kt_modal_confirm_survey_result',
            ajaxLink: "{{route('com.survey-result.store')}}",
            // validationMessages: workOrderValidationMessages,
            successCallback: function(data) {
                setTimeout(() => {
                    window.location.href = `${window.location.origin}/cmt-survey/detail/${data.data.serviceTypeId}/${data.data.surveyResultId}`;
                }, 800);
            }
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

        $('.edit-form').click(function (e) {
            e.preventDefault();

            editStatus = !editStatus;

            if (editStatus) {
                $('.real-form input').removeAttr('disabled');
                $('.real-form textarea').removeAttr('disabled');

                $(this).html(`
                    <i class="fa-solid fa-x fs-6"></i>Cancel
                `).removeClass('btn-info').addClass('btn-danger').attr('disabled', 'disabled');

                setTimeout(function() {
                    $('.edit-form').removeAttr('disabled');
                }, 800);

                $('#floating-button-container').html(`
                    <a href="#kt_modal_confirm_survey_result" class="btn btn-primary btn-md" data-bs-toggle="modal">
                        <i class="fa-solid fa-save fs-3"></i>
                    </a>
                `);

                customer_sig.signature('enable');
            } else {
                $('.real-form input').attr('disabled', 'disabled');
                $('.real-form textarea').attr('disabled', 'disabled');

                $(this).html(`
                    <i class="fa-solid fa-pen-to-square fs-6"></i>Edit
                `).removeClass('btn-danger').addClass('btn-info').attr('disabled', 'disabled');

                setTimeout(function() {
                    $('.edit-form').removeAttr('disabled');
                }, 800);

                $('#floating-button-container').html(``);

                customer_sig.signature('disable');
            }
        })

        @if (isset($surveyResult))
        $('.print-form').click(function () {
            const div = document.getElementById("printerDiv");
            div.innerHTML = `<iframe src="{{route('com.survey-result.export',['serviceType'=>$surveyRequest->service_type_id ,'id' => $surveyResult->id])}}" onload="this.contentWindow.print();"></iframe>`;
        })
        @endif
    })
</script>
@endsection