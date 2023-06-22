@extends('cmt-promag.detail')

@section('promag-detail-content')
<div class="d-flex flex-wrap flex-stack pt-10 pb-8">
    <h3 class="fw-bold my-2">
        Project Work Lists
    </h3>

    <div class="d-flex flex-wrap my-1">
        <ul class="nav nav-pills me-5" role="tablist">
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
        </ul>

        <div class="my-0">
            <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-sm form-select-solid w-150px select2-hidden-accessible" data-select2-id="select2-data-7-smn8" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                <option value="1" selected="" data-select2-id="select2-data-9-nm7b">Recently Updated</option>
                <option value="2">Last Month</option>
                <option value="3">Last Quarter</option>
                <option value="4">Last Year</option>
            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-g6s3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-sm form-select-solid w-150px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-14-container" aria-controls="select2-status-14-container"><span class="select2-selection__rendered" id="select2-status-14-container" role="textbox" aria-readonly="true" title="Recently Updated">Recently Updated</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_inp">
            <thead>
                <tr class="fw-bold fs-7 text-muted text-uppercase">
                    <th class="text-center w-50px">#</th>
                    <th class="">Work List</th>
                    <th class="w-150px">Section</th>
                    <th class="w-200px">Assigned</th>
                    <th class="w-200px">Progress</th>
                    <th class="w-100px">Status</th>
                    <th class="w-100px text-center">#</th>
                </tr>
            </thead>
            <tbody class="fs-7">
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <span class="fw-bold">Survey ke Lokasi Balikpapan - Comtelindo</span>
                    </td>
                    <td>
                        <span class="badge badge-light fw-semibold me-auto">Survey</span>
                    </td>
                    <td>
                        <div class="symbol-group symbol-hover">
                            {{-- <div class="symbol symbol-circle symbol-30px" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                <img src="{{asset('sense')}}/media/avatars/blank.png" alt="">
                            </div> --}}
                            <div class="symbol symbol-circle symbol-30px" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                <div class="symbol-label bg-warning">
                                    <span class="fs-7 text-white">E</span>
                                </div>
                            </div>
                            <div class="symbol symbol-circle symbol-30px">
                                <div class="symbol-label bg-dark">
                                    <span class="fs-7 text-inverse-dark">+0</span>
                                </div>
                            </div>
                            <div class="symbol symbol-circle symbol-30px">
                                <a href="#!" data-bs-toggle="modal" >
                                    <div class="symbol-label bg-light">
                                        <span class="fs-7"><i class="fa-solid fa-user-plus"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center w-100 mw-125px">  
                            <div class="progress h-6px w-100 me-2 bg-light-info">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 44%" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-muted fs-8 fw-semibold">
                                44%
                            </span>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-light-info px-3 py-2">Progress</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <ul class="dropdown-menu w-150px">
                            <li><a href="#" class="dropdown-item py-2" data-id="1"><i class="fa-solid fa-pen me-4"></i>View</a></li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
