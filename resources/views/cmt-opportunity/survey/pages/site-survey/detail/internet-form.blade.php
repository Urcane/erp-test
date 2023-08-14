@extends('layouts.app')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Survey, Survey, Survey Luar biasa!')
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
                    <div class="card-header">
                        <h3 class="card-title">🌟⭐✨</h3>
                        <div class="card-toolbar p-3">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-12 gap-3 d-flex align-items-center">
                                <div class="d-flex align-items-center gap-2 mb-8 mb-md-0 w-100">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="fs-5 text-uppercase fw-bolder text-dark d-none d-md-block w-100 align-items-center text-center">Form Survey : <span>{{ $surveyRequest->no_survey }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6 px-12">
                            <div class="col-lg-12">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Nama Perusahaan : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" disabled="disabled" class="form-control form-control-solid" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customer_name}}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Alamat : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" disabled="disabled" class="form-control form-control-solid" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customer_address}}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Kontak Person : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" disabled="disabled" class="form-control form-control-solid" placeholder="" name="customer_name" value="{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_name}}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Kontak Point : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-text border-0" id="kontak">+62</span>
                                            <input type="number" disabled="disabled" class="form-control form-control-solid" required minlength="8" name="kontak" value="{{$surveyRequest->customerProspect->customer->customerContact->customer_contact_phone}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Jenis Layanan : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row mt-3">
                                            @foreach ($siteSurveyServiceTypes as $siteSurveyServiceType)
                                            <div class="col-lg-2 mb-3">
                                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="site_survey_service_type[]" id="site_survey_service_type" value="{{$siteSurveyServiceType->id}}">
                                                <label class="fs-6 form-check-label mb-2" for="site_survey_service_type[]">
                                                    <span class="fw-bold">{{$siteSurveyServiceType->name}}</span>
                                                </label>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            @endforeach
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

<script>
    
</script>
@endsection