<script>
    let onWarehouseModalOpen;

    @can('FIN:crud-masterdata-inventory')
        const createModalInit = () => {
            let map;
            let marker;

            (() => {
                map = L.map('map').setView([-1.2495105, 116.8749959], 7);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

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
            })();

            $('[href="#add_warehouse_modal"]').on('click', function() {
                $('#modal_create_warehouse')[0].reset();
                $('#latitude').val('');
                $('#longitude').val('');

                if (marker) {
                    map.removeLayer(marker);
                }

                setTimeout(() => {
                    map.invalidateSize();
                }, 500);
            });
        }

        const editModalInit = () => {
            let map;
            let marker;

            function addMarker(lat, lng, openPopup) {
                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([lat, lng]).addTo(map);

                if (openPopup) {
                    map.setView([lat, lng], 15);
                }

                $('#modal_edit_warehouse input[name="latitude"]').val(lat);
                $('#modal_edit_warehouse input[name="longitude"]').val(lng);
            }

            (() => {
                map = L.map('mapedit').setView([-1.2495105, 116.8749959], 7);

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

                    addMarker(latitude, longitude, false);
                });
            })();

            onWarehouseModalOpen = ({
                id,
                name,
                latitude,
                longitude
            }) => {
                $('#modal_edit_warehouse input[name="id"]').val(id);
                $('#modal_edit_warehouse input[name="name"]').val(name);
                $('#modal_edit_warehouse input[name="latitude"]').val(latitude);
                $('#modal_edit_warehouse input[name="longitude"]').val(longitude);

                if (marker) {
                    map.removeLayer(marker);
                }

                setTimeout(() => {
                    map.invalidateSize();
                }, 500);

                let lat = latitude;
                let lng = longitude;

                if (lat && lng) {
                    addMarker(lat, lng, true);
                }
            }
        }
    @endcan

    const warehouseInit = () => {
        const warehouseTable = $('#kt_table_warehouse')
            .DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('fin.inv.master-data.warehouse.get-table') }}",
                    data: function(data) {
                        data.search = $('#warehouse_search').val();
                    }
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                buttons: [{
                    extend: 'excel',
                    className: 'btn btn-light-success btn-sm ms-3',
                    title: 'Data Absen Pegawai Comtelindo',
                    exportOptions: {
                        columns: [1]
                    }
                }, ],
                dom: "<'row mb-2'" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'>" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start '>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'l i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: [0, 2],
                    className: 'text-center',
                }, ],
            });

        $('#warehouse_search').on('keyup', function(e) {
            if (e.keyCode === 13) {
                warehouseTable.draw();
            }
        });

        @can('FIN:crud-masterdata-inventory')
            $('#modal_create_warehouse').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.master-data.warehouse.create') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#add_warehouse_modal').modal('hide');
                        warehouseTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#modal_edit_warehouse').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('fin.inv.master-data.warehouse.update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#edit_warehouse_modal').modal('hide');
                        warehouseTable.ajax.reload();
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            createModalInit();
            editModalInit();
        @endcan
    }
</script>
