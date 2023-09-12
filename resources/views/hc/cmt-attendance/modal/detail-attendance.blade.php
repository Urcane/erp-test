<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<div class="modal fade" id="detail_attendance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" id="attendance-modal-close"
                    data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-2 mb-2">
                <div class="col-lg-12 text-center mb-9">
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Attendances Log Details</span>
                    <span class="fs-7 fw-semibold text-gray-500"></span>
                </div>
                <div class="scroll-y me-n6 pe-6 row" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px">

                    <div class="col-lg-12 row" id="checkin">
                        <div class="col-lg-12 d-flex justify-content-center fw-semibold fs-4 mb-5">
                            Check In
                        </div>

                        <div class="col-lg-6">
                            <div id="map-in" style="height: 300px;" hidden></div>
                            <div id="no-map-in">Lokasi Tidak Tersedia</div>
                        </div>

                        <div class="col-lg-6">
                            <img style="max-width: 300px;" id="img-in"
                                src="https://cdn1.katadata.co.id/media/images/thumb/2022/11/10/Ilustrasi_Ciri-ciri_Orang_Yang_Bersyukur-2022_11_10-13_22_48_d368708753bdc5c3131472013522d76c_960x640_thumb.jpg">
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4"></div>

                    <div class="col-lg-12 row" id="checkout">
                        <div class="col-lg-12 d-flex justify-content-center fw-semibold fs-4 mb-5">
                            Check Out
                        </div>

                        <div class="col-lg-6">
                            <div id="map-out" style="height: 300px;"></div>
                            <div id="no-map-out">Lokasi Tidak Tersedia</div>
                        </div>

                        <div class="col-lg-6">
                            <img style="max-width: 300px;" id="img-out"
                                src="https://cdn1.katadata.co.id/media/images/thumb/2022/11/10/Ilustrasi_Ciri-ciri_Orang_Yang_Bersyukur-2022_11_10-13_22_48_d368708753bdc5c3131472013522d76c_960x640_thumb.jpg">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
<script>
    const changeMarker = (marker, map, {
        lattitude,
        longitude
    }) => {
        if (typeof marker !== 'undefined') {
            marker.remove();
        }

        var newMarker = L.marker([lattitude, longitude]).addTo(map);

        map.setView([lattitude, longitude], 13);

        return newMarker;
    }

    const brokenSrc = "https://cdn1.katadata.co.id/media/images/thumb/2022/11/10/Ilustrasi_Ciri-ciri_Orang_Yang_Bersyukur-2022_11_10-13_22_48_d368708753bdc5c3131472013522d76c_960x640_thumb.jpg";

    let markerIn;
    let markerOut;

    const mapIn = L.map('map-in').setView([51.505, -0.09], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapIn);

    markerIn = L.marker([51.5, -0.09]).addTo(mapIn);

    // mapIn.dragging.disable();
    // mapIn.scrollWheelZoom.disable();


    const mapOut = L.map('map-out').setView([51.505, -0.09], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapOut);

    markerOut = L.marker([51.5, -0.09]).addTo(mapOut);

    // mapOut.dragging.disable();
    // mapOut.scrollWheelZoom.disable();

    const initializeMap = ({
        checkIn,
        checkOut
    }) => {
        if (checkIn.lattitude != "-") {
            $('#no-map-in').hide();
            $('#map-in').show();
            changeMarker(markerIn, mapIn, checkIn);
        } else {
            $('#no-map-in').show();
            $('#map-in').hide();
        }

        if (checkOut.lattitude != "-") {
            $('#no-map-out').hide();
            $('#map-out').show();
            changeMarker(markerOut, mapOut, checkOut);
        } else {
            $('#no-map-out').show();
            $('#map-out').hide();
        }
    };

    const setImage = ({ checkIn, checkOut }) => {
        if (checkIn.file != "#") {
            $('#img-in').attr("src", checkIn.file);
        } else {
            $('#img-in').attr("src", brokenSrc);
        }

        if (checkOut.file != "#") {
            $('#img-out').attr("src", checkIn.file);
        } else {
            $('#img-out').attr("src", brokenSrc);
        }
    };

    const detailInit = (data) => {
        initializeMap(data);
        setImage(data);
    };
</script>
