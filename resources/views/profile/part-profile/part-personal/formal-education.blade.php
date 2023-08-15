<div class="modal fade" id="modal_create_formal_education" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_formal_education_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="modal_create_formal_education_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_create_formal_education_header" data-kt-scroll-wrappers="#modal_create_formal_education_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Formal Education</span>
                            <span class="fs-7 fw-semibold text-gray-500">Riwayat pendidikan formal anda</span>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Nama</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nama instansi" required name="name">
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Grade</span>
							</label>
                            <select class="drop-data form-select form-select-solid" data-control="grade" name="grade" required>
                                @foreach ($allOptions->grade as $option)
                                    <option value="{{$option}}" @if (old('grade') == $option) selected @endif>{{$option}}</option>
                                @endforeach
                            </select>
						</div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Major</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Jurusan" required name="major">
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Start Year</span>
							</label>
                            <input type="number" class="form-control form-control-solid" placeholder="Tahun Masuk" required name="start_year">
						</div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">End Year</span>
							</label>
                            <input type="number" class="form-control form-control-solid" placeholder="Tahun Lulus" required name="end_year">
						</div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Score</span>
							</label>
                            <input type="number" class="form-control form-control-solid" placeholder="Nilai yang didapatkan ketika lulus" required name="score">
						</div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="fw-bold">Certificate</span>
							</label>
                            <input type="file" class="form-control form-control-solid" placeholder="Sektifikat maupun ijazah yang didapatkan" name="certificate">
						</div>
                        <div id="containerSelectedSurveyRequests">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_formal_education_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_formal_education_submit" class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- formal education experience content --}}
<div class="col-lg-6 mb-9">
    <h4>Formal Education</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your formal education experience information</span>
</div>
<div class="col-lg-6 d-flex justify-content-end">
    <div>
        <a href="#modal_create_formal_education" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_formal"><i class="fa-solid fa-plus"></i>Add Formal Education</a>
    </div>
</div>
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_formal_education_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="">Grade</th>
                <th class="w-150px">Institution Name</th>
                <th class="w-150px">Major</th>
                <th class="w-150px">Start Year</th>
                <th class="w-150px">End Year</th>
                <th class="w-150px">Score</th>
                <th class="w-150px">Certificate</th>
                <th class="w-100px">#</th>
            </tr>
        </thead>
        <tbody class="fs-7">
        </tbody>
    </table>
</div>

<script>
    var dataTableFormal;

    $(".btn_tambah_formal").on( "click", function() {
        $("[name='id']").val("")
        $("input:not([name='user_id'])").val("")
    })

    $( "#education_experience" ).on( "click", function() {
        dataTableFormal = $('#tb_formal_education_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            ajax: {
                url : "{{route('hc.emp.get-table-formal-education')}}",
                data: function(data){
                    data.user_id = {{$user->id}}
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            buttons: [],
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
            { data: 'grade'},
            { data: 'major'},
            { data: 'start_year'},
            { data: 'end_year'},
            { data: 'score'},
            { data: 'certificate'},
            { data: 'action'},
            ],
        });
    });

    function deleteFormalEducation(id) {
        $.ajax({
            url: "{{ route('hc.emp.delete-formal-education') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: { id : id},
            success: function(data) {
                dataTableFormal.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = JSON.parse(xhr.responseText);
                toastr.error(errorThrown ,'Opps!');
            }
        });
    }

    $('#modal_create_formal_education_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('hc.emp.create-update-formal-education') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                dataTable.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = JSON.parse(xhr.responseText);
                toastr.error(errorThrown ,'Opps!');
            }
        });
    });
</script>
