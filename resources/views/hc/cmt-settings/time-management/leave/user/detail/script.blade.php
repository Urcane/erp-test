<script>
    const quotaChangeType = @json($constants->leave_quota_history_type);

    const onEditQuotaClick = ({
        id,
        quotas,
        expired_date,
        received_at
    }) => {
        $('[name="name"]').val("");
        $('[name="id"]').val(id);
        $('#quotas').val(quotas);
        $('[name="quota_change"]').val(0).trigger('keyup');
        $('[name="expired_date"]').val(expired_date);
        $('[name="received_at"]').val(received_at);
    }

    const updateAvailableQuota = () => {
        $.ajax({
            url: '{{ route('hc.setting.leave.get-user-leave-quotas') }}',
            method: 'POST',
            data: {
                user_id: '{{ $user->id }}'
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data) {
                $("#available_quota").text(data.data);
            },
            error: function(xhr, status, error) {
                $('#available_quota').text("-");
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    }

    let tableHistory;
    let tableQuota;

    $(document).ready(function() {
        tableQuota = $('#kt_table_quota').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            ajax: {
                url: "{{ route('hc.setting.leave-get-table-quota') }}",
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
                "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
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
                    data: 'quotas'
                },
                {
                    data: 'received_at'
                },
                {
                    data: 'expired_date'
                },
                {
                    data: 'action'
                }
            ],

            columnDefs: [{
                targets: [0, 4],
                searchable: false,
                className: 'text-center',
            }],
        });

        tableHistory = $('#kt_table_history').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            ajax: {
                url: "{{ route('hc.setting.leave-get-table-history') }}",
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
                "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
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

        $('[name="quota_change"]').on('keyup', function() {
            if ($(this).val() == '') {
                $('#quota_result').val(parseInt($('#quotas').val()));
                return;
            }

            $('#quota_result').val(parseInt($('#quotas').val()) + parseInt($(this).val()) + " Hari");
        });

        $('#edit_quota_form').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('hc.setting.leave.update-quota') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#edit_quota_modal').modal('hide');
                    tableHistory.draw();
                    tableQuota.draw();
                    updateAvailableQuota();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        updateAvailableQuota();
    });
</script>
