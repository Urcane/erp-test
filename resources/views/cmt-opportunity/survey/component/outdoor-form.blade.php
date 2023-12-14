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
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->tower_available_status == "1") checked="checked" @endif @endif 
                        type="radio" id="tower_available_status_1" class="form-check-input" placeholder="" name="tower_available_status" value="1">
                        <label class="fs-6 form-check-label" for="tower_available_status_1">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->tower_available_status == "0") checked="checked" @endif @endif 
                        type="radio" id="tower_available_status_0" class="form-check-input" placeholder="" name="tower_available_status" value="0">
                        <label class="fs-6 form-check-label" for="tower_available_status_0">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="tower_available_status_note" style="resize:none">{{isset($surveyResult) ? old('tower_available_status_note', $surveyResult->siteSurveyOutdoorArea->tower_available_status_note) : ''}}</textarea>
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
            <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-solid" placeholder="" name="closest_site_range" value="{{isset($surveyResult) ? $surveyResult->siteSurveyOutdoorArea->closest_site_range : ''}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="closest_site_range_note" style="resize:none">{{isset($surveyResult) ? old('closest_site_range_note', $surveyResult->siteSurveyOutdoorArea->closest_site_range_note) : ''}}</textarea>
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
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->closest_tower_status == "1") checked="checked" @endif @endif 
                        type="radio" id="closest_tower_status_1" class="form-check-input" placeholder="" name="closest_tower_status" value="1">
                        <label class="fs-6 form-check-label" for="closest_tower_status_1">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->closest_tower_status == "0") checked="checked" @endif @endif 
                        type="radio" id="closest_tower_status_0" class="form-check-input" placeholder="" name="closest_tower_status" value="0">
                        <label class="fs-6 form-check-label" for="closest_tower_status_0">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="closest_tower_status_note" style="resize:none">{{isset($surveyResult) ? old('closest_tower_status_note', $surveyResult->siteSurveyOutdoorArea->closest_tower_status_note) : ''}}</textarea>
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
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->thunder_protector_status == "1") checked="checked" @endif @endif type="radio" id="thunder_protector_status_1" class="form-check-input" placeholder="" name="thunder_protector_status" value="1">
                        <label class="fs-6 form-check-label" for="thunder_protector_status_1">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->thunder_protector_status == "0") checked="checked" @endif @endif type="radio" id="thunder_protector_status_0" class="form-check-input" placeholder="" name="thunder_protector_status" value="0">
                        <label class="fs-6 form-check-label" for="thunder_protector_status_0">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="thunder_protector_status_note" style="resize:none">{{isset($surveyResult) ? old('thunder_protector_status_note', $surveyResult->siteSurveyOutdoorArea->thunder_protector_status_note) : ''}}</textarea>
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
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->grounding_status == "1") checked="checked" @endif @endif type="radio" id="grounding_status_1" class="form-check-input" placeholder="" name="grounding_status" value="1">
                        <label class="fs-6 form-check-label" for="grounding_status_1">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->grounding_status == "0") checked="checked" @endif @endif type="radio" id="grounding_status_0" class="form-check-input" placeholder="" name="grounding_status" value="0">
                        <label class="fs-6 form-check-label" for="grounding_status_0">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="grounding_status_note" style="resize:none">{{isset($surveyResult) ? old('grounding_status_note', $surveyResult->siteSurveyOutdoorArea->grounding_status_note) : ''}}</textarea>
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
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "1") checked="checked" @endif @endif type="radio" id="cable_tray_status_1" class="form-check-input" placeholder="" name="cable_tray_status" value="1">
                        <label class="fs-6 form-check-label" for="cable_tray_status_1">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "0") checked="checked" @endif @endif type="radio" id="cable_tray_status_0" class="form-check-input" placeholder="" name="cable_tray_status" value="0">
                        <label class="fs-6 form-check-label" for="cable_tray_status_0">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="cable_tray_status_note" style="resize:none">{{isset($surveyResult) ? old('cable_tray_status_note', $surveyResult->siteSurveyOutdoorArea->cable_tray_status_note) : ''}}</textarea>
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
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "1") checked="checked" @endif @endif type="radio" id="pondation_status_1" class="form-check-input" placeholder="" name="pondation_status" value="1">
                        <label class="fs-6 form-check-label" for="pondation_status_1">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "0") checked="checked" @endif @endif type="radio" id="pondation_status_0" class="form-check-input" placeholder="" name="pondation_status" value="0">
                        <label class="fs-6 form-check-label" for="pondation_status_0">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="pondation_status_note" style="resize:none">{{isset($surveyResult) ? old('pondation_status_note', $surveyResult->siteSurveyOutdoorArea->pondation_status_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
