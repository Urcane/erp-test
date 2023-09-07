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
                            <h3 class="card-title">
                                <span class="lh-xxl fw-bolder text-dark d-md-lh-l">Update Perangkat
                                    Quotation</span>
                            </h3>
                            <div class="card-toolbar p-3">
                                <a href="#kt_modal_create_purchase_order"
                                    class="btn_create_purchase_order p- btn btn-md btn-info w-lg-180px"
                                    data-id="{{ $dataQuotation['quotationData']->id }}" data-bs-toggle="modal"><i
                                        class="fa-solid fa-file me-3"></i>Purchase Order</a>
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
                                                        required id="no_quotation" name="no_quotation"
                                                        value="{{ $dataQuotation['quotationData']->no_quotation }}"
                                                        placeholder="No Quotation Wajib Di isi" />
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6 col-8 mb-3">
                                                <label for="description" class="form-label">
                                                    <span class="fw-bold required">Description</span></label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <textarea class="form-control form-control-solid required"
                                                        placeholder="{{ $dataQuotation['quotationData']->description ?? 'Description Wajib Di isi' }}" required
                                                        name="description" id="description" cols="" rows="2">{{ $dataQuotation['quotationData']->description }}</textarea>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    {{-- divv TAMBAH, SUBMIT DAN TOTAL AMOUNT INTERNET BUNDLE --}}
                                    <div>  
                                        <div class="d-flex justify-content-end mx-20 mb-5">
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

                                    {{--  input hidden --}}
                                    <div>
                                        <input type="hidden" name="id" id="id"
                                            value="{{ $dataQuotation['boqFinalData'][0]->id }}">
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
 
    @include('cmt-opportunity.quotation.add.modal-create-purchase-order')

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

            var dataFromFirstResponse = null; // Variabel untuk menyimpan data dari respons pertama
       
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

                    event.preventDefault();

                    // Get Prospect ID and Survey ID from the HTML elements
                    var boq_id = $('#id').val();
                    // var total_price_bundle = $('#total_price_bundle').val();
                    var total_price_bundle = 100000000;
                    var no_quotation = $('#no_quotation').val();
                    var description = $('#description').val();
 
                    // Create an object to store prospect_id and survey_request_id
                    var quotation = {
                        boq_id: boq_id,
                        no_quotation: no_quotation,
                        description: description,
                        total_price: total_price_bundle
                    };

                    console.log(quotation);  

                    $.ajax({
                        url: "{{ route('com.quotation.store.quotation') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            quotation: quotation, 
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


            $('body').on('click', '.btn_create_purchase_order', function() {

                $('.drop-data').val("").trigger("change")
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

            //  Calculate and update total sum on page load
            updateTotalSum(); 
        });
    </script>
@endsection
