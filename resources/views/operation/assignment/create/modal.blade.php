<div class="modal fade" id="add_assigned_people_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <div class="scroll-y me-n6 pe-6" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Add People</span>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 mb-2">
                                <span class="fw-bold textd-dark">Category</span>
                            </label>
                            <select class="form-select form-select-solid" required id="people-category">
                                <option value="cmt">CMT People</option>
                                <option value="non-cmt">Non-CMT People</option>
                            </select>
                        </div>

                        <div class="col-lg-12 mb-3" id="cmt-employee">
                            <label class="d-flex align-items-center fs-6 mb-2 required">
                                <span class="fw-bold textd-dark">Select Employee</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" required
                                id="cmt-people">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                        data-nik="{{ $user->userEmployment->employee_id }}"
                                        data-position="{{ $user->division->divisi_name }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-12 mb-3" id="people-name-sec">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Name</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nama" required
                                id="people_name">
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">NIK</span>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="1234567890"
                                required id="people_nik">
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Position</span>
                            </label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Software Engineer" required id="people_position">
                        </div>

                    </div>
                </div>
                <div class="text-center mt-9">
                    <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="people_submit" class="btn btn-sm btn-info w-lg-200px" data-bs-dismiss="modal">
                        <span class="indicator-label">Tambah</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#people-category').on('change', function() {
            const selectedOption = $(this).find(':selected');
            const category = selectedOption.val();

            if (category === 'cmt') {
                $('#cmt-employee').show();
                $('#people-name-sec').hide();
                $('#cmt-people').trigger('change');
            } else {
                $('#cmt-employee').hide();
                $('#people-name-sec').show();
                $('#people_name').val('');
                $('#people_nik').val('');
                $('#people_position').val('');
            }
        });

        $('#cmt-people').on('change', function() {
            const selectedOption = $(this).find(':selected');
            const name = selectedOption.data('name');
            const nik = selectedOption.data('nik');
            const position = selectedOption.data('position');

            $('#people_name').val(name);
            $('#people_nik').val(nik);
            $('#people_position').val(position);
        });

        $('#people_submit').on('click', function() {
            if ($('#people-category').find(':selected').val() === 'cmt') {
                if ($('#cmt-people').find(':selected').val() === '') {
                    return;
                }
            } else {
                if ($('#people_name').val() === '' || $('#people_nik').val() === '' || $('#people_position').val() === '') {
                    return;
                }
            }

            let html;

            const randomId = Math.random().toString(36).substring(2, 8);

            if ($('#people-category').find(':selected').val() === 'cmt') {
                let selectedOption = $('#cmt-people').find(':selected');
                let id = $('#cmt-people').val();
                let name = selectedOption.data('name');
                let nik = selectedOption.data('nik');
                let position = selectedOption.data('position');

                html = `<div class="col-lg-12 row justify-content-center mb-3" id="people-${randomId}">
                    <input type="text" class="form-control form-control-solid" name="cmt_id[]"
                        value="${id}" disabled hidden>
                    <div class="col-lg-4">
                        <input type="text" class="form-control form-control-solid"
                        value="${name}" disabled>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control form-control-solid"
                        value="${nik}" disabled>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control form-control-solid"
                        value="${position}" disabled>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-start items-center">
                        <button type="button" class="btn btn-danger btn-sm btn-icon" id="button-${randomId}">
                            <i class="fa-solid fa-delete-left"></i>
                        </button>
                    </div>
                </div>`;
            } else {
                let name = $('#people_name').val();
                let nik = $('#people_nik').val();
                let position = $('#people_position').val();

                html = `<div class="col-lg-12 row justify-content-center mb-3" id="people-${randomId}">
                    <div class="col-lg-4">
                        <input type="text" class="form-control form-control-solid" name="people_name[]"
                        value="${name}" disabled>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control form-control-solid" name="people_nik[]"
                        value="${nik}" disabled>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control form-control-solid" name="people_position[]"
                        value="${position}" disabled>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-start items-center">
                        <button type="button" class="btn btn-danger btn-sm btn-icon" id="button-${randomId}">
                            <i class="fa-solid fa-delete-left"></i>
                        </button>
                    </div>
                </div>`;

                $('#people_name').val('');
                $('#people_nik').val('');
                $('#people_position').val('');
            }

            $('#people_container').append(html);

            $(`#button-${randomId}`).on('click', function() {
                $(`#people-${randomId}`).remove();
            });
        });

        $('#people-category').trigger('change');
    })
</script>
