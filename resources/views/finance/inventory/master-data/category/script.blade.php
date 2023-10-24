<script>
    @can('FIN:crud-masterdata-inventory')
        const onCategoryModalOpen = ({
            id,
            name,
            description,
            code_name
        }) => {
            $('#modal_edit_category input[name="id"]').val(id);
            $('#modal_edit_category input[name="name"]').val(name);
            $('#modal_edit_category input[name="description"]').val(description);
            $('#modal_edit_category input[name="code_name"]').val(code_name);
        }
    @endcan

    const categoryInit = () => {
        const categoryTable = $('#kt_table_category')
            .DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('fin.inv.master-data.category.get-table') }}",
                    data: function(data) {
                        data.search = $('#category_search').val();
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
                        data: 'code_name',
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
                    targets: [0, 3],
                    className: 'text-center',
                }, ],
            });

        $('#category_search').on('keyup', function(e) {
            if (e.keyCode === 13) {
                categoryTable.draw();
            }
        });

        @can('FIN:crud-masterdata-inventory')
            $('#modal_add_category').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.master-data.category.create') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#add_category_modal').modal('hide');
                        $('#modal_add_category')[0].reset();
                        categoryTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#modal_edit_category').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.master-data.category.update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#edit_category_modal').modal('hide');
                        $('#modal_edit_category')[0].reset();
                        categoryTable.ajax.reload();
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
