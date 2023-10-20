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
                            <div class="col-lg-12 mt-5 mb-9 d-flex justify-content-between">
                                <span class="fs-3 fw-bolder text-dark d-block mb-1">
                                    {{ $warehouseGood->inventoryGood->good_name }}
                                    {{ $warehouseGood->warehouse->name }}
                                </span>
                            </div>

                            <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold fs-4">Stock Gudang</p>
                                    <button id="edit_item_button" class="btn btn-sm btn-outline btn-outline-info me-3">
                                        <i class="fas fa-pen-to-square"></i>
                                        Adjust Item
                                    </button>
                                </div>

                                <hr class="mb-5 mt-4">

                                <form class="row" id="item_form" enctype="multipart/form-data" autocomplete="off">
                                    <input type="text" name="warehouse_id" value="{{ $warehouseGood->warehouse->id }}" hidden>
                                    <input type="text" name="inventory_good_id" value="{{ $warehouseGood->inventory_good_id }}" hidden>
                                    <div class="col-lg-2 mb-1">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">SN/PN/MAC</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2 mb-1">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Stock</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2 mb-1">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Minimum Stock</span>
                                        </label>
                                    </div>

                                    <div class="mb-3 col-lg-2" id="unit-1">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Unit</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2 mb-1">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Kondisi Barang</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2 mb-1">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Status Barang</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-1 mb-1 edit_section" style="display: none;">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Delete</span>
                                        </label>
                                    </div>

                                    @foreach ($warehouseGood->warehouseGoodStocks as $item)
                                        <input type="text" name="item_id[]" value="{{ $item->id }}" hidden>
                                        <div class="col-lg-2 mb-3">
                                            <input type="text" class=" form-control form-control-solid" disabled
                                                name="serial_number[]" value={{ $item->serial_number }}>
                                        </div>

                                        <div class="col-lg-2 mb-3">
                                            <input type="number"
                                                class="form-control form-control-solid fw-bold
                                        @if ($item->stock >= $item->minimum_stock) text-success
                                        @elseif($item->stock < $item->minimum_stock && $item->stock > 0)
                                            text-warning
                                        @else
                                            text-danger @endif
                                        "
                                                disabled required name="stock[]" min="0" step="any"
                                                value={{ $item->stock }}>
                                        </div>

                                        <div class="col-lg-2 mb-3">
                                            <input type="number" class="form-control form-control-solid" disabled required
                                                name="minimum_stock[]" min="0" step="any"
                                                value={{ $item->minimum_stock }}>
                                        </div>

                                        <div class="unit mb-3 col-lg-2">
                                            <div class="form-control form-control-solid">
                                                {{ $item->inventoryUnitMaster->name }}
                                            </div>
                                        </div>

                                        <div class="col-lg-2 mb-3">
                                            <div class="form-control form-control-solid">
                                                {{ $item->inventoryGoodCondition->name }}
                                            </div>
                                        </div>

                                        <div class="col-lg-2 mb-3">
                                            <div class="form-control form-control-solid">
                                                {{ $item->inventoryGoodStatus->name }}
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="edit_section" id="item-list" style="display: none;">
                                    </div>

                                    <div class="col-lg-12 mb-3 edit_section" style="display: none;">
                                        <a href="#add_item_modal" data-bs-toggle="modal"
                                            class="btn btn-sm btn-light-info me-3">
                                            <i class="fas fa-plus"></i>
                                            Add Item
                                        </a>
                                    </div>

                                    <div class="col-lg-12 mb-3 edit_section" style="display: none;">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Nama Kegiatan</span>
                                        </label>
                                        <input type="text"
                                            class="form-control form-control-solid border-info bg-light-info" required
                                            name="name">
                                    </div>

                                    <div class="col-lg-12 mb-3 edit_section" style="display: none;">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Deskripsi Kegiatan</span>
                                        </label>
                                        <textarea type="text" class="form-control form-control-solid border-info bg-light-info" name="description">
                                        </textarea>
                                    </div>

                                    <div class="justify-content-end mt-2 edit_section" style="display: none;">
                                        <button id="submit" class="btn btn-sm btn-outline btn-outline-info">
                                            <i class="fas fa-check"></i>
                                            Apply Changes
                                        </button>
                                    </div>
                                </form>

                                <hr class="mb-5 mt-4">

                                <p class="fw-bold fs-4">Deskripsi Item</p>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Kategori</span>
                                    </label>
                                    <div class="form-control form-control-solid">
                                        {{ $warehouseGood->inventoryGood->inventoryGoodCategory->name }}
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Tipe</span>
                                    </label>
                                    <div class="form-control form-control-solid">
                                        {{ $warehouseGood->inventoryGood->good_type ?? 'Tidak Ada Tipe' }}
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Merk</span>
                                    </label>
                                    <div class="form-control form-control-solid">
                                        {{ $warehouseGood->inventoryGood->merk ?? 'Tidak Ada Merk' }}
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Spesifikasi</span>
                                    </label>
                                    <div class="form-control form-control-solid">
                                        {{ $warehouseGood->inventoryGood->spesification ?? 'Tidak Ada Spesifikasi' }}
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Deskripsi</span>
                                    </label>
                                    <textarea class="form-control form-control-solid" rows="3" disabled>{{ $warehouseGood->inventoryGood->description ?? 'Tidak Ada deskripsi' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const itemCondition = @json($conditions);
        const itemStatus = @json($statuses);
        const itemUnit = @json($units);

        let isEdit = false;

        $(document).ready(function() {
            $('#edit_item_button').on('click', function() {
                if (isEdit) {
                    $(this).html('<i class="fas fa-pen-to-square"></i> Adjust Item');
                    $(this).addClass('btn-outline-info');
                    $(this).removeClass('btn-outline-danger');

                    $('#item_form [name="minimum_stock[]"]').each(function() {
                        $(this).prop('disabled', true)
                        $(this).prop('required', false)
                        $(this).removeClass(['bg-light-info', 'border-info'])
                    });
                    $('#item_form [name="stock[]"]').each(function() {
                        $(this).prop('disabled', true)
                        $(this).prop('required', false)
                        $(this).removeClass(['bg-light-info', 'border-info'])
                    });
                    $('#item_form [name="serial_number[]"]').each(function() {
                        $(this).prop('disabled', true)
                        $(this).removeClass(['bg-light-info', 'border-info'])
                    });
                    $('.edit_section').hide();
                    $('#unit-1').each(function() {
                        $(this).addClass('col-lg-2')
                        $(this).removeClass('col-lg-1')
                    });
                    $('.unit').each(function() {
                        $(this).addClass('col-lg-2')
                        $(this).removeClass('col-lg-1')
                    });
                } else {
                    $(this).html('<i class="fas fa-xmark"></i> Cancel Adjust');
                    $(this).addClass('btn-outline-danger');
                    $(this).removeClass('btn-outline-info');

                    $('#item_form [name="minimum_stock[]"]').each(function() {
                        $(this).prop('disabled', false)
                        $(this).prop('required', true)
                        $(this).addClass(['bg-light-info', 'border-info'])
                    });
                    $('#item_form [name="stock[]"]').each(function() {
                        $(this).prop('disabled', false)
                        $(this).prop('required', true)
                        $(this).addClass(['bg-light-info', 'border-info'])
                    });
                    $('#item_form [name="serial_number[]"]').each(function() {
                        $(this).prop('disabled', false)
                        $(this).addClass(['bg-light-info', 'border-info'])
                    });
                    $('.edit_section').fadeIn();
                    $('#unit-1').each(function() {
                        $(this).removeClass('col-lg-2')
                        $(this).addClass('col-lg-1')
                    });
                    $('.unit').each(function() {
                        $(this).removeClass('col-lg-2')
                        $(this).addClass('col-lg-1')
                    });
                }

                isEdit = !isEdit;
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
                            name="add_serial_number[]" value=${serialNumber}>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="number" class="form-control form-control-solid"
                            required name="add_stock[]" min="0" step="any" value=${stock}>
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="number" class="form-control form-control-solid"
                            required name="add_minimum_stock[]" min="0" step="any" value=${minimumStock}>
                    </div>

                    <div class="col-lg-1 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            hidden name="add_inventory_unit_master_id[]" value=${unitId}>
                        <input type="text" class="form-control form-control-solid" disabled
                            value="${((itemUnit.find(({ id }) => id == unitId))).code}">
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            hidden name="add_inventory_good_condition_id[]" value=${goodConditionId}>
                        <input type="text" class="form-control form-control-solid" disabled
                            value="${(itemCondition.find(({ id }) => id == goodConditionId)).name}">
                    </div>

                    <div class="col-lg-2 mb-3">
                        <input type="text" class="form-control form-control-solid"
                            hidden name="add_inventory_good_status_id[]" value=${goodStatusId}>
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

            $('#item_form').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.inventory.adjust-item') }}",
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
                            window.location.reload();
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
