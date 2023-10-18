<div class="modal fade" id="add_item_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Tambah Item</span>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">SN/PN/MAC</span>
                            </label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="SN/PN/MAC" id="serial_number">
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Stock</span>
                            </label>
                            <input type="number" step="any" class="form-control form-control-solid" placeholder="0" required
                                id="item_stock">
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Minimum Stock</span>
                            </label>
                            <input type="number" step="any" class="form-control form-control-solid" placeholder="10"
                                required id="minimum_stock">
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Satuan Unit</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" required
                                id="inventory_unit_master_id">
                                <option value="" selected>Choose a Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }} -
                                        {{ $unit->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Kondisi Barang</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" required
                                id="inventory_good_condition_id">
                                <option value="" selected>Choose a Condition</option>
                                @foreach ($conditions as $condition)
                                    <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Status Barang</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" required
                                id="inventory_good_status_id">
                                <option value="" selected>Choose a Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-9">
                    <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="add_item_submit" class="btn btn-sm btn-info w-lg-200px" data-bs-dismiss="modal">
                        <span class="indicator-label">Tambah</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
