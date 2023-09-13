@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Permission')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('sense') }}/plugins/custom/OrgChart/css/jquery.orgchart.css">
    <style>
        #chart-container {
            font-family: Arial;
            height: 420px;
            border: 2px dashed #aaa;
            border-radius: 5px;
            overflow: auto;
            text-align: center;
        }

        .orgchart {
            background: white;
        }
    </style>

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                    @include('hc.cmt-settings.sidebar')
                </div>
                <div class="col-lg-9 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-9">
                                <h4>Permission</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="tb_permission">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            {{-- <th class="text-center w-50px">#</th> --}}
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-150px">Nama Pegawai</th>
                                            <th class="w-150px">NIP</th>
                                            <th class="w-150px">Branch</th>
                                            <th class="w-150px">Department</th>
                                            <th class="w-150px">Jabatan</th>
                                            <th class="w-150px">permission</th>
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

    <script>
        let dataTablePermission

        $(document).ready(function() {
            dataTablePermission = $('#tb_permission').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                buttons: [],
                ajax: {
                    url: "{{ route('hc.setting.permission.getTable') }}",
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                dom: "<'row mb-2'" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",

                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'nip'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'department'
                    },
                    {
                        data: 'job_position'
                    },
                    {
                        data: 'action'
                    },
                ],

                columnDefs: [{
                        targets: 0,
                        className: 'text-center',
                    },
                    {
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
            });
        })
    </script>

@endsection
