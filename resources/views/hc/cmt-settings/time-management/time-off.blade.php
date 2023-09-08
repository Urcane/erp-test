@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Time Of')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="modal fade" id="modal_create_time_off" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_create_time_off_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="scroll-y me-n10 pe-10" id="modal_create_time_off_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_create_time_off_header"
                            data-kt-scroll-wrappers="#modal_create_time_off_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Tambah Kategori Time Off</span>
                                    {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Nama</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Name"
                                        required name="name">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Code</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Code"
                                        required name="code">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Effective Date</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid"
                                        required name="effective_date">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Expired Date</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid"
                                        name="expired_date">
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_create_time_off_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_create_time_off_submit" class="btn btn-sm btn-info w-lg-200px">
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
                    @include('hc.cmt-settings.sidebar')
                </div>
                <div class="col-lg-9 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-6 mb-9">
                                <h4>Time Off</h4>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div>
                                    <a href="#modal_create_time_off" data-bs-toggle="modal"
                                        class="btn btn-info btn-sm me-3 btn-add-category">
                                        <i class="fa-solid fa-plus"></i>
                                        Add Category
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                                <div class="col-lg-12">
                                    <table class="table align-top table-striped border table-rounded gy-5" id="tb_timeoff">
                                        <thead class="">
                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                <th class="text-center w-50px">#</th>
                                                <th class="w-150px">Name</th>
                                                <th class="w-150px">Code</th>
                                                <th class="w-150px">Effective Date</th>
                                                <th class="w-150px">Expire Date</th>
                                                {{-- <th class="w-150px">Expired Date</th>
                                                <th class="w-150px">Assigned To</th> --}}
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
        let dataTableTimeOff;

        $(document).ready(function() {
            function deleteTimeOff(id) {
                $.ajax({
                    url: "{{ route('hc.setting.timeoff.delete') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        dataTableTimeOff.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            }

            dataTableTimeOff = $('#tb_timeoff').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                buttons: [],
                ajax: {
                    url: "{{ route('hc.setting.timeoff-get-table') }}",
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

                columns: [
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'effective_date'
                    },
                    {
                        data: 'expired_date'
                    },
                    // { data: 'effective_date'},
                    // { data: 'expired_date'},
                    // { data: 'assigned_to'},
                    {
                        data: 'action'
                    },
                ],

                columnDefs: [{
                    targets: 0,
                    className: 'text-center',
                }],
            });

            $(".btn-add-category").on("click", function() {
                $("input").val("")
            })

            $('#modal_create_time_off_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('hc.setting.timeoff.createUpdate') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        dataTableTimeOff.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });
        });
    </script>
@endsection
