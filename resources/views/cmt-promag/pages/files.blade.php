@extends('cmt-promag.detail')

@section('promag-detail-content')
    <div class="modal fade" id="work_list_file" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="work_list_file_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Add Attechment</span>
                            {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                        </div>
                        <div class="scroll-y me-n10 pe-10" id="work_list_file_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#work_list_file_header"
                            data-kt-scroll-wrappers="#work_list_file_scroll" data-kt-scroll-offset="300px">
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
                            <button type="reset" id="work_list_file_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="work_list_file_submit"
                                class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="px-10">
        <div class="d-flex flex-wrap flex-stack my-5">
            <h3 class="fw-bold my-2">
                File Project
                <span class="fs-6 text-gray-400 fw-semibold ms-1">+{{$workList->attachments->count()}}</span>
            </h3>

            {{-- <div class="d-flex my-2">
                <div class="d-flex align-items-center position-relative me-4">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute translate-middle-y top-50 ms-4"></i>
                    <input type="text" id="kt_filter_search"
                        class="form-control form-control-sm form-control-solid bg-body fw-semibold fs-7 w-150px ps-11"
                        placeholder="Search">
                </div>
            </div> --}}
        </div>
        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
            @foreach ($workList->attachments as $attachment)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 ">
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <a href="{{str_replace("public/", "storage/", asset($attachment->path))}}" class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                <div class="symbol symbol-60px mb-5 position-relative">
                                    <img src="{{ asset('/sense/media/svg/files/default-file.svg') }}" class="theme-light-show" alt="">
                                    <img src="{{ asset('/sense/media/svg/files/default-file.svg') }}" class="theme-dark-show" alt="">
                                    <label class="position-absolute top-50 start-50 translate-middle-x text-light fw-semibold text-uppercase" style="margin-left: -3px !important">{{last(explode(".", $attachment->path))}}</label>
                                </div>

                                <div class="fs-5 fw-bold mb-2">
                                    <i class="fa-solid fa-eye"></i> {{$attachment->name}}
                                </div>
                            </a>

                            <div class="fs-7 fw-semibold text-gray-400">
                                {{Carbon\Carbon::parse($attachment->created_at)->diff(Carbon\Carbon::now())->format('%d days ago')}}
                                <a href="#delete_confirmation_file" data-bs-toggle="modal" onclick="deletefile('{{$attachment->id}}')" class="dropdown-item py-2 text-danger"><i class="fa-solid fa-trash me-3 text-danger"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-6 col-lg-4 col-xl-3">
                <a data-bs-toggle="modal" href="#work_list_file" aria-selected="true" class="text-hover-primary fs-5 fw-bold mb-2">
                    <div class="card h-100 flex-center bg-light-primary border-primary border border-dashed p-8">
                        <img src="{{ asset('/sense/media/svg/files/upload-primary.svg') }}" class="mb-5" alt="">
                        File Upload
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        var dataTablefile = null;
        $('#work_list_file_form').submit(function (e) {
            console.log(this)
            e.preventDefault();

            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('com.promag.file.create', ['work_list_id' => $work_list_id]) }}",
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
    </script>

    @include('components.delete-confirmation', ["id" => "file", "route" => route('com.promag.file.delete', ['work_list_id' => $work_list_id])])
@endsection
