@extends('layouts.app')
@section('title-apps','BOQ')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Bill Of Quantity')
@section('icon-apps','fa-solid fa-briefcase')

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
</div>

@role('administrator')
{{-- @include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv') --}}
@endrole


@endsection

<script >
  
  </script>