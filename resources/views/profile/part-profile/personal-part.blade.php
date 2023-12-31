<div class="row p-6 m-1 rounded border border-2 border-secondary">
    <div class="mb-6 hover-scroll-x">
        <div class="d-grid">
            <ul class="nav nav-tabs flex-nowrap text-nowrap">
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active"
                        data-bs-toggle="tab" id="basic_info" href="#basic_info_content">Basic Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                        data-bs-toggle="tab" id="additional_information" href="#identity_address">Identity & Address</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                        data-bs-toggle="tab" id="family" href="#family_content">Family</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                        data-bs-toggle="tab" id="emergency_contact" href="#emergency_contact_content">Emergency
                        Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                        data-bs-toggle="tab" id="education_experience" href="#education_experience_content">Education
                        Experience</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content mt-5" id="myTabContent">
        <div class="tab-pane fade show active" id="basic_info_content" role="tabpanel">
            <div class="row p-4">
                <div class="row">
                    @can('HC:update-profile')
                        {{-- Personal data --}}
                        <form id="kt_personal_data_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $user->id ?? '' }}" name="user_id">
                        @endcan
                        @include('hc.cmt-employee.part-form.form-personal-data')
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
                                            <button id="clear" type="button"
                                                class="btn btn-sm btn-icon btn-danger"><i
                                                    class="fa-solid fa-eraser"></i></button>
                                        </div>
                                        <div class="col-lg-12 mt-6">
                                            <div
                                                class="notice align-items-center d-flex bg-light-primary rounded border-primary border border-dashed p-6">
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
                            <select name="role_id" class="drop-data form-select form-select-solid"
                                data-control="select2" @cannot('HC:update-profile') disabled @endcannot>
                                @if (!$user->getRoleNames()->first())
                                    <option value="" selected hidden disabled>Select Role</option>
                                @endif
                                @foreach ($dataRole as $dr)
                                    <option value="{{ $dr->id }}"
                                        {{ $dr->name == $user->getRoleNames()->first() ? 'selected' : '' }}>
                                        {{ $dr->name }}</option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        @can('HC:update-profile')
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold text-dark">Password</span>
                            </label>
                        </div>
                        @if($user->is_new)
                            <div class="col-lg-12 mt-3">
                                <button type="button" class="btn btn-sm btn-warning" disabled>
                                    Password sudah direset
                                </button>
                            </div>
                        @else
                            <div class="col-lg-12 mt-3">
                                <button id="btn_reset_pass" type="button" class="btn btn-sm btn-warning">
                                    Reset User Password
                                </button>
                            </div>
                        @endif
                        @endcan
                        @can('HC:update-profile')
                            <div class="col-lg-12 mt-9 text-end">
                                <button type="submit" id="kt_personal_data_submit"
                                    class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                            </div>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="identity_address" role="tabpanel">
            <div class="row p-4">
                @can('HC:update-profile')
                    <form id="kt_identity_address_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                    @endcan
                    @include('hc.cmt-employee.part-form.form-identity-address')

                    @can('HC:update-profile')
                        <div class="col-lg-12 mt-9 text-end">
                            <button type="submit" id="kt_identity_address_submit"
                                class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                        </div>
                    </form>

                    <script>
                        $('#kt_identity_address_form').submit(function(event) {
                            event.preventDefault();
                            var formData = $(this).serialize();
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ route('hc.emp.update.identity') }}",
                                type: 'POST',
                                data: formData,
                                success: function(data) {
                                    toastr.success(data.message, 'Selamat 🚀 !');
                                },
                                error: function(xhr, status, error) {
                                    const data = xhr.responseJSON;
                                    toastr.error(data.message, 'Opps!');
                                }
                            });
                        });
                    </script>
                @endcan
                {{-- Content --}}
            </div>
        </div>

        <div class="tab-pane fade" id="family_content" role="tabpanel">
            <div class="row p-4">
                @include('profile.part-profile.part-personal.family-part')
            </div>
        </div>
        <div class="tab-pane fade" id="emergency_contact_content" role="tabpanel">
            <div class="row p-4">
                @include('profile.part-profile.part-personal.emergency-contact-part')
            </div>
        </div>
        <div class="tab-pane fade" id="education_experience_content" role="tabpanel">
            <div class="row p-4">
                <div class="modal fade" id="img_certificate_modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header pb-0 border-0 justify-content-end">
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                            <div class="modal-body mx-5 mx-lg-15 mb-7">
                                <img src="" alt="" id="img_certificate">
                                <div class="text-center mt-9">
                                    <button type="reset" id="img_certificate_cancel"
                                        class="btn btn-sm btn-light me-3 w-lg-200px"
                                        data-bs-dismiss="modal">Back</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @include('profile.part-profile.part-personal.formal-education')
                @include('profile.part-profile.part-personal.non-formal-education')
                @include('profile.part-profile.part-personal.working-experience')
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#btn_reset_pass').on('click', function() {
            $.ajax({
                url: "{{ route('hc.emp.reset-user-pass') }}",
                type: 'POST',
                data: {
                    id: "{{ $user->id }}"
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $("#kt_personal_data_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama lengkap pegawai wajib diisi</span>",
                },
                email: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Email user wajib diisi</span>",
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
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
                $('#kt_personal_data_submit').attr('disabled', 'disabled');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '{{ route('hc.emp.update.personal') }}',
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        toastr.success(data.status, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, errorThrown) {
                        $('#kt_personal_data_submit').removeAttr('disabled',
                            'disabled');
                        const data = JSON.parse(xhr.responseText);
                        toastr.error(errorThrown, 'Opps!');
                    }
                });
            }
        });
    });
</script>
