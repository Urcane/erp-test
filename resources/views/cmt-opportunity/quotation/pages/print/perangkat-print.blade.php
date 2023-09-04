{{-- @dd($dataFinalBoq); --}}
<div class="h-200px"></div>
<div class="mt-0 row">
    <div class="col-8">
        <div class="row">
            <div class="container">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Spesifikasi Kebutuan</th>
                            <th>Merk</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($dataFinalBoq[0]->itemable))
                            @foreach ($dataFinalBoq[0]->itemable->where('inventoryGood.good_category_id', '!=', 3) as $relatedItem)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $relatedItem->inventoryGood->good_name ?? null }}</td>
                                    <td></td>
                                    <td>{{ $relatedItem->inventoryGood->merk ?? null }}</td>
                                    <td>{{ $relatedItem->quantity ?? null }}</td>
                                    <td></td>
                                    <td>{{ $relatedItem->purchase_price ?? null }}</td>
                                    <td>{{ $relatedItem->total_price ?? null }}</td>
                                </tr>
                                @php
                                    $finalPrice += $relatedItem->total_price ?? 0; // Add the item's total price to the total
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                    <tr >
                        <td colspan="6"></td> 
                        <td class="font-weight-bold">Total Price:</td>
                        <td class="font-weight-bold">{{ $finalPrice }}</td> <!-- Display the calculated total price -->
                    </tr>
                </table>
                
            </div>
        </div>
    </div>
</div>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

