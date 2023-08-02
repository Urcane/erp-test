<section class="row">
    <div class="col-lg-12 mb-9">
        <h4>Personal Data</h4>
        <span class="fs-7 fw-semibold text-gray-500">All employee basic information data</span>
    </div>
    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Nama Lengkap</span>
        </label>
        <input type="text" value="{{ $user->name ?? "" }}" id="first_name" class="form-control form-control-solid" placeholder="First Name" required name="first_name">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Email</span>
        </label>
        <input type="email" value="{{ $user->email ?? "" }}" class="form-control form-control-solid" required placeholder="Fill Email" name="email">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-12 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Phone</span>
        </label>
        <input type="number" value="{{ $user->kontak ?? "" }}" class="form-control form-control-solid" name="kontak" placeholder="Phone Number">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Place of Birth</span>
        </label>
        <input type="text" value="{{ $user->userPersonalData->place_of_birth ?? "" }}" class="form-control form-control-solid" placeholder="Place of Birth" name="place_of_birth">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Birthdate</span>
        </label>
        <input type="date" value="{{ $user->userPersonalData->birthdate ?? "" }}" class="form-control form-control-solid" required placeholder="Birthdate" name="birthdate">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Marital Status</span>
        </label>
        <select required class="drop-data form-select form-select-solid" data-control="maritial_status" name="maritial_status">
            <option value="" selected hidden disabled>Select Status</option>
            <option value="Belum Kawin" >Belum Kawin</option>
            <option value="Kawin" >Kawin</option>
            <option value="Cerai Hidup" >Cerai Hidup</option>
            <option value="Cerai Mati" >Cerai Mati</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Gender</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="status" name="status">
            <option value="Laki-laki" >Laki-laki</option>
            <option value="Perempuan" >Perempuan</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="required fw-bold">Religion</span>
        </label>
        <select required class="drop-data form-select form-select-solid" data-control="religion" name="religion">
            <option value="" selected hidden disabled>Select Religion</option>
            <option value="Islam" >Islam</option>
            <option value="Kristen" >Kristen</option>
            <option value="Katolik" >Katolik</option>
            <option value="Buddha" >Buddha</option>
            <option value="Hindu" >Hindu</option>
            <option value="Konghucu" >Konghucu</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <label class="d-flex align-items-center fs-6 form-label mb-2">
            <span class="fw-bold">Blood Type</span>
        </label>
        <select class="drop-data form-select form-select-solid" data-control="blood_type" name="blood_type">
            <option value="" selected hidden disabled>Select Blood Type</option>
            <option value="A" >A</option>
            <option value="B" >B</option>
            <option value="AB" >AB</option>
            <option value="O" >O</option>
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</section>
