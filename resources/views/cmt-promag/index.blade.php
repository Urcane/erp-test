@extends('layouts.app')
@section('title-apps','CMT-PROMAG')
@section('sub-title-apps','Commercial')
@section('desc-apps','Pusing Kerja?, PROMAG solusi nya!')
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
                                        <a href="{{ route('com.promag.create') }}" class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Project Baru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_promag">
                                    <thead>
                                        <tr class="fw-bold fs-7 text-muted text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="">Work List</th>
                                            <th class="w-150px">No Project</th>
                                            <th class="w-150px">PO/SPK/PKS</th>
                                            <th class="w-150px">Assigned</th>
                                            <th class="w-100px">Progress</th>
                                            <th class="w-100px">Status</th>
                                            <th class="w-100px text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-7">
                                        {{-- <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <span class="fw-bold">Pembuatan Aplikasi Internal CMT - PT. COMTELINDO</span>
                                            </td>
                                            <td>C0167-TEL-20221201</td>
                                            <td>C0167-TEL-20221201</td>
                                            <td>
                                                <div class="symbol-group symbol-hover">
                                                    <div class="symbol symbol-circle symbol-30px" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                                        <img src="{{asset('sense')}}/media/avatars/blank.png" alt="">
                                                    </div>
                                                    <div class="symbol symbol-circle symbol-30px" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                                        <div class="symbol-label bg-warning">
                                                            <span class="fs-7 text-white">E</span>
                                                        </div>
                                                    </div>
                                                    <div class="symbol symbol-circle symbol-30px">
                                                        <div class="symbol-label bg-dark">
                                                            <span class="fs-7 text-inverse-dark">+0</span>
                                                        </div>
                                                    </div>
                                                    <div class="symbol symbol-circle symbol-30px">
                                                        <a href="#!" data-bs-toggle="modal" >
                                                            <div class="symbol-label bg-light">
                                                                <span class="fs-7"><i class="fa-solid fa-user-plus"></i></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center w-100 mw-125px">
                                                    <div class="progress h-6px w-100 me-2 bg-light-info">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 44%" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="text-muted fs-8 fw-semibold">
                                                        44%
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-info px-3 py-2">Progress</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <ul class="dropdown-menu w-150px">
                                                    <li><a href="{{route('com.promag.detail')}}" class="btn_edit_karyawan dropdown-item py-2" data-id="'.$action->id.'"><i class="fa-solid fa-pen me-4"></i>Edit</a></li>
                                                    <li><a class="dropdown-item py-2 text-success"><i class="fa-solid fa-bars-progress me-4 text-success"></i>Progress</a></li>
                                                    <div class="separator my-2"></div>
                                                    <li><a class="dropdown-item py-2"><i class="fa-solid fa-file-lines me-4"></i>Terbitkan <b class="text-warning">WO</b></a></li>
                                                </ul>
                                            </td>
                                        </tr> --}}
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

<script>
    $(document).ready(function () {
        var dataTablePromag = $('#kt_table_promag').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            buttons: [],
            ajax: {
                url : "{{route('com.promag.datatable')}}",
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",

            columns: [
                { data: 'DT_RowIndex'},
                { data: 'work_name'},
                { data: 'no_project'},
                { data: 'no_po_customer'},
                { data: 'assigned'},
                { data: 'progress'},
                { data: 'status'},
                { data: 'action'},
            ],

            columnDefs: [
            {
                targets: 0,
                searchable : false,
                className: 'text-center',
            },
            {
                targets: 7,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
    })
</script>
@endsection
