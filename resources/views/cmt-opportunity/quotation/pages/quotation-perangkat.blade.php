@extends('cmt-opportunity.quotation.index')
@php
    $selected_side_bar_content = 'quotation-perangkat'
@endphp

@section('quotation-content')
    <div class="row mb-6 align-items-center">
        <div class="col-lg-6 gap-3 d-flex align-items-center">
            <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Quotation Internet</span>
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
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Contact Person</th> 
                                        <th class="w-200px">No Quotation</th> 
                                        <th class="w-200px">Description</th> 
                                        <th class="w-200px">On Progress</th> 
                                        <th class="w-100px text-center">#</th>
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
                                id="kt_table_done_quotation">
                                <thead class="">
                                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                        <th class="text-center w-50px">#</th>
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Contact Person</th> 
                                        <th class="w-200px">No Quotation</th> 
                                        <th class="w-200px">Description</th> 
                                        <th class="w-200px">On Progress</th> 
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
                                id="kt_table_cancel_quotation">
                                <thead class="">
                                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                        <th class="text-center w-50px">#</th>
                                        <th class="w-200px">Company Name</th> 
                                        <th class="w-200px">Contact Person</th> 
                                        <th class="w-200px">No Quotation</th> 
                                        <th class="w-200px">Description</th> 
                                        <th class="w-200px">On Progress</th> 
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

    @role('administrator')
    @endrole

    <script>
        $(document).ready(function() {

        $('#tab_boq').click(function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('In Progress');
        });
        $('#tab_on_progress_quotation').click(function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('In Progress');
        });
        $('#tab_done_quotation').click(function() {
            $('#progress_bar').removeClass('badge-danger').addClass('badge-info');
            $('#progress_bar').text('Done');
        });
        $('#tab_cancel_quotation').click(function() {
            $('#progress_bar').removeClass('badge-info').addClass('badge-danger');
            $('#progress_bar').text('Cancel');
        });

        generateDatatable({
            tableName: "tableDoneBoq",
            elementName: "#kt_table_boq_done",
            ajaxLink: "{{ route('com.boq.render.datatable') }}",
            filters: {
                is_quotation: false,
                calledFrom: "Perangkat",
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
        });

        $('#tab_on_progress_quotation').click(function() {
            generateDatatable({
                tableName: "tableOnProgressQuotation",
                elementName: "#kt_tab_on_progress_quotation",
                ajaxLink: "{{ route('com.quotation.render.datatable') }}",
                filters: {
                    is_progress : true,
                    calledFrom: "Perangkat",
                },
                columnData: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'itemable_bill_of_quantity.customer_prospect.customer.customer_name',
                },
                {
                    data: 'itemable_bill_of_quantity.customer_prospect.customer.customer_contact.customer_contact_phone',
                    render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return '0' + data;
                            }
                            return data;
                        }
                },
                {
                    data: 'no_quotation',
                },
                {
                    data: 'description',
                },
                {
                    data: 'status',
                },
                {
                    data: 'action_update',
                }
            ],
            });
        });

        $('#tab_done_quotation').click(function() {
            generateDatatable({
                tableName: "tabledonequotation",
                elementName: "#kt_table_done_quotation",
                ajaxLink: "{{ route('com.quotation.render.datatable') }}",
                filters: {
                    is_done : true,
                    calledFrom: "Perangkat",
                },
                columnData: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'itemable_bill_of_quantity.customer_prospect.customer.customer_name',
                },
                {
                    data: 'itemable_bill_of_quantity.customer_prospect.customer.customer_contact.customer_contact_phone',
                    render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return '0' + data;
                            }
                            return data;
                        }
                },
                {
                    data: 'no_quotation',
                },
                {
                    data: 'description',
                },
                {
                    data: 'status',
                },
                {
                    data: 'action_done',
                }
            ],
            });
        });

        $('#tab_cancel_quotation').click(function() {
            generateDatatable({
                tableName: "tableCancelQuotation",
                elementName: "#kt_table_cancel_quotation",
                ajaxLink: "{{ route('com.quotation.render.datatable') }}",
                filters: {
                    is_done : false,
                    calledFrom: "Perangkat",
                },
                columnData: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'itemable_bill_of_quantity.customer_prospect.customer.customer_name',
                },
                {
                    data: 'itemable_bill_of_quantity.customer_prospect.customer.customer_contact.customer_contact_phone',
                    render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return '0' + data;
                            }
                            return data;
                        }
                },
                {
                    data: 'no_quotation',
                },
                {
                    data: 'description',
                },
                {
                    data: 'progress_pretified',
                },
                {
                    data: 'action_update',
                }
            ],
            });
        });

    </script>
@endsection
