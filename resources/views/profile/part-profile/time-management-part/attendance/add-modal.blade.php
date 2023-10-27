<div class="modal fade" id="attendance_request_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_attendance_request" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Request Attendance</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Pilih Tanggal Attendance</span>
                                </label>
                                <input required type="date" class="form-control form-control-solid"
                                    placeholder="Select Date" name="date">
                            </div>
                            {{-- <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Shift</span>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    value="{{ $user->userEmployment->workingScheduleShift->workingShift->name ?? "-"}}"
                                    disabled>
                            </div> --}}
                            <div class="col-lg-6 mt-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkbox-real" id="check_in_box">
                                    <label class="fs-6 form-check-label mb-2" for="check_in_box">
                                        <span class="fw-bold">Check In</span>
                                    </label>
                                </div>
                                <input type="time" class="form-control form-control-solid text-muted"
                                    placeholder="Select Date" name="check_in" id="check_in">
                            </div>
                            <div class="col-lg-6 mt-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkbox-real" id="check_out_box">
                                    <label class="fs-6 form-check-label mb-2" for="check_out_box">
                                        <span class="fw-bold">Check Out</span>
                                    </label>
                                </div>
                                <input type="time" class="form-control form-control-solid text-muted"
                                    placeholder="Select Date" name="check_out" id="check_out">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">File</span>
                                </label>
                                <input type="file" class="form-control form-control-solid" name="file">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Notes</span>
                                </label>
                                <textarea class="form-control form-control-solid" name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
