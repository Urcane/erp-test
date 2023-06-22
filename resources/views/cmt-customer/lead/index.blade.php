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
                            <div class="col-lg-6 gap-3 d-flex align-items-center">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Lead/Prospek</span>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div class="input-group w-150px w-md-250px mx-4">
                                    <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
                                    <input class="form-control form-control-solid form-control-sm" autocomplete="off" name="range_date" id="range_date">
                                </div>
                                @role('administrator')
                                <div class="tab_all_menu_lead">
                                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-gear me-2"></i>Mass Action</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px text-start pb-3" id="action_lead" data-kt-menu="true" style="">
                                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Mass Action Options</span>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        <div class="menu-item px-3">
                                            <a href="#kt_modal_tindak_lanjut_lead" data-bs-toggle="modal" class="menu-link" id="btn_tindak_lanjut_lead">
                                                <span class="menu-icon">
                                                    <i class="fa-solid fa-building-circle-check text-gray-500"></i>
                                                </span>
                                                <span class="menu-title text-dark">Tindak Lanjut (Prospek)</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_all_menu_prospect" style="display:none">
                                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-gear me-2"></i>Mass Action</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px text-start pb-3" id="action_prospect" data-kt-menu="true" style="">
                                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Mass Action Options</span>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        <div class="menu-item px-3">
                                            <a href="#kt_modal_batal_prospect" data-bs-toggle="modal" class="menu-link" id="btn_batal_prospect">
                                                <span class="menu-icon">
                                                    <i class="fa-solid fa-building-circle-xmark text-danger"></i>
                                                </span>
                                                <span class="menu-title text-danger">Tutup/Batal Prospek</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endrole
                                {{-- <div class="tab_all_menu_lead">
                                    <button type="button" class="btn btn-light-info btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-filter me-2"></i>Filter</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px text-start" id="filter_pegawai" data-kt-menu="true" style="">
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
                                </div> --}}
                                @role('administrator')
                                <div class="tab_all_menu_lead">
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
                                                            <th class="w-250px">Perusahaan</th>
                                                            <th class="w-150px">Sales</th>
                                                            <th class="w-100px">Lead From</th>
                                                            <th class="w-100px">Client Type</th>
                                                            <th class="">Kontak</th>
                                                            <th class="w-100px">Status</th>
                                                            <th class="w-100px">Created</th>
                                                            <th class="w-100px text-center">#</th>
                                                            <th class="" hidden>Tahun</th>
                                                            <th class="" hidden>Tanggal</th>
                                                            <th class="" hidden>Week Number</th>
                                                            <th class="" hidden>Company Name</th>
                                                            <th class="" hidden>Kota/Kabupaten</th>
                                                            <th class="" hidden>Alamat</th>
                                                            <th class="" hidden>Lat</th>
                                                            <th class="" hidden>Lng</th>
                                                            <th class="" hidden>Contact Name</th>
                                                            <th class="" hidden>Email</th>
                                                            <th class="" hidden>Job Position</th>
                                                            <th class="" hidden>Phone/WA</th>
                                                            <th class="" hidden>Status</th>
                                                            <th class="" hidden>Note</th>
                                                            <th class="" hidden>Next Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-7">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_prospect_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_prospect">
                                                    <thead class="">
                                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="text-center w-50px">#</th>
                                                            <th class="w-200px">Perusahaan</th>
                                                            <th class="w-200px">Title</th>
                                                            <th class="w-150px">Penindaklanjut</th>
                                                            <th class="">Progress</th>
                                                            <th class="w-150px">Next Action</th>
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
            </div>
        </div>
    </div>
</div>

@role('administrator')
@include('cmt-customer.lead.add.modal-tambah-lead')
@include('cmt-customer.lead.add.modal-edit-lead')
@include('cmt-customer.lead.add.modal-tindak-lanjut-lead')
@include('cmt-customer.lead.add.modal-update-prospect')
@include('cmt-customer.lead.add.modal-batal-prospect')
@endrole

<script>
    $(document ).ready(function() {
        function onlyUnique(value, index, array) {
            return array.indexOf(value) === index;
        }

        $('input[name="range_date"]').daterangepicker({autoUpdateInput: false}, (from_date, to_date) => {
            $('#range_date').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
        }); 
        
        var lead_ids = [];
        var prospect_ids = [];
        
        $('body').on('click', '#tab_all', function () {
            $('.tab_all_menu_lead').show();
            $('.tab_all_menu_prospect').hide();
        });
        $('body').on('click', '#tab_prospect', function () {
            $('.tab_all_menu_lead').hide();
            $('.tab_all_menu_prospect').show();
        });
        
        window.tableLead  = $('#kt_table_lead')
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            drawCallback: function () {
                lead_ids = [];
                $('#kt_table_lead').on('click', 'input[name=\'checkbox_lead_ids\']', function () {
                    if($(this).is(":checked")){
                        lead_ids.push($(this).val());
                    } else {
                        removeFrom(lead_ids, $(this).val());
                    }
                });
            },
            ajax: {
                url : "{{route('com.lead.get-table-lead')}}",
                data: function(data) {
                    data.filters = {
                        'range_date': $('#range_date').val(),
                    }
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
                title: 'Data Lead Comtelindo',
                exportOptions: {
                    columns: [1,10,11,12,3,4,13,5,14,16,17,15,18,19,20,21,22,23,24]
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
            { data: 'customer'},
            { data: 'sales_name'},
            { data: 'lead_reference_name',},
            { data: 'bussines_type_name',},
            { data: 'kontak', orderable: false, searchable: false},
            { data: 'status',},
            { data: 'created_at',},
            { data: 'action'},
            { data: 'lead_year', visible:false},
            { data: 'lead_date', visible:false},
            { data: 'lead_week_number', visible:false},
            { data: 'lead_company_name', visible:false},
            { data: 'lead_company_city', visible:false},
            { data: 'lead_company_address', visible:false},
            { data: 'lead_company_lat', visible:false},
            { data: 'lead_company_lng', visible:false},
            { data: 'lead_company_contact_name', visible:false},
            { data: 'lead_company_contact_email', visible:false},
            { data: 'lead_company_contact_job', visible:false},
            { data: 'lead_company_contact_phone', visible:false},
            { data: 'lead_status', visible:false},
            { data: 'lead_note', visible:false},
            { data: 'lead_next_action', visible:false},
            ],  
            columnDefs: [
            {
                targets: 0,
                className: 'text-center',
            },
            {
                targets: 1,
                className: 'text-center',
            },
            {
                targets: 9,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });

        $('#range_date').on('apply.daterangepicker', function(ev, picker) {
            tableLead.draw();
            tableProspect.draw();
        });
        
        function removeFrom(array, item) {
            var index = array.indexOf(item);
            if (index !== -1) array.splice(index, 1);
        }
        
        function removeFromProspect(array, item) {
            var index = array.indexOf(item);
            // Dont Use its a trap
            while (index !== -1) array.splice(index, 1);
        }
        
        window.tableProspect  = $('#kt_table_prospect')
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            drawCallback: function () {
                prospect_ids = [];
                $('#kt_table_prospect').on('click', 'input[name=\'checkbox_prospect_ids\']', function () {
                    if($(this).is(":checked")){
                        prospect_ids.push($(this).val());
                    } else {
                        removeFrom(prospect_ids, $(this).val());
                    }
                    // console.log(prospect_ids);
                });
            },
            ajax: {
                url : "{{route('com.prospect.get-table-prospect')}}",
                data: function(data) {
                    data.filters = {
                        'range_date': $('#range_date').val(),
                    }
                }
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
            { data: 'DT_RowChecklist', orderable: false, searchable: false},
            { data: 'DT_RowIndex'},
            { data: 'customer'},
            { data: 'prospect_title'},
            { data: 'sales_name'},
            { data: 'progress', orderable: false, searchable: false},
            { data: 'next_action', orderable: false, searchable: false},
            { data: 'action'},
            ],  
            columnDefs: [
            {
                targets: 0,
                className: 'text-center',
            },
            {
                targets: 1,
                className: 'text-center',
            },
            {
                targets: -1,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
        
        $('body').on('click', '.btn_tambah_lead', function () {
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_tambah_lead_form').trigger("reset")
            $('#kt_modal_tambah_lead_submit').removeAttr('disabled','disabled');
        });
        $("#kt_modal_tambah_lead_form").validate({
            messages: {
                customer_name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama Perusahaan/Badan Usaha wajib diisi</span>",
                },
                bussines_type_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Jenis bisnis wajib dipilih</span>",
                },
                lead_reference_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Referensi lead wajib dipilih</span>",
                },
                customer_address: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Alamat perusahaan/badan usaha wajib diisi</span>",
                },
                city_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Kota perusahaan/badan usaha wajib dipilih</span>",
                },
                customer_contact_name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama wajib diisi</span>",
                },
                customer_contact_job: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Jabatan wajib diisi</span>",
                },
                customer_contact_email: {
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                },
                customer_contact_phone: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nomor wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Kontak tidak sesuai format</span>",
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_tambah_lead_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("com.lead.store-lead")}}',
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
        
        $('table').on('click', '.btn_edit_lead', function () {
            $('.drop-data').val("").trigger("change")
            $('#kt_modal_edit_lead_form').trigger("reset")
            $('#kt_modal_edit_lead_submit').removeAttr('disabled','disabled');
            var id = $(this).data('id')
            var form_edit = $('#kt_modal_edit_lead_form')
            $.get(`{{url('')}}/cmt-lead/get-data/edit/lead/${id}`, function (data) {
                form_edit.find("input[name='lead_id']").val(id)
                form_edit.find("input[name='customer_name']").val(data.customer_name)
                form_edit.find("select[name='bussines_type_id']").val(data.bussines_type_id).trigger('change');
                form_edit.find("select[name='lead_reference_id']").val(data.lead_reference_id).trigger('change');
                form_edit.find("textarea[name='customer_address']").val(data.customer_address)
                form_edit.find("select[name='city_id']").val(data.city_id).trigger('change');
                form_edit.find("input[name='lat']").val(data.lat)
                form_edit.find("input[name='lng']").val(data.lng)
                form_edit.find("input[name='customer_contact_name']").val(data.customer_contact_name)
                form_edit.find("input[name='customer_contact_job']").val(data.customer_contact_job)
                form_edit.find("input[name='customer_contact_email']").val(data.customer_contact_email)
                form_edit.find("input[name='customer_contact_phone']").val(data.customer_contact_phone)
            })
        });
        $("#kt_modal_edit_lead_form").validate({
            messages: {
                customer_name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama Perusahaan/Badan Usaha wajib diisi</span>",
                },
                customer_bussines_type: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Jenis bisnis wajib diisi</span>",
                },
                reference_from: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Referensi lead wajib diisi</span>",
                },
                customer_address: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Alamat perusahaan/badan usaha wajib diisi</span>",
                },
                customer_city: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Kota perusahaan/badan usaha wajib diisi</span>",
                },
                customer_contact_name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama wajib diisi</span>",
                },
                customer_contact_job: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Jabatan wajib diisi</span>",
                },
                customer_contact_email: {
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                },
                customer_contact_phone: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nomor wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Kontak tidak sesuai format</span>",
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_edit_lead_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("com.lead.update-lead")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_edit_lead_cancel').click();
                        var oTable = $('#kt_table_lead').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_edit_lead_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });
        
        $('body').on('click', '#btn_tindak_lanjut_lead', function () {
            $('#kt_modal_tindak_lanjut_lead_submit').removeAttr('disabled','disabled');
            $('#containerTindakLanjutLead').html('');
            const form_edit = $('#kt_modal_tindak_lanjut_lead_form');
            $.each(lead_ids.filter(onlyUnique), function(index, rowId) {
                form_edit.find('#containerTindakLanjutLead').append(
                $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'lead_id[]')
                .val(rowId)
                );
            });
        });
        $("#kt_modal_tindak_lanjut_lead_form").validate({
            messages: {
                prospect_next_action: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Next Action wajib diisi</span>",
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_tindak_lanjut_lead_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("com.lead.tindak-lanjut-lead")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_tindak_lanjut_lead_cancel').click();
                        toastr.success(data.status,'Selamat 🚀 !');
                        location.reload();
                        
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_tindak_lanjut_lead_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });
        
        $('table').on('click', '.btn_update_prospect', function () {
            $('#kt_modal_update_prospect_form').trigger("reset")
            $('#kt_modal_update_prospect_submit').removeAttr('disabled','disabled');
            var id = $(this).data('id')
            var prospectId = $(this).data('prospectid')
            var form_edit = $('#kt_modal_update_prospect_form')
            $.get(`{{url('')}}/cmt-lead/get-data/edit/lead/${id}`, function (data) {
                form_edit.find("input[name='customer_prospect_id']").val(prospectId);
                form_edit.find("input[name='lead_id']").val(id);
            })
        });
        $("#kt_modal_update_prospect_form").validate({
            messages: {
                prospect_next_action: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Next Action wajib diisi</span>",
                },
                prospect_update: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Note/Update wajib diisi</span>",
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_update_prospect_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("com.lead.update-prospect")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_update_prospect_cancel').click();
                        var oTable = $('#kt_table_prospect').dataTable();
                        oTable.fnDraw(false);
                        prospect_ids = [];
                        toastr.success(data.status,'Selamat 🚀 !');
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_update_prospect_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });
        
        $('body').on('click', '#btn_batal_prospect', function () {
            $('#kt_modal_batal_prospect_submit').removeAttr('disabled','disabled');
            $('#containerBatalProspect').html('');
            const form_edit = $('#kt_modal_batal_prospect_form');
            $.each(prospect_ids, function(index, rowId) {
                form_edit.find('#containerBatalProspect').append(
                $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'prospect_id[]')
                .val(rowId)
                );
            });
        });
        $("#kt_modal_batal_prospect_form").validate({
            messages: {
                prospect_update: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Alasan pembatalan wajib diisi</span>",
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_modal_batal_prospect_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false, 
                    url: '{{route("com.lead.batal-prospect")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_batal_prospect_cancel').click();
                        toastr.success(data.status,'Selamat 🚀 !');
                        location.reload();
                        
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_modal_batal_prospect_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });
        
    });
</script>

@endsection
