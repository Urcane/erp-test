<div class="modal fade" id="kt_modal_tambah_bundle_internet" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="fw-bolder">Tambah Bundle Internet Baru</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_tambah_bundle_internet_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_tambah_bundle_internet_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_tambah_bundle_internet_header"
                        data-kt-scroll-wrappers="#kt_modal_tambah_bundle_internet_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-lg-12 mb-5">
                                <label for="good_name_update_bundle" class="d-flex align-items-center fs-6 form-label mb-2" required>
                                    <span class="fw-bold required">Nama Inventory Item</span>
                                </label>
                                <input type="text" class="form-control form-control-solid required" name="good_name_update_bundle"required
                                    id="good_name_update_bundle">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="col-lg-3 col-3">
                                        <label for="code_name" class="d-flex align-items-center fs-6 form-label mb-2" >
                                            <span class="fw-bold required">Code Item</span>
                                        </label>
                                        <input class="form-control required " type="text" name="code_name_update"required
                                            id="code_name">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <div class="col-lg-3 col-3">
                                        <label for="Merk" class="d-flex align-items-center fs-6 form-label mb-2" >
                                            <span class=" fw-bold required">Merk</span>
                                        </label>
                                        <input class="form-control required" type="text" name="merk_update" id="Merk" required>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <div class="col-lg-3 col-3">
                                        <label for="good_type" class="d-flex align-items-center fs-6 form-label mb-2" >
                                            <span class="fw-bold required">Tipe Barang</span>
                                        </label>
                                        <input class="form-control required" type="text" name="good_type_update" required
                                            id="good_type">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <div class="col-lg-12">
                                <label for="description_update" class="d-flex align-items-center fs-6 form-label mb-2" >
                                    <span class="fw-bold required">Detail Item Inventory</span>
                                </label>
                                <textarea class="form-control form-control-solid required" id="description_update" name="description_update" value="" required
                                    placeholder="" rows="2"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>

                        <div>
                            <input type="hidden" name="good_category_id_update" id="good_category_id" value="3">
                        </div>
                    </div>

                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_tambah_boq_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_tambah_boq_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
