@extends('cmt-customer.promag.detail')

@section('promag-detail-content')
<div class="row g-6 g-xl-9">
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.overview.task-summary')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.overview.task-overtime')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.overview.card-date')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.overview.summary-file')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.overview.card-contributor')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.overview.task-recent')
    </div>
</div>
@include('cmt-customer.promag.component.overview.table-project-spend')
@endsection
