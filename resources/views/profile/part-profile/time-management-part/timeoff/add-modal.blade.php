<div class="modal fade" id="time_off_request_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_time_off_request" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Request Time Off</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Time Off Type</span>
                                </label>
                                <select required class="drop-data form-select form-select-solid"
                                    data-control="leave_request_category_id" name="leave_request_category_id">
                                    @foreach ($leaveRequestCategory as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Tanggal Mulai</span>
                                </label>
                                <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                    required name="start_date">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Tanggal Selesai</span>
                                </label>
                                <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                    required name="end_date">
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">File</span>
                                </label>
                                <input type="file" class="form-control form-control-solid" name="file" required>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Notes</span>
                                </label>
                                <textarea class="form-control form-control-solid" required name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_family_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_family_submit" class="btn btn-sm btn-info w-lg-200px"
                            data-bs-dismiss="modal">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
