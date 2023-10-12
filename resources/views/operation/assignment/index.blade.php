@extends('layouts.app')
@section('title-apps', 'Assignment')
@section('sub-title-apps', 'Operation')
@section('desc-apps', 'Buat surat dulu, Jalan kemudian')
@section('icon-apps', 'fa-solid fa-file-alt')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="col-lg-12 row rounded">

                            <div class="flex-grow-1 text-center mb-6">
                                <span class="fs-4 text-uppercase fw-bolder text-dark d-none d-md-block">List Assignment</span>
                            </div>

                            {{-- <div class="row border rounded p-4 mb-4 justify-content-center">
                                <div class="col-3">
                                    <p class="fw-bold fs-6 mb-2">Present</p>
                                    <div class="ms-1 row">
                                        <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="on-time">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="on-time">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">On Time</div>
                                        </a>
                                        <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="late-clock-in">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="late-clock-in">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">Late Clock In</div>
                                        </a>
                                        <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="early-clock-out">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="early-clock-out">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">Early Clock Out</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-4">
                                    <p class="fw-bold fs-6 mb-2">Not Present</p>
                                    <div class="ms-1 row">
                                        <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="absent">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="absent">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">Absent</div>
                                        </a>
                                        <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="no-clock-in">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="no-clock-in">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">No Clock In</div>
                                        </a>
                                        <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="no-clock-out">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="no-clock-out">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">No Clock Out</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <p class="fw-bold fs-6 mb-2">Away</p>
                                    <div class="ms-1 row">
                                        <a class="col-4 summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="day-off">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="day-off">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">Day Off</div>
                                        </a>
                                        <div class="col-1"></div>
                                        <a class="col-4 summaries" href="#summaries_modal" data-bs-toggle="modal"
                                            data-param="time-off">
                                            <div class="text-info fw-bolder fs-4 mb-3" id="time-off">-</div>
                                            <div class="fw-semibold fs-7 text-gray-600">Time Off</div>
                                        </a>
                                        <div class="col-1"></div>
                                    </div>
                                </div>
                            </div> --}}

                            @can('OPR:create-department-assignment')
                                <div class="d-flex justify-content-end mb-5">
                                    <div>
                                        <a href="{{ route('opt.asign.create') }}" class="btn btn-info btn-sm me-3 btn_tambah_pegawai">
                                            <i class="fa-solid fa-plus"></i>
                                            Assignment Baru
                                        </a>
                                    </div>
                                </div>
                            @endcan

                            <div class="d-flex justify-content-end mb-2">
                                <div class="input-group w-150px w-md-250px mx-4">
                                    <span class="input-group-text border-0"><i
                                            class="fa-solid fa-magnifying-glass"></i></span>
                                    <input class="form-control form-control-solid form-control-sm" autocomplete="off"
                                        id="search">
                                </div>

                                <div class="input-group w-150px w-md-250px mx-4">
                                    <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
                                    <input class="form-control form-control-solid form-control-sm" autocomplete="off"
                                        name="range_date" id="range_date">
                                </div>

                                <div>
                                    <button type="button" class="btn btn-light-info btn-sm me-3"
                                        data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i
                                            class="fa-solid fa-filter me-2"></i>Filter</button>
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px text-start"
                                        id="filter_pegawai" data-kt-menu="true" style="">
                                        <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                            <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Filter Options</span>
                                        </div>
                                        <div class="separator mb-6"></div>
                                        <div class="row px-8 pb-6">
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 mb-2">
                                                    <span class="fw-bold textd-dark">Department</span>
                                                </label>
                                                <select class="form-select form-select-sm form-select-solid"
                                                    data-control="select2" required name="filterDepartment"
                                                    id="filter_department" data-dropdown-parent="#filter_pegawai">
                                                    <option value="*">Semua Department</option>
                                                    @foreach ($dataDepartment as $dp)
                                                        <option value="{{ $dp->id }}">{{ $dp->department_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 mb-2">
                                                    <span class="fw-bold textd-dark">Status</span>
                                                </label>
                                                <select class="form-select form-select-sm form-select-solid"
                                                    data-control="select2" required name="filterStatus"
                                                    id="filter_status" data-dropdown-parent="#filter_pegawai">
                                                    <option value="*">Semua Status</option>
                                                    @foreach ($assignmentStatus as $status)
                                                        <option value="{{ $status }}">{{ $status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mt-6 text-end">
                                                <button class="btn btn-sm btn-light"
                                                    id="btn_reset_filter">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table align-top border table-rounded gy-5" id="kt_table_assignment">
                                        <thead class="">
                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                                <th class="text-center w-50px">#</th>
                                                <th class="w-100px">Created At</th>
                                                <th class="w-150px">Project Name</th>
                                                <th class="w-150px">Created By</th>
                                                <th class="w-150px">Signed By</th>
                                                <th class="w-150px">Assignment Date</th>
                                                <th class="w-150px">Location</th>
                                                <th class="w-100px">Assigned</th>
                                                <th class="w-50px">Status</th>
                                                <th class="w-50px">#</th>
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

<script>
    const getFilter = () => {
        return {
            'filterDate': $('#range_date').val(),
            'search': $('#search').val(),
            'filterDepartment': $('#filter_department').val(),
            'filterStatus': $('#filter_status').val(),
        };
    };

    const cancelRequest = (id) => {
        $.ajax({
            url: "{{ route('opt.asign.cancel') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            data: {
                id
            },
            success: function(data) {
                toastr.success(data.message, 'Selamat 🚀 !');
                tableAssignment.draw();
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    }

    let tableAssignment;

    $(document).ready(function () {
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
            $('#range_date').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
        });

        $('#range_date').val(moment().subtract(29, 'days').format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));

        tableAssignment =  $('#kt_table_assignment')
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            drawCallback: function() {
                $('body').on('click', 'input[name=\'pegawai_ids\']', function() {
                    if ($(this).is(":checked")) {
                        pegawai_ids.push($(this).val());
                    } else {
                        removeFrom(pegawai_ids, $(this).val());
                    }
                });
            },
            ajax: {
                url: "{{ route('opt.asign.get-table-assignment') }}",
                data: function(data) {
                    data.filters = getFilter()
                },
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable": "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            buttons: [{
                extend: 'excel',
                className: 'btn btn-light-success btn-sm ms-3',
                title: 'Data Absen Pegawai Comtelindo',
                exportOptions: {
                    columns: [1]
                }
            }, ],
            dom: "<'row mb-2'" +
                "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                ">",

            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_by',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'signed_by',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'date',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'location',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'assigned',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [{
                targets: [0, 1, 7, 8],
                className: 'text-center',
            }, ],
        });

        $('#search').on('keyup', function(e) {
            if (e.keyCode === 13) {
                tableAssignment.draw();
            }
        });

        $('#range_date').on('apply.daterangepicker', function(ev, picker) {
            tableAssignment.draw();
        });

        $('#filter_department').on('change', function() {
            tableAssignment.draw();
        });

        $('#filter_status').on('change', function() {
            tableAssignment.draw();
        });

        $('#btn_reset_filter').on('click', function () {
            $('#filter_department').val("*").trigger('change');
            $('#filter_status').val("*").trigger('change');
        });
    });
</script>

@endsection
