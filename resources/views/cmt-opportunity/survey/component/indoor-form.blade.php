<div>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="room_status" value="1">
                        <label class="fs-6 form-check-label" for="room_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="room_status" value="0">
                        <label class="fs-6 form-check-label" for="room_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="room_status_note" style="resize:none"></textarea>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="air_conditioning_status" value="1">
                        <label class="fs-6 form-check-label" for="air_conditioning_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="air_conditioning_status" value="0">
                        <label class="fs-6 form-check-label" for="air_conditioning_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="air_conditioning_status_note" style="resize:none"></textarea>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="power_source" value="{{$powerSource->id}}">
                        <label class="fs-6 form-check-label" for="power_source">
                            <span class="fw-bold">{{$powerSource->name}}</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="power_sorce_note" style="resize:none"></textarea>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="mcb_status" value="1">
                        <label class="fs-6 form-check-label" for="mcb_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="mcb_status" value="0">
                        <label class="fs-6 form-check-label" for="mcb_status">
                            <span class="fw-bold">Belum ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="mcb_status_note" style="resize:none"></textarea>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="mcb_type" value="AC">
                        <label class="fs-6 form-check-label" for="mcb_type">
                            <span class="fw-bold">AC</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="mcb_type" value="DC">
                        <label class="fs-6 form-check-label" for="mcb_type">
                            <span class="fw-bold">DC</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="mcb_type" style="resize:none"></textarea>
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
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Phase To Neutral" name="voltage_phase_to_neutral" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Phase To Ground" name="voltage_phase_to_ground" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Neutral To Ground" name="voltage_neutral_to_ground" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control form-control-solid" placeholder="Voltage Freq" name="voltage_frequency" value="">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="voltage_note" style="resize:none"></textarea>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="ups_regulator_status" value="1">
                        <label class="fs-6 form-check-label" for="ups_regulator_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="ups_regulator_status" value="0">
                        <label class="fs-6 form-check-label" for="ups_regulator_status">
                            <span class="fw-bold">Tidak Ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="ups_regulator_status_note" style="resize:none"></textarea>
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
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="table_status" value="1">
                        <label class="fs-6 form-check-label" for="table_status">
                            <span class="fw-bold">Ada</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 d-flex align-items-center">
                    <div class="my-auto">
                        <input type="radio" class="form-check-input checkbox-real" placeholder="" name="table_status" value="0">
                        <label class="fs-6 form-check-label" for="table_status">
                            <span class="fw-bold">Tidak Ada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-10 mt-2">
            <textarea class="form-control form-control-solid" placeholder="Notes" rows="5" required name="table_status_note" style="resize:none"></textarea>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
    </div>
</div>
