<div class="modal fade" id="kt_modal_create_survey_result_internet" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div id="kt_modal_create_survey_result_internet_cancel" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-9">
                <form id="kt_modal_create_survey_result_internet_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="survey_request_id" value="">
                    <input type="hidden" name="work_order_id" value="">
                    <input type="hidden" name="service_type_id" value="1">
                    <div id="containerSelectedWorkOrders">

                    </div>
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_create_survey_result_internet_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_survey_result_internet_header" data-kt-scroll-wrappers="#kt_modal_create_survey_result_internet_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-9">
                                <i class="fas fa-file-signature text-primary fs-3x mb-6"></i>
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Membuat Hasil Survey Internet</span>
                                <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">membuat hasil survey</b> pada Permintaan Survey ini<span id="prospect_name"></span> ?</span>
                            </div>
                            <div class="stepper stepper-pills kt_stepper_survey_result_internet">
                                <div class="stepper-nav flex-center flex-wrap mb-10">
                                    <div class="stepper-item mx-8 current" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper d-flex align-items-center">
                                            <div class="stepper-icon w-30px h-30px">
                                                <i class="stepper-check fas fs-3 fa-check"></i>
                                                <i class="stepper-number fa-solid fa-house-signal fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="stepper-line h-35px"></div>
                                    </div>
                                    <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper d-flex align-items-center">
                                            <div class="stepper-icon w-30px h-30px">
                                                <i class="stepper-check fas fs-3 fa-check"></i>
                                                <i class="stepper-number fa-solid fa-house-laptop fs-3"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper d-flex align-items-center">
                                            <div class="stepper-icon w-30px h-30px">
                                                <i class="stepper-check fas fs-3 fa-check"></i>
                                                <i class="stepper-number fa-solid fa-image fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="stepper-line h-35px"></div>
                                    </div>
                                </div>
                                
                                <div class="w-lg-500px mx-auto">
                                    <div class="mb-10">
                                        <div class="flex-column current" data-kt-stepper-element="content">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Transmission media</span>
                                                    </label>
                                                    <select class="drop-data form-select form-select-solid" data-control="select2" required name="trans_media_id" data-dropdown-parent="#kt_modal_create_survey_result_internet">
                                                        <option value="" selected hidden disabled>Pilih Dulu</option>
                                                        @foreach ($transMedias as $transMedia)
                                                        <option value="{{$transMedia->id}}">{{$transMedia->name}}</option>									
                                                        @endforeach
                                                    </select>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Internet Service Type</span>
                                                    </label>
                                                    <select class="drop-data form-select form-select-solid" data-control="select2" required name="internet_service_type_id" data-dropdown-parent="#kt_modal_create_survey_result_internet">
                                                        <option value="" selected hidden disabled>Pilih Dulu</option>
                                                        @foreach ($internetServiceTypes as $internetServiceType)
                                                        <option value="{{$internetServiceType->id}}">{{$internetServiceType->name}}</option>									
                                                        @endforeach
                                                    </select>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Existing Connection</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid" placeholder="Fill Existing Connection" name="existing_connection">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Transportation Access</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid" placeholder="Fill Transportation Access" required name="transportation_access">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Building Type</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid" placeholder="Fill Building Type" required name="building_type">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Building Height</span>
                                                    </label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Fill Building Height" required name="building_height">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Building Floor Count</span>
                                                    </label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Fill Building Floor" name="building_floor_count">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Building Status</span>
                                                    </label>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="building_rooftop_state" id="building_rooftop_state" value=false>
                                                            <label class="fs-6 form-check-label mb-2" for="building_rooftop_state">
                                                                <span class="fw-bold">has rooftop ?</span>
                                                            </label>
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="building_electricity_state" id="building_electricity_state" value=false>
                                                            <label class="fs-6 form-check-label mb-2" for="building_electricity_state">
                                                                <span class="fw-bold">has electricity ?</span>
                                                            </label>
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">how many hours electricity used in a day?</span>
                                                    </label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" name="building_electricity_time">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Electricity Type</span>
                                                    </label>
                                                    <select class="drop-data form-select form-select-solid" data-control="select2" name="building_electricity_type" data-dropdown-parent="#kt_modal_create_survey_result_internet">
                                                        <option value="" selected hidden disabled>Pilih Dulu</option>
                                                        <option value="PLN" >PLN</option>
                                                        <option value="GENSET" >Genset</option>
                                                        <option value="SOLARCELL" >Tenaga Surya / Solar Cell</option>
                                                    </select>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-column" data-kt-stepper-element="content">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="require fw-bold">Kebutuhan Pengguna</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid" placeholder="" required name="user_needs">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Potensi Jumlah Pengguna</span>
                                                    </label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" required name="quantity_service_use">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Kebutuhan Bandwith</span>
                                                    </label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="" required name="bandwith_needs">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Permintaan Spesial</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid" placeholder="" name="special_request">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-column" data-kt-stepper-element="content">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="required fw-bold">Lampiran</span>
                                                    </label>
                                                    <input type="file" class="form-control form-control-solid" placeholder="" multiple required accept="image/*" name="file_survey_result_internet[]">
                                                    {{-- <span class="fs-8 text-muted">4 foto jalur kabel</span>                                                         --}}
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 d-flex flex-stack">
                                        <div class="me-2">
                                            <button type="button" class="btn btn-sm btn-light me-3 w-lg-200px" data-kt-stepper-action="previous">
                                                Kembali
                                            </button>
                                        </div>
                                        <div>
                                            <button type="submit" id="kt_modal_create_survey_result_internet_submit" class="btn btn-sm btn-info w-lg-200px" data-kt-stepper-action="submit">
                                                <span class="indicator-label">Simpan</span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-info w-lg-200px" data-kt-stepper-action="next">
                                                Selanjutnya
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

