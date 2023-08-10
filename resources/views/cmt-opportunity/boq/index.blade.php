@extends('layouts.app')
@section('title-apps', 'BOQ')
@section('sub-title-apps-2', 'Commercial')
@section('sub-title-apps', 'CMT-OPPOR')
@section('desc-apps', 'Bill Of Quantity')
@section('icon-apps', 'fa-solid fa-briefcase')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('summary-page')
    {{-- <div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataUser->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Pegawai</span>
</div>
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataDivision->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Divisi</span>
</div> --}}
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-6 align-items-center">
                            <div class="col-lg-6 gap-3 d-flex align-items-center">
                                <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">List Project / Work</span>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                                    <div class="">
                                        <a href="{{url('cmt-boq/form-boq')}}" class="btn btn-info btn-sm me-3 btn_tambah_lead"><i class="fa-solid fa-plus"></i>Create BoQ</a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-6 hover-scroll-x">
                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active" data-bs-toggle="tab" id="tab_opportunity" href="#tab_opportunity_content">Oppoturnities</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="tab_survey" href="#tab_survey_content">Survey</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="tab_draft" href="#tab_draft_content">Draft BoQ</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" id="tab_commercial" href="#tab_commercial_content">BoQ Commercial</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-success rounded-bottom-0" data-bs-toggle="tab" id="tab_boq_done" href="#tab_boq_done_content">Done</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" id="tab_cancel" href="#tab_boq_cancel_content">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                  
                                    {{-- TAB OPPORTUNITY --}}
                                    <div class="tab-pane fade show active" id="tab_opportunity_content" role="tabpanel">
                                        <div class="row">
                                          <div class="table-responsive">
                                            <div class="col-lg-12">
                                              <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_opportunities">
                                                <thead>
                                                  <tr class="fw-bold fs-7 text-muted text-uppercase">
                                                    <th class="w-25px">#</th>
                                                    <th class="w-25px">#</th>
                                                    <th class="">Company Name</th>
                                                    <th class="w-100px">Company Contact</th>
                                                    <th class="w-100px">Business Type</th>
                                                    <th class="w-300px">Next Action</th>
                                                    <th class="w-300px">Status</th>
                                                    <th class="w-50px text-center">#</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fs-7">
                                                  {{-- <tr>
                                                    <td>
                                                       <span></span>
                                                    </td>
                                                    <td>1</td>
                                                    <td> 
                                                        <span class="fw-normal d-block">Project 1</span>
                                                    </td>
                                                    <td>PRJ001</td>
                                                    <td>John Doe</td>
                                                    <td>
                                                        <span href="#" class="btn btn-light-success btn-sm"><i class="fa-solid fa-check"></i>Selesai</span>
                                                    </td>
                                                    <td>
                                                        <span>2023-07-18 08:51:48</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#kt_modal_update_prospect" class="dropdown-item py-2 btn_update_prospect" data-bs-toggle="modal" data-prospectid="'.$action->prospect_id.'" data-id="'.$action->id.'"><i class="fa-solid fa-list-check me-3"></i>Update BoQ</a></li>
                                                        </ul>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="text-center">
                                                        <div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>
                                                    </td>
                                                    <td>2</td>
                                                    <td>
                                                        <span class="fw-normal d-block">Project 2</span>
                                                    </td>
                                                    <td>PRJ002</td>
                                                    <td>Jane Smith</td>
                                                    <td>
                                                        <span href="#" class="btn btn-light-warning btn-sm"><i class="fas fa-envelope-open-text fs-6"></i> Survey</span>
                                                    </td>
                                                    <td>2023-07-25</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#kt_modal_update_prospect" class="dropdown-item py-2 btn_update_prospect" data-bs-toggle="modal" data-prospectid="'.$action->prospect_id.'" data-id="'.$action->id.'"><i class="fa-solid fa-list-check me-3"></i>Update Progress</a></li>
                                                        </ul>
                                                    </td>
                                                  </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- TAB SURVEY  --}}
                                        <div class="tab-pane fade" id="tab_survey_content" role="tabpanel">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <div class="col-lg-12">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_survey">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-50px">#</th>
                                                                    <th class="">Task Name</th>
                                                                    <th class="w-200px">No. Survey Request</th>
                                                                    <th class="w-200px">No. Work Order</th>
                                                                    <th class="w-100px">Service Type</th>
                                                                    <th class="w-100px">Building Type</th>
                                                                    <th class="w-100px">Building Height</th>
                                                                    <th class="w-100px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                                {{-- <tr>
                                                          <td class="text-center">
                                                              <div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>
                                                          </td>
                                                          <td>2</td>
                                                          <td>
                                                              <span class="fw-normal d-block">Project 2</span>
                                                          </td>
                                                          <td>PRJ002</td>
                                                          <td>Jane Smith</td>
                                                          <td>
                                                              <span href="#" class="btn btn-light-warning btn-sm"><i class="fas fa-envelope-open-text fs-6"></i> Survey</span>
                                                          </td>
                                                          <td>2023-07-18 08:51:48</td>
                                                          <td class="text-center">
                                                              <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                              <ul class="dropdown-menu">
                                                                  <li><a href="#kt_modal_update_prospect" class="dropdown-item py-2 btn_update_prospect" data-bs-toggle="modal" data-prospectid="'.$action->prospect_id.'" data-id="'.$action->id.'"><i class="fa-solid fa-list-check me-3"></i>Update Progress</a></li>
                                                              </ul>
                                                          </td>
                                                        </tr> --}}
                                                      </tbody>
                                                </table>
                                            </div>
                                           </div>
                                        </div>
                                    </div>
                                    {{-- TAB DRAFT  --}}
                                    <div class="tab-pane fade" id="tab_draft_content" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table align-top table-striped border table-rounded gy-5" id="kt_table_draft_boq">
                                                        <thead class="">
                                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                <th class="text-center w-25px">#</th>
                                                                <th class="w-25px">#</th>
                                                                <th class="">Company Name</th>
                                                                <th class="w-300px">Company Address</th>
                                                                <th class="w-300px">Prospect Title</th>
                                                                <th class="w-300px">Next Action</th>
                                                                <th class="w-300px">Prospect Update</th>
                                                                <th class="w-50px text-center">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fs-7">
                                                            {{-- <tr>
                                                                <td class="text-center">
                                                                    <div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>
                                                                </td>
                                                                <td>1</td>
                                                                <td>
                                                                    <span class="fw-normal d-block">Project 1</span>
                                                                </td>
                                                                <td>PRJ001</td>
                                                                <td>
                                                                    <div class="timeline">
                                                                        <div class="timeline">
                                                                            <div class="timeline-item">
                                                                              <div class="timeline-line w-35px"></div>
                                                                              <div class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                <div class="symbol-label bg-light-success">
                                                                                  <i class="fa-solid fa-check text-success"></i>
                                                                                </div>
                                                                              </div>
                                                                              <div class="timeline-content">
                                                                                <div class="pe-5">
                                                                                  <span class="fw-bold d-block">Approval Manager</span>
                                                                                  <p class="text-gray-500 mb-0">Updated: 13 Mei 2023</p>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                            
                                                                            <div class="timeline-item">
                                                                              <div class="timeline-line w-35px"></div>
                                                                              <div class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                <div class="symbol-label bg-light-info">
                                                                                  <i class="fa-regular fa-clock text-info"></i>
                                                                                </div>
                                                                              </div>
                                                                              <div class="timeline-content">
                                                                                <div class="pe-5">
                                                                                  <span class="fw-bold d-block">Approval Manager</span>
                                                                                  <p class="text-gray-500 mb-0">Updated: 13 Mei 2023</p>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                    </div>
                                                                </td>
                                                                <td>Review</td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#kt_modal_update_prospect" class="dropdown-item py-2 btn_update_prospect" data-bs-toggle="modal" data-prospectid="'.$action->prospect_id.'" data-id="'.$action->id.'"><i class="fa-solid fa-list-check me-3"></i>Update Progress</a></li>
                                                                    </ul>
                                                                </td>
                                                            </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB COMMERCIAL  --}}
                                        <div class="tab-pane fade" id="tab_commercial_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_commercial">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-25px">#</th>
                                                                    <th class="w-25px">#</th>
                                                                    <th class="">Project Name</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <div class="text-center w-50px"><input
                                                                                name="checkbox_prospect_ids"
                                                                                type="checkbox"
                                                                                value="'.$check->prospect_id.'"></div>
                                                                    </td>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <span class="fw-normal d-block">Project 1</span>
                                                                    </td>
                                                                    <td>PRJ001</td>
                                                                    <td>
                                                                        <div class="timeline">
                                                                            <div class="timeline">
                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-success">
                                                                                            <i
                                                                                                class="fa-solid fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Approval
                                                                                                Manager</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-info">
                                                                                            <i
                                                                                                class="fa-regular fa-clock text-info"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Approval
                                                                                                Manager</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-info">
                                                                                            <i
                                                                                                class="fa-regular fa-clock text-info"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Approval
                                                                                                Manager</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-info">
                                                                                            <i
                                                                                                class="fa-regular fa-clock text-info"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Approval
                                                                                                Manager</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>Review</td>
                                                                    <td class="text-center">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-icon btn-sm"
                                                                            data-kt-menu-placement="bottom-end"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i
                                                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#kt_modal_update_prospect"
                                                                                    class="dropdown-item py-2 btn_update_prospect"
                                                                                    data-bs-toggle="modal"
                                                                                    data-prospectid="'.$action->prospect_id.'"
                                                                                    data-id="'.$action->id.'"><i
                                                                                        class="fa-solid fa-list-check me-3"></i>Update
                                                                                    Progress</a></li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB BOQ DONE  --}}
                                        <div class="tab-pane fade" id="tab_boq_done_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_boq-done">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-25px">#</th>
                                                                    <th class="w-25px">#</th>
                                                                    <th class="">Project Name</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <div class="text-center w-50px"><input
                                                                                name="checkbox_prospect_ids"
                                                                                type="checkbox"
                                                                                value="'.$check->prospect_id.'"></div>'
                                                                    </td>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <span class="fw-normal d-block">Project 1</span>
                                                                    </td>
                                                                    <td>PRJ001</td>
                                                                    <td>
                                                                        <div class="timeline">
                                                                            <div class="timeline">
                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-success">
                                                                                            <i
                                                                                                class="fa-solid fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Done</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-info">
                                                                                            <i
                                                                                                class="fa-regular fa-clock text-info"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Done</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>Next to Quotation</td>
                                                                    <td class="text-center">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-icon btn-sm"
                                                                            data-kt-menu-placement="bottom-end"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i
                                                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#kt_modal_update_prospect"
                                                                                    class="dropdown-item py-2 btn_update_prospect"
                                                                                    data-bs-toggle="modal"
                                                                                    data-prospectid="'.$action->prospect_id.'"
                                                                                    data-id="'.$action->id.'"><i
                                                                                        class="fa-solid fa-list-check me-3"></i>Update
                                                                                    Progress</a></li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- TAB BOQ CANCEL  --}}
                                        <div class="tab-pane fade" id="tab_boq_cancel_content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-top table-striped border table-rounded gy-5"
                                                            id="kt_table_boq-done">
                                                            <thead class="">
                                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                                    <th class="text-center w-25px">#</th>
                                                                    <th class="w-25px">#</th>
                                                                    <th class="">Project Name</th>
                                                                    <th class="w-200px">No. Project</th>
                                                                    <th class="w-200px">Progress</th>
                                                                    <th class="w-300px">Next Action</th>
                                                                    <th class="w-50px text-center">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fs-7">
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <div class="text-center w-50px"><input
                                                                                name="checkbox_prospect_ids"
                                                                                type="checkbox"
                                                                                value="'.$check->prospect_id.'"></div>'
                                                                    </td>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <span class="fw-normal d-block">Project 2</span>
                                                                    </td>
                                                                    <td>PRJ002</td>
                                                                    <td>
                                                                        <div class="timeline">
                                                                            <div class="timeline">
                                                                                <div class="timeline-item">
                                                                                    <div class="timeline-line w-35px">
                                                                                    </div>
                                                                                    <div
                                                                                        class="timeline-icon symbol symbol-circle symbol-35px">
                                                                                        <div
                                                                                            class="symbol-label bg-light-danger">
                                                                                            <i
                                                                                                class="fa-solid fa-xmark text-danger"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="timeline-content">
                                                                                        <div class="pe-5">
                                                                                            <span
                                                                                                class="fw-bold d-block">Canceled</span>
                                                                                            <p class="text-gray-500 mb-0">
                                                                                                Updated: 13 Mei 2023</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>No Action</td>
                                                                    <td></td>
                                                                </tr>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @role('administrator')
        {{-- @include('cmt-opportunity.survey.modal.modal-request-survey')
@include('cmt-opportunity.survey.modal.modal-create-wo-survey')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-internet')
@include('cmt-opportunity.survey.modal.survey-result.modal-create-survey-result-cctv') --}}
    @endrole


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        generateDatatable({
            tableName: "tableOpporunities",
            elementName: "#kt_table_opportunities",
            ajaxLink: "{{ route('com.prospect.get-table-prospect-only-done') }}",
            columnData: [
                { data: 'DT_RowChecklist', orderable: false, searchable: false},
                { data: 'DT_RowIndex'},
                { data: 'customer.customer_contact.customer_contact_name'},
                { data: 'customer.customer_contact.customer_contact_phone'},
                { data: 'customer.bussines_type.type_name'},
                { data: 'next_action_pretified'},
                { data: 'progress_pretified'},
                { data: 'actionBoq' },
            ]
        });

        $('#tab_survey').click(function() {
            generateDatatable({
                tableName: "tableDoneSurvey",
                elementName: "#kt_table_survey",
                ajaxLink: "{{ route('com.survey-result.datatable') }}",
                columnData: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'work_order.task_description'
                    },
                    {
                        data: 'survey_request.no_survey'
                    },
                    {
                        data: 'work_order.no_wo'
                    },
                    {
                        data: 'service_type.name'
                    },
                    {
                        data: 'building_type'
                    },
                    {
                        data: 'building_height'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });

      $('#tab_draft').click(function () {
          generateDatatable({
            tableName: "tableDraftBoq",
            elementName: "#kt_table_draft_boq",
            ajaxLink: "{{ route('com.boq.draft.datatable') }}",
            columnData: [
                // { data: 'DT_RowChecklist'},
                { data: 'DT_RowIndex'},
                { data: 'prospect.customer.customer_name'},
                { data: 'prospect.customer.customer_address'},
                { data: 'prospect.customer_prospect_logs.prospect_update'},
                { data: 'prospect.customer_prospect_logs.prospect_next_action'},
                { data: 'action' },
            ]
         });   
      });
});
</script>
