<div>
    <div class="row mb-3">
        <div class="col-lg-2">
            <label class="d-flex align-items-center fs-6 form-label h-100">
                <span class="fw-bold my-auto">Ruangan : </span>
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
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
            <div class="row mt-3">
                @foreach ($powerSources as $powerSource)
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="power_source[]" id="power_source" value="{{$powerSource->id}}">
                    <label class="fs-6 form-check-label mb-2" for="power_source[]">
                        <span class="fw-bold">{{$powerSource->name}}</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
            <div class="row mt-3">
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="site_survey_interface[]" id="site_survey_interface" value="AC">
                    <label class="fs-6 form-check-label mb-2" for="site_survey_interface[]">
                        <span class="fw-bold">AC</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-2 mb-3">
                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="site_survey_interface[]" id="site_survey_interface" value="DC">
                    <label class="fs-6 form-check-label mb-2" for="site_survey_interface[]">
                        <span class="fw-bold">DC</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Phase To Neutral" name="customer_name" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Phase To Ground" name="customer_name" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Neutral To Ground" name="customer_name" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Freq" name="customer_name" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
                        <span class="fw-bold">Tidak Ada</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
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
                        <span class="fw-bold">Tidak Ada</span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="customer_address" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
