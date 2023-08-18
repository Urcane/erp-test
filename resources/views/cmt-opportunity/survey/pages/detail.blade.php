@extends('layouts.app')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Survey, Survey, Survey Luar biasa!')
@section('icon-apps','fa-solid fa-briefcase')

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
<div class="row justify-content-center">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">🌟⭐✨</h3>
                        <div class="card-toolbar p-3">
                            @php                            
                                if ($query->service_type_id == 1) {
                                    $additionalMenu = "<a href=\"#kt_modal_create_survey_result_internet\" class=\"btn btn-md btn-primary w-lg-150px btn_create_survey_result_internet\" data-bs-toggle=\"modal\"><i class=\"fa-solid fa-edit\"></i>Edit</a>";
                                }

                                if ($query->service_type_id == 2) {
                                    $additionalMenu = "<a href=\"#kt_modal_create_survey_result_cctv\" class=\"btn btn-md btn-primary w-lg-150px btn_create_survey_result_cctv\" data-bs-toggle=\"modal\"><i class=\"fa-solid fa-edit\"></i>Edit</a>";
                                }
                            @endphp
                            {!!$additionalMenu ?? ""!!}
                            {{-- <a href="./#" class="btn btn-md btn-primary w-lg-150px">
                                <i class="fa-solid fa-edit"></i>{{$additionalMenu}}
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-12 gap-3 d-flex align-items-center">
                                <div class="d-flex align-items-center gap-2 mb-8 mb-md-0 w-100">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="fs-5 text-uppercase fw-bolder text-dark d-none d-md-block w-100 align-items-center text-center">Hasil Survey: <span>blablalba</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 p-9 mb-8 border border-gray-300 rounded">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                                    <img class="mw-50px mw-lg-75px" src="{{asset('sense')}}/media/logos/logo-comtel.png" alt="image">
                                                </div>
                                            </div>
                                            <div class="row col-lg-10">
                                                <div class="col-lg-12 mb-5">
                                                    <p class="text-dark fs-3 fw-bold mb-1">Company Name</p>
                                                    <p class="text-gray-600 fs-5">{{$query->surveyRequest->customerProspect->customer->customer_name}}</p>
                                                </div>
                                                <div class="row col-lg-6">
                                                    <div class="col-lg-12">
                                                        <p class="text-dark">Company Contact</p>
                                                        <p class="text-gray-600">{{$query->surveyRequest->customerProspect->customer->customerContact->customer_contact_name}}</p>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <p class="text-dark">Survey Datetime</p>
                                                        <p class="text-gray-600">{{$query->workOrder->start_date}} s/d {{$query->workOrder->planning_due_date}}</p>
                                                    </div>
                                                </div>
                                                <div class="row col-lg-6">
                                                    <div class="col-lg-12">
                                                        <p class="text-dark">No. WO / No. Survey</p>
                                                        <p class="text-gray-600">{{$query->workOrder->no_wo}} - {{$query->surveyRequest->no_survey}}</p>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <p class="text-dark">Task Description</p>
                                                        <p class="text-gray-600">{{$query->workOrder->task_description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-9 mb-8 border border-gray-300 rounded">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-10">
                                            <p class="text-uppercase fs-5 fw-bold text-dark">A. Informasi Lokasi</p>
                                            <div class="mx-8 fs-6">
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Nama Perusahaan</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->surveyRequest->customerProspect->customer->customer_name}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Contact Person</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->surveyRequest->customerProspect->customer->customerContact->customer_contact_name}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Jabatan</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->surveyRequest->customerProspect->customer->customerContact->customer_contact_job}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">No. Telpon</div>
                                                    <div class="col-lg-7 text-gray-800">: +62{{$query->surveyRequest->customerProspect->customer->customerContact->customer_contact_phone}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Lokasi/Wilayah</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->surveyRequest->customerProspect->customer->city->city_name}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Titik Koordinat</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->surveyRequest->lat}}, {{$query->surveyRequest->lang}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Jaringan Existing</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->existing_connection}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Media Transmisi Jaringan</div>
                                                    <div class="col-lg-7 text-gray-800">: </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <p class="text-uppercase fs-5 fw-bold text-dark">B. Informasi Pengguna</p>
                                            @if ($query->service_type_id == 1 && $query->siteSurveyInternet !== null) 
                                            <div class="mx-8 fs-6">
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Potensi Jumlah Pengguna</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyInternet->quantity_service_use}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Kebutuhan Pengguna</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyInternet->user_needs}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Kebutuhan Bandwith</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyInternet->bandwith_needs}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Special Request</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyInternet->special_request}}</div>
                                                </div>
                                            </div>
                                            @elseif ($query->service_type_id == 2 && $query->siteSurveyCCTV !== null)
                                            <div class="mx-8 fs-6">
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Jenis Kamera</div>
                                                    <div class="col-lg-7 text-gray-800">: </div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Potensi Jumlah CCTV</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyCCTV->quantity_service_use}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Durasi Rekaman</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyCCTV->record_duration}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Besar Penyimpanan Kamera</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyCCTV->camera_storage}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Resolusi Kamera</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyCCTV->camera_resolution}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Special Request</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->siteSurveyCCTV->special_request}}</div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-10">
                                            <div class="mx-8 fs-6">
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Akses Transportasi</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->transportation_access}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Jenis Layanan</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->SiteSurveyServiceType->name}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Jenis Bangunan</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->building_type}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Tinggi Bangunan</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->building_height}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Rooftop</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->building_rooftop_state ? 'Ada' : 'Tidak Ada'}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Listrik</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->building_electricity_state ? 'Ada' : 'Tidak Ada'}}</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Durasi Listrik (per Hari)</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->building_electricity_time}} Jam per Hari</div>
                                                </div>
                                                <div class="row my-6">
                                                    <div class="col-lg-5 text-dark">Tipe Listrik</div>
                                                    <div class="col-lg-7 text-gray-800">: {{$query->building_electricity_type}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-8 ps-0 ">
                                <div class="border border-gray-300 rounded h-100">
                                    @include('cmt-promag.component.overview.summary-file')
                                </div>
                            </div>
                            <div class="col-lg-4 mb-8 pe-0">
                                <div class="border border-gray-300 rounded h-100">
                                    @include('cmt-promag.component.overview.task-recent')
                                </div>
                            </div>
                            <div class="col-lg-6 mb-8 ps-0">
                                <div class="p-9 border border-gray-300 rounded">
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
                                <div class="p-9 border border-gray-300 rounded">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold text-dark">Tanda Tangan Customer</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div id="customer_sig" class="border border-gray-500 rounded"></div>
                                            <textarea id="customer_sign_url" name="customer_sign_url" style="display: none"></textarea>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-md btn-icon btn-danger clear-sign-cust"><i class="fa-solid fa-eraser"></i></button>
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
</div>

@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet', array('unfileable' => true))
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv', array('unfileable' => true))

<script>
    const employee_sig = $('#employee_sig').signature({syncField: '#survey_person_sign_url', syncFormat: 'PNG'});
    const customer_sig = $('#customer_sig').signature({syncField: '#customer_sign_url', syncFormat: 'PNG'});
    $('.clear-sign-emp').click(function() {
        employee_sig.signature('clear');
        $("#survey_person_sign_url").val('');
    });
    $('.clear-sign-cust').click(function() {
        customer_sig.signature('clear');
        $("#customer_sign_url").val('');
    });

    const surveyResultValidationMessages = {
        survey_request_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Survey Result has Broken Link, Please Refresh (unable to find survey request)</span>",
        },
        work_order_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Survey Result has Broken Link, Please Refresh (unfind work order)</span>",
        },
        service_type_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
    };

    $(document).ready(function () {
        const surveyResult = {!!json_encode($query)!!};
        const surveyResultInternetElement = document.querySelector(".kt_stepper_survey_result_internet");
        const surveyResultCctvElement = document.querySelector(".kt_stepper_survey_result_cctv");

        const surveyResultInternetStepper = new KTStepper(surveyResultInternetElement);
        const surveyResultCctvStepper = new KTStepper(surveyResultCctvElement);

        surveyResultInternetStepper.on("kt.stepper.next", function (stepper) {
            const state = $('#kt_modal_create_survey_result_internet_form').valid();
            // if (state) {
                stepper.goNext(); 
            // }
        });
        surveyResultCctvStepper.on("kt.stepper.next", function (stepper) {
            const state = $('#kt_modal_create_survey_result_cctv_form').valid();
            // if (state) {
                stepper.goNext(); 
            // }
        });
        surveyResultInternetStepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious(); 
        });
        surveyResultCctvStepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious(); 
        });

        ['create_survey_result_cctv', 'create_survey_result_internet'].forEach(element => {
            const form_edit = $(`#kt_modal_${element}_form`);
            form_edit.find('#containerSelectedSurveyRequests').html('');
            // $('.drop-data').val("").trigger("change")
            $(`#kt_modal_${element}_form`).trigger("reset")
            $(`#kt_modal_${element}_submit`).removeAttr('disabled','disabled');

            form_edit.find('input[name="survey_request_id"]').val(surveyResult.survey_request.id);
            form_edit.find('input[name="work_order_id"]').val(surveyResult.work_order.id);
            form_edit.find('input[name="site_survey_id"]').val(surveyResult.id);
            
            form_edit.find('select[name="trans_media_id"]').val(surveyResult.trans_media_id).trigger('change');
            form_edit.find('select[name="internet_service_type_id"]').val(surveyResult.internet_service_type_id).trigger('change');
            form_edit.find('input[name="existing_connection"]').val(surveyResult.existing_connection);
            form_edit.find('input[name="transportation_access"]').val(surveyResult.transportation_access);
            form_edit.find('input[name="building_type"]').val(surveyResult.building_type);
            form_edit.find('input[name="building_height"]').val(surveyResult.building_height);
            form_edit.find('input[name="building_floor_count"]').val(surveyResult.building_floor_count);
            if (!!surveyResult.building_rooftop_state) {
                form_edit.find('input[name="building_rooftop_state"]').click();
            }
            if (!!surveyResult.building_electricity_state) {
                form_edit.find('input[name="building_electricity_state"]').click();
            }
            form_edit.find('input[name="building_electricity_time"]').val(surveyResult.building_electricity_time);
            form_edit.find('select[name="building_electricity_type"]').val(surveyResult.building_electricity_type).trigger('change');

            // Edit Internet
            if (surveyResult.site_survey_internet !== null) {
                form_edit.find('input[name="site_survey_internet_id"]').val(surveyResult.site_survey_internet.id);
                form_edit.find('input[name="user_needs"]').val(surveyResult.site_survey_internet.user_needs);
                form_edit.find('input[name="quantity_service_use"]').val(surveyResult.site_survey_internet.quantity_service_use);
                form_edit.find('input[name="bandwith_needs"]').val(surveyResult.site_survey_internet.bandwith_needs);
                form_edit.find('input[name="special_request"]').val(surveyResult.site_survey_internet.special_request);
            }
            
            // Edit CCTV
            if (surveyResult.site_survey_c_c_t_v !== null) {
                form_edit.find('input[name="site_survey_cctv_id"]').val(surveyResult.site_survey_c_c_t_v.id);
                form_edit.find('select[name="camera_type_id"]').val(surveyResult.site_survey_c_c_t_v.camera_type_id).trigger('change');
                form_edit.find('input[name="quantity_service_use"]').val(surveyResult.site_survey_c_c_t_v.quantity_service_use);
                form_edit.find('input[name="record_duration"]').val(surveyResult.site_survey_c_c_t_v.record_duration);
                form_edit.find('input[name="camera_storage"]').val(surveyResult.site_survey_c_c_t_v.camera_storage);
                form_edit.find('input[name="camera_resolution"]').val(surveyResult.site_survey_c_c_t_v.camera_resolution);
                form_edit.find('input[name="special_request"]').val(surveyResult.site_survey_c_c_t_v.special_request);
            }
            
            submitModal({
                modalName: `kt_modal_${element}`,
                tableName: 'kt_table_on_progress_survey',
                anotherTableName: 'tableDoneSurvey',
                ajaxLink: "{{route('com.survey-result.store')}}",
                validationMessages: surveyResultValidationMessages,
            })
        }); 
    })
</script>
@endsection