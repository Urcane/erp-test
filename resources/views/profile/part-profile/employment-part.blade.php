<div class="row p-6 m-1 rounded border border-2 border-secondary">
    @can("HC:update-profile")
    <form id="kt_employment_content_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
        <input type="hidden" value="{{$user->id}}" name="user_id">
        @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif
        @endcan
        @include("hc.cmt-employee.part-form.form-employment-data")
        @can("HC:update-profile")
        <div class="col-lg-12 mt-9 text-end">
            <button type="submit" id="kt_employment_content_submit" class="btn btn-info btn-sm w-md-200px w-100">Simpan</button>
        </div>
    </form>

    <script>
        $('#kt_employment_content_form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('hc.emp.update.employment') }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    toastr.success(data.message,'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
            });
        });
    </script>

    @endcan
    {{-- Content --}}
</div>
