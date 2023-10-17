@extends('finance.inventory.layout.layout')

@section('title-apps','Inventory')
@section('sub-title-apps','Finance')

@section('main_content')
    <div class="col-lg-9 mt-md-n14">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 text-center mt-5 mb-9">
                    <span class="fs-3 fw-bolder text-dark d-block mb-1">DASHBOARD</span>
                </div>
                <div class="row justify-content-between mb-8">
                    <div class="col-3">
                        <div
                            class="px-3 py-1 rounded-4 border border-2 border-info d-flex justify-content-start align-items-center">
                            <img src="{{ asset('sense/media/images/Available.png') }}" class="py-2 me-1 img-fluid"
                                style="height: 80px">
                            <div class="align-items-center justify-content-center">
                                <div class="text-info fw-bolder fs-3">{{ $stocks->availableStock }} Item</div>
                                <div class="text-muted">Available Stock</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div
                            class="px-3 py-1 rounded-4 border border-2 border-info d-flex justify-content-start align-items-center">
                            <img src="{{ asset('sense/media/images/Low.png') }}" class="py-2 img-fluid"
                                style="height: 80px">
                            <div class="align-items-center justify-content-center">
                                <div class="text-info fw-bolder fs-3">{{ $stocks->lowStock }} Item</div>
                                <div class="text-muted">Low Stock</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div
                            class="px-3 py-1 rounded-4 border border-2 border-info d-flex justify-content-start align-items-center">
                            <img src="{{ asset('sense/media/images/Out.png') }}" class="py-2 img-fluid"
                                style="height: 80px">
                            <div class="align-items-center justify-content-center">
                                <div class="text-info fw-bolder fs-3">{{ $stocks->outOfStock }} Item</div>
                                <div class="text-muted">Out of Stock</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div
                            class="px-3 py-1 rounded-4 border border-2 border-info d-flex justify-content-start align-items-center">
                            <img src="{{ asset('sense/media/images/Warehouse.png') }}" class="py-2 img-fluid"
                                style="height: 80px">
                            <div class="align-items-center justify-content-center">
                                <div class="text-info fw-bolder fs-3">{{ $warehouseCount }}</div>
                                <div class="text-muted">Warehouse</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-5 mb-4">
                    <span class="fs-5 fw-bolder text-dark d-block mb-1">RECENT HISTORY</span>
                </div>
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-top table-striped border table-rounded gy-5 dataTable no-footer"
                            id="kt_table_pegawai" aria-describedby="kt_table_pegawai_info" style="width: 1202px;">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th class="text-center w-100px" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 70.25px;">
                                        #
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 325.25px;">
                                        Item Name
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 150.25px;">
                                        Status
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 275.25px;">
                                        Warehouse
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 200.25px;">
                                        Category
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 197.25px;">
                                        Stock
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                                @for ($i = 0; $i < 5; $i++)
                                    <tr class="odd">
                                        <td class="text-center">{{$i * 2 + 1}}</td>
                                        <td>Nama Item</td>
                                        <td><span class="badge px-3 py-2 badge-light-primary">ADJUST</span></td>
                                        <td>HO Balikpapan</td>
                                        <td>Radio</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="even">
                                        <td class="text-center">{{$i * 2 + 2}}</td>
                                        <td>Nama Item</td>
                                        <td><span class="badge px-3 py-2 badge-light-primary">ADJUST</span></td>
                                        <td>HO Balikpapan</td>
                                        <td>Radio</td>
                                        <td>3</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
