@extends('layouts.app')
@section('title-apps','Settings')
@section('sub-title-apps','Branch')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center mt-md-n20">
            <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                @include("hc.cmt-settings.sidebar")
            </div>
            <div class="col-lg-9 mt-md-n14">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-9">
                                <h4>Branch</h4>
                                <span class="fs-7 fw-semibold text-gray-500">Cabang yang dimiliki perusahaan</span>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div>
                                    <a href="{{route("hc.setting.branch.create")}}" class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Add Branch</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="tb_branch">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-150px">Branch Name</th>
                                            <th class="w-150px">Parent Branch</th>
                                            <th class="w-150px">Province</th>
                                            <th class="w-150px">City</th>
                                            <th class="w-100px">#</th>
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

<script>
    let dataTableBranch
    $(document).ready(function () {
        dataTableBranch = $('#tb_branch').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            buttons: [],
            drawCallback: function () {
                $('body').on('click', 'input[name=\'family_ids\']', function () {
                    if($(this).is(":checked")){
                        family_ids.push($(this).val());
                    } else {
                        removeFrom(family_ids, $(this).val());
                    }
                });
            },
            ajax: {
                url : "{{route('hc.emp.getTableBranch')}}",
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
            { data: 'DT_RowChecklist', orderable: false, searchable: false},
            { data: 'DT_RowIndex'},
            { data: 'name'},
            { data: 'parent'},
            { data: 'province'},
            { data: 'city'},
            { data: 'action'},
            ],

            columnDefs: [
            {
                targets: 0,
                searchable : false,
                className: 'text-center',
            },
            {
                targets: 1,
                className: 'text-center',
            },
            {
                targets: 6,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
    })

    function deleteBranch(id) {
        $.ajax({
            url: "{{ route('hc.setting.branch.delete') }}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'POST',
            data: { id : id},
            success: function(data) {
                dataTableBranch.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = JSON.parse(xhr.responseText);
                toastr.error(errorThrown ,'Opps!');
            }
        });
    }
</script>

@endsection
