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
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-12 gap-3 d-flex align-items-center">
                                <div class="d-flex align-items-center gap-2 mb-8 mb-md-0 w-100">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="fs-5 text-uppercase fw-bolder text-dark d-none d-md-block w-100 align-items-center text-center">Hasil Survey: <span>blablalba</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row col-lg-12 p-9 mb-4 border border-gray-300 rounded">
                                <div class="row col-lg-12">
                                    <div class="col-lg-2">
                                        <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                            <img class="mw-50px mw-lg-75px" src="{{asset('sense')}}/media/logos/logo-comtel.png" alt="image">
                                        </div>
                                    </div>
                                    <div class="row col-lg-10">
                                        <div class="col-lg-12 mb-5">
                                            <p class="text-dark fs-3 fw-bold mb-1">Company Name</p>
                                            <p class="text-gray-600 fs-5">Lorem Ipsum</p>
                                        </div>
                                        <div class="row col-lg-6">
                                            <div class="col-lg-12">
                                                <p class="text-dark">Company Contact</p>
                                                <p class="text-gray-600">Lorem Ipsum</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <p class="text-dark">Survey Datetime</p>
                                                <p class="text-gray-600">Lorem Ipsum</p>
                                            </div>
                                        </div>
                                        <div class="row col-lg-6">
                                            <div class="col-lg-12">
                                                <p class="text-dark">No. WO / No. Survey</p>
                                                <p class="text-gray-600">Lorem Ipsum</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <p class="text-dark">Task Description</p>
                                                <p class="text-gray-600">Lorem Ipsum</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-lg-12 p-9 mb-4 border border-gray-300 rounded">
                                <div class="col-lg-6">
                                    <div class="mb-10">
                                        <p class="text-uppercase fs-5 fw-bold text-dark">A. Informasi Lokasi</p>
                                        <div class="mx-8 fs-6">
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Nama Perusahaan</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Contact Person</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Jabatan</div>
                                                <div class="col-lg-6 text-gray-800">: Jabatan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">No. Telpon</div>
                                                <div class="col-lg-6 text-gray-800">: No. Telpon</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Lokasi/Wilayah</div>
                                                <div class="col-lg-6 text-gray-800">: Lokasi/Wilayah</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Titik Koordinat</div>
                                                <div class="col-lg-6 text-gray-800">: Titik Koordinat</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Jaringan Existing</div>
                                                <div class="col-lg-6 text-gray-800">: Jaringan Existing</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <p class="text-uppercase fs-5 fw-bold text-dark">B. Informasi Pengguna</p>
                                        <div class="mx-8 fs-6">
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Nama Perusahaan</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Contact Person</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Jabatan</div>
                                                <div class="col-lg-6 text-gray-800">: Jabatan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-10">
                                        <div class="mx-8 fs-6">
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Nama Perusahaan</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Contact Person</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Jabatan</div>
                                                <div class="col-lg-6 text-gray-800">: Jabatan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Nama Perusahaan</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Contact Person</div>
                                                <div class="col-lg-6 text-gray-800">: Nama Perusahaan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Jabatan</div>
                                                <div class="col-lg-6 text-gray-800">: Jabatan</div>
                                            </div>
                                            <div class="row my-6">
                                                <div class="col-lg-6 text-dark">Jabatan</div>
                                                <div class="col-lg-6 text-gray-800">: Jabatan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-lg-7 mb-4 border border-gray-300 rounded">
                                @include('cmt-promag.component.overview.summary-file')
                            </div>
                            <div class="row col-lg-5 mb-4 border border-gray-300 rounded">
                                @include('cmt-promag.component.overview.task-recent')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection