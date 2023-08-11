<div class="modal fade" id="modal_create_emergency_contact" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_emergency_contact_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="modal_create_emergency_contact_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_create_emergency_contact_header" data-kt-scroll-wrappers="#modal_create_emergency_contact_scroll" data-kt-scroll-offset="300px">
                    <div class="row mb-9">
                        <div class="col-lg-12 text-center mb-9">
                            <span class="fs-1 fw-bolder text-dark d-block mb-1">Emergency Contact</span>
                            <span class="fs-7 fw-semibold text-gray-500">Nomor yang dapat dihubungi dalam keadaan darurat</span>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Nama</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Name" required name="name">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                <span class="required fw-bold">Relationship</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Hubungan dengan anda" required name="relationship">
                        </div>
                        <div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Phone</span>
							</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nomor yang dapat dihubungi" required name="phone">
						</div>
                        <div id="containerSelectedSurveyRequests">

                        </div>
                    </div>
                </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_emergency_contact_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_emergency_contact_submit" class="btn btn-sm btn-info w-lg-200px" data-bs-dismiss="modal">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Emergency Contact Content --}}
<div class="col-lg-6 mb-9">
    <h4>Emergency Contact</h4>
    <span class="fs-7 fw-semibold text-gray-500">Your emergency contact information</span>
</div>
<div class="col-lg-6 d-flex justify-content-end">
    <div>
        <a href="#modal_create_emergency_contact" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_contact"><i class="fa-solid fa-plus"></i>Add Emergency Contact</a>
    </div>
</div>
<div class="col-lg-12">
    <table class="table align-top table-striped border table-rounded gy-5" id="tb_emergency_contact_content">
        <thead class="">
            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                <th class="text-center w-50px">#</th>
                <th class="text-center w-50px">#</th>
                <th class="">Nama</th>
                <th class="w-150px">Relationship</th>
                <th class="w-150px">Phone Number</th>
                <th class="w-100px">#</th>

            </tr>
        </thead>
        <tbody class="fs-7">
        </tbody>
    </table>
</div>

<script>
    var dataTableEmergencyContact;

    $(".btn_tambah_contact").on( "click", function() {
        $("[name='id']").val("")
        $("input:not([name='user_id'])").val("")
    })

    $( "#emergency_contact" ).on( "click", function() {
        dataTableEmergencyContact = $('#tb_emergency_contact_content').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting : [],
            drawCallback: function () {
                $('body').on('click', 'input[name=\'emergency_contact_ids\']', function () {
                    if($(this).is(":checked")){
                        emergency_contactids.push($(this).val());
                    } else {
                        removeFrom(emergency_contactids, $(this).val());
                    }
                });
            },
            ajax: {
                url : "{{route('hc.emp.get-table-emergency-contact')}}",
                data: function(data){
                    data.user_id = {{$user->id}}
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 📁",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            buttons: [
            // {
            //     extend: 'excel',
            //     className: 'btn btn-light-success btn-sm ms-3',
            //     title: 'Data Pegawai Comtelindo',
            //     exportOptions: {
            //         columns: [1,8,9,3,10,4,5,6]
            //     }
            // },
            ],
            dom:
            "<'row mb-2'" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
            "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
            "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
            ">",

            columns: [
            { data: 'DT_RowChecklist', orderable: false, searchable: false},
            { data: 'DT_RowIndex'},
            { data: 'name'},
            { data: 'relationship',},
            { data: 'phone',},
            { data: 'action'},
            ],
        });
    })

    function deleteEmergencyContact(id) {
        $.ajax({
            url: "{{ route('hc.emp.delete-emergency-contact') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: { id : id},
            success: function(data) {
                dataTableEmergencyContact.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = JSON.parse(xhr.responseText);
                toastr.error(errorThrown ,'Opps!');
            }
        });
    }

    $('#modal_create_emergency_contact_form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('hc.emp.create-update-emergency-contact') }}",
            type: 'POST',
            data: formData,
            success: function(data) {
                dataTableEmergencyContact.ajax.reload();
                toastr.success(data.message,'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = JSON.parse(xhr.responseText);
                toastr.error(errorThrown ,'Opps!');
            }
        });
    });
</script>
