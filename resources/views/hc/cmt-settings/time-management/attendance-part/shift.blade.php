
<div class="modal fade" id="modal_create_shift" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_shift_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="modal_create_shift_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_create_shift_header" data-kt-scroll-wrappers="#modal_create_shift_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Shift</span>
                            {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                        </div>
                        <div class="col-lg-12">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">General Setup</span>
                            </label>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="show_in_request" id="show_in_request">
                                <label class="fs-6 form-check-label mb-2" for="show_in_request">
                                    <span class="fw-bold">Show In Request</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Shift Name</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Name" required name="name">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Schedule In</span>
                            </label>
                            <input type="time" class="form-control form-control-solid" placeholder="Schedule In" required name="working_start">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Schedule Out</span>
                            </label>
                            <input type="time" class="form-control form-control-solid" placeholder="Schedule Out" required name="working_end">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Break Start</span>
                            </label>
                            <input type="time" class="form-control form-control-solid" placeholder="Schedule In" required name="break_start">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Break End</span>
                            </label>
                            <input type="time" class="form-control form-control-solid" placeholder="Schedule Out" required name="break_end">
                        </div>

                        <div class="col-lg-12">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="fw-bold">Additional Setup</span>
							</label>
						</div>
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="add_attendance_validation" id="add_attendance_validation" onclick="toggleHidden('#attendance_validation')">
                                <label class="fs-6 form-check-label mb-2" for="add_attendance_validation">
                                    <span class="fw-bold">Add attendance validation</span>
                                </label>
                            </div>
                        </div>
                        <div class="row" id="attendance_validation">
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class= fw-bold">Min. Clock in time (Minute)</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" placeholder="Schedule In" name="start_attend">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class= fw-bold">Max. Clock out time (Minute)</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" placeholder="Schedule Out" name="end_attend">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="add_grace_period" id="add_grace_period" onclick="toggleHidden('#grace_period')">
                                <label class="fs-6 form-check-label mb-2" for="add_grace_period">
                                    <span class="fw-bold">Add grace period</span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="grace_period">
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class= fw-bold">Clock in dispensation (Minute)</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" placeholder="Clock in dispensation" name="late_check_in">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class= fw-bold">Clock out dispensation (Minute)</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" placeholder="Clock out dispensation" name="late_check_out">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="enable_auto_overtime" id="enable_auto_overtime" onclick="toggleHidden('#auto_overtime')">
                                <label class="fs-6 form-check-label mb-2" for="enable_auto_overtime">
                                    <span class="fw-bold">Enable auto overtime</span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="auto_overtime">
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class= fw-bold">Overtime Before</span>
                                </label>
                                <input type="time" class="form-control form-control-solid" placeholder="Overtime Before" name="overtime_before">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class= fw-bold">Overtime After</span>
                                </label>
                                <input type="time" class="form-control form-control-solid" placeholder="Overtime After" name="overtime_after">
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_shift_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_shift_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-9">
        <h4>Shift</h4>
        <span class="fs-7 fw-semibold text-gray-500">Set every shift on your company.</span>
    </div>
    <div class="col-lg-6 d-flex justify-content-end">
        <div>
            <a href="#modal_create_shift" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_shift"><i class="fa-solid fa-plus"></i>Add Shift</a>
        </div>
    </div>
    <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5 overflow-auto" id="tb_shift">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Name</th>
                        <th class="w-150px">Working Hour</th>
                        <th class="w-150px">Break Hour</th>
                        <th class="w-150px">OT Before</th>
                        <th class="w-150px">OT After</th>
                        <th class="w-150px">Show In Request</th>
                        <th class="w-150px">Assigned To</th>
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
    let dataTableJobShift
    $(".btn_tambah_shift").on( "click", function() {
        $("input").val("")
        $("[name=\'show_in_request\']").val("0");
        $("[name=\'show_in_request\']").prop("checked", false);
        $("[name=\'add_attendance_validation\']").val("0");
        $("[name=\'add_attendance_validation\']").prop("checked", false);
        $("#attendance_validation").addClass("d-none")
        $("[name=\'add_grace_period\']").val("0");
        $("[name=\'add_grace_period\']").prop("checked", false);
        $("#grace_period").addClass("d-none")
        $("[name=\'enable_auto_overtime\']").val("0");
        $("[name=\'enable_auto_overtime\']").prop("checked", false);
        $("#auto_overtime").addClass("d-none")
    })

    function toggleHidden(id) {
        $(id).toggleClass("d-none");
        $(id + " input").map(function(){
            console.log($(this).val(""))

        });
    }

    $(document).ready(function () {
        dataTableJobShift = $('#tb_shift').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            buttons: [],
            ajax: {
                url : "{{route('hc.setting.getTableShift')}}",
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",

            columns: [
            { data: 'DT_RowIndex'},
            { data: 'name'},
            { data: 'working_hour'},
            { data: 'break_hour'},
            { data: 'overtime_before'},
            { data: 'overtime_after'},
            { data: 'show_in_request'},
            { data: 'assigned_to'},
            { data: 'action'},
            ],

            columnDefs: [
            {
                targets: 0,
                className: 'text-center',
            },
            {
                targets: 8,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
    })

    function deleteShift(id) {
        $.ajax({
            url: "{{ route('hc.setting.shift.delete') }}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'POST',
            data: { id : id},
            success: function(data) {
                dataTableJobShift.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    }

    $('#modal_create_shift_form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('hc.setting.shift.createUpdate') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(data) {
                $('#modal_create_shift').modal('hide');
                dataTableJobShift.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });

    function updateShowInRequest(id) {
        $.ajax({
            url: "{{ route('hc.setting.shift.udpateShowInRequest') }}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'POST',
            data: { id : id},
            success: function(data) {
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
                $(`#show_id_request_table_${id}`).prop('checked', !$(`#show_id_request_table_${id}`).is(':checked'));
            }
        });
    }

    function fillInput(
        id,
        show_in_request,
        name,
        working_start,
        working_end,
        break_start,
        break_end,
        start_attend,
        end_attend,
        late_check_in,
        late_check_out,
        overtime_before,
        overtime_after,) {
        $("[name=\'id\']").val(id);
        $("[name=\'name\']").val(name);
        $("[name=\'working_start\']").val(working_start);
        $("[name=\'working_end\']").val(working_end);
        $("[name=\'break_start\']").val(break_start);
        $("[name=\'break_end\']").val(break_end);
        $("[name=\'start_attend\']").val(start_attend);
        $("[name=\'end_attend\']").val(end_attend);
        $("[name=\'late_check_in\']").val(late_check_in);
        $("[name=\'late_check_out\']").val(late_check_out);
        $("[name=\'overtime_before\']").val(overtime_before);
        $("[name=\'overtime_after\']").val(overtime_after);

        $("[name=\'show_in_request\']").val("0");
        $("[name=\'show_in_request\']").prop("checked", false);
        $("[name=\'add_attendance_validation\']").val("0");
        $("[name=\'add_attendance_validation\']").prop("checked", false);
        $("[name=\'add_grace_period\']").val("0");
        $("[name=\'add_grace_period\']").prop("checked", false);
        $("[name=\'enable_auto_overtime\']").val("0");
        $("[name=\'enable_auto_overtime\']").prop("checked", false);

        if (show_in_request != "0") {
            $("[name=\'show_in_request\']").val("1")
            $("[name=\'show_in_request\']").prop("checked", true);
        }

        $("#attendance_validation").addClass("d-none")
        if (start_attend || end_attend) {
            $("[name=\'add_attendance_validation\']").val("1")
            $("[name=\'add_attendance_validation\']").prop("checked", true);
            $("#attendance_validation").removeClass("d-none")
        }

        $("#grace_period").addClass("d-none")
        if (late_check_in || late_check_out) {
            $("[name=\'add_grace_period\']").val("1")
            $("[name=\'add_grace_period\']").prop("checked", true);
            $("#grace_period").removeClass("d-none")
        }

        $("#auto_overtime").addClass("d-none")
        if (overtime_before || overtime_after) {
            $("[name=\'enable_auto_overtime\']").val("1")
            $("[name=\'enable_auto_overtime\']").prop("checked", true);
            $("#auto_overtime").removeClass("d-none")
        }
    }
</script>
