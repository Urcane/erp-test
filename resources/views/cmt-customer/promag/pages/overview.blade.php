@extends('cmt-customer.promag.detail')

@section('promag-detail-content')
<div class="row g-6 g-xl-9">
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.task-summary')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.task-overtime')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.card-date')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.summary-file')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.card-contributor')
    </div>
    <div class="col-lg-6">
        @include('cmt-customer.promag.component.task-recent')
    </div>
</div>
@include('cmt-customer.promag.component.table-project-spend')
@endsection
