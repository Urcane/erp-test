@extends('layouts.app')
@section('title-apps', 'Set Permission')
@section('sub-title-apps', 'HC & Legal')
@section('desc-apps', 'Hak yang dimiliki karyawan dalam website')
@section('icon-apps', 'fa-solid fa-users')

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
                    <div class="card">
                        <div class="card-body">
                            <div class="mx-5 mx-lg-15 my-9">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="symbol symbol-125px">
                                            @if ($user->foto_file == null)
                                                <img alt="User" src="{{ asset('sense') }}/media/avatars/blank.png" />
                                            @else
                                                <img alt="User"
                                                    src="{{ asset('sense') }}/media/foto_pegawai/{{ $user_foto_file }}" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-10 row">
                                        <div class="col-lg-4">
                                            <span><i style="color: rgb(114,57,234)"
                                                    class="me-2 mb-2 fa-regular fa-user"></i> Employee Name</span>
                                            <h5>{{ $user->name }}</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <span><i style="color: rgb(114,57,234)"
                                                    class="me-2 mb-2 fa-solid fa-id-card-clip"></i> NIP</span>
                                            <h5>{{ $user->nip }}</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <span><i style="color: rgb(114,57,234)"
                                                    class="me-2 mb-2 fa-regular fa-building"></i> Branch</span>
                                            <h5>{{ $user->userEmployment->subBranch->name }}</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <span><i style="color: rgb(114,57,234)"
                                                    class="me-2 mb-2 fa-regular fa-building"></i> Department</span>
                                            <h5>{{ $user->department->department_name }}</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <span><i style="color: rgb(114,57,234)"
                                                    class="me-2 mb-2 fa-regular fa-id-card"></i> Job Level</span>
                                            <h5>{{ $user->getRoleNames()[0] }}</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <span><i style="color: rgb(114,57,234)"
                                                    class="me-2 mb-2 fa-regular fa-id-card"></i> Job Position</span>
                                            <h5>{{ $user->division->divisi_name }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <form id="assign_permission_form">
                                    <h4 class="text-center mt-20">Set Permission</h4>
                                    <div class="row p-6 mt-10 rounded border border-2 border-secondary">
                                        @foreach ($allFeature as $feature)
                                            @if ($feature->permissions_count > 4)
                                                <div class="col-lg-12">
                                                @else
                                                    <div class="col-lg-4">
                                            @endif
                                            <div class="col-lg-12">
                                                <input type="checkbox" class="form-check-input feature" placeholder=""
                                                    name="feature[]" id="{{ $feature->name }}"
                                                    value="{{ $feature->name }}">
                                                <label class="fw-bold mb-2" for="{{ $feature->name }}">
                                                    <span class="fw-bold">{{ $feature->name }}</span>
                                                </label>
                                            </div>
                                            <div class="row">
                                                @foreach ($feature->permissions as $permission)
                                                    @if ($feature->permissions_count > 5)
                                                        <div class="col-lg-4 col-md-2">
                                                        @else
                                                            <div class="col-lg-12">
                                                    @endif
                                                    <input type="checkbox"
                                                        class="permission form-check-input {{ $feature->name }}"
                                                        placeholder="" data-feature="{{ $feature->name }}" name="permissions[]" id="{{ $permission->name }}"
                                                        value="{{ $permission->name }}" @if (in_array($permission->name, $user->permissions->pluck('name')->toArray()) )
                                                            checked
                                                        @endif>
                                                    <label class="fw-bold mb-2" for="{{ $permission->name }}">
                                                        <span class="fw-bold">{{ $permission->name }}</span>
                                                    </label>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-lg-12 mt-10">
                            <div class="d-flex justify-content-center">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2">
                                    Reset
                                </button>

                                <button type="submit" class="btn btn-sm btn-primary">
                                    Apply
                                </button>
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
        $('.permission').map(function () {
            var featureId = $(this).data('feature')
            var allChecked = $("." + featureId + ":checked").length === $("." + featureId).length;
            $("#" + featureId).prop("checked", allChecked);
        })

        $(document).ready(function() {
            $('.permission').change(function() {
                var featureId = $(this).data('feature')
                var allChecked = $("." + featureId + ":checked").length === $("." + featureId).length;
                $("#" + featureId).prop("checked", allChecked);
            })

            $(".feature").change(function() {
                var featureId = $(this).attr("id");

                var isChecked = $(this).prop("checked");

                $("." + featureId).prop("checked", isChecked);
            });
        });
    </script>
    <script>
        $('#assign_permission_form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('hc.setting.permission.assignPermission', ['user' => $user->id]) }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('.feature').click
    </script>
@endsection
