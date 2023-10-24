@extends('layouts.app')
@section('title-apps', 'Detail Procurement')
@section('sub-title-apps', 'Procurement')
@section('desc-apps', 'Detail informasi procuremetn')
@section('icon-apps', 'fa-solid fa-box-open')

@section('navbar')
    @include('layouts.navbar.navbar')
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
                                @include("cmt-opportunity.procurement.form-procurement-item-part.basic-form")
                                <div class="col-lg-6">
                                    <h4>Item From BOQ</h4>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table align-top table-striped border table-rounded gy-5"
                                            id="kt_table_item">
                                            <thead class="">
                                                <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                                    <th class="w-50px text-center">#</th>
                                                    <th class="w-200px">Name</th>
                                                    <th class="w-200px">Spesification</th>
                                                    <th class="w-200px">Quantity</th>
                                                    <th class="">Price</th>
                                                    <th class="">Jasa Antar</th>
                                                    <th class="">Total Price</th>
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
        $(document).ready(function () {
            generateDatatable({
                elementName: "#kt_table_item",
                ajaxLink: "{{ route('com.procurement.getTableItemProcurement') }}",
                filters: {
                    id: {{ $procurement->id }},
                },
                columnData: [
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'good_name'
                    },

                    {
                        data: 'spesification'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'shipping_price'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        })
    </script>
@endsection
