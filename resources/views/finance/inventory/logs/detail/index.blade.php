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
                            <div class="col-lg-12 text-center mt-5 mb-9">
                                <span class="fs-3 fw-bolder text-dark d-block mb-1">{{ $name }} Logs</span>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table align-top border table-rounded gy-5" id="kt_table_inventory">
                                        <thead class="">
                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                                <th class="text-center w-50px">#</th>
                                                <th class="w-150px">Tanggal</th>
                                                <th class="w-300px">Nama Kegiatan</th>
                                                <th class="w-150px">Status</th>
                                                <th class="w-150px">Warehouse</th>
                                                <th class="w-200px">Jumlah Item</th>
                                                <th class="w-100px">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-7">
                                            @php
                                                $i = 0;
                                            @endphp

                                            @foreach($recentLogs as $log)
                                                <tr class="@if ($i % 2 == 0) even @else odd @endif">
                                                    <td class="text-center">{{ $i + 1 }}</td>
                                                    <td>{{ $log->warehouseGoodLog->inventoryGood->good_name }}</td>
                                                    <td>
                                                        @include('finance.inventory.components.badge', [
                                                            'status' => $log->warehouseGoodLog->warehouseLog->status,
                                                            'statusEnum' => $statuses
                                                        ])
                                                    </td>
                                                    <td>{{ $log->warehouseGoodLog->warehouseLog->warehouse->name }}</td>
                                                    <td>{{ $log->warehouseGoodLog->inventoryGood->inventoryGoodCategory->name }}</td>
                                                    @if($log->stock > 0)
                                                        <td class="text-center text-success">
                                                            + {{ $log->stock }}
                                                        </td>
                                                    @else
                                                        <td class="text-center text-danger">
                                                            - {{ $log->stock * -1 }}
                                                        </td>
                                                    @endif
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
