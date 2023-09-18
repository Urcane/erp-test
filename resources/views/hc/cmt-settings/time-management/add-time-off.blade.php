@extends('layouts.app')
@section('title-apps', 'Settings')
@section('sub-title-apps', 'Time Of')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                    @include('hc.cmt-settings.sidebar')
                </div>
                <div class="col-lg-9 mt-md-n14">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-lg-12 mb-9 text-center">
                                <h4>Add Time Off</h4>
                            </div>

                            <div class="col-lg-12 p-6 m-1 rounded border border-2 border-secondary">
                                <form class="form row" enctype="multipart/form-data" id="time_off_form">
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Time Off Name</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Name"
                                            required name="name">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Time Off Code</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Code"
                                            required name="code">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class="required fw-bold">Effective Date</span>
                                        </label>
                                        <input type="date" class="form-control form-control-solid" required
                                            name="effective_date">
                                    </div>

                                    <hr class="mb-5 mt-4">

                                    <p class="fw-bold fs-4">Time Off Configuration</p>

                                    <div class="col-lg-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-real"
                                                name="use_quota" id="use_quota">
                                            <label class="fs-7 form-check-label mb-2" for="use_quota">
                                                <span class="fw-bold">Use Quota (This Time Off Will take leave quota)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-real"
                                                name="unlimited_balance" id="unlimited_balance">
                                            <label class="fs-7 form-check-label mb-2" for="unlimited_balance">
                                                <span class="fw-bold">This time off has unlimited balance</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 row mb-3" id="use_balance_section">
                                        <div class="col-lg-6 mb-3">
                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                <span class="required fw-bold">Time Off Type</span>
                                            </label>
                                            <select class="drop-data form-select form-select-solid"
                                                data-control="balance_type" name="balance_type" required>
                                                @foreach ($balanceTypes as $balanceType)
                                                    <option value="{{ $balanceType }}">{{ $balanceType }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Minimum Works (Month)</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="12" required name="min_works">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Balance (Days)</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="12" required name="balance">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                                    name="expire" id="expire">
                                                <label class="fs-7 form-check-label mb-2" for="expire">
                                                    <span class="fw-bold">Balance Has Expire</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row col-lg-12" id="expire_section">
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Carry Amount</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" required
                                                    name="carry_amount">
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="required fw-bold">Carry Expire (In Month)</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid" required
                                                    name="carry_expired">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                                name="half_day" id="half_day">
                                            <label class="fs-7 form-check-label mb-2" for="half_day">
                                                <span class="fw-bold">Set Half Day Schedule</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                                name="show_in_request" id="show_in_request">
                                            <label class="fs-7 form-check-label mb-2" for="show_in_request">
                                                <span class="fw-bold">Show in request</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-real" placeholder=""
                                                name="attachment" id="attachment">
                                            <label class="fs-7 form-check-label mb-2" for="attachment">
                                                <span class="fw-bold">Required Attachment</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3"></div>

                                    <div class="col-lg-4">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input checkbox-real"
                                                id="max_request">
                                            <label class="fs-7 form-check-label mb-2" for="max_request">
                                                <span class="fw-bold">Max Request (in a row)</span>
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-solid" placeholder="0"
                                            name="max_request">
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input checkbox-real" id="duration">
                                            <label class="fs-7 form-check-label mb-2" for="duration">
                                                <span class="fw-bold">Duration</span>
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-solid"
                                            placeholder="0 ( In days )" name="duration">
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input checkbox-real"
                                                id="minus_amount">
                                            <label class="fs-7 form-check-label mb-2" for="minus_amount">
                                                <span class="fw-bold">Minus Amount</span>
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-solid" placeholder="0"
                                            name="minus_amount">
                                    </div>


                                    <div class="col-lg-12 mt-8 mb-4 d-flex justify-content-center">
                                        <a type="reset" id="cancel" href="{{ route('hc.setting.timeoff.index') }}"
                                            class="btn btn-outline btn-sm px-9 me-7">
                                            Cancel
                                        </a>
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

    <script>
        const onUnlimitedBalanceChange = () => {
            if ($('#unlimited_balance').is(':checked')) {
                $('#use_balance_section').hide();
                $('#expire').prop('checked', false).trigger('change');

                $('[name="balance_type"]').prop('required', false);
                $('[name="min_works"]').prop('required', false);
                $('[name="balance"]').prop('required', false);

                $('[name="balance_type"]').val("");
                $('[name="min_works"]').val("");
                $('[name="balance"]').val("");
            } else {
                $('#use_balance_section').show();

                $('[name="balance_type"]').prop('required', true);
                $('[name="min_works"]').prop('required', true);
                $('[name="balance"]').prop('required', true);
            }
        };

        const onExpireChange = () => {
            if ($('#expire').is(':checked')) {
                $('#expire_section').show();

                $('[name="carry_amount"]').prop('required', true);
                $('[name="carry_expired"]').prop('required', true);
            } else {
                $('#expire_section').hide();

                $('[name="carry_amount"]').prop('required', false);
                $('[name="carry_expired"]').prop('required', false);
                $('[name="carry_amount"]').val("");
                $('[name="carry_expired"]').val("");
            }
        };

        const onHalfDayChange = () => {
            if ($('#half_day').is(':checked')) {
                $('#use_date input').prop("disabled", true);

                $('#duration').prop("disabled", true);
                $('#duration').prop('checked', false).trigger('change');
                $('[name="duration"]').prop("disabled", true);
                $('[name="duration"]').val("");

                $('#minus_amount').prop("disabled", true);
                $('#minus_amount').prop('checked', false).trigger('change');
                $('[name="minus_amount"]').prop("disabled", true);
                $('[name="minus_amount"]').val("");
            } else {
                $('#duration').prop("disabled", false);
                $('[name="duration"]').prop("disabled", false);
                $('[name="duration"]').val("");

                $('#minus_amount').prop("disabled", false);
                $('[name="minus_amount"]').prop("disabled", false);
                $('[name="minus_amount"]').val("");
            }
        };

        const onMinusAmountChange = () => {
            if ($('#minus_amount').is(':checked')) {
                $('[name="use_quota"]').prop('checked', true);
            }
        };

        $(document).ready(function() {
            $('#unlimited_balance').on('change', function() {
                onUnlimitedBalanceChange();
            });

            $('#expire').on('change', function() {
                onExpireChange();
            });

            $('#half_day').on('change', function() {
                onHalfDayChange();
            });

            $('#minus_amount').on('change', function() {
                onMinusAmountChange();

                $('[name="minus_amount"]').prop("disabled", !$(this).is(':checked'));
                $('[name="minus_amount"]').val("");
            });

            $('#max_request').on('change', function() {
                $('[name="max_request"]').prop("disabled", !$(this).is(':checked'));
                $('[name="max_request"]').val("");
            });

            $('#duration').on('change', function() {
                $('[name="duration"]').prop("disabled", !$(this).is(':checked'));
                $('[name="duration"]').val("");
            });

            $('#use_quota').on('change', function() {
                if (!$('[name="use_quota"]').is(':checked') && $('#minus_amount').is(':checked')) {
                    $('[name="minus_amount"]').prop("disabled", !$(this).is(':checked'));
                    $('[name="minus_amount"]').val("");
                    $('#minus_amount').prop('checked', false);
                }
            });

            $('#time_off_form').on('submit', function(event) {
                event.preventDefault();
                const formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('hc.setting.timeoff.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        toastr.success(data.message, 'Selamat 🚀 !');
                    },
                    error: function(xhr, status, error) {
                        const data = xhr.responseJSON;
                        toastr.error(data.message, 'Opps!');
                    }
                });
            });

            $('#unlimited_balance').prop('checked', true).trigger('change');

            onUnlimitedBalanceChange();
            onExpireChange();
            onHalfDayChange();

            $('#max_request').trigger('change');
            $('#minus_amount').trigger('change');
            $('#duration').trigger('change');
        });
    </script>

@endsection
