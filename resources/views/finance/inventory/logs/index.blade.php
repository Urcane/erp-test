@extends('finance.inventory.layout.layout')

@section('title-apps', 'Inventory')
@section('sub-title-apps', 'Finance')

@section('main_content')
    <div class="col-lg-9 mt-md-n14">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 text-center mt-5 mb-9">
                    <span class="fs-3 fw-bolder text-dark d-block mb-1">Warehouse Logs</span>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <select class="form-select form-select-sm form-select-solid" data-control="select2" required
                            name="filterWarehouse" id="filter_warehouse">
                            <option value="*">Semua Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-8">
                        <div class="d-flex justify-content-end">
                            <div class="input-group w-150px w-md-250px mx-4">
                                <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input class="form-control form-control-solid form-control-sm" autocomplete="off"
                                    id="search">
                            </div>
                            <div class="input-group w-150px w-md-250px me-4">
                                <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control form-control-solid form-control-sm" autocomplete="off"
                                    name="range_date" id="range_date">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table align-top border table-rounded gy-5" id="kt_table_inventory">
                            <thead class="">
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                    <th class="text-center w-50px">#</th>
                                    <th class="w-150px">Tanggal</th>
                                    <th class="w-300px">Nama Kegiatan</th>
                                    <th class="w-150px">Status</th>
                                    <th class="w-150px">Warehouse</th>
                                    <th class="w-200px">Jumlah Item</th>
                                    <th class="w-100px">#</th>
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

    <script>
        $(document).ready(function() {
            $('input[name="range_date"]').daterangepicker({
                autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, (from_date, to_date) => {
                $('#range_date').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
            });

            const table = $('#kt_table_inventory')
                .DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    deferRender: true,
                    responsive: false,
                    aaSorting: [],
                    ajax: {
                        url: "{{ route('fin.inv.logs-get-table-logs') }}",
                        data: function(data) {
                            data.search = $('#search').val();
                            data.filterWarehouse = $('#filter_warehouse').val();
                            data.date = $('#range_date').val();
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
                            data: 'created_at',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'warehouse',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'item_count',
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
                        targets: [0, 5, 6],
                        className: 'text-center',
                    }, ],
                });

            $('#search').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    table.draw();
                }
            });

            $('#filter_warehouse').on('change', function() {
                table.draw();
            });

            $('#range_date').on('apply.daterangepicker', function(ev, picker) {
                table.draw();
            });
        });
    </script>
@endsection
