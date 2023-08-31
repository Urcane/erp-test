<script>
    const onAttendanceModalOpen = ({
        id,
        name = "-",
        nip = "-",
        branch = "-",
        org = "-",
        position = "-",
        level = "-",
        shift = "-",
        work = "-",
        created = "-",
        checkin = "-",
        checkout = "-",
        notes = "-",
        status
    }) => {
        const createdFormated = formatDateTime(created);
        const checkinFormated = formatDateTime(checkin);
        const checkoutFormated = formatDateTime(checkout);

        switch (status) {
            case approveStatusEnum[0]:
                $('#attendance_approved_button').hide();
                $('#attendance_rejected_button').hide();
                $('#attendance_waiting_button').show();
                break;
            case approveStatusEnum[1]:
                $('#attendance_approved_button').show();
                $('#attendance_rejected_button').hide();
                $('#attendance_waiting_button').hide();
                break;
            case approveStatusEnum[2]:
                $('#attendance_approved_button').hide();
                $('#attendance_rejected_button').show();
                $('#attendance_waiting_button').hide();
                break;
        }

        $('#att-name-modal').text(name);
        $('#att-nip-modal').text(nip);
        $('#att-branch-modal').text(branch);
        $('#att-org-modal').text(org);
        $('#att-position-modal').text(position);
        $('#att-level-modal').text(level);
        $('#att-shift-modal').text(shift);
        $('#att-work-modal').text(work);
        $('#att-created-modal').text(createdFormated);
        $('#att-checkin-modal').text(checkinFormated);
        $('#att-checkout-modal').text(checkoutFormated);
        $('#att-notes-modal').text(notes);
        $('#attendance-request-id').val(id)
        $('#attendance_comment').val("");
    };

    const attendanceInit = () => {
        const getAttendanceFilter = () => {
            return {
                'filterDivisi': $('#filter_divisi_attendance').val(),
                'filterDepartment': $('#filter_department_attendance').val(),
                'filterStatus': $('#filter_status_attendance').val(),
                'filterDate': $('#range_date_attendance').val(),
                'search': $('#search_attendance').val()
            }
        }

        const deleteAttendanceSummaries = () => {
            $('#view-need-att').text("-");
            $('#view-approved-att').text("-");
            $('#view-reject-att').text("-");
            $('#all-need-att').text("-");
            $('#all-approved-att').text("-");
            $('#all-reject-att').text("-");
            $('#view-date-attendance').text("View Date : -");
        }

        const getAttendanceSummaries = () => {
            $.ajax({
                url: "{{ route('hc.request.att.summaries') }}",
                method: 'GET',
                data: {
                    filters: getAttendanceFilter()
                },
                success: function(data) {
                    const {
                        allSummaries,
                        viewDate
                    } = data.data;

                    $('#view-need-att').text(viewDate.waiting);
                    $('#view-approved-att').text(viewDate.approved);
                    $('#view-reject-att').text(viewDate.rejected);
                    $('#all-need-att').text(allSummaries.waiting);
                    $('#all-approved-att').text(allSummaries.approved);
                    $('#all-reject-att').text(allSummaries.rejected);
                    $('#view-date-attendance').text(
                        `View Date : ${formatDate(viewDate.rangeDate[0])} - ${formatDate(viewDate.rangeDate[1])}`
                    );
                },
                error: function(xhr, status, error) {
                    deleteAttendanceSummaries();
                }
            });
        };

        $('input[name="range_date_attendance"]').daterangepicker({
            autoUpdateInput: false
        }, (from_date, to_date) => {
            $('#range_date_attendance').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format(
                'MM/DD/YYYY'));
        });

        $('#range_date_attendance').val(moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));

        const tableAttendance = $('#kt_table_attendance')
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
                    url: "{{ route('hc.request.att.get-table') }}",
                    data: function(data) {
                        data.filters = getAttendanceFilter()
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
                        data: 'name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nip',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'branch',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'organization',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'job_level',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'job_position',
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
                    }
                ],
                columnDefs: [{
                    targets: [0, 8, 9],
                    className: 'text-center',
                }, ],
            });

        $('#range_date_attendance').on('apply.daterangepicker', function(ev, picker) {
            tableAttendance.draw();
            deleteAttendanceSummaries();
            getAttendanceSummaries();
        });

        $('#filter_department_attendance').change(function() {
            tableAttendance.draw();
            deleteAttendanceSummaries();
            getAttendanceSummaries();
        });

        $('#filter_divisi_attendance').change(function() {
            tableAttendance.draw();
            deleteAttendanceSummaries();
            getAttendanceSummaries();
        });

        $('#filter_status_attendance').change(function() {
            tableAttendance.draw();
        });

        $('#btn_reset_filter').on('click', function () {
            $('#filter_department_attendance').val("*").trigger("change")
            $('#filter_divisi_attendance').val("*").trigger("change")
            $('#filter_status_attendance').val("*").trigger("change")
        });

        $('#search_attendance').on('input', function() {
            tableAttendance.draw();
            deleteAttendanceSummaries();
            getAttendanceSummaries();
        });

        const onAttendanceModalClose = () => {
            $('#att-name-modal').text("-");
            $('#att-nip-modal').text("-");
            $('#att-branch-modal').text("-");
            $('#att-org-modal').text("-");
            $('#att-position-modal').text("-");
            $('#att-level-modal').text("-");
            $('#att-shift-modal').text("-");
            $('#att-work-modal').text("-");
            $('#att-created-modal').text("-");
            $('#att-checkin-modal').text("-");
            $('#att-checkout-modal').text("-");
            $('#att-notes-modal').text("-");
            $('#attendance-request-id').val("")
            $('#attendance_comment').val("");
        };

        const onAttendanceModalSubmit = (id, status, comment) => {
            $.ajax({
                url: "{{ route('hc.request.att.update') }}",
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id,
                    status,
                    comment
                },
                success: function(data) {
                    tableAttendance.draw();
                    onAttendanceModalClose();
                    deleteAttendanceSummaries();
                    getAttendanceSummaries();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        };

        $('#attendance-modal-close').on('click', function() {
            onAttendanceModalClose();
        });

        $('#attendance_reject').on('click', function() {
            const id = $('#attendance-request-id').val();
            const comment = $('#attendance_comment').val();
            onAttendanceModalSubmit(id, approveStatusEnum[2], comment);
        });

        $('#attendance_approve').on('click', function() {
            const id = $('#attendance-request-id').val();
            const comment = $('#attendance_comment').val();
            onAttendanceModalSubmit(id, approveStatusEnum[1], comment);
        });

        getAttendanceSummaries();
    }
</script>
