<div class="tab-pane fade" id="time_off_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Time Off</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your time off information</span>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <div>
                <button class="btn btn-info btn-sm me-3"><i class="fa-solid fa-plus"></i>Request Time Off</button>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5" id="tb_time_off_content">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Create Date</th>
                        <th class="w-150px">Start Date</th>
                        <th class="w-150px">End Date</th>
                        <th class="w-150px">Taken</th>
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
    $( "#time_off" ).on( "click", function() {
        // table experience
        $('#tb_time_off_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            ajax: {
                url : "{{route('hc.emp.get-table-request-timeoff')}}",
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
            { data: 'created_at'},
            { data: 'start_date'},
            { data: 'end_date'},
            { data: 'taken'},
            { data: 'action'},
            ],
        });
    });
</script>
