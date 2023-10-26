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
<script src="{{asset("sense/plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>

<div class="modal fade" id="modal_task_list_attechment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="task_list_attachment_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    <div class="col-lg-12 text-center mb-9">
                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Add Attechment</span>
                        {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                    </div>
                    <div class="scroll-y me-n10 pe-10" id="modal_task_list_attechment_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_task_list_attechment_header"
                        data-kt-scroll-wrappers="#modal_task_list_attechment_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Attachment</span>
                                </label>
                                <input type="file" class="form-control form-control-solid"
                                    required name="file">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Display Name</span>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    required name="name">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_task_list_attechment_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_task_list_attechment_submit"
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap flex-stack pt-10 pb-8">
                            <h3 class="fw-bold my-2">
                                Project Task Lists
                            </h3>

                            <div class="d-flex flex-wrap my-1">
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
                            <div class="col-lg-6 border-end border-secondary fw-semibold">
                                <div class="row text-gray-400">
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

                                <div class="d-flex flex-wrap flex-stack pb-8 mt-15 pe-5">
                                    <h6>Attachment</h6>
                                    <div class="d-flex flex-wrap">
                                        <a class="btn btn-info btn-sm" data-bs-toggle="modal" href="#modal_task_list_attechment" aria-selected="true">
                                            <i class="fas fa-plus"></i> Add Attachment
                                        </a>
                                    </div>
                                </div>
                                <div class="pe-5">
                                    @foreach ($workTaskList->attachments as $attachment)
                                        <div class="d-flex flex-row justify-content-between mt-5">
                                            <div>
                                                <h4>{{$attachment->name}}</h4>
                                                <span>{{$attachment->created_at}}</span> <br>
                                            </div>
                                            <div>
                                                <a href="{{str_replace("public/", "storage/", asset($attachment->path))}}" class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="fa-solid fa-file-invoice"></i> File
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex flex-wrap flex-stack pb-8 mt-15 pe-5">
                                    <h6>Checklist</h6>
                                    {{-- <div class="d-flex flex-wrap">
                                        <a class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add Checklist</a>
                                    </div> --}}
                                </div>
                                <div id="checklist">
                                    @foreach ($workTaskList->workTaskCheckList as $workTaskCheckList)
                                        <div>
                                            <input type="checkbox" class="form-check-input checkbox-real checklist_id" placeholder="" name="checklist_id" value="{{$workTaskCheckList->id}}" @if ($workTaskCheckList->status == 1)
                                                checked
                                            @endif>
                                            <label class="fs-6 form-check-label mb-2 ms-2"
                                                for="checklist_id">
                                                <span class="fw-bold">{{$workTaskCheckList->task_name}}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="add" class="mt-8">
                                    <form id="form-checklist">
                                        <div class="d-flex justify-content-end pb-8 mt-8 pe-5">
                                            <input type="text" class="form-control form-control-solid me-5" name="task_name" placeholder="Task Name">
                                            <button class="btn btn-sm btn-info">Save</button>
                                        </div>
                                    </form>
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
                                        <textarea name="comment" id="kt_docs_ckeditor_classic">
                                        </textarea>
                                        <button class="btn btn-info btn-sm mt-5">Save</button>
                                    </form>
                                </div>
                                <div id="list-comment">
                                    @foreach ($comments as $comment)
                                        <div class="card">
                                            <!--begin::Card body-->
                                            <div class="card-body d-flex flex-column p-1 pt-3">
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
                                                        <span class="fs-5 text-gray-900 text-hover-primary"><span class="fw-bold">{{$comment->user->name}}</span> {{explode(" ", $comment->created_at)[0]}}</span>

                                                        <div class="text-gray-400" >
                                                            {!!$comment->comments!!}
                                                        </div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                        </div>
                                    @endforeach
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
    ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });

    $('#task_list_attachment_form').submit(function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        $.ajax({
            url: "{{ route('com.promag.task-list.attachment.create', ['task_list_id' => $task_list_id]) }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                toastr.success(data.message, 'Selamat 🚀 !');

                // relode current page
                location.reload();
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    })

    $("#comment-form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        const formData = new FormData(this);
        $.ajax({
            url: "{{ route('com.promag.task-list.comment', ['task_list_id' => $task_list_id]) }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                var newComment = data.data;
                const newCard = `
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column p-1 pt-3">
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
                                    <span class="fs-5 text-gray-900 text-hover-primary"><span class="fw-bold">{{Auth::user()->name}}</span> ${newComment.created_at.split("T")[0]}</span>

                                    <div class="text-gray-400" >
                                        ${newComment.comments}
                                    </div>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Item-->
                        </div>
                    </div>
                `;

                // append the new card to the list-comment div
                $('#list-comment').prepend(newCard);
                toastr.success(data.message, 'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    });

    $(".checklist_id").click(function() {
        const element = $(this);
        const isChecked = element.is(":checked");
        $.ajax({
            url: "{{ route('com.promag.task-list.checklist.update', ['task_list_id' => $task_list_id]) }}",
            type: 'POST',
            data: {
                checklist_id: element.val(),
                status: isChecked ? 1 : 0
            },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                toastr.success(data.message, 'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                console.log(!isChecked, element)
                element.prop('checked', !isChecked);

                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    })
    $("#form-checklist").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        const formData = new FormData(this);
        $.ajax({
            url: "{{ route('com.promag.task-list.checklist.add', ['task_list_id' => $task_list_id]) }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                var newComment = data.data;
                const newSelect = `
                    <div>
                        <input type="checkbox" class="form-check-input checkbox-real"
                            placeholder="" name="checklist_id"
                            id="checklist_id" value="${newComment.id}">
                        <label class="fs-6 form-check-label mb-2 ms-2"
                            for="checklist_id">
                            <span class="fw-bold">${newComment.task_name}</span>
                        </label>
                    </div>
                `;

                // append the new card to the list-comment div
                $('#checklist').prepend(newSelect);
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
