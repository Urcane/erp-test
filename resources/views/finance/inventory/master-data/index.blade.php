@extends('finance.inventory.layout.layout')

@section('title-apps', 'Inventory')
@section('sub-title-apps', 'Finance')

@section('main_content')
    <div class="col-lg-9 mt-md-n14">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 text-center mt-5 mb-9">
                    <span class="fs-3 fw-bolder text-dark d-block mb-1">MASTER DATA</span>
                </div>
                <div class="col-lg-12 row rounded">
                    <div class="d-grid">
                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active"
                                    data-bs-toggle="tab" id="warehousenav" href="#warehouse">Warehouse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                    data-bs-toggle="tab" id="categorynav" href="#category">Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                    data-bs-toggle="tab" id="unitnav" href="#unit">Satuan Unit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                    data-bs-toggle="tab" id="conditionnav" href="#condition">Kondisi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                    data-bs-toggle="tab" id="statusnav" href="#status">Status</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="unit" role="tabpanel">
                            @include('finance.inventory.master-data.warehouse.index')
                        </div>

                        <div class="tab-pane fade" id="category" role="tabpanel">
                            @include('finance.inventory.master-data.category.index')
                        </div>

                        <div class="tab-pane fade" id="unit" role="tabpanel">
                            @include('finance.inventory.master-data.unit.index')
                        </div>

                        <div class="tab-pane fade" id="condition" role="tabpanel">
                            @include('finance.inventory.master-data.condition.index')
                        </div>

                        <div class="tab-pane fade" id="status" role="tabpanel">
                            @include('finance.inventory.master-data.status.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('finance.inventory.master-data.script')
@endsection
