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
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table align-top table-striped border table-rounded gy-5"
                                            id="kt_table_procurement">
                                            <thead class="">
                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                    <th class="w-50px text-center">#</th>
                                                    <th class="">Customer Name</th>
                                                    <th class="">Customer Address</th>
                                                    <th class="">Total Items</th>
                                                    <th class="w-200px">Project Title</th>
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
                        data: 'customer_name'
                    },
                    {
                        data: 'customer_address'
                    },
                    {
                        data: 'total_items'
                    },
                    {
                        data: 'prospect_title'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });
    </script>
@endsection
