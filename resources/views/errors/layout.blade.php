@extends('layouts.app')
@section('toolbar-status','false')

@section('content')
<div class="row h-100">
	<div class="col-xl-12 align-self-center">
		<div class="row justify-content-center align-items-center">
			<div class="col-xl-12 col-11 text-center">
				<span class="fs-4x fw-bolder text-dark d-block">@yield('code')</span>
				<span class="fs-6 fw-semibold text-muted">@yield('message')</span>
			</div>
		</div>
	</div>
</div>
@endsection