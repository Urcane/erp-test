<div class="modal fade" id="kt_modal_update_price" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="fw-bolder">Update Item</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_update_price_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_update_price_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_update_price_header"
                        data-kt-scroll-wrappers="#kt_modal_update_price_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">

                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama Item</span>
                                </label>
                                <select class="form-select form-select-solid drop-data" data-control="select2" required readonly="readonly" data-placeholder="Select an Item" name="good_name" id="good_name_update_price" data-dropdown-parent="#kt_modal_update_price"
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
                                </select>
                            </div>

                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Jenis Item</span>
                                </label>
                                <input class="form-control" type="text" name="good_type" id="good_type_update_price" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <!-- Tambahkan atribut "data-url" pada select merek -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Merek</span>
                                </label>
                                <input class="form-control" type="text" name="merk" id="merk_update_price" disabled>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Detail Item inventory</span>
                                </label>
                                <input class="form-control" type="text" name="detail" id="detail_update_price" disabled>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Detail Item project</span>
                                </label>
                                <input class="form-control form-control-solid" type="text" disabled="disabled" name="item_detail" id="item_detail_update_price" >
                            </div>


                            <div class="col-lg-12 mb-3">
                                <div class="separator my-3"></div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Quantity</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid required" required readonly="readonly"
                                            min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_update_price', 'update_price');" 
                                            name="quantity_update_price" id="quantity_update_price">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Tipe Unit</span>
                                        </label>
                                        <select class="form-select form-select-solid drop-data" data-control="select2" required readonly="readonly" data-placeholder="Select an Item" name="unit_update_price" id="unit_update_price" data-dropdown-parent="#kt_modal_update_price">
                                            <option></option>
                                                @foreach ($dataUnit as $unit)
                                                    <option value="{{ $unit->code }}">{{ $unit->name }}</option>
                                                @endforeach
                                        </select>
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
                                        <input class="form-control form-control-solid" type="text" name="delivery_route" id="delivery_route_update_price" >
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Tipe Pengiriman</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" name="delivery_type" id="delivery_type_update_price" >
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Harga Beli</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid required" required
                                            min="1" minlength="3" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_update_price', 'update_price');"
                                            name="purchase_price_update_price" id="purchase_price_update_price">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Jasa antar</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_update_price', 'update_price');"
                                            name="purchase_delivery_update_price" id="purchase_delivery_charge_update_price">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    @if(isset($boq_type) && $boq_type == "perangkat")
                                    <div class="col-12">
                                        @can('Boq:markup-price-boq')
                                        <label class="form-label">Markup Price</label>
                                        <div class="position-relative">
                                            <div class="position-absolute top-0"></div>
                                            <input type="number" class="form-control form-control-solid" oninput="validateAndFormatNumber(this);"
                                            name="markup_update_price" id="markup_update_price">
                                        </div>
                                        @endcan
                                    </div>
                                    @endif
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Lokasi Barang</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" name="purchase_from" id="purchase_from_update_price" >
                                    </div>
                                    <div class="col-lg-12 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Toko Referensi / Suplier</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="purchase_reference" id="purchase_reference_update_price">
                                    </div>

                                    <div class="col-lg-8 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Jenis Pembayaran</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" name="payment_type" id="payment_type_update_price" >
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Batas Waktu Harga</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="number" name="purchase_validity" id="purchase_validity_update_price" >
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end ">
                                <div class="w-20 me-10">
                                    <span class="fw-bold">Total Amount : Rp. <span id="total_update_price"></span></span>
                                    <input type="hidden" class="form-control form-control-solid total" name="total_update_price" id="total_price_update_price" value=""/>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_update_price_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_update_price_submit"
                            class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>

                    <div>
                        <input type="hidden" id="uniq_id_price" name="uniq_id_price" value="">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>