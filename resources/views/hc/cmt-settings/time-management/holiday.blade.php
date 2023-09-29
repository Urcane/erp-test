@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Time Off')

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
                <form id="modal_create_holiday" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="modal_create_time_off_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_create_time_off_header"
                        data-kt-scroll-wrappers="#modal_create_time_off_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Tambah Hari Libur</span>
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
                                    <span class="required fw-bold">Start Date</span>
                                </label>
                                <input type="date" class="form-control form-control-solid"
                                    required name="start_date">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">End Date</span>
                                </label>
                                <input type="date" class="form-control form-control-solid"
                                    required name="end_date">
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
                            <h4>Holiday</h4>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div>
                                <a href="#modal_create_time_off" data-bs-toggle="modal"
                                    class="btn btn-info btn-sm me-3 btn_tambah_holiday">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Holiday
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                            <div class="d-flex justify-content-end mb-2">
                                <div class="input-group w-150px w-md-250px">
                                    <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
                                    <input class="form-control form-control-solid form-control-sm" autocomplete="off" name="range_date"
                                        id="range_date">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="tb_holiday">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-400px">Name</th>
                                            <th class="w-150px">Start Date</th>
                                            <th class="w-150px">End Date</th>
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
    let dataTableHoliday;

    $(document).ready(function() {
        function deleteTimeOff(id) {
            $.ajax({
                url: "{{ route('hc.setting.holiday.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    dataTableHoliday.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        }

        dataTableHoliday = $('#tb_holiday').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            buttons: [],
            ajax: {
                url: "{{ route('hc.setting.holiday-get-table') }}",
                data: function(data) {
                    data.range_date = $('#range_date').val()
                }
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
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'start_date',
                    render: function(data) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    data: 'end_date',
                    render: function(data) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false
                },
            ],

            columnDefs: [{
                targets: 0,
                className: 'text-center',
            }],
        });

        $('input[name="range_date"]').daterangepicker({
            autoUpdateInput: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, (from_date, to_date) => {
            $('#range_date').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format(
                'MM/DD/YYYY'));
        });

        $('#range_date').on('apply.daterangepicker', function(ev, picker) {
            dataTableHoliday.draw();
        });

        $('#modal_create_holiday').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('hc.setting.holiday.createUpdate') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    dataTableHoliday.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $(".btn_tambah_holiday").on("click", function() {
            $("input").val("")
        })
    });
</script>
@endsection
