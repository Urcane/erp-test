@extends('layouts.app')
@section('title-apps','CMT-Attendance')
@section('sub-title-apps','HC & Legal')
@section('desc-apps','Catatan Daftar Hadir Karyawan')
@section('icon-apps','fa-solid fa-calendar-days')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .summaries:hover {
        background-color: rgba(114, 57, 234, 0.1);
        border-radius: 10px;
        transition: background-color 0.2s ease, border-radius 0.2s ease;
    }
</style>
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="flex-grow-1 text-center mb-6">
                            <span class="fs-4 text-uppercase fw-bolder text-dark d-none d-md-block">List Attendance</span>
                        </div>

                        @include('hc.cmt-attendance.modal.summaries')

                        <div class="row border rounded p-4 mb-4 justify-content-center">
                            <div class="col-3">
                                <p class="fw-bold fs-6 mb-2">Present</p>
                                <div class="ms-1 row">
                                    <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="on-time">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="on-time">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">On Time</div>
                                    </a>
                                    <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="late-clock-in">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="late-clock-in">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">Late Clock In</div>
                                    </a>
                                    <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="early-clock-out">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="early-clock-out">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">Early Clock Out</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-4">
                                <p class="fw-bold fs-6 mb-2">Not Present</p>
                                <div class="ms-1 row">
                                    <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="absent">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="absent">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">Absent</div>
                                    </a>
                                    <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="no-clock-in">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="no-clock-in">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">No Clock In</div>
                                    </a>
                                    <a class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="no-clock-out">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="no-clock-out">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">No Clock Out</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-3">
                                <p class="fw-bold fs-6 mb-2">Away</p>
                                <div class="ms-1 row">
                                    <a class="col-4 summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="day-off">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="day-off">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">Day Off</div>
                                    </a>
                                    <div class="col-1"></div>
                                    <a class="col-4 summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="time-off">
                                        <div class="text-info fw-bolder fs-4 mb-3" id="time-off">-</div>
                                        <div class="fw-semibold fs-7 text-gray-600">Time Off</div>
                                    </a>
                                    <div class="col-1"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-2">
                            <div class="input-group w-150px w-md-250px mx-4">
                                <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input class="form-control form-control-solid form-control-sm" autocomplete="off" id="search_attendance">
                            </div>

                            <div class="input-group w-150px w-md-250px mx-4">
                                <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control form-control-solid form-control-sm" autocomplete="off" name="range_date" id="range_date">
                            </div>

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

                                        <div class="col-lg-12 mb-3">
                                            <label class="d-flex align-items-center fs-6 mb-2">
                                                <span class="fw-bold textd-dark">Status</span>
                                            </label>
                                            <select class="form-select form-select-sm form-select-solid" data-control="select2" required name="filterStatus" id="filter_status" data-dropdown-parent="#filter_pegawai">
                                                <option value="*">Semua Status</option>
                                                @foreach ($constants->filter_status_attendance as $status)
                                                    <option value="{{$status}}">{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-6 text-end">
                                            <button class="btn btn-sm btn-light" id="btn_reset_filter">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-top border table-rounded gy-5" id="kt_table_attendance">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                            <th class="text-center w-50px">#</th>
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-400px">Nama Pegawai</th>
                                            <div class="overflow-x-auto">
                                                <th class="w-150px">Nip</th>
                                                <th class="w-150px">Date</th>
                                                <th class="w-150px">Shift</th>
                                                <th class="w-150px text-center">Schedule In</th>
                                                <th class="w-150px text-center">Schedule Out</th>
                                                <th class="w-250px text-center">Clock In</th>
                                                <th class="w-250px text-center">Clock Out</th>
                                                <th class="w-150px">Overtime</th>
                                                <th class="w-150px">Attendance Code</th>
                                                <th class="w-150px">Time Off Code</th>
                                            </div>
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

@include('hc.cmt-attendance.modal.edit-attendance')
@include('hc.cmt-attendance.modal.delete-attendance')
@include('hc.cmt-attendance.modal.export-attendance')

<script>
    const attendanceCodeEnum = @json($constants->attendance_code_view);

    const getTime = (timeStr, format) => moment(timeStr, format);

    const checkTimeIsAfter = (time1, time2) => {
        const hours1 = time1.hours();
        const minutes1 = time1.minutes();

        const hours2 = time2.hours();
        const minutes2 = time2.minutes();

        if (hours1 > hours2) {
            return true;
        } else if (hours1 === hours2 && minutes1 > minutes2) {
            return true;
        }

        return false;
    };

    const getFilter = () => {
        return {
            'filterDivisi': $('#filter_divisi').val(),
            'filterDepartment': $('#filter_department').val(),
            'filterStatus': $('#filter_status').val(),
            'filterDate': $('#range_date').val(),
            'search': $('#search_attendance').val()
        }
    }

    const paramToView = (param) => {
        const parts = param.split('-');
        const formattedParts = parts.map(part => part.charAt(0).toUpperCase() + part.slice(1));
        return formattedParts.join(' ');
    }

    $(document ).ready(function() {
        $('input[name="range_date"]').daterangepicker({autoUpdateInput: false}, (from_date, to_date) => {
            $('#range_date').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
        });

        $('#range_date').val(moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));

        function deleteSummaries() {
            $('#on-time').html("-");
            $('#late-clock-in').html("-");
            $('#early-clock-out').html("-");
            $('#absent').html("-");
            $('#no-clock-in').html("-");
            $('#no-clock-out').html("-");
            $('#day-off').html("-");
            $('#time-off').html("-");
        }

        function renderSummaries() {
            $.ajax({
                url: "{{route('hc.att.all-summaries')}}",
                method: 'GET',
                data: {
                    filters: getFilter()
                },
                success: function(data) {
                    const {
                        onTimeCount,
                        lateCheckInCount,
                        earlyCheckOutCount,
                        absent,
                        noCheckInCount,
                        noCheckOutCount,
                        dayOffCount,
                        timeOffCount
                    } = data;

                    $('#on-time').html(onTimeCount);
                    $('#late-clock-in').html(lateCheckInCount);
                    $('#early-clock-out').html(earlyCheckOutCount);
                    $('#absent').html(absent);
                    $('#no-clock-in').html(noCheckInCount);
                    $('#no-clock-out').html(noCheckOutCount);
                    $('#day-off').html(dayOffCount);
                    $('#time-off').html(timeOffCount);
                },
                error: function(xhr, status, error) {
                    deleteSummaries();
                }
            });
        }

        window.tableAttendance  = $('#kt_table_attendance')
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
                url : "{{route('hc.att.get-table-attendance')}}",
                data: function(data) {
                    data.filters = getFilter()
                },
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            buttons: [],
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",

            columns: [
                { data: 'DT_RowChecklist', orderable: false, searchable: false},
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'name', orderable: false, searchable: false},
                { data: 'nip' , orderable: false, searchable: false},
                { data: 'date' , orderable: false, searchable: false},
                { data: 'shift' , orderable: false, searchable: false},
                { data: 'schedule_in' , orderable: false, searchable: false},
                { data: 'schedule_out' , orderable: false, searchable: false},
                { data: 'clock_in' , orderable: false, searchable: false},
                { data: 'clock_out' , orderable: false, searchable: false},
                { data: 'overtime' , orderable: false, searchable: false},
                { data: 'attendance_code' , orderable: false, searchable: false},
                { data: 'time_off_code' , orderable: false, searchable: false},
                { data: 'action', orderable: false, searchable: false}
            ],
            createdRow: function(row, data, dataIndex) {
                const {
                    working_start: startTime,
                    late_check_in: lateIn,
                    check_in: checkInTime,
                    working_end: endTime,
                    late_check_out: lateOut,
                    check_out: checkOutTime,
                    attendance_code: attendanceCode,
                    date
                } = data;

                const $row = $(row);

                if (attendanceCode !== attendanceCodeEnum[0]) {
                    return $row.css('background-color', 'rgba(192, 192, 192, 0.4)');
                }

                const workingStartTime = getTime(startTime, 'HH:mm:ss');
                const workingEndTime = getTime(endTime, 'HH:mm:ss');
                const checkIn = getTime(checkInTime, 'YYYY-MM-DD HH:mm:ss');
                const checkOut = getTime(checkOutTime, 'YYYY-MM-DD HH:mm:ss');

                const today = moment();
                const isDateToday = moment(date).isSame(today, 'day');
                const isDateBeforeToday = moment(date).isBefore(today, 'day');

                const redBgColor = 'rgba(255, 0, 0, 0.2)';

                const isLateCheckIn = checkTimeIsAfter(
                    checkIn,
                    workingStartTime.clone().add(lateIn, 'minutes')
                );

                const isEarlyCheckOut = checkTimeIsAfter(
                    workingEndTime.clone().subtract(lateOut, 'minutes'),
                    checkOut
                );

                if (
                    (!checkIn.isValid() || !checkOut.isValid()) && isDateBeforeToday ||
                    isDateToday && (
                        (checkIn.isValid() && isLateCheckIn) ||
                        (checkOut.isValid() && isEarlyCheckOut) ||
                        (!checkIn.isValid() && checkTimeIsAfter(today, workingStartTime.clone().add(lateIn, 'minutes')))
                    ) ||
                    isLateCheckIn || isEarlyCheckOut
                ) {
                    return $row.css('background-color', redBgColor);
                }
            },
            search: {
                "regex": true
            },
            columnDefs: [
                {
                    targets: [0, 1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                    className: 'text-center',
                },
            ],
        });

        const renderSummariesTable = (param, name) => {
            if ($.fn.DataTable.isDataTable('#kt_table_summaries')) {
                $('#kt_table_summaries').DataTable().destroy();
            }

            $('#kt_table_summaries').DataTable({
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
                    url : "{{route('hc.att.get-table-attendance-summaries')}}",
                    data: function(data) {
                        data.filters = getFilter();
                        data.param = param;
                    },
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable" : "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                dom:
                "<'row mb-2'" +
                "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                ">",

                columns: [
                    { data: 'date' , orderable: false, searchable: false},
                    { data: 'nip' , orderable: false, searchable: false},
                    { data: 'name', orderable: false, searchable: false},
                    { data: 'shift' , orderable: false, searchable: false},
                ],
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-light-success btn-sm ms-3',
                        title: name,
                        exportOptions: {
                            columns: [1,2,3,4]
                        }
                    },
                ],
                search: {
                    "regex": true
                },
                columnDefs: [
                    {
                        targets: [0, 1, 3],
                        className: 'text-center',
                    },
                ],
            });
        }

        const customExportLink = '<a href="#attendance_export_modal" class="btn btn-light-success btn-sm ms-3" data-bs-toggle="modal">Excel</a>'
        $(tableAttendance.buttons().container()).append(customExportLink);

        $('#range_date').on('apply.daterangepicker', function(ev, picker) {
            tableAttendance.draw();
            deleteSummaries();
            renderSummaries();
        });

        $('#filter_department').change(function() {
            tableAttendance.draw();
            deleteSummaries();
            renderSummaries();
        });

        $('#filter_divisi').change(function() {
            tableAttendance.draw();
            deleteSummaries();
            renderSummaries();
        });

        $('#filter_status').change(function() {
            tableAttendance.draw();
        });

        $('#search_attendance').on('input', function() {
            tableAttendance.draw();
            deleteSummaries();
            renderSummaries();
        });

        $('#modal_attendance_edit_modal').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('hc.att.edit') }}",
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    tableAttendance.draw();
                    renderSummaries();
                    toastr.success(data.message,'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('#modal_attendance_delete_modal').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('hc.att.delete') }}",
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    tableAttendance.draw();
                    renderSummaries();
                    toastr.success(data.message,'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('.summaries').each(function () {
            $(this).on('click', function () {
                const param = $(this).data('param');

                const department = $('#filter_department').find(':selected').text();
                const divisi = $('#filter_divisi').find(':selected').text();
                const search = $('#search_attendance').val() !== "" ? $('#range_date').val() : "-";

                $('#summaries_modal_title').text(`${paramToView(param)} - (${$('#range_date').val()})`);
                $('#summaries_modal_subtitle').text(`Divisi: ${divisi}, Department: ${department}, Search: ${search}`);

                renderSummariesTable(param, `${paramToView(param)} - (${$('#range_date').val()}) File`);
            });
        });

        $('#btn_reset_filter').on('click', function () {
            $('#filter_department').val("*").trigger("change")
            $('#filter_divisi').val("*").trigger("change")
            $('#filter_status').val("*").trigger("change")
        });

        $('#modal_attendance_export_submit').on('click', function() {
            const rangeDate = $('#range_date_export').val();
            const filterDivisi = $('#filter_divisi_export').val();
            const filterDepartment = $('#filter_department_export').val();

            window.open(`{{ route('hc.att.export.all') }}?rangeDate=${rangeDate}&filterDivisi=${filterDivisi}&filterDepartment=${filterDepartment}`, '_blank');
        });

        renderSummaries();
    });
</script>

@endsection
