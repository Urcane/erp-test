@include('hc.cmt-request.attendance.modal')

<div class="flex-grow-1 text-center mb-6">
    <span class="fs-4 text-uppercase fw-bolder text-dark d-none d-md-block">List Request Time Off</span>
</div>

<div class="row border rounded p-4 mb-4 justify-content-center">
    <div class="col-6">
        <p class="fw-bold fs-6 mb-2" id="view-date-attendance">View Date : -</p>
        <div class="ms-1 row">
            <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="on-time">
                <div class="text-info fw-bolder fs-4 mb-3" id="view-need-att">-</div>
                <div class="fw-semibold fs-7 text-gray-600">Need Approval</div>
            </div>
            <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="late-clock-in">
                <div class="text-info fw-bolder fs-4 mb-3" id="view-approved-att">-</div>
                <div class="fw-semibold fs-7 text-gray-600">Approved</div>
            </div>
            <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="early-clock-out">
                <div class="text-info fw-bolder fs-4 mb-3" id="view-reject-att">-</div>
                <div class="fw-semibold fs-7 text-gray-600">Rejected</div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <p class="fw-bold fs-6 mb-2">All Time</p>
        <div class="ms-1 row">
            <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="on-time">
                <div class="text-info fw-bolder fs-4 mb-3" id="all-need-att">-</div>
                <div class="fw-semibold fs-7 text-gray-600">Need Approval</div>
            </div>
            <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="late-clock-in">
                <div class="text-info fw-bolder fs-4 mb-3" id="all-approved-att">-</div>
                <div class="fw-semibold fs-7 text-gray-600">Approved</div>
            </div>
            <div class="col summaries" href="#summaries_modal" data-bs-toggle="modal" data-param="early-clock-out">
                <div class="text-info fw-bolder fs-4 mb-3" id="all-reject-att">-</div>
                <div class="fw-semibold fs-7 text-gray-600">Rejected</div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mb-2">
    <div class="input-group w-150px w-md-250px mx-4">
        <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input class="form-control form-control-solid form-control-sm" autocomplete="off" id="search_attendance">
    </div>

    <div class="input-group w-150px w-md-250px mx-4">
        <span class="input-group-text border-0"><i class="fa-solid fa-calendar"></i></span>
        <input class="form-control form-control-solid form-control-sm" autocomplete="off" name="range_date_attendance"
            id="range_date_attendance">
    </div>

    <div>
        <button type="button" class="btn btn-light-info btn-sm me-3" data-kt-menu-trigger="hover"
            data-kt-menu-placement="bottom-start"><i class="fa-solid fa-filter me-2"></i>Filter</button>
        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px text-start" id="filter_pegawai_attendance"
            data-kt-menu="true" style="">
            <div class="d-flex flex-column bgi-no-repeat rounded-top">
                <span class="fs-6 text-dark fw-bolder px-8 mt-6 mb-3">Filter Options</span>
            </div>
            <div class="separator mb-6"></div>
            <div class="row px-8 pb-6">
                <div class="col-lg-12 mb-3">
                    <label class="d-flex align-items-center fs-6 mb-2">
                        <span class="fw-bold textd-dark">Department</span>
                    </label>
                    <select class="form-select form-select-sm form-select-solid" data-control="select2" required
                        name="filterDepartment" id="filter_department_attendance" data-dropdown-parent="#filter_pegawai_attendance">
                        <option value="*">Semua Department</option>
                        @foreach ($dataDepartment as $dp)
                            <option value="{{ $dp->id }}">{{ $dp->department_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-12 mb-3">
                    <label class="d-flex align-items-center fs-6 mb-2">
                        <span class="fw-bold textd-dark">Divisi</span>
                    </label>
                    <select class="form-select form-select-sm form-select-solid" data-control="select2" required
                        name="filterDivisi" id="filter_divisi_attendance" data-dropdown-parent="#filter_pegawai_attendance">
                        <option value="*">Semua Divisi</option>
                        @foreach ($dataDivision as $dd)
                            <option value="{{ $dd->id }}">{{ $dd->divisi_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-12 mb-3">
                    <label class="d-flex align-items-center fs-6 mb-2">
                        <span class="fw-bold textd-dark">Status</span>
                    </label>
                    <select class="form-select form-select-sm form-select-solid" data-control="select2" required
                        name="filterStatus" id="filter_status_attendance" data-dropdown-parent="#filter_pegawai_attendance">
                        <option value="*">Semua Status</option>
                        @foreach ($approveStatus as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12 mt-6 text-end">
                    <button class="btn btn-sm btn-light" id="btn_reset_filter">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table align-top border table-rounded gy-5" id="kt_table_attendance">
            <thead class="">
                <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                    <th class="text-center w-50px">#</th>
                    <th class="text-center w-50px">#</th>
                    <th class="w-250px">Nama Pegawai</th>
                    <th class="w-150px">Nip</th>
                    <th class="w-150px">Date</th>
                    <th class="w-150px">Branch</th>
                    <th class="w-150px">Organization</th>
                    <th class="w-150px">Job Level</th>
                    <th class="w-150px">Job Position</th>
                    <th class="w-50px">Status</th>
                    <th class="w-150px">#</th>
                </tr>
            </thead>
            <tbody class="fs-7">
            </tbody>
        </table>
    </div>
</div>
