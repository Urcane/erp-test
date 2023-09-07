<div class="modal fade" id="delete_confirmation_{{$id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="delete_confirmation_form_{{$id}}" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" value="" id="input_delete_confirmation_form_{{$id}}">
                    <div class="scroll-y me-n10 pe-10" id="modal_create_job_level_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_create_job_level_header"
                        data-kt-scroll-wrappers="#modal_create_job_level_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Are you sure?</span><br>
                                <span class="fs-7 fw-semibold text-gray-500">Do you really want to delete these records?
                                    This process cannot be undone.</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center row">
                        <button type="reset"
                            class="col btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="col btn btn-sm btn-danger w-lg-200px" data-bs-dismiss="modal">
                            <span class="indicator-label">Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function delete{{$id}}(id) {
        console.log($('#input_delete_confirmation_form_{{$id}}'));
        $('#input_delete_confirmation_form_{{$id}}').val(id);
    }

    $('#delete_confirmation_form_{{$id}}').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ $route }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            data: formData,
            success: function(data) {
                dataTable{{$id}}.ajax.reload();
                toastr.success(data.message, 'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    })
</script>
