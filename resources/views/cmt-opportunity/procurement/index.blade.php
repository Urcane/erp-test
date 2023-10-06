@extends('layouts.app')
@section('title-apps', 'Procurement')
@section('sub-title-apps', 'Commercial')
@section('desc-apps', 'Pengadaan yang peru diadakan')
@section('icon-apps', 'fa-solid fa-box-open')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('summary-page')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-9">
                                    <h4>Procurement List</h4>
                                    <span class="fs-7 fw-semibold text-gray-500">All procurement that has been submited</span>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <div>
                                        <a href="{{route("com.procurement.create")}}" class="btn btn-info btn-sm me-3 fs-8"><i
                                                class="fa-solid fa-plus"></i>Create Procurement</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table align-top table-striped border table-rounded gy-5"
                                            id="kt_table_procurement">
                                            <thead class="">
                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                    <th class="w-50px text-center">#</th>
                                                    <th class="">Customer Name</th>
                                                    <th class="">Request Date</th>
                                                    <th class="">No. PR</th>
                                                    <th class="">Type</th>
                                                    <th class="">Status</th>
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
    <script>
        $(document).ready(function() {
            generateDatatable({
                tableName: "tableDoneBoq",
                elementName: "#kt_table_procurement",
                ajaxLink: "{{ route('com.procurement.getTable') }}",
                filters: {
                    is_done: true,
                },
                columnData: [
                    {
                        data: 'id'
                    },
                    {
                        data: 'customer'
                    },
                    {
                        data: 'request_date'
                    },
                    {
                        data: 'no_pr'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });
    </script>
@endsection
