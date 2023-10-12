@extends('layouts.app')
@section('title-apps', 'Detail Item Procurement')
@section('sub-title-apps', 'Procurement')
@section('desc-apps', 'Detail informasi dan status item')
@section('icon-apps', 'fa-solid fa-box-open')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <div class="modal fade" id="update_status" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <form action="{{ route('com.procurement.updateItemProcurement', ['id' => $procurementItem->id]) }}" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        @csrf
                        <div class="scroll-y me-n10 pe-10" id="update_status_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#update_status_header" data-kt-scroll-wrappers="#update_status_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-9">
                                <div class="col-lg-12 text-center mb-9">
                                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Update Procurement</span>
                                    {{-- <span class="fs-7 fw-semibold text-gray-500">Keanggotaan keluarga anda</span> --}}
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2">
                                        <span class="required fw-bold">Status</span>
                                    </label>
                                    <select class="drop-data form-select form-select-solid"
                                        name="status" id="status" required>
                                        <option value="" selected hidden disabled>Pilih status terbaru</option>
                                        @foreach ($dataStatus as $data)
                                            <option value="{{ $data }}">{{ $data }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3" id="main_form">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="d-flex align-items-center fs-6 form-label mb-2"
                                        for="description">
                                        <span class=" fw-bold">Description</span>
                                    </label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control form-control-solid" placeholder="Masukkan deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <button type="reset" id="update_status_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="update_status_submit" class="btn btn-sm btn-info w-lg-200px">
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
                                <div class="col-lg-12 mb-9 row">
                                    <div class="col-lg-2">
                                        <a href="{{ route('com.procurement.detail', ["id" => $procurementItem->procurement_id]) }}" class="fw-bold"><i
                                                class="fa-solid fa-arrow-left "></i> Back</a>
                                    </div>
                                    <div class="col-lg-8 text-center mb-9">
                                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Item Details</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="#update_status" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 btn_tambah_update_status w-100"><i class="fa-solid fa-plus"></i>Update Status</a>
                                    </div>
                                </div>
                                <div class="col-lg-12 row mt-10">
                                    <h4>Item Information</h4>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="good_name">
                                            <span class="fw-bold">Nama Item</span>
                                        </label>
                                        <input type="text" id="good_name" class="form-control form-control-solid"
                                            value="{{ $procurementItem->inventoryGood->good_name }}" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="merk">
                                            <span class="fw-bold">Merk</span>
                                        </label>
                                        <input type="text" id="merk" class="form-control form-control-solid"
                                            value="{{ $procurementItem->inventoryGood->merk }}" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2"
                                            for="description">
                                            <span class="fw-bold">Desciption Item</span>
                                        </label>
                                        <input type="text" id="description" class="form-control form-control-solid"
                                            value="{{ $procurementItem->inventoryGood->description }}" disabled>
                                    </div>
                                </div>
                                <h4 class="mt-10">Order Information</h4>
                                @include("cmt-opportunity.procurement.form-procurement-item-part.purchase-form", ["disabled" => true])
                                <hr class="my-10">
                                <div class="col-lg-12 row">
                                    <h4>Status</h4>
                                    @foreach ($procurementItem->procurementItemStatus as $itemStatus)
                                        <div class="col-lg-12 d-flex flex-row mt-5 ms-5 @if($loop->iteration == 1) text-success @endif">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-regular fa-circle-check fs-1 @if($loop->iteration == 1) text-success @endif"></i>
                                            </div>
                                            <div class="ms-5">
                                                <h4 class="@if($loop->iteration == 1) text-success @endif">{{$itemStatus->status}}</h4>
                                                <span>{{$itemStatus->created_at}}</span><br>
                                                <span>{{$itemStatus->description}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#status').change(function () {
            $("#main_form").html(``);
            if ($(this).val() == "Making an order") {
                $("#main_form").html(`@include("cmt-opportunity.procurement.form-procurement-item-part.purchase-form", ["disabled" => false])`);
            }
        })
    </script>
@endsection
