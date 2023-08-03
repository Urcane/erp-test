@extends('layouts.app')
@section('title-apps',''.$user->name)
@section('sub-title-apps','Profile')

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
                <div class="card bgi-no-repeat mb-6" style="background-position: bottom 0 right 0; background-size: 125px; background-image:url('{{asset('sense')}}/media/svg/general/rhone.svg')">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center">
                                <div class="symbol symbol-circle symbol-125px mt-6">
                                    @if ($user->foto_file == null)
                                    <img alt="User" src="{{asset('sense')}}/media/avatars/blank.png" />
                                    @else
                                    <img alt="User" src="{{asset('sense')}}/media/foto_pegawai/{{$user_foto_file}}" />
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <span class="fw-bolder align-items-center fs-2 d-block">{{$user->name}}</span>
                                    <p class="text-gray-500 fs-8">{{$user->nip}}</p>
                                    <span class="badge badge-light-warning px-3 py-2">{{$user->divisi_name}}</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-6">
                                <div class="separator my-5"></div>
                                <table class="table g-1">
                                    <tr>
                                        <td class="w-25px"><i class="fa-solid fa-phone text-gray-500"></i></td>
                                        <td class=""><span>+62 {{$user->kontak ?? "-"}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="w-25px"><i class="fa-solid fa-envelope text-gray-500"></i></td>
                                        <td class=""><span>{{$user->email}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="w-25px"><i class="fa-solid fa-map-pin text-gray-500"></i></td>
                                        <td class=""><span>{{$user->team->team_name}}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="fs-8 flex-grow-1 fw-bold">NIK</span>
                            @if ($user->userIdentity != null)
                            <i class="fa-solid fa-check-circle fs-5 text-success"></i>
                            @else
                            <i class="fa-solid fa-times-circle fs-5 text-danger"></i>
                            @endif
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="fs-8 flex-grow-1 fw-bold">Foto Profil</span>
                            @if ($user->foto_file != null)
                            <i class="fa-solid fa-check-circle fs-5 text-success"></i>
                            @else
                            <i class="fa-solid fa-times-circle fs-5 text-danger"></i>
                            @endif
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="fs-8 flex-grow-1 fw-bold">Tanda Tangan Digital</span>
                            @if ($user->sign_file !== null)
                            <i class="fa-solid fa-check-circle fs-5 text-success"></i>
                            @else
                            <i class="fa-solid fa-times-circle fs-5 text-danger"></i>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($user->status != 1)
                <div class="notice align-items-center d-flex bg-light-danger rounded border-danger border border-dashed p-6 mt-6">
                    <i class="fa-solid fa-user-xmark fs-1 me-4 text-danger"></i>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fs-7">
                            <h5 class="text-dark fw-bold mb-0">Pegawai Tidak Aktif</h5>
                            <div class="text-dark">
                                Akun tidak aktif. Hubungi Admin untuk mengaktifkan kembali.
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-9 mt-md-n14">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-6 hover-scroll-x">
                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="personal" href="#personal_content">Personal</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="employment" href="#employment_content">Employment</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="payroll" href="#payroll_content">Payroll</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="time_management" href="#time_management_content">Time Management</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="finance" href="#finance_content">Finance</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="files" href="#files_content">Files</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="assets" href="#assets_content">Assets</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="history" href="#history_content">History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    {{-- Personal --}}
                                    <div class="tab-pane fade show active" id="personal_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">
                                            <div class="d-grid">
                                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="basic_info" href="#basic_info_content">Basic Info</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="additional_information" href="#identity_address">Identity & Address</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="family" href="#family_content">Family</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="emergency_contact" href="#emergency_contact_content">Emergency Contact</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="education_experience" href="#education_experience_content">Education Experience</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content mt-5" id="myTabContent">
                                                <div class="tab-pane fade show active" id="basic_info_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        <div class="row">
                                                            @role("administrator")
                                                            {{-- Personal data --}}
                                                            <form id="kt_personal_data_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                                @csrf
                                                                @endrole
                                                                @include("hc.cmt-employee.part-form.form-personal-data")
                                                                <div class="col-lg-12 mb-3">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                                <span class="fw-bold text-dark">Tanda Tangan</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div id="sig" class="border border-gray-500"></div>
                                                                            <textarea id="pegawai_sign_url" name="pegawai_sign_url" style="display: none"></textarea>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <button id="clear" type="button" class="btn btn-sm btn-icon btn-danger"><i class="fa-solid fa-eraser"></i></button>
                                                                                </div>
                                                                                <div class="col-lg-12 mt-6">
                                                                                    <div class="notice align-items-center d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                                                                        <i class="fa-solid fa-exclamation-circle fs-1 me-4 text-primary"></i>
                                                                                        <div class="d-flex flex-stack flex-grow-1">
                                                                                            <div class="fs-7">
                                                                                                <h5 class="text-dark fw-bold mb-0">Perhatian</h5>
                                                                                                <div class="text-dark">
                                                                                                    Kosongkan tanda tangan jika tidak ingin diubah.
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 mb-3">
                                                                    <div class="separator my-3"></div>
                                                                </div>
                                                                <div class="col-lg-12 mb-9">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="symbol rounded symbol-35px overflow-hidden me-5">
                                                                            <div class="symbol-label bg-light-info">
                                                                                <i class="fa-solid fa-unlock text-info fs-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <span class="fs-4 fw-bold text-dark">Account Information</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 mb-3">
                                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                        <span class="required fw-bold text-dark">Role</span>
                                                                    </label>
                                                                    @role('administrator')
                                                                    <select class="drop-data form-select form-select-solid" data-control="select2" required name="role_id">
                                                                        @foreach ($dataRole as $dr)
                                                                        <option value="{{$dr->name}}" {{$dr->id == $user->role_id  ? 'selected' : ''}}>{{$dr->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @else
                                                                    <select class="drop-data form-select form-select-solid" data-control="select2" disabled>
                                                                        @foreach ($dataRole as $dr)
                                                                        <option value="{{$dr->name}}" {{$dr->id == $user->role_id  ? 'selected' : ''}}>{{$dr->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="hidden" name="role_id" value="{{$user->role_id}}">
                                                                    @endrole
                                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                                </div>
                                                                <div class="col-lg-12 mb-3">
                                                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                        <span class="fw-bold text-dark">Password Baru</span>
                                                                    </label>
                                                                    <input type="password" class="form-control form-control-solid" placeholder="" confirmed minlength="8" name="new_password">
                                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                                </div>
                                                                <div class="col-lg-12 mt-3">
                                                                    <div class="notice align-items-center d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                                                        <i class="fa-solid fa-exclamation-circle fs-1 me-4 text-primary"></i>
                                                                        <div class="d-flex flex-stack flex-grow-1">
                                                                            <div class="fs-7">
                                                                                <h5 class="text-dark fw-bold mb-0">Perhatian</h5>
                                                                                <div class="text-dark">
                                                                                    Password minimal memiliki <b>8</b> karakter. Kosongkan password jika tidak ingin diubah.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @role("administrator")
                                                                <div class="col-lg-12 mt-9 text-end">
                                                                    <button type="submit" id="kt_personal_data_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                                </div>
                                                            </form>
                                                            @endrole
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="family_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        family_content
                                                        {{-- Content --}}
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="emergency_contact_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        emergency_contact_content
                                                        {{-- Content --}}
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="education_experience_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        education_experience_content
                                                        {{-- Content --}}
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="identity_address" role="tabpanel">
                                                    <div class="row p-4">
                                                        @role("administrator")
                                                        <form id="kt_identity_address_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                            @csrf
                                                            @endrole
                                                            @include("hc.cmt-employee.part-form.form-identity-address")

                                                            @role("administrator")
                                                            <div class="col-lg-12 mt-9 text-end">
                                                                <button type="submit" id="kt_identity_address_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                            </div>
                                                        </form>
                                                        @endrole
                                                        {{-- Content --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Employment Conten --}}
                                    <div class="tab-pane fade" id="employment_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">
                                            @role("administrator")
                                            <form id="kt_employment_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                @csrf
                                                @endrole
                                                @include("hc.cmt-employee.part-form.form-employment-data")
                                                @role("administrator")
                                                <div class="col-lg-12 mt-9 text-end">
                                                    <button type="submit" id="kt_employment_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                </div>
                                            </form>
                                            @endrole
                                            {{-- Content --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="payroll_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">
                                            <div class="d-grid">
                                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="salary" href="#salary_content">Salary</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="bank_account" href="#bank_account_content">Bank Account</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="tax_configuration" href="#tax_configuration_content">Tax Configuration</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="bpjs_configuration" href="#bpjs_configuration_content">BPJS Configuration</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content mt-5" id="myTabContent">
                                                <div class="tab-pane fade show active" id="salary_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        <div class="row">
                                                            {{-- salary --}}
                                                            @role("administrator")
                                                            <form id="kt_salary_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                                @csrf
                                                                @endrole
                                                                @include("hc.cmt-employee.part-form.form-salary")
                                                                @role("administrator")
                                                                <div class="col-lg-12 mt-9 text-end">
                                                                    <button type="submit" id="kt_salary_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                                </div>
                                                            </form>
                                                            @endrole
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tax_configuration_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        @role("administrator")
                                                        <form id="kt_tax_configuration_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                            @csrf
                                                            @endrole
                                                            @include("hc.cmt-employee.part-form.form-tax-configuration")
                                                            @role("administrator")
                                                            <div class="col-lg-12 mt-9 text-end">
                                                                <button type="submit" id="kt_tax_configuration_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                            </div>
                                                        </form>
                                                        @endrole
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="bpjs_configuration_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        @role("administrator")
                                                        <form id="kt_bpjs_configuration_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                            @csrf
                                                            @endrole
                                                            @include("hc.cmt-employee.part-form.form-bpjs-configuration")
                                                            @role("administrator")
                                                            <div class="col-lg-12 mt-9 text-end">
                                                                <button type="submit" id="kt_bpjs_configuration_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                            </div>
                                                        </form>
                                                        @endrole
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="bank_account_content" role="tabpanel">
                                                    <div class="row p-4">
                                                        @role("administrator")
                                                        <form id="kt_bank_account_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                                            @csrf
                                                            @endrole
                                                            @include("hc.cmt-employee.part-form.form-bank-account")
                                                            @role("administrator")
                                                            <div class="col-lg-12 mt-9 text-end">
                                                                <button type="submit" id="kt_bank_account_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                                            </div>
                                                        </form>
                                                        @endrole
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="time_management_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">

                                            time_management_content
                                            {{-- Content --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="finance_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">

                                            finance_content
                                            {{-- Content --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="files_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">

                                            files_content
                                            {{-- Content --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="assets_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">

                                            assets_content
                                            {{-- Content --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="history_content" role="tabpanel">
                                        <div class="row p-6 m-1 rounded border border-2 border-secondary">

                                            history_content
                                            {{-- Content --}}
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
    var sig = $('#sig').signature({syncField: '#pegawai_sign_url', syncFormat: 'PNG'});
    $('#clear').click(function() {
        sig.signature('clear');
        $("#pegawai_sign_url").val('');
    });
</script>

<script>
    $(document ).ready(function() {
        $("#kt_profile_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama lengkap pegawai wajib diisi</span>",
                },
                email: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Email user wajib diisi</span>",
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                },
                nik: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIK pegawai wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>NIK minimal memiliki 16 karakter</span>",
                },
                nip: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIP pegawai wajib diisi</span>",
                },
                kontak: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Kontak pegawai wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Kontak tidak sesuai format</span>",
                },
                role_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Role wajib dipilih</span>",
                },
                division_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Divisi wajib dipilih</span>",
                },
                team_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Penempatan wajib dipilih</span>",
                },
                new_password: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Password minimal memiliki 8 karakter</span>",
                    confirmed: "<span class='fw-semibold fs-8 text-danger'>Password tidak sama</span>",
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#kt_profile_submit').attr('disabled', 'disabled');
                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '{{route("hc.emp.update")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        toastr.success(data.status,'Selamat 🚀 !');
                        location.reload();
                    },
                    error: function (xhr, status, errorThrown) {
                        $('#kt_profile_submit').removeAttr('disabled','disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown ,'Opps!');
                    }
                });
            }
        });
    });
</script>

@endsection
