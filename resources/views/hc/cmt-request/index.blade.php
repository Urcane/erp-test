@extends('layouts.app')
@section('title-apps', 'CMT-Request')
@section('sub-title-apps', 'HC & Legal')
@section('desc-apps', 'Catatan Daftar Request Karyawan')
@section('icon-apps', 'fa-solid fa-handshake')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-lg-12 row rounded">

                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active"
                                                data-bs-toggle="tab" id="attendancenav" href="#attendance">Attendance</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                                data-bs-toggle="tab" id="timeoffnav" href="#timeoff">Time Off</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                                data-bs-toggle="tab" id="overtimenav" href="#overtime">Overtime</a>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                                data-bs-toggle="tab" id="shiftnav" href="#shift">Shift</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                                data-bs-toggle="tab" id="delegatenav" href="#delegate">Delegate</a>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="attendance" role="tabpanel">
                                        @include('hc.cmt-request.attendance.index')
                                    </div>

                                    <div class="tab-pane fade" id="timeoff" role="tabpanel">
                                        @include('hc.cmt-request.timeoff.index')
                                    </div>

                                    {{-- <div class="tab-pane fade" id="overtime" role="tabpanel">
                                        @include('hc.cmt-request.overtime.index')
                                    </div> --}}

                                    <div class="tab-pane fade" id="shift" role="tabpanel">
                                        @include('hc.cmt-request.shift.index')
                                    </div>

                                    {{-- <div class="tab-pane fade" id="delegate" role="tabpanel">
                                        @include('hc.cmt-request.delegate.index')
                                    </div> --}}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('hc.cmt-request.script')

@endsection
