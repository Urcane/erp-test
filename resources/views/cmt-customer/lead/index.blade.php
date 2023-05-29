@extends('layouts.app')
@section('title-apps','CMT-LEAP')
@section('sub-title-apps','Commercial')
@section('desc-apps','Lead Dulu Prospek Kemudian')
@section('icon-apps','fa-solid fa-paper-plane')

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
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Lead/Prospek</span>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                @role('administrator')
                                <div class="tab_all_menu">
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
                                <div class="tab_all_menu">
                                    <button type="button" class="btn btn-light-info btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-filter me-2"></i>Filter</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px text-start" id="filter_pegawai" data-kt-menu="true" style="">
                                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Filter Options</span>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        <div class="row px-8 pb-6">
                                            {{-- <div class="col-lg-12 mb-3">
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
                                            </div> --}}
                                            <div class="col-lg-12 mt-6 text-end">
                                                <button class="btn btn-sm btn-light" id="btn_reset_filter">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @role('administrator')
                                <div class="tab_all_menu">
                                    <a href="#kt_modal_tambah_lead" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_lead"><i class="fa-solid fa-plus"></i>Lead Baru</a>
                                </div>
                                @endrole
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-6 hover-scroll-x">
                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="tab_all" href="#tab_all_content">Lead</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="tab_prospect" href="#tab_prospect_content">Prospected</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tab_all_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_lead">
                                                    <thead class="">
                                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="w-300px">Perusahaan</th>
                                                            <th class="w-150px">Sales</th>
                                                            <th class="w-100px">Referensi</th>
                                                            <th class="">Kontak</th>
                                                            <th class="w-150px">Status</th>
                                                            <th class="w-100px">Created</th>
                                                            <th class="w-100px text-center">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-7">
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center">1</td>
                                                            <td>
                                                                <span class="fw-bold d-block">PT. Nama Perusahaan</span>
                                                                <p class="text-gray-500 mb-0">Alamat Perusahaan yang panjang itu nah nda tau lagi aku</p>
                                                                <span class="text-gray-500">Balikpapan</span>
                                                            </td>
                                                            <td>Nama Sales</td>
                                                            <td>Internal</td>
                                                            <td>
                                                                <span class="mb-0 fw-bold d-block">Nama Kontak</span>
                                                                <span class="text-gray-500 d-block">+62093801980</span>
                                                                <u class="text-primary"><a href="#!" class="text-primary fs-8" data-bs-toggle="modal">Tampilan kontak lain</a></u>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-light-primary px-3 py-2">Lead</span>
                                                            </td>
                                                            <td>5/26/2023 18:10:20</td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_prospect_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_lead">
                                                    <thead class="">
                                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="w-300px">Perusahaan</th>
                                                            <th class="w-150px">Penindaklanjut</th>
                                                            <th class="">Progress</th>
                                                            <th class="w-150px">Next Action</th>
                                                            <th class="w-100px text-center">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-7">
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center">1</td>
                                                            <td>
                                                                <span class="fw-bold d-block">PT. Nama Perusahaan</span>
                                                                <p class="text-gray-500 mb-0">Alamat Perusahaan yang panjang itu nah nda tau lagi aku</p>
                                                                <span class="text-gray-500">Balikpapan</span>
                                                            </td>
                                                            <td>Nama Sales</td>
                                                            <td>
                                                                <div class="timeline">
                                                                    <div class="timeline-item">
                                                                        <div class="timeline-line w-35px"></div>
                                                                        <div class="timeline-icon symbol symbol-circle symbol-35px">
                                                                            <div class="symbol-label bg-light-warning">
                                                                                <i class="fa-solid fa-clock text-warning"></i>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-content">
                                                                            <div class="pe-5">
                                                                                <span class="fw-bold d-block">Follow up Pak Rudi Tabuti terkait BOQ</span>
                                                                                <p class="text-gray-500 mb-0">Updated : 5/29/23 18:20:20</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Gatau apa
                                                            </td>
                                                            <td></td>
                                                        </tr>
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
        </div>
    </div>
</div>

@role('administrator')
@include('cmt-customer.lead.add.modal-tambah-lead')
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
        
        // $('body').on('click', '#tab_all', function () {
        //     $('.tab_all_menu').show();
        // });
        // $('body').on('click', '#tab_prospect', function () {
        //     $('.tab_all_menu').hide();
        // });
        
        window.tablePegawai  = $('#kt_table_lead')
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
        
        $('body').on('click', '.btn_tambah_lead', function () {
            $('#kt_modal_tambah_lead_form').trigger("reset")
            $('#kt_modal_tambah_lead_submit').removeAttr('disabled','disabled');
        });
        
        $("#kt_modal_tambah_lead_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama lengkap pegawai wajib diisi</span>",
                },
                email: {
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
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_tambah_lead_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("hc.emp.store")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_tambah_lead_cancel').click();
                        var oTable = $('#kt_table_lead').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_tambah_lead_submit').removeAttr('disabled','disabled');
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
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("hc.emp.update-status")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_nonaktif_pegawai_cancel').click();
                        var oTable = $('#kt_table_lead').dataTable();
                        pegawai_ids = [];
                        oTable.fnDraw(false);
                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_nonaktif_pegawai_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
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
                        $('#kt_modal_reset_password_pegawai_cancel').click();
                        var oTable = $('#kt_table_lead').dataTable();
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
