{{-- Emergency Contact Content --}}
<div class="col-lg-6 mb-9">
    <h4>Emergency Contact</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your emergency contact information</span>
</div>
<div class="col-lg-6 d-flex justify-content-end">
    <div>
        <button class="btn btn-info btn-sm me-3 btn_tambah_pegawai"><i class="fa-solid fa-plus"></i>Add Emergency Contact</button>
    </div>
</div>
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_emergency_contact_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="text-center w-50px">#</th>
                <th class="">Nama</th>
                <th class="w-150px">Relationship</th>
                <th class="w-150px">Phone Number</th>
                <th class="w-100px">#</th>

            </tr>
        </thead>
        <tbody class="fs-7">
        </tbody>
    </table>
</div>

<script>
    $( "#emergency_contact" ).on( "click", function() {
        $('#tb_emergency_contact_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            drawCallback: function () {
                $('body').on('click', 'input[name=\'emergency_contact_ids\']', function () {
                    if($(this).is(":checked")){
                        emergency_contactids.push($(this).val());
                    } else {
                        removeFrom(emergency_contactids, $(this).val());
                    }
                });
            },
            ajax: {
                url : "{{route('hc.emp.get-table-emergency-contact')}}",
                data: function(data){
                    data.user_id = {{$user->id}}
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            buttons: [
            // {
            //     extend: 'excel',
            //     className: 'btn btn-light-success btn-sm ms-3',
            //     title: 'Data Pegawai Comtelindo',
            //     exportOptions: {
            //         columns: [1,8,9,3,10,4,5,6]
            //     }
            // },
            ],
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
            { data: 'DT_RowChecklist', orderable: false, searchable: false},
            { data: 'DT_RowIndex'},
            { data: 'name'},
            { data: 'relationship',},
            { data: 'phone',},
            { data: 'action'},
            ],
        });
    })
</script>
