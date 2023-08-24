<div class="mt-6">
    <h3 class="">Other</h3>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Kabel Power Outdoor : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                @foreach ($outdoorCableTypes as $outdoorCableType)
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->outdoor_cable_type_id == $outdoorCableType->id) checked="checked" @endif @endif 
                    type="radio" class="form-check-input " placeholder="" name="outdoor_cable_type_id" value="{{$outdoorCableType->id}}">
                    <label class="fs-6 form-check-label" for="outdoor_cable_type_id">
                        <span class="fw-bold">{{$outdoorCableType->name}}</span>
                    </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Tipe Kabel Power : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->cable_power_type == "INDOOR") checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="cable_power_type" value="INDOOR">
                    <label class="fs-6 form-check-label" for="cable_power_type">
                        <span class="fw-bold">Indoor</span>
                    </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->cable_power_type == "OUTDOOR") checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="cable_power_type" value="OUTDOOR">
                    <label class="fs-6 form-check-label" for="cable_power_type">
                        <span class="fw-bold">Outdoor</span>
                    </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Tipe Kabel Grounding : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->grounding_cable_type == "SERABUT") checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="grounding_cable_type" value="SERABUT">
                    <label class="fs-6 form-check-label" for="grounding_cable_type">
                        <span class="fw-bold">Serabut</span>
                    </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->grounding_cable_type == "TUNGGAL") checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="grounding_cable_type" value="TUNGGAL">
                    <label class="fs-6 form-check-label" for="grounding_cable_type">
                        <span class="fw-bold">Tunggal</span>
                    </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Konfigurasi Koneksi : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->connection_configuration_status == "1") checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="connection_configuration_status" value="1">
                    <label class="fs-6 form-check-label" for="connection_configuration_status">
                        <span class="fw-bold">Ada</span>
                    </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->connection_configuration_status == "0") checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="connection_configuration_status" value="0">
                    <label class="fs-6 form-check-label" for="connection_configuration_status">
                        <span class="fw-bold">Belum ada</span>
                    </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Akses Transportasi : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                @foreach ($transportationAccesses as $transportationAccess)
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->transportation_access_id == $transportationAccess->id) checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="transportation_access_id" value="{{$transportationAccess->id}}">
                    <label class="fs-6 form-check-label" for="transportation_access_id">
                        <span class="fw-bold">{{$transportationAccess->name}}</span>
                    </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Tipe Bangunan : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3 h-min-50px">
                @foreach ($buildingTypes as $buildingType)
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                    <input @if (isset($surveyResult)) disabled="disabled" @if ($surveyResult->siteSurveyOtherArea->building_type_id == $buildingType->id) checked="checked" @endif @endif 
                    type="radio" class="form-check-input" placeholder="" name="building_type_id" value="{{$buildingType->id}}">
                    <label class="fs-6 form-check-label" for="building_type_id">
                        <span class="fw-bold">{{$buildingType->name}}</span>
                    </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Notes : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <textarea @if (isset($surveyResult)) disabled="disabled" @endif class="form-control form-control-solid" placeholder="Notes" rows="5" name="other_area_notes" style="resize:none">{{isset($surveyResult) ? old('other_area_notes', $surveyResult->siteSurveyOtherArea->notes) : ''}}</textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
