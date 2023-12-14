@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Job Position')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('sense') }}/plugins/custom/OrgChart/css/jquery.orgchart.css"">
    <style>
        #chart-container {
            font-family: Arial;
            height: 420px;
            border: 2px dashed #aaa;
            border-radius: 5px;
            overflow: auto;
            text-align: center;
        }

        .orgchart {
            background: white;
        }
    </style>

    <div class="modal fade" id="modal_create_job_position" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_create_job_position_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="scroll-y me-n10 pe-10" id="modal_create_job_position_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_create_job_position_header"
                            data-kt-scroll-wrappers="#modal_create_job_position_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Job Position</span>
                                    {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Nama</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Name"
                                        required name="divisi_name">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold">Alias</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Name"
                                        name="divisi_alias">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Organization</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid" data-control="department_id"
                                        name="department_id" required>
                                        @foreach ($dataOrganization as $option)
                                            <option value="{{ $option->id }}"
                                                @if (old('department_id') == $option->id) selected @endif>
                                                {{ $option->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Parent</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid" data-control="parent_id"
                                        name="parent_id" required>
                                        @foreach ($dataDivision as $option)
                                            <option value="{{ $option->id }}"
                                                @if (old('parent_id') == $option->id) selected @endif>{{ $option->divisi_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_create_job_position_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_create_job_position_submit"
                                class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                                <h4>Job Position</h4>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div>
                                    <a href="#modal_create_job_position" data-bs-toggle="modal"
                                        class="btn btn-info btn-sm me-3 btn_tambah_job_position"><i
                                            class="fa-solid fa-plus"></i>Add Job Position</a>
                                </div>
                            </div>
                            <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" id="attendance" href="#table">Table</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0"
                                                data-bs-toggle="tab" id="chart_tab" href="#chart">Chart</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="table" role="tabpanel">
                                        <div class="">
                                            <table class="table align-top table-striped border table-rounded gy-5"
                                                id="tb_job_position">
                                                <thead class="">
                                                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                        <th class="text-center w-50px">#</th>
                                                        <th class="text-center w-50px">#</th>
                                                        <th class="w-150px">Job Position</th>
                                                        <th class="w-150px">Parent Job Position</th>
                                                        <th class="w-150px">Employee</th>
                                                        <th class="w-100px">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fs-7">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="chart" role="tabpanel">
                                        <div id="chart-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            const initChart = (datascource) => {
                orgInit();
                (($) => {
                $(function() {
                    var oc = $('#chart-container').orgchart({
                        'pan': true,
                        'data': datascource,
                        'nodeContent': 'count',
                        'zoom': true,
                    });

                });

                })(jQuery);
            }

            $("#chart_tab").one("click", function() {
                $.ajax({
                    url: "{{ route('hc.emp.job-position.getGraph') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(data) {

                        (() => initChart(data.data))()
                    }
                });
            });
        })
    </script>

    <script>
        let dataTableJobPosition
        $(".btn_tambah_job_position").on("click", function() {
            $("input").val("")
        })

        $(document).ready(function() {
            dataTableJobPosition = $('#tb_job_position').DataTable({
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
                    url: "{{ route('hc.emp.getTableJobPosition') }}",
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
                        data: 'divisi_name'
                    },
                    {
                        data: 'parent_name'
                    },
                    {
                        data: 'employee'
                    },
                    {
                        data: 'action'
                    },
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
                    {
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
            });
        })

        $('#modal_create_job_position_form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('hc.setting.job-position.createUpdate') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#modal_create_job_position').modal('hide');
                    dataTableJobPosition.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });
    </script>
    @include('components.delete-confirmation', [
        'id' => 'JobPosition',
        'route' => route('hc.setting.job-position.delete'),
    ])

    @include("hc.cmt-settings.company.script.init-orgchart")
@endsection
