<div class="modal fade" id="time_off_request_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_time_off_request" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Request Time Off</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Time Off Type</span>
                                </label>
                                <select required class="drop-data form-select form-select-solid"
                                    data-control="leave_request_category_id" name="leave_request_category_id">
                                    @foreach ($leaveRequestCategory as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                                <div class="fs-7 fw-semibold text-danger ms-2 mt-2" id="use_quota">
                                    <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>
                                    Kategori ini akan memakai kuota cuti anda (Sebanyak <span class="minus_amount"></span>)
                                </div>
                                <div class="fs-7 fw-semibold text-danger ms-2 mt-2" id="unlimited_balance">
                                    <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>
                                    Kategori ini memiliki kuota pemakaian (Sebanyak <span class="minus_amount"></span>)
                                </div>
                            </div>

                            <section class="row" id="half_day_section">
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Tanggal</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                        required name="date">
                                </div>

                                <div class="col-lg-6 mt-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkbox-real" id="working_start_box">
                                        <label class="fs-6 form-check-label mb-2" for="working_start_box">
                                            <span class="fw-bold">Waktu Masuk</span>
                                        </label>
                                    </div>
                                    <input type="time" class="form-control form-control-solid text-muted"
                                        placeholder="Select Date" name="working_start" id="working_start">
                                </div>
                                <div class="col-lg-6 mt-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkbox-real" id="working_end_box">
                                        <label class="fs-6 form-check-label mb-2" for="working_end_box">
                                            <span class="fw-bold">Waktu Keluar</span>
                                        </label>
                                    </div>
                                    <input type="time" class="form-control form-control-solid text-muted"
                                        placeholder="Select Date" name="working_end" id="working_end">
                                </div>
                            </section>

                            <section class="row" id="date_section">
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Tanggal Mulai</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                        required name="start_date">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Tanggal Selesai</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                        required name="end_date">
                                </div>
                            </section>

                            <div class="fs-7 fw-semibold text-danger ms-2 mt-1 mb-3" id="min_notice_warn">
                                <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>
                                Pengajuan dilakukan minimal dilakukan <span id="min_notice_amount"></span> hari sebelumnya
                            </div>

                            <div class="fs-7 fw-semibold text-danger ms-2 mt-1 mb-3" id="duration_warn">
                                <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>
                                Kategori ini memiliki durasi <span id="duration_amount"></span> hari
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold" id="file_label">File</span>
                                </label>
                                <input type="file" class="form-control form-control-solid" name="file" required>
                                <div class="fs-7 fw-semibold text-danger ms-2 mt-2" id="attachment">
                                    <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>
                                    Attachment diwajibkan untuk kategori ini!
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Notes</span>
                                </label>
                                <textarea class="form-control form-control-solid" required name="notes"></textarea>
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

<script>
    const leaveRequestCategory = @json($leaveRequestCategory);

    $(document).ready(function () {
        $('select[name="leave_request_category_id"]').on('change', function() {
            const {
                attachment,
                max_request,
                use_quota,
                unlimited_balance,
                half_day,
                minus_amount,
                duration,
                min_notice
            } = leaveRequestCategory.find(({ id }) => id == $(this).val());

            if (attachment) {
                $('[name="file"]').prop('required', true);
                $('#file_label').addClass('required');
                $('#attachment').fadeIn();
            } else {
                $('[name="file"]').prop('required', false);
                $('#file_label').removeClass('required');
                $('#attachment').hide();
            }

            if (use_quota) {
                $('#use_quota').fadeIn();
            } else {
                $('#use_quota').hide();
            }

            if (unlimited_balance) {
                $('#unlimited_balance').hide();
            } else {
                $('#unlimited_balance').fadeIn();
            }

            if (half_day) {
                $('#half_day_section').show();
                $('#date_section').hide();
                $('#working_start_box').prop('checked', false);
                $('#working_start_box').trigger('change');
                $('#working_end_box').prop('checked', false);
                $('#working_end_box').trigger('change');
                $('[name="date"]').prop('required', true);
                $('[name="start_date"]').prop('required', false);
                $('[name="end_date"]').prop('required', false);

                if (min_notice) {
                    $('[name="date"]').attr('min', moment().add(min_notice, 'days').format('YYYY-MM-DD'));
                    $('#min_notice_warn').fadeIn();
                    $('#min_notice_amount').text(min_notice);
                } else {
                    $('#min_notice_warn').hide();
                    $('[name="date"]').removeAttr('min');
                }

                $('#duration_warn').hide();
            } else {
                $('#half_day_section').hide();
                $('#date_section').show();
                $('#working_start_box').prop('checked', false);
                $('#working_start_box').trigger('change');
                $('#working_end_box').prop('checked', false);
                $('#working_end_box').trigger('change');
                $('[name="date"]').prop('required', false);
                $('[name="start_date"]').prop('required', true);
                $('[name="end_date"]').prop('required', true);

                if (minus_amount) {
                    $('.minus_amount').text(minus_amount);
                } else {
                    $('.minus_amount').text("durasi pengajuan");
                }

                if (min_notice) {
                    $('[name="start_date"]').attr('min', moment().add(min_notice, 'days').format('YYYY-MM-DD'));
                    $('#min_notice_warn').fadeIn();
                    $('#min_notice_amount').text(min_notice);
                } else {
                    $('#min_notice_warn').hide();
                    $('[name="start_date"]').removeAttr('min');
                }

                if (duration) {
                    $('#duration_warn').fadeIn();
                    $('#duration_amount').text(duration);
                    $('[name="end_date"]').attr('disabled', true);

                    $('[name="start_date"]').on("change", function() {
                        let date = moment($(this).val());
                        date = date.add(duration, 'days').format('YYYY-MM-DD');

                        $('[name="end_date"]').val(date);
                    });
                } else {
                    $('#duration_warn').hide();
                    $('[name="start_date"]').off("change");
                    $('[name="end_date"]').attr('disabled', false);
                }
            }

            $('#modal_create_time_off_request input').val('');
        });

        $('select[name="leave_request_category_id"]').trigger('change');

        $('#working_start_box').on('change', function() {
            if ($(this).is(':checked')) {
                $('#working_start').prop('disabled', false);
                $('#working_start').prop('required', true);
                $('#working_start').removeClass('text-muted');
            } else {
                $('#working_start').prop('disabled', true);
                $('#working_start').prop('required', false);
                $('#working_start').addClass('text-muted');
                $('#working_start').val('');
            }
        });

        $('#working_end_box').on('change', function() {
            if ($(this).is(':checked')) {
                $('#working_end').prop('disabled', false);
                $('#working_end').prop('required', true);
                $('#working_end').removeClass('text-muted');
            } else {
                $('#working_end').prop('disabled', true);
                $('#working_end').prop('required', false);
                $('#working_end').addClass('text-muted');
                $('#working_end').val('');
            }
        });
    });
</script>
