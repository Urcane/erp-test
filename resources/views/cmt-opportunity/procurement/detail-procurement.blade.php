@extends('layouts.app')
@section('title-apps', 'Detail Procurement')
@section('sub-title-apps', 'Procurement')
@section('desc-apps', 'Pengadaan yang peru diadakan')
@section('icon-apps', 'fa-solid fa-box-open')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('summary-page')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')

    <div class="modal fade" id="modal_status_item" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form id="modal_status_item_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="scroll-y me-n10 pe-10" id="modal_status_item_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_status_item_header"
                            data-kt-scroll-wrappers="#modal_status_item_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Status Item</span>
                                </div>

                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="modal_status_item_cancel"
                                class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal_status_item_submit"
                                class="btn btn-sm btn-info w-lg-200px">
                                <span class="indicator-label">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 p-10">

                                    <div class="row mb-5">
                                        <div class="col-lg-12">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Judul Prospect</span><br>
                                                {{ $boq->customerProspect->prospect_title }}
                                            </label>
                                        </div>
                                        @if ($boq->survey_request_id)
                                            <div class="col-lg-4">
                                                <label class="fs-6 form-label mb-2">
                                                    <span class="fw-bold">Survei ID</span><br>
                                                    {{ $boq->no_survey }}
                                                </label>
                                            </div>
                                        @endif
                                        <div class="col-lg-6 mb-5">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Tipe BOQ</span><br>
                                                {{ $boq->boq_type }}
                                            </label>
                                        </div>

                                        <div class="col-lg-12">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Nama Perusahaan</span><br>
                                                {{ $boq->customerProspect->customer->customer_name }}
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Nama Kontak Customer</span><br>
                                                {{ $boq->customerProspect->customer->customerContact->customer_contact_name }}
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">No Kontak Customer</span><br>
                                                {{ $boq->customerProspect->customer->customerContact->customer_contact_phone }}
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Jenis Project</span><br>
                                                {{ $boq->customerProspect->customer->bussinesType->type_name }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-lg-4">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Sales</span><br>
                                                {{ $boq->sales->name }}
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Technician</span><br>
                                                {{ $boq->technician->name }}
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Procurement</span><br>
                                                {{ $boq->procurement->name }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mt-10">
                                        <div class="col-lg-3">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Modal</span><br>
                                                {{ $boq->modal }}
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Markup</span><br>
                                                {{ $boq->gpm }}
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Profit</span><br>
                                                {{ $boq->npm }}
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="fs-6 form-label mb-2">
                                                <span class="fw-bold">Percentage</span><br>
                                                {{ $boq->percentage }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-10">
                                        <table class="table align-top table-striped border table-rounded gy-5"
                                            id="kt_table_item">
                                            <thead class="">
                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                    <th class="w-50px text-center">#</th>
                                                    <th class="w-200px">Item</th>
                                                    <th class="w-200px">Quantity</th>
                                                    <th class="">Price</th>
                                                    <th class="">Jasa Antar</th>
                                                    <th class="">Total Price</th>
                                                    <th class="">Markup Price</th>
                                                    <th class="w-50px text-center">#</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-7">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getStatus(id) {
            console.log("ASdfsf")
            var dataId = $(this).data("id");

            // $.ajax({
            //     url: "{{ route('com.procurement.getStatusItem')}}",
            //     headers: {
            //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
            //     },
            //     type: 'POST',
            //     data: {
            //         id: dataId,
            //     },
            //     success: function(data) {
            //         toastr.success(data.message, 'Selamat 🚀 !');
            //         $(element).remove()
            //     },
            //     error: function(xhr, status, error) {
            //         const data = xhr.responseJSON;
            //         toastr.error(data.message, 'Opps!');
            //     }
            // });
        }
        $(document).ready(function() {
            generateDatatable({
                elementName: "#kt_table_item",
                ajaxLink: "{{ route('com.procurement.getTableItem', ['id' => $boq->id]) }}",
                filters: {
                    is_done: true,
                },
                columnData: [{
                        data: 'id'
                    },
                    {
                        data: 'item_detail'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'purchase_price'
                    },
                    {
                        data: 'purchase_delivery_charge'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'markup_price'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });
    </script>
@endsection
