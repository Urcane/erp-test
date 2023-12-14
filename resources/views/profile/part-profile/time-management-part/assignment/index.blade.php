<div class="tab-pane fade" id="assignment_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Assignment Content</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your assignment information</span>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <div>
                <a href="{{ route('req.assignment.create') }}" class="btn btn-info btn-sm me-3">
                    <i class="fa-solid fa-plus"></i>
                    Request Assignment
                </a>
            </div>
        </div>

        <div class="d-grid">
            <ul class="nav nav-tabs flex-nowrap text-nowrap">
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0 active"
                        data-bs-toggle="tab" href="#active-assignment">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                        data-bs-toggle="tab" href="#request-assignment">My Request</a>
                </li>
            </ul>
        </div>

        <div class="col-lg-12">
            <div class="tab-content mt-5">
                <div class="tab-pane fade show active" id="active-assignment" role="tabpanel">
                    <div class="col-lg-12">
                        <table class="table align-top table-striped border table-rounded gy-5"
                            id="tb_active_assignment">
                            <thead class="">
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th class="text-center w-50px">#</th>
                                    <th class="">Date</th>
                                    <th class="">Project Name</th>
                                    <th class="">Created By</th>
                                    <th class="">Signed By</th>
                                    <th class="">Created At</th>
                                    <th class="w-50px">#</th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="request-assignment" role="tabpanel">
                    <div class="col-lg-12">
                        <table class="table align-top table-striped border table-rounded gy-5"
                            id="tb_request_assignment">
                            <thead class="">
                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                    <th class="text-center w-50px">#</th>
                                    <th class="">Date</th>
                                    <th class="">Project Name</th>
                                    <th class="">Signed By</th>
                                    <th class="">Status</th>
                                    <th class="">Created At</th>
                                    <th class="w-50px">#</th>
                                </tr>
                            </thead>
                            <tbody class="fs-7">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const cancelRequest = (id) => {
        $.ajax({
            url: "{{ route('req.assignment.cancel') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            data: {
                id
            },
            success: function(data) {
                toastr.success(data.message, 'Selamat 🚀 !');
                tableAssignment.draw();
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    }

    $(document).ready(function() {
        $("#assignment").on("click", function() {
            $('#tb_active_assignment').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.assignment.get-table-active') }}",
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
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'created_by'
                    },
                    {
                        data: 'signed_by'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        targets: 6,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
            });

            $('#tb_request_assignment').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.assignment.get-table-request') }}",
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
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'signed_by'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        targets: 4,
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        targets: 6,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
            });
        });
    });
</script>
