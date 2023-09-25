<div class="tab-pane fade" id="time_off_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Time Off</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your time off information</span>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <div>
                <a href="#time_off_request_modal" class="btn btn-info btn-sm me-3 fs-8" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>Request Time Off</a>
            </div>
        </div>


        <div class="row border rounded p-4 mb-4 justify-content-center">
            <div class="col-12">
                <p class="fw-bold fs-6 mb-2" id="view-date-attendance">Cuti Tahunan</p>
                <div class="ms-1 row">
                    <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="on-time">
                        <div class="fw-semibold fs-7 text-gray-600 m-0 p-0">Sisa Cuti</div>
                        <div class="m-0 p-0 d-flex align-items-center">
                            <p class="text-info fw-bolder me-1" style="font-size: 31px;">13</p>
                            <p class="text-gray-800 " style="font-size: 13px;">Hari</p>
                        </div>
                    </div>
                    <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                        data-param="late-clock-in">
                        <div class="fw-semibold fs-7 text-gray-600 m-0 p-0">Terpakai</div>
                        <div class="m-0 p-0 d-flex align-items-center">
                            <p class="fw-bolder me-1" style="font-size: 31px; color: rgb(249 115 22);">13</p>
                            <p class="text-gray-800 " style="font-size: 13px;">Hari</p>
                        </div>
                    </div>
                    <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal"
                        data-param="early-clock-out">
                        <div class="fw-semibold fs-7 text-gray-600 m-0 p-0">Berlaku Hingga</div>
                        <div class="text-gray-500 fw-bolder m-0 p-0">
                            <p style="font-size: 22px;">13 Maret 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid">
            <ul class="nav nav-tabs flex-nowrap text-nowrap">
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active"
                        data-bs-toggle="tab" href="#tmoff-request">Time Off Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                        data-bs-toggle="tab" href="#tmoff-history">History</a>
                </li>
            </ul>
        </div>

        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="tmoff-request" role="tabpanel">
                <div class="col-lg-12">
                    <table class="table align-top table-striped border table-rounded gy-5" id="tb_time_off_content">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th class="text-center w-50px">#</th>
                                <th class="w-150px">Created Date</th>
                                <th class="w-150px">Request</th>
                                <th class="w-100px">Code</th>
                                <th class="w-200px">Approval Line</th>
                                <th class="w-150px">Status</th>
                                <th class="w-100px">#</th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="tmoff-history" role="tabpanel">
                <div class="col-lg-12">
                    <table class="table align-top table-striped border table-rounded gy-5"
                        id="tb_time_off_history_content">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th class="text-center w-50px">#</th>
                                <th class="w-150px">Name</th>
                                <th class="w-150px">Approval Name</th>
                                <th class="w-150px">Date</th>
                                <th class="w-150px">Quota Change</th>
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

@include('profile.part-profile.time-management-part.timeoff.add-modal')
@include('profile.part-profile.time-management-part.timeoff.info-modal')

<script>
    const quotaChangeType = @json($constants->leave_quota_history_type);

    const onTimeOffModalOpen = ({
        id,
        taken = "-",
        file = "-",
        type = "-",
        created = "-",
        notes = "-",
        startDate = "-",
        endDate = "-",
        status,
        fileLink = "-",
        fileName = "-"
    }) => {
        const createdFormated = formatDateTime(created);
        const startDateFormated = formatDate(startDate);
        const endDateFormated = formatDate(endDate);

        switch (status) {
            case approveStatusEnum[0]:
                $('#timeoff_approved_button').hide();
                $('#timeoff_rejected_button').hide();
                $('#timeoff_cancel_button').show();
                $('#timeoff_canceled_button').hide();

                $('#timeoff_comment').hide();
                $('#att_timeoff_label').hide();
                break;
            case approveStatusEnum[1]:
                $('#timeoff_approved_button').show();
                $('#timeoff_rejected_button').hide();
                $('#timeoff_cancel_button').hide();
                $('#timeoff_canceled_button').hide();

                $('#att_timeoff_label').show();
                $('#timeoff_comment').show();
                $('#timeoff_comment').val(comment);
                break;
            case approveStatusEnum[2]:
                $('#timeoff_approved_button').hide();
                $('#timeoff_rejected_button').show();
                $('#timeoff_cancel_button').hide();
                $('#timeoff_canceled_button').hide();

                $('#att_timeoff_label').show();
                $('#timeoff_comment').show();
                $('#timeoff_comment').val(comment);
                break;
            case approveStatusEnum[3]:
                $('#timeoff_approved_button').hide();
                $('#timeoff_rejected_button').hide();
                $('#timeoff_cancel_button').hide();
                $('#timeoff_canceled_button').show();

                $('#timeoff_comment').hide();
                $('#att_timeoff_label').hide();
                break;
        }

        $('#tmoff-type-modal').text(type);
        $('#tmoff-file-modal').text(file);
        $('#tmoff-taken-modal').text(`${taken} Day(s)`);
        $('#tmoff-date-modal').text(`${startDateFormated} - ${endDateFormated}`);
        $('#tmoff-created-modal').text(createdFormated);
        $('#tmoff-notes-modal').text(notes);
        $('#timeoff-request-id').val(id)

        if (fileName !== "-") {
            $('#tmoff-file-modal').attr('href', fileLink);
        }

        $('#tmoff-file-modal').text(fileName);
    };

    let timeOffTable;
    let timeOffHistoryTable;

    $(document).ready(function() {
        $("#time_off").on("click", function() {
            timeOffTable = $('#tb_time_off_content').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.time-off.get-table-me') }}",
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

                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'approval_line'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },
                ],

                columnDefs: [{
                    targets: "_all",
                    searchable: false,
                    className: 'text-center',
                }],
            });

            timeOffTable = $('#tb_time_off_history_content').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('hc.emp.get-table-leave-history') }}",
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

                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'approval_name'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'quota_change'
                    },
                ],

                columnDefs: [{
                    targets: 0,
                    searchable: false,
                    className: 'text-center',
                }],

                createdRow: function(row, data, dataIndex) {
                    const quotaChangeCell = $(row).find('td:eq(4)');

                    if (data.type == quotaChangeType[0]) {
                        quotaChangeCell.addClass('text-danger');
                        quotaChangeCell.text("-" + data.quota_change + " Day(s)");
                    } else if (data.type == quotaChangeType[1]) {
                        quotaChangeCell.addClass('text-success')
                        quotaChangeCell.text("+" + data.quota_change + " Day(s)");
                    }
                }
            });
        });

        $('#modal_create_time_off_request').submit(function(event) {
            event.preventDefault();
            const disabled = $(this).find('input:disabled').prop('disabled', false);
            var formData = new FormData($(this)[0]);
            disabled.prop('disabled', true);
            $.ajax({
                url: "{{ route('req.time-off.create') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#time_off_request_modal').modal('hide');
                    $("#modal_create_time_off_request")[0].reset();
                    $('select[name="leave_request_category_id"]').trigger('change');
                    timeOffTable.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('#timeoff_cancel').on('click', function() {
            $.ajax({
                url: "{{ route('req.time-off.cancel') }}",
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id: $('#timeoff-request-id').val(),
                },
                success: function(data) {
                    timeOffTable.draw();
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
