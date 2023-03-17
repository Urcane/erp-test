@extends('layouts.app')
@section('title','CMT-EMP')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <span class="fs-7 fw-bolder text-dark pe-4 text-nowrap d-none d-lg-block">List Karyawan</span>
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_department" id="filter_department">
                                    <option value="*" selected>All Deparment</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_divisi" id="filter_divisi">
                                    <option value="*" selected>All Divisi</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_level" id="filter_level">
                                    <option value="*" selected>Level</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="#kt_modal_tambah_karyawan" data-bs-toggle="modal" class="btn btn-primary btn-sm me-2 btn_tambah_karyawan"><i class="fa-solid fa-plus me-1"></i>Karyawan Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_pegawai">
                                    <thead>
                                        <tr class="fw-bold fs-7 text-muted text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="">Karyawan</th>
                                            <th class="w-100px">NIK</th>
                                            <th class="w-150px">Kontak</th>
                                            <th class="w-150px">Department</th>
                                            <th class="w-150px">Divisi</th>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <span class="fs-7 fw-bolder text-dark pe-4 text-nowrap d-none d-lg-block">List Karyawan</span>
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_department" id="filter_department">
                                    <option value="*" selected>All Deparment</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_divisi" id="filter_divisi">
                                    <option value="*" selected>All Divisi</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_level" id="filter_level">
                                    <option value="*" selected>Level</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="#kt_modal_tambah_karyawan" data-bs-toggle="modal" class="btn btn-primary btn-sm me-2 btn_tambah_karyawan"><i class="fa-solid fa-plus me-1"></i>Karyawan Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_pegawai">
                                    <thead>
                                        <tr class="fw-bold fs-7 text-muted text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="">Karyawan</th>
                                            <th class="w-100px">NIK</th>
                                            <th class="w-150px">Kontak</th>
                                            <th class="w-150px">Department</th>
                                            <th class="w-150px">Divisi</th>
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
    </div>
</div>

@include('cmt-employee.add.modal-tambah-karyawan')

<script>
    $(document ).ready(function() {
        
        window.tableDisc  = $('#kt_table_pegawai')
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            ajax: {
                url : "{{route('hc.emp-get-table-employee')}}"
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +
            
            "<'table-responsive'tr>" +
            
            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",
            
            columns: [
            { data: 'DT_RowIndex'},
            { data: 'emp'},
            { data: 'nip',},
            { data: 'kontak',},
            { data: 'dept',},
            { data: 'div',},
            { data: 'action'},
            ],
            
            columnDefs: [
            {
                targets: 0,
                searchable : false,
                className: 'text-center',
            },
            {
                targets: 3,
                searchable : false,
                orderable : false,
                className : 'text-center',
            },
            {
                targets: -1,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });

        $('body').on('click', '.btn_tambah_karyawan', function () {
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_tambah_karyawan_form').trigger("reset")
        });

        $("#kt_modal_tambah_karyawan_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama lengkap karyawan wajib diisi</span>",
                },
                email: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Email user wajib diisi</span>",
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                },
                nip: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIP karyawan wajib diisi</span>",
                },
                nik: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIK karyawan wajib diisi</span>",
                },
                kontak: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Kontak karyawan wajib diisi</span>",
                },
                role_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Role wajib dipilih</span>",
                },
                division_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Divisi wajib dipilih</span>",
                },
                team_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Penempatan wajib dipilih</span>",
                },
                new_password: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Password minimal memiliki 8 karakter</span>",
                    confirmed: "<span class='fw-semibold fs-8 text-danger'>Password tidak sama</span>",
                },
                new_password_confirmation: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password minimal memiliki 8 karakter</span>",
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    data: $('#kt_modal_tambah_karyawan_form').serialize(),
                    url: '{{route("hc.emp.store")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_tambah_karyawan_cancel').click();
                        var oTable = $('#kt_table_pegawai').dataTable();
                        oTable.fnDraw(false);
                        toastr.success('Karyawan baru berhasil ditambahkan','Selamat !');
                    },
                    error: function (xhr, status, errorThrown) {
                        // if (JSON.parse(xhr.responseText).errors.name) {
                        //     toastr.error('Nama user wajib diisi', 'Opps!');
                        // }else if (JSON.parse(xhr.responseText).errors.email) {
                        //     toastr.error('Email user wajib diisi/telah terdaftar', 'Opps!');
                        // }else if (JSON.parse(xhr.responseText).errors.role_id) {
                        //     toastr.error('Role user wajib dipilih', 'Opps!');
                        // }else if (JSON.parse(xhr.responseText).errors.new_password) {
                        //     toastr.error('Password tidak sama', 'Opps!');
                        // }else if (JSON.parse(xhr.responseText).errors.new_password_confirmation) {
                        //     toastr.error('Password tidak sama', 'Opps!');
                        // }else {
                        //     toastr.error(errorThrown ,'Opps!');
                        // }
                        toastr.error('Terjadi kesalahan' ,'Opps!');
                    }
                });
            }
        });
        
    });
</script>

@endsection
