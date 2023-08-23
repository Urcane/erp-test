<script>
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

        $('input[name="range_date_attendance"]').daterangepicker({
            autoUpdateInput: false
        }, (from_date, to_date) => {
            $('#range_date_attendance').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format(
                'MM/DD/YYYY'));
        });

        $('#range_date').on('apply.daterangepicker', function(ev, picker) {
            $('#view-date-attendance').text(`View Date : ${$(this).val()}`);
        });

        $('#range_date_attendance').val(moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));
        $('#view-date-attendance').text(`View Date : ${$('#range_date_attendance').val()}`);

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
                        data: 'DT_RowChecklist',
                        orderable: false,
                        searchable: false
                    },
                    {
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
                    targets: [0, 1],
                    className: 'text-center',
                }, ],
            });
    }
</script>
