<div class="modal fade" id="edit_quota_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="edit_quota_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <input type="text" name="id" hidden>
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Edit Quota</span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama Perubahan</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Perubahan Cuti"
                                    required name="name">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Received Date</span>
                                </label>
                                <input type="date" class="form-control form-control-solid"
                                    required name="received_at">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Expired Date</span>
                                </label>
                                <input type="date" class="form-control form-control-solid"
                                    required name="expired_date">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Quotas</span>
                                </label>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <input type="number" class="form-control form-control-solid" id="quotas" disabled
                                    required>
                            </div>
                            <div class="col-lg-1 mb-3 d-flex align-items-center justify-content-center fs-6">
                                <span class="fw-bold">+</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <input type="number" class="form-control form-control-solid" placeholder="0"
                                    required name="quota_change">
                            </div>
                            <div class="col-lg-1 mb-3 d-flex align-items-center justify-content-center fs-6">
                                <span class="fw-bold">=</span>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control form-control-solid" disabled id="quota_result"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
