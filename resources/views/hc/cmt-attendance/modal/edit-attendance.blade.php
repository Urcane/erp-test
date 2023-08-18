<div class="modal fade" id="attendance_edit_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_attendance_edit_modal" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Edit Attendance</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                            </div>
                            <input type="hidden" name="id" id="edit_attendance_id">
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama User</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" id="edit_name" disabled>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Tanggal Attendance</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" id="edit_date" disabled>
                            </div>

                            <div class="col-lg-6 mt-3 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Check In</span>
                                </label>
                                <input type="time" class="form-control form-control-solid"
                                    placeholder="Select Date" name="check_in" id="edit_check_in">
                            </div>

                            <div class="col-lg-6 mt-3 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Check Out</span>
                                </label>
                                <input type="time" class="form-control form-control-solid"
                                    placeholder="Select Date" name="check_out" id="edit_check_out">
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Alasan Edit</span>
                                </label>
                                <textarea class="form-control form-control-solid" placeholder="Alasan Edit" name="reason" id="edit_reason"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_family_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_family_submit" class="btn btn-sm btn-info w-lg-200px"
                            data-bs-dismiss="modal">
                            <span class="indicator-label">Edit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const onEditButtonClick = ({ id, name, date, checkIn, checkOut }) => {
        $('#edit_attendance_id').val(id);
        $('#edit_name').val(name);
        $('#edit_date').val(date);
        $('#edit_check_in').val(checkIn);
        $('#edit_check_out').val(checkOut);
        $('#edit_reason').val("");
    }
</script>
