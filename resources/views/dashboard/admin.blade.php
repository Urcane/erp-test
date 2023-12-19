@extends('layouts.app')
@section('title-apps','Selamat Datang')
@section('toolbar-status','false')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('content')
<div class="row h-100">
	<div class="col-lg-12 align-self-center">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-12">
				<div class="row justify-content-center">
					<div class="col-lg-4">
						<div class="row">
							<div class="col-lg-12 mb-6 mb-md-0">
								<a href="{{route('hc.emp.profile',['id'=>auth()->user()->id])}}">
									<div class="card bg-primary text-center" style="height:420px">
										<div class="card-body d-flex flex-column justify-content-between">
											<span class="fs-3 fw-bolder text-white mb-3">Profile & Time Management
												<p class="fs-7 mb-0 fw-semibold text-white">Pengelolaan Waktu yang Lebih Baik, Profil yang Lebih Unggul.</p>
											</span>
											<img class="mx-auto w-300px" src="{{asset('sense')}}/media/logos/profile_time_management.png" alt="">
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="row">
							<div class="col-lg-12 mb-6 mb-md-6">
								<a href="{{route("hc.emp.index")}}">
									<div class="card h-200px" style="background-color:#9367EF">
										<div class="card-body">
											<div class="row align-items-center mt-8">
												<div class="col-lg-4 col-4">
													<img class="mx-auto w-100px" src="{{asset('sense')}}/media/logos/employee_management.png" alt="">
												</div>
												<div class="col-lg-8 col-8">
													<span class="fs-3 fw-bolder text-white mb-3">Employee Management
														<p class="fs-7 fw-semibold text-white mb-0">Berkolaborasi, Berkembang, Bersama-sama.</p>
													</span>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
                        <div class="col-lg-12 mb-0">
                            <div class="row">
                                <div class="col-lg-6 col-6 mb-6 mb-md-0">
                                    <a href="#!">
                                        <div class="card bg-gray-500 text-center h-200px">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <img class="mx-auto w-100px mb-3" src="{{asset('sense')}}/media/logos/logo-comtel-nig.png" alt="">
                                                <span class="fs-3 fw-bolder text-white">Coming Soon
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-6 mb-6 mb-md-0">
                                    <a href="#!">
                                        <div class="card text-center h-200px bg-gray-500">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <img class="mx-auto w-100px mb-3" src="{{asset('sense')}}/media/logos/logo-comtel-nig.png" alt="">
                                                <span class="fs-3 fw-bolder text-white">Coming Soon
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
					</div>
					{{-- <div class="col-lg-4">
						<div class="row">
							<div class="col-lg-12 mb-6">
								<a href="#!">
									<div class="card h-200px bg-info">
										<div class="card-body">
											<div class="row align-items-center mt-8">
												<div class="col-lg-4 col-4">
													<img class="mx-auto w-100px" src="{{asset('sense')}}/media/logos/logo-comtel-nig.png" alt="">
												</div>
												<div class="col-lg-8 col-8">
													<span class="fs-3 fw-bolder text-white mb-3">Nama Menu
														<p class="fs-7 fw-semibold text-white mb-0">Deskripsi Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
													</span>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6 col-6 mb-6 mb-md-0">
										<a href="#!">
											<div class="card bg-primary text-center h-200px">
												<div class="card-body d-flex flex-column justify-content-between">
													<img class="mx-auto w-100px mb-3" src="{{asset('sense')}}/media/logos/logo-comtel-nig.png" alt="">
													<span class="fs-3 fw-bolder text-white">Nama Menu
													</span>
												</div>
											</div>
										</a>
									</div>
									<div class="col-lg-6 col-6 mb-6 mb-md-0">
										<a href="#!">
											<div class="card text-center h-200px" style="background-color: #FF8D69">
												<div class="card-body d-flex flex-column justify-content-between">
													<img class="mx-auto w-100px mb-3" src="{{asset('sense')}}/media/logos/logo-comtel-nig.png" alt="">
													<span class="fs-3 fw-bolder text-white">Nama Menu
													</span>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
