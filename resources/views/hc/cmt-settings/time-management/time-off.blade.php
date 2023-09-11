@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Time Of')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                    @include('hc.cmt-settings.sidebar')
                </div>
                <div class="col-lg-9 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-6 mb-9">
                                <h4>Time Off</h4>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div>
                                    <a href="{{ route('hc.setting.timeoff.create') }}"
                                        class="btn btn-info btn-sm me-3 btn-add-category">
                                        <i class="fa-solid fa-plus"></i>
                                        Add Category
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                                <div class="col-lg-12">
                                    <table class="table align-top table-striped border table-rounded gy-5" id="tb_timeoff">
                                        <thead class="">
                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                <th class="text-center w-50px">#</th>
                                                <th class="w-150px">Name</th>
                                                <th class="w-150px">Code</th>
                                                <th class="w-150px">Effective Date</th>
                                                <th class="w-150px">Expire Date</th>
                                                {{-- <th class="w-150px">Expired Date</th>
                                                <th class="w-150px">Assigned To</th> --}}
                                                <th class="w-100px">#</th>
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
        </div>
    </div>

    <script>
        let dataTableTimeOff;

        $(document).ready(function() {
            function deleteTimeOff(id) {
                $.ajax({
                    url: "{{ route('hc.setting.timeoff.delete') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        dataTableTimeOff.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            }

            dataTableTimeOff = $('#tb_timeoff').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                buttons: [],
                ajax: {
                    url: "{{ route('hc.setting.timeoff-get-table') }}",
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

                columns: [
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'effective_date'
                    },
                    {
                        data: 'expired_date'
                    },
                    // { data: 'effective_date'},
                    // { data: 'expired_date'},
                    // { data: 'assigned_to'},
                    {
                        data: 'action'
                    },
                ],

                columnDefs: [{
                    targets: 0,
                    className: 'text-center',
                }],
            });
        });
    </script>
@endsection
