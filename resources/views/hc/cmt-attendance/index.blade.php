@extends('layouts.app')
@section('title-apps','CMT-Attendance')
@section('sub-title-apps','HC & Legal')
@section('desc-apps','Catatan Daftar Hadir Karyawan')
@section('icon-apps','fa-solid fa-calendar-days')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Attendance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
