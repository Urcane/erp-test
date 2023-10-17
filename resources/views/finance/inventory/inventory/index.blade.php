@extends('finance.inventory.layout.layout')

@section('title-apps', 'Inventory')
@section('sub-title-apps', 'Finance')

@section('main_content')
    <div class="col-lg-9 mt-md-n14">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 text-center mt-5 mb-9">
                    <span class="fs-3 fw-bolder text-dark d-block mb-1">INVENTORY</span>
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
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <div class="input-group w-150px w-md-250px mx-4">
                                <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input class="form-control form-control-solid form-control-sm" autocomplete="off"
                                    id="search">
                            </div>
                            <a href="{{ route('fin.inv.inventory-create') }}" class="btn btn-info btn-sm me-3 fs-8">
                                <i class="fa-solid fa-plus"></i>
                                Add Item
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table align-top border table-rounded gy-5" id="kt_table_inventory">
                            <thead class="">
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                    <th class="text-center w-50px">#</th>
                                    <th class="w-350px">Item Name</th>
                                    <th class="w-150px">Item Code</th>
                                    <th class="w-200px">Warehouse</th>
                                    <th class="w-150px">SN/PN/MAC</th>
                                    <th class="w-150px">Category</th>
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
            const table = $('#kt_table_inventory')
                .DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    deferRender: true,
                    responsive: false,
                    aaSorting: [],
                    ajax: {
                        url: "{{ route('fin.inv.inventory-get-table-inventory') }}",
                        data: function(data) {
                            data.search = $('#search').val();
                            data.filterWarehouse = $('#filter_warehouse').val();
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
                            data: 'item_name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'code',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'warehouse_name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'serial_number',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'category',
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
                        targets: [0, 6],
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
        });
    </script>
@endsection
