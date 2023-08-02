<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>BPJS Configurtion</h4>
        <span class="fs-7 fw-semibold text-gray-500">Employee BPJS payment arrangements</span>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_number">
            <span class= fw-bold">BPJS Ketenagakerjaan Number</span>
        </label>
        <input type="number" class="form-control form-control-solid" placeholder="BPJS Ketenagakerjaan Number" name="ketenagakerjaan_number" id="ketenagakerjaan_number" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_npp">
            <span class="fw-bold">NPP BPJS Ketenagakerjaan</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="ketenagakerjaan_npp" name="ketenagakerjaan_npp" id="ketenagakerjaan_npp" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select NPP BPJS Ketenagakerjaan</option>
            <option value="NPP BPJS Ketenagakerjaan 1" >NPP BPJS Ketenagakerjaan 1</option>
            <option value="NPP BPJS Ketenagakerjaan 2" >NPP BPJS Ketenagakerjaan 2</option>
            <option value="NPP BPJS Ketenagakerjaan 3" >NPP BPJS Ketenagakerjaan 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_date">
            <span class= fw-bold">BPJS Ketenagakerjaan Date</span>
        </label>
        <input type="date" class="form-control form-control-solid" placeholder="BPJS Ketenagakerjaan Date" name="ketenagakerjaan_date" id="ketenagakerjaan_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_number">
            <span class= fw-bold">BPJS Kesehatan Number</span>
        </label>
        <input type="number" class="form-control form-control-solid" placeholder="BPJS Kesehatan Number" name="kesehatan_number" id="kesehatan_number" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_family">
            <span class="fw-bold">BPJS Kesehatan Family</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="kesehatan_family" name="kesehatan_family" id="kesehatan_family" @unlessrole("administrator") disabled @endunlessrole>
            <option value="" selected hidden disabled>Select BPJS Kesehatan Family</option>
            <option value="BPJS Kesehatan Family 1" >BPJS Kesehatan Family 1</option>
            <option value="BPJS Kesehatan Family 2" >BPJS Kesehatan Family 2</option>
            <option value="BPJS Kesehatan Family 3" >BPJS Kesehatan Family 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_date">
            <span class= fw-bold">BPJS Kesehatan Date</span>
        </label>
        <input type="date" class="form-control form-control-solid" placeholder="BPJS Kesehatan Date" name="kesehatan_date" id="kesehatan_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_cost">
            <span class="fw-bold">BPJS Kesehatan Cost</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="kesehatan_cost" name="kesehatan_cost" id="kesehatan_cost" @unlessrole("administrator") disabled @endunlessrole>
            <option value="By Employee" >By Employee</option>
            <option value="BPJS Kesehatan Cost 2" >BPJS Kesehatan Cost 2</option>
            <option value="BPJS Kesehatan Cost 3" >BPJS Kesehatan Cost 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="jht_cost">
            <span class="fw-bold">JHT Cost</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="jht_cost" name="jht_cost" id="jht_cost" @unlessrole("administrator") disabled @endunlessrole>
            <option value="By Employee" >By Employee</option>
            <option value="BPJS Kesehatan Cost 2" >BPJS Kesehatan Cost 2</option>
            <option value="BPJS Kesehatan Cost 3" >BPJS Kesehatan Cost 3</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_pensiun_cost">
            <span class="fw-bold">Jaminan Pensiun Cost</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="jaminan_pensiun_cost" name="jaminan_pensiun_cost" id="jaminan_pensiun_cost" @unlessrole("administrator") disabled @endunlessrole>
            <option value="By Employee" >By Employee</option>
            <option value="Jaminan Pensiun Cost 2" >Jaminan Pensiun Cost 2</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_pensiun_date">
            <span class= fw-bold">Jaminan Pensiun Date</span>
        </label>
        <input type="date" class="form-control form-control-solid" placeholder="Jaminan Pensiun Date" name="jaminan_pensiun_date" id="jaminan_pensiun_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
