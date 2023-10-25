@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Live Locations')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.8.0/dist/geosearch.css" />
    <style>
        #map {
            height: 300px;
        }
    </style>
    <div class="modal fade" id="modal_location" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_location_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Add branch location</span>
                            {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                        </div>
                        <div class="scroll-y me-n10 pe-10" id="modal_create_job_position_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_create_job_position_header"
                            data-kt-scroll-wrappers="#modal_create_job_position_scroll" data-kt-scroll-offset="300px">
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Name</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="name" required
                                    name="name">
                            </div>
                            <div class="row mb-9">
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="fw-bold required">Coordinate</span>
                                    </label>
                                    <div id="map"></div>
                                    <input type="text" id="latitude" name="latitude" readonly hidden required>
                                    <input type="text" id="longitude" name="longitude" readonly hidden required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Radius</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" placeholder="radius" required
                                    name="radius">
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_location_cancel" class="btn btn-sm btn-light me-3 w-lg-200px"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_location_submit" class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                    @include('hc.cmt-settings.sidebar')
                </div>
                <div class="col-lg-9 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-6 mb-9">
                                <h4>Branch Locations</h4>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <div>
                                    <a href="#modal_location" data-bs-toggle="modal" class="btn btn-info btn-sm me-3"
                                        id="trigger_modal"><i class="fa-solid fa-plus"></i>Add Location</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <table class="table align-top table-striped border table-rounded gy-5" id="tb_location">
                                    <thead class="">
                                        <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                            {{-- <th class="text-center w-50px">#</th> --}}
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-150px">name</th>
                                            <th class="w-150px">latitude</th>
                                            <th class="w-150px">longitude</th>
                                            <th class="w-150px">Radius</th>
                                            <th class="w-150px">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-7">
                                    </tbody>
                                </table>
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
        let marker;

        function addMarker(lat, lng, openPopup) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            if (openPopup) {
                marker.bindPopup('You are here!').openPopup();
            }
            map.setView([lat, lng], 20);

            $('#latitude').val(lat);
            $('#longitude').val(lng);
        }

        $("#trigger_modal").on("click", function() {
            $("input").val("");

            map.removeLayer(marker);
        })

        $(document).ready(function() {
            var existingCircle = null;
            let circleCenter = null;
            map = L.map('map').setView([-1.2495105, 116.8749959], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

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

                if (existingCircle) {
                    map.removeLayer(existingCircle);
                }

                circleCenter = [latitude, longitude];
                existingCircle = L.circle([latitude, longitude], {
                    color: 'orange',
                    fillColor: 'orange',
                    fillOpacity: 0.2,
                    radius: $('[name="radius"]').val() ? $('[name="radius"]').val() : 0
                }).addTo(map);

                addMarker(latitude, longitude, false);
            });

            $('[name="radius"]').on('keyup', function() {
                if (existingCircle) {
                    map.removeLayer(existingCircle);
                }

                existingCircle = L.circle(circleCenter, {
                    color: 'orange',
                    fillColor: 'orange',
                    fillOpacity: 0.2,
                    radius: $('[name="radius"]').val() ? $('[name="radius"]').val() : 0
                }).addTo(map);
            });

            $('#myModal').on('show.bs.modal', function() {
                setTimeout(function() {
                    map.invalidateSize();
                }, 10);
            });

            $('#trigger_modal').click(function() {

                setTimeout(function() {
                    map.invalidateSize()
                }, 400);
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

            console.log(input)
            console.log(form)
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
        let dataTableLocation

        function fillInput(id, latitude, longitude, radius ) {
            $("[name=\'id\']").val(id);
            $("[name=\'latitude\']").val(latitude);
            $("[name=\'longitude\']").val(longitude);
            $("[name=\'radius\']").val(radius);

            addMarker(latitude, longitude, false);

            setTimeout(function() {
                map.invalidateSize()
            }, 400);
        }

        $(document).ready(function() {
            dataTableLocation = $('#tb_location').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                buttons: [],
                ajax: {
                    url: "{{ route('hc.setting.live-location.getTableLocation', ['branchId' => $branch->id]) }}",
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                dom: "<'row mb-2'" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",

                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'latitude'
                    },
                    {
                        data: 'longitude'
                    },
                    {
                        data: 'radius'
                    },
                    {
                        data: 'action'
                    },
                ],

                columnDefs: [{
                        targets: 0,
                        className: 'text-center',
                    },
                    {
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
            });

            $('#modal_location_form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('hc.setting.live-location.createUpdate', ['branchId' => $branch->id]) }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#modal_location').modal('hide');
                        dataTableLocation.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });

            });
        })
    </script>

@endsection
