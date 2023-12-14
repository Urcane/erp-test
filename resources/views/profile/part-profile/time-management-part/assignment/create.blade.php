@extends('layouts.app')
@section('title-apps', 'Assignment')
@section('sub-title-apps', 'Request')
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.8.0/dist/geosearch.css" />
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-6 text-center">
                                <h4>Request Assignment</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <form class="form row" enctype="multipart/form-data" id="assignment_form">
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Nama Penugasan</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Projek Maintenance" required name="name">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Nomor Surat</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="000/CMT-XX/XXX/VIII/0000" required name="number">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Start Date</span>
                                        </label>
                                        <input type="date" class="form-control form-control-solid" required
                                            name="start_date">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">End Date</span>
                                        </label>
                                        <input type="date" class="form-control form-control-solid" required
                                            name="end_date">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold required">Coordinate</span>
                                        </label>
                                        <div id="map" style="height: 370px"></div>
                                        <input type="text" id="latitude" name="latitude" readonly hidden required>
                                        <input type="text" id="longitude" name="longitude" readonly hidden required>
                                    </div>

                                    {{-- <div class="col-lg-12 row mb-3"> --}}
                                        <div class="col-lg-12 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="required fw-bold">Lokasi</span>
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Buntok Kalimantan Tengah" required name="location">
                                        </div>

                                        <div class="col-lg-12 mb-8" hidden>
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="required fw-bold">Radius (meter)</span>
                                            </label>
                                            <input type="number" class="form-control form-control-solid"
                                                placeholder="100000" required name="radius" value="1000">
                                        </div>

                                        <div class="col-lg-12 mb-3" hidden>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                                    name="override_holiday" id="override_holiday" checked>
                                                <label class="fs-7 form-check-label mb-2" for="override_holiday">
                                                    <span class="fw-bold">Kerja di hari libur Nasional</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-3" hidden>
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="required fw-bold">Hari Penugasan</span>
                                            </label>
                                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                                                @foreach ($days as $day)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="work_schedule[]" value="{{ $day }}"
                                                            checked >
                                                        <label class="fs-7 form-check-label mb-2"
                                                            for="work_schedule[]">
                                                            <span class="fw-bold">{{ $day }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3" hidden>
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Working Start</span>
                                            </label>
                                            <input type="time" class="form-control form-control-solid"
                                                name="working_start" value="00:02">
                                        </div>

                                        <div class="col-lg-6 mb-3" hidden>
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="fw-bold">Working End</span>
                                            </label>
                                            <input type="time" class="form-control form-control-solid"
                                                name="working_end" value="23:58">
                                        </div>
                                    {{-- </div> --}}

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 mb-2 required">
                                            <span class="fw-bold textd-dark">Signed By</span>
                                        </label>
                                        <select class="form-select form-select-solid" data-control="select2" required
                                            id="signed_by" name="signed_by">
                                            {{-- <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-nik="{{ $user->userEmployment->employee_id }}"
                                                    data-position="{{ $user->division->divisi_name }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach --}}
                                            <option value="{{ Auth::user()->userEmployment->approvalLine->id }}">
                                                {{ Auth::user()->userEmployment->approvalLine->name }} | {{ Auth::user()->userEmployment->approvalLine->division->divisi_name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Tujuan</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Maintenance Perangkat xxx di xxx PT.xxx" required name="purpose">
                                    </div>

                                    <div class="col-lg-12 mt-8 mb-4 d-flex justify-content-center">
                                        <button type="reset" id="cancel" onclick="window.history.back()"
                                            class="btn btn-outline btn-sm px-9 me-7">
                                            Cancel
                                        </button>
                                        <button id="submit" class="btn btn-outline btn-outline-info btn-sm px-9">
                                            Submit
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

    <script src="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.8.0/dist/geosearch.umd.js"></script>
    <script>
        let map;

        $(document).ready(function() {
            map = L.map('map').setView([-1.2495105, 116.8749959], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            let marker;

            function addMarker(lat, lng, openPopup) {
                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([lat, lng]).addTo(map);

                if (openPopup) {
                    marker.bindPopup('You are here!').openPopup();
                    map.setView([lat, lng], 19);
                }

                $('#latitude').val(lat);
                $('#longitude').val(lng);
            }

            function getCurrentLocation(event) {
                event.stopPropagation();

                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        let lat = position.coords.latitude;
                        let lng = position.coords.longitude;

                        if (marker) {
                            marker.closePopup();
                        }

                        addMarker(lat, lng, true);

                        $('#latitude').val(lat.toFixed(6));
                        $('#longitude').val(lng.toFixed(6));
                    });
                } else {
                    console.log("Geolocation is not available.");
                }
            }

            let getLocationBtn = L.control({
                position: 'bottomright'
            });

            getLocationBtn.onAdd = function() {
                let div = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
                div.innerHTML = `
                <button type="button" class="btn btn-info d-flex justify-content-center align-items-center"
                    style="width: 40px; height: 40px;"
                >
                    <i class="fas fa-location-crosshairs ms-1" style="font-size: 16px;"></i>
                </button>
            `;
                $(div).on('click', 'button', getCurrentLocation);
                return div;
            };

            getLocationBtn.addTo(map);

            map.on('click', function(e) {
                let latitude = e.latlng.lat.toFixed(6);
                let longitude = e.latlng.lng.toFixed(6);

                addMarker(latitude, longitude, false);
            });
        });
    </script>

    <script>
        const provider = new GeoSearch.OpenStreetMapProvider()
        const search = new GeoSearch.GeoSearchControl({
            provider: provider,
            style: 'bar',
            searchLabel: 'Balikpapan',
            autoClose: true,
        });
        $(document).ready(function() {
            map.addControl(search);
            const form = $('.leaflet-control-geosearch form');
            const input = $('.leaflet-control-geosearch form input.glass');
            const resultEl = $('.leaflet-control-geosearch form .results');

            const test = async (event, value) => {
                const results = await provider.search({
                    query: value
                });
                event.preventDefault();
                addMarker(results[0].y, results[0].x, false)
            }

            input.keydown(function(e) {
                if (e.which == 13) {
                    test(e, input.val());
                }
            });

            resultEl.click(function(e) {
                test(e, input.val());
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#assignment_form').on('submit', function(event) {
                event.preventDefault();
                const formData = $(this).serializeArray();

                $.ajax({
                    url: "{{ route('req.assignment.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        toastr.success(data.message, 'Selamat 🚀 !');
                        setTimeout(function() {
                            window.history.back();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });
        });
    </script>

@endsection
