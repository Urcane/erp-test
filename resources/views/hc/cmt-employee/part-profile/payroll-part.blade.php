<div class="row p-6 m-1 rounded border border-2 border-secondary">
    <div class="d-grid">
        <ul class="nav nav-tabs flex-nowrap text-nowrap">
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-primary rounded-bottom-0 active" data-bs-toggle="tab" id="salary" href="#salary_content">Salary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="bank_account" href="#bank_account_content">Bank Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="tax_configuration" href="#tax_configuration_content">Tax Configuration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold btn btn-active-light btn-color-muted btn-active-color-warning rounded-bottom-0" data-bs-toggle="tab" id="bpjs_configuration" href="#bpjs_configuration_content">BPJS Configuration</a>
            </li>
        </ul>
    </div>
    <div class="tab-content mt-5" id="myTabContent">
        <div class="tab-pane fade show active" id="salary_content" role="tabpanel">
            <div class="row p-4">
                <div class="row">
                    {{-- salary --}}
                    @role("administrator")
                    <form id="kt_salary_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        @csrf
                        @endrole
                        @include("hc.cmt-employee.part-form.form-salary")
                        @role("administrator")
                        <div class="col-lg-12 mt-9 text-end">
                            <button type="submit" id="kt_salary_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                        </div>
                    </form>
                    @endrole
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tax_configuration_content" role="tabpanel">
            <div class="row p-4">
                @role("administrator")
                <form id="kt_tax_configuration_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    @endrole
                    @include("hc.cmt-employee.part-form.form-tax-configuration")
                    @role("administrator")
                    <div class="col-lg-12 mt-9 text-end">
                        <button type="submit" id="kt_tax_configuration_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                    </div>
                </form>
                @endrole
            </div>
        </div>
        <div class="tab-pane fade" id="bpjs_configuration_content" role="tabpanel">
            <div class="row p-4">
                @role("administrator")
                <form id="kt_bpjs_configuration_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    @endrole
                    @include("hc.cmt-employee.part-form.form-bpjs-configuration")
                    @role("administrator")
                    <div class="col-lg-12 mt-9 text-end">
                        <button type="submit" id="kt_bpjs_configuration_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                    </div>
                </form>
                @endrole
            </div>
        </div>
        <div class="tab-pane fade" id="bank_account_content" role="tabpanel">
            <div class="row p-4">
                @role("administrator")
                <form id="kt_bank_account_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    @endrole
                    @include("hc.cmt-employee.part-form.form-bank-account")
                    @role("administrator")
                    <div class="col-lg-12 mt-9 text-end">
                        <button type="submit" id="kt_bank_account_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
                    </div>
                </form>
                @endrole
            </div>
        </div>
    </div>
</div>
