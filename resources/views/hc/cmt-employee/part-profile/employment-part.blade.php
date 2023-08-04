<div class="row p-6 m-1 rounded border border-2 border-secondary">
    @role("administrator")
    <form id="kt_employment_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
        @csrf
        @endrole
        @include("hc.cmt-employee.part-form.form-employment-data")
        @role("administrator")
        <div class="col-lg-12 mt-9 text-end">
            <button type="submit" id="kt_employment_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
        </div>
    </form>
    @endrole
    {{-- Content --}}
</div>
