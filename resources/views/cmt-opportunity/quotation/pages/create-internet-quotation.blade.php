@extends('layouts.app')
@section('title-apps', 'Quotation')
@section('sub-title-apps-2', 'Quotation')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Quotation')
@section('icon-apps', 'fa-solid fa-briefcase')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('summary-page')
    {{-- <div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataUser->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Pegawai</span>
</div>
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataDivision->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Divisi</span>
</div> --}}
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    {{-- FORM BOQ --}}
    {{-- @dd($dataCompany) --}}
    {{-- @dd($dataBoq['boqFinalData'][0]->customerProspect->customer->customer_name)   --}}
    {{-- @dd($dataBoq['boqFinalData'][0]->id)   --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark  d-md-lh-l ">Create Internet
                                    Quotation</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- Company --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">
                                        {{-- baris prospect company --}}
                                        <div class="d-flex justify-content-around col-12 flex-wrap">
                                            <div class="col-lg-5 col-8 col-md-5 mb-3">
                                                <label for="judul"
                                                    class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="judul"
                                                    placeholder="{{ $dataBoq['boqFinalData'][0]->customerProspect->prospect_title }} - {{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customer_name }}">

                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $dataBoq['boqFinalData'][0]->prospect_id }}">

                                                <div id="error-prospect"></div>
                                            </div>

                                            <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                            <div class="col-lg-5 col-8 col-md-5 mb-3">
                                                <label for="survey_request_id"
                                                    class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $dataBoq['boqFinalData'][0]->survey_request_id }}"
                                                    {{ $dataBoq['boqFinalData'][0]->survey_request_id ?? 'Survey Tidak ada' }}>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris company contact --}}
                                        <div class="d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="customer_name" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="customer_contact_name" class="form-label">Nama Kontak
                                                    Customer</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="customer_contact_phone" class="form-label">No Kontak
                                                    Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="type_name" class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataBoq['boqFinalData'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--  GPM --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">
                                        <div class="d-flex justify-content-around col-12 flex-wrap">

                                            <div class="col-lg-2 col-8 col-md-5 mb-3">
                                                <label class="form-label" for="gpm">GPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="gpm" disabled
                                                        name="gpm"
                                                        value="{{ $dataBoq['boqFinalData'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-md-5 mb-3">
                                                <label for="modal" class="form-label">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"disabled
                                                        oninput="validateAndFormatNumber(this);" id="modal"
                                                        name="modal"
                                                        value="{{ $dataBoq['boqFinalData'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-md-5 mb-3">
                                                <label for="npm" class="form-label">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="npm"disabled
                                                        name="npm"
                                                        value="{{ $dataBoq['boqFinalData'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-8 col-md-5 mb-3">
                                                <label for="manpower" class="form-label">Manpower</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="manpower"
                                                        name="manpower"disabled
                                                        value="{{ $dataBoq['boqFinalData'][0]->manpower ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-8 col-md-5 mb-3">
                                                <label for="percentage" class="form-label">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="percentage"
                                                        name="percentage"disabled
                                                        value="{{ $dataBoq['boqFinalData'][0]->percentage ?? null }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  ITEM --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">

                                        <div class="MultipleItem">
                                            @if (isset($dataBoq['boqFinalData'][0]->itemable))

                                                @foreach ($dataBoq['boqFinalData'][0]->itemable as $relatedItem)
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <div
                                                        class="file-soft-boq-item-{{ $random_string }} d-flex justify-content-around col-12 col-lg-12 flex-wrap">
                                                        <div class="col-lg-2 col-8 col-md-5 col-sm-5 mb-3">
                                                            <label for="item_{{ $random_string }}"
                                                                class="form-label">Item</label>
                                                            <input type="text" class="form-control form-control-solid"
                                                                disabled name="content[][good_name]"
                                                                id="item_{{ $random_string }}"
                                                                value="{{ $relatedItem->inventoryGood->good_name ?? null }}" />
                                                        </div>

                                                        {{-- <div class="col-lg-1 col-8 col-md-5 col-sm-5 mb-3">
                                                            <label for="merk_{{ $random_string }}"
                                                                class="form-label">Merk</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="text"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][good_merk]"
                                                                    id="merk_{{ $random_string }}"
                                                                    value="{{ $relatedItem->inventoryGood->merk ?? null }}" />
                                                            </div>
                                                        </div> --}}

                                                        <div class="col-lg-1 col-8 col-md-5 col-sm-5 mb-3">
                                                            <label for="quantity_{{ $random_string }}"
                                                                class="form-label">Qty</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][quantity]"
                                                                    id="quantity_{{ $random_string }}"
                                                                    value="{{ $relatedItem->quantity ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-8 col-md-5 col-sm-5 mb-3">
                                                            <label for="price_{{ $random_string }}"
                                                                class="form-label">Price</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][purchase_price]"
                                                                    id="price_{{ $random_string }}"
                                                                    value="{{ $relatedItem->purchase_price ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-8 col-md-5 col-sm-5 mb-3">
                                                            <label for="purchase_delivery_{{ $random_string }}"
                                                                class="form-label">Jasa
                                                                Antar</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][purchase_delivery]"
                                                                    id="purchase_delivery_{{ $random_string }}"
                                                                    value="{{ $relatedItem->purchase_delivery_charge ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2 col-8 col-md-5 col-sm-5 mb-3">
                                                            <label for="total_price_{{ $random_string }}"
                                                                class="form-label">Total
                                                                Price</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="total-price form-control form-control-solid"
                                                                    disabled name="content[][total_price]"
                                                                    id="total_price_{{ $random_string }}"
                                                                    value="{{ $relatedItem->total_price ?? null }}" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <input type="hidden" name="content[][id]" disabled
                                                            value="{{ $relatedItem->id ?? null }}" />
                                                        <input type="hidden" name="content[][item_inventory_id]" disabled
                                                            value="{{ $relatedItem->item_inventory_id ?? null }}" />
                                                        <input type="hidden" name="content[][purchase_reference]"
                                                            disabled
                                                            value="{{ $relatedItem->purchase_refrence ?? null }}" />
                                                        <input type="hidden" name="content[][item_detail]" disabled
                                                            value="{{ $relatedItem->item_detail ?? null }}" />
                                                    </div>
                                        </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-end mx-20">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Price Item : Rp<span
                                                        id="totalsum"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form id="kt_create_quotation_internet_form"
                                    class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                                    @csrf
                                    {{--  No Quota & Description --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">
                                        <div class="d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-3 col-md-4 col-8 mb-3">

                                                <label for="no_quotation" class="form-label">
                                                    <span class="fw-bold required">NO Quotation</span> </label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="text" class="form-control form-control-solid required"
                                                        required id="no_quotation" name="no_quotation" value=""
                                                        placeholder="No Quotation Wajib Di isi" />
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6 col-8 mb-3">

                                                <label for="description" class="form-label">
                                                    <span class="fw-bold required">Description</span></label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <textarea class="form-control form-control-solid required" placeholder="Description Wajib Di isi" required
                                                        name="description" id="description" cols="" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  BUNDLE INTERNET --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12"> 
                                        <div class="BundleItem"> 
                                            <div
                                                class="file-soft-quotation-bundle d-flex justify-content-around flex-wrap col-12">
                                                @php
                                                    $random_string = \Illuminate\Support\Str::random(4);
                                                @endphp
                                                <div
                                                    class="d-flex justify-content-around flex-nowrap col-lg-5 col-md-5 col-8 mb-3">
                                                    <div class="col-lg-9 col-md-9 col-9 col-sm-9">
                                                        <label for="good_name_bundle_{{ $random_string }}"
                                                            class="d-flex align-items-center fs-6 form-label mb-2"
                                                            required>
                                                            <span class="required fw-bold">Internet Bundle</span>
                                                        </label>
                                                        <select class="form-select form-select-solid drop-data" required
                                                            data-control="select2"
                                                            name="good_name_bundle_{{ $random_string }}"
                                                            id="good_name_bundle_{{ $random_string }}">
                                                            <option value="">Select Internet Bundle</option>
                                                            @if (isset($dataBoq['inventoryGoodInet']))
                                                                @foreach ($dataBoq['inventoryGoodInet'] as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->good_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center flex-nowrap col-lg-2 col-md-1 col-1 col-sm-1">
                                                        <div class="col-12">
                                                            <div class="h-25px"></div>
                                                            <a href="#kt_modal_tambah_bundle_internet"
                                                                data-bs-toggle="modal" id="btn-bundle-internet"
                                                                class="btn btn-light-info btn-sm btn_bundle_internet">
                                                                <i class="fa-solid fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 col-md-5 col-8 mb-3">
                                                    <label for="quantity_{{ $random_string }}"
                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold required">Quantity</span>
                                                    </label>
                                                    <input class="form-control" type="text" required min="1"
                                                        minlength="1"
                                                        oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                        name="quantity_{{ $random_string }}"
                                                        id="quantity_{{ $random_string }}">
                                                </div>

                                                <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                    <label for="purchase_price_{{ $random_string }}"
                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold required">Purchase Price</span>
                                                    </label>
                                                    <input class="form-control" type="text" required min="1"
                                                        minlength="1"
                                                        oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                        name="purchase_price_{{ $random_string }}"
                                                        id="purchase_price_{{ $random_string }}">
                                                </div>

                                                <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                    <label for="total_price_{{ $random_string }}"
                                                        class="d-flex align-items-center fs-6 form-label mb-2">
                                                        <span class="fw-bold">Total Price</span>
                                                    </label>
                                                    <input class="form-control" type="text" required min="1"
                                                        minlength="1" disabled
                                                        oninput="validateAndFormatNumber(this); calculateTotalBundle('{{ $random_string }}');"
                                                        name="total_price{{ $random_string }}"
                                                        id="total_price_{{ $random_string }}">
                                                </div>
                                            </div>

                                            <div class="ms-15 w-20 mt-6 mb-10 col-lg-3">
                                                <button class="btn btn-light-info btn-sm me-3 btn_bundle" id="btn-bundle">
                                                    <i class="fa-solid fa-plus"></i>Tambah Bundle Internet
                                                </button>
                                                {{-- <div id="error-item"></div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- SUBMIT DAN TOTAL AMOUNT INTERNET BUNDLE --}}
                                    <div>
                                        <div class="d-flex justify-content-end mx-20">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Price Bundle : Rp<span
                                                        id="totalsumbundle"></span></span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-6">
                                            <div class=" me-5">
                                                <button type="reset" id="kt_modal_tambah_boq_cancel"
                                                    class="btn btn-sm btn-light-info me-3 w-lg-200px"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="me-5">
                                                <button type="submit" id="kt_modal_tambah_boq_submit"
                                                    class="btn btn-sm btn-info w-lg-200px">
                                                    <span class="indicator-label">Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- input hidden --}}
                                    <div>
                                        <input type="hidden" name="id" id="id"
                                            value="{{ $dataBoq['boqFinalData'][0]->id }}">
                                        <input type="hidden" name="total_price_bundle" id="total_price_bundle">
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @role('administrator')
        @include('cmt-opportunity.quotation.add.modal-tambah-bundle-internet')
    @endrole

    <script>
        function validateAndFormatNumber(input) {
            // Mengambil nilai input tanpa karakter non-digit
            let inputValue = input.value.replace(/\D/g, '');

            // Pastikan nilai input tidak kosong
            if (inputValue.length > 0) {
                // Pastikan nilai input tidak diawali dengan angka 0
                if (inputValue[0] === '0') {
                    // Jika nilai input diawali dengan angka 0, hapus angka 0 di awal
                    inputValue = inputValue.slice(1);
                }
            }

            // Mengatur nilai input kembali dengan angka yang telah diformat
            input.value = inputValue;

            updateTotalSumBundle();
        };


        function updateTotalSum() {
            var totalSum = 0;

            // Loop through each item's total price input field and sum up the values
            $('.MultipleItem input[name^="content[][total_price]"]').each(function() {
                var totalPriceValue = $(this).val();

                if (totalPriceValue !== "") {
                    totalSum += parseInt(totalPriceValue);
                }
            });
            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSum);
            // Update the total sum element with the calculated value
            $('#totalsum').text(totalPriceWithCommas);
        }

        function updateTotalSumBundle() {
            var totalSumBundle = 0;

            const gpmVal = parseInt(document.querySelector(`[name='gpm']`).value);

            // Loop through each item's total price input field and sum up the values
            $('.BundleItem input[name^="total_price"]').each(function() {
                var totalPriceBundleValue = $(this).val();

                if (totalPriceBundleValue !== "") {
                    totalSumBundle += parseInt(totalPriceBundleValue);
                }
            });

            if (gpmVal <= totalSumBundle) {
                return document.getElementById("totalsumbundle").textContent = "   MELEBIHI LIMIT GPM";
            }
            const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSumBundle);
            // Update the total sum element with the calculated value
            $('#totalsumbundle').text(totalPriceWithCommas);

            const hiddenTotalInput = document.querySelector(`[name='total_price_bundle']`);
            hiddenTotalInput.value = totalSumBundle; // Set the hidden input value to empty string
        }


        function calculateTotalBundle(uniq_id) {
            const purchasePrice = parseFloat(document.querySelector(`[name='purchase_price_${uniq_id}']`).value);
            const quantity = parseInt(document.querySelector(`[name='quantity_${uniq_id}']`).value);

            if (isNaN(purchasePrice) || isNaN(quantity)) {
                return document.getElementById("total_price_" + uniq_id).value = "null";
            }

            let totalAmount = purchasePrice * quantity;

            if (totalAmount.toString().length > 15) {
                return document.getElementById("total_price_" + uniq_id).value = "Melewati limit angka";
            }

            // const totalAmountWithCommas = new Intl.NumberFormat("id").format(totalAmount);

            document.getElementById("total_price_" + uniq_id).value = totalAmount;
            updateTotalSumBundle()
        }

        function calculateTotalAmount(totalElementId, modal) {
            // Mengambil nilai dari masing-masing input menggunakan querySelector
            const purchasePrice = parseFloat(document.querySelector(`[name='purchase_price_${modal}']`).value);
            const quantity = parseInt(document.querySelector(`[name='quantity_${modal}']`).value);
            const purchaseDelivery = parseFloat(document.querySelector(`[name='purchase_delivery_${modal}']`).value);


            // Cek jika nilai purchasePrice dan quantity adalah angka
            if (isNaN(purchasePrice) || isNaN(quantity)) {
                // Jika ada input yang belum diisi atau bukan angka, tampilkan hasil kosong dan return
                document.getElementById(totalElementId).textContent = "";
                const hiddenTotalInput = document.querySelector(`[name='${totalElementId}']`);
                hiddenTotalInput.value = ""; // Set the hidden input value to empty string
                return;
            }

            // Melakukan perhitungan total
            let totalAmount = purchasePrice * quantity;

            // Tambahkan purchaseDelivery ke totalAmount jika nilai purchaseDelivery adalah angka
            if (!isNaN(purchaseDelivery)) {
                totalAmount += purchaseDelivery;
            }

            // Cek jika totalAmount melebihi 12 karakter
            // 9,007,199,254,740,991 maksimal karakter number
            if (totalAmount.toString().length > 15) {
                document.getElementById(totalElementId).textContent = "Melewati limit angka";
                const hiddenTotalInput = document.querySelector(`[name='${totalElementId}']`);
                hiddenTotalInput.value = ""; // Set the hidden input value to empty string
                return;
            }

            // Menampilkan total dalam format dengan tanda titik setiap 3 digit dari kanan
            const totalAmountWithCommas = new Intl.NumberFormat("id").format(totalAmount);

            // Mengatur nilai total pada elemen dengan id 'totalDisplay'
            document.getElementById(totalElementId).textContent = totalAmountWithCommas;

            // Mengatur nilai total pada elemen dengan class 'total' (hidden input)
            const hiddenTotalInput = document.querySelector(`[name='${totalElementId}']`);
            hiddenTotalInput.value = totalAmount; // Store the numerical value for passing to the main page.
        }

        $(document).ready(function() {
            // Function Tambah Bundling Internet 
            $('#btn-bundle').on('click', function() {
                // Find the parent container where you want to append new divs
                const parentContainer = document.querySelector(".BundleItem");

                // Create a new div element
                const newDiv = document.createElement("div");
                newDiv.className =
                    "file-soft-quotation-bundle d-flex justify-content-around flex-wrap mb-10 col-12";

                const random_string = generateRandomString(4);
                // Define the HTML structure as a string literal
                const htmlStructure = `   
                    <div class="col-lg-5 col-md-5 col-8 mb-3">
                        <label for="good_name_bundle_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                            <span class="required fw-bold">Internet Bundle</span>
                        </label>
                        <select class="form-select form-select-solid drop-data" required
                            data-control="select2" name="good_name_bundle_${random_string}"
                            id="good_name_bundle_${random_string}">
                            <option selected>Select Internet Bundle</option>
                        </select> 
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="col-lg-1 col-md-5 col-8 mb-3">
                        <label for="quantity_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                            <span class="fw-bold required">Quantity</span>
                        </label>
                        <input class="form-control required" type="text" required min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="quantity_${random_string}" id="quantity_${random_string}">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="col-lg-2 col-md-5 col-8 mb-3">
                        <label for="purchase_price_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                            <span class="fw-bold required">Purchase Price</span>
                        </label>
                        <input class="form-control required" type="text" required min="1" minlength="1" oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="purchase_price_${random_string}" id="purchase_price_${random_string}">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center flex-nowrap col-lg-2 col-md-5 col-8 mb-3">
                        <div class="col-lg-9 col-md-9 col-9 mb-3" >
                            <label for="total_price_${random_string}" class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Total Price</span>
                            </label>
                            <input class="form-control" type="text" min="1" minlength="1" disabled oninput="validateAndFormatNumber(this); calculateTotalBundle('${random_string}');" name="total_price_${random_string}" id="total_price_${random_string}">
                        </div>
                        <div class="col-lg-2 col-md-2 col-2 mb-3">
                            <div>
                                <div class="h-25px"></div> 
                                <button type="button" class="btn btn-secondary btn-icon btn-sm h-44px" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button> 
                                <ul class="dropdown-menu"> 
                                    <li type="button" class="clear-purchase-order-item-${random_string}"
                                        data-random-string="${random_string}">
                                        <a class="dropdown-item py-2">
                                        <i class="fa-solid fa-trash me-3"></i>Hapus Item</a>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                `;

                // Set the HTML content of the new div to the HTML structure
                newDiv.innerHTML = htmlStructure;

                $.ajax({
                    url: "{{ route('com.quotation.get.internet.bundling') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $(newDiv).find('#good_name_bundle_' + random_string)
                            .empty(); // Hapus opsi yang ada sebelumnya
                        $(newDiv).find('#good_name_bundle_' + random_string).append($(
                            '<option>', {
                                value: '',
                                text: 'Select Internet Bundle'
                            }));
                        $.each(response, function(index, item) {
                            $(newDiv).find('#good_name_bundle_' + random_string).append(
                                $(
                                    '<option>', {
                                        value: item.id,
                                        text: item.good_name
                                    }));
                        });

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                // Append the new div to the parent container
                parentContainer.appendChild(newDiv);

                $(`select[name="good_name_bundle_${random_string}"]`).select2({
                    dropdownAutoWidth: true
                });

                // Function Hapus per Item
                $('.BundleItem').on('click', `.clear-purchase-order-item-${random_string}`,
                    function() {
                        $(this).parent().parent().parent().parent().parent().remove();
                        updateTotalSumBundle();
                    });

            });

            // Function Muncul Modal Bundling Internet BARU
            $('#btn-bundle-internet').on('click', '.btn_bundle_internet', function() {
                $('.drop-data').val("").trigger("change");
                $('#kt_modal_tambah_bundle_internet_form').trigger("reset");
                $('#kt_modal_tambah_bundle_internet_submit').removeAttr('disabled', 'disabled');
            });

            // Function Submit Modal
            $("#kt_modal_tambah_bundle_internet_form").validate({
                messages: {
                    good_name_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Wajib Mengisi Nama Item</span>",
                    },
                    code_name_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Code Barang wajib diisi</span>",
                    },
                    merk_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Merk Barang wajib diisi</span>",
                    },
                    good_type_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Tipe Barang wajib diisi</span>",
                    },
                    description_update: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Deskripsi Barang wajib diisi</span>",
                    }
                },
                submitHandler: function() {
                    event.preventDefault();
                    // Dapatkan referensi ke elemen form
                    var form = document.getElementById("kt_modal_tambah_bundle_internet_form");

                    // Dapatkan nilai dari input berdasarkan nama (name)
                    var goodName = form.querySelector('input[name="good_name_update"]').value;
                    var codeName = form.querySelector('input[name="code_name_update"]').value;
                    var merk = form.querySelector('input[name="merk_update"]').value;
                    var goodType = form.querySelector('input[name="good_type_update"]').value;
                    var description = form.querySelector('textarea[name="description_update"]').value;
                    var goodCategoryId = form.querySelector('input[name="good_category_id_update"]')
                        .value;

                    // Sekarang, Anda memiliki nilai dari masing-masing input berdasarkan nama (name)
                    console.log("Nama Inventory Item:", goodName);
                    console.log("Code Item:", codeName);
                    console.log("Merk:", merk);
                    console.log("Tipe Barang:", goodType);
                    console.log("Detail Item Inventory:", description);
                    console.log("Good Category ID:", goodCategoryId);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('com.quotation.update.internet.bundling') }}", // Ganti dengan URL yang sesuai
                        data: {
                            _token: '{{ csrf_token() }}',
                            good_category_id: goodCategoryId,
                            good_name: goodName,
                            code_name: codeName,
                            merk: merk,
                            good_type: goodType,
                            description: description
                        },
                        success: function(response) {
                            console.log("Data berhasil disimpan:", response.message);
                            form.reset();

                            $('#kt_modal_tambah_bundle_internet').modal('hide');

                            $('#error-item').empty();

                            $(`select[name^="good_name_bundle"]`).append($(
                                '<option>', {
                                    value: response.item.id,
                                    text: response.item.good_name
                                }));
                        },
                        error: function(error) {
                            console.error("Terjadi kesalahan:", error);
                        },
                    });
                }
            });

            // Function Submit Modal
            $("#kt_create_quotation_internet_form").validate({
                messages: {
                    no_quotation: {
                        required: "<span class='fw-semibold fs-8 text-danger'>NO QUOTATION Wajib diisi</span>",
                    },
                    description: {
                        required: "<span class='fw-semibold fs-8 text-danger'>DESRCIPTION Wajib diisi</span>",
                    }
                },

                submitHandler: function() {

                    // event.preventDefault();

                    // Get Prospect ID and Survey ID from the HTML elements
                    var boq_id = $('#id').val();
                    var total_price_bundle = $('#total_price_bundle').val();
                    var no_quotation = $('#no_quotation').val();
                    var description = $('#description').val();

                    // Array to store all item data
                    var bundle = [];
                    // Create an object to store prospect_id and survey_request_id
                    var quotation = {
                        boq_id: boq_id,
                        no_quotation: no_quotation,
                        description: description,
                        total_price: total_price_bundle
                    };

                    console.log(quotation);

                    // Loop through each .file-soft-boq-item div to get the data for each item
                    $('.BundleItem [class^="file-soft-quotation-bundle"]').each(function(index, item) {
                        // Extract data for the specific item
                        var id = $(item).find('select[name^="good_name_bundle"]').val();
                        var purchase_price = $(item).find('input[id^="purchase_price"]').val();
                        var quantity = $(item).find('input[id^="quantity"]').val();
                        var total_price = $(item).find('input[name^="total_price"]').val();

                        // Create an object to store the data for the specific item
                        var itemData = {
                            id: id,
                            quantity: quantity,
                            purchase_price: purchase_price,
                            total_price: total_price
                        };

                        // Push the itemData object to the items array
                        bundle.push(itemData);
                    });
                    console.log(bundle);

                    $.ajax({
                        url: "{{ route('com.quotation.store.quotation') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            quotation: quotation,
                            bundle: bundle
                        },
                        success: function(response) {
                            // Handle the response from the server, e.g., show a success message
                            console.log(response);
                        },
                        error: function(error) {
                            // Handle errors if the request fails
                            console.error('Error submitting all bundle data: ', error);
                        }
                    });

                }
            });

            //  Calculate and update total sum on page load
            updateTotalSum();
        });
    </script>
@endsection
