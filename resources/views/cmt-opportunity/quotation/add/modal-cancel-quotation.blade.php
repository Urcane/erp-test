<div class="modal fade" id="kt_modal_cancel_quotation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end"> 
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7 row">
                <form id="kt_modal_cancel_quotation_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="quo_id" name="quo_id">
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_cancel_quotation_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_cancel_quotation_header"
                        data-kt-scroll-wrappers="#kt_modal_cancel_quotation_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-2">
                                <i class="fas fa-xmark text-danger fs-5x mb-4"></i>
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Cancel Quotation</span>
                                <span class="fs-5 fw-semibold text-gray-500">Apa ada yakin ingin <b
                                        class="text-danger">Membatalkan</b> pada Quotation ini<span
                                        id="prospect_name"></span> ?</span>
                            </div>  
                        </div> 
                        <div class="col-lg-12 mb-3">
							<label for="remark"  class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Deskripsi Pekerjaan</span>
							</label>
                            <textarea class="form-control form-control-solid h-100px" placeholder="Fill Remark" required  name="remark" id="remark"></textarea>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                    </div>
                    <div class="text-center mt-9 col-12">
                        <button type="reset" id="kt_modal_cancel_quotation_submit"
                            class="btn col-5 col-sm-5 col-md-5 col-lg-5 btn-sm btn-info">
                            <span class="indicator-label">Discard</span>
                        </button>
                        <button type="submit" id="kt_modal_cancel_quotation_cancel"
                            class="btn col-5 col-sm-5 col-md-5 col-lg-5 btn-sm btn-danger me-3" data-bs-dismiss="modal">Cancel Quotation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
