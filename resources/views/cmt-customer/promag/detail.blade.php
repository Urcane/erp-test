@extends('layouts.app')
@section('title-apps','CMT-PROMAG')
@section('sub-title-apps','Commercial')
@section('desc-apps','Pusing Kerja?, PROMAG solusi nya!')
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
                        <div
                            class="app-main flex-column flex-row-fluid"
                            id="kt_app_main"
                        >
                            <div class="d-flex flex-column flex-column-fluid">
                                <div id="kt_app_content" class="app-content">
                                    <div class="card mb-6 mb-xl-9">
                                        <div class="card-body pt-9 pb-0">
                                            @include('cmt-customer.promag.component.header')
                                            <div class="separator"></div>
                                            @include('cmt-customer.promag.component.navigator-tabs')
                                        </div>
                                    </div>
                                    <div id="promag-detail-containe">
                                        @yield('promag-detail-content')
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
    $(document ).ready(function() {
    })    
</script>
@endsection
                