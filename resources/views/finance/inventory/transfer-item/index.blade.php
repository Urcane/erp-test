@extends('layouts.app')
@section('title-apps', 'Inventory')
@section('sub-title-apps', 'Finance')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    @include('finance.inventory.transfer-item.modal')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-12 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-9 text-center">
                                <h4>TRANSFER ITEM INVENTORY</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <form class="form row" enctype="multipart/form-data" id="transfer_item_form">
                                    <p class="fw-bold fs-4">Deskripsi Transfer</p>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-4 form-label mb-2">
                                            <span class="fw-bolder">From</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="warehouse_id" id="warehouse_id">
                                            <option value="" selected>Choose a Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-4 form-label mb-2">
                                            <span class="fw-bolder">To</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="transfer_warehouse_id" id="transfer_warehouse_id">
                                            <option value="" selected>Choose a Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr class="mb-5 mt-4">

                                    <p class="fw-bold fs-4">Dekripsi Kegiatan</p>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold required">Nama Kegiatan</span>
                                        </label>
                                        <input type="text" name="name" class="form-control form-control-solid">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Deskripsi Kegiatan</span>
                                        </label>
                                        <textarea type="text" name="description" class="form-control form-control-solid"></textarea>
                                    </div>

                                    <hr class="mb-5 mt-4">

                                    <p class="fw-bold fs-4">Item Transfer</p>

                                    <div id="item-list">
                                        <div class="row">
                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Item</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Stock Item</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Transfer Amount</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-1 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Unit</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Kondisi Barang</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Status Barang</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-1 d-flex justify-content-start items-center">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Hapus</span>
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Item List --}}
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <a href="#add_transfer_item_modal" data-bs-toggle="modal"
                                            class="btn btn-light-info me-3">
                                            <i class="fas fa-plus"></i>
                                            Add Item
                                        </a>
                                    </div>

                                    <div class="col-lg-12 mt-8 mb-4 d-flex justify-content-center">
                                        <a type="reset" id="cancel" href="{{ route('fin.inv.inventory') }}"
                                            class="btn btn-outline btn-sm px-9 me-7">
                                            Cancel
                                        </a>
                                        <button id="submit" class="btn btn-outline btn-outline-info btn-sm px-9">
                                            Submit
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const warehouses = @json($warehouses);

        let table;

        const onAddItemClick = ({
            id,
            itemName,
            itemStock,
            unit,
            condition,
            status
        }) => {
            const randomId = Math.random().toString(36).substring(2, 8);

            const item = `
                <div class="row" id="item-${randomId}">
                    <input type="text" name="warehouse_good_stock_id[]" value="${id}" hidden>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid" value="${itemName}" disabled>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="number" class="form-control form-control-solid" value="${itemStock}" disabled>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="number" step="any" max="${itemStock}" min="0" class="form-control form-control-solid" required name="stock[]">
                    </div>

                    <div class="col-lg-1 mb-3">
                        <input type="text" class="form-control form-control-solid" value="${unit}" disabled>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid" value="${condition}" disabled>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid" value="${status}" disabled>
                    </div>

                    <div class="col-lg-1 d-flex justify-content-start items-center">
                        <button type="button" class="btn btn-danger btn-sm btn-icon" id="button-${randomId}">
                            <i class="fa-solid fa-delete-left"></i>
                        </button>
                    </div>
                </div>
            `;

            $('#item-list').append(item);

            $(`#button-${randomId}`).on('click', function() {
                $(`#item-${randomId}`).remove();
            });

            table.ajax.reload();
        };

        $(document).ready(function() {
            $('[href="#add_transfer_item_modal"]').one('click', function() {
                table = $('#kt_table_transfer')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        retrieve: true,
                        deferRender: true,
                        responsive: false,
                        aaSorting: [],
                        ajax: {
                            url: "{{ route('fin.inv.inventory-get-table-transfer') }}",
                            data: function(data) {
                                data.warehouse_id = $('#warehouse_id').val();
                                data.items = $('[name="warehouse_good_stock_id[]"]').map(function() {
                                    return $(this).val();
                                }).get();
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
                                data: 'category',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'item_name',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'stock',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'unit',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'condition',
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
                            },
                        ],
                        columnDefs: [{
                            targets: [0, 7],
                            className: 'text-center',
                        }, ],
                    });
            });

            $('[href="#add_transfer_item_modal"]').on('click', function() {
                $('#modal_warehouse').text(
                    `Item Tersedia pada Gudang ${warehouses.find(({ id }) => id == $('#warehouse_id').val()).name}`
                );

                table.ajax.reload();
            });

            $('#warehouse_id').on('change', function() {
                $('#item-list').html(`
                    <div class="row">
                        <div class="col-lg-2 mb-1">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Item</span>
                            </label>
                        </div>

                        <div class="col-lg-2 mb-1">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Stock Item</span>
                            </label>
                        </div>

                        <div class="col-lg-2 mb-1">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Transfer Amount</span>
                            </label>
                        </div>

                        <div class="col-lg-1 mb-1">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Unit</span>
                            </label>
                        </div>

                        <div class="col-lg-2 mb-1">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Kondisi Barang</span>
                            </label>
                        </div>

                        <div class="col-lg-2 mb-1">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Status Barang</span>
                            </label>
                        </div>

                        <div class="col-lg-1 d-flex justify-content-start items-center">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Hapus</span>
                            </label>
                        </div>
                    </div>
                `);
            });

            $('#transfer_item_form').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.inventory-transfer') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        toastr.success(data.message, 'Selamat 🚀 !');
                        setTimeout(function() {
                            window.location.href = "{{ route('fin.inv.inventory') }}";
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });
        });
    </script>
@endsection
