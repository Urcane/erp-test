
<div class="modal fade" id="kt_modal_update_prospect" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
            <div class="modal-header py-3">
				<h5 class="fw-bolder">Update Prospek</h5>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<i class="fas fa-times"></i>
				</div>
			</div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_update_prospect_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="customer_prospect_id">
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_update_prospect_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_prospect_header" data-kt-scroll-wrappers="#kt_modal_update_prospect_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-8 col-8 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Next Action</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="" required name="prospect_next_action">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col-lg-4 col-4 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Status</span>
                            </label>
                            <select class="drop-data form-select form-select-solid" data-control="select2" required name="prospect_status" data-dropdown-parent="#kt_modal_update_prospect">
                                <option value="1">In Progress</option>
                                <option value="2">Deal/Opportunity</option>
                                <option value="0">Batal</option>
                            </select>
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
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Note Update</span>
                            </label>
                            <textarea class="form-control form-control-solid" placeholder="" rows="2" required name="prospect_update" style="resize:none"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div id="containerTindakLanjutLead">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_update_prospect_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_update_prospect_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>