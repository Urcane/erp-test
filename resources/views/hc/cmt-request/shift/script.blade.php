<script>
    const onShiftModalOpen = ({
        id,
        name = "-",
        nip = "-",
        branch = "-",
        org = "-",
        position = "-",
        level = "-",
        currshift = "-",
        currwork = "-",
        created = "-",
        date = "-",
        newshift = "-",
        newwork = "-",
        notes = "-",
        status,
        changed,
        prmshift,
        prmwork,
        comment = "-"
    }) => {
        const createdFormated = formatDateTime(created);

        switch (status) {
            case approveStatusEnum[0]:
                $('#shift_approved_button').hide();
                $('#shift_rejected_button').hide();
                $('#shift_waiting_button').show();
                $('#shift_comment').val("");
                $('#shift_comment').attr('placeholder', 'Write Comment Here');
                $('#shift_comment').prop('disabled', false);
                break;
            case approveStatusEnum[1]:
                $('#shift_approved_button').show();
                $('#shift_rejected_button').hide();
                $('#shift_waiting_button').hide();
                $('#shift_comment').val(comment);
                $('#shift_comment').attr('placeholder', '-');
                $('#shift_comment').prop('disabled', false);
                break;
            case approveStatusEnum[2]:
                $('#shift_approved_button').hide();
                $('#shift_rejected_button').show();
                $('#shift_waiting_button').hide();
                $('#shift_comment').val(comment);
                $('#shift_comment').attr('placeholder', '-');
                $('#shift_comment').prop('disabled', false);
                break;
        }

        $('#shf-name-modal').text(name);
        $('#shf-nip-modal').text(nip);
        $('#shf-branch-modal').text(branch);
        $('#shf-org-modal').text(org);
        $('#shf-position-modal').text(position);
        $('#shf-level-modal').text(level);
        $('#shf-curr-shift-modal').text(currshift);
        $('#shf-curr-work-modal').text(currwork);
        $('#shf-created-modal').text(createdFormated);
        $('#shf-date-modal').text(date);
        $('#shf-new-shift-modal').text(newshift);
        $('#shf-new-work-modal').text(newwork);
        $('#shf-notes-modal').text(notes);
        $('#shift-request-id').val(id)

        if (changed == '1') {
            $('#shf-title-prm-shift-modal').text("Primary Shift");
            $('#shf-title-prm-work-modal').text("Primary Work Hours");

            $('#shf-prm-shift-modal').text(prmshift);
            $('#shf-prm-work-modal').text(prmwork);

            $('#shf-curr-shift-modal').text(currshift);
            $('#shf-curr-work-modal').text(currwork);

            $('.shf_changed').each(function () {
                $(this).show();
            });
        } else {
            $('#shf-title-prm-shift-modal').text("Current Shift");
            $('#shf-title-prm-work-modal').text("Current Work Hours");

            $('#shf-prm-shift-modal').text(currshift);
            $('#shf-prm-work-modal').text(currwork);

            $('.shf_changed').each(function () {
                $(this).hide();
            });
        }
    };

    const shiftInit = () => {
        const getShiftFilter = () => {
            return {
                'filterDivisi': $('#filter_divisi_shift').val(),
                'filterDepartment': $('#filter_department_shift').val(),
                'filterStatus': $('#filter_status_shift').val(),
                'filterDate': $('#range_date_shift').val(),
                'search': $('#search_shift').val()
            }
        }

        const deleteShiftSummaries = () => {
            $('#view-need-shf').text("-");
            $('#view-approved-shf').text("-");
            $('#view-reject-shf').text("-");
            $('#all-need-shf').text("-");
            $('#all-approved-shf').text("-");
            $('#all-reject-shf').text("-");
            $('#view-date-shift').text("View Date : -");
        }

        const getShiftSummaries = () => {
            $.ajax({
                url: "{{ route('hc.request.shf.summaries') }}",
                method: 'GET',
                data: {
                    filters: getShiftFilter()
                },
                success: function(data) {
                    const {
                        allSummaries,
                        viewDate
                    } = data.data;

                    $('#view-need-shf').text(viewDate.waiting);
                    $('#view-approved-shf').text(viewDate.approved);
                    $('#view-reject-shf').text(viewDate.rejected);
                    $('#all-need-shf').text(allSummaries.waiting);
                    $('#all-approved-shf').text(allSummaries.approved);
                    $('#all-reject-shf').text(allSummaries.rejected);
                    $('#view-date-shift').text(
                        `View Date : ${formatDate(viewDate.rangeDate[0])} - ${formatDate(viewDate.rangeDate[1])}`
                    );
                },
                error: function(xhr, status, error) {
                    deleteShiftSummaries();
                }
            });
        };

        $('input[name="range_date_shift"]').daterangepicker({
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
            $('#range_date_shift').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format(
                'MM/DD/YYYY'));
        });

        $('#range_date_shift').val(moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));

        const tableShift = $('#kt_table_shift')
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
                    url: "{{ route('hc.request.shf.get-table') }}",
                    data: function(data) {
                        data.filters = getShiftFilter()
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

        $('#range_date_shift').on('apply.daterangepicker', function(ev, picker) {
            tableShift.draw();
            deleteShiftSummaries();
            getShiftSummaries();
        });

        $('#filter_department_shift').change(function() {
            tableShift.draw();
            deleteShiftSummaries();
            getShiftSummaries();
        });

        $('#filter_divisi_shift').change(function() {
            tableShift.draw();
            deleteShiftSummaries();
            getShiftSummaries();
        });

        $('#filter_status_shift').change(function() {
            tableShift.draw();
        });

        $('#btn_reset_filter').on('click', function () {
            $('#filter_department_shift').val("*").trigger("change")
            $('#filter_divisi_shift').val("*").trigger("change")
            $('#filter_status_shift').val("*").trigger("change")
        });

        $('#search_shift').on('input', function() {
            tableShift.draw();
            deleteShiftSummaries();
            getShiftSummaries();
        });

        const onShiftModalClose = () => {
            $('#shf-name-modal').text("-");
            $('#shf-nip-modal').text("-");
            $('#shf-branch-modal').text("-");
            $('#shf-org-modal').text("-");
            $('#shf-position-modal').text("-");
            $('#shf-level-modal').text("-");
            $('#shf-curr-shift-modal').text("-");
            $('#shf-curr-work-modal').text("-");
            $('#shf-created-modal').text("-");
            $('#shf-date-modal').text("-");
            $('#shf-new-shift-modal').text("-");
            $('#shf-new-work-modal').text("-");
            $('#shf-notes-modal').text("-");
            $('#shift-request-id').val("")
            $('#shift_comment').val("");
        };

        const onShiftModalSubmit = (id, status, comment) => {
            $.ajax({
                url: "{{ route('hc.request.shf.update') }}",
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
                    tableShift.draw();
                    onShiftModalClose();
                    deleteShiftSummaries();
                    getShiftSummaries();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        };

        $('#shift-modal-close').on('click', function() {
            onShiftModalClose();
        });

        $('#shift_reject').on('click', function() {
            const id = $('#shift-request-id').val();
            const comment = $('#shift_comment').val();
            onShiftModalSubmit(id, approveStatusEnum[2], comment);
        });

        $('#shift_approve').on('click', function() {
            const id = $('#shift-request-id').val();
            const comment = $('#shift_comment').val();
            onShiftModalSubmit(id, approveStatusEnum[1], comment);
        });

        getShiftSummaries();
    }
</script>
