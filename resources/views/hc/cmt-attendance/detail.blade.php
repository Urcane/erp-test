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
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6">
                                <span class="fs-4 text-uppercase fw-bolder text-dark d-none d-md-block">
                                    Attendance: {{$user->name}} - {{$user->userEmployment->employee_id}}
                                </span>
                            </div>

                            {{-- Button --}}

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-top border table-rounded gy-5" id="kt_table_attendance">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                            <th class="text-center w-50px">#</th>
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-150px">Date</th>
                                            <th class="w-150px">Shift</th>
                                            <th class="w-150px text-center">Schedule In</th>
                                            <th class="w-150px text-center">Schedule Out</th>
                                            <th class="w-250px text-center">Clock In</th>
                                            <th class="w-250px text-center">Clock Out</th>
                                            <th class="w-150px">Overtime</th>
                                            <th class="w-150px">Attendance Code</th>
                                            <th class="w-150px">Time Off Code</th>
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
    const attendanceCodeEnum = @json($attendanceCode);

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

    $(document ).ready(function() {
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
                url : "{{route('hc.att.get-table-attendance-detail')}}",
                data: function(data){
                    data.user_id = {{$user->id}}
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
                    title: 'Data Absen Pegawai Comtelindo',
                    exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9,10]
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
                { data: 'date' },
                { data: 'shift' },
                { data: 'schedule_in' },
                { data: 'schedule_out' },
                { data: 'clock_in' },
                { data: 'clock_out' },
                { data: 'overtime' },
                { data: 'attendance_code' },
                { data: 'time_off_code' },
                { data: 'action'}
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

                const workingStartTime = getTime(startTime, 'HH:mm:ss');
                const workingEndTime = getTime(endTime, 'HH:mm:ss');
                const checkIn = getTime(checkInTime, 'YYYY-MM-DD HH:mm:ss');
                const checkOut = getTime(checkOutTime, 'YYYY-MM-DD HH:mm:ss');

                if (attendanceCode !== attendanceCodeEnum[0]) {
                    return $(row).css('background-color', 'rgba(192, 192, 192, 0.4)');
                }

                if ((!checkIn.isValid() || !checkOut.isValid()) && moment(date).isBefore(moment(), 'day')) {
                    return $(row).css('background-color', 'rgba(255, 0, 0, 0.2)');
                }

                const isLateCheckIn = checkTimeIsAfter(
                    checkIn,
                    workingStartTime.clone().add(lateIn, 'minutes')
                );

                const isEarlyCheckOut = checkTimeIsAfter(
                    workingEndTime.clone().subtract(lateOut, 'minutes'),
                    checkOut
                );

                if (isLateCheckIn || isEarlyCheckOut) {
                    return $(row).css('background-color', 'rgba(255, 0, 0, 0.2)');
                }
            }

            // columnDefs: [
            //     {
            //         targets: 0,
            //         searchable : false,
            //         className: 'text-center',
            //     },
            //     {
            //         targets: 1,
            //         className: 'text-center',
            //     },
            //     {
            //         targets: 7,
            //         orderable : false,
            //         searchable : false,
            //         className : 'text-center',
            //     },
            // ],
        });
    });
</script>

@endsection
