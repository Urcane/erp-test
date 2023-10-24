<script>
    @can('FIN:crud-masterdata-inventory')
        const onConditionModalOpen = ({
            id,
            name
        }) => {
            $('#modal_edit_condition input[name="id"]').val(id);
            $('#modal_edit_condition input[name="name"]').val(name);
        }
    @endcan

    const conditionInit = () => {
        const conditionTable = $('#kt_table_condition')
            .DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('fin.inv.master-data.condition.get-table') }}",
                    data: function(data) {
                        data.search = $('#condition_search').val();
                    }
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
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'>" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'l i>" +
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
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: [0, 2],
                    className: 'text-center',
                }, ],
            });

        $('#condition_search').on('keyup', function(e) {
            if (e.keyCode === 13) {
                conditionTable.draw();
            }
        });

        @can('FIN:crud-masterdata-inventory')
            $('#modal_add_condition').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.master-data.condition.create') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#add_condition_modal').modal('hide');
                        $('#modal_add_condition')[0].reset();
                        conditionTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#modal_edit_condition').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.master-data.condition.update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#edit_condition_modal').modal('hide');
                        $('#modal_edit_condition')[0].reset();
                        conditionTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });
        @endcan
    }
</script>
