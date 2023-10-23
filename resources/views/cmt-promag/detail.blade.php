@extends('layouts.app')
@section('title-apps','CMT-PROMAG')
@section('sub-title-apps','Commercial')
@section('desc-apps','Pusing Kerja?, PROMAG solusi nya!')
@section('icon-apps','fa-solid fa-briefcase')

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
<div class="row justify-content-center">
    <div class="col-lg-12 mt-n20">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="app-main flex-column flex-row-fluid"
                            id="kt_app_main"
                        >
                            <div class="d-flex flex-column flex-column-fluid">
                                <div id="kt_app_content" class="app-content">
                                    <div class="card mb-6 mb-xl-9">
                                        <div class="card-body pt-9 pb-0">
                                            @include('cmt-promag.component.header')
                                            <div class="separator"></div>
                                            @include('cmt-promag.component.navigator-tabs')
                                        </div>
                                    </div>
                                    <div id="promag-detail-containe">
                                        @yield('promag-detail-content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('cmt-promag.modal.modal-views-users')
@include('cmt-promag.modal.modal-user-search')

<script>
    $(document ).ready(function() {
        handleAddUsersToProject({addUserButtonElement: '#add-users'});
    })

    const handleAddUsersToProject = ({addUserButtonElement}) => {
        // Elements
        let timeout;
        const work_list_id = {{$work_list_id}};
        const element = document.querySelector('#kt_modal_users_search_handler');

        const wrapperElement = element.querySelector('[data-kt-search-element="wrapper"]');
        const suggestionsElement = element.querySelector('[data-kt-search-element="suggestions"]');
        const resultsElement = element.querySelector('[data-kt-search-element="results"]');
        const emptyElement = element.querySelector('[data-kt-search-element="empty"]');

        const processs = async function(search) {
            clearTimeout(timeout);
            timeout = setTimeout( async function() {
                const data = await $.ajax({
                    url: "{{route('com.promag.detail.getAllUsers', ['work_list_id' => $work_list_id])}}",
                    type: 'GET',
                    data: {
                        'searchValue': search.getQuery(),
                    },
                    dataType: 'json',
                });

                console.log(data.users.length <= 1);

                // Hide recently viewed
                $('#container-searched-users').html('');
                suggestionsElement.classList.add("d-none");

                if (data && (data.status !== "success" || data.users.length === 0)) {
                    // Hide results
                    resultsElement.classList.add("d-none");
                    // Show empty message
                    emptyElement.classList.remove("d-none");
                } else {
                    data.users.forEach(user => {
                        $('#container-searched-users').append(viewSearchedUser(user));

                        // handled already added user
                        if (user.work_lists.some(item => item.id == work_list_id)) {
                            $(`#container-searched-users`).find(`#user-${user.id}`).click();
                        } 
                    })

                    // Show results
                    resultsElement.classList.remove("d-none");
                    // Hide empty message
                    emptyElement.classList.add("d-none");
                }

                // Complete search
                search.complete();
            }, 1250);
        }

        const clear = function(search) {
            // Show recently viewed
            suggestionsElement.classList.remove("d-none");
            // Hide results
            resultsElement.classList.add("d-none");
            // Hide empty message
            emptyElement.classList.add("d-none");
        }

        // Input handler
        const handleInput = () => {
            // Select input field
            const inputField = element.querySelector('[data-kt-search-element="input"]');

            // Handle keyboard press event
            inputField.addEventListener("keydown", e => {
                // Only apply action to Enter key press
                if(e.key === "Enter"){
                    e.preventDefault(); // Stop form from submitting
                }
            });
        }

        const viewRelatedUser = (user) => {
            const profile_pic = user.foto_file ? `{{asset('sense')}}/media/foto_pegawai/${user.foto_file}` : "{{asset('sense')}}/media/avatars/blank.png"

            return `
            <div class="d-flex align-items-center p-3 rounded mb-1">
                <div class="symbol symbol-35px symbol-circle me-5">
                    <img alt="Pic" src="${profile_pic}" />
                </div>
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">${user.name}</span>
                    <span class="badge badge-light">${user.division.divisi_name}</span>
                </div>
                <div class="fw-semibold align-self-center ms-auto">
                    <button type="button" id="revoke-user-${user.id}" class="btn btn-sm btn-active-light-danger" data-id="${user.id}">Revoke</button>
                </div>
            </div>
            `
        }

        const viewSearchedUser = (user) => {
            const profile_pic = user.foto_file ? `{{asset('sense')}}/media/foto_pegawai/${user.foto_file}` : "{{asset('sense')}}/media/avatars/blank.png"

            return `
            <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                <div class="d-flex align-items-center">
                    <label class="form-check form-check-custom form-check-solid me-5">
                        <input class="form-check-input" id="user-${user.id}" type="checkbox" name="users[]" data-kt-check="true" data-kt-check-target="[data-user-id='${user.id}']" value="${user.id}" /> </label>
                    <div class="symbol symbol-35px symbol-circle">
                        <img alt="Pic" src="${profile_pic}" />
                    </div>
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">${user.name}</a>
                        <div class="fw-semibold text-muted">
                            ${user.email}
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
            `;
        }

        // Initialize search handler
        searchObject = new KTSearch(element);

        // Search handler
        searchObject.on("kt.search.process", processs);

        // Clear handler
        searchObject.on("kt.search.clear", clear);

        // Handle select
        KTUtil.on(element, '[data-kt-search-element="customer"]', "click", function() {
            // modal.hide();
        });

        // Handle input enter keypress
        handleInput();

        submitModal({
            modalName: 'kt_modal_users_search',
            tableName: 'kt_table_promag',
            ajaxLink: "{{ route('com.promag.detail.store.users', ['work_list_id' => $work_list_id]) }}",
            successCallback: function (data) {
                $(`#kt_modal_users_search_submit`).removeAttr('disabled');
                $(addUserButtonElement).click();
            }
        });

        $(addUserButtonElement).click(function (e) {
            searchObject.clear();

            $.ajax({
                url: "{{route('com.promag.detail.users', ['work_list_id' => $work_list_id])}}",
                type: 'GET',
                success: function(response) {
                    $('#container-related-users').html("");

                    if (response.data.users.length >= 1) {
                        response.data.users.forEach(user => {
                            $('#container-related-users').append(viewRelatedUser(user));
                        });

                        $("[id^=revoke-user-]").click(function (e) {
                            const user_id = $(this).data('id');

                            $.ajax({
                                url: `/cmt-promag/detail/{{$work_list_id}}/users/${user_id}`,
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                type: 'DELETE',
                                success: function (data) {
                                    toastr.success(data.status, 'Selamat 🚀 !');
                                    $(addUserButtonElement).click();
                                },
                                error: function (error) {
                                    toastr.error(data.status, 'Opps!');
                                    consol.error(error)
                                }
                            })
                        })
                        return
                    }
                    $('#container-related-users').html(`
                        <div class="text-muted mx-auto text-center">No User has been added yet.</div>
                    `);
                },
                error: function(error) {
                    console.error(error);
                }
            });

            
        })
    }
</script>
@endsection
