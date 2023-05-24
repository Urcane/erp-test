@extends('layouts.app')
@section('title-apps','Login')
@section('toolbar-status','false')
@section('navbar-status','false')

@section('content')
<div class="row h-100">
    <div class="col-lg-12 align-self-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card bgi-no-repeat d-md-flex d-none h-md-450px" style="background-color: #1B283F; background-position: 0 calc(100% + 0.5rem); background-size: 100% auto; background-image:url('{{asset('sense')}}/media/svg/general/rhone.svg')"> 
                                    {{-- <div class="card-body d-flex flex-column justify-content-between pb-0">
                                        <span class="fs-1 fw-bolder">Where Greay Things Happen</span>
                                        <img class="mx-auto" src="{{asset('sense')}}/media/svg/general/rhone.svg" alt="">
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card h-md-450px">
                                    <div class="card-body p-md-8 p-0">
                                        <div class="row">
                                            <div class="col-lg-12 mb-15">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-12 col-8">
                                                        <span class="fs-1 fw-bolder d-block">Hello 👋</span>
                                                        <span class="text-muted">Silahkan Login Sebelum Menggunakan Aplikasi</span>
                                                    </div>
                                                    <div class="col-lg-12 col-4 text-end">
                                                        <img class="w-60px d-md-none" src="{{asset('sense')}}/media/logos/logo-comtel-org.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-15">
                                                <form class="form w-100" id="kt_sign_in_form" action="{{ route('login') }}" method="POST" autocomplete>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                <span class="required fw-bold">Email</span>
                                                            </label>
                                                            <input type="email" :value="old('email')" required autofocus placeholder="" name="email" class="form-control form-control-solid  @error('email') is-invalid @enderror" />
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                                <span class="required fw-bold">Password</span>
                                                            </label>
                                                            <input type="password" placeholder="******" name="password" required autocomplete="current-password" class="form-control form-control-solid  @error('password') is-invalid @enderror" />
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="form-check form-check-sm form-check-solid form-check-custom align-items-start">
                                                                <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember"/>
                                                                <label class="form-check-label ms-2 fw-semibold fs-7" for="remember_me">
                                                                    Remember Me
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-info btn-sm w-100 mb-1">Sign In</button>
                                                    <span class="text-muted fs-7 fw-semibold">Lupa Password ? <a href="#!" class="text-info">Reset Password</a></span>
                                                </div>
                                            </form>
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
</div>
@endsection
