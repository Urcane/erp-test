@extends('layouts.app')
@section('title-apps',''.$profile->name)
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
                                    @if ($profile->foto_file == null)
                                    <img alt="User" src="{{asset('sense')}}/media/avatars/blank.png" />
                                    @else
                                    <img alt="User" src="{{asset('sense')}}/media/foto_pegawai/{{$profile_foto_file}}" />
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <span class="fw-bolder align-items-center fs-2 d-block">{{$profile->name}}</span>
                                    <p class="text-gray-500 fs-8">{{$profile->nip}}</p>
                                    <span class="badge badge-light-warning px-3 py-2">{{$profile->divisi_name}}</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-6">
                                <div class="separator my-5"></div>
                                <table class="table g-1">
                                    <tr>
                                        <td class="w-25px"><i class="fa-solid fa-phone text-gray-500"></i></td>
                                        <td class=""><span>+62{{$profile->kontak}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="w-25px"><i class="fa-solid fa-envelope text-gray-500"></i></td>
                                        <td class=""><span>{{$profile->email}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="w-25px"><i class="fa-solid fa-map-pin text-gray-500"></i></td>
                                        <td class=""><span>{{$profile->team_name}}</span></td>
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
                            @if ($profile->nik != null)
                            <i class="fa-solid fa-check-circle fs-5 text-success"></i>
                            @else
                            <i class="fa-solid fa-times-circle fs-5 text-danger"></i>
                            @endif 
                        </div>
                        <div class="d-flex align-items-center mb-3">             
                            <span class="fs-8 flex-grow-1 fw-bold">Foto Profil</span> 
                            @if ($profile->foto_file != null)
                            <i class="fa-solid fa-check-circle fs-5 text-success"></i>
                            @else
                            <i class="fa-solid fa-times-circle fs-5 text-danger"></i>
                            @endif 
                        </div>
                        <div class="d-flex align-items-center">             
                            <span class="fs-8 flex-grow-1 fw-bold">Tanda Tangan Digital</span>
                            @if ($profile->sign_file !== null)
                            <i class="fa-solid fa-check-circle fs-5 text-success"></i>
                            @else
                            <i class="fa-solid fa-times-circle fs-5 text-danger"></i>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($profile->status != 1)
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
                        <form id="kt_profile_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$profile->id}}" name="user_id">
                            {{-- personal information --}}
                            <div class="row p-6">
                                <div class="col-lg-12 mb-9">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol rounded symbol-35px overflow-hidden me-5">
                                            <div class="symbol-label bg-light-info">
                                                <i class="fa-solid fa-id-badge text-info fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fs-4 fw-bold text-dark">Personal Information</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">Nama Lengkap</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" required value="{{$profile->name}}" name="name">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">NIP</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid" placeholder="" required maxlength="18" minlength="18" value="{{$profile->nip}}" name="nip" onkeyup="this.value = this.value.replace(/\D/g, '')">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold text-dark">NIK</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid" placeholder="" required maxlength="16" minlength="16" value="{{$profile->nik}}" name="nik" min="0" onkeyup="this.value = this.value.replace(/\D/g, '')">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">Telepon</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0" id="kontak">+62</span>
                                        <input type="number" class="form-control form-control-solid" required minlength="8" value="{{$profile->kontak}}" name="kontak"/>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">Divisi</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid" data-control="select2" required name="division_id" id="division_id">
                                        @foreach ($dataDivision as $dd)
                                        <option value="{{$dd->id}}" {{$dd->id == $profile->division_id  ? 'selected' : ''}}>{{$dd->divisi_name}}</option>									
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">Penempatan</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid" data-control="select2" required name="team_id" id="team_id">
                                        @foreach ($dataPlacement as $dp)
                                        <option value="{{$dp->id}}" {{$dp->id == $profile->team_id  ? 'selected' : ''}}>{{$dp->team_name}}</option>									
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
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
                                <div class="col-lg-8 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">Email</span>
                                    </label>
                                    <input type="email" class="form-control form-control-solid" placeholder="" value="{{$profile->email}}" required name="email">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold text-dark">Role</span>
                                    </label>
                                    @role('administrator')
                                    <select class="drop-data form-select form-select-solid" data-control="select2" required name="role_id">
                                        @foreach ($dataRole as $dr)
                                        <option value="{{$dr->name}}" {{$dr->id == $profile->role_id  ? 'selected' : ''}}>{{$dr->name}}</option>									
                                        @endforeach
                                    </select>
                                    @else
                                    <select class="drop-data form-select form-select-solid" data-control="select2" disabled>
                                        @foreach ($dataRole as $dr)
                                        <option value="{{$dr->name}}" {{$dr->id == $profile->role_id  ? 'selected' : ''}}>{{$dr->name}}</option>									
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="role_id" value="{{$profile->role_id}}">
                                    @endrole
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-lg-6 mb-3">
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
                                <div class="col-lg-12 mt-9 text-end">
                                    <button type="submit" id="kt_profile_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                                </div>
                            </div>
                        </form>
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
            rules: {
                nip : {
                    required: true,
                    minlength: 18,
                    maxlength: 18,
                },  
                kontak : {
                    required: true,
                    minlength: 9,
                    maxlength: 13,
                }
            },
            
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
                    maxlength: "<span class='fw-semibold fs-8 text-danger'>NIK maksimal memiliki 16 karakter</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>NIK minimal memiliki 16 karakter</span>",
                },
                nip: {
                    required: "<span class='fw-semibold fs-8 text-danger'>NIP pegawai wajib diisi</span>",
                    maxlength: "<span class='fw-semibold fs-8 text-danger'>NIK maksimal memiliki 18 karakter</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>NIK minimal memiliki 18 karakter</span>",
                },
                kontak: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Kontak pegawai wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'> Kontak minimal memiliki 9 karakter</span>",
                    maxlength: "<span class='fw-semibold fs-8 text-danger'> Kontak maksimal memiliki 13 karakter</span>",
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
