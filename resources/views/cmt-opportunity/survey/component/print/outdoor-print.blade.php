<div class="mt-0">
    <h3 class="fs-6">Outdoor Area</h3>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Ketersediaan Tower : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <div class="row mt-3 h-min-50px">
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->tower_available_status == "1") checked="checked" @endif @endif 
                        type="radio" class="" placeholder="" name="tower_available_status" value="1">
                        <label class="fs-9 form-check-label" for="tower_available_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->tower_available_status == "0") checked="checked" @endif @endif 
                        type="radio" class="" placeholder="" name="tower_available_status" value="0">
                        <label class="fs-9 form-check-label" for="tower_available_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="tower_available_status_note" style="resize:none">{{isset($surveyResult) ? old('tower_available_status_note', $surveyResult->siteSurveyOutdoorArea->tower_available_status_note) : ''}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Jarak Site Terdekat : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <input @if (isset($surveyResult)) disabled="disabled" @endif type="number" class="form-control form-control-transparent fs-9" placeholder="" name="closest_site_range" value="{{isset($surveyResult) ? $surveyResult->siteSurveyOutdoorArea->closest_site_range : ''}}">
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="closest_site_range_note" style="resize:none">{{isset($surveyResult) ? old('closest_site_range_note', $surveyResult->siteSurveyOutdoorArea->closest_site_range_note) : ''}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">BTS Terdekat : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <div class="row mt-3 h-min-50px">
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->closest_tower_status == "1") checked="checked" @endif @endif 
                        type="radio" class="" placeholder="" name="closest_tower_status" value="1">
                        <label class="fs-9 form-check-label" for="closest_tower_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->closest_tower_status == "0") checked="checked" @endif @endif 
                        type="radio" class="" placeholder="" name="closest_tower_status" value="0">
                        <label class="fs-9 form-check-label" for="closest_tower_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="closest_tower_status_note" style="resize:none">{{isset($surveyResult) ? old('closest_tower_status_note', $surveyResult->siteSurveyOutdoorArea->closest_tower_status_note) : ''}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Penangkal Petir : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <div class="row mt-3 h-min-50px">
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->thunder_protector_status == "1") checked="checked" @endif @endif type="radio" class="" placeholder="" name="thunder_protector_status" value="1">
                        <label class="fs-9 form-check-label" for="thunder_protector_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->thunder_protector_status == "0") checked="checked" @endif @endif type="radio" class="" placeholder="" name="thunder_protector_status" value="0">
                        <label class="fs-9 form-check-label" for="thunder_protector_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="thunder_protector_status_note" style="resize:none">{{isset($surveyResult) ? old('thunder_protector_status_note', $surveyResult->siteSurveyOutdoorArea->thunder_protector_status_note) : ''}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Grounding : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <div class="row mt-3 h-min-50px">
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->grounding_status == "1") checked="checked" @endif @endif type="radio" class="" placeholder="" name="grounding_status" value="1">
                        <label class="fs-9 form-check-label" for="grounding_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->grounding_status == "0") checked="checked" @endif @endif type="radio" class="" placeholder="" name="grounding_status" value="0">
                        <label class="fs-9 form-check-label" for="grounding_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="grounding_status_note" style="resize:none">{{isset($surveyResult) ? old('grounding_status_note', $surveyResult->siteSurveyOutdoorArea->grounding_status_note) : ''}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Kabel Tray : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <div class="row mt-3 h-min-50px">
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "1") checked="checked" @endif @endif type="radio" class="" placeholder="" name="cable_tray_status" value="1">
                        <label class="fs-9 form-check-label" for="cable_tray_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "0") checked="checked" @endif @endif type="radio" class="" placeholder="" name="cable_tray_status" value="0">
                        <label class="fs-9 form-check-label" for="cable_tray_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="cable_tray_status_note" style="resize:none">{{isset($surveyResult) ? old('cable_tray_status_note', $surveyResult->siteSurveyOutdoorArea->cable_tray_status_note) : ''}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-2 border border-solid">
            <label class="d-flex align-items-center fs-9 form-label h-100">
                <span class="fw-bold my-auto">Pondasi : </span>
            </label>
        </div>
        <div class="col-6 border border-solid">
            <div class="row mt-3 h-min-50px">
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "1") checked="checked" @endif @endif type="radio" class="" placeholder="" name="pondation_status" value="1">
                        <label class="fs-9 form-check-label" for="pondation_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-4 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOutdoorArea->cable_tray_status == "0") checked="checked" @endif @endif type="radio" class="" placeholder="" name="pondation_status" value="0">
                        <label class="fs-9 form-check-label" for="pondation_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 border border-solid">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-transparent fs-9" placeholder="Notes" rows="3" name="pondation_status_note" style="resize:none">{{isset($surveyResult) ? old('pondation_status_note', $surveyResult->siteSurveyOutdoorArea->pondation_status_note) : ''}}</textarea>
        </div>
    </div>
</div>
