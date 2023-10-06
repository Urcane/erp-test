@extends('layouts.app')
@section('title-apps', 'New Procurement')
@section('sub-title-apps', 'Procurement')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="modal fade" id="modal_detail_item" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <div class="col-lg-12 text-center mb-9">
                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Detail Item</span>
                    </div>
                    <div class="scroll-y me-n10 pe-10" id="modal_status_item_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_status_item_header"
                        data-kt-scroll-wrappers="#modal_status_item_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">

                                <div class="row mb-9">

                                    <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Nama Item</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="good_name" id="good_name" disabled>
                                    </div>

                                    <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Jenis Item</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="good_type" id="good_type" disabled>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <!-- Tambahkan atribut "data-url" pada select merek -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Merek</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="merk" id="merk" disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Detail Item inventory</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="detail" id="detail" disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Spesification</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" disabled
                                            name="spesification" id="spesification">
                                    </div>


                                    <div class="col-lg-12 mb-3">
                                        <div class="separator my-3"></div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Quantity</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid "
                                                    readonly="readonly" disabled
                                                    name="quantity" id="quantity">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Tipe Unit</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid "
                                                    readonly="readonly" disabled name="unit"
                                                    id="unit">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="separator my-3"></div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Rute Pengiriman</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text"
                                                    name="delivery_route" id="delivery_route" disabled>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Tipe Pengiriman</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text"
                                                    name="delivery_type" id="delivery_type" disabled>
                                            </div>

                                            <div class="col-lg-6 col-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Harga Beli</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid " disabled
                                                    name="purchase_price" id="purchase_price">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Jasa antar</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid" disabled
                                                    name="purchase_delivery"
                                                    id="purchase_delivery_charge">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Markup Price</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled="disabled"
                                                        class="form-control form-control-solid"
                                                        name="markup" id="markup">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Lokasi Barang</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text" disabled
                                                    name="purchase_from" id="purchase_from">
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Toko Referensi / Suplier</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="purchase_reference" id="purchase_reference">
                                            </div>

                                            <div class="col-lg-8 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Jenis Pembayaran</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text" disabled
                                                    name="payment_type" id="payment_type">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Batas Waktu</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="number" disabled
                                                    name="purchase_validity" id="purchase_validity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end ">
                                        <div class="w-20 me-10 mt-5">
                                            <span class="fw-bold">Total Amount : Rp. <span
                                                    id="total"></span></span>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card p-10">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1">
                                    <a href="{{ route('com.procurement.index') }}" class="fw-bold"><i
                                            class="fa-solid fa-arrow-left "></i> Back</a>
                                </div>
                                <div class="col-lg-10 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Add New Customer Request</span>
                                </div>

                                <div class="flex-column current" data-kt-stepper-element="content">
                                    <form action="" id="form_procurement">
                                        <div class="mb-3">
                                            <label class="fs-6 form-label mb-2" for="itemable_quotation_part_id">
                                                <span class="required fw-bold">Select Quotation</span>
                                            </label>
                                            <select class="drop-data form-select form-select-solid"
                                                data-control="itemable_quotation_part_id" required
                                                name="itemable_quotation_part_id" id="itemable_quotation_part_id">
                                                @if (($procurement->itemable_quotation_part_id ?? old('itemable_quotation_part_id')) == null)
                                                    <option value="" selected hidden disabled>Select Quotation Number
                                                    </option>
                                                @endif
                                                @foreach ($quotations as $quotation)
                                                    <option value="{{ $quotation->id }}"
                                                        @if (($procurement->itemable_quotation_part_id ?? old('itemable_quotation_part_id')) == $quotation->id) selected @endif>
                                                        {{ $quotation->no_quotation }}</option>
                                                @endforeach
                                            </select>
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <div id="main-form" class="d-none row">
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="no_pr">
                                                    <span class="required fw-bold">No. Procurement</span>
                                                </label>
                                                <input type="text" id="no_pr" class="form-control form-control-solid"
                                                    placeholder="No. Procurement" required name="no_pr">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="ref_po_spk_pks">
                                                    <span class="required fw-bold">Ref PO/SPK/PKS Pelanggan</span>
                                                </label>
                                                <input type="text" id="ref_po_spk_pks"
                                                    class="form-control form-control-solid"
                                                    placeholder="Ref PO/SPK/PKS Pelanggan" required name="ref_po_spk_pks">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ref_ph">
                                                    <span class="required fw-bold">Ref PH</span>
                                                </label>
                                                <input type="text" id="ref_ph" class="form-control form-control-solid"
                                                    placeholder="Ref PH" required name="ref_ph">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="requester">
                                                    <span class="required fw-bold">Requester</span>
                                                </label>
                                                <input type="text" id="requester" class="form-control form-control-solid"
                                                    placeholder="Nama Requester" required name="requester">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="customer">
                                                    <span class="required fw-bold">Calon Pelanggan</span>
                                                </label>
                                                <input type="text" id="customer" class="form-control form-control-solid"
                                                    placeholder="Nama Calon Pelanggan" required name="customer">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="need">
                                                    <span class="required fw-bold">Peruntukan</span>
                                                </label>
                                                <input type="text" id="need" class="form-control form-control-solid"
                                                    placeholder="Peruntukan" required name="need">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="request_date">
                                                    <span class="required fw-bold">Tanggal Request</span>
                                                </label>
                                                <input type="date" id="request_date"
                                                    class="form-control form-control-solid" required name="request_date">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="delivery_location">
                                                    <span class="required fw-bold">Lokasi Pengiriman</span>
                                                </label>
                                                <input type="text" id="delivery_location"
                                                    class="form-control form-control-solid" placeholder="Lokasi Pengiriman"
                                                    required name="delivery_location">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <hr class="my-10">
                                            <div class="col-lg-6 mb-9">
                                                <h4>Item From BOQ</h4>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="table-responsive mt-10">
                                                    <table class="table align-top table-striped border table-rounded gy-5"
                                                        id="kt_table_item">
                                                        <thead class="">
                                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                <th class="text-center w-50px">#</th>
                                                                <th class="w-50px text-center">#</th>
                                                                <th class="w-200px">Name</th>
                                                                <th class="w-200px">Spesification</th>
                                                                <th class="w-200px">Quantity</th>
                                                                <th class="">Price</th>
                                                                <th class="">Jasa Antar</th>
                                                                <th class="">Total Price</th>
                                                                <th class="">Markup Price</th>
                                                                <th class="w-50px text-center">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fs-7">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="text-center mt-9 mb-10">
                                                <button type="reset" id="modal_status_item_cancel"
                                                    class="btn btn-sm btn-light me-3 w-lg-200px"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" id="modal_status_item_submit"
                                                    class="btn btn-sm btn-info w-lg-200px">
                                                    <span class="indicator-label">Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function getDetail(id) {
                $.ajax({
                    url: "{{ route('com.procurement.getDetailItem') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        console.log(data)
                        $("#good_name").val(data.data.inventory_good.good_name)
                        $("#good_type").val(data.data.inventory_good.good_type)
                        $("#merk").val(data.data.inventory_good.merk)
                        $("#detail").val(data.data.inventory_good.description)
                        $("#spesification").val(data.data.inventory_good.spesification)
                        $("#quantity").val(data.data.quantity)
                        $("#delivery_route").val(data.data.delivery_route)
                        $("#delivery_type").val(data.data.delivery_type)
                        $("#purchase_price").val(data.data.purchase_price)
                        $("#purchase_delivery_charge").val(data.data.purchase_delivery_charge)
                        $("#markup").val(data.data.markup_price)
                        $("#quantity").val(data.data.quantity)
                        $("#purchase_form").val(data.data.purchase_form)
                        $("#purchase_reference").val(data.data.purchase_reference)
                        $("#payment_type").val(data.data.payment_type)
                        $("#purchase_validity").val(data.data.purchase_validity)
                        $("#total").html(data.data.total_price)
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                })
            }
            $('#form_procurement').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('com.procurement.storeProcurement') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                })
            })
            $('#itemable_quotation_part_id').change(function() {
                var id = $(this).val()
                $('#main-form').removeClass("d-none")
                generateDatatable({
                    elementName: "#kt_table_item",
                    ajaxLink: "{{ route('com.procurement.getTableItemFromQuotation') }}",
                    filters: {
                        id: id,
                    },
                    columnData: [{
                            data: 'DT_RowChecklist',
                            orderable: false,
                            searchable: false
                        },
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
                            data: 'purchase_price'
                        },
                        {
                            data: 'purchase_delivery_charge'
                        },
                        {
                            data: 'total_price'
                        },
                        {
                            data: 'markup_price'
                        },
                        {
                            data: 'action'
                        },
                    ]
                });
            })
        </script>
    @endsection
