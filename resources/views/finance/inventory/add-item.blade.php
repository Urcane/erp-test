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
                            <div class="col-lg-12 mb-9 text-center">
                                <h4>ADD ITEM INVENTORY</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <form class="form row" enctype="multipart/form-data" id="time_off_form">
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Time Off Name</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="filterWarehouse" id="filter_warehouse">
                                            <option value="*">Semua Warehouse</option>
                                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Item Name</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Name"
                                            required name="name">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Select Merk</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="filterWarehouse" id="filter_warehouse">
                                            <option value="*">Semua Warehouse</option>
                                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Select Item Code</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="filterWarehouse" id="filter_warehouse">
                                            <option value="*">Semua Warehouse</option>
                                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Select Category</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="filterWarehouse" id="filter_warehouse">
                                            <option value="*">Semua Warehouse</option>
                                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Select Satuan Unit</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="filterWarehouse" id="filter_warehouse">
                                            <option value="*">Semua Warehouse</option>
                                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">SN/PN/MAC</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Name"
                                            required name="name">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Kondisi Barang</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            name="filterWarehouse" id="filter_warehouse">
                                            <option value="*">Semua Warehouse</option>
                                            @foreach ([1, 2, 3, 4, 5, 6] as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Minimum Stock</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid" placeholder="Name"
                                            required name="name">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Stock Awal</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid" placeholder="Name"
                                            required name="name">
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

    <script></script>
@endsection
