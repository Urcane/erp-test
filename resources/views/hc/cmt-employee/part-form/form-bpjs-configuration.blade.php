<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>BPJS Configurtion</h4>
        <span class="fs-7 fw-semibold text-gray-500">Employee BPJS payment arrangements</span>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_number">
            <span class= fw-bold">BPJS Ketenagakerjaan Number</span>
        </label>
        <input type="number" value="{{$user->userBpjs->ketenagakerjaan_number ?? old('ketenagakerjaan_number')}}" class="form-control form-control-solid" placeholder="BPJS Ketenagakerjaan Number" name="ketenagakerjaan_number" id="ketenagakerjaan_number" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_npp">
            <span class="fw-bold">NPP BPJS Ketenagakerjaan</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="ketenagakerjaan_npp" name="ketenagakerjaan_npp" id="ketenagakerjaan_npp" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userBpjs->ketenagakerjaan_npp ?? old('ketenagakerjaan_npp')) == null)
                <option value="" selected hidden disabled>Select NPP BPJS Ketenagakerjaan</option>
            @endif
            @foreach ($constants->ketenagakerjaan_npp as $ketenagakerjaan_npp)
                <option value="{{$ketenagakerjaan_npp}}" @if (($user->userBpjs->ketenagakerjaan_npp ?? old('ketenagakerjaan_npp')) == $ketenagakerjaan_npp) selected @endif>{{$ketenagakerjaan_npp}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_date">
            <span class= fw-bold">BPJS Ketenagakerjaan Date</span>
        </label>
        <input type="date" value="{{$user->userBpjs->ketenagakerjaan_date ?? old('ketenagakerjaan_date')}}" class="form-control form-control-solid" placeholder="BPJS Ketenagakerjaan Date" name="ketenagakerjaan_date" id="ketenagakerjaan_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_number">
            <span class= fw-bold">BPJS Kesehatan Number</span>
        </label>
        <input type="number" value="{{$user->userBpjs->kesehatan_number ?? old('kesehatan_number')}}" class="form-control form-control-solid" placeholder="BPJS Kesehatan Number" name="kesehatan_number" id="kesehatan_number" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_family">
            <span class="fw-bold">BPJS Kesehatan Family</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="kesehatan_family" name="kesehatan_family" id="kesehatan_family" @unlessrole("administrator") disabled @endunlessrole>
            @if (($user->userBpjs->kesehatan_family ?? old('kesehatan_family')) == null)
                <option value="" selected hidden disabled>Select BPJS Kesehatan Family</option>
            @endif
            @foreach ($constants->kesehatan_family as $kesehatan_family)
                <option value="{{$kesehatan_family}}" @if (($user->userBpjs->kesehatan_family ?? old('kesehatan_family')) == $kesehatan_family) selected @endif>{{$kesehatan_family}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_date">
            <span class= fw-bold">BPJS Tanggal Kesehatan</span>
        </label>
        <input type="date" value="{{$user->userBpjs->kesehatan_date ?? old('kesehatan_date')}}" class="form-control form-control-solid" placeholder="BPJS Kesehatan Date" name="kesehatan_date" id="kesehatan_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_cost">
            <span class="fw-bold">BPJS Kesehatan Cost</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="kesehatan_cost" name="kesehatan_cost" id="kesehatan_cost" @unlessrole("administrator") disabled @endunlessrole>
            @foreach ($constants->kesehatan_cost as $kesehatan_cost)
                <option value="{{$kesehatan_cost}}" @if (($user->userBpjs->kesehatan_cost ?? old('kesehatan_cost')) == $kesehatan_cost) selected @endif>{{$kesehatan_cost}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="jht_cost">
            <span class="fw-bold">JHT Cost</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="jht_cost" name="jht_cost" id="jht_cost" @unlessrole("administrator") disabled @endunlessrole>
            @foreach ($constants->jht_cost as $jht_cost)
                <option value="{{$jht_cost}}" @if (($user->userBpjs->jht_cost ?? old('jht_cost')) == $jht_cost) selected @endif>{{$jht_cost}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_pensiun_cost">
            <span class="fw-bold">Jaminan Pensiun Cost</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="jaminan_pensiun_cost" name="jaminan_pensiun_cost" id="jaminan_pensiun_cost" @unlessrole("administrator") disabled @endunlessrole>
            @foreach ($constants->jaminan_pensiun_cost as $jaminan_pensiun_cost)
                <option value="{{$jaminan_pensiun_cost}}" @if (($user->userBpjs->jaminan_pensiun_cost ?? old('jaminan_pensiun_cost')) == $jaminan_pensiun_cost) selected @endif>{{$jaminan_pensiun_cost}}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_pensiun_date">
            <span class= fw-bold">Jaminan Pensiun Date</span>
        </label>
        <input type="date" value="{{$user->userBpjs->jaminan_pensiun_date ?? old('jaminan_pensiun_date')}}" class="form-control form-control-solid" placeholder="Jaminan Pensiun Date" name="jaminan_pensiun_date" id="jaminan_pensiun_date" @unlessrole("administrator") disabled @endunlessrole>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
