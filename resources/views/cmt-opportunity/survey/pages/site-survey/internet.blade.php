@extends('cmt-opportunity.survey.index')

@section('survey-content')
@php
    $selected_side_bar_content = 'site-survey-internet'
@endphp

<div class="row mb-6 align-items-center">
    <div class="col-lg-6 gap-3 d-flex align-items-center">
        <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Project / Work</span>
    </div>
    <div class="col-lg-6 d-flex justify-content-end">
        <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
            <div class="d-flex align-items-center">
                <div class="tab_action_work_order">
                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-gear me-2"></i>Mass Action</button>
                    <div class="menu menu-sub menu-sub-dropdown w-300px text-start pb-3" id="action_lead" data-kt-menu="true" style="">
                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Mass Action Options</span>
                        </div>
                        <div class="separator mb-6"></div>
                        @can('Approval:survey-work-order')
                        <div class="menu-item px-3">
                            <a href="#kt_modal_approve_work_order" data-bs-toggle="modal" class="menu-link" id="btn_approve_work_order">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-building-circle-check text-gray-500"></i>
                                </span>
                                <span class="menu-title text-dark">Approval Work Order</span>
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
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
                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0 active" data-bs-toggle="tab" id="tab_survey_sent" href="#tab_survey_sent_content">Survey Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" id="tab_on_progress" href="#tab_on_progress_content">On Progress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="tab_survey_done" href="#tab_survey_done_content">Done</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab_survey_sent_content" role="tabpanel">
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
            <div class="tab-pane fade" id="tab_on_progress_content" role="tabpanel">
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
                                    <th class="text-center w-50px">#</th>
                                    <th class="">Task Name</th>
                                    <th class="w-200px">No. Survey Request</th>
                                    <th class="w-200px">No. Work Order</th>
                                    <th class="w-100px">Service Type</th>
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

{{-- @role('administrator') --}}
@include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.modal-create-soft-survey')
                        
@can('Approval:survey-work-order')
@include('cmt-promag.modal.modal-approve-work-order')
@endcan
{{-- @endrole --}}

<script>
    let prospectIds = [];
    let surveyRequestIds = [];
    let workOrderIds = [];

    $('body').on('click', '#tab_on_progress', function () {
        $('.tab_action_work_order').show();
    });
    $('body').on('click', '#tab_survey_sent', function () {
        $('.tab_action_work_order').hide();
    });
    $('body').on('click', '#tab_survey_done', function () {
        $('.tab_action_work_order').hide();
    });

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

    const workOrderApproveValidationMessages = {
        approved_status: {
            required: "<span class='fw-semibold fs-8 text-danger'>Survey Result has Broken Link, Please Refresh (unable to find survey request)</span>",
        },
        work_order_id: {
            required: "<span class='fw-semibold fs-8 text-danger'>Survey Result has Broken Link, Please Refresh (unable to find work order)</span>",
        },
    };

    $(document).ready(function() {
        $('.tab_action_work_order').hide();

        generateDatatable({
            tableName: "tableSurveyRequest",
            elementName: "#kt_table_survey_request",
            ajaxLink: "{{route('com.survey-request.datatable')}}",
            filters: {
                'status': 'ST',
                'only-site-survey': true,
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

        submitModal({
            modalName: 'kt_modal_create_wo_survey',
            tableName: 'kt_table_survey_request',
            anotherTableName: 'tableOnProgressSurvey',
            ajaxLink: "{{route('com.work-order-survey.store')}}",
            validationMessages: workOrderValidationMessages,
        })
    });

    $('#tab_on_progress').click(function () {
        generateDatatable({
            tableName: "tableOnProgressSurvey",
            elementName: "#kt_table_on_progress_survey",
            ajaxLink: "{{ route('com.work-order-survey.datatable') }}",
            filters: {
                'service_type_id': 1,
            },
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
            ],
            functionCallback: () => {
                $('body').on('click', '.btn_edit_wo_survey', function () {
                    $('.drop-data').val("").trigger("change")
                    $('#kt_modal_create_wo_survey_form').trigger("reset")
                    $('#kt_modal_create_wo_survey_submit').removeAttr('disabled','disabled');

                    const id = $(this).data('id');
                    const form_edit = $('#kt_modal_create_wo_survey_form');
                    form_edit.find('#containerSelectedSurveyRequests').html('');
                    surveyRequestIds = [];
                    const workOrderId = $(this).data('id');

                    $.get(`{{url('')}}/cmt-promag/work-order/detail/${id}`, function (data) {
                        form_edit.find('input[name="work_order_id"]').val(workOrderId);
                        form_edit.find('input[name="no_wo"]').val(data.no_wo);
                        form_edit.find('input[name="task_description"]').val(data.task_description);
                        form_edit.find('input[name="start_date"]').val(getFormattedDate(new Date(data.start_date))[0]);
                        form_edit.find('input[name="planning_due_date"]').val(getFormattedDate(new Date(data.planning_due_date))[0]);

                        surveyRequestIds.push(data.survey_request_id);
                        $.each(surveyRequestIds.filter(onlyUnique), function(index, rowId) {
                            form_edit.find('#containerSelectedSurveyRequests').append(
                                $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'survey_request_id[]')
                                .val(rowId)
                            );
                        });
                    })
                });

                $('input[name="checkbox_work_order_ids"]').click(function () {
                    if ($(this).is(':checked')) {
                        workOrderIds.push($(this).val());   
                    }
                });
            }
        });

        // ['create_survey_result_cctv', 'create_survey_result_internet'].forEach(element => {
        //     $('body').on('click', `.btn_${element}`, function () {
        //         const form_edit = $(`#kt_modal_${element}_form`);
        //         form_edit.find('#containerSelectedSurveyRequests').html('');
        //         $('.drop-data').val("").trigger("change")
        //         $(`#kt_modal_${element}_form`).trigger("reset")
        //         $(`#kt_modal_${element}_submit`).removeAttr('disabled','disabled');

        //         form_edit.find('input[name="survey_request_id"]').val($(this).data('surveyid'));
        //         form_edit.find('input[name="work_order_id"]').val($(this).data('id'));
        //     });

        //     submitModal({
        //         modalName: `kt_modal_${element}`,
        //         tableName: 'kt_table_on_progress_survey',
        //         anotherTableName: 'tableDoneSurvey',
        //         ajaxLink: "{{route('com.survey-result.store')}}",
        //         validationMessages: surveyResultValidationMessages,
        //     })
        // });    

        $('#btn_approve_work_order').click(function () {
            const form_edit = $('#kt_modal_approve_work_order_form')
            form_edit.find('#containerSelectedWorkOrders').html('')

            $.each(workOrderIds.filter(onlyUnique), function(index, rowId) {
                form_edit.find('#containerSelectedWorkOrders').append(
                    $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'work_order_id[]')
                    .val(rowId)
                );
            });
        })

        $('#kt_modal_approve_work_order_approve').click(function (e) {
            const form_edit = $('#kt_modal_approve_work_order_form')
            e.preventDefault();

            form_edit.find('input[name="approved_status"]').val(1);
            form_edit.trigger('submit');
        })

        $('#kt_modal_approve_work_order_decline').click(function (e) {
            const form_edit = $('#kt_modal_approve_work_order_form')
            e.preventDefault();

            form_edit.find('input[name="approved_status"]').val(0);
            form_edit.trigger('submit');
        })

        submitModal({
            modalName: `kt_modal_approve_work_order`,
            tableName: 'kt_table_on_progress_survey',
            ajaxLink: "{{route('com.work-order.approve')}}",
            validationMessages: workOrderApproveValidationMessages,
        })    
    });

    $('#tab_survey_done').click(function () {
        generateDatatable({
            tableName: "tableDoneSurvey",
            elementName: "#kt_table_survey_done",
            ajaxLink: "{{ route('com.survey-result.datatable') }}",
            filters: {
                'service_type_id': 1,
            },
            columnData: [
                { data: 'DT_RowIndex'},
                { data: 'work_order.task_description'},
                { data: 'survey_request.no_survey'},
                { data: 'work_order.no_wo'},
                { data: 'site_survey_service_type.name'},
                { data: 'action' },
            ]
        });    
    });
</script>

@endsection
