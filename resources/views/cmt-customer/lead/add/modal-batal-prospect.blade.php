<div class="modal fade" id="kt_modal_batal_prospect" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_batal_prospect_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="prospect_id[]">
                    <input type="hidden" name="prospect_status" value="0">
                    <input type="hidden" name="prospect_next_action" value="-">
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_batal_prospect_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_batal_prospect_header" data-kt-scroll-wrappers="#kt_modal_batal_prospect_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <i class="fas fa-exclamation-circle text-danger fs-3x mb-6"></i>
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Periksa Kembali!</span>
                            <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-danger">membatalkan</b> pada prospek terpilih ? Data yang telah dibatalkan tidak dapat dikembalikan.</span>
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Alasan Pembatalan</span>
							</label>
							<textarea class="form-control form-control-solid" placeholder="" rows="2" required name="prospect_update" style="resize:none"></textarea>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div id="containerBatalProspect">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_batal_prospect_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_batal_prospect_submit" class="btn btn-sm btn-danger w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

