@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Company Info')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
{{-- <link rel="stylesheet" href="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.css') }}"> --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<style>
    #map {
    height: 400px;
    }
</style>
<div class="row justify-content-center mt-n20">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center mt-md-n20">
            <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                @include('hc.cmt-settings.sidebar')
            </div>
            <div class="col-lg-9 mt-md-n14">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mt-5 mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Branch</span>
                                </div>
                                <div class="row p-6 m-1 rounded border border-2 border-secondary">
                                    <form action="{{ route('hc.setting.branch.createUpdate') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="company_id"
                                            value="{{ $subBranch->id ?? old('company_id') }}">
                                        <section class="row">
                                            <div class="col-12 mb-3 d-flex justify-content-center mt-5">
                                                <img src="{{ $subBranch->logo ?? null ? asset('storage/branch-logo/' . $subBranch->logo) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFmDTZFCydgh_teJfzp3Gxq88OgTC_VYdUUg&usqp=CAU' }}"
                                                    class="rounded-circle m-auto" style="width: 150px;"
                                                    alt="Avatar" />
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5">
                                                <label class="align-items-center fs-6 form-label" for="logo">
                                                    <span class="fw-bold">Logo Perusahaan</span>
                                                </label>
                                            </div>
                                            <div class="col-12 mb-3 d-flex justify-content-center">
                                                <input type="file" style="width: 112px"
                                                    class="form-control form-control-solid"
                                                    placeholder="Logo Perusahaan" name="logo" id="logo"
                                                    @cannot('HC:setting') disabled @endcannot>
                                            </div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="col-lg-6 mb-3 mt-5">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="name">
                                                    <span class="required fw-bold">Branch Name</span>
                                                </label>
                                                <input type="text" value="{{ $subBranch->name ?? old('name') }}"
                                                    class="form-control form-control-solid"
                                                    placeholder="Nama Perusahaan" name="name" id="name"
                                                    @cannot('HC:setting') disabled @endcannot required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3 mt-5">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="phone_number">
                                                    <span class="fw-bold required">Branch Phone Number</span>
                                                </label>
                                                <input type="number"
                                                    value="{{ $subBranch->phone_number ?? old('phone_number') }}"
                                                    class="form-control form-control-solid"
                                                    placeholder="Nomor yang dapat dihubungi" name="phone_number"
                                                    id="phone_number"
                                                    @cannot('HC:setting') disabled @endcannot required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="email">
                                                    <span class="fw-bold required">Email</span>
                                                </label>
                                                <input type="email" value="{{ $subBranch->email ?? old('email') }}"
                                                    class="form-control form-control-solid" placeholder="Email cabang"
                                                    name="email" id="email"
                                                    @cannot('HC:setting') disabled @endcannot required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="umr">
                                                    <span class="fw-bold required">UMR</span>
                                                </label>
                                                <input type="number" value="{{ $subBranch->umr ?? old('umr') }}"
                                                    class="form-control form-control-solid" placeholder="UMR"
                                                    name="umr" id="umr"
                                                    @cannot('HC:setting') disabled @endcannot required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="name">
                                                    <span class="fw-bold required">Address</span>
                                                </label>
                                                <textarea name="address" class="form-control form-control-solid" placeholder="Alamat lengkap perusahaan" id="address"
                                                    cols="30" rows="5" @cannot('HC:setting') disabled @endcannot required>{{ $subBranch->address ?? old('address') }}</textarea>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="city">
                                                            <span class="fw-bold required">City</span>
                                                        </label>
                                                        <input type="text"
                                                            value="{{ $subBranch->city ?? old('city') }}"
                                                            class="form-control form-control-solid" placeholder="Kota"
                                                            name="city" id="city"
                                                            @cannot('HC:setting') disabled @endcannot required>
                                                        <div class="fv-plugins-message-container invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="province">
                                                            <span class="fw-bold required">Province</span>
                                                        </label>
                                                        <input type="text"
                                                            value="{{ $subBranch->province ?? old('province') }}"
                                                            class="form-control form-control-solid"
                                                            placeholder="Provinsi" name="province" id="province"
                                                            @cannot('HC:setting') disabled @endcannot required>
                                                        <div class="fv-plugins-message-container invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold required">Coordinate</span>
                                                </label>
                                                <div id="map"></div>
                                                <input type="text" id="latitude" name="latitude" value="{{ ($subBranch->branchLocations ?? false) ? $subBranch->branchLocations->first()->latitude : old('latitude') }}" readonly hidden required>
                                                <input type="text" id="longitude" name="longitude" value="{{ ($subBranch->branchLocations ?? false) ? $subBranch->branchLocations->first()->longitude : old('longitude') }}" readonly hidden required>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="coordinate_radius">
                                                    <span class="fw-bold required">Office Radius (Meter)</span>
                                                </label>
                                                <input type="number" value="{{ ($subBranch->branchLocations ?? false) ? $subBranch->branchLocations->first()->radius : old('coordinate_radius') }}"
                                                    class="form-control form-control-solid" placeholder="40"
                                                    name="coordinate_radius" id="coordinate_radius"
                                                    @cannot('HC:setting') disabled @endcannot required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                    for="parent_id">
                                                    <span class="fw-bold required">Branch Parent</span>
                                                </label>
                                                <select class="drop-data form-select form-select-solid"
                                                    data-control="parent_id" name="parent_id" id="parent_id"
                                                    @cannot('HC:setting') disabled @endcannot required>
                                                    @foreach ($dataParent as $option)
                                                        <option value="{{ $option->id }}"
                                                            @if ($subBranch->parent_id ?? old('parent_id') == $option->id) selected @endif>
                                                            {{ $option->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>

                                            {{-- npwp Info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-9">
                                                    <div class="col-lg-12 mb-3">
                                                        <input type="checkbox" class="form-check-input checkbox-real"
                                                            placeholder="" name="npwp_same_parent"
                                                            id="npwp_same_parent">
                                                        <label class="fs-6 form-check-label mb-2"
                                                            for="npwp_same_parent">
                                                            <span class="fw-bold required">NPWP same with Parent Branch</span>
                                                        </label>
                                                        <div class="fv-plugins-message-container invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="tax" class="col-12 row">
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="npwp">
                                                            <span class="fw-bold required">Branch NPWP</span>
                                                        </label>
                                                        <input type="number"
                                                            value="{{ $subBranch->npwp ?? old('npwp') }}"
                                                            class="form-control form-control-solid"
                                                            placeholder="Company NPWP" name="npwp" id="npwp"
                                                            @cannot('HC:setting') disabled @endcannot required>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="tax_name">
                                                            <span class="fw-bold required">Branch Tax Name</span>
                                                        </label>
                                                        <input type="text"
                                                            value="{{ $subBranch->tax_name ?? old('tax_name') }}"
                                                            class="form-control form-control-solid" name="tax_name"
                                                            id="tax_name"
                                                            @cannot('HC:setting') disabled @endcannot required>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="tax_person_name">
                                                            <span class="fw-bold required">Tax Person</span>
                                                        </label>
                                                        <input type="text"
                                                            value="{{ $subBranch->tax_person_name ?? old('tax_person_name') }}"
                                                            class="form-control form-control-solid"
                                                            placeholder="Nama Perusahaan" name="tax_person_name"
                                                            id="tax_person_name"
                                                            @cannot('HC:setting') disabled @endcannot required>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                            for="tax_person_npwp">
                                                            <span class="fw-bold required">Tax Person NPWP</span>
                                                        </label>
                                                        <input type="number"
                                                            value="{{ $subBranch->tax_person_npwp ?? old('tax_person_npwp') }}"
                                                            class="form-control form-control-solid"
                                                            placeholder="Tax Person NPWP" name="tax_person_npwp"
                                                            id="tax_person_npwp"
                                                            @cannot('HC:setting') disabled @endcannot required>
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $("#npwp_same_parent").on("change", function() {
                                                        console.log($(this).val())
                                                        if ($(this).is(':checked')) {
                                                            $("#tax").hide();
                                                            $('#tax input').prop('disabled', true)
                                                            $('#tax input').prop('required', false)
                                                        } else {
                                                            $("#tax").show();
                                                            $('#tax input').prop('disabled', false);
                                                            $('#tax input').prop('required', true)
                                                        }
                                                    });
                                                </script>
                                            </section>

                                            {{-- Other Info --}}
                                            <section class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                        for="klu">
                                                        <span class="fw-bold required">Kode KLU (Klasifikasi Lapangan
                                                            Usaha)</span>
                                                    </label>
                                                    <input type="text" value="{{ $subBranch->klu ?? old('klu') }}"
                                                        class="form-control form-control-solid"
                                                        placeholder="Kode KLU (Klasifikasi Lapangan Usaha)" name="klu" id="klu"
                                                        @cannot('HC:setting') disabled @endcannot required>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                {{-- <div class="col-lg-6 mb-3">
                                                    <label class="d-flex align-items-center fs-6 form-label mb-2"
                                                        for="signature">
                                                        <span class="fw-bold required">Signature</span>
                                                    </label>
                                                    <input type="file"
                                                        value="{{ $subBranch->signature ?? old('signature') }}"
                                                        class="form-control form-control-solid"
                                                        placeholder="Nama Perusahaan" name="signature" id="signature"
                                                        @cannot('HC:setting') disabled @endcannot required>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    ini priview
                                                </div> --}}
                                            </section>

                                            <div class="mt-6 d-flex justify-content-center">
                                                <div class="me-2">
                                                    <a href="{{ route('hc.setting.branch.index') }}"
                                                        class="btn btn-sm btn-light me-3 w-lg-200px"
                                                        data-kt-stepper-action="previous">
                                                        Cancel
                                                    </a>
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                        id="kt_modal_create_survey_result_internet_submit"
                                                        class="btn btn-sm btn-info w-lg-200px"
                                                        data-kt-stepper-action="submit">
                                                        <span class="indicator-label">Simpan</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </section>

                                    </form>
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
    $(document).ready(function () {
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

            $('#latitude').val(lat);
            $('#longitude').val(lng);
        }

        function getCurrentLocation(event) {
            event.stopPropagation();

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
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

        let getLocationBtn = L.control({ position: 'bottomright' });

        getLocationBtn.onAdd = function () {
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

        map.on('click', function (e) {
            let latitude = e.latlng.lat.toFixed(6);
            let longitude = e.latlng.lng.toFixed(6);

            addMarker(latitude, longitude, false);
        });

        @if($subBranch->branchLocations ?? false)
            addMarker("{{ $subBranch->branchLocations->first()->latitude ?? old('latitude') }}", "{{ $subBranch->branchLocations->first()->longitude ?? old('longitude') }}", false);
        @endif
    });
</script>

@endsection
