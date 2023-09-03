<div class="modal fade" id="shift_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" id="shift-modal-close" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-2 mb-2">
                <div class="col-lg-12 text-center mb-9">
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Shift Request Details</span>
                    <span class="fs-7 fw-semibold text-gray-500"></span>
                </div>
                <div class="scroll-y me-n6 pe-6" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px">
                    <input type="text" id="shift-request-id" hidden>
                    <p class="fw-bold">Employee Detail</p>
                    <div class="row p-2 m-1 rounded border border-2 border-secondary">
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Name</span>
                            <p class="fs-7 fw-normal" id="shf-name-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">NIP</span>
                            <p class="fs-7 fw-normal" id="shf-nip-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Branch</span>
                            <p class="fs-7 fw-normal" id="shf-branch-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Organization</span>
                            <p class="fs-7 fw-normal" id="shf-org-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Job Position</span>
                            <p class="fs-7 fw-normal" id="shf-position-modal">-</p>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Job Level</span>
                            <p class="fs-7 fw-normal" id="shf-level-modal">-</p>
                        </div>
                    </div>

                    <p class="fw-bold mt-4">Request Detail</p>
                    <div class="row p-2 m-1 rounded border border-2 border-secondary">
                        <div class="col-lg-2 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1" id="shf-title-prm-shift-modal">Current Shift</span>
                            <p class="fs-7 fw-normal" id="shf-prm-shift-modal">-</p>
                        </div>
                        <div class="col-lg-3 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1" id="shf-title-prm-work-modal">Current Work Hours</span>
                            <p class="fs-7 fw-normal" id="shf-prm-work-modal">-</p>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Request Created</span>
                            <p class="fs-7 fw-normal" id="shf-created-modal">-</p>
                        </div>
                        <div class="col-lg-3 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Request for Date</span>
                            <p class="fs-7 fw-normal" id="shf-date-modal">-</p>
                        </div>

                        <div class="col-lg-2 mb-1 shf_changed">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Current Shift</span>
                            <p class="fs-7 fw-normal" id="shf-curr-shift-modal">-</p>
                        </div>
                        <div class="col-lg-3 mb-1 shf_changed">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Current Work Hours</span>
                            <p class="fs-7 fw-normal" id="shf-curr-work-modal">-</p>
                        </div>
                        <div class="col-lg-1 shf_changed"></div>

                        <div class="col-lg-2 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">New Shift</span>
                            <p class="fs-7 fw-normal" id="shf-new-shift-modal">-</p>
                        </div>
                        <div class="col-lg-3 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">New Work Hours</span>
                            <p class="fs-7 fw-normal" id="shf-new-work-modal">-</p>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <span class="fs-8 text-gray-600 fw-semibold mb-1">Notes</span>
                            <p class="fs-7 fw-normal" id="shf-notes-modal">-</p>
                        </div>
                    </div>

                    <p class="fw-bold mt-4">Comment</p>
                    <textarea id="shift_comment" class="form-control form-control-solid" placeholder="Write Comment Here..."></textarea>
                </div>
                <div class="text-center mt-9" id="shift_approved_button">
                    <button type="reset"
                        class="btn btn-success btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-check text-white"></i>
                        Approved
                    </button>
                </div>
                <div class="text-center mt-9" id="shift_rejected_button">
                    <button type="reset"
                        class="btn btn-danger btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-white"></i>
                        Rejected
                    </button>
                </div>
                <div class="text-center mt-9" id="shift_waiting_button">
                    <button type="reset" id="shift_reject"
                        class="btn btn-outline btn-outline-danger btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-danger"></i>
                        Reject
                    </button>
                    <button type="reset" id="shift_approve"
                        class="btn btn-outline btn-outline-success btn-sm me-3"
                        data-bs-dismiss="modal">
                        <i class="fas fa-check text-success"></i>
                        Approve
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
