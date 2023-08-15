@extends('layouts.app')
@section('title-apps','Survey')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Survey, Survey, Survey Luar biasa!')
@section('icon-apps','fa-solid fa-briefcase')

@section('navbar')
@include('layouts.navbar.navbar')
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
                                                <input type="checkbox" class="form-check-input checkbox-real my-auto" placeholder="" name="site_survey_service_type[]" id="site_survey_service_type" value="{{$siteSurveyServiceType->id}}">
                                                <label class="fs-6 form-check-label mb-2" for="site_survey_service_type[]">
                                                    <span class="fw-bold">{{$siteSurveyServiceType->name}}</span>
                                                </label>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Lokal Akses : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="local_access" value="{{old('local_access')}}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Internet Bandwidth : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row mt-3 h-min-50px">
                                            @foreach ($internetBandwidths as $internetBandwidth)
                                            <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                <div class="my-auto">
                                                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="internet_bandwidth[]" id="internet_bandwidth" value="{{$internetBandwidth->id}}">
                                                    <label class="fs-6 form-check-label" for="internet_bandwidth[]">
                                                        <span class="fw-bold">{{$internetBandwidth->name}}</span>
                                                    </label>
                                                    {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="d-flex align-items-center fs-6 form-label h-100">
                                            <span class="fw-bold my-auto">Interface : </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row mt-3 h-min-50px">
                                            @foreach ($siteSurveyInterfaces as $siteSurveyInterface)
                                            <div class="col-lg-2 mb-3 d-flex align-items-center">
                                                <div class="my-auto">
                                                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="site_survey_interface[]" id="site_survey_interface" value="{{$siteSurveyInterface->id}}">
                                                    <label class="fs-6 form-check-label" for="site_survey_interface[]">
                                                        <span class="fw-bold">{{$siteSurveyInterface->name}}</span>
                                                    </label>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="separator mb-6"></div>
                                @include('cmt-opportunity.survey.component.outdoor-form')
                                <div class="separator mb-6"></div>
                                @include('cmt-opportunity.survey.component.indoor-form')
                                <div class="separator mb-6"></div>
                                @include('cmt-opportunity.survey.component.other-form')
                                <div class="position-fixed bottom-0 end-0 rounded-circle m-5">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="fa-solid fa-save fs-3"></i>
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

<script>
    
</script>
@endsection