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
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Attendances Details</span>
                    <span class="fs-7 fw-semibold text-gray-500"></span>
                </div>
                <div class="scroll-y me-n6 pe-6 row" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px">

                    <div class="col-lg-12" id="checkin">
                        <div class="col-lg-12 d-flex justify-content-center fw-bold fs-4 mb-5">
                            Check In
                        </div>

                        <div class="row rounded border border-2 border-secondary p-3" id="checkin-section">
                            <div class="col-lg-6">
                                <div id="map-in" style="height: 200px;"></div>
                                <div id="no-map-in">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                        <img class="img-fluid" style="height: 50px"
                                            src="{{ asset('sense/media/images/no-location.png') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 d-flex justify-content-center">
                                <img class="img-fluid" style="max-height: 200px" id="img-in"
                                    src="">
                            </div>

                            <div class="col-lg-12 mb-6"></div>

                            <div class="col-lg-4 text-center">
                                <div class="col-lg-12">
                                    <i class="fa-solid fa-location-dot me-1 text-info"></i>
                                    Location
                                </div>
                                <div class="col-lg-12">
                                    <a href="#" class="fw-bold text-info" id="loc-in" target="_blank">Lihat Lokasi</a>
                                </div>
                            </div>

                            <div class="col-lg-4 text-center">
                                <div class="col-lg-12">
                                    <i class="fa-regular fa-clock me-1 text-info"></i>
                                    Clock In Time
                                </div>
                                <div class="col-lg-12">
                                    <p class="fw-bold" id="time-in">08:90</p>
                                </div>
                            </div>

                            <div class="col-lg-4 text-center">
                                <div class="col-lg-12">
                                    <i class="fa-solid fa-briefcase me-1 text-info"></i>
                                    Shift
                                </div>
                                <div class="col-lg-12">
                                    <p class="fw-bold shift">Shift 2</p>
                                </div>
                            </div>

                        </div>

                        <div class="row rounded border border-2 border-secondary p-3" id="no-checkin-section">
                            <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                <img src="{{ asset('sense/media/images/no-attendance.svg') }}" style="height: auto;">
                            </div>
                            <div class="col-lg-12 fw-bold fs-3 text-center">
                                Tidak ada data check in!
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4" id="colmb"></div>

                    <div class="col-lg-12" id="checkout">
                        <div class="col-lg-12 d-flex justify-content-center fw-bold fs-4 mb-5">
                            Check Out
                        </div>

                        <div class="row rounded border border-2 border-secondary p-3" id="checkout-section">
                            <div class="col-lg-6">
                                <div id="map-out" style="height: 200px;"></div>
                                <div id="no-map-out">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                        <img class="img-fluid" style="height: 50px"
                                            src="{{ asset('sense/media/images/no-location.png') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 d-flex justify-content-center">
                                <img class="img-fluid" style="max-height: 200px;" id="img-out"
                                src="">
                            </div>

                            <div class="col-lg-12 mb-6"></div>

                            <div class="col-lg-4 text-center">
                                <div class="col-lg-12">
                                    <i class="fa-solid fa-location-dot me-1 text-info"></i>
                                    Location
                                </div>
                                <div class="col-lg-12">
                                    <a href="#" class="fw-bold text-info" id="loc-out" target="_blank">Lihat Lokasi</a>
                                </div>
                            </div>

                            <div class="col-lg-4 text-center">
                                <div class="col-lg-12">
                                    <i class="fa-regular fa-clock me-1 text-info"></i>
                                    Clock Out Time
                                </div>
                                <div class="col-lg-12">
                                    <p class="fw-bold" id="time-out">08:90</p>
                                </div>
                            </div>

                            <div class="col-lg-4 text-center">
                                <div class="col-lg-12">
                                    <i class="fa-solid fa-briefcase me-1 text-info"></i>
                                    Shift
                                </div>
                                <div class="col-lg-12">
                                    <p class="fw-bold shift">Shift 2</p>
                                </div>
                            </div>
                        </div>

                        <div class="row rounded border border-2 border-secondary p-3" id="no-checkout-section">
                            <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                <img src="{{ asset('sense/media/images/no-attendance.svg') }}" style="height: auto;">
                            </div>
                            <div class="col-lg-12 fw-bold fs-3 text-center">
                                Tidak ada data check out!
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 rounded border border-2 border-secondary p-3" id="nowork">
                        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                            <img src="{{ asset('sense/media/images/no-work.svg') }}" style="height: auto;">
                        </div>
                        <div class="col-lg-12 fw-bold fs-3 text-center">
                            Tidak ada jadwal untuk hari ini!
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
<script>
    let markerIn;
    let markerOut;
    let mapIn;
    let mapOut;

    const changeMarker = (marker, map, {
        lattitude,
        longitude
    }) => {
        if (typeof marker !== 'undefined') {
            marker.remove();
        }

        setTimeout(() => {
            map.invalidateSize();
        }, 500);

        var newMarker = L.marker([lattitude, longitude]).addTo(map);

        map.setView([lattitude, longitude], 13);

        return newMarker;
    }

    const brokenImage = "{{ asset('sense/media/images/image-slash.png') }}";

    const initializeMap = ({
        checkIn,
        checkOut
    }) => {
        if (checkIn.lattitude) {
            $('#no-map-in').hide();
            $('#map-in').show();
            changeMarker(markerIn, mapIn, checkIn);
        } else {
            $('#no-map-in').show();
            $('#map-in').hide();
        }

        if (checkOut.lattitude) {
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
            $('#img-in').attr("src", brokenImage);
        }

        if (checkOut.file != "#") {
            $('#img-out').attr("src", checkOut.file);
        } else {
            $('#img-out').attr("src", brokenImage);
        }
    };

    const mapsLink = ({ lattitude, longitude }) => {
        return `https://www.google.com/maps?q=${lattitude},${longitude}`;
    };

    const setData = ({ checkIn, checkOut, shift }) => {
        if (checkIn.lattitude) {
            $('#loc-in').attr("href", mapsLink(checkIn));
            $('#loc-in').text("Show Location");
        } else {
            $('#loc-in').removeAttr("href");
            $('#loc-in').text("-");
        }

        if (checkOut.lattitude) {
            $('#loc-out').attr("href", mapsLink(checkOut));
            $('#loc-out').text("Show Location");
        } else {
            $('#loc-out').removeAttr("href");
            $('#loc-out').text("-");
        }

        $('#time-in').text(checkIn.time);
        $('#time-out').text(checkOut.time);

        $('.shift').text(shift);
    };

    const detailInit = (data) => {
        if (data.attendanceCode !== attendanceCodeEnum[0]) {
            $('#checkin').hide();
            $('#checkout').hide();
            $('#colmb').hide();
            $('#nowork').show();
            return;
        } else {
            $('#checkin').show();
            $('#checkout').show();
            $('#colmb').show();
            $('#nowork').hide();
        }

        if (data.checkIn.time) {
            $('#checkin-section').show();
            $('#no-checkin-section').hide();
        } else {
            $('#checkin-section').hide();
            $('#no-checkin-section').show();
        }

        if (data.checkOut.time) {
            $('#checkout-section').show();
            $('#no-checkout-section').hide();
        } else {
            $('#checkout-section').hide();
            $('#no-checkout-section').show();
        }

        initializeMap(data);
        setData(data)
        setImage(data);
    };

    $(document).ready(function () {
        mapIn = L.map('map-in').setView([51.505, -0.09], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapIn);

        markerIn = L.marker([51.5, -0.09]).addTo(mapIn);

        mapOut = L.map('map-out').setView([51.505, -0.09], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapOut);

        markerOut = L.marker([51.5, -0.09]).addTo(mapOut);
    })
</script>
