@extends('layouts.app')
@section('title-apps', 'Detail Item Procurement')
@section('sub-title-apps', 'Procurement')
@section('desc-apps', 'Detail informasi dan status item')
@section('icon-apps', 'fa-solid fa-box-open')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="modal fade" id="update_status" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="update_status_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="scroll-y me-n10 pe-10" id="update_status_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#update_status_header" data-kt-scroll-wrappers="#update_status_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Category File</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Name" required name="name">
                            </div>
                        </div>
                    </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="update_status_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="update_status_submit" class="btn btn-sm btn-info w-lg-200px">
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
                            <div class="">
                                <div class="col-lg-12 mb-9 row">
                                    <div class="col-lg-2">
                                        <a href="{{ route('com.procurement.detail', ["id" => $procurementItem->procurement_id]) }}" class="fw-bold"><i
                                                class="fa-solid fa-arrow-left "></i> Back</a>
                                    </div>
                                    <div class="col-lg-8 text-center mb-9">
                                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Item Details</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="#update_status" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_update_status w-100"><i class="fa-solid fa-plus"></i>Update Status</a>
                                    </div>
                                </div>
                                <div class="col-lg-12 row mt-10">
                                    <h4>Item Information</h4>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="good_name">
                                            <span class="required fw-bold">Nama Item</span>
                                        </label>
                                        <input type="text" id="good_name" class="form-control form-control-solid"
                                            value="{{ $procurementItem->inventoryGood->good_name ?? old('good_name') }}" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="quantity">
                                            <span class="required fw-bold">Quantity</span>
                                        </label>
                                        <input type="text" id="quantity" class="form-control form-control-solid"
                                            value="{{ $procurementItem->quantity ?? old('quantity') }}" disabled name="quantity">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="no_po_nota">
                                            <span class="required fw-bold">No. PO/Nota</span>
                                        </label>
                                        <input type="text" id="no_po_nota" class="form-control form-control-solid"
                                            value="{{ $procurementItem->no_po_nota ?? old('no_po_nota') }}" disabled name="no_po_nota">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="purchase_number">
                                            <span class="required fw-bold">Nomor Pembelian</span>
                                        </label>
                                        <input type="text" id="purchase_number" class="form-control form-control-solid"
                                            value="{{ $procurementItem->purchase_number ?? old('purchase_number') }}" disabled name="purchase_number">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="need">
                                            <span class="required fw-bold">Kebutuhan</span>
                                        </label>
                                        <input type="text" id="need" class="form-control form-control-solid"
                                            value="{{ $procurementItem->need ?? old('need') }}" disabled name="need">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="price">
                                            <span class="required fw-bold">Price</span>
                                        </label>
                                        <input type="text" id="price" class="form-control form-control-solid"
                                            value="{{ $procurementItem->price ?? old('price') }}" disabled name="price">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 row mt-10">
                                    <h4>Order Information</h4>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="receipt_number">
                                            <span class="required fw-bold">Nomor Resi</span>
                                        </label>
                                        <input type="text" id="receipt_number" class="form-control form-control-solid"
                                            value="{{ $procurementItem->receipt_number ?? old('receipt_number') }}" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="quantity">
                                            <span class="required fw-bold">Quantity</span>
                                        </label>
                                        <input type="text" id="quantity" class="form-control form-control-solid"
                                            value="{{ $procurementItem->quantity ?? old('quantity') }}" disabled name="quantity">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="vendor">
                                            <span class="required fw-bold">Vendor</span>
                                        </label>
                                        <input type="text" id="vendor" class="form-control form-control-solid"
                                            value="{{ $procurementItem->vendor ?? old('vendor') }}" disabled name="vendor">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="vendor_location">
                                            <span class="required fw-bold">Vendor Location</span>
                                        </label>
                                        <input type="text" id="vendor_location" class="form-control form-control-solid"
                                            value="{{ $procurementItem->vendor_location ?? old('vendor_location') }}" disabled name="vendor_location">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="shipping_price">
                                            <span class="required fw-bold">Shipping Price</span>
                                        </label>
                                        <input type="text" id="shipping_price" class="form-control form-control-solid"
                                            value="{{ $procurementItem->shipping_price ?? old('shipping_price') }}" disabled name="shipping_price">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="payment_method">
                                            <span class="required fw-bold">Payment Method</span>
                                        </label>
                                        <input type="text" id="payment_method" class="form-control form-control-solid"
                                            value="{{ $procurementItem->payment_method ?? old('payment_method') }}" disabled name="payment_method">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="payment_method">
                                            <span class="required fw-bold">Payment Method</span>
                                        </label>
                                        <input type="text" id="payment_method" class="form-control form-control-solid"
                                            value="{{ $procurementItem->payment_method ?? old('payment_method') }}" disabled name="payment_method">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="expedition">
                                            <span class="required fw-bold">Expedition</span>
                                        </label>
                                        <input type="text" id="expedition" class="form-control form-control-solid"
                                            value="{{ $procurementItem->expedition ?? old('expedition') }}" disabled name="expedition">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="receipt_number">
                                            <span class="required fw-bold">Receipt Number</span>
                                        </label>
                                        <input type="text" id="receipt_number" class="form-control form-control-solid"
                                            value="{{ $procurementItem->receipt_number ?? old('receipt_number') }}" disabled name="receipt_number">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="information">
                                            <span class="required fw-bold">Information</span>
                                        </label>
                                        <input type="text" id="information" class="form-control form-control-solid"
                                            value="{{ $procurementItem->information ?? old('information') }}" disabled name="information">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <hr class="my-10">
                                <div class="col-lg-12 row">
                                    <h4>Status</h4>
                                    <div class="col-lg-12 d-flex flex-row mt-5 ms-5">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-regular fa-circle-check fs-1"></i>
                                        </div>
                                        <div class="ms-5">
                                            <h4>asfsdf</h4>
                                            <span>date</span><br>
                                            <span>asldkfjslkfa sdfalskdfjasdf</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
