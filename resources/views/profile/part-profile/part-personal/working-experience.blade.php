@can('HC:update-profile')
    <div class="modal fade" id="modal_create_work_experience" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_create_work_experience_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="id" value="">
                        <div class="scroll-y me-n10 pe-10" id="modal_create_work_experience_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_create_work_experience_header"
                            data-kt-scroll-wrappers="#modal_create_work_experience_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Working Experience</span>
                                    <span class="fs-7 fw-semibold text-gray-500">Riwayat atau pengalaman pekerjaan
                                        anda</span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Company</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nama perusahaan" required name="name">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Position</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Posisi yang ditempati selama bekerja" required name="position">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Start Date</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid"
                                        placeholder="tanggal mulai kerja" required name="start_date">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">End Date</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid"
                                        placeholder="Tanggal selesai kerja" required name="end_date">
                                </div>
                                <div id="containerSelectedSurveyRequests">

                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_create_work_experience_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_create_work_experience_submit"
                                class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan

{{-- Working experience content --}}
<div class="col-lg-6 mb-9 mt-9">
    <h4>Working Experience</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your working experience information</span>
</div>
@can('HC:update-profile')
<div class="col-lg-6 d-flex justify-content-end mt-9">
    <div>
        <a href="#modal_create_work_experience" data-bs-toggle="modal"
            class="btn btn-info btn-sm me-3 btn_working_exp"><i class="fa-solid fa-plus"></i>Add Working Experience</a>
    </div>
</div>
@endcan
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_experience_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="">Company</th>
                <th class="w-150px">Position</th>
                <th class="w-150px">From</th>
                <th class="w-150px">To</th>
                @can('HC:update-profile')
                    <th class="w-100px">#</th>
                @endcan
            </tr>
        </thead>
        <tbody class="fs-7">
        </tbody>
    </table>
</div>

<script>
    var dataTableWork;

    $(".btn_working_exp").on("click", function() {
        $("[name='id']").val("")
        $("input:not([name='user_id'])").val("")
    })

    $("#education_experience").on("click", function() {
        // table experience
        dataTableWork = $('#tb_experience_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            ajax: {
                url: "{{ route('hc.emp.get-table-experience') }}",
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
                    data: 'name'
                },
                {
                    data: 'position'
                },
                {
                    data: 'start_date'
                },
                {
                    data: 'end_date'
                },
                @can('HC:update-profile')
                    {
                        data: 'action'
                    },
                @endcan
            ],
        });
    })
    @can('HC:update-profile')
        function deleteWorkExperience(id) {
            $.ajax({
                url: "{{ route('hc.emp.delete-work-experience') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    dataTableWork.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        }

        $('#modal_create_work_experience_form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('hc.emp.create-update-work-experience') }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    dataTableWork.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });
    @endcan
</script>
