@extends('finance.invoice.layout.layout')

@section('main_content')
    <div class="col-lg-9 mt-md-n14">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-4">
                    <span class="fs-3 fw-bolder text-dark d-block mb-1">INVOICE LIST</span>
                </div>
                <div class="col-lg-8 d-flex justify-content-end">
                    <div class="input-group w-150px w-md-250px mx-4">
                        <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input class="form-control form-control-solid form-control-sm" autocomplete="off"
                            id="search">
                    </div>

                    <div>
                        <button type="button" class="btn btn-light-info btn-sm me-3" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"><i class="fa-solid fa-filter me-2"></i>Filter</button>
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px text-start" id="filter" data-kt-menu="true" style="">
                            <div class="d-flex flex-column bgi-no-repeat rounded-top">
                                <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Filter Options</span>
                            </div>
                            <div class="separator mb-6"></div>
                            <div class="row px-8 pb-6">
                                {{-- <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 mb-2">
                                        <span class="fw-bold textd-dark">Department</span>
                                    </label>
                                    <select class="form-select form-select-sm form-select-solid" data-control="select2" required name="filterDepartment" id="filter_department" data-dropdown-parent="#filter">
                                        <option value="*">Semua Department</option>
                                        @foreach ($dataDepartment as $dp)
                                        <option value="{{$dp->id}}">{{$dp->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="col-lg-12 mt-6 text-end">
                                    <button class="btn btn-sm btn-light" id="btn_reset_filter">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @can('FIN:add-inventory') --}}
                        <a href="{{ route('fin.inv.inventory-create') }}" class="btn btn-info btn-sm me-3 fs-8">
                            <i class="fa-solid fa-plus"></i>
                            Add Invoice
                        </a>
                    {{-- @else
                        <div class="btn btn-outline btn-outline-muted text-muted btn-sm me-3 fs-8 cursor cursor-not-allowed">
                            <i class="fa-solid fa-plus"></i>
                            Add (Resisted)
                        </div>
                    @endcan --}}
                </div>

                <div class="dataTables_wrapper dt-bootstrap4 no-footer mt-6">
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
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 197.25px;"
                                        class="text-center">
                                        Stock
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                                @for ($i = 0; $i < 5; $i++)
                                    <tr class="odd">
                                        <td class="text-center">{{ $i * 2 + 1 }}</td>
                                        <td>Nama Item</td>
                                        <td><span class="badge px-3 py-2 badge-light-primary">ADJUST</span></td>
                                        <td>HO Balikpapan</td>
                                        <td>Radio</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="even">
                                        <td class="text-center">{{ $i * 2 + 2 }}</td>
                                        <td>Nama Item</td>
                                        <td><span class="badge px-3 py-2 badge-light-primary">ADJUST</span></td>
                                        <td>HO Balikpapan</td>
                                        <td>Radio</td>
                                        <td>3</td>
                                    </tr>
                                @endfor
                                {{-- @foreach ($recentLogs as $key => $log)
                                    <tr class="@if ($key % 2 == 0) even @else odd @endif">
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $log->warehouseGoodLog->inventoryGood->good_name }}</td>
                                        <td>
                                            @include('finance.inventory.components.badge', [
                                                'status' => $log->warehouseGoodLog->warehouseLog->status,
                                                'statusEnum' => $statuses
                                            ])
                                        </td>
                                        <td>{{ $log->warehouseGoodLog->warehouseLog->warehouse->name }}</td>
                                        <td>{{ $log->warehouseGoodLog->inventoryGood->inventoryGoodCategory->name }}</td>
                                        @if ($log->stock > 0)
                                            <td class="text-center text-success fw-bold">
                                                + {{ $log->stock }}
                                            </td>
                                        @else
                                            <td class="text-center text-danger fw-bold">
                                                - {{ $log->stock * -1 }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
