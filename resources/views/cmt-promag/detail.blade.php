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
        const processs = function(search) {
            const timeout = setTimeout(function() {
                const number = KTUtil.getRandomInt(1, 6);

                // Hide recently viewed
                suggestionsElement.classList.add("d-none");

                if (number === 3) {
                    // Hide results
                    resultsElement.classList.add("d-none");
                    // Show empty message
                    emptyElement.classList.remove("d-none");
                } else {
                    // Show results
                    resultsElement.classList.remove("d-none");
                    // Hide empty message
                    emptyElement.classList.add("d-none");
                }

                // Complete search
                search.complete();
            }, 1500);
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

            console.log(user);
            return `
            <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                <div class="symbol symbol-35px symbol-circle me-5">
                    <img alt="Pic" src="${profile_pic}" />
                </div>
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">${user.name}</span>
                    <span class="badge badge-light">${user.division.divisi_name}</span>
                </div>
            </a>
            `
        }

        // Elements
        element = document.querySelector('#kt_modal_users_search_handler');

        wrapperElement = element.querySelector('[data-kt-search-element="wrapper"]');
        suggestionsElement = element.querySelector('[data-kt-search-element="suggestions"]');
        resultsElement = element.querySelector('[data-kt-search-element="results"]');
        emptyElement = element.querySelector('[data-kt-search-element="empty"]');

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

        $(addUserButtonElement).click(function (e) {
            $.ajax({
                url: "{{route('com.promag.detail.users', ['work_list_id' => $work_list_id])}}",
                type: 'GET',
                success: function(response) {
                    $('#container-related-users').html("");

                    if (response.data.users.length >= 1) {
                        response.data.users.forEach(user => {
                            $('#container-related-users').html(viewRelatedUser(user));
                        });
                        return
                    }
                    $('#container-related-users').html(`
                        <div class="text-muted mx-auto text-center">No User has been added yet.</div>
                    `);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
    }
</script>
@endsection
