@extends('layouts.app')
@section('title-apps','Employee')
@section('sub-title-apps','HC & Legal')
@section('desc-apps','Database Pegawai Comtelindo')
@section('icon-apps','fa-solid fa-users')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('summary-page')
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataUser->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Pegawai</span>
</div>
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataDivision->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Divisi</span>
</div>
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="modal fade" id="modal_import_emp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_import_emp_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="modal_import_emp_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_import_emp_header"
                        data-kt-scroll-wrappers="#modal_import_emp_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Job Level</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Name"
                                    required name="name">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_import_emp_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_import_emp_submit"
                            class="btn btn-sm btn-info w-lg-200px">
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Pegawai</span>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                @role('administrator')
                                <div>
                                    <a href="#modal_import_emp" data-bs-toggle="modal" class="btn btn-light-success btn-sm me-3 btn_tambah_job_level"><i class="fa-solid fa-plus"></i>Import Employee</a>
                                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-gear me-2"></i>Mass Action</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px text-start pb-3" id="action_pegawai" data-kt-menu="true" style="">
                                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Mass Action Options</span>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        <div class="menu-item px-3">
                                            <a href="#kt_modal_nonaktif_pegawai" data-bs-toggle="modal" class="menu-link" id="btn_nonaktif_pegawai">
                                                <span class="menu-icon">
                                                    <i class="fa-solid fa-user-xmark text-danger"></i>
                                                </span>
                                                <span class="menu-title text-danger">Non Aktif Pegawai</span>
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#kt_modal_reset_password_pegawai" data-bs-toggle="modal" class="menu-link" id="btn_reset_password_pegawai">
                                                <span class="menu-icon">
                                                    <i class="fa-solid fa-key text-gray-500"></i>
                                                </span>
                                                <span class="menu-title text-dark">Reset Password</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endrole
                                <div>
                                    <button type="button" class="btn btn-light-info btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-filter me-2"></i>Filter</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px text-start" id="filter_pegawai" data-kt-menu="true" style="">
                                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Filter Options</span>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        <div class="row px-8 pb-6">
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 mb-2">
                                                    <span class="fw-bold textd-dark">Department</span>
                                                </label>
                                                <select class="form-select form-select-sm form-select-solid" data-control="select2" required name="filterDepartment" id="filter_department" data-dropdown-parent="#filter_pegawai">
                                                    <option value="*">Semua Department</option>
                                                    @foreach ($dataDepartment as $dp)
                                                    <option value="{{$dp->id}}">{{$dp->department_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 mb-2">
                                                    <span class="fw-bold textd-dark">Divisi</span>
                                                </label>
                                                <select class="form-select form-select-sm form-select-solid" data-control="select2" required name="filterDivisi" id="filter_divisi" data-dropdown-parent="#filter_pegawai">
                                                    <option value="*">Semua Divisi</option>
                                                    @foreach ($dataDivision as $dd)
                                                    <option value="{{$dd->id}}">{{$dd->divisi_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mt-6 text-end">
                                                <button class="btn btn-sm btn-warning" id="btn_reset_filter">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @role('administrator')
                                <div>
                                    <a href="{{ route('hc.emp.create') }}" class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Pegawai Baru</a>
                                </div>
                                @endrole
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_pegawai">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="text-center w-50px">#</th>
                                            <th class="">Pegawai</th>
                                            <th class="w-150px">NIP</th>
                                            <th class="w-150px">Kontak</th>
                                            <th class="w-150px">Departemen</th>
                                            <th class="w-1 50px">Divisi</th>
                                            <th class="w-100px">#</th>
                                            <th class="" hidden>Nama Pegawai</th>
                                            <th class="" hidden>Email</th>
                                            <th class="" hidden>NIK</th>
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

@role('administrator')
{{-- @include('hc.cmt-employee.add.modal-tambah-pegawai') --}}
@include('hc.cmt-employee.add.modal-nonaktif-pegawai')
@include('hc.cmt-employee.add.modal-reset-password-pegawai')
@endrole

<script>
    $(document ).ready(function() {

        var pegawai_ids = [];

        var getFilter = function(){
            return {
                'filterDivisi': $('#filter_divisi').val(),
                'filterDepartment': $('#filter_department').val(),
            }
        }

        window.tablePegawai  = $('#kt_table_pegawai')
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            drawCallback: function () {
                $('body').on('click', 'input[name=\'pegawai_ids\']', function () {
                    if($(this).is(":checked")){
                        pegawai_ids.push($(this).val());
                    } else {
                        removeFrom(pegawai_ids, $(this).val());
                    }
                });
            },
            ajax: {
                url : "{{route('hc.emp.get-table-employee')}}",
                data: function(data){
                    data.filters = getFilter()
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            buttons: [
            {
                extend: 'excel',
                className: 'btn btn-light-success btn-sm ms-3',
                title: 'Data Pegawai Comtelindo',
                exportOptions: {
                    columns: [1,8,9,3,10,4,5,6]
                }
            },
            ],
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
            { data: 'emp'},
            { data: 'nip',},
            { data: 'kontak',},
            { data: 'dept',},
            { data: 'div',},
            { data: 'action'},
            { data: 'name', visible: false},
            { data: 'email', visible: false},
            { data: 'nik', visible: false},
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
                targets: 7,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });

        $('#filter_department').change(function(){
            tablePegawai.draw()
        });
        $('#filter_divisi').change(function(){
            tablePegawai.draw()
        });
        $('body').on('click', '#btn_reset_filter', function () {
            $('#filter_department').val("*").trigger("change")
            $('#filter_divisi').val("*").trigger("change")
        });

        function removeFrom(array, item) {
            var index = array.indexOf(item);
            if (index !== -1) array.splice(index, 1);
        }

        // $('body').on('click', '.btn_tambah_pegawai', function () {
        //     $('.drop-data').val("").trigger("change")
        //     $('#kt_modal_tambah_pegawai_form').trigger("reset")
        //     $('#kt_modal_tambah_pegawai_submit').removeAttr('disabled','disabled');
        // });

        $("#kt_create_emp_form").validate({
            messages: {
                // first_name : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Nama Depan pegawai wajib diisi</span>",
                // },
                // email: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Email user wajib diisi</span>",
                //     email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                // },
                // birthdate :{
                //     required: "<span class='fw-semibold fs-8 text-danger'>Tanggal lahir pegawai wajib diisi</span>",
                // },
                // maritial_status :{
                //     required: "<span class='fw-semibold fs-8 text-danger'>Status pernihakahan pegawai wajib diisi</span>",
                // },
                // religion :{
                //     required: "<span class='fw-semibold fs-8 text-danger'>Agama pegawai wajib diisi</span>",
                // },
                // employee_id : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Nomor Induk Pegawai wajib diisi</span>",
                // }
                // employment_status : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Status pegawai dalam perusahaan wajib diisi</span>",
                // }
                // join_date : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Tanggal bergabung pegawai dalam perusahaan wajib diisi</span>",
                // }
                // end_status_date : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Tanggal berhenti pegawai dalam perusahaan wajib diisi</span>",
                // }
                // branch : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Cabang pegawai mendaftar dalam perusahaan wajib diisi</span>",
                // }
                // organization : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Organisasi pegawai dalam perusahaan wajib diisi</span>",
                // }
                // job_position : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Posisi pekerjaan pegawai dalam perusahaan wajib diisi</span>",
                // }
                // job_level : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Level pekerjaan pegawai dalam perusahaan wajib diisi</span>",
                // }
                // jht_cost : {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Level pekerjaan pegawai dalam perusahaan wajib diisi</span>",
                // }




                // nip: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>NIP pegawai wajib diisi</span>",
                // },
                // nik: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>NIK pegawai wajib diisi</span>",
                //     minlength: "<span class='fw-semibold fs-8 text-danger'>NIK minimal memiliki 16 karakter</span>",
                // },

                // role_id: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Role wajib dipilih</span>",
                // },
                // division_id: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Divisi wajib dipilih</span>",
                // },
                // team_id: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Penempatan wajib dipilih</span>",
                // },
                // new_password: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Password wajib diisi</span>",
                //     minlength: "<span class='fw-semibold fs-8 text-danger'>Password minimal memiliki 8 karakter</span>",
                //     confirmed: "<span class='fw-semibold fs-8 text-danger'>Password tidak sama</span>",
                // },
                // new_password_confirmation: {
                //     required: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password wajib diisi</span>",
                //     minlength: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password minimal memiliki 8 karakter</span>",
                // },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_tambah_pegawai_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '{{route("hc.emp.store")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_tambah_pegawai_cancel').click();
                        var oTable = $('#kt_table_pegawai').dataTable();
                        pegawai_ids = [];
                        oTable.fnDraw(false);
                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_tambah_pegawai_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });

        $('body').on('click', '#btn_nonaktif_pegawai', function () {


            $('#kt_modal_nonaktif_pegawai_submit').removeAttr('disabled','disabled');
            $('#containerUserNonAktif').html('');
            const form_edit = $('#kt_modal_nonaktif_pegawai_form');
            $.each(pegawai_ids, function(index, rowId) {
                form_edit.find('#containerUserNonAktif').append(
                $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'pegawai_id[]')
                .val(rowId)
                );
            });
        });

        $("#kt_modal_nonaktif_pegawai_form").validate({
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_nonaktif_pegawai_submit').attr('disabled', 'disabled');

                var form_edit = $('#kt_modal_nonaktif_pegawai_form');
            $.each(pegawai_ids, function(index, rowId) {
                form_edit.find('#containerUserNonAktif').append(
                $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'pegawai_id[]')
                .val(rowId)
                );
            });

                $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: '{{route("hc.emp.update-status")}}',
                type: "POST",
                dataType: 'json',
                success: function(data) {

                     // Check Selected Pegawai
                    if (pegawai_ids.length === 0) {
                        $('#kt_modal_nonaktif_pegawai_cancel').click();
                        toastr.error('Tidak Ada Data Pegawai Yang Dipilih', 'Opps!');
                        return;
                    }

                    $('#kt_modal_nonaktif_pegawai_cancel').click();
                    var oTable = $('#kt_table_pegawai').dataTable();
                    pegawai_ids = [];
                    oTable.fnDraw(false);
                    toastr.success(data.status, 'Selamat 🚀 !');
                },
                error: function(xhr, status, errorThrown) {
                    $('#kt_modal_nonaktif_pegawai_submit').removeAttr('disabled');
                    const data = JSON.parse(xhr.responseText);
                    toastr.error(errorThrown, 'Opps!');
                }
                });
            }
        });


        $('body').on('click', '#btn_reset_password_pegawai', function () {
            $('#kt_modal_reset_password_pegawai_submit').removeAttr('disabled','disabled');
            $('#containerResetPasswordPegawai').html('');
            const form_edit = $('#kt_modal_reset_password_pegawai_form');
            $.each(pegawai_ids, function(index, rowId) {
                form_edit.find('#containerResetPasswordPegawai').append(
                $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'pegawai_id[]')
                .val(rowId)
                );
            });
        });

        $("#kt_modal_reset_password_pegawai_form").validate({
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_reset_password_pegawai_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '{{route("hc.emp.reset-password-pegawai")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                         // Check Selected Pegawai
                        if (pegawai_ids.length === 0) {
                            $('#kt_modal_reset_password_pegawai_cancel').click();
                            toastr.error('Tidak Ada Password Pegawai Yang Dipilih', 'Opps!');
                            return;
                        }

                        $('#kt_modal_reset_password_pegawai_cancel').click();
                        var oTable = $('#kt_table_pegawai').dataTable();
                        pegawai_ids = [];
                        oTable.fnDraw(false);
                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_reset_password_pegawai_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });

    });
</script>

@endsection
