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
<meta name="csrf-token" content="{{ csrf_token() }}" />

@if(Auth::user()->id == $user->id && $user->is_new)
    <div class="modal fade" id="reset-pass" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="reset-pass-form" class="form fv-plugins-bootstrap5 fv-plugins-framework" autocomplete="off">
                        <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Reset Password</span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Masukan Password Baru</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        required name="password">
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center mt-md-n20">
            <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                <div class="card bgi-no-repeat mb-6" style="background-position: bottom 0 right 0; background-size: 125px; background-image:url('{{asset('sense')}}/media/svg/general/rhone.svg')">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center mt-10">
                                <div class="image-input image-input-outline" style="background-image: url('{{asset('sense')}}/media/avatars/blank.png')">
                                    <!--begin::Preview existing avatar-->
                                    @if ($user->foto_file != null)
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{asset('storage/personal/avatar/'.$user->foto_file)}}')"></div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{asset('sense')}}/media/avatars/blank.png')"></div>
                                    @endif
                                    <!--end::Preview existing avatar-->

                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                        <i class="fa-solid fa-pen fs-7"></i>
                                        <form id="avatar_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                            enctype="multipart/form-data">
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="avatar">
                                            <!--end::Inputs-->
                                        </form>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                        <i class="fa-solid fa-xmark fa-sm "></i>
                                    <!--end::Cancel-->
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
                                        <td class=""><span>{{$user->team->team_name ?? "-"}}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->id == $user->id && $user->is_new)
                    <div class="col-lg-12 mb-3">
                        <a href="#reset-pass" data-bs-toggle="modal" class="btn btn-warning w-100">
                            Silahkan Ganti Password Anda!
                        </a>
                    </div>
                @endif
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
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="payroll" href="#payroll_content">Payroll</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-danger rounded-bottom-0" data-bs-toggle="tab" id="time_management" href="#time_management_content">Time Management</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0" data-bs-toggle="tab" id="finance" href="#finance_content">Finance</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" id="files" href="#files_content">Files</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="assets" href="#assets_content">Assets</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="history" href="#history_content">History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    {{-- Personal --}}
                                    <div class="tab-pane fade show active" id="personal_content" role="tabpanel">
                                        @include('profile.part-profile.personal-part')
                                    </div>

                                    {{-- Employment Conten --}}
                                    <div class="tab-pane fade" id="employment_content" role="tabpanel">
                                        @include('profile.part-profile.employment-part')
                                    </div>

                                    {{-- Payroll Content --}}
                                    <div class="tab-pane fade" id="payroll_content" role="tabpanel">
                                        @include('profile.part-profile.payroll-part')
                                    </div>

                                    {{-- Time Management Content --}}
                                    <div class="tab-pane fade" id="time_management_content" role="tabpanel">
                                        @include('profile.part-profile.time-management-part.index')
                                    </div>

                                    {{-- Finance Content --}}
                                    <div class="tab-pane fade" id="finance_content" role="tabpanel">
                                        @include('profile.part-profile.finance')
                                    </div>

                                    {{-- Files Content --}}
                                    <div class="tab-pane fade" id="files_content" role="tabpanel">
                                        @include('profile.part-profile.file-part')
                                    </div>

                                    {{-- Assets Content --}}
                                    <div class="tab-pane fade" id="assets_content" role="tabpanel">
                                        @include('profile.part-profile.assets-part')
                                    </div>

                                    {{-- History Content --}}
                                    <div class="tab-pane fade" id="history_content" role="tabpanel">
                                        @include('profile.part-profile.history-part')
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
    $(document).ready(function () {
        @if(Auth::user()->id == $user->id && $user->is_new)
            $('#reset-pass-form').submit(function (e) {
                e.preventDefault();
                const data = $(this).serialize();
                $.ajax({
                    url: "{{ route('hc.emp.change-password') }}",
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        toastr.success(data.message, 'Selamat 🚀 !');
                        $('#reset-pass').modal('hide');
                        document.getElementById('logout-form').submit();
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });
        @endif

        $('#clear').click(function() {
            sig.signature('clear');
            $("#pegawai_sign_url").val('');
        });

        $('[name="use_as_residential"]').on('change', function () {
            $('[name="residential_address"]').val("");
            $('[name="residential_address"]').prop("disabled", $(this).is(':checked'));

            if ($(this).is(':checked')) {
                $('[name="residential_address"]').addClass("bg-secondary");
            } else {
                $('[name="residential_address"]').removeClass("bg-secondary");
            }
        })

        function formatNPWP(v) {
            if (!v) return v;

            v = v.replace(/\D/g, "");

            if (v.length <= 2) return v;

            if (v.length <= 5) return v.replace(/^(\d{0,2})(\d{0,3})/, "$1.$2");

            if (v.length <= 8) return v.replace(/^(\d{0,2})(\d{0,3})(\d{0,3})/, "$1.$2.$3");

            if (v.length <= 9) return v.replace(/^(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,1})/, "$1.$2.$3.$4");

            if (v.length <= 12) return v.replace(/^(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,1})(\d{0,3})/, "$1.$2.$3.$4-$5");

            return v.replace(/^(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,1})(\d{0,3})(\d{0,3})/, "$1.$2.$3.$4-$5-$6").slice(0, 20);
        }

        // Listen for input changes
        $("[name='npwp']").on('input', function() {
            let inputValue = $(this).val();
            let formattedValue = formatNPWP(inputValue);
            $(this).val(formattedValue);
        });

        $("[name='npwp']").trigger('input');
    });

    $("#avatar").change(function () {
        const avatar = new FormData($("#avatar_form")[0]);

        $.ajax({
            url: "{{ route('hc.emp.update.avatar') }}",
            type: 'POST',
            data: avatar,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                toastr.success(data.message, 'Selamat 🚀 !');

                // relode current page
                location.reload();
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    })
</script>


@endsection
