@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Time Off')

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
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                    @include('hc.cmt-settings.sidebar')
                </div>
                <div class="col-lg-9 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 row rounded">
                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0 active"
                                                data-bs-toggle="tab" id="settingnav" href="#setting">Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-info rounded-bottom-0"
                                                data-bs-toggle="tab" id="usernav" href="#user">User Management</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="setting" role="tabpanel">
                                        @include('hc.cmt-settings.time-management.leave.settings.index')
                                    </div>

                                    <div class="tab-pane fade" id="user" role="tabpanel">
                                        @include('hc.cmt-settings.time-management.leave.user.index')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('hc.cmt-settings.time-management.leave.script')

@endsection
