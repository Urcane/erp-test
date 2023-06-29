<div class="modal fade" id="kt_modal_create_wo_survey" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_create_wo_survey_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_of_wo" value="SR">
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_create_wo_survey_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_wo_survey_header" data-kt-scroll-wrappers="#kt_modal_create_wo_survey_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <i class="fas fa-file-signature text-primary fs-3x mb-6"></i>
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Menerbitkan WO</span>
                            <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">mengajukan menerbitkan WO</b> pada Permintaan Survey ini<span id="prospect_name"></span> ?</span>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">No. Work Order</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Fill Work Order Number" required name="no_wo">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Deskripsi Pekerjaan</span>
							</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Fill Task Description" required name="task_description">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Start Date</span>
							</label>
							<input type="date" class="form-control form-control-solid" placeholder="Select Date" required name="start_date">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Planning Due Date</span>
							</label>
							<input type="date" class="form-control form-control-solid" placeholder="Select Date" required name="planning_due_date">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        {{-- <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Kategori Work Order</span>
                            </label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="type_of_wo" data-dropdown-parent="#kt_modal_create_wo_survey">
                                <option value="" selected hidden disabled>Pilih Dulu</option>
                                @foreach ($typeOfWOs as $typeOfWO)
                                <option value="{{$typeOfWO->code}}">{{$typeOfWO->name}}</option>									
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div> --}}
                        <div id="containerSelectedSurveyRequests">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_create_wo_survey_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_create_wo_survey_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

