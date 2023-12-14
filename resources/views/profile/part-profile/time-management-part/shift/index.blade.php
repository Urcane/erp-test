<div class="tab-pane fade" id="shift_content" role="tabpanel">
    <div class="row p-4">
        <div class="col-lg-6 mb-9">
            <h4>Request Shift</h4>
            <span class="fs-7 fw-semibold text-gray-500">Your request shift information</span>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <div>
                <a href="#shift_request_modal" class="btn btn-info btn-sm me-3 fs-8" data-bs-toggle="modal"><i
                        class="fa-solid fa-plus"></i>Request Shift</a>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5" id="tb_shift_content">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Created Date</th>
                        <th class="w-150px">Request Date</th>
                        <th class="w-150px">Approval Line</th>
                        <th class="w-150px">Shift</th>
                        <th class="w-150px">Working Start</th>
                        <th class="w-150px">Working End</th>
                        <th class="w-150px">Status</th>
                        <th class="w-100px">#</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('profile.part-profile.time-management-part.shift.add-modal')
@include('profile.part-profile.time-management-part.shift.info-modal')

<script>
    const onShiftModalOpen = ({
        id,
        currshift = "-",
        currwork = "-",
        created = "-",
        date = "-",
        newshift = "-",
        newwork = "-",
        notes = "-",
        status,
        changed,
        prmshift,
        prmwork,
        comment = "-"
    }) => {
        const createdFormated = formatDateTime(created);

        switch (status) {
            case approveStatusEnum[0]:
                $('#shift_approved_button').hide();
                $('#shift_rejected_button').hide();
                $('#shift_cancel_button').show();
                $('#shift_canceled_button').hide();

                $('#shift_comment').hide();
                $('#att_shift_label').hide();
                break;
            case approveStatusEnum[1]:
                $('#shift_approved_button').show();
                $('#shift_rejected_button').hide();
                $('#shift_cancel_button').hide();
                $('#shift_canceled_button').hide();

                $('#att_shift_label').show();
                $('#shift_comment').show();
                $('#shift_comment').val(comment);
                break;
            case approveStatusEnum[2]:
                $('#shift_approved_button').hide();
                $('#shift_rejected_button').show();
                $('#shift_cancel_button').hide();
                $('#shift_canceled_button').hide();

                $('#att_shift_label').show();
                $('#shift_comment').show();
                $('#shift_comment').val(comment);
                break;
            case approveStatusEnum[3]:
                $('#shift_approved_button').hide();
                $('#shift_rejected_button').hide();
                $('#shift_cancel_button').hide();
                $('#shift_canceled_button').show();

                $('#shift_comment').hide();
                $('#att_shift_label').hide();
                break;
        }

        $('#shf-curr-shift-modal').text(currshift);
        $('#shf-curr-work-modal').text(currwork);
        $('#shf-created-modal').text(createdFormated);
        $('#shf-date-modal').text(date);
        $('#shf-new-shift-modal').text(newshift);
        $('#shf-new-work-modal').text(newwork);
        $('#shf-notes-modal').text(notes);
        $('#shift-request-id').val(id)

        if (changed == '1') {
            $('#shf-title-prm-shift-modal').text("Primary Shift");
            $('#shf-title-prm-work-modal').text("Primary Work Hours");

            $('#shf-prm-shift-modal').text(prmshift);
            $('#shf-prm-work-modal').text(prmwork);

            $('#shf-curr-shift-modal').text(currshift);
            $('#shf-curr-work-modal').text(currwork);

            $('.shf_changed').each(function () {
                $(this).show();
            });
        } else {
            $('#shf-title-prm-shift-modal').text("Current Shift");
            $('#shf-title-prm-work-modal').text("Current Work Hours");

            $('#shf-prm-shift-modal').text(currshift);
            $('#shf-prm-work-modal').text(currwork);

            $('.shf_changed').each(function () {
                $(this).hide();
            });
        }
    };

    $(document ).ready(function() {
        let shiftTable;
        $("#shift").on("click", function() {
            shiftTable = $('#tb_shift_content').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('req.shift.get-table-me') }}",
                    data: function(data) {
                        data.user_id = {{ $user->id }}
                    }
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                buttons: [],
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
                        data: 'created_at'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'approval_line'
                    },
                    {
                        data: 'shift'
                    },
                    {
                        data: 'working_start'
                    },
                    {
                        data: 'working_end'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },
                ],
                columnDefs: [{
                    targets: 0,
                    searchable: false,
                    className: 'text-center',
                }, ],
            });
        })

        $('#modal_create_shift_request').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('req.shift.create') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#shift_request_modal').modal('hide');
                    shiftTable.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        });

        $('#shift_cancel').on('click', function() {
            $.ajax({
                url: "{{ route('req.shift.cancel') }}",
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id: $('#shift-request-id').val(),
                },
                success: function(data) {
                    shiftTable.draw();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        })
    });
</script>
