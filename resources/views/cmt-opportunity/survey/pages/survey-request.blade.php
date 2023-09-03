@extends('cmt-opportunity.survey.index')

@section('survey-content')
@php
    $selected_side_bar_content = 'main'
@endphp

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
                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="tab_done_survey" href="#tab_done_survey_content">Done</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" id="tab_on_progress" href="#tab_on_progress_content">On Progress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="tab_survey_done" href="#tab_survey_done_content">Done</a>
                    </li> --}}
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
                        <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_survey_request_progress">
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
                                    {{-- <th class="w-100px text-center">#</th> --}}
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_done_survey_content" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_survey_request_done">
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
                                    {{-- <th class="w-100px text-center">#</th> --}}
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="tab_on_progress_content" role="tabpanel">
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
            <div class="tab-pane fade" id="tab_survey_done_content" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_survey_done">
                            <thead class="">
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th class="text-center w-25px">#</th>
                                    <th class="text-center w-50px">#</th>
                                    <th class="">Task Name</th>
                                    <th class="w-200px">No. Survey Request</th>
                                    <th class="w-200px">No. Work Order</th>
                                    <th class="w-100px">Service Type</th>
                                    <th class="w-100px">Building Type</th>
                                    <th class="w-100px">Building Height</th>
                                    <th class="w-100px text-center">#</th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@role('administrator')
@include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.modal-create-soft-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv')
@endrole

<script>
    let prospectIds = [];
    let surveyRequestIds = [];

    const surveyRequestValidationMessages = {
        no_survey: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        service_type_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        type_of_survey_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        survey_date: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        survey_time: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
    };

    const workOrderValidationMessages = {
        survey_request_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Work Order has Broken Link, Please Refresh (unable to find survey request)</span>",
        },
        no_wo: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        task_description: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        start_date: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
        planning_due_date: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
    };

    const softSurveyValidationMessages = {
        survey_request_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Work Order has Broken Link, Please Refresh (unable to find survey request)</span>",
        },
    };

    const surveyResultValidationMessages = {
        survey_request_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Survey Result has Broken Link, Please Refresh (unable to find survey request)</span>",
        },
        work_order_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Survey Result has Broken Link, Please Refresh (unable to find work order)</span>",
        },
        service_type_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>This Field is required</span>",
        },
    };

    $(document).ready(function() {
        const surveyResultInternetElement = document.querySelector(".kt_stepper_survey_result_internet");
        const surveyResultCctvElement = document.querySelector(".kt_stepper_survey_result_cctv");

        const surveyResultInternetStepper = new KTStepper(surveyResultInternetElement);
        const surveyResultCctvStepper = new KTStepper(surveyResultCctvElement);

        surveyResultInternetStepper.on("kt.stepper.next", function (stepper) {
            const state = $('#kt_modal_create_survey_result_internet_form').valid();
            if (state) {
                stepper.goNext(); 
            }
        });
        surveyResultCctvStepper.on("kt.stepper.next", function (stepper) {
            const state = $('#kt_modal_create_survey_result_cctv_form').valid();
            if (state) {
                stepper.goNext(); 
            }
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
            filters: {
                calledFrom: 'SURVEY'
            },
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

            prospectIds = [];
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
            anotherTableName: 'tableSurveyRequest',
            ajaxLink: '{{route("com.survey-request.store")}}',
            validationMessages: surveyRequestValidationMessages,
        });
    });

    $('#tab_survey_sent').click(function () {
        generateDatatable({
            tableName: "tableSurveyRequest",
            elementName: "#kt_table_survey_request",
            ajaxLink: "{{route('com.survey-request.datatable')}}",
            filters: {
                'status': 'ST'
            },
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
            ],
            functionCallback: () => {
                $('body').on('click', '.btn_edit_request_survey', function () {
                    $('.drop-data').val("").trigger("change")
                    $('#kt_modal_request_survey_form').trigger("reset")
                    $('#kt_modal_request_survey_submit').removeAttr('disabled','disabled');

                    const id = $(this).data('id');
                    const form_edit = $('#kt_modal_request_survey_form');
                    form_edit.find('#containerSelectedProspects').html('');
                    prospectIds = [];
                    const surveyRequestId = $(this).data('id');

                    $.get(`{{url('')}}/cmt-survey/survey-request/detail/${id}`, function (data) {
                        form_edit.find('input[name="survey_request_id"]').val(surveyRequestId);
                        form_edit.find('input[name="no_survey"]').val(data.no_survey);
                        form_edit.find('select[name="type_of_survey_id"]').val(data.type_of_survey_id).trigger('change');
                        form_edit.find('select[name="service_type_id"]').val(data.service_type_id).trigger('change');
                        form_edit.find('input[name="survey_date"]').val(getFormattedDate(new Date(data.survey_datetime))[0]);
                        form_edit.find('input[name="survey_time"]').val(getFormattedDate(new Date(data.survey_datetime))[1]);
                        form_edit.find('input[name="lat"]').val(data.lat);
                        form_edit.find('input[name="lang"]').val(data.lang);
                        form_edit.find('input[name="closest_bts"]').val(data.closest_bts);
                        form_edit.find('textarea[name="notes"]').val(data.notes);

                        prospectIds.push(data.customer_prospect_id);
                        $.each(prospectIds.filter(onlyUnique), function(index, rowId) {
                            form_edit.find('#containerSelectedProspects').append(
                                $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'prospect_id[]')
                                .val(rowId)
                            );
                        });
                    })
                });
            }
        });

        $('body').on('click', '.btn_create_wo_survey', function () {
            const form_edit = $('#kt_modal_create_wo_survey_form');
            form_edit.find('#containerSelectedSurveyRequests').html('');
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_create_wo_survey_form').trigger("reset")
            $('#kt_modal_create_wo_survey_submit').removeAttr('disabled','disabled');

            surveyRequestIds = [];
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

        $('body').on('click', '.btn_create_soft_survey', function () {
            let random_string = generateRandomString(4);

            const form_edit = $('#kt_modal_create_soft_survey_form');
            form_edit.find('#containerSelectedSurveyRequests').html('');
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_create_soft_survey_form').trigger("reset")
            $('#kt_modal_create_soft_survey_submit').removeAttr('disabled','disabled');

            surveyRequestIds = [];
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

            $(`.file-soft-survey-item-initial`).change(function(){
                imageReadURL(this);
            });

            form_edit.on('click', '.btn_add_more_soft_survey_item', function () {
                form_edit.find('#containerSoftSurveyItems').append(
                    `
                    <div class="row soft-survey-item">
                        <div class="col-lg-12 mb-3">
                            <div class="separator my-3 text-center text-gray-800">Soft Survey Item</div>
                        </div>
                        <div class="col-lg-10 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Lampiran</span>
                            </label>
                            <input type="file" class="form-control form-control-solid file-soft-survey-item-${random_string}" placeholder="" required accept="image/*" name="content[][file_soft_survey_internet]">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            <img id="containerImage" class="img-fluid m-5" src="#" alt="File Image" hidden="hidden"/>
                        </div>
                        <div class="col-lg-2 my-9">
                            <button type="button" class="btn btn-sm btn-icon btn-danger clear-soft-survey-item-${random_string}"><i class="fa-solid fa-eraser"></i></button>
                        </div>
                        <div class="col-lg-10 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Deskripsi Pekerjaan</span>
                            </label>
                            <textarea class="form-control form-control-solid h-100px" placeholder="Fill Notes" name="content[][description]"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    `
                )

                $(`.file-soft-survey-item-${random_string}`).change(function(){
                    imageReadURL(this);
                });

                $(`.clear-soft-survey-item-${random_string}`).click(function () {
                    $(this).parent().parent().remove();
                    console.log(random_string)
                    random_string = generateRandomString(4);

                    $('#countable_soft_survey_items').html($('.soft-survey-item').length + 1);
                })

                $('#countable_soft_survey_items').html($('.soft-survey-item').length + 1);
                random_string = generateRandomString(4);
            })
        });

        submitModal({
            modalName: 'kt_modal_create_wo_survey',
            tableName: 'kt_table_survey_request',
            anotherTableName: 'tableOnProgressSurvey',
            ajaxLink: "{{route('com.work-order-survey.store')}}",
            validationMessages: workOrderValidationMessages,
        })

        submitModal({
            modalName: 'kt_modal_create_soft_survey',
            tableName: 'kt_table_survey_request',
            anotherTableName: 'tableOnProgressSurvey',
            ajaxLink: "{{route('com.soft-survey.store')}}",
            validationMessages: softSurveyValidationMessages,
        })
    })   
    
    $('#tab_on_progress_survey').click( function() {
        generateDatatable({
            tableName: "tableSurveyRequest",
            elementName: "#kt_table_survey_request_progress",
            ajaxLink: "{{route('com.survey-request.datatable')}}",
            filters: {
                'status': 'PR'
            },
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
            ],
        });
    });

    $('#tab_done_survey').click( function() {
        generateDatatable({
            tableName: "tableSurveyRequest",
            elementName: "#kt_table_survey_request_done",
            ajaxLink: "{{route('com.survey-request.datatable')}}",
            filters: {
                'status': 'DN'
            },
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
            ],
        });
    });

    // $('#tab_on_progress').click(function () {
    //     generateDatatable({
    //         tableName: "tableOnProgressSurvey",
    //         elementName: "#kt_table_on_progress_survey",
    //         ajaxLink: "{{ route('com.work-order.datatable') }}",
    //         columnData: [
    //             { data: 'DT_RowChecklist', orderable: false, searchable: false},
    //             { data: 'DT_RowIndex'},
    //             { data: 'no_wo'},
    //             { data: 'task_description'},
    //             { data: 'start_date'},
    //             { data: 'planning_due_date'},
    //             { data: 'status'},
    //             { data: 'approved_status'},
    //             { data: 'action' },
    //         ],
    //         functionCallback: () => {
    //             $('body').on('click', '.btn_edit_wo_survey', function () {
    //                 $('.drop-data').val("").trigger("change")
    //                 $('#kt_modal_create_wo_survey_form').trigger("reset")
    //                 $('#kt_modal_create_wo_survey_submit').removeAttr('disabled','disabled');

    //                 const id = $(this).data('id');
    //                 const form_edit = $('#kt_modal_create_wo_survey_form');
    //                 form_edit.find('#containerSelectedSurveyRequests').html('');
    //                 surveyRequestIds = [];
    //                 const workOrderId = $(this).data('id');

    //                 $.get(`{{url('')}}/cmt-promag/work-order/detail/${id}`, function (data) {
    //                     form_edit.find('input[name="work_order_id"]').val(workOrderId);
    //                     form_edit.find('input[name="no_wo"]').val(data.no_wo);
    //                     form_edit.find('input[name="task_description"]').val(data.task_description);
    //                     form_edit.find('input[name="start_date"]').val(getFormattedDate(new Date(data.start_date))[0]);
    //                     form_edit.find('input[name="planning_due_date"]').val(getFormattedDate(new Date(data.planning_due_date))[0]);

    //                     surveyRequestIds.push(data.survey_request_id);
    //                     $.each(surveyRequestIds.filter(onlyUnique), function(index, rowId) {
    //                         form_edit.find('#containerSelectedSurveyRequests').append(
    //                             $('<input>')
    //                             .attr('type', 'hidden')
    //                             .attr('name', 'survey_request_id[]')
    //                             .val(rowId)
    //                         );
    //                     });
    //                 })
    //             });
    //         }
    //     });

    //     ['create_survey_result_cctv', 'create_survey_result_internet'].forEach(element => {
    //         $('body').on('click', `.btn_${element}`, function () {
    //             const form_edit = $(`#kt_modal_${element}_form`);
    //             form_edit.find('#containerSelectedSurveyRequests').html('');
    //             $('.drop-data').val("").trigger("change")
    //             $(`#kt_modal_${element}_form`).trigger("reset")
    //             $(`#kt_modal_${element}_submit`).removeAttr('disabled','disabled');

    //             form_edit.find('input[name="survey_request_id"]').val($(this).data('surveyid'));
    //             form_edit.find('input[name="work_order_id"]').val($(this).data('id'));
    //         });

    //         submitModal({
    //             modalName: `kt_modal_${element}`,
    //             tableName: 'kt_table_on_progress_survey',
    //             anotherTableName: 'tableDoneSurvey',
    //             ajaxLink: "{{route('com.survey-result.store')}}",
    //             validationMessages: surveyResultValidationMessages,
    //         })
    //     });        
    // });

    // $('#tab_survey_done').click(function () {
    //     generateDatatable({
    //         tableName: "tableDoneSurvey",
    //         elementName: "#kt_table_survey_done",
    //         ajaxLink: "{{ route('com.survey-result.datatable') }}",
    //         columnData: [
    //             { data: 'DT_RowIndex'},
    //             { data: 'work_order.task_description'},
    //             { data: 'survey_request.no_survey'},
    //             { data: 'work_order.no_wo'},
    //             { data: 'service_type.name'},
    //             { data: 'building_type'},
    //             { data: 'building_height'},
    //             { data: 'action' },
    //         ]
    //     });    
    // });
</script>

@endsection
