@extends('layouts.app')
@section('title-apps', 'CMT-PROMAG')
@section('sub-title-apps', 'Commercial')
@section('desc-apps', 'Pusing Kerja?, PROMAG solusi nya!')
@section('icon-apps', 'fa-solid fa-briefcase')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('summary-page')
    {{-- <div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataUser->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Pegawai</span>
</div>
<div class="col-lg-3 col-6 mb-6 mb-md-0 text-center text-md-start">
    <span class="mb-0 fs-4 fw-bolder d-block text-white">{{$dataDivision->count()}}</span>
    <span class="mb-0 fs-6 fw-bold" style="color:#ad87ff">Total Divisi</span>
</div> --}}
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-6 align-items-center">
                                <div class="col-lg-6 gap-3 d-flex align-items-center">
                                    <span class="fs-7 text-uppercase fw-bolder text-dark d-none d-md-block">Create New
                                        Project</span>
                                </div>
                            </div>
                            <form action="{{route("com.promag.store")}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Bill of Quantity</span>
                                        </label>
                                        <select class="drop-data form-select form-select-solid" data-control="select2"
                                            required name="itemable_bill_of_quantities_id">
                                            <option value="" selected hidden disabled>Pilih Dulu</option>
                                            @foreach ($dataBOQ as $data)
                                                <option value="{{ $data->id }}">{{ $data->prospect->prospect_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="work_name">
                                            <span class="fw-bold">Work Name</span>
                                        </label>
                                        <input type="text" value="{{ old('work_name') }}"
                                            class="form-control form-control-solid" placeholder="Work Name" name="work_name"
                                            id="work_name" @cannot('HC:update-profile') disabled @endcannot>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="no_project">
                                            <span class="fw-bold">No Project</span>
                                        </label>
                                        <input type="number" value="{{ old('no_project') }}"
                                            class="form-control form-control-solid" placeholder="No Project"
                                            name="no_project" id="no_project"
                                            @cannot('HC:update-profile') disabled @endcannot>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="work_location">
                                            <span class="fw-bold">No PO Customer</span>
                                        </label>
                                        <input type="number" value="{{ old('no_po_customer') }}"
                                            class="form-control form-control-solid" placeholder="No PO Customer"
                                            name="no_po_customer" id="no_po_customer"
                                            @cannot('HC:update-profile') disabled @endcannot>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="work_location">
                                            <span class="fw-bold">Work Location</span>
                                        </label>
                                        <input type="text" value="{{ old('work_location') }}"
                                            class="form-control form-control-solid" placeholder="Work Name"
                                            name="work_location" id="work_location"
                                            @cannot('HC:update-profile') disabled @endcannot>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="fw-bold required">Coordinate</span>
                                        </label>
                                        <div id="map" style="height: 400px; width: 100%;"></div>
                                        <input type="text" id="lat" name="lat" value="" hidden required>
                                        <input type="text" id="lang" name="lang" value="" hidden required>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2" for="work_desc">
                                            <span class="fw-bold">Description</span>
                                        </label>
                                        <textarea class="form-control form-control-solid" name="work_desc" id="work_desc" cols="10" rows="10"></textarea>
                                    </div>
                                    <div class="col-lg-12 mb-3 text-center">
                                        <button type="button" class="btn btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            let map = L.map('map').setView([-1.2495105, 116.8749959], 7);

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

                $('#lat').val(lat);
                $('#lang').val(lng);
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
@endsection
