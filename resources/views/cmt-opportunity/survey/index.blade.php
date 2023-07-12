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
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6 gap-3 d-flex align-items-center">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Project / Work</span>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-7 fw-bolder badge badge-info px-3 py-2 text-white me-4 text-nowrap d-none d-lg-block">In Progress</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-6 hover-scroll-x">
                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active" data-bs-toggle="tab" id="tab_opportunity" href="#tab_opportunity_content">Oppoturnities</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="tab_survey_sent" href="#tab_survey_sent_content">Survey Requests</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" id="tab_on_progress_survey" href="#tab_on_progress_survey_content">On Progress</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="tab_prospect" href="#tab_survey_done_content">Done</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tab_opportunity_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_opportunities">
                                                    <thead>
                                                        <tr class="fw-bold fs-7 text-muted text-uppercase">
                                                            <th class="text-center w-25px">#</th>
                                                            <th class="w-25px">#</th>
                                                            <th class="">Company Name</th>
                                                            <th class="w-100px">Contact Name</th>
                                                            <th class="w-100px">Prospected By</th>
                                                            <th class="w-300px">Last Progress</th>
                                                            <th class="w-300px">Last Next Action</th>
                                                            <th class="w-50px text-center">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-7">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_survey_sent_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_survey_request">
                                                    <thead class="">
                                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                            <th class="text-center w-25px">#</th>
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="w-200px">Company Name</th>
                                                            <th class="w-200px">No Survey</th>
                                                            <th class="w-150px">Service Type</th>
                                                            <th class="w-200px">Type Of Survey</th>
                                                            <th class="w-200px">Survey Datetime</th>
                                                            <th class="w-100px">Latitude</th>
                                                            <th class="w-100px">Langitude</th>
                                                            <th class="w-100px">Closest BTS</th>
                                                            <th class="w-100px">Covered Status</th>
                                                            <th class="w-300px">Notes</th>
                                                            <th class="w-100px text-center">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-7">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_on_progress_survey_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_on_progress_survey">
                                                    <thead class="">
                                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                            <th class="text-center w-25px">#</th>
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="w-200px">No. Work Order</th>
                                                            <th class="w-200px">Task Description</th>
                                                            <th class="w-200px">Start Date</th>
                                                            <th class="w-200px">Due Date</th>
                                                            <th class="w-200px">Status</th>
                                                            <th class="w-200px">Approved Status</th>
                                                            <th class="w-100px text-center">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-7">
                                                    </tbody>
                                                </table>
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
</div>

@role('administrator')
@include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv')
@endrole

<script>
    const prospectIds = [];
    const surveyRequestIds = [];

    const surveyRequestValidationMessages = {
        no_survey: {
            required: "<span class='fw-semibold fs-8 text-danger'>Nama Perusahaan/Badan Usaha wajib diisi</span>",
        },
        service_type_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Jenis bisnis wajib dipilih</span>",
        },
        type_of_survey_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Referensi lead wajib dipilih</span>",
        },
        survey_date: {
            required: "<span class='fw-semibold fs-8 text-danger'>Alamat perusahaan/badan usaha wajib diisi</span>",
        },
        survey_time: {
            required: "<span class='fw-semibold fs-8 text-danger'>Kota perusahaan/badan usaha wajib dipilih</span>",
        },
    };

    const workOrderValidationMessages = {
        survey_request_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Kota perusahaan/badan usaha wajib dipilih</span>",
        },
        no_wo: {
            required: "<span class='fw-semibold fs-8 text-danger'>Nama Perusahaan/Badan Usaha wajib diisi</span>",
        },
        task_description: {
            required: "<span class='fw-semibold fs-8 text-danger'>Jenis bisnis wajib dipilih</span>",
        },
        start_date: {
            required: "<span class='fw-semibold fs-8 text-danger'>Referensi lead wajib dipilih</span>",
        },
        planning_due_date: {
            required: "<span class='fw-semibold fs-8 text-danger'>Alamat perusahaan/badan usaha wajib diisi</span>",
        },
    };

    const surveyResultValidationMessages = {
        survey_request_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Kota perusahaan/badan usaha wajib dipilih</span>",
        },
        work_order_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Nama Perusahaan/Badan Usaha wajib diisi</span>",
        },
        service_type_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Jenis bisnis wajib dipilih</span>",
        },
    };

    $(document).ready(function() {
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

        generateDatatable({
            tableName: "tableOpportunity",
            elementName: "#kt_table_opportunities",
            ajaxLink: "{{route('com.prospect.get-table-prospect-only-done')}}",
            columnData: [
                { data: 'DT_RowChecklist', orderable: false, searchable: false},
                { data: 'DT_RowIndex'},
                { data: 'customer.customer_name'},
                { data: 'customer.customer_contact.customer_contact_name' },
                { data: 'customer.user_follow_up.name' },
                { data: 'progress_pretified'},
                { data: 'next_action_pretified'},
                { data: 'action' },
            ]
        });

        $('body').on('click', '.btn_request_survey', function () {
            const form_edit = $('#kt_modal_request_survey_form');
            form_edit.find('#containerSelectedProspects').html('');
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_request_survey_form').trigger("reset")
            $('#kt_modal_request_survey_submit').removeAttr('disabled','disabled');

            const prospectId = $(this).data('id');
            prospectIds.push(prospectId);

            $.each(prospectIds.filter(onlyUnique), function(index, rowId) {
                form_edit.find('#containerSelectedProspects').append(
                    $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'prospect_id[]')
                    .val(rowId)
                );
            });
        });

        submitModal({
            modalName: 'kt_modal_request_survey',
            tableName: 'kt_table_opportunities',
            ajaxLink: '{{route("com.survey-request.store")}}',
            validationMessages: surveyRequestValidationMessages,
        });
    });

    $('#tab_survey_sent').click(function () {
        generateDatatable({
            tableName: "tableSurveyRequest",
            elementName: "#kt_table_survey_request",
            ajaxLink: "{{route('com.survey-request.datatable')}}",
            columnData: [
                { data: 'DT_RowChecklist', orderable: false, searchable: false},
                { data: 'DT_RowIndex'},
                { data: 'customer_prospect.customer.customer_name'},
                { data: 'no_survey' },
                { data: 'service_type.name' },
                { data: 'type_of_survey.name'},
                { data: 'survey_datetime'},
                { data: 'lat'},
                { data: 'lang'},
                { data: 'closest_bts'},
                { data: 'covered_status_pretified'},
                { data: 'notes'},
                { data: 'action' },
            ]
        });

        $('body').on('click', '.btn_create_wo_survey', function () {
            const form_edit = $('#kt_modal_create_wo_survey_form');
            form_edit.find('#containerSelectedSurveyRequests').html('');
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_create_wo_survey_form').trigger("reset")
            $('#kt_modal_create_wo_survey_submit').removeAttr('disabled','disabled');

            const surveyRequestId = $(this).data('id');
            surveyRequestIds.push(surveyRequestId);

            $.each(surveyRequestIds.filter(onlyUnique), function(index, rowId) {
                form_edit.find('#containerSelectedSurveyRequests').append(
                    $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'survey_request_id[]')
                    .val(rowId)
                );
            });
        });

        submitModal({
            modalName: 'kt_modal_create_wo_survey',
            tableName: 'kt_table_survey_request',
            ajaxLink: "{{route('com.work-order-survey.store')}}",
            validationMessages: workOrderValidationMessages,
        })
    })    

    $('#tab_on_progress_survey').click(function () {
        generateDatatable({
            tableName: "tableOnProgressSurvey",
            elementName: "#kt_table_on_progress_survey",
            ajaxLink: "{{ route('com.work-order.datatable') }}",
            columnData: [
                { data: 'DT_RowChecklist', orderable: false, searchable: false},
                { data: 'DT_RowIndex'},
                { data: 'no_wo'},
                { data: 'task_description'},
                { data: 'start_date'},
                { data: 'planning_due_date'},
                { data: 'status'},
                { data: 'approved_status'},
                { data: 'action' },
            ]
        });

        ['create_survey_result_cctv', 'create_survey_result_internet'].forEach(element => {
            $('body').on('click', `.btn_${element}`, function () {
                const form_edit = $(`#kt_modal_${element}_form`);
                form_edit.find('#containerSelectedSurveyRequests').html('');
                $('.drop-data').val("").trigger("change")
                $(`#kt_modal_${element}_form`).trigger("reset")
                $(`#kt_modal_${element}_submit`).removeAttr('disabled','disabled');

                form_edit.find('input[name="survey_request_id"]').val($(this).data('surveyid'));
                form_edit.find('input[name="work_order_id"]').val($(this).data('id'));
            });

            submitModal({
                modalName: `kt_modal_${element}`,
                tableName: 'kt_table_on_progress_survey',
                ajaxLink: "{{route('com.survey-result.store')}}",
                validationMessages: surveyResultValidationMessages,
            })
        });        
    });
</script>
@endsection