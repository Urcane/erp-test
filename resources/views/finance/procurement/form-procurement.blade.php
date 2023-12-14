@extends('layouts.app')
@section('title-apps', 'New Procurement')
@section('sub-title-apps', 'Procurement')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card p-10">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1">
                                    <a href="{{ url()->previous() }}" class="fw-bold"><i class="fa-solid fa-arrow-left "></i> Back</a>
                                </div>
                                <div class="col-lg-10 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Add New Procurement</span>
                                </div>

                                <form action="" id="form_procurement">
                                    <input type="hidden" value="{{$workList->id ?? ""}}" name="work_list_id">
                                    @include("finance.procurement.form-procurement-item-part.basic-form")
                                    <div class="text-center mt-9 mb-10">
                                        <button type="reset" id="modal_status_item_cancel"
                                            class="btn btn-sm btn-light me-3 w-lg-200px"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" id="modal_status_item_submit"
                                            class="btn btn-sm btn-info w-lg-200px">
                                            <span class="indicator-label">Submit</span>
                                        </button>
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
        $('#form_procurement').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('com.procurement.storeProcurement') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: formData,
                success: function(data) {
                    toastr.success(data.message,'Selamat 🚀 !');
                    setTimeout(function() {
                        @if ($workList->id ?? false)
                            window.location.href = "{{ route('com.promag.procurement', ['work_list_id' => $workList->id]) }}";
                        @else
                            window.location.href = "{{ route('com.procurement.index') }}";
                        @endif
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            })
        })
    </script>
    @endsection
