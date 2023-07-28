<div class="modal fade" id="kt_modal_create_soft_survey" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div>
                    <span class="badge badge-light-warning fs-6" id="countable_soft_survey_items">1</span>
                </div>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_create_soft_survey_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_create_soft_survey_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_soft_survey_header" data-kt-scroll-wrappers="#kt_modal_create_soft_survey_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <i class="fas fa-file-signature text-primary fs-3x mb-6"></i>
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Soft Survey</span>
                            <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">membuat soft survey</b> pada Permintaan Survey ini<span id="prospect_name"></span> ?</span>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="separator my-3 text-center text-gray-800">Soft Survey Item</div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Lampiran</span>
                            </label>
                            <input type="file" class="form-control form-control-solid file-soft-survey-item-initial" placeholder="" required accept="image/*" name="content[]['file_soft_survey_internet']">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            <img id="containerImage" class="img-fluid m-5" src="#" alt="File Image" hidden="hidden"/>
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Deskripsi Pekerjaan</span>
							</label>
                            <textarea class="form-control form-control-solid h-100px" placeholder="Fill Notes" name="content[]['description']"></textarea>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-12 mb-3">
                            <div id="containerSoftSurveyItems">

                            </div>
                        </div>
                        <div class="col-lg-10 mb-3">
							<button type="button" class="btn btn-sm btn-outline btn-active-light-info w-lg-150px btn_add_more_soft_survey_item"><i class="fa-solid fa-plus"></i>Tambah Item</button>
						</div>
                        <div id="containerSelectedSurveyRequests">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_create_soft_survey_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_create_soft_survey_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

