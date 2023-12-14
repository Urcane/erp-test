@extends('cmt-promag.detail')

@section('promag-detail-content')
    <div class="card-body">
        <!--begin::Tab Content-->
        <div class="tab-content">
            <!--begin::Tab panel-->
            <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel"
                aria-labelledby="kt_activity_today_tab">
                <!--begin::Timeline-->
                <div class="timeline timeline-border-dashed">
                    @foreach ($workActivity as $activity)
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line"></div>
                            <!--end::Timeline line-->

                            <!--begin::Timeline icon-->
                            <div class="timeline-icon rounded-circle d-flex justify-content-center align-items-center bg-light" style="margin-left: -19px; border: 1px solid var(--bs-gray-300); border-style: dashed!important; height:40px; width:40px;">
                                @if ($activity->type == "work_list")
                                    <i class="fa-solid fa-briefcase fs-2 text-gray-500"></i>
                                @elseif ($activity->type == "attachment")
                                    <i class="fa-solid fa-paperclip fs-2 text-gray-500"></i>
                                @elseif ($activity->type == "task_list")
                                    <i class="fa-solid fa-list-check fs-2 text-gray-500"></i>
                                @elseif ($activity->type == "comment")
                                    <i class="fa-regular fa-comment fs-2 text-gray-500"></i>
                                @elseif ($activity->type == "procurement")
                                    <i class="fa-solid fa-box-open fs-2 text-gray-500"></i>
                                @endif
                            </div>
                            <!--end::Timeline icon-->

                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="mb-5 pe-3">
                                    <!--begin::Title-->
                                    <span class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">{{$activity->description}}</span>
                                    <!--end::Title-->

                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Created at {{$activity->created_at}} by {{$activity->user->name}}</div>
                                        <!--end::Info-->

                                        <!--begin::User-->
                                        {{-- <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" aria-label="Jan Hummer" data-bs-original-title="Jan Hummer" data-kt-initialized="1">
                                            <img src="/metronic8/demo2/assets/media/avatars/300-23.jpg" alt="img">
                                        </div> --}}
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->

                                @if ($activity->attachments->isNotEmpty())
                                    <!--begin::Timeline details-->
                                    <div class="overflow-auto pb-5">
                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                            @foreach ($activity->attachments as $attachment)
                                                <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div class="card h-100 ">
                                                        <div class="card-body d-flex justify-content-center text-center flex-column">
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
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Timeline details-->
                                @endif
                            </div>
                            <!--end::Timeline content-->
                        </div>
                    @endforeach

                </div>
                <!--end::Timeline-->
            </div>
            <!--end::Tab panel-->
        </div>
        <!--end::Tab Content-->
    </div>
@endsection
