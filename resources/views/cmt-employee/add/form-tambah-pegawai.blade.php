@extends('layouts.app')
@section('title-apps','CMT-EMP')
@section('sub-title-apps','HC & Legal')
@section('desc-apps','Database Pegawai Comtelindo')
@section('icon-apps','fa-solid fa-users')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('summary-page')
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataUser->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Pegawai</span>
</div>
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataDivision->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Divisi</span>
</div>
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
                        <div class="mx-5 mx-lg-15 my-9">
                            <form id="kt_create_emp_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                @csrf
                                <div class="row rounded">
                                    <div class="col-lg-1">
                                        <a href="{{route("hc.emp.index")}}" class="fw-bold"><i class="fa-solid fa-arrow-left "></i> Back</a>
                                    </div>
                                    <div class="col-lg-10 text-center mb-9">
                                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Add Employee</span>
                                    </div>
                                    <div class="stepper stepper-pills kt_stepper_form_emp">
                                        {{-- icon for indicator stepper --}}
                                        <div class="stepper-nav flex-center flex-wrap mb-10">
                                            <div class="stepper-item mx-8 current" data-kt-stepper-element="nav">
                                                <div class="stepper-wrapper d-flex align-items-center">
                                                    <div class="stepper-icon w-30px h-30px">
                                                        <i class="stepper-check fas fs-3 fa-check"></i>
                                                        <i class="stepper-number fa-solid fa-user fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                            <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                                <div class="stepper-wrapper d-flex align-items-center">
                                                    <div class="stepper-icon w-30px h-30px">
                                                        <i class="stepper-check fas fs-3 fa-check"></i>
                                                        <i class="stepper-number fa-solid fa-house-laptop fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                            <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                                <div class="stepper-wrapper d-flex align-items-center">
                                                    <div class="stepper-icon w-30px h-30px">
                                                        <i class="stepper-check fas fs-3 fa-check"></i>
                                                        <i class="stepper-number fa-solid fa-image fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                            <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                                <div class="stepper-wrapper d-flex align-items-center">
                                                    <div class="stepper-icon w-30px h-30px">
                                                        <i class="stepper-check fas fs-3 fa-check"></i>
                                                        <i class="stepper-number fa-solid fa-image fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                        </div>

                                        {{-- form --}}
                                        <div class=" mx-auto border border-2 border-secondary p-10 rounded">

                                            <div class="mb-10">
                                                <div class="flex-column current" data-kt-stepper-element="content">
                                                    <div class="row">

                                                        {{-- personal data --}}
                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>Personal Data</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">Fill all employee basic information data</span>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="required fw-bold">First Name</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-solid" placeholder="First Name" required name="first_name">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Last Name</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-solid" placeholder="Last Name" name="last_name">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="required fw-bold">Email</span>
                                                                </label>
                                                                <input type="email" class="form-control form-control-solid" required placeholder="Fill Email" name="email">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            {{-- <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Mobile Phone</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" name="mobile_phone">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div> --}}
                                                            <div class="col-lg-12 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Phone</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" name="kontak" placeholder="Phone Number">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Place of Birth</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-solid" placeholder="Place of Birth" name="place_of_birth">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="required fw-bold">Birthdate</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" required placeholder="Birthdate" name="birthdate">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="required fw-bold">Marital Status</span>
                                                                </label>
                                                                <select required class="drop-data form-select form-select-solid" data-control="maritial_status" name="maritial_status">
                                                                    <option value="" selected hidden disabled>Select Status</option>
                                                                    <option value="Belum Kawin" >Belum Kawin</option>
                                                                    <option value="Kawin" >Kawin</option>
                                                                    <option value="Cerai Hidup" >Cerai Hidup</option>
                                                                    <option value="Cerai Mati" >Cerai Mati</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Gender</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="status" name="status">
                                                                    <option value="Laki-laki" >Laki-laki</option>
                                                                    <option value="Perempuan" >Perempuan</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="required fw-bold">Religion</span>
                                                                </label>
                                                                <select required class="drop-data form-select form-select-solid" data-control="religion" name="religion">
                                                                    <option value="" selected hidden disabled>Select Religion</option>
                                                                    <option value="Islam" >Islam</option>
                                                                    <option value="Kristen" >Kristen</option>
                                                                    <option value="Katolik" >Katolik</option>
                                                                    <option value="Buddha" >Buddha</option>
                                                                    <option value="Hindu" >Hindu</option>
                                                                    <option value="Konghucu" >Konghucu</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Blood Type</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="blood_type" name="blood_type">
                                                                    <option value="" selected hidden disabled>Select Blood Type</option>
                                                                    <option value="A" >A</option>
                                                                    <option value="B" >B</option>
                                                                    <option value="AB" >AB</option>
                                                                    <option value="O" >O</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                        </section>

                                                        <hr class="my-10">

                                                        {{-- Identity & Address --}}
                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>Identity & Address</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">Employee identity address information</span>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Identity Type</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="indentity_type" name="indentity_type">
                                                                    <option value="" selected hidden disabled>Identity Type</option>
                                                                    <option value="Type 1" >Type 1</option>
                                                                    <option value="Type 2" >Type 2</option>
                                                                    <option value="TYpe 3" >TYpe 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Identity Number</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Identity Number" name="identity_number">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Identity Expiry Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" placeholder="Select Date" name="identity_expiry_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="fw-bold">Postal Code</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Postal Code" name="postal_code">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="permanent" id="permanent" value=false>
                                                                <label class="fs-6 form-check-label mb-2" for="permanent">
                                                                    <span class="fw-bold">Permanent</span>
                                                                </label>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="citizen_id_address">
                                                                    <span class="fw-bold">Citizen ID Address</span>
                                                                </label>
                                                                <textarea name="citizen_id_address" id="citizen_id_address" class="form-control form-control-solid" placeholder="Citizen ID Address"></textarea>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="use_as_residential" id="use_as_residential" value=false>
                                                                <label class="fs-6 form-check-label mb-2" for="use_as_residential">
                                                                    <span class="fw-bold">Use as residential address</span>
                                                                </label>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="residential_address">
                                                                    <span class="fw-bold">Residential Address</span>
                                                                </label>
                                                                <textarea name="residential_address" id="residential_address" class="form-control form-control-solid" placeholder="Residential Address"></textarea>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="flex-column" data-kt-stepper-element="content">
                                                    <div class="row">

                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>Employment Data</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">Fill all employment data information relate to company</span>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="employee_id">
                                                                    <span class="required fw-bold">Employee ID</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-solid" name="employee_id" required placeholder="Employee ID">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                    <span class="required fw-bold">Employment Status</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="employment_status" required name="employment_status">
                                                                    <option value="" selected hidden disabled>Employment Status</option>
                                                                    <option value="Status 1" >Status 1</option>
                                                                    <option value="Status 2" >Status 2</option>
                                                                    <option value="Status 3" >Status 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="join_date">
                                                                    <span class="required fw-bold">Join Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" required name="join_date" id="join_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="end_status_date">
                                                                    <span class="required fw-bold">End Status Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" required name="end_status_date" id="end_status_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="branch">
                                                                    <span class="required fw-bold">Branch</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="branch" required name="branch" id="branch">
                                                                    <option value="Pusat" >Pusat</option>
                                                                    <option value="Cabang" >Cabang</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="organization">
                                                                    <span class="required fw-bold">Organization</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="organization" required name="organization" id="organization">
                                                                    <option value="" selected hidden disabled>Select Organization</option>
                                                                    <option value="Organization 1" >Organization 1</option>
                                                                    <option value="Organization 2" >Organization 2</option>
                                                                    <option value="Organization 3" >Organization 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="job_position">
                                                                    <span class="required fw-bold">Job Position</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="job_position" required name="job_position" id="job_position">
                                                                    <option value="" selected hidden disabled>Select Job Position</option>
                                                                    <option value="Job Position 1" >Job Position 1</option>
                                                                    <option value="Job Position 2" >Job Position 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="job_level">
                                                                    <span class="required fw-bold">Job Level</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="job_level" required name="job_level" id="job_level">
                                                                    <option value="" selected hidden disabled>Select Job Level</option>
                                                                    <option value="Job Level 1" >Job Level 1</option>
                                                                    <option value="Job Level 2" >Job Level 2</option>
                                                                    <option value="Job Level 3" >Job Level 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="grade">
                                                                    <span class="required fw-bold">Grade</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="grade" required name="grade" id="grade">
                                                                    <option value="" selected hidden disabled>Select Grade</option>
                                                                    <option value="Grade 1" >Grade 1</option>
                                                                    <option value="Grade 2" >Grade 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="class">
                                                                    <span class="required fw-bold">Class</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="class" required name="class" id="class">
                                                                    <option value="" selected hidden disabled>Select Class</option>
                                                                    <option value="Class 1" >Class 1</option>
                                                                    <option value="Class 2" >Class 2</option>
                                                                    <option value="Class 3" >Class 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="schedule">
                                                                    <span class="required fw-bold">Schedule</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="schedule" required name="schedule" id="schedule">
                                                                    <option value="" selected hidden disabled>Select Schedule</option>
                                                                    <option value="Schedule 1" >Schedule 1</option>
                                                                    <option value="Schedule 2" >Schedule 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="approval_line">
                                                                    <span class="required fw-bold">Approval Line</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="approval_line" required name="approval_line" id="approval_line">
                                                                    <option value="" selected hidden disabled>Select Approval Line</option>
                                                                    <option value="Approval Line 1" >Approval Line 1</option>
                                                                    <option value="Approval Line 2" >Approval Line 2</option>
                                                                    <option value="Approval Line 3" >Approval Line 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="Barcode">
                                                                    <span class="fw-bold">Barcode</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-solid" placeholder="Barcode" name="Barcode" id="Barcode">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="flex-column" data-kt-stepper-element="content">
                                                    <div class="row">

                                                        {{-- Salary --}}
                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>Salary</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">Input employment salary information</span>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="basic_salary">
                                                                    <span class="required fw-bold">Basic Salary</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="text" class="form-control form-control-solid" required placeholder="0" name="basic_salary" id="basic_salary">
                                                                </div>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="salary_type">
                                                                    <span class="fw-bold">Salary Type</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="salary_type" name="salary_type" id="salary_type">
                                                                    <option value="Monthly" >Monthly</option>
                                                                    <option value="Yearly" >Yearly</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="payment_schedule">
                                                                    <span class="fw-bold">Payment Schedule</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="payment_schedule" name="payment_schedule" id="payment_schedule">
                                                                    <option value="Payment Schedule 1" >Payment Schedule 1</option>
                                                                    <option value="Payment Schedule 2" >Payment Schedule 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="prorate_setting">
                                                                    <span class="fw-bold">Prorate Setting</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="prorate_setting" name="prorate_setting" id="prorate_setting">
                                                                    <option value="" selected hidden disabled>Select Prorate Setting</option>
                                                                    <option value="Prorate Setting 1" >Prorate Setting 1</option>
                                                                    <option value="Prorate Setting 2" >Prorate Setting 2</option>
                                                                    <option value="Prorate Setting 3" >Prorate Setting 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="allowed_for_overtime">
                                                                    <span class="fw-bold">Allowed for Overtime</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="allowed_for_overtime" name="allowed_for_overtime" id="allowed_for_overtime">
                                                                    <option value="1" >Iya</option>
                                                                    <option value="0" >Tidak</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_working_day">
                                                                    <span class="fw-bold">Overtime Working Day Default</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="overtime_working_day" name="overtime_working_day" id="overtime_working_day">
                                                                    <option value="" selected hidden disabled>Select Overtime Working Day Default</option>
                                                                    <option value="Overtime Working Day Default 1" >Overtime Working Day Default 1</option>
                                                                    <option value="Overtime Working Day Default 2" >Overtime Working Day Default 2</option>
                                                                    <option value="Overtime Working Day Default 3" >Overtime Working Day Default 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_day_off">
                                                                    <span class="fw-bold">Overtime Day Off Default</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="overtime_day_off" name="overtime_day_off" id="overtime_day_off">
                                                                    <option value="" selected hidden disabled>Select Overtime Day Off Default</option>
                                                                    <option value="Overtime Day Off Default 1" >Overtime Day Off Default 1</option>
                                                                    <option value="Overtime Day Off Default 2" >Overtime Day Off Default 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="overtime_national_holiday">
                                                                    <span class="fw-bold">Overtime National Holiday Default</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="overtime_national_holiday" name="overtime_national_holiday" id="overtime_national_holiday">
                                                                    <option value="" selected hidden disabled>Select Overtime National Holiday Default</option>
                                                                    <option value="Overtime National Holiday Default 1" >Overtime National Holiday Default 1</option>
                                                                    <option value="Overtime National Holiday Default 2" >Overtime National Holiday Default 2</option>
                                                                    <option value="Overtime National Holiday Default 3" >Overtime National Holiday Default 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                        </section>

                                                        <hr class="my-10">

                                                        {{-- Bank Account --}}
                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>Bank Account</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">The employee's bank account is used for payroll</span>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="bank_name">
                                                                    <span class="fw-bold">Bank Name</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="bank_name" name="bank_name" id="bank_name">
                                                                    <option value="" selected hidden disabled>Select Bank Name</option>
                                                                    <option value="Bank Name 1" >Bank Name 1</option>
                                                                    <option value="Bank Name 2" >Bank Name 2</option>
                                                                    <option value="Bank Name 3" >Bank Name 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="account_number">
                                                                    <span class="fw-bold">Account Number</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="account_number" name="account_number" id="account_number">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="account_holder_name">
                                                                    <span class="fw-bold">Account Holder Name</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-solid" placeholder="account_holder_name" name="account_holder_name" id="account_holder_name">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                        </section>

                                                        <hr class="my-10">

                                                        {{-- Tax Configuration --}}
                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>Tax Configuration</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">Select the tax calculation type to your company</span>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="npwp">
                                                                    <span class= fw-bold">NPWP</span>
                                                                </label>
                                                                <input type="text" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}.[0-9]{1}-[0-9]{3}.[0-9]{3}" class="form-control form-control-solid" placeholder="00.000.000.0-000.000" name="npwp" id="npwp">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ptkp_status">
                                                                    <span class="required fw-bold">PTKP Status</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="ptkp_status" required name="ptkp_status" id="ptkp_status">
                                                                    <option value="" selected hidden disabled>Select PTKP Status</option>
                                                                    <option value="PTKP Status 1" >PTKP Status 1</option>
                                                                    <option value="PTKP Status 2" >PTKP Status 2</option>
                                                                    <option value="PTKP Status 3" >PTKP Status 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_method">
                                                                    <span class="fw-bold">TAX Method</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="tax_method" name="tax_method" id="tax_method">
                                                                    <option value="TAX Method 1" >Gross</option>
                                                                    <option value="TAX Method 2" >TAX Method 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="tax_salary">
                                                                    <span class="fw-bold">Tax Salary</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="tax_salary" name="tax_salary" id="tax_salary">                                                                    <option value="Tax Salary 1" >Tax Salary 1</option>
                                                                    <option value="Tax Salary 2" >Taxable</option>
                                                                    <option value="Tax Salary 3" >Tax Salary 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="taxable_date">
                                                                    <span class= fw-bold">Taxable Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" placeholder="Select Date" name="taxable_date" id="taxable_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ptkp_status">
                                                                    <span class="fw-bold">Employment TAX Status</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="ptkp_status" name="ptkp_status" id="ptkp_status">
                                                                    <option value="Pegawai Tetap" >Pegawai Tetap</option>
                                                                    <option value="Pegawai Sementara" >Pegawai Sementara</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="beginning_netto">
                                                                    <span class="fw-bold">Beginning Netto</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="text" class="form-control form-control-solid" placeholder="0" name="beginning_netto" id="beginning_netto">
                                                                </div>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="pph21_paid">
                                                                    <span class="fw-bold">PPH21 Paid</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="text" class="form-control form-control-solid" placeholder="0" name="pph21_paid" id="pph21_paid">
                                                                </div>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                        </section>

                                                        <hr class="my-10">

                                                        {{-- BPJS Configurtion --}}
                                                        <section class="row">
                                                            <div class="col-lg-12 mb-9">
                                                                <h4>BPJS Configurtion</h4>
                                                                <span class="fs-7 fw-semibold text-gray-500">Employee BPJS payment arrangements</span>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_number">
                                                                    <span class= fw-bold">BPJS Ketenagakerjaan Number</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="BPJS Ketenagakerjaan Number" name="ketenagakerjaan_number" id="ketenagakerjaan_number">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_npp">
                                                                    <span class="fw-bold">NPP BPJS Ketenagakerjaan</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="ketenagakerjaan_npp" name="ketenagakerjaan_npp" id="ketenagakerjaan_npp">
                                                                    <option value="" selected hidden disabled>Select NPP BPJS Ketenagakerjaan</option>
                                                                    <option value="NPP BPJS Ketenagakerjaan 1" >NPP BPJS Ketenagakerjaan 1</option>
                                                                    <option value="NPP BPJS Ketenagakerjaan 2" >NPP BPJS Ketenagakerjaan 2</option>
                                                                    <option value="NPP BPJS Ketenagakerjaan 3" >NPP BPJS Ketenagakerjaan 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ketenagakerjaan_date">
                                                                    <span class= fw-bold">BPJS Ketenagakerjaan Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" placeholder="BPJS Ketenagakerjaan Date" name="ketenagakerjaan_date" id="ketenagakerjaan_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_number">
                                                                    <span class= fw-bold">BPJS Kesehatan Number</span>
                                                                </label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="BPJS Kesehatan Number" name="kesehatan_number" id="kesehatan_number">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_family">
                                                                    <span class="fw-bold">BPJS Kesehatan Family</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="kesehatan_family" name="kesehatan_family" id="kesehatan_family">
                                                                    <option value="" selected hidden disabled>Select BPJS Kesehatan Family</option>
                                                                    <option value="BPJS Kesehatan Family 1" >BPJS Kesehatan Family 1</option>
                                                                    <option value="BPJS Kesehatan Family 2" >BPJS Kesehatan Family 2</option>
                                                                    <option value="BPJS Kesehatan Family 3" >BPJS Kesehatan Family 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_date">
                                                                    <span class= fw-bold">BPJS Kesehatan Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" placeholder="BPJS Kesehatan Date" name="kesehatan_date" id="kesehatan_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="kesehatan_cost">
                                                                    <span class="fw-bold">BPJS Kesehatan Cost</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="kesehatan_cost" name="kesehatan_cost" id="kesehatan_cost">
                                                                    <option value="By Employee" >By Employee</option>
                                                                    <option value="BPJS Kesehatan Cost 2" >BPJS Kesehatan Cost 2</option>
                                                                    <option value="BPJS Kesehatan Cost 3" >BPJS Kesehatan Cost 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="jht_cost">
                                                                    <span class="fw-bold">JHT Cost</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="jht_cost" name="jht_cost" id="jht_cost">
                                                                    <option value="By Employee" >By Employee</option>
                                                                    <option value="BPJS Kesehatan Cost 2" >BPJS Kesehatan Cost 2</option>
                                                                    <option value="BPJS Kesehatan Cost 3" >BPJS Kesehatan Cost 3</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_pensiun_cost">
                                                                    <span class="fw-bold">Jaminan Pensiun Cost</span>
                                                                </label>
                                                                <select class="drop-data form-select form-select-solid" data-control="jaminan_pensiun_cost" name="jaminan_pensiun_cost" id="jaminan_pensiun_cost">
                                                                    <option value="By Employee" >By Employee</option>
                                                                    <option value="Jaminan Pensiun Cost 2" >Jaminan Pensiun Cost 2</option>
                                                                </select>
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="d-flex align-items-center fs-6 form-label mb-2" for="jaminan_pensiun_date">
                                                                    <span class= fw-bold">Jaminan Pensiun Date</span>
                                                                </label>
                                                                <input type="date" class="form-control form-control-solid" placeholder="Jaminan Pensiun Date" name="jaminan_pensiun_date" id="jaminan_pensiun_date">
                                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="flex-column" data-kt-stepper-element="content">
                                                    <div class="m-auto p-10">
                                                        <img src="" alt="">
                                                        <div class="m-auto">
                                                            <h4 class="text-center">Invite the employee to access CMT-EMP</h4>
                                                            <p class="text-center">You have successfully added employee data. To continue the process, you can invite employees to access CMT-EMP.</p>
                                                        </div>
                                                        <div class="m-auto align-items-center justify-content-center">
                                                            <div class="p-10 rounded row align-items-center justify-content-center" style="background-color: #f1f5fb69">
                                                                <div class="col-lg-12 mb-4">
                                                                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="invite_to_cmt-emp" id="invite_to_cmt-emp" value=false>
                                                                    <label class="fw-bold mb-2" for="invite_to_cmt-emp">
                                                                        <span class="fw-bold">Invite to CMT-EMP</span>
                                                                    </label><br>
                                                                    <span class="fw-bold">Invite to give them access to platform using Employee Self Service feature. You can do this later at settings page</span>
                                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                                </div>

                                                                <div class="col-lg-12 mb-4">
                                                                    <label class="d-flex align-items-center fs-6 form-label" for="jht_cost">
                                                                        <span class="fw-bold">Role Access</span>
                                                                    </label>
                                                                    <select class="drop-data form-select" data-control="jht_cost" name="jht_cost" id="jht_cost">
                                                                        <option value="By Employee" >Select Role Access</option>
                                                                        <option value="Role Access 1" >Role Access 1</option>
                                                                        <option value="ROle Access 2" >ROle Access 2</option>
                                                                    </select>
                                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                                </div>

                                                                <div class="col-lg-12 mb-3">
                                                                    <input type="checkbox" class="form-check-input checkbox-real" placeholder="" name="use_onboarding" id="use_onboarding" value=false>
                                                                    <label class="fw-bold mb-2" for="use_onboarding">
                                                                        <span class="fw-bold">Use onboarding for this employee</span>
                                                                    </label>
                                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-6 d-flex flex-stack">
                                                <div class="me-2">
                                                    {{-- <button type="button" class="btn btn-sm btn-light me-3 w-lg-200px" id="cancelBtn" data-kt-stepper-action="first">
                                                        Cancel
                                                    </button> --}}
                                                    <button type="button" class="btn btn-sm btn-light me-3 w-lg-200px" data-kt-stepper-action="previous">
                                                        Kembali
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="submit" id="kt_modal_create_survey_result_internet_submit" class="btn btn-sm btn-info w-lg-200px" data-kt-stepper-action="submit">
                                                        <span class="indicator-label">Simpan</span>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-info w-lg-200px" data-kt-stepper-action="next">
                                                        Selanjutnya
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const formEmp = document.querySelector(".kt_stepper_form_emp");
        const formEmpStepper = new KTStepper(formEmp);

        formEmpStepper.on("kt.stepper.next", function (stepper) {
            const state = $('#kt_create_emp_form').valid();
            if (state) {
                stepper.goNext();
            }
        });

        formEmpStepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious();
        });

    })
</script>
@endsection
