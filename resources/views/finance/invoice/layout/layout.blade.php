@extends('layouts.app')

@section('title-apps', 'Invoice')
@section('sub-title-apps', 'Finance')

@section('navbar')
    @include('layouts.navbar.navbar')
@endsection

@section('toolbar')
    @include('layouts.navbar.toolbar')
@endsection

@section('content')
    <style>

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row justify-content-center mt-n20">
        <div class="col-lg-12 mt-n20">
            <div class="row justify-content-center mt-md-n20">
                <div class="col-lg-3 mb-6 mb-md-0 mt-md-n14">
                    @include('finance.invoice.layout.sidebar')
                </div>

                @yield('main_content')

            </div>
        </div>
    </div>
@endsection
