{{-- formal education experience content --}}
<div class="col-lg-6 mb-9">
    <h4>Formal Education</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your formal education experience information</span>
</div>
<div class="col-lg-6 d-flex justify-content-end">
    <div>
        <button class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Add Formal Education</button>
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

{{-- non formal education experience content --}}
<div class="col-lg-6 mb-9 mt-9">
    <h4>Non-Formal Education</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your non-formal education experience information</span>
</div>
<div class="col-lg-6 d-flex justify-content-end mt-9">
    <div>
        <button class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Add Formal Education</button>
    </div>
</div>
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_non_formal_education_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="w-150px">name</th>
                <th class="w-150px">Held By</th>
                <th class="w-150px">Expired Date</th>
                <th class="w-150px">Start Year</th>
                <th class="w-150px">End Year</th>
                <th class="w-150px">Duration</th>
                <th class="w-150px">Fee</th>
                <th class="w-150px">Certificate</th>
                <th class="w-100px">#</th>
            </tr>
        </thead>
        <tbody class="fs-7">
        </tbody>
    </table>
</div>

{{-- Working experience content --}}
<div class="col-lg-6 mb-9 mt-9">
    <h4>Working Experience</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your working experience information</span>
</div>
<div class="col-lg-6 d-flex justify-content-end mt-9">
    <div>
        <button class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Add Working Experience</button>
    </div>
</div>
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_experience_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="">Company</th>
                <th class="w-150px">Position</th>
                <th class="w-150px">From</th>
                <th class="w-150px">To</th>
                <th class="w-100px">#</th>
            </tr>
        </thead>
        <tbody class="fs-7">
        </tbody>
    </table>
</div>

<script>
    $( "#education_experience" ).on( "click", function() {
        $('#tb_formal_education_content').DataTable({
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

        // table non formal education
        $('#tb_non_formal_education_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            ajax: {
                url : "{{route('hc.emp.get-table-non-formal-education')}}",
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
            { data: 'held_by'},
            { data: 'expired_date'},
            { data: 'start_year'},
            { data: 'end_year'},
            { data: 'duration'},
            { data: 'fee'},
            { data: 'certificate'},
            { data: 'action'},
            ],
        });

        // table experience
        $('#tb_experience_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            ajax: {
                url : "{{route('hc.emp.get-table-experience')}}",
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
            { data: 'position'},
            { data: 'start_day'},
            { data: 'end_day'},
            { data: 'action'},
            ],
        });
    })
</script>
