@extends('layouts.app')
@section('title-apps','Settings')
@section('sub-title-apps','Company Info')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center mt-md-n20">
            <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                @include("hc.cmt-settings.sidebar")
            </div>
            <div class="col-lg-9 mt-md-n14">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mt-5 mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Branch</span>
                                </div>
                                <div class="row p-6 m-1 rounded border border-2 border-secondary">
                                    <form action="">
                                        <section class="row">
                                            <div class="col-12 mb-3 d-flex justify-content-center mt-5">
                                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle m-auto" style="width: 150px;" alt="Avatar" />
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5">
                                                <label class="align-items-center fs-6 form-label" for="logo">
                                                    <span class="fw-bold">Logo Perusahaan</span>
                                                </label>
                                            </div>
                                            <div class="col-12 mb-3 d-flex justify-content-center">
                                                <input type="file" style="width: 112px" class="form-control form-control-solid" placeholder="Logo Perusahaan" name="logo" id="logo" @unlessrole("administrator") disabled @endunlessrole>
                                            </div>

                                            <div class="col-lg-6 mb-3 mt-5">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="name">
                                                    <span class="fw-bold">Branch Name</span>
                                                </label>
                                                <input type="text" value="{{$subBranch->name ?? old('name')}}" class="form-control form-control-solid" placeholder="Nama Perusahaan" name="name" id="name" @unlessrole("administrator") disabled @endunlessrole>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3 mt-5">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="phone_number">
                                                    <span class="fw-bold">Branch Phone Number</span>
                                                </label>
                                                <input type="number" value="{{$subBranch->number ?? old('phone_number')}}" class="form-control form-control-solid" placeholder="Nomor yang dapat dihubungi" name="phone_number" id="phone_number" @unlessrole("administrator") disabled @endunlessrole>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="email">
                                                    <span class="fw-bold">Email</span>
                                                </label>
                                                <input type="email" value="{{$subBranch->email ?? old('email')}}" class="form-control form-control-solid" placeholder="Email cabang" name="email" id="email" @unlessrole("administrator") disabled @endunlessrole>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="umr">
                                                    <span class="fw-bold">UMR</span>
                                                </label>
                                                <input type="number" value="{{$subBranch->umr ?? old('umr')}}" class="form-control form-control-solid" placeholder="UMR" name="umr" id="umr" @unlessrole("administrator") disabled @endunlessrole>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="name">
                                                    <span class="fw-bold">Address</span>
                                                </label>
                                                <textarea name="address" class="form-control form-control-solid" placeholder="Alamat lengkap perusahaan" id="address" cols="30" rows="5" @unlessrole("administrator") disabled @endunlessrole>{{$subBranchh->address ?? old("address")}}</textarea>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="city">
                                                            <span class="fw-bold">City</span>
                                                        </label>
                                                        <input type="text" value="{{$subBranch->name ?? old('city')}}" class="form-control form-control-solid" placeholder="Kota" name="city" id="city" @unlessrole("administrator") disabled @endunlessrole>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="province">
                                                            <span class="fw-bold">Province</span>
                                                        </label>
                                                        <input type="text" value="{{$subBranch->name ?? old('province')}}" class="form-control form-control-solid" placeholder="Provinsi" name="province" id="province" @unlessrole("administrator") disabled @endunlessrole>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="parent_id">
                                                    <span class="fw-bold">Branch Parent</span>
                                                </label>
                                                <select class="drop-data form-select form-select-solid" data-control="parent_id" name="parent_id" id="parent_id" @unlessrole("administrator") disabled @endunlessrole>
                                                    @foreach ($dataParent as $option)
                                                        <option value="{{$option->id}}" @if ($subBranch->parent_id ?? old('parent_id') == $option->id) selected @endif>{{$option->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            {{-- npwp Info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-9">
                                                    <div class="col-lg-12 mb-3">
                                                        <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="npwp_same_parent" id="npwp_same_parent">
                                                        <label class="fs-6 form-check-label mb-2" for="npwp_same_parent">
                                                            <span class="fw-bold">NPWP same with Parent Branch</span>
                                                        </label>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="npwp">
                                                        <span class="fw-bold">Branch NPWP</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->npwp ?? old('npwp')}}" class="form-control form-control-solid" placeholder="Company NPWP" name="npwp" id="npwp" @unlessrole("administrator") disabled @endunlessrole>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_name">
                                                        <span class="fw-bold">Branch Tax Name</span>
                                                    </label>
                                                    <input type="date" value="{{$subBranch->tax_name ?? old('tax_name')}}" class="form-control form-control-solid" name="tax_name" id="tax_name" @unlessrole("administrator") disabled @endunlessrole>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_person_name">
                                                        <span class="fw-bold">Tax Person</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->tax_person_name ?? old('tax_person_name')}}" class="form-control form-control-solid" placeholder="Nama Perusahaan" name="tax_person_name" id="tax_person_name" @unlessrole("administrator") disabled @endunlessrole>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_person_npwp">
                                                        <span class="fw-bold">Tax Person NPWP</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->tax_person_npwp ?? old('tax_person_npwp')}}" class="form-control form-control-solid" placeholder="Nomor rekening" name="tax_person_npwp" id="tax_person_npwp" @unlessrole("administrator") disabled @endunlessrole>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </section>

                                            {{-- Other Info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="klu">
                                                        <span class="fw-bold">Kode KLU (Klasifikasi Lapangan Usaha)</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->klu ?? old('klu')}}" class="form-control form-control-solid" placeholder="Nomor rekening" name="klu" id="klu" @unlessrole("administrator") disabled @endunlessrole>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="signature">
                                                        <span class="fw-bold">Signature</span>
                                                    </label>
                                                    <input type="file" value="{{$subBranch->signature ?? old('signature')}}" class="form-control form-control-solid" placeholder="Nama Perusahaan" name="signature" id="signature" @unlessrole("administrator") disabled @endunlessrole>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    ini priview
                                                </div>
                                            </section>

                                            <div class="mt-6 d-flex justify-content-center">
                                                <div class="me-2">
                                                    <button type="button" class="btn btn-sm btn-light me-3 w-lg-200px" data-kt-stepper-action="previous">
                                                        Cancel
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="submit" id="kt_modal_create_survey_result_internet_submit" class="btn btn-sm btn-info w-lg-200px" data-kt-stepper-action="submit">
                                                        <span class="indicator-label">Simpan</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </section>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
