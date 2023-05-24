@extends('layouts.app')
@section('title-apps','CMT-EMP')
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
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Pegawai</span>
                            </div>
                            <div class="col-lg-6 text-end">
                                <button type="button" class="btn btn-light-info btn-sm me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-filter me-2"></i>Filter</button>
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
                                            <button class="btn btn-sm btn-light" id="btn_reset_filter">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <a href="#kt_modal_tambah_pegawai" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Pegawai Baru</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_pegawai">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="">Pegawai</th>
                                            <th class="w-150px">NIP</th>
                                            <th class="w-150px">Kontak</th>
                                            <th class="w-150px">Departemen</th>
                                            <th class="w-150px">Divisi</th>
                                            <th class="w-100px">#</th>
                                            <th class="">Nama Pegawai</th>
                                            <th class="">Email</th>
                                            <th class="">NIK</th>
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

@include('cmt-employee.add.modal-tambah-pegawai')

<script>
    $(document ).ready(function() {

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
                    columns: [0,7,8,2,9,3,4,5]
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
                targets: 6,
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
        
        
        $('body').on('click', '.btn_tambah_pegawai', function () {
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_tambah_pegawai_form').trigger("reset")
            $('#kt_modal_tambah_pegawai_submit').removeAttr('disabled','disabled');
        });
        
        $("#kt_modal_tambah_pegawai_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama lengkap pegawai wajib diisi</span>",
                },
                email: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Email user wajib diisi</span>",
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                },
                nip: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIP pegawai wajib diisi</span>",
                },
                nik: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIK pegawai wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>NIK minimal memiliki 16 karakter</span>",
                },
                kontak: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Kontak pegawai wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Kontak tidak sesuai format</span>",
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
        
    });
</script>

@endsection
