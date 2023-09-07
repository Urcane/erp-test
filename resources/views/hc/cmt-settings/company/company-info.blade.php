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
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Company Info</span>
                                </div>
                                <div class="row p-6 m-1 rounded border border-2 border-secondary">
                                    <form action="{{route("hc.setting.company-info.update")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="company_id" value="{{$subBranch->branch_id ?? old('company_id')}}">
                                        <section class="row">
                                            <div class="col-12 mb-3 d-flex justify-content-center mt-5">
                                                <img src="{{$subBranch->logo ? asset("storage/branch-logo/" . $subBranch->logo) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFmDTZFCydgh_teJfzp3Gxq88OgTC_VYdUUg&usqp=CAU"}}" class="rounded-circle m-auto" style="width: 150px;" alt="Avatar" />
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5">
                                                <label class="align-items-center fs-6 form-label" for="logo">
                                                    <span class="fw-bold">Logo Perusahaan</span>
                                                </label>
                                            </div>
                                            <div class="col-12 mb-3 d-flex justify-content-center">
                                                <input type="file" style="width: 112px" class="form-control form-control-solid" placeholder="Logo Perusahaan" name="logo" id="logo" @cannot("HC:update-profile") disabled @endcannot>
                                            </div>

                                            {{-- company info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-9">
                                                    <h4>Company Info</h4>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="name">
                                                        <span class="fw-bold">Company Name</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->name ?? old('name')}}" class="form-control form-control-solid" placeholder="Nama Perusahaan" name="name" id="name" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="phone_number">
                                                        <span class="fw-bold">Company Phone Number</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->phone_number ?? old('phone_number')}}" class="form-control form-control-solid" placeholder="Nomor yang dapat dihubungi" name="phone_number" id="phone_number" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="email">
                                                        <span class="fw-bold">Email</span>
                                                    </label>
                                                    <input type="email" value="{{$subBranch->email ?? old('email')}}" class="form-control form-control-solid" placeholder="Email perusahaan" name="email" id="email" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="name">
                                                        <span class="fw-bold">Address</span>
                                                    </label>
                                                    <textarea name="address" class="form-control form-control-solid" placeholder="Alamat lengkap perusahaan" id="address" cols="30" rows="5" @cannot("HC:update-profile") disabled @endcannot>{{$subBranch->address ?? old("address")}}</textarea>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2" for="city">
                                                                <span class="fw-bold">City</span>
                                                            </label>
                                                            <input type="text" value="{{$subBranch->city ?? old('city')}}" class="form-control form-control-solid" placeholder="Kota" name="city" id="city" @cannot("HC:update-profile") disabled @endcannot>
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2" for="province">
                                                                <span class="fw-bold">Province</span>
                                                            </label>
                                                            <input type="text" value="{{$subBranch->province ?? old('province')}}" class="form-control form-control-solid" placeholder="Provinsi" name="province" id="province" @cannot("HC:update-profile") disabled @endcannot>
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="industry">
                                                        <span class="fw-bold">Industry</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->branch->industry ?? old('industry')}}" class="form-control form-control-solid" placeholder="Sektor industry perusahaan" name="industry" id="industry" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="company_size">
                                                        <span class="fw-bold">Company Size</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->branch->company_size ?? old('company_size')}}" class="form-control form-control-solid" placeholder="Jumlah karyawan" name="company_size" id="company_size" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </section>

                                            {{-- Tax Info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-9">
                                                    <h4>Tax Info</h4>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="npwp">
                                                        <span class="fw-bold">Company NPWP</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->npwp ?? old('npwp')}}" class="form-control form-control-solid" placeholder="Company NPWP" name="npwp" id="npwp" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="company_taxable_date">
                                                        <span class="fw-bold">Company Taxable Date</span>
                                                    </label>
                                                    <input type="date" value="{{$subBranch->branch->company_taxable_date ?? old('company_taxable_date')}}" class="form-control form-control-solid" name="company_taxable_date" id="company_taxable_date" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_person_name">
                                                        <span class="fw-bold">Tax Person</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->tax_person_name ?? old('tax_person_name')}}" class="form-control form-control-solid" placeholder="Tax Person" name="tax_person_name" id="tax_person_name" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_person_npwp">
                                                        <span class="fw-bold">Tax Person NPWP</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->tax_person_npwp ?? old('tax_person_npwp')}}" class="form-control form-control-solid" placeholder="Tax Person NPWP" name="tax_person_npwp" id="tax_person_npwp" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </section>

                                            {{-- Other Info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-9">
                                                    <h4>Other Info</h4>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="head_office_initial">
                                                        <span class="fw-bold">Head Office Initial</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->branch->head_office_initial ?? old('head_office_initial')}}" class="form-control form-control-solid" placeholder="Initial yang dimiliki perusahaan" name="head_office_initial" id="head_office_initial" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="umr">
                                                        <span class="fw-bold">UMR</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->umr ?? old('umr')}}" class="form-control form-control-solid" placeholder="UMR" name="umr" id="umr" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="bpjs_ketenagakerjaan">
                                                        <span class="fw-bold">BPJS Ketenagakerjaan</span>
                                                    </label>
                                                    <input type="number" value="{{$subBranch->branch->bpjs_ketenagakerjaan ?? old('bpjs_ketenagakerjaan')}}" class="form-control form-control-solid" placeholder="Nomor BPJS Ketenaga kerjaan" name="bpjs_ketenagakerjaan" id="bpjs_ketenagakerjaan" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_kecelakaan_kerja">
                                                        <span class="fw-bold">Jaminan Kecelakaan Kerja</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->branch->jaminan_kecelakaan_kerja ?? old('jaminan_kecelakaan_kerja')}}" class="form-control form-control-solid" placeholder="Jumlah jaminan kecelakaan" name="jaminan_kecelakaan_kerja" id="jaminan_kecelakaan_kerja" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="klu">
                                                        <span class="fw-bold">Kode KLU (Klasifikasi Lapangan Usaha)</span>
                                                    </label>
                                                    <input type="text" value="{{$subBranch->klu ?? old('klu')}}" class="form-control form-control-solid" placeholder="Klasifikasi Lapangan Usaha" name="klu" id="klu" @cannot("HC:update-profile") disabled @endcannot>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2" for="signature">
                                                        <span class="fw-bold">Signature</span>
                                                    </label>
                                                    <input type="file" value="{{$subBranch->signature ?? old('signature')}}" class="form-control form-control-solid" placeholder="Tanda tangan" name="signature" id="signature" @cannot("HC:update-profile") disabled @endcannot>
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
