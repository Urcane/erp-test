{{-- @dd($dataBoq); --}}
@extends('layouts.print')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-QUOTATION')
@section('desc-apps','Print Quotation')
@section('icon-apps','fa-solid fa-briefcase')
@section('print-title', 'Quotation Perangkat')

@section('content')
<div class="mt-10 row">
    <div class="col-12">
        <div class="row">
            <div class="col-6 mb-10 fs-5">
                <div class="row">
                    <div class="col-3">No.</div>
                    <div class="col-9">: {{$dataQuotation->no_quotation}}</div>
                    <div class="col-3">Perihal</div>
                    <div class="col-9">: Penawaran Harga</div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6 mb-10 fs-5 fw-bold">
                <div class="row">
                    <div class="col-12">{{$dataBoq[0]->customerProspect->customer->customer_name}}</div>
                    <div class="col-12">Di Tempat</div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-12 mb-10 fs-5">
                <div class="row">
                    <div class="col-12">Bersama ini kami sampaikan penawaran harga untuk <span class="fw-bold">{{$dataBoq[0]->customerProspect->prospect_title ?? 'Project Perusahaan'.$dataBoq[0]->customerProspect->customer->customer_name}}</span> sebagai Berikut </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-bordered border rounded">
                    <thead class="thead border bg-warning">
                        <tr>
                            <th class="text-center">No</th>
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
                        @if (isset($dataBoq[0]->itemable))
                            @foreach ($dataBoq[0]->itemable as $relatedItem)
                                <tr class="border">
                                    <td class="text-center">{{ $index++ }}</td>
                                    <td>{{ $relatedItem->inventoryGood->good_name ?? null }}</td>
                                    <td></td>
                                    <td>{{ $relatedItem->inventoryGood->merk ?? null }}</td>
                                    <td>{{ $relatedItem->quantity ?? null }}</td>
                                    <td>{{ $relatedItem->unitRelation->name ?? null }}</td>
                                    <td>{{ round($relatedItem->markup_price / $relatedItem->quantity, 0) ?? null }}</td>
                                    <td>{{ $relatedItem->markup_price ?? null }}</td>
                                </tr>
                                @php
                                    $finalPrice += $relatedItem->markup_price ?? 0; // Add the item's total price to the total
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                    <tr class="border">
                        <td colspan="6"></td> 
                        <td class="font-weight-bold border">Total Price:</td>
                        <td class="font-weight-bold border">{{ $finalPrice }}</td> <!-- Display the calculated total price -->
                    </tr>
                </table>
            </div>
            <div class="col-12 mb-10 fs-5">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">Terms And Conditions</p>
                        <div class="ms-10">
                            <p class="m-0">1.	Harga belum termasuk PPN 11%</p>
                            <p class="m-0">2.	Masa berlaku harga 5 hari terhitung sejak penawaran ini dibuat</p>
                            <p class="m-0">3.	Harga sudah termasuk biaya pengiriman</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-10 fs-5">
                <div class="row">
                    <div class="col-12">Demikian kami sampaikan Surat Penawaran Harga ini. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.</div>
                </div>
            </div>
            <div class="col-8"></div>
            <div class="col-4 mb-10 fs-5">
                <div class="row">
                    <div class="col-12">Balikpapan, {{\Carbon\Carbon::parse($dataQuotation->updated_at)->format('d F Y')}}</div>
                    <div class="col-12">Hormat Kami,</div>
                    @if (isset($dataBoq[0]->sales))
                    <img src="{{asset('sense/media/sign_pegawai') . '/' . $dataBoq[0]->sales->sign_file ?? ''}}" class="col-12">
                    <div class="col-12">{{$dataBoq[0]->sales->name ?? 'Unknown'}}</div>
                    @else
                    <div class="col-12 h-100px"></div>
                    @endif
                    <div class="col-12">PT. Comtelindo</div>
                    <div class="col-12">Phone :  08115927991</div>
                    <div class="col-12 fs-7 text-primary">sales@comtelindo.com</div>
                </div>
            </div>
            <div class="col-12 mb-10 fs-5">
                <div class="row text-center justify-content-center">
                    {{-- footer --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
