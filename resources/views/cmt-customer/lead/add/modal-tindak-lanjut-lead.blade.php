<div class="modal fade" id="kt_modal_tindak_lanjut_lead" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_tindak_lanjut_lead_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lead_id[]">
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_tindak_lanjut_lead_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_tindak_lanjut_lead_header" data-kt-scroll-wrappers="#kt_modal_tindak_lanjut_lead_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <i class="fas fa-building-circle-check text-primary fs-3x mb-6"></i>
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Periksa Kembali!</span>
                            <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">melakukan prospek</b> pada lead terpilih ? Jika penindak lanjut tidak sama dengan sales, maka perlu approval oleh Manager.</span>
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Next Action</span>
							</label>
							<input type="text" class="form-control form-control-solid" placeholder="" required name="prospect_next_action">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-8 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Plan Date</span>
							</label>
							<input type="date" class="form-control form-control-solid" placeholder="Select Date" required name="next_action_plan_date">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Plan Time</span>
							</label>
							<input type="time" class="form-control form-control-solid" placeholder="Select Time" required name="next_action_plan_time">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div id="containerTindakLanjutLead">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_tindak_lanjut_lead_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_tindak_lanjut_lead_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

