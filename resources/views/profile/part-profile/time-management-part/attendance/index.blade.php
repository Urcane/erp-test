<div class="tab-pane fade show active" id="attendance_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Attendance</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your attendance information</span>
        </div>
        <div class="col-lg-6 ">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="#attendance_request_modal" class="btn btn-info btn-sm me-3 fs-9" data-bs-toggle="modal"><i
                            class="fa-solid fa-plus"></i>Request Attendance</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('hc.att.detail', ['id' => $user->id]) }}" class="btn btn-info btn-sm me-3 fs-8"><i class="fa-solid fa-eye"></i>View Log</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5" id="tb_attendance_content">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Created Date</th>
                        <th class="w-150px">Request Date</th>
                        <th class="w-150px">Approval Line</th>
                        <th class="w-150px">Check In</th>
                        <th class="w-150px">Check Out</th>
                        <th class="w-150px">Status</th>
                        <th class="w-100px">#</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('profile.part-profile.time-management-part.attendance.add-modal')
@include('profile.part-profile.time-management-part.attendance.info-modal')

<script>
    let attendanceTable;

    const onAttendanceModalOpen = ({
        id,
        shift = "-",
        work = "-",
        created = "-",
        checkin = "-",
        checkout = "-",
        notes = "-",
        status,
        fileLink = "-",
        fileName = "-",
        comment = "-"
    }) => {
        const createdFormated = formatDateTime(created);
        const checkinFormated = formatDateTime(checkin);
        const checkoutFormated = formatDateTime(checkout);

        $('#attendance-request-id').val(id)
        $('#att-shift-modal').text(shift);
        $('#att-work-modal').text(work);
        $('#att-created-modal').text(createdFormated);
        $('#att-checkin-modal').text(checkinFormated);
        $('#att-checkout-modal').text(checkoutFormated);
        $('#att-notes-modal').text(notes);

        if (fileName !== "-") {
            $('#att-file-modal').attr('href', fileLink);
        }

        $('#att-file-modal').text(fileName);

        switch (status) {
            case approveStatusEnum[0]:
                $('#attendance_approved_button').hide();
                $('#attendance_rejected_button').hide();
                $('#attendance_cancel_button').show();
                $('#attendance_canceled_button').hide();

                $('#attendance_comment').hide();
                $('#att_comment_label').hide();
                break;
            case approveStatusEnum[1]:
                $('#attendance_approved_button').show();
                $('#attendance_rejected_button').hide();
                $('#attendance_cancel_button').hide();
                $('#attendance_canceled_button').hide();

                $('#att_comment_label').show();
                $('#attendance_comment').show();
                $('#attendance_comment').val(comment);
                break;
            case approveStatusEnum[2]:
                $('#attendance_approved_button').hide();
                $('#attendance_rejected_button').show();
                $('#attendance_cancel_button').hide();
                $('#attendance_canceled_button').hide();

                $('#att_comment_label').show();
                $('#attendance_comment').show();
                $('#attendance_comment').val(comment);
                break;
            case approveStatusEnum[3]:
                $('#attendance_approved_button').hide();
                $('#attendance_rejected_button').hide();
                $('#attendance_cancel_button').hide();
                $('#attendance_canceled_button').show();

                $('#attendance_comment').hide();
                $('#att_comment_label').hide();
                break;
        }
    };

    $(document).ready(function() {
        $("#time_management").on("click", function() {
            attendanceTable = $('#tb_attendance_content').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.attd.get-table-me') }}",
                    data: function(data) {
                        data.user_id = {{ $user->id }}
                    }
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                buttons: [],
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
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'approval_line'
                    },
                    {
                        data: 'check_in'
                    },
                    {
                        data: 'check_out'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        searchable : false,
                        className: 'text-center',
                    },
                ],
            });
        });

        $('#check_in_box').on('change', function() {
            if ($(this).is(':checked')) {
                $('#check_in').prop('disabled', false);
                $('#check_in').prop('required', true);
                $('#check_in').removeClass('text-muted');
            } else {
                $('#check_in').prop('disabled', true);
                $('#check_in').prop('required', false);
                $('#check_in').addClass('text-muted');
                $('#check_in').val('');
            }
        });

        $('#check_out_box').on('change', function() {
            if ($(this).is(':checked')) {
                $('#check_out').prop('disabled', false);
                $('#check_out').prop('required', true);
                $('#check_out').removeClass('text-muted');
            } else {
                $('#check_out').prop('disabled', true);
                $('#check_out').prop('required', false);
                $('#check_out').addClass('text-muted');
                $('#check_out').val('');
            }
        });

        $('#modal_create_attendance_request').submit(function(event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('req.attd.create') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    attendanceTable.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('#attendance_cancel').on('click', function() {
            $.ajax({
                url: "{{ route('req.attd.cancel') }}",
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id: $('#attendance-request-id').val(),
                },
                success: function(data) {
                    attendanceTable.draw();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        })
    });
</script>
