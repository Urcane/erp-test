@extends('layouts.app')
@section('title-apps','CMT-PROMAG')
@section('sub-title-apps','Commercial')
@section('desc-apps','Pusing Kerja?, PROMAG solusi nya!')
@section('icon-apps','fa-solid fa-briefcase')

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
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap flex-stack pt-10 pb-8">
                            <h3 class="fw-bold my-2">
                                Project Task Lists
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
                                <a class="btn btn-info btn-sm" data-bs-toggle="modal" href="#modal_task_list" aria-selected="true">
                                    {{-- <i class="fas fa-plus"></i>  --}}
                                    Action
                                </a>
                            </div>
                        </div>
                        <div class="row border border-2 border-secondary rounded p-10">
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap flex-stack pb-8">
                                    <h3 class="fw-bold">
                                        {{$workTaskList->task_name}}
                                    </h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="me-10 text-end">
                                            <h5>Status</h5>
                                            {{$workTaskList->status}}
                                        </div>
                                        <div class="text-end">
                                            <h5>Due Date</h5>
                                            {{$workTaskList->due_date}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 border-end border-secondary">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6>No. Project</h6>
                                        <span>{{$workTaskList->workList->no_project}}</span>
                                        <h6 class="mt-5">Progress</h6>
                                        <span>{{$workTaskList->workList->progress}}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>No. PO Customer</h6>
                                        <span>{{$workTaskList->workList->no_po_customer}}</span> <br>
                                        <h6 class="mt-5">Location</h6>
                                        <span>{{$workTaskList->workList->work_location}}</span>
                                    </div>
                                    <div class="col-lg-12 mt-5">
                                        <h6>Task Description</h6>
                                        <span>{{$workTaskList->task_description}}</span>
                                    </div>

                                </div>
                            </div>

                            {{-- Activity --}}
                            <div class="col-lg-6 px-5">
                                <h6>Activity</h6>
                                <div class="d-flex align-items-start my-5">
                                    <div class="me-5 position-relative">
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="https://preview.keenthemes.com/metronic8/demo30/assets/media/avatars/300-6.jpg"/>
                                        </div>
                                    </div>
                                    <form class="w-100" id="comment-form" >
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" ></textarea>
                                        <button class="btn btn-info btn-sm mt-5">Save</button>
                                    </form>
                                </div>

                                <div class="card">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-column p-1 pt-3 mb-9">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Avatar-->
                                            <div class="me-5 position-relative">
                                                <!--begin::Image-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="https://preview.keenthemes.com/metronic8/demo30/assets/media/avatars/300-6.jpg"/>
                                                </div>
                                                <!--end::Image-->
                                            </div>
                                            <!--end::Avatar-->

                                            <!--begin::Details-->
                                            <div class="fw-semibold" >
                                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">Emma Smith</a>

                                                <div class="text-gray-400" >
                                                    8 Pending &amp;
                                                    97 Completed
                                                    Tasks
                                                </div>
                                            </div>
                                            <!--end::Details-->

                                            <!--begin::Badge-->
                                            <div class="badge badge-light ms-auto" >
                                                5
                                            </div>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Item-->
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

@include('cmt-promag.modal.modal-views-users')


<script>
    $("#comment-form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        const formData = new FormData(this);
        $.ajax({
            url: "{{ route('com.promag.task-list.comment'), ['task_list_id', $task_list_id] }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#edit_item_modal').modal('hide');
                $('#modal_edit_item')[0].reset();
                itemTable.ajax.reload();
                toastr.success(data.message, 'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });
</script>
@endsection
