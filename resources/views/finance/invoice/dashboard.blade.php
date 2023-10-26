@extends('finance.invoice.layout.layout')

@section('main_content')
    <div class="col-lg-9 mt-md-n14">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-12 text-center mt-5">
                    <span class="fs-3 fw-bolder text-dark d-block mb-1">MONTHLY SUMMARY</span>
                </div>
                <div class="col-lg-6 p-3">
                    <div class="rounded border border-2 border-secondary">
                        <div class="mt-3 ms-7">
                            <div class="text-info fw-bolder fs-2">Invoice Status</div>
                            <div class="text-muted fs-7 fw-bold">Total Invoice : 33</div>
                        </div>
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="col-lg-6 row p-4">
                    <div class="col-lg-12 mb-3 rounded border border-2 border-secondary d-flex align-items-center px-6">
                        <i class="fa-solid fa-people-group" style="font-size: 30px; color: #FF8D69"></i>
                        <div class="ms-6">
                            <div class="text-info fw-bolder fs-2">100</div>
                            <div class="text-muted fw-bold fs-6">Active Client</div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3 rounded border border-2 border-secondary d-flex align-items-center px-6">
                        <i class="fa-solid fa-wallet" style="font-size: 30px; color: #FF8D69"></i>
                        <div class="ms-6">
                            <div class="text-info fw-bolder fs-2">Rp 231.100.000,-</div>
                            <div class="text-muted fw-bold fs-6">Income</div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3 rounded border border-2 border-secondary d-flex align-items-center px-6">
                        <i class="fa-solid fa-money-bill-wave" style="font-size: 30px; color: #FF8D69"></i>
                        <div class="ms-6">
                            <div class="text-info fw-bolder fs-2">Rp 1.100.000,-</div>
                            <div class="text-muted fw-bold fs-6">Total Pending</div>
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
    <script>
        const status = @json($status);

        const renderChart = (data) => {
            const options = {
                series: data,
                labels: status,
                colors: ['#5215D3', '#07D974', '#DEF008', '#FF3C3C', '#C50909'],
                chart: {
                    type: 'donut',
                    width: 390,
                },
                legend: {
                    show: true,
                    position: 'right',
                    horizontalAlign: 'center'
                },
            };

            const chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        $(document).ready(function() {
            renderChart([10, 20, 30, 40, 50]);
        });
    </script>
@endsection
