<div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Search Users</h1>
                    <div class="text-muted fw-semibold fs-5">
                        Invite Collaborators To Your Project
                    </div>
                </div>
                <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline" data-kt-search="true">
                    <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                        <input type="hidden" />
                        <input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search by username, full name or email..." data-kt-search-element="input" />
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner"> <span class="spinner-border h-15px w-15px align-middle text-muted"></span> </span>
                        <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear"> <i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0"><span class="path1"></span>
                        <span class="path2"></span>
                            </i>
                            </span>
                    </form>
                    <div class="py-5">
                        <div data-kt-search-element="suggestions">
                            <h3 class="fw-semibold mb-5">Recently searched:</h3>
                            <div class="mh-375px scroll-y me-n7 pe-7">
                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5">
                                        <img alt="Pic" src="" />
                                    </div>
                                    <div class="fw-semibold">
                                        <span class="fs-6 text-gray-800 me-2">Emma Smith</span>
                                        <span class="badge badge-light">Art Director</span>
                                    </div>
                                </a>
                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5">
                                        <span class="symbol-label bg-light-danger text-danger fw-semibold"> M </span>
                                    </div>
                                    <div class="fw-semibold">
                                        <span class="fs-6 text-gray-800 me-2">Melody Macy</span>
                                        <span class="badge badge-light">Marketing Analytic</span>
                                    </div>
                                </a>
                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5">
                                        <img alt="Pic" src="" />
                                    </div>
                                    <div class="fw-semibold">
                                        <span class="fs-6 text-gray-800 me-2">Max Smith</span>
                                        <span class="badge badge-light">Software Enginer</span>
                                    </div>
                                </a>
                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5">
                                        <img alt="Pic" src="" />
                                    </div>
                                    <div class="fw-semibold">
                                        <span class="fs-6 text-gray-800 me-2">Sean Bean</span>
                                        <span class="badge badge-light">Web Developer</span>
                                    </div>
                                </a>
                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                    <div class="symbol symbol-35px symbol-circle me-5">
                                        <img alt="Pic" src="" />
                                    </div>
                                    <div class="fw-semibold">
                                        <span class="fs-6 text-gray-800 me-2">Brian Cox</span>
                                        <span class="badge badge-light">UI/UX Designer</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div data-kt-search-element="results" class="d-none">
                            <div class="mh-375px scroll-y me-n7 pe-7">
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="0" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Smith</a>
                                            <div class="fw-semibold text-muted">
                                                smith@kpmg.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-43-wzfg" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2" selected="" data-select2-id="select2-data-45-vscm">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-44-u184" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-nmfq-container" aria-controls="select2-nmfq-container"><span class="select2-selection__rendered" id="select2-nmfq-container" role="textbox" aria-readonly="true" title="Owner">Owner</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="1">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='1']" value="1" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-danger text-danger fw-semibold"> M </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                            <div class="fw-semibold text-muted">
                                                melody@altbox.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-46-0x96" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1" selected="" data-select2-id="select2-data-48-bc29">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-47-1occ" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-4w3s-container" aria-controls="select2-4w3s-container"><span class="select2-selection__rendered" id="select2-4w3s-container" role="textbox" aria-readonly="true" title="Guest">Guest</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="2">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='2']" value="2" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max Smith</a>
                                            <div class="fw-semibold text-muted">
                                                max@kt.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-49-6bl7" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-51-ddix">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-50-csag" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-aytd-container" aria-controls="select2-aytd-container"><span class="select2-selection__rendered" id="select2-aytd-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="3">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='3']" value="3" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean Bean</a>
                                            <div class="fw-semibold text-muted">
                                                sean@dellito.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-52-evme" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2" selected="" data-select2-id="select2-data-54-zx9h">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-53-4hwp" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kuuw-container" aria-controls="select2-kuuw-container"><span class="select2-selection__rendered" id="select2-kuuw-container" role="textbox" aria-readonly="true" title="Owner">Owner</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="4">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='4']" value="4" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian Cox</a>
                                            <div class="fw-semibold text-muted">
                                                brian@exchange.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-55-788g" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-57-huxo">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-56-jjxh" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ylc0-container" aria-controls="select2-ylc0-container"><span class="select2-selection__rendered" id="select2-ylc0-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="5">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='5']" value="5" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-warning text-warning fw-semibold"> C </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>
                                            <div class="fw-semibold text-muted">
                                                mik@pex.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-58-gp8a" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2" selected="" data-select2-id="select2-data-60-91sn">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-59-nmm3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-uc0d-container" aria-controls="select2-uc0d-container"><span class="select2-selection__rendered" id="select2-uc0d-container" role="textbox" aria-readonly="true" title="Owner">Owner</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="6">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='6']" value="6" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
                                            <div class="fw-semibold text-muted">
                                                f.mit@kpmg.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-61-b2ks" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-63-k0tf">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-62-xhov" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-59j0-container" aria-controls="select2-59j0-container"><span class="select2-selection__rendered" id="select2-59j0-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="7">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='7']" value="7" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-danger text-danger fw-semibold"> O </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia Wild</a>
                                            <div class="fw-semibold text-muted">
                                                olivia@corpmail.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-64-8os7" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2" selected="" data-select2-id="select2-data-66-o7ea">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-65-yqpp" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-0mpa-container" aria-controls="select2-0mpa-container"><span class="select2-selection__rendered" id="select2-0mpa-container" role="textbox" aria-readonly="true" title="Owner">Owner</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="8">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='8']" value="8" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-primary text-primary fw-semibold"> N </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil Owen</a>
                                            <div class="fw-semibold text-muted">
                                                owen.neil@gmail.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-67-4vda" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1" selected="" data-select2-id="select2-data-69-z926">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-68-rsb6" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-izm7-container" aria-controls="select2-izm7-container"><span class="select2-selection__rendered" id="select2-izm7-container" role="textbox" aria-readonly="true" title="Guest">Guest</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="9">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='9']" value="9" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan Wilson</a>
                                            <div class="fw-semibold text-muted">
                                                dam@consilting.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-70-5vj6" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-72-cajr">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-71-nlww" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-twcl-container" aria-controls="select2-twcl-container"><span class="select2-selection__rendered" id="select2-twcl-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="10">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='10']" value="10" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-danger text-danger fw-semibold"> E </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma Bold</a>
                                            <div class="fw-semibold text-muted">
                                                emma@intenso.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-73-af2o" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2" selected="" data-select2-id="select2-data-75-5ais">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-74-39k2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ug8p-container" aria-controls="select2-ug8p-container"><span class="select2-selection__rendered" id="select2-ug8p-container" role="textbox" aria-readonly="true" title="Owner">Owner</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="11">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='11']" value="11" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana Crown</a>
                                            <div class="fw-semibold text-muted">
                                                ana.cf@limtel.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-76-94gr" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1" selected="" data-select2-id="select2-data-78-85g3">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-77-2cou" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-rn8w-container" aria-controls="select2-rn8w-container"><span class="select2-selection__rendered" id="select2-rn8w-container" role="textbox" aria-readonly="true" title="Guest">Guest</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="12">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='12']" value="12" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-info text-info fw-semibold"> A </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert Doe</a>
                                            <div class="fw-semibold text-muted">
                                                robert@benko.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-79-qt05" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-81-wv0y">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-80-7lr4" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-0308-container" aria-controls="select2-0308-container"><span class="select2-selection__rendered" id="select2-0308-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="13">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='13']" value="13" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John Miller</a>
                                            <div class="fw-semibold text-muted">
                                                miller@mapple.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-82-8l65" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-84-9qkq">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-83-okv3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-5rq7-container" aria-controls="select2-5rq7-container"><span class="select2-selection__rendered" id="select2-5rq7-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="14">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='14']" value="14" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-success text-success fw-semibold"> L </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
                                            <div class="fw-semibold text-muted">
                                                lucy.m@fentech.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-85-qzy2" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2" selected="" data-select2-id="select2-data-87-r22e">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-86-jciv" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-yh9q-container" aria-controls="select2-yh9q-container"><span class="select2-selection__rendered" id="select2-yh9q-container" role="textbox" aria-readonly="true" title="Owner">Owner</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="15">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='15']" value="15" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="" />
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
                                            <div class="fw-semibold text-muted">
                                                ethan@loop.com.au
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-88-94nx" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1" selected="" data-select2-id="select2-data-90-q596">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-89-e5nf" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-wxh7-container" aria-controls="select2-wxh7-container"><span class="select2-selection__rendered" id="select2-wxh7-container" role="textbox" aria-readonly="true" title="Guest">Guest</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="16">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='16']" value="16" /> </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-success text-success fw-semibold"> L </span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
                                            <div class="fw-semibold text-muted">
                                                lucy.m@fentech.com
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 w-100px">
                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-91-ytfo" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option value="1">Guest</option>
                                            <option value="2">Owner</option>
                                            <option value="3" selected="" data-select2-id="select2-data-93-lgf0">Can Edit</option>
                                        </select>
                                        <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-92-b7pq" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-1ctd-container" aria-controls="select2-1ctd-container"><span class="select2-selection__rendered" id="select2-1ctd-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span>
                                        <span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-center mt-15">
                                <button type="reset" id="kt_modal_users_search_reset" data-bs-dismiss="modal" class="btn btn-active-light me-3"> Cancel </button>
                                <button type="submit" id="kt_modal_users_search_submit" class="btn btn-primary"> Add Selected Users </button>
                            </div>
                        </div>
                        <div data-kt-search-element="empty" class="text-center d-none">
                            <div class="fw-semibold py-10">
                                <div class="text-gray-600 fs-3 mb-2">
                                    No users found
                                </div>
                                <div class="text-muted fs-6">
                                    Try to search by username, full name or email...
                                </div>
                            </div>
                            <div class="text-center px-5">
                                <img src="" alt="" class="w-100 h-200px h-sm-325px" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>