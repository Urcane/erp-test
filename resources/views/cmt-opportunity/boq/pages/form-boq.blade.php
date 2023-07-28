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
    {{-- FORM BOQ  --}}
    {{-- @dd($dataForm) --}}
    
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
                                        <div class="d-flex justify-content-center mx-20 my-10">
                                            <div class="w-35">
                                                <label for="exampleFormControlInput1" class="required form-label">Company
                                                    Name</label>

                                                @if(request()->is('cmt-boq/form-boq'))
                                                    @foreach ($dataCompany as $data)
                                                                <p>{{ $data->customer->customer_name }}</p>
                                                    @endforeach
                                                @elseif(request()->is('cmt-boq/form-boq/*'))
                                                    <p>{{ $dataCompany->customer->customer_name }}</p>
                                                @endif
                                            </div>
                                            <div class="ms-10 w-25">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label required">Project</label>
                                                <div class="position-relative">
                                                    <div class=" position-absolute top-0"></div>
                                                    @foreach ($salesEmployees as $sales)
                                                    <p>{{ $sales->name }}</p>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- <div class="ms-10 w-25">
                                            <label for="exampleFormControlInput1" class="form-label required">No Project</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div> --}}

                                            <div class="ms-10 w-25">
                                                <label for="exampleFormControlInput1" class="form-label required">Due
                                                    Date</label>
                                                <div class="position-relative">
                                                    <div class=" position-absolute top-0"></div>
                                                    <input type="date" class="form-control form-control-solid"
                                                        placeholder="Example input" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-6 hover-scroll-x border-dashed border-gray-100">
                                        <div class="MultipleInput">

                                            <div class="d-flex justify-content-center mx-20 mb-5 mt-10 DuplicateRow">
                                                <div class="w-20">
                                                    <label for="exampleFormControlInput1" class=" form-label">Item</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        placeholder="Example input" />
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="exampleFormControlInput1" class=" form-label">Merk</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Example input" />
                                                    </div>
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="exampleFormControlInput1" class=" form-label">Price</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Example input" />
                                                    </div>
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="exampleFormControlInput1" class=" form-label">Qty</label>
                                                    <div class="position-relative">
                                                        <div class=" position-absolute top-0"></div>
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Example input" />
                                                    </div>
                                                </div>

                                                <div class="ms-10 w-20">
                                                    <label for="exampleFormControlInput1" class=" form-label">Total
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
                                            <label for="exampleFormControlInput1" class="required form-label">Company Name</label>
                                            <input type="email" class="form-control form-control-solid" placeholder="Example input"/>
                                        </div>
                                        
                                        <div class="ms-10 w-25">
                                            <label for="exampleFormControlInput1" class="form-label required">Project</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-25">
                                            <label for="exampleFormControlInput1" class="form-label required">No Project</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-25">
                                            <label for="exampleFormControlInput1" class="form-label required">Project</label>
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
                                                <label for="exampleFormControlInput1" class="required form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                        
                                        <div class="ms-10 w-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Site</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="exampleFormControlInput1" class="form-label required">Layanan</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="exampleFormControlInput1" class="form-label required">Newlink</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="exampleFormControlInput1" class="form-label required">Vendor</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-10">
                                            <label for="exampleFormControlInput1" class="form-label required">Total Monthly</label>
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
                                            <label for="exampleFormControlInput1" class="required form-label">Nama Barang</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                        </div>
                                        
                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Site</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Layanan</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Qty</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Material dan Acc</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Total</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mx-20">
                                        <div class="w-15">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama Barang</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                        </div>
                                        
                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Site</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Layanan</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Qty</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Material dan Acc</label>
                                            <div class="position-relative">
                                                <div class=" position-absolute top-0"></div>
                                                <input type="text" class="form-control form-control-solid" placeholder="Example input"/>
                                            </div>
                                        </div>

                                        <div class="ms-10 w-15">
                                            <label for="exampleFormControlInput1" class="form-label required">Total</label>
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
        $(document).ready(function() {

            // var items = 1;
            // $(".additembtn").click(function() {
            //     items++; // Increment the variable without "var"
            //     $(".MultipleInput .DuplicateRow:last-child").clone().appendTo(".MultipleInput");
            // });

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
                    $('#kt_modal_tambah_boq_submit').attr('disabled', 'disabled');
                    $.ajax({
                        data: formData,
                        processData: false,
                        contentType: false,
                        // bikin routenya ntar
                        url: '{{ route('com.lead.store-lead') }}',
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#kt_modal_tambah_boq_cancel').click();
                            // cek nama tabel db nya
                            var oTable = $('#kt_table_lead').dataTable();
                            oTable.fnDraw(false);
                            toastr.success(data.status, 'Selamat 🚀 !');
                        },
                        error: function(xhr, status, errorThrown) {
                            $('#kt_modal_tambah_boq_submit').removeAttr('disabled',
                                'disabled');
                            const data = JSON.parse(xhr.responseText);
                            toastr.error(errorThrown, 'Opps!');
                        }
                    });
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
                
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


        });
    </script>

@endsection