<div class="row p-6 m-1 rounded border border-2 border-secondary">
    <div class="d-grid">
        <ul class="nav nav-tabs flex-nowrap text-nowrap">
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="attendance" href="#attendance_content">Attendance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="overtime" href="#overtime_content">Overtime</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="time_off" href="#time_off_content">Time Off</a>
            </li>
        </ul>
    </div>
    <div class="tab-content mt-5" id="myTabContent">
        <div class="tab-pane fade show active" id="attendance_content" role="tabpanel">
            <div class="row p-4">

                {{-- Family Cotent --}}
                <div class="col-lg-6 mb-9">
                    <h4>Attendance</h4>
                    <span class="fs-7 fw-semibold text-gray-500">Your attendance information</span>
                </div>
                <div class="col-lg-6 justify-content-end">
                    <div class="row w-100">
                        <div class="col-6">
                            <button class="btn btn-info btn-sm me-3 fs-9"><i class="fa-solid fa-plus"></i>Request Attendance</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-info btn-sm me-3 fs-8"><i class="fa-solid fa-plus"></i>View Log</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <table class="table align-top table-striped border table-rounded gy-5" id="tb_attendance_content">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th class="text-center w-50px">#</th>
                                <th class="">Nama</th>
                                <th class="w-150px">Relationship</th>
                                <th class="w-150px">Birthday</th>
                                <th class="w-150px">NIK</th>
                                <th class="w-150px">Marital Status</th>
                                <th class="w-100px">#</th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="overtime_content" role="tabpanel">
            <div class="row p-4">

                {{-- Overtime Content --}}
                <div class="col-lg-6 mb-9">
                    <h4>Overtime Content</h4>
                    <span class="fs-7 fw-semibold text-gray-500">Your overtime information</span>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-info btn-sm me-3"><i class="fa-solid fa-plus"></i>Request Overtime</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <table class="table align-top table-striped border table-rounded gy-5" id="tb_overtime_content">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th class="text-center w-50px">#</th>
                                <th class="">Create Date</th>
                                <th class="w-150px">Overtime Date</th>
                                <th class="w-150px">Status</th>
                                <th class="w-150px">Compensation Type</th>
                                <th class="w-100px">#</th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="time_off_content" role="tabpanel">
            <div class="row p-4">

                {{-- Time Off content --}}
                <div class="col-lg-6 mb-9">
                    <h4>Time Off</h4>
                    <span class="fs-7 fw-semibold text-gray-500">Your time off information</span>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-info btn-sm me-3"><i class="fa-solid fa-plus"></i>Request Time Off</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <table class="table align-top table-striped border table-rounded gy-5" id="tb_time_off_content">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th class="text-center w-50px">#</th>
                                <th class="">Create Date</th>
                                <th class="w-150px">Start Date</th>
                                <th class="w-150px">End Date</th>
                                <th class="w-150px">Taken</th>
                                <th class="w-150px">Request Code</th>
                                <th class="w-100px">#</th>
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
