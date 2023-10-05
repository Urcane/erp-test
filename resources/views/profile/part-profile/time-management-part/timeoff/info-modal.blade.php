<div class="modal fade" id="timeoff_info_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" id="attendance-modal-close"
                    data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-2 mb-2">
                <div class="col-lg-12 text-center mb-9">
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Time Off Request Details</span>
                    <span class="fs-7 fw-semibold text-gray-500"></span>
                </div>
                <div class="scroll-y me-n6 pe-6" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px">
                    <p class="fw-bold mt-4">Request Detail</p>
                    <input type="text" id="timeoff-request-id" hidden>
                    <div class="row p-2 m-1 rounded border border-2 border-secondary">
                        <div class="col-lg-12 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Time Off Type</span>
                            <p class="fs-7 fw-normal" id="tmoff-type-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Duration</span>
                            <p class="fs-7 fw-normal" id="tmoff-duration-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Quota Taken</span>
                            <p class="fs-7 fw-normal" id="tmoff-quotataken-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Request Created</span>
                            <p class="fs-7 fw-normal" id="tmoff-created-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Request for Date</span>
                            <p class="fs-7 fw-normal" id="tmoff-date-modal">-</p>
                        </div>

                        <div class="col-lg-6 mb-1 halfdaysection">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Working Start</span>
                            <p class="fs-7 fw-normal" id="tmoff-workingin-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1 halfdaysection">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Working End</span>
                            <p class="fs-7 fw-normal" id="tmoff-workingend-modal">-</p>
                        </div>

                        <div class="col-lg-12 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">File</span>
                            <div>
                                <p class="fs-7 fw-normal" id="tmoff-nofile-modal">No File Attached</p>
                                <a href="" class="fs-7 fw-normal btn btn-link m-0 p-0" id="tmoff-file-modal" target="_blank">-</a>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Notes</span>
                            <p class="fs-7 fw-normal" id="tmoff-notes-modal">-</p>
                        </div>
                    </div>

                    <p class="fw-bold mt-4" id="att_timeoff_label">Comment</p>
                    <textarea id="timeoff_comment" class="form-control form-control-solid" placeholder="-"></textarea>
                </div>
                <div class="text-center mt-9" id="timeoff_approved_button">
                    <button type="reset" class="btn btn-success btn-sm me-3" data-bs-dismiss="modal">
                        <i class="fas fa-check text-white"></i>
                        Approved
                    </button>
                </div>
                <div class="text-center mt-9" id="timeoff_rejected_button">
                    <button type="reset" class="btn btn-danger btn-sm me-3" data-bs-dismiss="modal">
                        <i class="fas fa-times text-white"></i>
                        Rejected
                    </button>
                </div>
                <div class="text-center mt-9" id="timeoff_cancel_button">
                    <button type="reset" id="timeoff_cancel" class="btn btn-outline btn-outline-danger btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-danger"></i>
                        Cancel Request
                    </button>
                </div>
                <div class="text-center mt-9" id="timeoff_canceled_button">
                    <button type="reset" id="timeoff_cancel"
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
