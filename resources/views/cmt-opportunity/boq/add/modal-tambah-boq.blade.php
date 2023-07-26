<div class="modal fade" id="kt_modal_tambah_boq" aria-hidden="true">
    {{--  cek id --}}

    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="fw-bolder">Tambah Item Baru</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_tambah_boq_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_tambah_boq_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_tambah_boq_header"
                        data-kt-scroll-wrappers="#kt_modal_tambah_boq_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">

                            {{-- <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama Item</span>
                                </label>
								<select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="good_name" id="good_name"
                                    data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled>Pilih Dulu</option>
                                    @foreach ($getInventoryGoods as $gig)
                                        <option value="{{ $gig->id }}">{{ $gig->good_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Jenis Item</span>
                                </label>
                                <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="good_type" id="good_type"
                                    data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled>Pilih Dulu</option>
                                    @foreach ($getInventoryGoods as $gig)
                                        <option value="{{ $gig->id }}">{{ $gig->good_type }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Merek</span>
                                </label>
                                <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="merk" id="merk"
                                    data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled>Pilih Dulu</option>
                                    @foreach ($getInventoryGoods as $gig)
                                        <option value="{{ $gig->id }}">{{ $gig->merk }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div> --}}

                            <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama Item</span>
                                </label>
                                <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="good_name" id="good_name" data-dropdown-parent="#kt_modal_tambah_boq"
                                    data-url="{{ route('get.merk.type') }}">
                                    <option value="" selected hidden disabled>Pilih Dulu</option>
                                    @foreach ($dataForm as $gig)
                                        <option value="{{ $gig->id }}">{{ $gig->good_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Jenis Item</span>
                                </label>
                                {{-- <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="good_type" id="good_type" data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled></option>
                                </select> --}}
                                
                            <input class="form-control" type="text" name="good_type" id="good_type" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>



                            <!-- Tambahkan atribut "data-url" pada select merek -->
                            <div class="col-lg-6 col-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class=" fw-bold">Merek</span>
                                </label>
                                {{-- <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="merk" id="merk" data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled></option>
                                </select> --}}
                            <input class="form-control" type="text" name="merk" id="merk" disabled>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>



                            {{-- <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Alamat</span>
                                </label>
                                <textarea class="form-control form-control-solid" placeholder="" rows="2" required name="customer_address"
                                    style="resize:none"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Kota/Kabupaten</span>
                                </label>
                                <select class="drop-data form-select form-select-solid" data-control="select2" required
                                    name="city_id" id="city_id" data-dropdown-parent="#kt_modal_tambah_boq">
                                    <option value="" selected hidden disabled>Pilih Dulu</option>
                                    @foreach ($getCity as $gc)
                                        <option value="{{ $gc->id }}">{{ $gc->city_name }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Lat</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="lat">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-6 col-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Lng</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="lng">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="separator my-3"></div>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama Kontak</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="" required
                                    name="customer_contact_name">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col-lg-4 col-4 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Jabatan</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="" required
                                    name="customer_contact_job">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col-lg-6 col-4 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Email</span>
                                </label>
                                <input type="email" class="form-control form-control-solid" placeholder=""
                                    name="customer_contact_email">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col-lg-6 col-4 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold text-dark">Telepon</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0">+62</span>
                                    <input type="number" class="form-control form-control-solid" required
                                        minlength="9" maxlength="13" name="customer_contact_phone" />
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_tambah_boq_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_tambah_boq_submit"
                            class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
