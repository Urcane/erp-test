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
                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                <option value="{{ $a }}">{{ $a }}</option>
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
                                    <th class="w-300px">Item Name</th>
                                    <th class="w-150px">Item Code</th>
                                    <th class="w-300px">Warehouse</th>
                                    <th class="w-150px">Category</th>
                                    <th class="w-50px">#</th>
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
                        url: "{{ route('hc.att.get-table-attendance') }}",
                        data: function(data) {
                            data.filters = getFilter()
                        },
                    },
                    language: {
                        "lengthMenu": "Show _MENU_",
                        "emptyTable": "Tidak ada data terbaru 📁",
                        "zeroRecords": "Data tidak ditemukan 😞",
                    },
                    buttons: [],
                    dom: "<'row mb-2'" +
                        "<'col-12 col-lg-6 d-flex align-items-center justify-content-start' B>" +
                        "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                        ">" +

                        "<'table-responsive'tr>" +

                        "<'row'" +
                        "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'l i>" +
                        "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                        ">",

                    columns: [{
                            data: 'DT_RowChecklist',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'nip',
                            name: 'nip',
                        },
                        {
                            data: 'shift',
                            name: 'shift',
                        },
                        {
                            data: 'date',
                            name: 'date',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    search: {
                        "regex": true
                    },
                    columnDefs: [{
                        targets: [0],
                        className: 'text-center',
                    }, ],
                });

            $('#search').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    table.draw();
                }
            });

        });
    </script>
@endsection
