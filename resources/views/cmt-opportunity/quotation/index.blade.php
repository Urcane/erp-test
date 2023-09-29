@extends('layouts.app')
@section('title-apps','Quotation')
@section('sub-title-apps-2','Commercial')
@section('sub-title-apps','CMT-OPPOR')
@section('desc-apps','Quotation')
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
    <div class="col-lg-2 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body px-0">
                        @include('cmt-opportunity.quotation.component.sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10 mt-lg-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @yield('quotation-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection