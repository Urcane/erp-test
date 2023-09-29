<script>
    const onTimeOffModalOpen = ({
        id,
        name = "-",
        nip = "-",
        branch = "-",
        org = "-",
        position = "-",
        level = "-",
        taken = "-",
        file = "-",
        created = "-",
        notes = "-",
        startDate = "-",
        endDate = "-",
        date = "-",
        status,
        fileLink = "-",
        fileName = "-",
        comment = "-",
        leaveRequestCategory
    }) => {
        const createdFormated = formatDateTime(created);

        switch (status) {
            case approveStatusEnum[0]:
                $('#timeoff_approved_button').hide();
                $('#timeoff_rejected_button').hide();
                $('#timeoff_waiting_button').show();
                $('#timeoff_comment').val("");
                $('#timeoff_comment').attr('placeholder', 'Write Comment Here');
                $('#timeoff_comment').prop('disabled', false);
                break;
            case approveStatusEnum[1]:
                $('#timeoff_approved_button').show();
                $('#timeoff_rejected_button').hide();
                $('#timeoff_waiting_button').hide();
                $('#timeoff_comment').val(comment);
                $('#timeoff_comment').attr('placeholder', '-');
                $('#timeoff_comment').prop('disabled', true);
                break;
            case approveStatusEnum[2]:
                $('#timeoff_approved_button').hide();
                $('#timeoff_rejected_button').show();
                $('#timeoff_waiting_button').hide();
                $('#timeoff_comment').val(comment);
                $('#timeoff_comment').attr('placeholder', '-');
                $('#timeoff_comment').prop('disabled', true);
                break;
        }

        if (parseInt(leaveRequestCategory.halfday)) {
            $('#tmoff-taken-modal').text("1 Day(s)");
            $('#tmoff-duration-modal').text("1 Day(s)");
            $('#tmoff-date-modal').text(`${date}`);
            $('.halfdaysection').show();
            $('#tmoff-daytaken-modal').text("1 Day(s)");

            $('#tmoff-workingin-modal').text(leaveRequestCategory.working.start);
            $('#tmoff-workingend-modal').text(leaveRequestCategory.working.end);
        } else {
            $('#tmoff-duration-modal').text(`${calculateDateDifference(startDate, endDate)} Day(s)`);
            $('#tmoff-date-modal').text(`${formatDate(startDate)} - ${formatDate(endDate)}`);
            $('.halfdaysection').hide();
        }

        if (parseInt(leaveRequestCategory.useQuota)) {
            $('#tmoff-quotataken-modal').text(`${taken} Day(s)`);
        } else {
            $('#tmoff-quotataken-modal').text(`0 Day(s)`);
        }

        $('#tmoff-name-modal').text(name);
        $('#tmoff-nip-modal').text(nip);
        $('#tmoff-branch-modal').text(branch);
        $('#tmoff-org-modal').text(org);
        $('#tmoff-position-modal').text(position);
        $('#tmoff-level-modal').text(level);
        $('#tmoff-type-modal').text(`${leaveRequestCategory.name} (${leaveRequestCategory.code})`);

        $('#tmoff-created-modal').text(createdFormated);
        $('#tmoff-notes-modal').text(notes);
        $('#timeoff-request-id').val(id);

        if (fileName !== "-") {
            $('#tmoff-file-modal').attr('href', fileLink);
            $('#tmoff-file-modal').text(fileName);
            $('#tmoff-file-modal').show();
            $('#tmoff-nofile-modal').hide();
        } else {
            $('#tmoff-file-modal').attr('href', "#");
            $('#tmoff-file-modal').hide();
            $('#tmoff-nofile-modal').show();
        }
    };

    const timeOffInit = () => {
        const getTimeOffFilter = () => {
            return {
                'filterDivisi': $('#filter_divisi_timeoff').val(),
                'filterDepartment': $('#filter_department_timeoff').val(),
                'filterStatus': $('#filter_status_timeoff').val(),
                'filterDate': $('#range_date_timeoff').val(),
                'search': $('#search_timeoff').val()
            }
        }

        const deleteTimeOffSummaries = () => {
            $('#view-need-tmoff').text("-");
            $('#view-approved-tmoff').text("-");
            $('#view-reject-tmoff').text("-");
            $('#all-need-tmoff').text("-");
            $('#all-approved-tmoff').text("-");
            $('#all-reject-tmoff').text("-");
            $('#view-date-timeoff').text("View Date : -");
        }

        const getTimeOffSummaries = () => {
            $.ajax({
                url: "{{ route('hc.request.tmoff.summaries') }}",
                method: 'GET',
                data: {
                    filters: getTimeOffFilter()
                },
                success: function(data) {
                    const {
                        allSummaries,
                        viewDate
                    } = data.data;

                    $('#view-need-tmoff').text(viewDate.waiting);
                    $('#view-approved-tmoff').text(viewDate.approved);
                    $('#view-reject-tmoff').text(viewDate.rejected);
                    $('#all-need-tmoff').text(allSummaries.waiting);
                    $('#all-approved-tmoff').text(allSummaries.approved);
                    $('#all-reject-tmoff').text(allSummaries.rejected);
                    $('#view-date-timeoff').text(
                        `View Date : ${viewDate.rangeDate.join(' - ')}`
                    );
                },
                error: function(xhr, status, error) {
                    deleteTimeOffSummaries();
                }
            });
        };

        $('input[name="range_date_timeoff"]').daterangepicker({
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
            $('#range_date_timeoff').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format(
                'MM/DD/YYYY'));
        });

        $('#range_date_timeoff').val(moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));

        const tableTimeOff = $('#kt_table_timeoff')
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
                    url: "{{ route('hc.request.tmoff.get-table') }}",
                    data: function(data) {
                        data.filters = getTimeOffFilter()
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
                        data: 'created_at',
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
                    targets: [0],
                    className: 'text-center',
                }, ],
            });

        $('#range_date_timeoff').on('apply.daterangepicker', function(ev, picker) {
            tableTimeOff.draw();
            deleteTimeOffSummaries();
            getTimeOffSummaries();
        });

        $('#filter_department_timeoff').change(function() {
            tableTimeOff.draw();
            deleteTimeOffSummaries();
            getTimeOffSummaries();
        });

        $('#filter_divisi_timeoff').change(function() {
            tableTimeOff.draw();
            deleteTimeOffSummaries();
            getTimeOffSummaries();
        });

        $('#filter_status_timeoff').change(function() {
            tableTimeOff.draw();
        });

        $('#btn_reset_filter').on('click', function () {
            $('#filter_department_timeoff').val("*").trigger("change")
            $('#filter_divisi_timeoff').val("*").trigger("change")
            $('#filter_status_timeoff').val("*").trigger("change")
        });

        $('#search_timeoff').on('input', function() {
            tableTimeOff.draw();
            deleteTimeOffSummaries();
            getTimeOffSummaries();
        });

        const onTimeOffModalClose = () => {
            $('#tmoff-name-modal').text("-");
            $('#tmoff-nip-modal').text("-");
            $('#tmoff-branch-modal').text("-");
            $('#tmoff-org-modal').text("-");
            $('#tmoff-position-modal').text("-");
            $('#tmoff-level-modal').text("-");
            $('#tmoff-shift-modal').text("-");
            $('#tmoff-work-modal').text("-");
            $('#tmoff-created-modal').text("-");
            $('#tmoff-checkin-modal').text("-");
            $('#tmoff-checkout-modal').text("-");
            $('#tmoff-notes-modal').text("-");
            $('#timeoff-request-id').val("")
            $('#timeoff_comment').val("");
            $('#tmoff-file-modal').attr('href', "#");
            $('#tmoff-file-modal').text("-");
        };

        const onTimeOffModalSubmit = (id, status, comment) => {
            $.ajax({
                url: "{{ route('hc.request.tmoff.update') }}",
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
                    tableTimeOff.draw();
                    onTimeOffModalClose();
                    deleteTimeOffSummaries();
                    getTimeOffSummaries();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        };

        $('#timeoff-modal-close').on('click', function() {
            onTimeOffModalClose();
        });

        $('#timeoff_reject').on('click', function() {
            const id = $('#timeoff-request-id').val();
            const comment = $('#timeoff_comment').val();
            onTimeOffModalSubmit(id, approveStatusEnum[2], comment);
        });

        $('#timeoff_approve').on('click', function() {
            const id = $('#timeoff-request-id').val();
            const comment = $('#timeoff_comment').val();
            onTimeOffModalSubmit(id, approveStatusEnum[1], comment);
        });

        getTimeOffSummaries();
    }
</script>
