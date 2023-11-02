@extends('layouts.app')
@section('title-apps', 'Detail Procurement')
@section('sub-title-apps', 'Procurement')
@section('desc-apps', 'Detail informasi procuremetn')
@section('icon-apps', 'fa-solid fa-box-open')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')

    <div class="modal fade" id="modal_status_item" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_status_item_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="scroll-y me-n10 pe-10" id="modal_status_item_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_status_item_header"
                            data-kt-scroll-wrappers="#modal_status_item_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Status Item</span>
                                </div>

                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_status_item_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_status_item_submit"
                                class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment_procurement" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="payment_procurement_procurement_form" enctype="multipart/form-data">
                        <div class="scroll-y me-n10 pe-10" id="payment_procurement_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#payment_procurement_header" data-kt-scroll-wrappers="#payment_procurement_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Request Payment</span>
                                    {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Status</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid" data-control="select2"
                                        name="payment_type" id="payment_type" required>
                                        <option value="" selected hidden disabled>Pilih status terbaru</option>
                                        @foreach ($paymentCategory as $data)
                                            <option value="{{ $data }}">{{ $data }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @include("finance.procurement.form-procurement-item-part.payment-form", ['required' => true])
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2"
                                        for="description">
                                        <span class=" required fw-bold">Description</span>
                                    </label>
                                    <textarea required name="description" id="description" cols="30" rows="10" class="form-control form-control-solid" placeholder="Masukkan deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="payment_procurement_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="payment_procurement_submit" class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h4 class="mb-5 col-lg-6">Procurement Information</h4>
                                <div class="col-lg-6 text-end">
                                    <a href="#payment_procurement" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_payment_procurement"><i class="fa-solid fa-plus"></i>Request Payment</a>
                                </div>
                                @include("finance.procurement.form-procurement-item-part.basic-form")
                                <div class="col-lg-6">
                                    <h4>Item Procurement</h4>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table align-top table-striped border table-rounded gy-5"
                                            id="kt_table_item">
                                            <thead class="">
                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                    <th class="w-50px text-center">#</th>
                                                    <th class="w-200px">Name</th>
                                                    <th class="w-200px">Spesification</th>
                                                    <th class="w-200px">Quantity</th>
                                                    <th class="">Price</th>
                                                    <th class="">Jasa Antar</th>
                                                    <th class="">Total Price</th>
                                                    <th class="w-50px text-center">#</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-7">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="checklist" class="col-lg-12">
                                    @foreach ($procurement->payments as $payment)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="card h-100 ">
                                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                                    <a href="#payment_procurement" data-bs-toggle="modal" class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                                        <div class="symbol symbol-60px mb-5 position-relative">
                                                            <img src="{{ asset('/sense/media/svg/files/default-file.svg') }}" class="theme-light-show" alt="">
                                                            <img src="{{ asset('/sense/media/svg/files/default-file.svg') }}" class="theme-dark-show" alt="">
                                                        </div>

                                                        <div class="fs-5 fw-bold mb-2">
                                                            <div>
                                                                <span>{{$payment->payment_type}}</span><br>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <div class="fs-7 fw-semibold text-gray-400">
                                                        <span>Rp. {{$payment->nominal}}</span>
                                                        <span>{{$payment->status}}</span> <br>
                                                        {{Carbon\Carbon::parse($payment->payment_date)->diff(Carbon\Carbon::now())->format('%d days ago')}}
                                                        <a href="#payment_procurement" data-id="{{$payment->id}}" data-bs-toggle="modal" class="payment-detail dropdown-item py-2 text-info"><i class="fa-solid fa-eye me-3 text-info"></i> Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".payment-detail").click(function (e) {
                const id = $(this).data("id");
                $.ajax({
                    url: "{{ route('com.procurement.getPaymentProcurement') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        toastr.info('Loading...', 'Please wait');
                    },
                    success: function(data) {
                        $(`#payment_type`).each(function() {
                            if (category_id == parseInt($(this).val())) {
                                $(this).prop("selected", true);
                            }
                        });
                        $("#nominal").val(data.nominal);
                        $("#payment_date").val(data.payment_date);
                        $("#payment_method").val(data.payment_method);
                        $("#description").val(data.description);
                        $("#payment_procurement_submit").hide();
                        $("#payment_procurement_cancel").hide();
                        $("#recipe").hide();


                    }
                })
            })

            $("#payment_procurement_procurement_form").submit(function(e) {
                event.preventDefault();
                var formData = new FormData(this); // Use FormData to include file input

                $.ajax({
                    url: "{{ route('com.procurement.addPaymentProcurement' , ['id' => $procurement->id]) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content type
                    beforeSend: function() {
                        toastr.info('Loading...', 'Please wait');
                    },
                    success: function(data) {
                        toastr.success(data.message,'Selamat 🚀 !');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                })
            });

            generateDatatable({
                elementName: "#kt_table_item",
                ajaxLink: "{{ route('com.procurement.getTableItemProcurement') }}",
                filters: {
                    id: {{ $procurement->id }},
                },
                columnData: [
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'good_name'
                    },

                    {
                        data: 'spesification'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'shipping_price'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        })
    </script>
@endsection
