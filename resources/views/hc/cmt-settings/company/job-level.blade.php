@extends('layouts.app')
@section('title-apps','Settings')
@section('sub-title-apps','Organization')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<link rel="stylesheet" href="{{asset('sense')}}/plugins/custom/OrgChart/css/jquery.orgchart.css">
<style>
    #chart-container {
        font-family: Arial;
        height: 420px;
        border: 2px dashed #aaa;
        border-radius: 5px;
        overflow: auto;
        text-align: center;
    }

    .orgchart { background: white; }
</style>

<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center mt-md-n20">
            <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                @include("hc.cmt-settings.sidebar")
            </div>
            <div class="col-lg-9 mt-md-n14">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-lg-6 mb-9">
                            <h4>Job Level</h4>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div>
                                <a href="#modal_create_job_level" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_job_level"><i class="fa-solid fa-plus"></i>Add Job Level</a>
                            </div>
                        </div>
                        <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="tb_job_level">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-150px">Job Level</th>
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
    let dataTableJobLevel
    $(".btn_tambah_job_level").on( "click", function() {
        $("input").val("")
    })

    $(document).ready(function () {
        dataTableJobLevel = $('#tb_job_level').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            buttons: [],
            drawCallback: function () {
                $('body').on('click', 'input[name=\'job_level_ids\']', function () {
                    if($(this).is(":checked")){
                        family_ids.push($(this).val());
                    } else {
                        removeFrom(family_ids, $(this).val());
                    }
                });
            },
            ajax: {
                url : "{{route('hc.emp.getTableJobLevel')}}",
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
                targets: 3,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
    })

    $('#modal_create_job_level_form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('hc.setting.job-level.createUpdate') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(data) {
                dataTableJobLevel.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });
</script>

@include('components.delete-confirmation', ["id" => "JobLevel", "route" => route('hc.setting.job-level.delete')])

@endsection
