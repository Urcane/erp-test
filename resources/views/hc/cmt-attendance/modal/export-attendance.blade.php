<div class="modal fade" id="attendance_export_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <div id="modal_attendance_export">
                    <div>
                        <div class="row mb-9" id="filter_pegawai_export">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Export Attendance</span>
                            </div>

                            <div class="col-lg-12 mt-3 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Periode Attendance</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
                                    <input class="form-control form-control-solid form-control-md" autocomplete="off" name="range_date_export" id="range_date_export">
                                </div>
                            </div>

                            @empty($user)
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 mb-2">
                                        <span class="required fw-bold textd-dark">Department</span>
                                    </label>
                                    <select class="form-select form-select-md form-select-solid" data-control="select2" required
                                        name="filterDepartment" id="filter_department_export" data-dropdown-parent="#filter_pegawai_export">
                                        <option value="*">Semua Department</option>
                                        @foreach ($dataDepartment as $dp)
                                            <option value="{{ $dp->id }}">{{ $dp->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 mb-2">
                                        <span class="required fw-bold textd-dark">Divisi</span>
                                    </label>
                                    <select class="form-select form-select-md form-select-solid" data-control="select2" required
                                        name="filterDivisi" id="filter_divisi_export" data-dropdown-parent="#filter_pegawai_export">
                                        <option value="*">Semua Divisi</option>
                                        @foreach ($dataDivision as $dd)
                                            <option value="{{ $dd->id }}">{{ $dd->divisi_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endempty
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_attendance_export_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_attendance_export_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Export</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document ).ready(function() {
        $('input[name="range_date_export"]').daterangepicker({
            autoUpdateInput: false,
            opens: 'left',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, (from_date, to_date) => {
            $('#range_date_export').val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
        });
    })
</script>
