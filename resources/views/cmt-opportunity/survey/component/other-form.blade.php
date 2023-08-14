<div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Kabel Power Outdoor : </span>
            </label>
        </div>
        <div class="col-lg-10">
            <div class="row mt-3">
                @foreach ($outdoorCableTypes as $outdoorCableType)
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="outdoor_cable_type[]" id="outdoor_cable_type" value="{{$outdoorCableType->id}}">
                    <label class="fs-6 form-check-label mb-2" for="outdoor_cable_type[]">
                        <span class="fw-bold">{{$outdoorCableType->name}}</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
            <div class="row mt-3">
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="outdoor_cable_type[]" id="outdoor_cable_type" value="INDOOR">
                    <label class="fs-6 form-check-label mb-2" for="outdoor_cable_type[]">
                        <span class="fw-bold">Indoor</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="outdoor_cable_type[]" id="outdoor_cable_type" value="OUTDOOR">
                    <label class="fs-6 form-check-label mb-2" for="outdoor_cable_type[]">
                        <span class="fw-bold">Outdoor</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
            <div class="row mt-3">
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="outdoor_cable_type[]" id="outdoor_cable_type" value="SERABUT">
                    <label class="fs-6 form-check-label mb-2" for="outdoor_cable_type[]">
                        <span class="fw-bold">Serabut</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="outdoor_cable_type[]" id="outdoor_cable_type" value="TUNGGAL">
                    <label class="fs-6 form-check-label mb-2" for="outdoor_cable_type[]">
                        <span class="fw-bold">Tunggal</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
            <div class="row mt-3">
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="site_survey_interface[]" id="site_survey_interface" value="0">
                    <label class="fs-6 form-check-label mb-2" for="site_survey_interface[]">
                        <span class="fw-bold">Ada</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="site_survey_interface[]" id="site_survey_interface" value="0">
                    <label class="fs-6 form-check-label mb-2" for="site_survey_interface[]">
                        <span class="fw-bold">Belum ada</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
            <div class="row mt-3">
                @foreach ($transportationAccesses as $transportationAccess)
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="transportation_access[]" id="transportation_access" value="{{$transportationAccess->id}}">
                    <label class="fs-6 form-check-label mb-2" for="transportation_access[]">
                        <span class="fw-bold">{{$transportationAccess->name}}</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
            <div class="row mt-3">
                @foreach ($buildingTypes as $buildingType)
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="transportation_access[]" id="transportation_access" value="{{$buildingType->id}}">
                    <label class="fs-6 form-check-label mb-2" for="transportation_access[]">
                        <span class="fw-bold">{{$buildingType->name}}</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
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
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
