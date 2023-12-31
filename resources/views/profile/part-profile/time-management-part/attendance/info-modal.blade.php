<div class="modal fade" id="attendances_info_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" id="attendance-modal-close" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-2 mb-2">
                <div class="col-lg-12 text-center mb-9">
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Attendances Request Details</span>
                    <span class="fs-7 fw-semibold text-gray-500"></span>
                </div>
                <input type="text" id="attendance-request-id" hidden>
                <div class="scroll-y me-n6 pe-6" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px">
                    <p class="fw-bold mt-4">Request Detail</p>
                    <div class="row p-2 m-1 rounded border border-2 border-secondary">
                        <div class="col-lg-4 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Shift</span>
                            <p class="fs-7 fw-normal" id="att-shift-modal">-</p>
                        </div>
                        <div class="col-lg-4 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Work Hours</span>
                            <p class="fs-7 fw-normal" id="att-work-modal">-</p>
                        </div>
                        <div class="col-lg-4 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Request Created</span>
                            <p class="fs-7 fw-normal" id="att-created-modal">-</p>
                        </div>
                        <div class="col-lg-4 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Check In Request</span>
                            <p class="fs-7 fw-normal" id="att-checkin-modal">-</p>
                        </div>
                        <div class="col-lg-4 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Check Out Request</span>
                            <p class="fs-7 fw-normal" id="att-checkout-modal">-</p>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">File</span>
                            <div>
                                <a href="" class="fs-7 fw-normal btn btn-link" id="att-file-modal" target="_blank">-</a>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Notes</span>
                            <p class="fs-7 fw-normal" id="att-notes-modal">-</p>
                        </div>
                    </div>

                    <p class="fw-bold mt-4" id="att_comment_label">Comment</p>
                    <textarea id="attendance_comment" class="form-control form-control-solid" placeholder="-" disabled></textarea>
                </div>
                <div class="text-center mt-9" id="attendance_approved_button">
                    <button type="reset"
                        class="btn btn-success btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-check text-white"></i>
                        Approved
                    </button>
                </div>
                <div class="text-center mt-9" id="attendance_rejected_button">
                    <button type="reset"
                        class="btn btn-danger btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-white"></i>
                        Rejected
                    </button>
                </div>
                <div class="text-center mt-9" id="attendance_cancel_button">
                    <button type="reset" id="attendance_cancel"
                        class="btn btn-outline btn-outline-danger btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-danger"></i>
                        Cancel Request
                    </button>
                </div>
                <div class="text-center mt-9" id="attendance_canceled_button">
                    <button type="reset" id="attendance_cancel"
                        class="btn btn-outline btn-outline-danger btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-ban text-danger"></i>
                        Canceled
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
