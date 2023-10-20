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
    @include('finance.inventory.add-item.modal')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-12 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-9 text-center">
                                <h4>ADD ITEM INVENTORY</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <form class="form row" enctype="multipart/form-data" id="add_item_form">
                                    <p class="fw-bold fs-4">Deskripsi Kegiatan</p>

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

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Pilih Warehouse</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="warehouse_id" id="warehouse_id">
                                            <option value="" selected>Choose a Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Pilih Item</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="inventory_good_id" id="inventory_good_id">
                                            <option value="" selected>Choose a Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->good_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr class="mb-5 mt-4">

                                    <p class="fw-bold fs-4">Deskripsi Item</p>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Kategori</span>
                                        </label>
                                        <input type="text" id="item_category" class="form-control form-control-solid"
                                            disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Nama</span>
                                        </label>
                                        <input type="text" id="item_name" class="form-control form-control-solid"
                                            disabled>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Tipe</span>
                                        </label>
                                        <input type="text" id="item_type" class="form-control form-control-solid"
                                            disabled>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Merk</span>
                                        </label>
                                        <input type="text" id="item_merk" class="form-control form-control-solid"
                                            disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Spesifikasi</span>
                                        </label>
                                        <input type="text" id="item_spesification"
                                            class="form-control form-control-solid" disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Deskripsi</span>
                                        </label>
                                        <textarea class="form-control form-control-solid" rows="3" id="item_description" disabled></textarea>
                                    </div>

                                    <hr class="mb-5 mt-4">

                                    <p class="fw-bold fs-4">Penambahan Stock Gudang</p>

                                    <div id="item-list">
                                        <div class="row">
                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">SN/PN/MAC</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Stock</span>
                                                </label>
                                            </div>

                                            <div class="col-lg-2 mb-1">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Minimum Stock</span>
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
                                        <a href="#add_item_modal" data-bs-toggle="modal" class="btn btn-light-info me-3">
                                            <i class="fas fa-plus"></i>
                                            Add Item
                                        </a>
                                    </div>

                                    <div class="col-lg-12 mt-8 mb-4 d-flex justify-content-center">
                                        <a type="reset" id="cancel" href="{{ route('hc.setting.timeoff.index') }}"
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
        const itemData = @json($items);
        const itemCondition = @json($conditions);
        const itemStatus = @json($statuses);
        const itemUnit = @json($units);

        $(document).ready(function() {
            $('#inventory_good_id').on('change', function() {
                const item = itemData.find(item => item.id == $(this).val());
                $('#item_category').val(item.inventory_good_category.name + " - " + item
                    .inventory_good_category.code_name ?? "(No Code)");
                $('#item_name').val(item.good_name + " - " + item.code_name ?? "(No Code)");
                $('#item_type').val(item.good_type ?? "-");
                $('#item_merk').val(item.merk ?? "-");
                $('#item_spesification').val(item.spesification ?? "-");
                $('#item_description').val(item.description);
            });

            $('#add_item_form').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.inventory-create') }}",
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

            $('#add_item_submit').on('click', function() {
                const randomId = Math.random().toString(36).substring(2, 8);
                const serialNumber = $('#serial_number').val();
                const stock = $('#item_stock').val();
                const minimumStock = $('#minimum_stock').val();
                const unitId = $('#inventory_unit_master_id').val();
                const goodConditionId = $('#inventory_good_condition_id').val();
                const goodStatusId = $('#inventory_good_status_id').val();

                const html = `<div class="row" id="item-${randomId}">
                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            name="serial_number[]" value=${serialNumber}>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="number" class="form-control form-control-solid"
                            required name="stock[]" min="0" step="any" value=${stock}>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="number" class="form-control form-control-solid"
                            required name="minimum_stock[]" min="0" step="any" value=${minimumStock}>
                    </div>

                    <div class="col-lg-1 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            hidden name="inventory_unit_master_id[]" value=${unitId}>
                        <input type="text" class="form-control form-control-solid" disabled
                            value="${((itemUnit.find(({ id }) => id == unitId))).code}">
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            hidden name="inventory_good_condition_id[]" value=${goodConditionId}>
                        <input type="text" class="form-control form-control-solid" disabled
                            value="${(itemCondition.find(({ id }) => id == goodConditionId)).name}">
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            hidden name="inventory_good_status_id[]" value=${goodStatusId}>
                        <input type="text" class="form-control form-control-solid" disabled
                            value="${(itemStatus.find(({ id }) => id == goodStatusId)).name}">
                    </div>

                    <div class="col-lg-1 d-flex justify-content-start items-center">
                        <button type="button" class="btn btn-danger btn-sm btn-icon"
                            id="button-${randomId}">
                            <i class="fa-solid fa-delete-left"></i>
                        </button>
                    </div>
                </div>`;

                $('#item-list').append(html);

                $(`#button-${randomId}`).on('click', function() {
                    $(`#item-${randomId}`).remove();
                });

                $('#add_item_modal input').each(function() {
                    $(this).val('');
                    $(this).trigger('change');
                });

                $('#add_item_modal select').each(function() {
                    $(this).val('');
                    $(this).trigger('change');
                });
            });
        });
    </script>
@endsection
