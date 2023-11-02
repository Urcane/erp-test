<div class="row">
    {{-- <div class="col-lg-12">
        <div class="form-check">
            <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="use_inventory" id="use_inventory" onclick="toggleHidden('#auto_overtime')">
            <label class="fs-6 form-check-label mb-2" for="use_inventory">
                <span class="fw-bold">Use Inventory</span>
            </label>
        </div>
    </div>
    <div class="col-lg-12 row" id="inventory">
        <div class="col-lg-4">
            <label class="d-flex align-items-center fs-6 form-label mb-2" for="warehouse">
                <span class="required fw-bold">Warehouse</span>
            </label>
            <select class="drop-data form-select form-select-solid" data-control="warehouse" required>
                <option>{{$procurement->warehouseUser->name}}</option>
            </select>
        </div>
        <div class="col-lg-4">
            <label class="d-flex align-items-center fs-6 form-label mb-2"
                for="quantity">
                <span class="required fw-bold">Quantity</span>
            </label>
            <input type="text" id="quantity" class="form-control form-control-solid"
                value="{{ $procurementItem->quantity ?? old('quantity') }}" disabled name="quantity">
        </div>
    </div> --}}
    <div class="col-lg-12">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="need">
            <span class="required fw-bold">Kebutuhan</span>
        </label>
        <input type="text" id="need" class="form-control form-control-solid"
            value="{{ $procurementItem->need ?? old('need') }}" required name="need" @if($disabled) disabled @endif>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-12">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="purchase_number">
            <span class="required fw-bold">Nomor Pembelian</span>
        </label>
        <input type="text" id="purchase_number" class="form-control form-control-solid"
            value="{{ $procurementItem->purchase_number ?? old('purchase_number') }}" @if($disabled) disabled @endif required name="purchase_number">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="no_po_nota">
            <span class="fw-bold">No. PO/Nota</span>
        </label>
        <input type="text" id="no_po_nota" class="form-control form-control-solid"
            value="{{ $procurementItem->no_po_nota ?? old('no_po_nota') }}" @if($disabled) disabled @endif name="no_po_nota" >
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="receipt_number">
            <span class="required fw-bold">Receipt Number</span>
        </label>
        <input type="text" id="receipt_number" class="form-control form-control-solid"
            value="{{ $procurementItem->receipt_number ?? old('receipt_number') }}" @if($disabled) disabled @endif required name="receipt_number">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="price">
            <span class="required fw-bold">Price</span>
        </label>
        <input type="text" id="price" class="form-control form-control-solid"
            value="{{ $procurementItem->price ?? old('price') }}" @if($disabled) disabled @endif required name="price" required>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="quantity">
            <span class="required fw-bold">Quantity</span>
        </label>
        <div class="input-group">
            <input type="text" id="quantity" class="form-control form-control-solid"
                value="{{ $procurementItem->quantity ?? old('quantity') }}" @if($disabled) disabled @endif required name="quantity" required>
            <span class="input-group-text">{{$procurementItem->unit}}</span>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="vendor">
            <span class="required fw-bold">Vendor</span>
        </label>
        <input type="text" id="vendor" class="form-control form-control-solid"
            value="{{ $procurementItem->vendor ?? old('vendor') }}" @if($disabled) disabled @endif required name="vendor">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="vendor_location">
            <span class="required fw-bold">Vendor Location</span>
        </label>
        <input type="text" id="vendor_location" class="form-control form-control-solid"
            value="{{ $procurementItem->vendor_location ?? old('vendor_location') }}" @if($disabled) disabled @endif required name="vendor_location">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>

    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="expedition">
            <span class="required fw-bold">Expedition</span>
        </label>
        <input type="text" id="expedition" class="form-control form-control-solid"
            value="{{ $procurementItem->expedition ?? old('expedition') }}" @if($disabled) disabled @endif required name="expedition">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div class="col-lg-6">
        <label class="d-flex align-items-center fs-6 form-label mb-2"
            for="shipping_price">
            <span class="required fw-bold">Shipping Price</span>
        </label>
        <input type="text" id="shipping_price" class="form-control form-control-solid"
            value="{{ $procurementItem->shipping_price ?? old('shipping_price') }}" @if($disabled) disabled @endif required name="shipping_price">
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
</div>


