@extends('cmt-opportunity.quotation.index')

@section('quotation-content')
    <div class="row mb-6 align-items-center">
        <div class="col-lg-6 gap-3 d-flex align-items-center">
            <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Quotation Internet</span>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                <div class="d-flex align-items-center">
                    <span class="fs-7 fw-bolder badge badge-info px-3 py-2 text-white me-4 text-nowrap d-none d-lg-block">In
                        Progress</span>
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
                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active"
                                data-bs-toggle="tab" id="tab_boq" href="#tab_boq_content">BOQ Done</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                                data-bs-toggle="tab" id="tab_on_progress_quotation"
                                href="#tab_on_progress_quotation_content">On Progress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0"
                                data-bs-toggle="tab" id="tab_done_quotation" href="#tab_done_quotation_content">Done</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-danger rounded-bottom-0"
                                data-bs-toggle="tab" id="tab_cancel_quotation"
                                href="#tab_cancel_quotation_content">Cancel</a>
                        </li>
                        {{-- <li class="nav-item"> --}}
                    </ul>
                </div>
            </div>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="tab_boq_content" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table align-middle table-striped border table-rounded gy-5"
                                id="kt_table_boq_done">
                                <thead>
                                    <tr class="fw-bold fs-7 text-muted text-uppercase">
                                        <th class="text-center w-50px">NO</th>
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

                <div class="tab-pane fade" id="tab_on_progress_quotation_content" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table align-top table-striped border table-rounded gy-5"
                                id="kt_tab_on_progress_quotation">
                                <thead class="">
                                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                        <th class="text-center w-50px">#</th>
                                        {{-- <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-100px text-center">#</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="fs-7">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab_done_quotation_content" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table align-top table-striped border table-rounded gy-5"
                                id="kt_table_survey_request_progress">
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

                <div class="tab-pane fade" id="tab_cancel_quotation_content" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table align-top table-striped border table-rounded gy-5"
                                id="kt_table_survey_request_done">
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

                {{-- <div class="tab-pane fade" id="tab_on_progress_content" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table align-top table-striped border table-rounded gy-5"
                                id="kt_table_on_progress_survey">
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
                            <table class="table align-top table-striped border table-rounded gy-5"
                                id="kt_table_survey_done">
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
    @endrole

    <script>
        $(document).ready(function() {

            generateDatatable({
                tableName: "tableDoneBoq",
                elementName: "#kt_table_boq_done",
                ajaxLink: "{{ route('com.boq.render.datatable') }}",
                filters: {
                    is_done: true,
                    calledFrom: "Internet",
                },
                columnData: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'prospect.customer.customer_name'
                    },
                    {
                        data: 'prospect.customer.customer_contact.customer_contact_phone',
                        render: function(data, type, row) {
                            // Check if the data is of type display or filter (not sorting)
                            if (type === 'display' || type === 'filter') {
                                // Prepend '0' to the phone number
                                return '0' + data;
                            }
                            // For sorting and other purposes, return the original data
                            return data;
                        }
                    },
                    {
                        data: 'prospect.prospect_title'
                    },
                    {
                        data: 'progress_pretified'
                    },
                    {
                        data: 'next_action_pretified'
                    },
                    {
                        data: 'action_quotation'
                    },
                ]
            });

            // $('body').on('click', '.btn_request_survey', function() {
            //     const form_edit = $('#kt_modal_request_survey_form');
            //     form_edit.find('#containerSelectedProspects').html('');
            //     $('.drop-data').val("").trigger("change")
            //     $('#kt_modal_request_survey_form').trigger("reset")
            //     $('#kt_modal_request_survey_submit').removeAttr('disabled', 'disabled');

            //     prospectIds = [];
            //     const prospectId = $(this).data('id');
            //     prospectIds.push(prospectId);

            //     $.each(prospectIds.filter(onlyUnique), function(index, rowId) {
            //         form_edit.find('#containerSelectedProspects').append(
            //             $('<input>')
            //             .attr('type', 'hidden')
            //             .attr('name', 'prospect_id[]')
            //             .val(rowId)
            //         );
            //     });
            // });

            // submitModal({
            //     modalName: 'kt_modal_request_survey',
            //     tableName: 'kt_table_opportunities',
            //     anotherTableName: 'tableSurveyRequest',
            //     ajaxLink: '{{ route('com.survey-request.store') }}',
            //     validationMessages: surveyRequestValidationMessages,
            // });
        });

        $('#tab_on_progress_quotation').click(function() {
            generateDatatable({
                tableName: "tableOnProgressQuotation",
                elementName: "#kt_tab_on_progress_quotation",
                ajaxLink: "{{ route('com.quotation.render.datatable') }}",
                filters: {},
                columnData: [{
                    data: 'DT_RowIndex'
                }, ],
            });
        });

        // $('#tab_done_quotation_content').click(function() {
        //     generateDatatable({
        //         tableName: "tableSurveyRequest",
        //         elementName: "#kt_table_survey_request_done",
        //         ajaxLink: "{{ route('com.quotation.render.datatable') }}",
        //         filters: {
        //             'status': 'DN'
        //         },
        //         columnData: [{
        //                 data: 'DT_RowChecklist',
        //                 orderable: false,
        //                 searchable: false
        //             },
        //             {
        //                 data: 'DT_RowIndex'
        //             },
        //             {
        //                 data: 'customer_prospect.customer.customer_name'
        //             },
        //             {
        //                 data: 'no_survey'
        //             },
        //             {
        //                 data: 'service_type.name'
        //             },
        //             {
        //                 data: 'type_of_survey.name'
        //             },
        //             {
        //                 data: 'survey_datetime'
        //             },
        //             {
        //                 data: 'lat'
        //             },
        //             {
        //                 data: 'lang'
        //             },
        //             {
        //                 data: 'closest_bts'
        //             },
        //             {
        //                 data: 'covered_status_pretified'
        //             },
        //             {
        //                 data: 'notes'
        //             },
        //         ],
        //     });
        // });

        // $('#tab_cancel_quotation_content').click(function () {
        //     generateDatatable({
        //         tableName: "tableOnProgressSurvey",
        //         elementName: "#kt_table_on_progress_survey",
        //         ajaxLink: "{{ route('com.quotation.render.datatable') }}",
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

        //                 $.get(`{{ url('') }}/cmt-promag/work-order/detail/${id}`, function (data) {
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
        //  });

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
        //             ajaxLink: "{{ route('com.survey-result.store') }}",
        //             validationMessages: surveyResultValidationMessages,
        //         })
        //     });        
        // });
    </script>
@endsection
