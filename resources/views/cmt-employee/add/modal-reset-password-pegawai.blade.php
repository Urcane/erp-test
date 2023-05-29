<div class="modal fade" id="kt_modal_reset_password_pegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <form id="kt_modal_reset_password_pegawai_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pegawai_id[]">
                    <div class="scroll-y me-n10 pe-10" id="kt_modal_reset_password_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_reset_password_pegawai_header" data-kt-scroll-wrappers="#kt_modal_reset_password_pegawai_scroll" data-kt-scroll-offset="300px">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-12 text-center">
                            <i class="fas fa-exclamation-circle text-danger fs-3x mb-6"></i>
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Periksa Kembali!</span>
                            <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">mereset password</b> pegawai terpilih ?. Password yang sudah reset akan menjadi default kembali.</span>
                        </div>
                        <div id="containerResetPasswordPegawai">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="kt_modal_reset_password_pegawai_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="kt_modal_reset_password_pegawai_submit" class="btn btn-sm btn-primary w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

