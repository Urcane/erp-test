@extends('layouts.app')
@section('title-apps','Settings')
@section('sub-title-apps','Attendance')

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
                @include("hc.cmt-settings.sidebar")
            </div>
            <div class="col-lg-9 mt-md-n14">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-lg-12 row p-6 m-1 rounded">
                            <div class="d-grid">
                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="btn_schedule" href="#schedule_content">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="shift" href="#shift_content">Shift</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content mt-10" id="myTabContent">
                                <div class="tab-pane fade show active" id="schedule_content" role="tabpanel">
                                    @include("hc.cmt-settings.time-management.attendance-part.schedule")
                                </div>
                                <div class="tab-pane fade" id="shift_content" role="tabpanel">
                                    @include("hc.cmt-settings.time-management.attendance-part.shift")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
