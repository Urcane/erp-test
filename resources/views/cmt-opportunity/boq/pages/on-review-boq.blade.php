@extends('layouts.app')
@section('title-apps', 'BOQ')
@section('sub-title-apps-2', 'Commercial')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Bill Of Quantity')
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
    {{-- BOQ  COMMERCIAL --}}
    {{-- @dd($dataSurvey) --}}
    {{-- @dd($dataProspect) --}}
    {{-- @dd($updateDraftBoqData['dataSalesSelected']) --}}


    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @csrf
                            <div class="mb-6  d-flex justify-content-between flex-wrap">
                                <div class="mx-20 col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Review Bill of
                                        Quantity</span>
                                </div>

                                <div class="mx-20 col-lg-6 gap-3 d-flex align-items-center">
                                    <div class="mx-20 form-check form-check-custom form-check-success form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="approve_manager"
                                            name="approve_manager" />
                                        <label class="form-check-label" for="approve_manager">Approve</label>
                                    </div>
                                    <div class="mx-20 form-check form-check-custom form-check-danger form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="reject_manager"
                                            name="reject_manager" />
                                        <label class="form-check-label" for="reject_manager">Reject</label>
                                    </div>
                                </div>

                                <div class="mx-20 col-lg-6 gap-3 d-flex align-items-center">
                                    <div class="mx-20 form-check form-check-custom form-check-success form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="approve_finnman"
                                            name="approve_finnman" />
                                        <label class="form-check-label" for="approve_finnman">Approve</label>
                                    </div>
                                    <div class="mx-20 form-check form-check-custom form-check-danger form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="reject_finnman"
                                            name="reject_finnman" />
                                        <label class="form-check-label" for="reject_finnman">Reject</label>
                                    </div>
                                </div>

                                <div class="mx-20 col-lg-6 gap-3 d-flex align-items-center">
                                    <div class="mx-20 form-check form-check-custom form-check-success form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="approve_director"
                                            name="approve_director" />
                                        <label class="form-check-label" for="approve_director">Approve</label>
                                    </div>
                                    <div class="mx-20 form-check form-check-custom form-check-danger form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="reject_director"
                                            name="reject_director" />
                                        <label class="form-check-label" for="reject_director">Reject</label>
                                    </div>
                                </div>


                            </div>

                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">

                                    {{-- divv Company --}}
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        {{-- baris prospect company --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 450px; margin-bottom: 15px;">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Judul Prospect</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    placeholder="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->prospect_title }} - {{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                                <input type="hidden" class="form-control form-control-solid" disabled
                                                    name="prospect_id" id="prospect_id"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->prospect_id }}">
                                                <div id="error-prospect"></div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 450px; margin-bottom: 15px;">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Survey ID</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="survey_request_id" id="survey_request_id"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->survey_request_id }}"
                                                    {{ $updateDraftBoqData['dataCompanyItem'][0]->survey_request_id ?? 'Survey Tidak ada' }}>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        {{-- baris company contact --}}
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    id="customer_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customer_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" disabled name="customer_contact_name"
                                                    id="customer_contact_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_name }}">
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">No Kontak Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8" name="customer_contact_phone"
                                                        id="customer_contact_phone"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->customerContact->customer_contact_phone }}">
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 20%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Jenis Project</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" disabled name="type_name" id="type_name"
                                                    value="{{ $updateDraftBoqData['dataCompanyItem'][0]->customerProspect->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- sales & gpm required --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Sales</label>
                                                <input type="number" class="form-control form-control-solid disabled"
                                                    oninput="validateAndFormatNumber(this);" id="sales_id"
                                                    name="sales_id"
                                                    placeholder="{{ $updateDraftBoqData['dataSalesSelected']->name ?? 'Sales Tidak Ada' }}" />
                                            </div>

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Technician</label>
                                                <input type="number" class="form-control form-control-solid disabled"
                                                    oninput="validateAndFormatNumber(this);" id="technician_id"
                                                    name="technician_id"
                                                    placeholder="{{ $updateDraftBoqData['dataTechnicianSelected']->name ?? 'Technician Tidak Ada' }}" />
                                            </div>

                                            <div class=""
                                                style="flex-basis: 30%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Procurement</label>
                                                <input type="number" class="form-control form-control-solid disabled"
                                                    oninput="validateAndFormatNumber(this);" id="procurement_id"
                                                    name="procurement_id"
                                                    placeholder="{{ $updateDraftBoqData['dataProcurementSelected']->name ?? 'Procurement Tidak Ada' }}" />
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-around flex-wrap mx-20 my-8">

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">GPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="gpm"
                                                        name="gpm"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->gpm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Modal</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="modal"
                                                        name="modal"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->modal ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">NPM</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="npm"
                                                        name="npm"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->npm ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 18%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Manpower</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="manpower"
                                                        name="manpower"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->manpower ?? null }}" />
                                                </div>
                                            </div>

                                            <div class=""
                                                style="flex-basis: 10%; min-width: 200px; margin-bottom: 15px;">
                                                <label class="form-label">Percentage</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" class="form-control form-control-solid disabled"
                                                        oninput="validateAndFormatNumber(this);" id="percentage"
                                                        name="percentage"
                                                        value="{{ $updateDraftBoqData['dataCompanyItem'][0]->percentage ?? null }}" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tempat Items --}}
                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">

                                        <div class="MultipleItem">
                                            @if (isset($updateDraftBoqData['dataCompanyItem'][0]->itemable))
                                                @foreach ($updateDraftBoqData['dataCompanyItem'][0]->itemable as $relatedItem)
                                                    @php
                                                        $random_string = \Illuminate\Support\Str::random(4);
                                                    @endphp
                                                    <div
                                                        class="file-soft-boq-item-{{ $random_string }} d-flex justify-content-between mx-20 mb-5 mt-10">
                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Item</label>
                                                            <input type="text" class="form-control form-control-solid"
                                                                disabled name="content[][good_name]"
                                                                value="{{ $relatedItem->inventoryGood->good_name ?? null }}" />
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Merk</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="text"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][good_merk]"
                                                                    value="{{ $relatedItem->inventoryGood->merk ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Price</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][purchase_price]"
                                                                    value="{{ $relatedItem->purchase_price ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Qty</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][quantity]"
                                                                    value="{{ $relatedItem->quantity ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div style="flex-basis: 14%; min-width: 150px; margin: 10px;">
                                                            <label class="form-label">Jasa
                                                                Antar</label>
                                                            <div class="position-relative">
                                                                <div class="position-absolute top-0"></div>
                                                                <input type="number"
                                                                    class="form-control form-control-solid" disabled
                                                                    name="content[][purchase_delivery]"
                                                                    value="{{ $relatedItem->purchase_delivery_charge ?? null }}" />
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-between"
                                                            style="flex-basis: 28%; min-width: 150px; margin: 10px;">
                                                            <div style="flex-basis: 80%; min-width: 120px;">
                                                                <label class="form-label">Total
                                                                    Price</label>
                                                                <div class="position-relative">
                                                                    <div class="position-absolute top-0"></div>
                                                                    <input type="number"
                                                                        class="total-price form-control form-control-solid"
                                                                        disabled name="content[][total_price]"
                                                                        value="{{ $relatedItem->total_price ?? null }}" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <input type="hidden" name="content[][id]" disabled
                                                                value="{{ $relatedItem->id ?? null }}" />
                                                            <input type="hidden" name="content[][item_inventory_id]"
                                                                disabled
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

                                        @role('administrator')
                                            {{-- <div class="ms-15 w-20 mt-3 mb-3 ">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_boq">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                                <div id="error-item"></div>
                                            </div> --}}
                                        @endrole

                                    </div>

                                    {{-- layer total dan submit --}}
                                    <div>
                                        <div class="d-flex justify-content-end mx-20">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : Rp<span id="totalsum"></span></span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-6">
                                            <div class=" me-5">
                                                <a href="" class="btn btn-light-info">Discard</a>
                                            </div>
                                            <div class="me-5">
                                                <a href="cmt-boq" id="submit-all-items" class="btn btn-info">Submit</a>
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

        @role('administrator')
        @endrole

        <script>
            // Mengambil semua elemen checkbox dengan class "form-check-input"
            const checkboxes = document.querySelectorAll('.form-check-input');
            // Mendaftar event listener untuk setiap checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Jika checkbox yang dipilih adalah checkbox "Approve" di dalam grupnya
                    if (this.id.startsWith('approve')) {
                        // Matikan checkbox "Reject" di grup yang sama
                        const rejectCheckbox = document.querySelector(`#reject${this.id.substr(7)}`);
                        if (rejectCheckbox) {
                            rejectCheckbox.checked = false;
                        }
                    }
                    // Jika checkbox yang dipilih adalah checkbox "Reject" di dalam grupnya
                    else if (this.id.startsWith('reject')) {
                        // Matikan checkbox "Approve" di grup yang sama
                        const approveCheckbox = document.querySelector(`#approve${this.id.substr(6)}`);
                        if (approveCheckbox) {
                            approveCheckbox.checked = false;
                        }
                    }
                });
            });

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
            };

            //  function kalkulasi total di Modal
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
                $('#submit-all-items').on('click', function(event) {
                    event.preventDefault();

                    var boq_id = $('#prospect_id').val();

                    var is_approve_manager = $('#approve_manager').is(':checked');
                    var is_approve_finnman = $('#approve_finnman').is(':checked');
                    var is_approve_director = $('#approve_director').is(':checked');

                    // Jika checkbox "Reject Manager" dicentang, set is_approve_manager menjadi false
                    if ($('#reject_manager').is(':checked')) {
                        is_approve_manager = false;
                    }

                    // Jika checkbox "Reject Finnman" dicentang, set is_approve_finnman menjadi false
                    if ($('#reject_finnman').is(':checked')) {
                        is_approve_finnman = false;
                    }

                    // Jika checkbox "Reject Director" dicentang, set is_approve_director menjadi false
                    if ($('#reject_director').is(':checked')) {
                        is_approve_director = false;
                    }

                    var boq = {
                        boq_id: boq_id,
                        is_approve_manager: is_approve_manager ? 1 : 0,
                        is_approve_finnman: is_approve_finnman ? 1 : 0,
                        is_approve_director: is_approve_director ? 1 : 0,
                    };

                    console.log(boq);

                    // $.ajax({
                    //     url: "{{ route('com.boq.store.boq') }}",
                    //     method: 'POST',
                    //     data: {
                    //         _token: '{{ csrf_token() }}',
                    //         boq: boq,
                    //     },
                    //     success: function(response) {
                    //         console.log(response);
                    //     },
                    //     error: function(error) {
                    //         console.error('Error submitting all item data: ', error);
                    //     }
                    // });
                });


                function updateTotalSum() {
                    var totalSum = 0;

                    // Loop through each item's total price input field and sum up the values
                    $('.MultipleItem input[name="content[][total_price]"]').each(function() {
                        var totalPriceValue = $(this).val();

                        if (totalPriceValue !== "") {
                            totalSum += parseInt(totalPriceValue);
                        }
                    });
                    const totalPriceWithCommas = new Intl.NumberFormat("id").format(totalSum);
                    // Update the total sum element with the calculated value
                    $('#totalsum').text(totalPriceWithCommas);
                }

                updateTotalSum();
            });
        </script>

    @endsection
