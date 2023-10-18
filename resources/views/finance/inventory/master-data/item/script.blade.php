<script>
    const onItemModalOpen = ({
        id,
        good_category_id,
        good_name,
        good_type,
        code_name,
        spesification,
        merk,
        description,
    }) => {
        $('#modal_edit_item input[name="id"]').val(id);
        $('#edit_item_category').val(good_category_id).trigger('change.select2');
        $('#modal_edit_item input[name="good_name"]').val(good_name);
        $('#modal_edit_item input[name="good_type"]').val(good_type);
        $('#modal_edit_item input[name="code_name"]').val(code_name);
        $('#modal_edit_item input[name="spesification"]').val(spesification);
        $('#modal_edit_item input[name="merk"]').val(merk);
        $('#modal_edit_item input[name="description"]').val(description);
    }

    const itemInit = () => {
        const itemTable = $('#kt_table_item')
            .DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('fin.inv.master-data.item.get-table') }}",
                    data: function(data) {
                        data.search = $('#item_search').val();
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
                        data: 'good_name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'merk',
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
                    targets: [0, 5],
                    className: 'text-center',
                }, ],
            });

        $('#item_search').on('keyup', function(e) {
            if (e.keyCode === 13) {
                itemTable.draw();
            }
        });

        $('#add_item_category').select2({
            placeholder: 'Select Kategori',
            ajax: {
                url: "{{ route('fin.inv.master-data.category.data') }}",
                dataType: 'json',
                processResults: function({
                    data
                }) {
                    return {
                        results: data.map(({
                            id,
                            name
                        }) => ({
                            id,
                            text: name
                        }))
                    };
                },
            },
            minimumInputLength: 0,
        });

        $.ajax({
            url: "{{ route('fin.inv.master-data.category.data') }}",
            dataType: 'json',
            success: function ({ data }) {
                const option = data.reduce((result, { id, name }) => '<option value="' + id + '">' + name + '</option>' + result, '');
                $('#edit_item_category').append(option)
            }
        });

        $('#modal_add_item').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('fin.inv.master-data.item.create') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#add_item_modal').modal('hide');
                    $('#modal_add_item')[0].reset();
                    itemTable.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('#modal_edit_item').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('fin.inv.master-data.item.update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#edit_item_modal').modal('hide');
                    $('#modal_edit_item')[0].reset();
                    itemTable.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });
    }
</script>
