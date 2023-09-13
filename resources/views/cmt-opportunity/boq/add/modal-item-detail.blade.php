<div class="modal fade" id="kt_modal_item_detail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="fw-bolder">Update Item</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_item_detail_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_item_detail_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_item_detail_header"
                        data-kt-scroll-wrappers="#kt_modal_item_detail_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">

                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Nama Item</span>
                                </label>
                                {{-- <select class="form-select form-select-solid drop-data" data-control="select2"  readonly="readonly" data-placeholder="Select an Item" name="good_name_item_detail" id="good_name_item_detail" data-dropdown-parent="#kt_modal_item_detail"
                                data-url="{{ route('get.merk.type') }}">
                                    <option></option>
                                    @if (isset($dataItem))
                                        @foreach ($dataItem as $gig)
                                            <option value="{{ $gig->id }}">{{ $gig->good_name }}</option>
                                        @endforeach
                                    @endif
                                    @if (isset($updateDraftBoqData["dataForm"]))
                                        @foreach ($updateDraftBoqData["dataForm"] as $item) 
                                            <option value="{{ $item->id }}">{{ $item->good_name }}</option>
                                        @endforeach
                                    @endif 
                                </select> --}}
                                
                                <input class="form-control form-control-solid" type="text" name="good_name_item_detail" id="good_name_item_detail" disabled> 
                            </div>

                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Jenis Item</span>
                                </label>
                                <input class="form-control form-control-solid" type="text" name="good_type_item_detail" id="good_type_item_detail" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <!-- Tambahkan atribut "data-url" pada select merek -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Merek</span>
                                </label>
                                <input class="form-control form-control-solid" type="text" name="merk_item_detail" id="merk_item_detail" disabled>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Detail Item inventory</span>
                                </label>
                                <input class="form-control form-control-solid" type="text" name="detail_item_detail" id="detail_item_detail" disabled>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Detail Item project</span>
                                </label>
                                <input class="form-control form-control-solid" type="text" disabled name="item_detail_item_detail" id="item_detail_item_detail" >
                            </div>


                            <div class="col-lg-12 mb-3">
                                <div class="separator my-3"></div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Quantity</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid "  readonly="readonly" disabled
                                            min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_item_detail', 'item_detail');" 
                                            name="quantity_item_detail" id="quantity_item_detail">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Tipe Unit</span>
                                        </label>
                                        {{-- <select class="form-select form-select-solid drop-data" data-control="select2" disabled  readonly="readonly" data-placeholder="Select an Item" name="unit_item_detail" id="unit_item_detail" data-dropdown-parent="#kt_modal_item_detail">
                                            <option></option>
                                                @foreach ($dataUnit as $unit)
                                                    <option value="{{ $unit->code }}">{{ $unit->name }}</option>
                                                @endforeach
                                        </select> --}}
                                        
                                        <input type="text" class="form-control form-control-solid "  readonly="readonly" disabled 
                                            name="unit_item_detail" id="unit_item_detail">
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
                                        <input class="form-control form-control-solid" type="text" name="delivery_route" id="delivery_route_item_detail" disabled>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Tipe Pengiriman</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" name="delivery_type" id="delivery_type_item_detail" disabled >
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Harga Beli</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid "  disabled
                                            min="1" minlength="3" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_item_detail', 'item_detail');"
                                            name="purchase_price_item_detail" id="purchase_price_item_detail">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Jasa antar</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid" disabled oninput="validateAndFormatNumber(this); calculateTotalAmount('total_item_detail', 'item_detail');"
                                            name="purchase_delivery_item_detail" id="purchase_delivery_charge_item_detail">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    @if(isset($boq_type) && $boq_type == "perangkat")
                                    <div class="col-12">
                                        <label class="form-label">Markup Price</label>
                                        <div class="position-relative">
                                            <div class="position-absolute top-0"></div>
                                            <input type="number" disabled="disabled" class="form-control form-control-solid" oninput="validateAndFormatNumber(this);"
                                            name="markup_item_detail" id="markup_item_detail">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Lokasi Barang</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" disabled name="purchase_from" id="purchase_from_item_detail" >
                                    </div>
                                    <div class="col-lg-12 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Toko Referensi / Suplier</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled
                                            name="purchase_reference" id="purchase_reference_item_detail">
                                    </div>

                                    <div class="col-lg-8 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Jenis Pembayaran</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" disabled name="payment_type" id="payment_type_item_detail" >
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Batas Waktu Harga</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="number" disabled name="purchase_validity" id="purchase_validity_item_detail" >
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end ">
                                <div class="w-20 me-10 mt-5">
                                    <span class="fw-bold">Total Amount : Rp. <span id="total_item_detail"></span></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_item_detail_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        {{-- <button type="submit" id="kt_modal_item_detail_submit"
                            class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button> --}}
                    </div>

                    <div>
                        <input type="hidden" id="uniq_id_price" name="uniq_id_price" value="">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>