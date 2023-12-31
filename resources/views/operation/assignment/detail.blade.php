@extends('layouts.app')
@section('title-apps', 'Assignment')
@section('sub-title-apps', 'Operation')
@section('desc-apps', 'Buat surat dulu, Jalan kemudian')
@section('icon-apps', 'fa-solid fa-file-alt')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-6 text-center">
                                <h4>Assignment Details</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <div class="form row">
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Di terbitkan oleh</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->user->name }} | {{ $assignment->user->department->department_name }}">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Nama Project</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->name }}">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Nomor Project</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->number }}">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Start Date</span>
                                        </label>
                                        <input type="date" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->start_date }}">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">End Date</span>
                                        </label>
                                        <input type="date" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->end_date }}">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold required">Coordinate</span>
                                        </label>
                                        <div id="map" style="height: 350px"></div>
                                    </div>

                                    {{-- <div class="col-lg-12 row mb-3"> --}}
                                        <div class="col-lg-12 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Lokasi</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" disabled
                                                value="{{ $assignment->location }}">
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Radius (meter)</span>
                                            </label>
                                            <input type="number" class="form-control form-control-solid" disabled
                                                value="{{ $assignment->radius }}">
                                        </div>

                                        {{-- <div class="col-lg-12 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                                    disabled @if ($assignment->override_holiday) checked @endif>
                                                <label class="fs-7 form-check-label mb-2" for="override_holiday">
                                                    <span class="fw-bold">Kerja di hari libur</span>
                                                </label>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-lg-12 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Hari Penugasan</span>
                                            </label>
                                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                                                @php
                                                    $workingDays = $assignment->assignmentWorkSchedules->pluck('day')->toArray();
                                                @endphp
                                                @foreach ($days as $day)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" disabled
                                                            @if (in_array($day, $workingDays)) checked @endif>
                                                        <label class="fs-7 form-check-label mb-2" for="work_schedule[]">
                                                            <span class="fw-bold">{{ $day }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-lg-6 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Working Start</span>
                                            </label>
                                            <input type="time" class="form-control form-control-solid" disabled
                                                value="{{ date('H:i', strtotime($assignment->working_start)) }}">
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Working End</span>
                                            </label>
                                            <input type="time" class="form-control form-control-solid" disabled
                                                value="{{ date('H:i', strtotime($assignment->working_end)) }}">
                                        </div> --}}
                                    {{-- </div> --}}

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 mb-2">
                                            <span class="fw-bold textd-dark">Signed By</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->signedBy->name }}">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold">Tujuan</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled
                                            value="{{ $assignment->purpose }}">
                                    </div>

                                    <hr class="mb-5 mt-4">

                                    <div class="col-lg-12 mb-6">
                                        <h4 class="required">Assign To</h4>
                                    </div>

                                    <div class="col-lg-12 mb-3" id="people_container">
                                        @foreach ($assignment->userAssignments as $user)
                                            @if ($user->user_id)
                                                <div class="col-lg-12 row justify-content-center mb-3">
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="CMT {{ $user->user->name }}" disabled>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="{{ $user->user->userEmployment->employee_id }}"
                                                            disabled>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="{{ $user->user->division->divisi_name }}" disabled>
                                                    </div>
                                                    @if ($assignment->status == $statusEnum[1])
                                                        <div class="col-lg-1">
                                                            <div id="print-{{ $user->id }}" hidden></div>
                                                            <button type="button"
                                                                onclick="(() => {
                                                                    const element = `<iframe src='{{ route('opt.asign.export-pdf', [
                                                                        'assignment' => $assignment->id,
                                                                        'user' => $user->id,
                                                                    ]) }}'></iframe>`;
                                                                    $('#print-{{ $user->id }}').html(element);
                                                                })()"
                                                                class="btn btn-danger btn-sm me-4 d-flex justify-content-center align-items-center">
                                                                <p class="mb-0">Pdf</p>
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-1">
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="col-lg-12 row justify-content-center mb-3">
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="Non-CMT {{ $user->name }}" disabled>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="{{ $user->nik }}" disabled>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="{{ $user->position }}" disabled>
                                                    </div>
                                                    @if ($assignment->status == $statusEnum[1])
                                                        <div class="col-lg-1">
                                                            <div id="print-{{ $user->id }}" hidden></div>
                                                            <button type="button"
                                                                onclick="(() => {
                                                                    const element = `<iframe src='{{ route('opt.asign.export-pdf', [
                                                                        'assignment' => $assignment->id,
                                                                        'user' => $user->id,
                                                                    ]) }}'></iframe>`;
                                                                    $('#print-{{ $user->id }}').html(element);
                                                                })()"
                                                                class="btn btn-danger btn-sm me-4 d-flex justify-content-center align-items-center">
                                                                <p class="mb-0">Pdf</p>
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-1">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-lg-12 mt-8 mb-4 d-flex justify-content-center">
                                        @switch($assignment->status)
                                            @case($statusEnum[0])
                                                @if ($assignment->user_id == Auth::user()->id)
                                                    <button type="reset" id="assignment_cancel"
                                                        class="btn btn-outline btn-outline-warning btn-sm me-3"
                                                        data-bs-dismiss="modal">
                                                        <i class="fas fa-times text-warning"></i>
                                                        Cancel
                                                    </button>

                                                    <a href="{{ route('opt.asign.edit', $assignment->id) }}"
                                                        class="btn btn-outline btn-outline-info btn-sm me-3">
                                                        <i class="fas fa-pencil text-info"></i>
                                                        Edit
                                                    </a>
                                                @endif

                                                @can('OPR:change-department-status-assignment')
                                                    <button id="assignment_reject"
                                                        class="btn btn-outline btn-outline-danger btn-sm me-3">
                                                        <i class="fas fa-times text-danger"></i>
                                                        Reject
                                                    </button>
                                                    <button id="assignment_approve"
                                                        class="btn btn-outline btn-outline-success btn-sm me-3">
                                                        <i class="fas fa-check text-success"></i>
                                                        Approve
                                                    </button>
                                                @endcan
                                            @break

                                            @case($statusEnum[1])
                                                <button type="reset" class="btn btn-success btn-sm me-3"
                                                    data-bs-dismiss="modal">
                                                    <i class="fas fa-check text-white"></i>
                                                    Approved
                                                </button>
                                            @break

                                            @case($statusEnum[2])
                                                <button type="reset" class="btn btn-danger btn-sm me-3"
                                                    data-bs-dismiss="modal">
                                                    <i class="fas fa-times text-white"></i>
                                                    Rejected
                                                </button>
                                            @break

                                            @case($statusEnum[3])
                                                <button type="reset" class="btn btn-warning btn-sm me-3"
                                                    data-bs-dismiss="modal">
                                                    <i class="fas fa-ban text-white"></i>
                                                    Canceled
                                                </button>
                                            @break

                                            @default
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            var latitude = '{{ $assignment->latitude }}';
            var longitude = '{{ $assignment->longitude }}';

            var map = L.map('map').setView([latitude, longitude], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
        });
    </script>
    @if ($assignment->user_id == Auth::user()->id)
    <script>
        $('#assignment_cancel').on('click', function() {
            $.ajax({
                url: "{{ route('opt.asign.cancel') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: {
                    id: '{{ $assignment->id }}'
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });
    </script>
    @endif
    @can('OPR:change-department-status-assignment')
        @if ($assignment->status == $statusEnum[0])
            <script>
                $(document).ready(function() {
                    $('#assignment_reject').on('click', function() {
                        $.ajax({
                            url: "{{ route('opt.asign.update-status') }}",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            type: 'POST',
                            data: {
                                assignment_id: "{{ $assignment->id }}",
                                status: "{{ $statusEnum[2] }}",
                            },
                            success: function(data) {
                                toastr.success(data.message, 'Selamat 🚀 !');
                                setTimeout(function() {
                                    window.location.href = "{{ route('opt.asign.index') }}";
                                }, 1000);
                            },
                            error: function(xhr, status, error) {
                                const data = xhr.responseJSON;
                                toastr.error(data.message, 'Opps!');
                            }
                        });
                    })

                    $('#assignment_approve').on('click', function() {
                        $.ajax({
                            url: "{{ route('opt.asign.update-status') }}",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            type: 'POST',
                            data: {
                                assignment_id: "{{ $assignment->id }}",
                                status: "{{ $statusEnum[1] }}",
                            },
                            success: function(data) {
                                toastr.success(data.message, 'Selamat 🚀 !');
                                setTimeout(function() {
                                    window.location.href = "{{ route('opt.asign.index') }}";
                                }, 1000);
                            },
                            error: function(xhr, status, error) {
                                const data = xhr.responseJSON;
                                toastr.error(data.message, 'Opps!');
                                setTimeout(function() {
                                    window.location.href = "{{ route('opt.asign.index') }}";
                                }, 2000);
                            }
                        });
                    })
                });
            </script>
        @endif
    @endcan
@endsection
