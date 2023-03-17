@extends('layouts.app')
@section('title','Dashboard')
@section('toolbar-status','false')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('content')
<div class="row h-100">
	<div class="col-lg-12 align-self-center">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-8">
				<div class="text-center">
					<img src="{{asset('sense')}}/media/auth/ok-dark.png" class="mw-100 mh-350px theme-light-show" alt="">
					<img src="{{asset('sense')}}/media/auth/ok-dark.png" class="mw-100 mh-350px theme-dark-show" alt="">
				</div>
			</div>
			<div class="col-lg-12 col-11 text-center">
				<span class="fs-1 fw-bolder text-dark d-block">Selamat Datang di Comtel Apps</span>
				<span class="fs-6 fw-semibold text-muted">Buat BA Online, Psikotes Online sampai Payroll nanti ada di Comtel Apps 🙏</span>
			</div>
		</div>
	</div>
</div>
@endsection
