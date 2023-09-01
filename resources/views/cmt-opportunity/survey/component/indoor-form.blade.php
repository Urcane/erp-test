<div class="mt-6">
    <h3 class="">Indoor Form</h3>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Ruangan : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->room_status == "1") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="room_status" value="1">
                        <label class="fs-6 form-check-label" for="room_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->room_status == "0") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="room_status" value="0">
                        <label class="fs-6 form-check-label" for="room_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="room_status_note" style="resize:none">{{isset($surveyResult) ? old('room_status_note', $surveyResult->siteSurveyIndoorArea->room_status_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Air Conditioning : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->air_conditioning_status == "1") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="air_conditioning_status" value="1">
                        <label class="fs-6 form-check-label" for="air_conditioning_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->air_conditioning_status == "0") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="air_conditioning_status" value="0">
                        <label class="fs-6 form-check-label" for="air_conditioning_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="air_conditioning_status_note" style="resize:none">{{isset($surveyResult) ? old('air_conditioning_status_note', $surveyResult->siteSurveyIndoorArea->air_conditioning_status_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Power Source : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                @foreach ($powerSources as $powerSource)
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->power_source_id == $powerSource->id) checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="power_source_id" value="{{$powerSource->id}}">
                        <label class="fs-6 form-check-label" for="power_source_id">
                            <span class="fw-bold">{{$powerSource->name}}</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="power_source_note" style="resize:none">{{isset($surveyResult) ? old('power_source_note', $surveyResult->siteSurveyIndoorArea->power_source_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">MCB : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->mcb_status == "1") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="mcb_status" value="1">
                        <label class="fs-6 form-check-label" for="mcb_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->mcb_status == "0") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="mcb_status" value="0">
                        <label class="fs-6 form-check-label" for="mcb_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="mcb_status_note" style="resize:none">{{isset($surveyResult) ? old('mcb_status_note', $surveyResult->siteSurveyIndoorArea->mcb_status_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Tipe MCB : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->mcb_type == "AC") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="mcb_type" value="AC">
                        <label class="fs-6 form-check-label" for="mcb_type">
                            <span class="fw-bold">AC</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->mcb_type == "DC") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="mcb_type" value="DC">
                        <label class="fs-6 form-check-label" for="mcb_type">
                            <span class="fw-bold">DC</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="mcb_type_note" style="resize:none">{{isset($surveyResult) ? old('mcb_type_note', $surveyResult->siteSurveyIndoorArea->mcb_type_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Voltage : </span>
            </label>
        </div>
        <div class="col-lg-4 mb-2">
            <input @if (isset($surveyResult)) disabled="disabled" @endif type="text" class="form-control form-control-solid" placeholder="Voltage Phase To Neutral" name="voltage_phase_to_neutral" value="{{isset($surveyResult) ? old('mcb_type_note', $surveyResult->siteSurveyIndoorArea->voltage_phase_to_neutral) : ''}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input @if (isset($surveyResult)) disabled="disabled" @endif type="text" class="form-control form-control-solid" placeholder="Voltage Phase To Ground" name="voltage_phase_to_ground" value="{{isset($surveyResult) ? old('mcb_type_note', $surveyResult->siteSurveyIndoorArea->voltage_phase_to_ground) : ''}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input @if (isset($surveyResult)) disabled="disabled" @endif type="text" class="form-control form-control-solid" placeholder="Voltage Neutral To Ground" name="voltage_neutral_to_ground" value="{{isset($surveyResult) ? old('mcb_type_note', $surveyResult->siteSurveyIndoorArea->voltage_neutral_to_ground) : ''}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input @if (isset($surveyResult)) disabled="disabled" @endif type="text" class="form-control form-control-solid" placeholder="Voltage Freq" name="voltage_frequency" value="{{isset($surveyResult) ? old('mcb_type_note', $surveyResult->siteSurveyIndoorArea->voltage_frequency) : ''}}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="voltage_note" style="resize:none">{{isset($surveyResult) ? old('voltage_note', $surveyResult->siteSurveyIndoorArea->voltage_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">UPS / Regulator : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->ups_regulator_status == "1") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="ups_regulator_status" value="1">
                        <label class="fs-6 form-check-label" for="ups_regulator_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->ups_regulator_status == "0") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="ups_regulator_status" value="0">
                        <label class="fs-6 form-check-label" for="ups_regulator_status">
                            <span class="fw-bold">Tidak Ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="ups_regulator_status_note" style="resize:none">{{isset($surveyResult) ? old('ups_regulator_status_note', $surveyResult->siteSurveyIndoorArea->ups_regulator_status_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Meja / Rak : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->table_status == "1") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="table_status" value="1">
                        <label class="fs-6 form-check-label" for="table_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyIndoorArea->table_status == "0") checked="checked" @endif @endif 
                        type="radio" class="form-check-input" placeholder="" name="table_status" value="0">
                        <label class="fs-6 form-check-label" for="table_status">
                            <span class="fw-bold">Tidak Ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea @if(isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="table_status_note" style="resize:none">{{isset($surveyResult) ? old('table_status_note', $surveyResult->siteSurveyIndoorArea->table_status_note) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
