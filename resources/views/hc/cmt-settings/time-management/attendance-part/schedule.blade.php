<div class="modal fade" id="modal_create_schedule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="modal_create_schedule_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="scroll-y me-n10 pe-10" id="modal_create_schedule_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_create_schedule_header"
                        data-kt-scroll-wrappers="#modal_create_schedule_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Add Schedule</span>
                                {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Schedule Name</span>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    placeholder="Schedule Name" required name="name">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Effective Date</span>
                                </label>
                                <input type="date" class="form-control form-control-solid" placeholder="Select Date"
                                    required name="effective_date">
                            </div>

                            <div class="col-lg-12">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Settings</span>
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                    name="override_national_holiday" id="override_national_holiday">
                                <label class="fs-6 form-check-label mb-2" for="override_national_holiday">
                                    <span class="fw-bold">Override National Holiday</span>
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                    name="override_company_holiday" id="override_company_holiday">
                                <label class="fs-6 form-check-label mb-2" for="override_company_holiday">
                                    <span class="fw-bold">Override Company Holiday</span>
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                    name="override_special_holiday" id="override_special_holiday">
                                <label class="fs-6 form-check-label mb-2" for="override_special_holiday">
                                    <span class="fw-bold">Override Special Holiday</span>
                                </label>
                            </div>

                            <div class="col-lg-12">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="fw-bold">Day Off</span>
                                </label>
                            </div>

                            <div class="col-lg-12 mt-6 mb-3">
                                <h4>Set Shift</h4>
                                <span class="fs-7 fw-semibold text-gray-500">Set your shift combination for this
                                    schedule.</span>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Shift Name</th>
                                            <th scope="col">Working Hour</th>
                                            <th scope="col">Break</th>
                                            <th scope="col">OT Before</th>
                                            <th scope="col">OT After</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-shift">
                                        <tr id="shift-0">
                                            <td>
                                                <select class="form-select select-shift" data-id="0"
                                                    id="select-default">
                                                    <option value="" selected hidden disabled>Select Shift
                                                    </option>
                                                    @foreach ($dataWorkingShift as $option)
                                                        <option value="{{ $option->id }}"
                                                            @if (old('shift_id') == $option) selected @endif>
                                                            {{ $option->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td id="working_hour_0">-</td>
                                            <td id="break_0">-</td>
                                            <td id="ot_before_0">-</td>
                                            <td id="ot_after_0">-</td>
                                            <td onclick="removeShiftComponent('#shift-0')"><i
                                                    class="fa-solid fa-circle-minus"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-lg-12 mb-3 d-flex">
                                <button type="button" class="btn btn-info d-flex justify-content-center"
                                    onclick="addShiftComponent()">
                                    <i class="fa-solid fa-plus d-flex justify-content-center"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-9">
                        <button type="reset" id="modal_create_schedule_cancel"
                            class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal_create_schedule_submit"
                            class="btn btn-sm btn-info w-lg-200px">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-9">
        <h4>Working Schedule</h4>
        <span class="fs-7 fw-semibold text-gray-500">Set working schedule on your company.</span>
    </div>
    <div class="col-lg-6 d-flex justify-content-end">
        <div>
            <a href="#modal_create_schedule" data-bs-toggle="modal"
                class="btn btn-info btn-sm me-3 btn_create_schdule"><i class="fa-solid fa-plus"></i>Add Schedule</a>
        </div>
    </div>
    <div class="col-lg-12 row p-6 m-1 rounded border border-2 border-secondary">
        <div class="col-lg-12">
            <table class="table align-top table-striped border table-rounded gy-5" id="tb_schedule">
                <thead class="">
                    <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                        <th class="text-center w-50px">#</th>
                        <th class="text-center w-50px">#</th>
                        <th class="w-150px">Name</th>
                        <th class="w-150px">Effective Date</th>
                        <th class="w-150px">Shift</th>
                        <th class="w-100px">Assigned To</th>
                        <th class="w-100px">#</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    let dataTableSchedule
    $(".btn_create_schdule").on("click", function() {
        $("input:not(:checkbox)").val("")
        addShiftComponent()
        var parentElement = $("#table-shift");
        var lastChild = parentElement.children().last();

        parentElement.children().not(lastChild).remove();


        $("[name=\'override_national_holiday\']").val("0");
        $("[name=\'override_company_holiday\']").val("0");
        $("[name=\'override_special_holiday\']").val("0");
        $("[name=\'override_national_holiday\']").prop("checked", false);
        $("[name=\'override_company_holiday\']").prop("checked", false);
        $("[name=\'override_special_holiday\']").prop("checked", false);
    })

    function addShiftComponent() {
        const parentElement = $("#table-shift");
        var last_id = parseInt(parentElement.children().last().attr("id").split("-")[1]) + 1;
        const optionElements = $(".select-shift").last().children().clone();

        let content = $(`<tr id="shift-${last_id}">
                                        <td>
                                            <select class="form-select select-shift new" data-id="${last_id}" id="select-default">
                                            </select>
                                        </td>
                                        <td id="working_hour_${last_id}">-</td>
                                        <td id="break_${last_id}">-</td>
                                        <td id="ot_before_${last_id}">-</td>
                                        <td id="ot_after_${last_id}">-</td>
                                        <td onclick="removeShiftComponent('#shift-${last_id}')"><i class="fa-solid fa-circle-minus"></i></td>
                                    </tr>`)

        parentElement.append(content)
        $(`select.new[data-id="${last_id}"]`).append(optionElements)

        $("#shift-" + last_id + " select.new").on('change', function() {
            onChangeSelect($(this))
        })
    }

    function removeShiftComponent(element) {
        let sid = $(element + ' td:last-child').data("id") ?? null;
        let wid = $(element + ' td:last-child').data("working-schedule") ?? null;

        let child = $(element);
        let parent = $(element).parent();

        if (sid) {
            $.ajax({
                url: "{{ route('hc.setting.schedule.delete.shift') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: {
                    shift_id: sid,
                    working_schedule_id: wid
                },
                success: function(data) {
                    dataTableSchedule.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                    $(element).remove()
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        }

        if ($(element).parent().children().length > 1 && !sid) {
            $(element).remove()
        }
    }

    function fillInputSchedule(
        id,
        name,
        effective_date,
        override_national_holiday,
        override_company_holiday,
        override_special_holiday,
        workingScheduleShifts) {
        $("[name=\'id\']").val(id);
        $("[name=\'name\']").val(name);
        $("[name=\'effective_date\']").val(effective_date);
        $("[name=\'override_national_holiday\']").val("0");
        $("[name=\'override_company_holiday\']").val("0");
        $("[name=\'override_special_holiday\']").val("0");
        $("[name=\'override_national_holiday\']").prop("checked", false);
        $("[name=\'override_company_holiday\']").prop("checked", false);
        $("[name=\'override_special_holiday\']").prop("checked", false);

        if (override_national_holiday != "0") {
            $("[name=\'override_national_holiday\']").val("1")
            $("[name=\'override_national_holiday\']").prop("checked", true);
        }
        if (override_company_holiday != "0") {
            $("[name=\'override_company_holiday\']").val("1")
            $("[name=\'override_company_holiday\']").prop("checked", true);
        }
        if (override_special_holiday != "0") {
            $("[name=\'override_special_holiday\']").val("1")
            $("[name=\'override_special_holiday\']").prop("checked", true);
        }

        const optionElement = $(".select-shift").last().children();
        $("#table-shift").children().remove();

        workingScheduleShifts.map(data => {
            const shift = data.working_shift;
            const option = optionElement.clone()
            let ot_before = shift.overtime_before ?? ""
            let ot_after = shift.overtime_after ?? ""

            const working_start = shift.working_start ?? ""
            const working_end = shift.working_end ?? ""

            const break_start = shift.break_start ?? ""
            const break_end = shift.break_end ?? ""


            let content = $(`<tr id="shift-${shift.id}-edit">
                                <td>
                                    <select class="form-select select-shift" data-id="${data.id}" data-shift-id="${shift.id}" data-id-db="${data.id}">
                                    </select>
                                </td>
                                <td id="working_hour_${shift.id}">${working_start +" - "+ working_end}</td>
                                <td id="break_${shift.id}">${break_start +" - "+ break_end}</td>
                                <td id="ot_before_${shift.id}">${ot_before}</td>
                                <td id="ot_after_${shift.id}">${ot_after}</td>
                                <td onclick="removeShiftComponent('#shift-${shift.id}-edit')" data-id="${shift.id}" data-working-schedule="${id}"><i class="fa-solid fa-circle-minus"></i></td>
                            </tr>`);
            $("#table-shift").append(content);
            $(`select[data-id="${data.id}"]`).append(option)

            $(`[data-id="${data.id}"] option`).each(function() {
                if (shift.id == parseInt($(this).val())) {
                    $(this).prop("selected", true);
                }
            });
            $(`.select-shift[data-id="${data.id}"]`).on('change', function() {
                onChangeSelect($(this))
            })

        });
    }

    $(".select-shift").on('change', function() {
        onChangeSelect($(this))
    })

    function onChangeSelect(element) {
        let id = element.data('id');
        const db_id = element.data('id-db');
        const sid = element.data('shift-id');
        let shift_id = element.val();
        const parent = element.parent().parent();

        if (db_id) {
            $.ajax({
                url: "{{ route('hc.setting.schedule.update.shift') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: {
                    id: id,
                    working_shift_id: shift_id,
                },
                success: function(data) {
                    dataTableSchedule.ajax.reload();
                    let ot_before = data.shift.overtime_before ?? ""
                    let ot_after = data.shift.overtime_after ?? ""

                    const working_start = data.shift.working_start ?? ""
                    const working_end = data.shift.working_end ?? ""
                    parent.find(`#working_hour_${sid}`).html(working_start + " - " +
                        working_end)

                    const break_start = data.shift.break_start ?? ""
                    const break_end = data.shift.break_end ?? ""
                    parent.find(`#break_${sid}`).html(break_start + " - " + break_end)
                    parent.find(`#ot_before_${sid}`).html(ot_before)
                    parent.find(`#ot_after_${sid}`).html(ot_after)
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    parent.find(`option`).each(function() {
                        if (sid == parseInt($(this).val())) {
                            $(this).prop("selected", true);
                        }
                    });

                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            })
        } else {
            $.ajax({
                url: "{{ route('hc.setting.schedule.get.shift') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: {
                    id: shift_id
                },
                success: function(data) {
                    let ot_before = data.overtime_before ?? ""
                    let ot_after = data.overtime_after ?? ""

                    const working_start = data.working_start ?? ""
                    const working_end = data.working_end ?? ""
                    parent.find(`#working_hour_${id}`).html(working_start + " - " + working_end)

                    const break_start = data.break_start ?? ""
                    const break_end = data.break_end ?? ""
                    parent.find(`#break_${id}`).html(break_start + " - " + break_end)
                    parent.find(`#ot_before_${id}`).html(ot_before)
                    parent.find(`#ot_after_${id}`).html(ot_after)
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        }
    }

    $(document).ready(function() {
        dataTableSchedule = $('#tb_schedule').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            aaSorting: [],
            buttons: [],
            ajax: {
                url: "{{ route('hc.setting.getTableSchedule') }}",
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
                    data: 'DT_RowChecklist',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex'
                },
                {
                    data: 'name'
                },
                {
                    data: 'effective_date'
                },
                {
                    data: 'shift'
                },
                {
                    data: 'assigned_to'
                },
                {
                    data: 'action'
                },
            ],

            columnDefs: [{
                    targets: 0,
                    searchable: false,
                    className: 'text-center',
                },
                {
                    targets: 1,
                    className: 'text-center',
                },
            ],
        });
    })

    function deleteJobLevel(id) {
        $.ajax({
            url: "{{ route('hc.setting.schedule.delete') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                dataTableSchedule.ajax.reload();
                toastr.success(data.message, 'Selamat 🚀 !');
            },
            error: function(xhr, status, error) {
                const data = xhr.responseJSON;
                toastr.error(data.message, 'Opps!');
            }
        });
    }

    $('#modal_create_schedule_form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        var dataShift = [];

        $("#table-shift").children().each(function(index, child) {
            const id = $(child).attr("id").split("-")[1]

            dataShift.push({
                shift_id: $(`[data-id="${id}"]`).val()
            })
        })

        if (dataShift[0].shift_id != null) {
            $.ajax({
                url: "{{ route('hc.setting.schedule.createUpdate') }}",
                type: 'POST',
                data: {
                    id: $("[name='id']").val(),
                    name: $("[name='name']").val(),
                    effective_date: $("[name='effective_date']").val(),
                    override_national_holiday: $("[name='override_national_holiday']").val(),
                    override_company_holiday: $("[name='override_company_holiday']").val(),
                    override_special_holiday: $("[name='override_special_holiday']").val(),
                    late_check_in: $("[name='late_check_in']").val(),
                    late_check_out: $("[name='late_check_out']").val(),
                    shift_id: dataShift,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    dataTableSchedule.ajax.reload();
                    toastr.success(data.message, 'Selamat 🚀 !');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            });
        }

    });
</script>
