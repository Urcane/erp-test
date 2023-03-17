@extends('layouts.app')
@section('title','Dashboard')
@section('toolbar-status','false')
@section('navbar-status','false')

@section('content')
<div class="row h-100">
	<div class="col-lg-12 align-self-center">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form class="form w-100" id="kt_sign_in_form" action="{{ route('login') }}" method="POST" autocomplete>
                            @csrf
                            <div class="text-center mb-8">
                                <h1 class="text-dark fw-bolder">Sign In</h1>
                                <div class="text-muted fw-semibold fs-6">Silahkan Masuk Sebelum Menggunakan Sistem</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="email" :value="old('email')" required autofocus placeholder="Email" name="email" class="form-control form-control-solid  @error('email') is-invalid @enderror" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Password" name="password" required autocomplete="current-password" class="form-control form-control-solid  @error('password') is-invalid @enderror" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 mt-8 fs-base fw-semibold mb-8">
                                <div>
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary btn-sm"><span class="indicator-label">Sign In</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
