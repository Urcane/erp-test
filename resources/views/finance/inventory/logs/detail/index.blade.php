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
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-12 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mt-5 mb-9 d-flex justify-content-between">
                                <span class="fs-3 fw-bolder text-dark d-block mb-1">Logs Kegiatan :
                                    {{ $log->name }}</span>
                                @include('finance.inventory.components.badge', [
                                    'status' => $log->status,
                                    'statusEnum' => $statuses,
                                ])
                            </div>

                            <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                                <p class="fw-bold fs-4">Deskripsi Gudang</p>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Nama Gudang</span>
                                    </label>
                                    <div class="form-control form-control-solid">
                                        {{ $log->warehouse->name }}
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Keterangan Kegiatan</span>
                                    </label>
                                    <div class="form-control form-control-solid">
                                        {{ $log->description ? $log->description : 'Tidak ada keterangan' }}
                                    </div>
                                </div>

                                <hr class="mb-5 mt-4">

                                <p class="fw-bold fs-4">Detail Barang</p>

                                @foreach ($log->warehouseGoodLogs as $warehouseGoodLogs)
                                    <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                                        <div class="fw-bold fs-5 d-flex justify-content-between mb-3">
                                            <div>
                                                {{ $warehouseGoodLogs->inventoryGood->good_name }}
                                            </div>
                                            <div>
                                                {{ $warehouseGoodLogs->inventoryGood->inventoryGoodCategory->name }}
                                            </div>
                                        </div>
                                        <div class="fs-6 text-muted fw-bold d-flex justify-content-between">
                                            <div>
                                                Status - Kondisi Barang
                                            </div>
                                            <div>
                                                Jumlah Barang
                                            </div>
                                        </div>
                                        <hr class="mb-5 mt-4">

                                        @foreach ($warehouseGoodLogs->warehouseGoodStockLogs as $item)
                                            <div class="fs-6 d-flex justify-content-between">
                                                <div>
                                                    {{ $item->inventoryGoodStatus->name }} -
                                                    {{ $item->inventoryGoodCondition->name }}
                                                </div>
                                                @if ($item->stock > 0)
                                                    <div class="text-success fw-bold">
                                                        + {{ $item->stock }} {{ $item->inventoryUnitMaster->name }}
                                                    </div>
                                                @else
                                                    <div class="text-danger fw-bold">
                                                        {{ $item->stock }} {{ $item->inventoryUnitMaster->name }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
