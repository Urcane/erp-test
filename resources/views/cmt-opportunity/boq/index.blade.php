@extends('layouts.app')
@section('title-apps', 'BOQ')
@section('sub-title-apps-2', 'Commercial')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Bill Of Quantity')
@section('icon-apps', 'fa-solid fa-briefcase')

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
                            <div class="row mb-6 align-items-center d-flex justify-content-end">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="fs-7 text-uppercase fw-bolder text-dark">List Project / Work</span>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                                        <div class="d-flex align-items-center">
                                            <span
                                                class="fs-7 fw-bolder badge badge-info px-3 py-2 text-white me-4 text-nowrap"
                                                id="progress_bar">In Progress</span>
                                        </div>
                                    </div>
                                </div>
                                @can('Boq:create-draft-boq')
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                                        <div class="">
                                            <a href="{{ url('cmt-boq/create-draft-boq') }}"
                                                class="btn btn-info btn-sm me-3 btn_tambah_boq" id="create_boq">
                                                <i class="fa-solid fa-plus"></i>Create BoQ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endcan
                            </div>
                            <div class="row mb-6 align-items-center">

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-6 hover-scroll-x">
                                        <div class="d-grid">
                                            <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active"
                                                        data-bs-toggle="tab" id="tab_opportunity"
                                                        href="#tab_opportunity_content">Oppoturnities</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                                                        data-bs-toggle="tab" id="tab_survey"
                                                        href="#tab_survey_content">Survey</a>
                                                </li>
                                                @can('Boq:view-draft-boq')
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                                                        data-bs-toggle="tab" id="tab_draft" href="#tab_draft_content">Draft
                                                        BoQ</a>
                                                </li>
                                                @endcan
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0"
                                                        data-bs-toggle="tab" id="tab_commercial"
                                                        href="#tab_commercial_content">BoQ Commercial</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0"
                                                        data-bs-toggle="tab" id="tab_review"
                                                        href="#tab_on_review_content">On Review</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0"
                                                        data-bs-toggle="tab" id="tab_done"
                                                        href="#tab_boq_done_content">Done</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0"
                                                        data-bs-toggle="tab" id="tab_cancel"
                                                        href="#tab_boq_cancel_content">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="myTabContent">

                                        {{-- TAB OPPORTUNITY --}}
                                        <div class="tab-pane fade show active" id="tab_opportunity_content" role="tabpanel">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <div class="col-lg-12">
                                                        <table
                                                            class="table align-middle table-striped border table-rounded gy-5"
                                                            id="kt_table_opportunities">
                                                            <thead>
                                                                <tr class="fw-bold fs-7 text-muted text-uppercase">
                                                                    <th class="w-25px">#</th>
                                                                    <th class="w-25px">#</th>
                                                                    <th class="">Company Name</th>
                                                                    <th class="w-100px">Company Contact</th>
                                                                    <th class="w-100px">Business Type</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-300px">Status</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB SURVEY  --}}
                                        <div class="tab-pane fade" id="tab_survey_content" role="tabpanel">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <div class="col-lg-12">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_survey">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-50px">#</th>
                                                                    <th class="">Task Name</th>
                                                                    <th class="w-200px">No. Survey Request</th>
                                                                    <th class="w-200px">No. Work Order</th>
                                                                    <th class="w-100px">Service Type</th>
                                                                    <th class="w-100px">Covered Status</th>
                                                                    <th class="w-100px">Notes</th>
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
                                        {{-- TAB DRAFT  --}}
                                        @can('Boq:view-draft-boq')
                                        <div class="tab-pane fade" id="tab_draft_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_draft_boq">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-75px">#</th>
                                                                    <th class="text-center w-25px">ID. BOQ</th>
                                                                    <th class="">Company Name</th>
                                                                    <th class="w-300px">Company Address</th>
                                                                    <th class="w-300px">Prospect Title</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-300px">Prospect Update</th>
                                                                    <th class="w-300px">Created At</th>
                                                                    <th class="w-300px">Last Updated At</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcan
                                        {{-- TAB COMMERCIAL  --}}
                                        <div class="tab-pane fade" id="tab_commercial_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_commercial">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-75px">#</th>
                                                                    <th class="text-center w-25px">ID. BOQ</th>
                                                                    <th class="w-25px">Company Name</th>
                                                                    <th class="">Project Name</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-300px">Created At</th>
                                                                    <th class="w-300px">Last Updated At</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB ON REVIEW  --}}
                                        <div class="tab-pane fade" id="tab_on_review_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_review">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-75px">#</th>
                                                                    <th class="text-center w-25px">ID. BOQ</th>
                                                                    <th class="w-25px">Company Name</th>
                                                                    <th class="">Project Name</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-200px">Next Action</th>
                                                                    <th class="w-100px">Aging</th>
                                                                    <th class="w-300px">Created At</th>
                                                                    <th class="w-300px">Last Updated At</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB BOQ DONE  --}}
                                        <div class="tab-pane fade" id="tab_boq_done_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_boq_done">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="w-50px">#</th>
                                                                    <th class="text-center w-25px">ID. BOQ</th>
                                                                    <th class="">Company Name</th>
                                                                    <th class="">Company Contact</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-300px">Created At</th>
                                                                    <th class="w-300px">Last Updated At</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB BOQ CANCEL  --}}
                                        <div class="tab-pane fade" id="tab_boq_cancel_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_boq_cancel">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-25px">#</th>
                                                                    <th class="text-center w-25px">ID. BOQ</th>
                                                                    <th class="w-25px">Company Name</th>
                                                                    <th class="">Project Name</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-300px">Created At</th>
                                                                    <th class="w-300px">Last Updated At</th>
                                                                    <th class="w-50px text-center">#</th>
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
    </div>

    @role('administrator')
        {{-- @include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv') --}}
    @endrole


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#progress_bar').hide();

        $('body').on('click', '#tab_opportunity', function() {
            $('#progress_bar').hide();
            $('#create_boq').show();
        });

        $('body').on('click', '#tab_survey', function() {
            $('#progress_bar').hide();
            $('#create_boq').show();
        });

        $('body').on('click', '#tab_draft', function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('In Progress');
            $('#progress_bar').show();
            $('#create_boq').hide();
        });

        $('body').on('click', '#tab_commercial', function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('In Progress');
            $('#progress_bar').show();
            $('#create_boq').hide();
        });

        $('body').on('click', '#tab_done', function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('In Progress');
            $('#progress_bar').show();
            $('#create_boq').hide();
        });

        $('body').on('click', '#tab_cancel', function() {
            $('#progress_bar').removeClass('badge-info').addClass('badge-danger');
            $('#progress_bar').text('Canceled').prepend('<i class="fas fa-times-circle me-2"></i>');
            $('#progress_bar').show();
            $('#create_boq').hide();
        });

        $('body').on('click', '#tab_review', function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('In Progress');
            $('#progress_bar').show();
            $('#create_boq').hide();
        });

        generateDatatable({
            tableName: "tableOpporunities",
            elementName: "#kt_table_opportunities",
            ajaxLink: "{{ route('com.prospect.get-table-prospect-only-done') }}",
            filters: {
                calledFrom: 'BOQ'
            },
            columnData: [{
                    data: 'DT_RowChecklist',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex'
                },
                {
                    data: 'customer.customer_name'
                },
                {
                    data: 'customer.customer_contact.customer_contact_phone',
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
                    data: 'customer.bussines_type.type_name'
                },
                {
                    data: 'next_action_pretified'
                },
                {
                    data: 'progress_pretified'
                },
                {
                    data: 'action'
                },
            ]
        });

        $('#tab_survey').click(function() {
            generateDatatable({
                tableName: "tableDoneSurvey",
                elementName: "#kt_table_survey",
                ajaxLink: "{{ route('com.survey-request.datatable') }}",
                filters: {
                    'status': 'DN',
                    'calledFrom': 'BOQ'
                },
                columnData: [
                    // { data: 'DT_RowChecklist', orderable: false, searchable: false},
                    {
                        data: 'DT_RowIndex', searchable: false
                    },
                    {
                        data: 'customer_prospect.customer.customer_name'
                    },
                    {
                        data: 'no_survey'
                    },
                    {
                        data: 'service_type.name'
                    },
                    {
                        data: 'type_of_survey.name'
                    },
                    {
                        data: 'covered_status_pretified'
                    },
                    {
                        data: 'notes'
                    },
                    {
                        data: 'action'
                    },
                ],
            });
        });

        @can('Boq:view-draft-boq')
        $('#tab_draft').click(function() {
            generateDatatable({
                tableName: "tableDraftBoq",
                elementName: "#kt_table_draft_boq",
                ajaxLink: "{{ route('com.boq.render.datatable') }}",
                filters: {
                    is_draft: true,
                },
                columnData: [
                    // { data: 'DT_RowChecklist'},
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'prospect.customer.customer_name'
                    },
                    {
                        data: 'prospect.customer.customer_address'
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
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });
        @endcan

        $('#tab_commercial').click(function() {
            generateDatatable({
                tableName: "tableCommercialBoq",
                elementName: "#kt_table_commercial",
                ajaxLink: "{{ route('com.boq.render.datatable') }}",
                filters: {
                    is_draft: false,
                },
                columnData: [
                    // { data: 'DT_RowChecklist'},
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'prospect.customer.customer_name'
                    },
                    {
                        data: 'prospect.customer.customer_address'
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
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });

        $('#tab_done').click(function() {
            generateDatatable({
                tableName: "tableDoneBoq",
                elementName: "#kt_table_boq_done",
                ajaxLink: "{{ route('com.boq.render.datatable') }}",
                filters: {
                    is_done: true,
                },
                columnData: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
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
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action_done'
                    },
                ]
            });
        });

        $('#tab_cancel').click(function() {
            generateDatatable({
                tableName: "tableCancelBoq",
                elementName: "#kt_table_boq_cancel",
                ajaxLink: "{{ route('com.boq.render.datatable') }}",
                filters: {
                    is_done: false,
                },
                columnData: [
                    // { data: 'DT_RowChecklist'},
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'prospect.customer.customer_name'
                    },
                    {
                        data: 'prospect.customer.customer_address'
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
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action_cancel'
                    },
                ]
            });
        });

        $('#tab_review').click(function() {
            generateDatatable({
                tableName: "tableOnReviewBoq",
                elementName: "#kt_table_review",
                ajaxLink: "{{ route('com.boq.render.datatable') }}",
                filters: {
                    is_final: true,
                },
                columnData: [
                    // { data: 'DT_RowChecklist'},
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'prospect.customer.customer_name'
                    },
                    {
                        data: 'prospect.customer.customer_address'
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
                        data: 'aging'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action_approval'
                    },
                ]
            });
        });
    });
</script>
