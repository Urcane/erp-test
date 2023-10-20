@extends('cmt-promag.detail')

@section('promag-detail-content')
<div class="px-10">
    <div class="d-flex flex-wrap flex-stack pt-10 pb-8">
        <h3 class="fw-bold my-2">
            Procurement Lists
        </h3>

        <div class="d-flex flex-wrap my-1">
            {{-- <ul class="nav nav-pills me-5" role="tablist">
                <li class="nav-item m-0" role="presentation">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3" data-bs-toggle="tab" href="#kt_project_targets_card_pane" aria-selected="false" role="tab" tabindex="-1">
                        <i class="fas fa-tablet"></i>
                    </a>
                </li>

                <li class="nav-item m-0" role="presentation">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary active" data-bs-toggle="tab" href="#kt_project_targets_table_pane" aria-selected="true" role="tab">
                        <i class="fas fa-table-columns"></i>
                    </a>
                </li>
            </ul> --}}

            {{-- <div class="my-0">
                <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-sm form-select-solid w-150px select2-hidden-accessible" data-select2-id="select2-data-7-smn8" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                    <option value="1" selected="" data-select2-id="select2-data-9-nm7b">Recently Updated</option>
                    <option value="2">Last Month</option>
                    <option value="3">Last Quarter</option>
                    <option value="4">Last Year</option>
                </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-g6s3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-sm form-select-solid w-150px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-14-container" aria-controls="select2-status-14-container"><span class="select2-selection__rendered" id="select2-status-14-container" role="textbox" aria-readonly="true" title="Recently Updated">Recently Updated</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div> --}}
            <a class="btn btn-info btn-sm" href="{{route("com.promag.procurement.create", ["workList" => $work_list_id])}}">
                <i class="fas fa-plus"></i> Add Procrument
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table align-top table-striped border table-rounded gy-5"
                    id="kt_table_procurement">
                    <thead class="">
                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                            <th class="w-50px text-center">#</th>
                            <th class="">Customer Name</th>
                            <th class="">Request Date</th>
                            <th class="">No. PR</th>
                            <th class="">Type</th>
                            <th class="">Status</th>
                            <th class="w-50px text-center">#</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var dataTableTaskList;
    $(document).ready(function () {
        dataTableTaskList= $('#kt_table_procurement').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            buttons: [],
            ajax: {
                url : "{{route('com.promag.procurement.datatable', ['work_list_id' => $work_list_id])}}",
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
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
                {
                    data: 'customer'
                },
                {
                    data: 'request_date'
                },
                {
                    data: 'no_pr'
                },
                {
                    data: 'type'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ],

            columnDefs: [
            {
                targets: 0,
                searchable : false,
                className: 'text-center',
            },
            {
                targets: 6,
                orderable : false,
                searchable : false,
                className : 'text-center',
            },
            ],
        });
    });

    $("#task_list_form").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('com.promag.task-list.store', ['work_list_id' => $work_list_id]) }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(data) {
                dataTableTaskList.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });
</script>
@endsection
