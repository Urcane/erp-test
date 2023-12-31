@can('HC:update-profile')
    <div class="modal fade" id="modal_create_family" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_create_family_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="family_id" value="">
                        <div class="scroll-y me-n10 pe-10" id="modal_create_family_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_create_family_header"
                            data-kt-scroll-wrappers="#modal_create_family_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Form Family</span>
                                    <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Nama</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Name"
                                        required name="name">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">NIK</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Induk Keluarga" required name="nik">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Relationship</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Hubungan dengan anda" required name="relationship">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Gender</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid" data-control="gender"
                                        name="gender" required>
                                        @foreach ($constants->gender as $option)
                                            <option value="{{ $option }}"
                                                @if (old('gender') == $option) selected @endif>{{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Birthdate</span>
                                    </label>
                                    <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                        required name="birthdate">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Marital Status</span>
                                    </label>
                                    <select required class="drop-data form-select form-select-solid"
                                        data-control="marital_status" name="marital_status">
                                        @foreach ($constants->marital_status as $option)
                                            <option value="{{ $option }}"
                                                @if (old('marital_status') == $option) selected @endif>{{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Religion</span>
                                    </label>
                                    <select required class="drop-data form-select form-select-solid" data-control="religion"
                                        name="religion">
                                        @foreach ($constants->religion as $option)
                                            <option value="{{ $option }}"
                                                @if (old('religion') == $option) selected @endif>{{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Job</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Pekerjaan yang dimiliki" required name="job">
                                </div>
                                {{-- <div class="col-lg-6 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="fw-bold">Kategori Work Order</span>
                            </label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="type_of_wo" data-dropdown-parent="#modal_create_family">
                                <option value="" selected hidden disabled>Pilih Dulu</option>
                                @foreach ($typeOfWOs as $typeOfWO)
                                <option value="{{$typeOfWO->code}}">{{$typeOfWO->name}}</option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div> --}}
                                <div id="containerSelectedSurveyRequests">

                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_create_family_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_create_family_submit" class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan

{{-- Family Cotent --}}
<div class="col-lg-6 mb-9">
    <h4>Family Data</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your family data information</span>
</div>
@can('HC:update-profile')
    <div class="col-lg-6 d-flex justify-content-end">
        <div>
            <a href="#modal_create_family" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i
                    class="fa-solid fa-plus"></i>Add Family</a>
        </div>
    </div>
@endcan
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_family_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="text-center w-50px">#</th>
                <th class="btn-edit">Nama</th>
                <th class="w-150px">Relationship</th>
                <th class="w-150px">Birthday</th>
                <th class="w-150px">NIK</th>
                <th class="w-150px">Marital Status</th>
                <th class="w-150px">Gender</th>
                <th class="w-150px">Job</th>
                <th class="w-150px">Religion</th>
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
    var dataTableFamily;

    @can('HC:update-profile')
        $(".btn_tambah_pegawai").on("click", function() {
            $("[name='family_id']").val("")
            $("input:not([name='user_id'])").val("")
        })
    @endcan
    $("#family").on("click", function() {
        dataTableFamily = $('#tb_family_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            buttons: [],
            drawCallback: function() {
                $('body').on('click', 'input[name=\'family_ids\']', function() {
                    if ($(this).is(":checked")) {
                        family_ids.push($(this).val());
                    } else {
                        removeFrom(family_ids, $(this).val());
                    }
                });
            },
            ajax: {
                url: "{{ route('hc.emp.get-table-family') }}",
                data: function(data) {
                    data.user_id = {{ $user->id }}
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable": "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
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
                    data: 'DT_RowChecklist',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex'
                },
                {
                    data: 'name'
                },
                {
                    data: 'relationship',
                },
                {
                    data: 'birthdate',
                },
                {
                    data: 'nik',
                },
                {
                    data: 'marital_status',
                },
                {
                    data: 'gender',
                },
                {
                    data: 'job',
                },
                {
                    data: 'religion',
                },
                @can('HC:update-profile')
                    {
                        data: 'action'
                    },
                @endcan
            ],

            columnDefs: [{
                    targets: 0,
                    searchable: false,
                    className: 'text-center',
                },
                {
                    targets: 1,
                    className: 'text-center',
                },
                @can('HC:update-profile')
                    {
                        targets: 10,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                @endcan
            ],
        });
    })
    @can('HC:update-profile')
        function deleteFamily(family_id) {
            $.ajax({
                url: "{{ route('hc.emp.delete-family') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    family_id: family_id
                },
                success: function(data) {
                    dataTableFamily.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        }

        $('#modal_create_family_form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('hc.emp.create-update-family') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    dataTableFamily.ajax.reload();
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
