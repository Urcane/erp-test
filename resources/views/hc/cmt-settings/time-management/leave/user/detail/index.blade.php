@extends('layouts.app')
@section('title-apps', 'Time Off')
@section('sub-title-apps', 'Settings')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    @include('hc.cmt-settings.time-management.leave.user.detail.modal')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-12 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-9 text-center">
                                <h4>User Leave Quota Management</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <div class="fw-bold fs-6 text-black me-3 mb-1 p-0">Data Pegawai</div>
                                <div class="col-12 row">
                                    <div class="col">
                                        <div class="fw-bold fs-7 text-muted me-3 p-0">Nama</div>
                                        <div class="m-0 p-0 d-flex align-items-center text-info fs-1 fw-bolder">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold fs-7 text-muted me-3 p-0">Employee ID</div>
                                        <div class="m-0 p-0 d-flex align-items-center text-info fs-1 fw-bolder">
                                            {{ $user->userEmployment->employee_id }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold fs-7 text-muted me-3 p-0">Join Date</div>
                                        <div class="m-0 p-0 d-flex align-items-center text-info fs-1 fw-bolder">
                                            {{ (new DateTime($user->userEmployment->join_date))->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>

                                <hr class="mb-2">

                                <div class="fw-bolder fs-5 text-black me-3 mb-2 p-0">Quota Cuti</div>

                                <div class="col-12 mb-3">
                                    <div class="m-0 p-0 d-flex align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 my-auto me-3 p-0">Sisa Cuti :</div>
                                        <p class="text-info fw-bolder me-2 my-auto" style="font-size: 31px;" id="available_quota">12</p>
                                        <p class="text-gray-800 my-auto" style="font-size: 13px;">Hari</p>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <table class="table align-top border table-rounded" id="kt_table_quota">
                                        <thead class="">
                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                                <th class="text-center w-50px">#</th>
                                                <th class="w-100px">Quota</th>
                                                <th class="w-150px">Received Date</th>
                                                <th class="w-150px">Expired Date</th>
                                                <th class="w-150px">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-7">
                                        </tbody>
                                    </table>
                                </div>

                                <hr class="mb-3">

                                <div class="fw-bolder fs-5 text-black me-3 mb-4 p-0">History</div>

                                <div class="col-lg-12">
                                    <table class="table align-top border table-rounded" id="kt_table_history">
                                        <thead class="">
                                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                                                <th class="text-center w-50px">#</th>
                                                <th class="w-150px">Name</th>
                                                <th class="w-150px">Approval Name</th>
                                                <th class="w-150px">Date</th>
                                                <th class="w-150px">Quota Change</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-7">
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
    @include('hc.cmt-settings.time-management.leave.user.detail.script')
@endsection
