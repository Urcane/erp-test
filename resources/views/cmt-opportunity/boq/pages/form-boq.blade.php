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
    {{-- FORM BOQ --}}
    {{-- @dd($dataCompany) --}}

    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-6 align-items-center">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Bill of Quantity</span>
                                </div>
                            </div>

                            {{-- header company --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                        {{-- baris 1 --}}
                                        <div class="d-flex justify-content-between mx-20 my-8">
                                            <div class="w-75">
                                                <label for="" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    value="{{ $dataCompany->customer->customer_name }}">
                                            </div>

                                            <div class="ms-10 w-25">
                                                <label for="" class="form-label">Tenggat
                                                    Waktu</label>
                                                <div class="position-relative">
                                                    <div class=" position-absolute top-0"></div>
                                                    <input type="date" class="form-control form-control-solid" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- baris2 --}}
                                        <div class="d-flex justify-content-between mx-20 my-8">
                                            <div class="w-50">
                                                <label for="" class="form-label">Alamat Perusahaan</label>
                                                <textarea class="form-control form-control-solid" disabled rows="2" required style="resize:none">{{ $dataCompany->customer->customer_address }}</textarea>
                                            </div>

                                            <div class="w-25">
                                                <label for="" class="form-label">Jenis
                                                    Project</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->bussinesType->type_name }}">
                                            </div>
                                        </div>

                                        {{-- baris 3 lat lng --}}
                                        <div class="d-flex justify-content-around mx-15 my-8">
                                            <div class="w-25">
                                                <label for="" class=" form-label">Lat</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->lat }}" name=" ">
                                            </div>

                                            <div class="w-25">
                                                <label for="" class="form-label">Lng</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled value="{{ $dataCompany->customer->lng }}" name="">
                                            </div>
                                        </div>

                                        {{-- baris 4 contatct --}}
                                        <div class="d-flex justify-content-around mx-20 my-8">
                                            <div class="w-9vw">
                                                <label for="" class=" form-label">Nama Kontak Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_name }}"
                                                    name="">
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="form-label">Jabatan
                                                    Customer</label>
                                                <input type="text" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_job }}"
                                                    name="">
                                            </div>
                                            <div class="w-9vw">
                                                <label for="" class=" form-label">Email Customer</label>
                                                <input type="email" class="form-control form-control-solid" placeholder=""
                                                    disabled
                                                    value="{{ $dataCompany->customer->customerContact->customer_contact_email }}"
                                                    name="">
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="form-label">No Kontak
                                                    Customer</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0" id="">+62</span>
                                                    <input type="number" class="form-control form-control-solid" disabled
                                                        minlength="8"
                                                        value="{{ $dataCompany->customer->customerContact->customer_contact_phone }}"
                                                        name="" />
                                                </div>
                                            </div>

                                            {{-- <div class="w-9vw">
                                                <label for=""
                                                    class="required form-label">Manpower</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="manpower"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span class="input-group-text border-0">Orang</span>
                                                </div>
                                            </div> --}}

                                        </div>
                                        {{-- baris 3 --}}
                                        {{-- <div class="d-flex justify-content-between mx-20 my-8 mt-10px">
                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Lama
                                                    Pengadaan Barang</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="pengadaan_barang"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Hari</span>
                                                </div>
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Lama
                                                    Pengiriman Barang</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="pengiriman_barang"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Hari</span>
                                                </div>
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Lama
                                                    Perjalanan Tim</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="perjalanan_tim"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Hari</span>
                                                </div>
                                            </div>

                                            <div class="w-9vw">
                                                <label for="" class="required form-label">Manpower</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-solid"
                                                        placeholder="" required min="1" minlength="1" placeholder=""
                                                        value="" name="manpower"
                                                        oninput="validateAndFormatNumber(this)">
                                                    <span
                                                        class="input-group-text border-0">Orang</span>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- baris 4 --}}



                                    </div>

                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                        <div class="MultipleInput">

                                            <div class="d-flex justify-content-center mx-20 mb-5 mt-10 DuplicateRow">
                                                <div class="w-20">
                                                    <label for="" class=" form-label">Item</label>
                                                    <input type="text" class="form-control form-control-solid" name="content[]['good_id']"
                                                        placeholder="Example input" />
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="" class=" form-label">Merk</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid" name="content[]['good_merk']"
                                                            placeholder="Example input" />
                                                    </div>
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="" class=" form-label">Price</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid" name="content[]['price']"
                                                            placeholder="Example input" />
                                                    </div>
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="" class=" form-label">Qty</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Example input" />
                                                    </div>
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="" class=" form-label">Total
                                                        Price</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <button type="button" id="additembtn" class="btn text-info btn-sm me-3">
                                        <i class="fa-solid fa-plus text-info"></i> Add Item
                                    </button> --}}

                                        @role('administrator')
                                            <div class="ms-15 w-20 mt-3 tab_all_menu_lead">
                                                <a href="#kt_modal_tambah_boq" data-bs-toggle="modal"
                                                    class="btn btn-light-info btn-sm me-3 btn_tambah_lead">
                                                    <i class="fa-solid fa-plus"></i>Item Baru</a>
                                            </div>
                                        @endrole

                                        {{-- <div class="ms-15 w-20 mt-3">
                                        <a href="" data-bs-toggle="modal" class="btn text-info btn-sm me-3 additembtn"><i class="fa-solid fa-plus text-info"></i>Add Item</a>
                                    </div> --}}

                                        <div class="d-flex justify-content-end mx-20">
                                            <div class="w-20 me-10">
                                                <span class="fw-bold">Total Amount : <span>Rp.0</span></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-6">
                                            <div class=" me-5">
                                                <a href="cmt-boq" class="btn btn-light-info">Discard</a>
                                            </div>
                                            <div class="">
                                                <a href="{{ url()->previous() }}" class="btn btn-info">Submit</a>
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

    {{-- FORM BOQ KOMERSIL
<div class="row justify-content-center">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6 gap-3 d-flex align-items-center">
                                <span class="lh-xxl fw-bolder text-dark d-none d-md-block">Bill of Quantity</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5 mt-3 border-dashed border-gray-100 hover-scroll-x">
                                    <div class="d-flex justify-content-center mx-20 my-10">
                                        <div class="w-25">
                                            <label for="" class="required form-label">Company Name</label>
                                            <input type="email" class="form-control form-control-solid" placeholder="Example input"/>
                                        </div>
                                        
                                        <div class="ms-10 w-25">
                                            <label for="" class="form-label required">Project</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-25">
                                            <label for="" class="form-label required">No Project</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-25">
                                            <label for="" class="form-label required">Project</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="date" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                    <span class="lh-xxl mt-3 ms-5 fw-bolder text-uppercase text-dark d-none d-md-block">Jasa instalasi local loop</span>
                                    <div class="d-flex justify-content-center mx-20 mb-5 mt-10 mx-20 my-10">
                                        <div class="w-10">
                                            <div class="position-relative">
                                                <label for="" class="required form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                        
                                        <div class="ms-10 w-10">
                                            <label for="" class="required form-label">Site</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="" class="form-label required">Layanan</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="" class="form-label required">Newlink</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="" class="form-label required">Vendor</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="" class="form-label required">Total Monthly</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-15 w-20 mt-3">
                                        <a href="" data-bs-toggle="modal" class="btn text-info btn-sm me-3 "><i class="fa-solid fa-plus text-info"></i>Add Item</a>
                                    </div>  
                                </div>

                                <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                    <span class="lh-xxl mt-3 ms-5 fw-bolder text-dark text-uppercase d-none d-md-block">OTC AKSESORIS DAN MATERIAL INSTALASI</span>
                                    <div class="d-flex justify-content-center mx-20 mb-5 mt-10">
                                        <div class="w-15">
                                            <label for="" class="required form-label">Nama Barang</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                        </div>
                                        
                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Site</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Layanan</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Qty</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Material dan Acc</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Total</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mx-20">
                                        <div class="w-15">
                                            <label for="" class="required form-label">Nama Barang</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                        </div>
                                        
                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Site</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Layanan</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Qty</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Material dan Acc</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="" class="form-label required">Total</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-15 w-20 mt-3">
                                        <a href="" data-bs-toggle="modal" class="btn text-info btn-sm me-3 "><i class="fa-solid fa-plus text-info"></i>Add Item</a>
                                    </div>  
                                    <div class="d-flex justify-content-end mx-20">
                                        <div class="w-20 me-10">
                                           <span class="fw-bold">Total Amount : <span>Rp.0</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-6">
                                    <div class=" me-5">
                                        <a href="#" class="btn btn-light-info">Discard</a>
                                    </div>
                                    <div class="">
                                        <a href="#" class="btn btn-info">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    @role('administrator')
        @include('cmt-opportunity.boq.add.modal-tambah-boq')
        {{-- @include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv') --}}
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
        };

        function calculateTotalAmount() {
            // Mengambil nilai dari masing-masing input
            const purchasePrice = parseFloat(document.getElementsByName('purchase_price')[0].value);
            const quantity = parseInt(document.getElementsByName('quantity')[0].value);
            const purchaseDelivery = parseFloat(document.getElementsByName('purchase_delivery')[0].value);

            // Melakukan perhitungan total
            const totalAmount = purchasePrice * quantity + purchaseDelivery;

            // Menampilkan total dalam format dengan tanda titik setiap 3 digit dari kanan
            const formattedTotal = new Intl.NumberFormat().format(totalAmount);

            // Mengatur nilai total pada elemen dengan id 'total'
            document.getElementById('total').textContent = formattedTotal;
        }

        $(document).ready(function() {

            // Function Tambah BOQ
            $('body').on('click', '.btn_tambah_lead', function() {
                $('.drop-data').val("").trigger("change");
                $('#kt_modal_tambah_boq_form').trigger("reset");
                $('#kt_modal_tambah_boq_submit').removeAttr('disabled', 'disabled');
            });

            $("#kt_modal_tambah_boq_form").validate({
                messages: {
                    customer_name: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Nama Perusahaan/Badan Usaha wajib diisi</span>",
                    },
                    bussines_type_id: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Jenis bisnis wajib dipilih</span>",
                    },
                    lead_reference_id: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Referensi lead wajib dipilih</span>",
                    },
                    customer_address: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Alamat perusahaan/badan usaha wajib diisi</span>",
                    },
                    city_id: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Kota perusahaan/badan usaha wajib dipilih</span>",
                    },
                    customer_contact_name: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Nama wajib diisi</span>",
                    },
                    customer_contact_job: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Jabatan wajib diisi</span>",
                    },
                    customer_contact_email: {
                        email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                    },
                    customer_contact_phone: {
                        required: "<span class='fw-semibold fs-8 text-danger'>Nomor wajib diisi</span>",
                        minlength: "<span class='fw-semibold fs-8 text-danger'> Kontak minimal memiliki 9 karakter</span>",
                        maxlength: "<span class='fw-semibold fs-8 text-danger'> Kontak maksimal memiliki 13 karakter</span>",

                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    console.log(formData);
                    console.log(form)
                    $('#kt_modal_tambah_boq_submit').attr('disabled', 'disabled');
                    $('input[name="halohalo"]').val(formData.good_name);
                    $('input[name="halohalo"]').val(formData.good_name);
                    $('input[name="halohalo"]').val(formData.good_name);
                    $('input[name="halohalo"]').val(formData.good_name);
                    $('input[name="halohalo"]').val(formData.good_name);
                }
            });

            // Handler untuk peristiwa "change" pada select item
            $('#good_name').on('change', function() {
                var selectedItemId = $(this).val();
                var url = $(this).data('url');

                // Mengirim permintaan asinkron menggunakan AJAX untuk mendapatkan data jenis dan merek item
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        item_id: selectedItemId
                    }, // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
                    success: function(response) {
                        // Mengisi select jenis item dengan data yang diterima dari server
                        // var $goodTypeSelect = $('#good_type');
                        // $goodTypeSelect.val(response.good_type).prop('disabled', false);
                        // // Mengisi select merek item dengan data yang diterima dari server
                        // var $merkSelect = $('#merk');
                        // $merkSelect.empty();
                        // $merkSelect.append(
                        //     '<option value="" selected hidden disabled>Pilih Dulu</option>');
                        // $merkSelect.append('<option value="' + response.merk + '">' + response
                        //     .merk + '</option>');

                        $('#good_type').val(response.good_type).prop('disabled', true);
                        $('#merk').val(response.merk).prop('disabled', true);
                        $('#detail').val(response.description).prop('disabled', true);

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endsection
