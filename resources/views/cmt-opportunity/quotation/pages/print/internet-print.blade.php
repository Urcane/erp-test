@extends('layouts.print')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-QUOTATION')
@section('desc-apps','Print Quotation')
@section('icon-apps','fa-solid fa-briefcase')
@section('print-title', 'Quotation Internet')

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
                    <div class="col-3">Lampiran</div>
                    <div class="col-9">: -</div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6 mb-10 fs-5 fw-bold">
                <div class="row">
                    <div class="col-12">Kepada Yth, </div>
                    <div class="col-12">{{$dataBoq[0]->customerProspect->customer->customer_name}}</div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-12 mb-10 fs-5">
                <div class="row">
                    <div class="col-12 fs-5" style="text-align: justify;">
                        <p>Dengan Hormat, </p>
                        <p>Bersama ini kami dari PT. COMTELINDO menawarkan layanan Internet. Tujuan kami adalah memberikan pelayanan  dan  akses  internet  yang  terbaik  bagi perusahaan Bapak/Ibu, sehingga dapat bermanfaat bagi perusahaan Bapak/Ibu. </p>
                        <p>Harapan kami bisa bekerjasama dengan perusahaan Bapak/Ibu dan dengan senang hati kami akan menjelaskan lebih detail mengenai penawaran ini bila ada informasi tambahan yang Bapak/Ibu butuhkan. </p>
                        <p>Demikian penawaran ini dapat kami sampaikan,  atas  perhatian  dan  waktu  yang  diberikan, kami ucapkan terima kasih. </p>
                    </div>
                </div>
            </div>
            <div class="col-8"></div>
            <div class="col-4 mb-10 fs-5">
                <div class="row">
                    <div class="col-12">Balikpapan, {{\Carbon\Carbon::parse($dataQuotation->updated_at)->format('d F Y')}}</div>
                    <div class="col-12">Hormat Kami,</div>
                    @if (isset($dataBoq[0]->sales))
                    <img src="{{asset('sense/media/sign_pegawai') . '/' . $dataBoq[0]->sales->sign_file ?? ''}}" class="col-12 mt-5">
                    <div class="col-12 mt-5">{{$dataBoq[0]->sales->name ?? 'Unknown'}}</div>
                    @else
                    <div class="col-12 h-100px"></div>
                    @endif
                    <div class="col-12">PT. Comtelindo</div>
                    <div class="col-12">Phone :  08115927991</div>
                    <div class="col-12 fs-7 text-primary">sales@comtelindo.com</div>
                </div>
            </div>
            <div class="h-425px"></div>
            <div class="col-12">
                <p>Link Reference to Bill Of Quantity, <a href="{{ url("cmt-boq/review-done-boq?boq_id=". $dataQuotation->boq_id) }}">Click Here</a></p>
                <table class="table table-bordered border">
                    <thead class="thead bg-warning border">
                        <tr class="border">
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
                        @if (isset($dataQuotation->itemableQuotation))
                            @foreach ($dataQuotation->itemableQuotation as $relatedItem)
                                <tr class="border">
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $dataBoq[0]->customerProspect->customer->customer_name ?? null }}</td>
                                    <td>{{ $relatedItem->inventoryGood->good_name ?? null }}</td>
                                    <td></td>
                                    <td>{{ $relatedItem->quantity ?? null }}</td>
                                    <td>{{ $relatedItem->unitRelation->name ?? null }}</td>
                                    <td>{{ $relatedItem->purchase_price ?? null }}</td>
                                    <td>{{ $relatedItem->total_price ?? null }}</td>
                                </tr>
                                @php
                                $finalPrice += $relatedItem->total_price ?? 0; // Add the item's total price to the total
                            @endphp
                            @endforeach
                        @endif
                    </tbody>
                    <tr class="border">
                        <td colspan="6"></td> 
                        <td class="font-weight-bold">Total Price:</td>
                        <td class="font-weight-bold">{{ $finalPrice }}</td> <!-- Display the calculated total price -->
                    </tr>
                </table>
            </div>
            <div class="col-12 mb-5 fs-5">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">A. Terms And Conditions</p>
                        <div class="ms-10">
                            <p class="m-0">1.	Harga belum termasuk PPN 11%</p>
                            <p class="m-0">2.	SLA 97%</p>
                            <p class="m-0">3.	Harga Instalasi bisa berubah setelah survey on site</p>
                            <p class="m-0">4.	Pembayaran biaya bulanan wajib dibayarkan paling lambat tanggal 20 setiap bulannya</p>
                            <p class="m-0">5.	Invoice akan dikirimkan setiap tanggal 5 setiap bulannya</p>
                            <p class="m-0">6.	Minimal kontrak 1 tahun</p>
                            <p class="m-0">7.	Harga diatas belum termasuk Biaya Medical Administration (PCR, Karantina, Antigen , dll), Jika diperlukan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-5 fs-5">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">B. Terms And Conditions</p>
                        <div class="ms-10">
                            <p class="m-0">1.	Perangkat dipinjamkan selama masa kontrak</p>
                            <p class="m-0">2.	IP Public</p>
                            <p class="m-0">3.	Technical Support 24jam</p>
                            <p class="m-0">4.	<b>Comtelindo</b> memberikan fasilitas Router Mikrotik untuk QoS/Management Bandwidth + WiFi selama berlangganan<b>*</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-5 fs-5">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">C. Media Koneksi</p>
                        <div class="ms-10">
                            Media koneksi yang digunakan untuk Internet adalah Radio Wireless / Fiber Optic / VSAT.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-5 fs-5">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">D. Problem Escalation Procedure</p>
                        <div class="">
                            <table class="table table-bordered border">
                                <thead class="thead border">
                                    <tr class="border">
                                        <td class="text-center">No</td>
                                        <td>Customer Care (Kalimantan Region)</td>
                                        <td>Time</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border">
                                        <td class="text-center">1. </td>
                                        <td> 
                                            <p class="fw-bold">NOC Comtelindo</p>
                                            <p class="m-0">Mobile : +62816200255</p>
                                            <p class="m-0">email  : noc@comtelindo.com</p>
                                        </td>
                                        <td class="justify-content-right text-right"> < 2 Hours</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="text-center">2. </td>
                                        <td> 
                                            <p class="fw-bold">Technical Operation Manager</p>
                                            <p class="m-0">Mobile : +62 8115919055</p>
                                            <p class="m-0">email  : bambang@comtelindo.com</p>
                                        </td>
                                        <td class="justify-content-right text-right"> > 2-24 Hours</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="text-center">3. </td>
                                        <td> 
                                            <p class="fw-bold">Director</p>
                                            <p class="m-0">Mobile : +62 8115996706</p>
                                            <p class="m-0">email  : hari@comtelindo.com</p>
                                        </td>
                                        <td class="justify-content-right text-right"> > 24 Hours</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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


