@extends('layouts.app')
@section('title-apps','Tambah Karyawan')
@section('sub-title-apps','HC & Legal')
@section('desc-apps','Database Pegawai Comtelindo')
@section('icon-apps','fa-solid fa-users')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<style>
    input.error {
    }

    label.error {
        color: red !important
    }
</style>

<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mx-5 mx-lg-15 my-9">
                            <form method="post" action="{{route('hc.emp.store')}}" id="kt_create_emp_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
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
                                                        <i class="stepper-number fa-solid fa-people-group fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                            <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                                <div class="stepper-wrapper d-flex align-items-center">
                                                    <div class="stepper-icon w-30px h-30px">
                                                        <i class="stepper-check fas fs-3 fa-check"></i>
                                                        <i class="stepper-number fs-3 fa-solid fa-money-bills"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                            <div class="stepper-item mx-8" data-kt-stepper-element="nav">
                                                <div class="stepper-wrapper d-flex align-items-center">
                                                    <div class="stepper-icon w-30px h-30px">
                                                        <i class="stepper-check fas fs-3 fa-check"></i>
                                                        <i class="stepper-number fs-3 fa-solid fa-user-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="stepper-line h-35px"></div>
                                            </div>
                                        </div>

                                        {{-- form --}}
                                        <div class=" mx-auto border border-2 border-secondary p-10 rounded">
                                            @if($errors->any())
                                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                                            @endif
                                            <div class="mb-10">
                                                <div class="flex-column current" data-kt-stepper-element="content">
                                                    <div class="row">

                                                        {{-- personal data --}}
                                                        @include("hc.cmt-employee.part-form.form-personal-data")

                                                        <hr class="my-10">

                                                        {{-- Identity & Address --}}
                                                        @include("hc.cmt-employee.part-form.form-identity-address")
                                                    </div>
                                                </div>
                                                <div class="flex-column" data-kt-stepper-element="content">
                                                    <div class="row">

                                                        {{-- Employment Data --}}
                                                        @include("hc.cmt-employee.part-form.form-employment-data")
                                                    </div>
                                                </div>
                                                <div class="flex-column" data-kt-stepper-element="content">
                                                    <div class="row">

                                                        {{-- Salary --}}
                                                        @include("hc.cmt-employee.part-form.form-salary")

                                                        <hr class="my-10">

                                                        {{-- Bank Account --}}
                                                        @include("hc.cmt-employee.part-form.form-bank-account")

                                                        <hr class="my-10">

                                                        {{-- Tax Configuration --}}
                                                        @include("hc.cmt-employee.part-form.form-tax-configuration")

                                                        <hr class="my-10">

                                                        {{-- BPJS Configurtion --}}
                                                        @include("hc.cmt-employee.part-form.form-bpjs-configuration")

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
            } else {
                var firstError = $(".error:first");

                $('html, body').animate({
                    scrollTop: firstError.offset().top - 100
                }, 500);
            }
        });

        formEmpStepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious();
        });

        function validate(input, required, length = 0) {
            if (required && input.val() == '') {
                input.after("<span class='fw-semibold fs-8 text-danger'>Input ini wajib diisi</span>")
                return;
            } else {
                if (!input.val() && input.val() != '') {
                    return;
                }
            }

            if (input.val().length < length) {
                input.after("<span class='fw-semibold fs-8 text-danger'>Masukan setidaknya "+length+" Karakter</span>")
                return;
            }

            return;
        }

    })
</script>
@endsection
