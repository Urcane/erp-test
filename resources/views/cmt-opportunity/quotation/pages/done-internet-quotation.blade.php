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
    {{-- @dd($dataQuotation['quotationData'])   --}}
    {{-- @dd($dataQuotation['boqFinalData']) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-lg-4 col-md-3 col-sm-12">
                                <span class="lh-xxl fw-bolder text-dark d-md-lh-l">Done Internet
                                    Quotation</span>
                            </h3>
                            <div class="card-toolbar col-12 col-lg-2 col-md-3 col-sm-12 ">
                                <a href="#kt_modal_cancel_quotation"
                                    class="btn_cancel_quotation btn btn-md btn-danger w-lg-180px col-12"
                                    data-id="{{ $dataQuotation['quotationData']->id }}" data-bs-toggle="modal"><i
                                        class="fa-solid fa-xmark me-3"></i>Cancel Quotation</a>
                            </div>
                            <div class="card-toolbar col-12 col-lg-3 col-md-3 col-sm-12 ">
                                <a href="#kt_modal_see_purchase_order"
                                    class="btn_see_purchase_order btn btn-md btn-info w-lg-180px col-12"
                                    data-id="{{ $dataQuotation['quotationData']->id }}" data-bs-toggle="modal"><i
                                        class="fa-solid fa-file me-3"></i>Lihat Purchase Order</a>
                            </div>
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
                                                    placeholder="{{ $dataQuotation['boqFinalData'][0]->customerProspect->prospect_title }} - {{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customer_name }}">
                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->prospect_id }}">
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
                                                    value="{{ $dataQuotation['boqFinalData'][0]->survey_request_id }}"
                                                    {{ $dataQuotation['boqFinalData'][0]->survey_request_id ?? 'Survey Tidak ada' }}>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris company contact --}}
                                        <div class="d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="customer_name" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customer_name }}">
                                            </div>
                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="customer_contact_name" class="form-label">Nama Kontak
                                                    Customer</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="customer_contact_name" id="customer_contact_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>
                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="customer_contact_phone" class="form-label">No Kontak
                                                    Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                <label for="type_name" class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled name="type_name" id="type_name"
                                                    value="{{ $dataQuotation['boqFinalData'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">
                                        <div class="d-flex justify-content-around flex-wrap col-12">

                                            <div class="col-lg-3 col-md-4 col-8 mb-3">
                                                <label for="no_quotation" class="form-label">
                                                    <span class="fw-bold ">NO Quotation</span> </label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="text" class="form-control form-control-solid " disabled
                                                        id="no_quotation" name="no_quotation"
                                                        value="{{ $dataQuotation['quotationData']->no_quotation }}"
                                                        placeholder="No Quotation Wajib Di isi" />
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6 col-8 mb-3">
                                                <label for="description" class="form-label">
                                                    <span class="fw-bold ">Description</span></label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <textarea class="form-control form-control-solid "
                                                        placeholder="{{ $dataQuotation['quotationData']->description ?? 'Description Wajib Di isi' }}" disabled
                                                        name="description" id="description" cols="" rows="2">{{ $dataQuotation['quotationData']->description }}</textarea>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
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
                                                        value="{{ $dataQuotation['boqFinalData'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-md-5 mb-3">
                                                <label for="modal" class="form-label">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"disabled
                                                        oninput="validateAndFormatNumber(this);" id="modal"
                                                        name="modal"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-8 col-md-5 mb-3">
                                                <label for="npm" class="form-label">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="npm"disabled
                                                        name="npm"
                                                        value="{{ $dataQuotation['boqFinalData'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-8 col-md-5 mb-3">
                                                <label for="manpower" class="form-label">Manpower</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="manpower"
                                                        name="manpower"disabled
                                                        value="{{ $dataQuotation['boqFinalData'][0]->manpower ?? null }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-8 col-md-5 mb-3">
                                                <label for="percentage" class="form-label">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid"
                                                        oninput="validateAndFormatNumber(this);" id="percentage"
                                                        name="percentage"disabled
                                                        value="{{ $dataQuotation['boqFinalData'][0]->percentage ?? null }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  ITEM --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x col-lg-12">

                                        <div class="MultipleItem">
                                            @if (isset($dataQuotation['boqFinalData'][0]->itemable))

                                                @foreach ($dataQuotation['boqFinalData'][0]->itemable as $relatedItem)
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
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-end mx-20 mt-3 mb-5">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Price Item : Rp<span
                                                        id="totalsum"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--  BUNDLE INTERNET --}}
                                <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                    <div class="BundleItem">
                                        @if (isset($dataQuotation['quotationItem']))

                                            @foreach ($dataQuotation['quotationItem'] as $relatedItem)
                                                @php
                                                    $random_string = \Illuminate\Support\Str::random(4);
                                                @endphp

                                                <div
                                                    class="file-soft-quotation-bundle-{{ $random_string }} d-flex justify-content-around flex-wrap col-lg-12 mb-10">
                                                    <!-- Internet Bundle -->
                                                    <div class="col-lg-5 col-md-5 col-8 mb-3">
                                                        <label for="good_name_bundle_{{ $random_string }}"
                                                            class="d-flex align-items-center fs-6 form-label mb-2">
                                                            <span class=" fw-bold">Internet
                                                                Bundle</span>
                                                        </label>
                                                        <select class="form-control form-control-solid  drop-data"
                                                            data-control="select2" disabled
                                                            name="good_name_bundle_{{ $random_string }}"
                                                            id="good_name_bundle_{{ $random_string }}">

                                                            @foreach ($dataQuotation['inventoryGoodInet'] as $item)
                                                                @if ($relatedItem->item_inventory_id == $item->id)
                                                                    <option selected value="{{ $item->id }}">
                                                                        {{ $item->good_name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->good_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <!-- Quantity -->
                                                    <div class="col-lg-1 col-md-5 col-8 mb-3">
                                                        <label for="quantity_{{ $random_string }}"
                                                            class="d-flex align-items-center fs-6 form-label mb-2">
                                                            <span class="fw-bold ">Quantity</span>
                                                        </label>
                                                        <input class="form-control form-control-solid " type="text"
                                                            min="1" minlength="1" disabled
                                                            name="quantity_{{ $random_string }}"
                                                            id="quantity_{{ $random_string }}"
                                                            value="{{ $relatedItem->quantity }}">
                                                    </div>

                                                    <!-- Purchase Price -->
                                                    <div class="col-lg-2 col-md-5 col-8 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="purchase_price_{{ $random_string }}">
                                                            <span class="fw-bold ">Purchase Price</span>
                                                        </label>
                                                        <input class="form-control form-control-solid " type="text"
                                                            min="1" minlength="1" disabled
                                                            name="purchase_price_{{ $random_string }}"
                                                            value="{{ $relatedItem->purchase_price }}"
                                                            id="purchase_price_{{ $random_string }}">
                                                    </div>

                                                    <!-- Total Price -->
                                                    <div class="col-lg-2 col-md-5 col-8 mb-3">

                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="total_price_{{ $random_string }}">
                                                            <span class="fw-bold">Total Price</span>
                                                        </label>
                                                        <input class="form-control form-control-solid " type="text"
                                                            min="1" minlength="1" disabled
                                                            name="total_price_{{ $random_string }}"
                                                            id="total_price_{{ $random_string }}"
                                                            value="{{ $relatedItem->total_price }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                </div>

                                {{-- TAMBAH, SUBMIT DAN TOTAL AMOUNT INTERNET BUNDLE --}}
                                <div>
                                    <div class="d-flex justify-content-end mx-20 mb-5">
                                        <div class="w-20 me-10">
                                            <span class="fw-bold">Total Price Bundle : Rp<span
                                                    id="totalsumbundle"></span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-6">
                                        <div class=" me-5">
                                            <a href="" class="btn btn-light-info">Discard</a>
                                        </div>
                                        <div class="me-5">
                                            <button type="button" class="btn btn-md btn-danger me-3 print-form">
                                                <i class="fa-solid fa-print fs-6"></i>Print
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="printerDiv" style="display: hidden;"></div>
    
    @include('cmt-opportunity.quotation.add.modal-see-purchase-order')
    @include('cmt-opportunity.quotation.add.modal-cancel-quotation')
    <script>
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
        }

        $(document).ready(function() {

            $('body').on('click', '.btn_create_purchase_order', function() {
 
                $('#kt_modal_create_purchase_order_form').trigger("reset")
                $('#kt_modal_create_purchase_order_submit').removeAttr('disabled', 'disabled');

                var quo_id = $(this).data('id');
                $('#quotation_id').val(quo_id);

                $(`.file-purchase-order-item-initial`).change(function() {
                    imageReadURL(this);
                });

                submitModal({
                    modalName: 'kt_modal_create_purchase_order',
                    tableName: 'kt_table_purchase_order',
                    anotherTableName: 'tableOnProgressPurchaseOrder',
                    ajaxLink: "{{ route('com.quotation.store.po') }}",
                    successCallback: function(response) {
                        // Redirect ke halaman yang sesuai setelah operasi berhasil
                        window.location.href = "{{ route('com.quotation.index') }}";
                    }
                })

            });

            $('body').on('click', '.btn_cancel_quotation', function() {  
                $('#kt_modal_cancel_quotation_form').trigger("reset")
                $('#kt_modal_cancel_quotation_submit').removeAttr('disabled', 'disabled');

                var quo_id = $(this).data('id');
                $('#quo_id').val(quo_id); 

                submitModal({
                    modalName: 'kt_modal_cancel_quotation',
                    tableName: 'kt_table_cancel_quotation',
                    anotherTableName: 'tableCancelQuotation',
                    ajaxLink: "{{ route('com.quotation.cancel.quotation') }}",
                    successCallback: function(response) {
                        // Redirect ke halaman yang sesuai setelah operasi berhasil
                        window.location.href = "{{ route('com.quotation.index') }}";
                    }
                })
            });

            $('.print-form').click(function() {
                const div = document.getElementById("printerDiv");
                div.innerHTML =
                    `<iframe src="{{ route('com.quotation.result.export', ['isQuotation' => 'internet', 'id' => $dataQuotation['quotationData']->id]) }}" onload="this.contentWindow.print();"></iframe>`;
            });

            updateTotalSum();
            updateTotalSumBundle();
        });
    </script>
@endsection
