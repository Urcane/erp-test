<div class="modal fade" id="kt_modal_request_survey" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_request_survey_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="prospect_id[]"> --}}
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_request_survey_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_request_survey_header" data-kt-scroll-wrappers="#kt_modal_request_survey_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <i class="fas fa-file-signature text-primary fs-3x mb-6"></i>
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Survey Request</span>
                            <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">mengajukan survey</b> pada Prospek Perusahaan <span id="prospect_name"></span> ?</span>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">No Survey</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Fill Survey Number" required name="no_survey">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col-lg-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Jenis Layanan</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="service_type_id" data-dropdown-parent="#kt_modal_request_survey">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($serviceTypes as $serviceType)
								<option value="{{$serviceType->id}}">{{$serviceType->name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Type Survey</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="type_of_survey_id" data-dropdown-parent="#kt_modal_request_survey">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($typeOfSurveys as $typeOfSurvey)
								<option value="{{$typeOfSurvey->id}}">{{$typeOfSurvey->name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-8 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Survey Date</span>
							</label>
							<input type="date" class="form-control form-control-solid" placeholder="Select Date" required name="survey_date">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Survey Time</span>
							</label>
							<input type="time" class="form-control form-control-solid" placeholder="Select Time" required name="survey_time">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
                        <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Latitude</span>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="Fill Latitude" name="lat">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Langitude</span>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="Fill Langitude" name="lang">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Closest BTS</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Fill Closest BTS" name="closest_bts">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Notes</span>
                            </label>
                            <textarea class="form-control form-control-solid h-100px" placeholder="Fill Notes" name="notes"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div id="containerSelectedProspects">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_request_survey_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_request_survey_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

