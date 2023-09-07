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
<link rel="stylesheet" href="{{asset('sense')}}/plugins/custom/OrgChart/css/jquery.orgchart.css"">
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

<div class="modal fade" id="file_category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="file_category_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="file_category_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#file_category_header" data-kt-scroll-wrappers="#file_category_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Category File</span>
                            {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Nama</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Name" required name="name">
                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="file_category_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="file_category_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                            <h4>Category File</h4>
                            <span class="fs-7 fw-semibold text-gray-500">Kategori file yang dapat disimpan oleh user</span>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div>
                                <a href="#file_category" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_file_category"><i class="fa-solid fa-plus"></i>Add category file</a>
                            </div>
                        </div>
                        <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="tb_file_category">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-150px">Category Name</th>
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
    let dataTableFileCategory
    $(".btn_tambah_file_category").on( "click", function() {
        $("input").val("")
    })

    $(document).ready(function () {
        dataTableFileCategory = $('#tb_file_category').DataTable({
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
                url : "{{route('hc.emp.getTableUserFileCategory')}}",
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

    $('#file_category_form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('hc.setting.file-category.createUpdate') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(data) {
                dataTableFileCategory.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });
</script>

@include('components.delete-confirmation', ["id" => "FileCategory", "route" => route('hc.setting.file-category.delete')])

@endsection
