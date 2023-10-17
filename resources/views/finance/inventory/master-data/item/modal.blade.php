<div class="modal fade" id="add_item_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-4 mx-lg-13 mb-7">
                <form id="modal_add_item" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div style="max-height: 400px; overflow-y: auto;">
                        <div class="row mb-9 mx-1">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Tambah Item</span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Kategori</span>
                                </label>
                                <select class="form-select form-select-solid" data-control="select2"
                                    required name="good_category_id" id="add_item_category">
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Name"
                                    required name="good_name">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Tipe</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Tipe"
                                    name="good_type">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Code</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Code"
                                    required name="code_name">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Spesifikasi</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Spesifikasi"
                                    name="spesification">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Merk</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="merk"
                                    name="merk">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Description</span>
                                </label>
                                <textarea class="form-control form-control-solid" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_item_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-4 mx-lg-13 mb-7">
                <form id="modal_edit_item" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div style="max-height: 400px; overflow-y: auto;">
                        <div class="row mb-9 mx-1">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Edit Item</span>
                            </div>
                            <input type="text" name="id" hidden>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Kategori</span>
                                </label>
                                <select class="form-select form-select-solid" data-control="select2"
                                    required name="good_category_id" id="edit_item_category">
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Name"
                                    required name="good_name">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Tipe</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Tipe"
                                    name="good_type">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Code</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Code"
                                    required name="code_name">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Spesifikasi</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Spesifikasi"
                                    name="spesification">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Merk</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="merk"
                                    name="merk">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Description</span>
                                </label>
                                <textarea class="form-control form-control-solid" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
