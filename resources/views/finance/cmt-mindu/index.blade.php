@extends('layouts.app')
@section('title','CMT-EMP')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('toolbar')
@include('layouts.navbar.toolbar')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <span class="fs-7 fw-bolder text-dark pe-4 text-nowrap d-none d-lg-block">List Karyawan</span>
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_department" id="filter_department">
                                    <option value="*" selected>All Deparment</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_divisi" id="filter_divisi">
                                    <option value="*" selected>All Divisi</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-select form-select-sm w-auto" data-control="select2" name="filter_level" id="filter_level">
                                    <option value="*" selected>Level</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="#kt_modal_tambah_karyawan" data-bs-toggle="modal" class="btn btn-primary btn-sm me-2 btn_tambah_karyawan"><i class="fa-solid fa-plus me-1"></i>Karyawan Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table align-middle table-striped border table-rounded gy-5" id="kt_table_pegawai">
                                    <thead>
                                        <tr class="fw-bold fs-7 text-muted text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="">Karyawan</th>
                                            <th class="w-100px">NIK</th>
                                            <th class="w-150px">Kontak</th>
                                            <th class="w-150px">Department</th>
                                            <th class="w-150px">Divisi</th>
                                            <th class="w-100px text-center">#</th>
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

<script>
    $(document ).ready(function() {
        
    });
</script>

@endsection
