{{-- @dd($dataQuotation); --}}
<div class="h-200px"></div>
<div class="mt-0 row">
    <div class="col-8">
        <div class="row">
            <div class="container">
                <p>Link Reference to Bill Of Quantity, <a href="{{ url("cmt-boq/review-done-boq?boq_id=". $dataQuotation->boq_id) }}">Click Here</a></p>
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Remark</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($dataFinalBoq[0]->itemable))
                            @foreach ($dataFinalBoq[0]->itemable->where('inventoryGood.good_category_id',3) as $relatedItem)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $dataFinalBoq[0]->customerProspect->customer->customer_name ?? null }}</td>
                                    <td>{{ $relatedItem->inventoryGood->good_name ?? null }}</td>
                                    <td></td>
                                    <td>{{ $relatedItem->quantity ?? null }}</td>
                                    <td>{{ $relatedItem->inventoryGood->merk ?? null }}</td>
                                    <td>{{ $relatedItem->purchase_price ?? null }}</td>
                                    <td>{{ $relatedItem->total_price ?? null }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Bootstrap JavaScript (jQuery required) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

