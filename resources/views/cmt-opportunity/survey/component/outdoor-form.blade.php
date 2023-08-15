<div class="mt-6">
    <h3 class="">Outdoor Form</h3>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Ketersediaan Tower : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="tower_available_status" value="1">
                        <label class="fs-6 form-check-label" for="tower_available_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="tower_available_status" value="0">
                        <label class="fs-6 form-check-label" for="tower_available_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="tower_available_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Jarak Site Terdekat : </span>
            </label>
        </div>
        <div class="col-lg-4">
            <input type="number" class="form-control form-control-solid" placeholder="" name="closest_site_range" value="{{$surveyRequest->customerProspect->customer->customer_address}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="closest_site_range" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">BTS Terdekat : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="closest_tower_status" value="1">
                        <label class="fs-6 form-check-label" for="closest_tower_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="closest_tower_status" value="0">
                        <label class="fs-6 form-check-label" for="closest_tower_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="closest_tower_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Penangkal Petir : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="thunder_protector_status" value="1">
                        <label class="fs-6 form-check-label" for="thunder_protector_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="thunder_protector_status" value="0">
                        <label class="fs-6 form-check-label" for="thunder_protector_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="thunder_protector_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Grounding : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="grounding_status" value="1">
                        <label class="fs-6 form-check-label" for="grounding_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="grounding_status" value="0">
                        <label class="fs-6 form-check-label" for="grounding_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="grounding_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Kabel Tray : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="cable_tray_status" value="1">
                        <label class="fs-6 form-check-label" for="cable_tray_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="cable_tray_status" value="0">
                        <label class="fs-6 form-check-label" for="cable_tray_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="cable_tray_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Pondasi : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="pondation_status" value="1">
                        <label class="fs-6 form-check-label" for="pondation_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="pondation_status" value="0">
                        <label class="fs-6 form-check-label" for="pondation_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="pondation_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
