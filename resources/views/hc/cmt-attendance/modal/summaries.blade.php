<div class="modal fade" id="summaries_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mb-7">
                    <div class="scroll-y pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1" id="summaries_modal_title"></span>
                                <span class="fs-7 fw-semibold text-gray-500" id="summaries_modal_subtitle"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table align-top border table-rounded gy-5" id="kt_table_summaries">
                                <thead class="">
                                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto w-full">
                                        <th class="w-100px">Date</th>
                                        <th class="w-100px">Employee ID</th>
                                        <th class="w-200px">Name</th>
                                        <th class="w-150px">Shift</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-7">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-center mt-9">
                        <button type="reset" id="summaries_modal_cancel"
                            class="btn btn-sm btn-info me-3 w-lg-200px" data-bs-dismiss="modal">OK</button>
                    </div>
            </div>
        </div>
    </div>
</div>
