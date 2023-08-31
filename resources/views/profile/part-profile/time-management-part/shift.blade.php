<div class="modal fade" id="shift_request_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                @if (!$dataShift->isEmpty())
                    <form id="modal_create_shift_request" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <div class="scroll-y me-n10 pe-10" data-kt-scroll-max-height="auto"
                            data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Request Shift</span>
                                    {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Pilih Tanggal Shift</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid"
                                        placeholder="Select Date" required name="date">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Shift Saat ini</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        value="{{ $user->userEmployment->workingScheduleShift->workingShift->name }}"
                                        name="dweadawd" disabled>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Shift Baru</span>
                                    </label>
                                    <select required class="drop-data form-select form-select-solid"
                                        data-control="working_shift_id" name="working_shift_id">
                                        @foreach ($dataShift as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }} ({{$option->working_start}} - {{$option->working_end}})</option>
                                        @endforeach
                                    </select>
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
                            <button type="reset" id="shift_request_modal_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            @if (!$dataShift->isEmpty())
                                <button type="submit" id="shift_request_modal_submit"
                                    class="btn btn-sm btn-info w-lg-200px" data-bs-dismiss="modal">
                                    <span class="indicator-label">Request</span>
                                </button>
                            @endif
                        </div>
                    </form>
                @else
                    <div class="col-lg-12 text-center mb-9">
                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Tidak ada shift yang tersedia</span>
                        {{-- <span class="fs-7 fw-semibold text-gray-500">Ajukan absen</span> --}}
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="shift_request_modal_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">OK</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="shift_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Request Shift</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your request shift information</span>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <div>
                <a href="#shift_request_modal" class="btn btn-info btn-sm me-3 fs-8" data-bs-toggle="modal"><i
                        class="fa-solid fa-plus"></i>Request Shift</a>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5" id="tb_shift_content">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Created Date</th>
                        <th class="w-150px">Request Date</th>
                        <th class="w-150px">Approval Line</th>
                        <th class="w-150px">Shift</th>
                        <th class="w-150px">Working Start</th>
                        <th class="w-150px">Working End</th>
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
    $(document ).ready(function() {
        let shiftTable;
        $("#shift").on("click", function() {
            shiftTable = $('#tb_shift_content').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.shift.get-table-me') }}",
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

                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'approval_line'
                    },
                    {
                        data: 'shift'
                    },
                    {
                        data: 'working_start'
                    },
                    {
                        data: 'working_end'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },
                ],
                columnDefs: [{
                    targets: 0,
                    searchable: false,
                    className: 'text-center',
                }, ],
            });
        })

        $('#modal_create_shift_request').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('req.shift.create') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    shiftTable.ajax.reload();
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
