<div class="modal fade" id="attendance_request_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_attendance_request" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="family_id" value="">
                    <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Request Attendance</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Pilih Tanggal Attendance</span>
                                </label>
                                <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                    required name="date">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Shift</span>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    value="{{ $user->userEmployment->workingScheduleShift->workingShift->name }}"
                                    placeholder="Nomor Induk Keluarga" disabled>
                            </div>
                            <div class="col-lg-6 mt-3 mb-3">
                                <input type="checkbox" class="form-check-input checkbox-real" id="check_in_box">
                                <label class="fs-6 form-check-label mb-2" for="permanent">
                                    <span class="fw-bold">Check In</span>
                                </label>
                                <input type="time" class="form-control form-control-solid text-muted"
                                    placeholder="Select Date" name="check_in" id="check_in">
                            </div>
                            <div class="col-lg-6 mt-3 mb-3">
                                <input type="checkbox" class="form-check-input checkbox-real" id="check_out_box">
                                <label class="fs-6 form-check-label mb-2" for="permanent">
                                    <span class="fw-bold">Check Out</span>
                                </label>
                                <input type="time" class="form-control form-control-solid text-muted"
                                    placeholder="Select Date" name="check_out" id="check_out">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Notes</span>
                                </label>
                                <textarea class="form-control form-control-solid" placeholder="Select Date" required name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_family_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_family_submit" class="btn btn-sm btn-info w-lg-200px"
                            data-bs-dismiss="modal">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade show active" id="attendance_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Attendance</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your attendance information</span>
        </div>
        <div class="col-lg-6 ">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="#attendance_request_modal" class="btn btn-info btn-sm me-3 fs-9" data-bs-toggle="modal"><i
                            class="fa-solid fa-plus"></i>Request Attendance</a>
                </div>
                <div class="col-4">
                    <button class="btn btn-info btn-sm me-3 fs-8"><i class="fa-solid fa-plus"></i>View Log</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5" id="tb_attendance_content">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Date</th>
                        <th class="w-150px">Approval Line</th>
                        <th class="w-150px">Check In</th>
                        <th class="w-150px">Check Out</th>
                        <th class="w-150px">Status</th>
                        <th class="w-100px">#</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let attendanceTable;

    $(document).ready(function() {
        $("#time_management").on("click", function() {
            attendanceTable = $('#tb_attendance_content').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.attd.get-table-me') }}",
                    data: function(data) {
                        data.user_id = {{ $user->id }}
                    }
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                buttons: [],
                dom: "<'row mb-2'" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",

                columns: [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'approval_line'
                    },
                    {
                        data: 'check_in'
                    },
                    {
                        data: 'check_out'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        searchable : false,
                        className: 'text-center',
                    },
                ],
            });
        });

        $('#check_in_box').on('change', function() {
            if ($(this).is(':checked')) {
                $('#check_in').prop('disabled', false);
                $('#check_in').prop('required', true);
                $('#check_in').removeClass('text-muted');
            } else {
                $('#check_in').prop('disabled', true);
                $('#check_in').prop('required', false);
                $('#check_in').addClass('text-muted');
                $('#check_in').val('');
            }
        });

        $('#check_out_box').on('change', function() {
            if ($(this).is(':checked')) {
                $('#check_out').prop('disabled', false);
                $('#check_out').prop('required', true);
                $('#check_out').removeClass('text-muted');
            } else {
                $('#check_out').prop('disabled', true);
                $('#check_out').prop('required', false);
                $('#check_out').addClass('text-muted');
                $('#check_out').val('');
            }
        });

        $('#modal_create_attendance_request').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('req.attd.create') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    attendanceTable.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });
    });
</script>
