<div class="modal fade" id="kt_modal_tambah_bundle_internet" aria-hidden="true">
    {{--  cek id --}}

    {{-- @dd($dataCompany) --}}
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="fw-bolder">Tambah Bundle Internet Baru</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_tambah_boq_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_tambah_boq_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_tambah_boq_header"
                        data-kt-scroll-wrappers="#kt_modal_tambah_boq_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">

                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama Item</span>
                                </label>
                                <select class="form-select form-select-solid drop-data" data-control="select2" required data-placeholder="Select an Item" name="good_name" id="good_name" data-dropdown-parent="#kt_modal_tambah_boq"
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
                                <input class="form-control" type="text" name="good_type" id="good_type" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <!-- Tambahkan atribut "data-url" pada select merek -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Merek</span>
                                </label>
                                {{-- <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="merk" id="merk" data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled></option>
                                </select> --}}
                                <input class="form-control" type="text" name="merk" id="merk" disabled>
                                {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Detail Item inventory</span>
                                </label>
                                <input class="form-control" type="text" name="detail" id="detail" disabled>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Detail Item project</span>
                                </label>
                                <input class="form-control" type="text" name="item_detail" id="item_detail" >
                            </div>


                            <div class="col-lg-12 mb-3">
                                <div class="separator my-3"></div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Harga Beli</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid required" required
                                            min="1" minlength="3" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_tambah', 'tambah');"
                                            name="purchase_price_tambah">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Quantity</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid required" required
                                            min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_tambah', 'tambah');" name="quantity_tambah">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Jasa antar</span>
                                        </label>
                                        <input type="number" class="form-control form-control-solid required" required
                                            min="1" minlength="3" oninput="validateAndFormatNumber(this); calculateTotalAmount('total_tambah', 'tambah');"
                                            name="purchase_delivery_tambah">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Toko Referensi</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="purchase_reference">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end ">
                                <div class="w-20 me-10">
                                    <span class="fw-bold">Total Amount : Rp. <span id="total_tambah"></span></span>
                                    <input type="hidden" class="form-control form-control-solid total" name="total_tambah" value=""/>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_tambah_boq_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_tambah_boq_submit"
                            class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>