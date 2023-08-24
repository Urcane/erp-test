<div class="modal fade" id="kt_modal_approve_work_order" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15">
                <form id="kt_modal_approve_work_order_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <div class="scroll-y me-n10 pe-10" id="kt_modal_approve_work_order_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_approve_work_order_header" data-kt-scroll-wrappers="#kt_modal_approve_work_order_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <i class="fas fa-file-signature text-primary fs-3x mb-6"></i>
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Konfirmasi Work Order</span>
                                    <span class="fs-7 fw-semibold text-gray-500">Apa ada yakin ingin <b class="text-primary">melakukan Approval</b> pada Work Order ini<span id="prospect_name"></span> ?</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="approved_status" value="">
                        <div id="containerSelectedWorkOrders">
                            
                        </div>
                    </div>
                    <div class="text-center row mb-12">
                        <button type="button" id="kt_modal_approve_work_order_approve" class="col-lg-5 btn btn-sm btn-info h-36px my-3 me-3">
                            <span class="indicator-label">Approve</span>
                        </button>
                        <button type="button" id="kt_modal_approve_work_order_decline" class="col-lg-4 btn btn-sm btn-danger h-36px my-3 me-3">
                            <span class="indicator-label">Decline</span>
                        </button>
                        <button type="submit" id="kt_modal_approve_work_order_submit" class="col-lg-4 btn btn-sm btn-danger h-36px my-3 me-3" hidden="hidden" disabled="disabled">
                            <span class="indicator-label">Decline</span>
                        </button>
                        <button type="reset" id="kt_modal_approve_work_order_cancel" class="col-lg-2 btn btn-sm btn-light h-36px my-3 me-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

