
<div class="modal fade" id="kt_modal_tambah_pegawai" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
			<div class="modal-header py-3">
				<h5 class="fw-bolder">Tambah Pegawai Baru</h5>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<i class="fas fa-times"></i>
				</div>
			</div>
			<div class="modal-body mx-5 mx-lg-15 my-7">
				<form id="kt_modal_tambah_pegawai_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
					@csrf
					<div class="scroll-y me-n10 pe-10" id="kt_modal_tambah_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_tambah_pegawai_header" data-kt-scroll-wrappers="#kt_modal_tambah_pegawai_scroll" data-kt-scroll-offset="300px">
					<div class="row mb-9">
						<div class="col-lg-8 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Nama Lengkap</span>
							</label>
							<input type="text" class="form-control form-control-solid" placeholder="" required name="name">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-4 col-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">NIP</span>
							</label>
							<input type="number" class="form-control form-control-solid" placeholder="" required name="nip">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="fw-bold">NIK</span>
							</label>
							<input type="number" class="form-control form-control-solid" placeholder="" minlength="16" name="nik">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold text-dark">Telepon</span>
							</label>
							<div class="input-group">
								<span class="input-group-text border-0" id="kontak">+62</span>
								<input type="number" class="form-control form-control-solid" required minlength="8" name="kontak"/>
							</div>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold text-dark">Divisi</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="division_id" id="division_id" data-dropdown-parent="#kt_modal_tambah_pegawai">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($dataDivision as $dd)
								<option value="{{$dd->id}}">{{$dd->divisi_name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold text-dark">Penempatan</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="team_id" id="team_id" data-dropdown-parent="#kt_modal_tambah_pegawai">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($dataPlacement as $dp)
								<option value="{{$dp->id}}">{{$dp->team_name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="separator my-3"></div>
						</div>
						<div class="col-lg-8 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Email</span>
							</label>
							<input type="email" class="form-control form-control-solid" placeholder="" required name="email">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-4 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Role</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="role_id" id="role_id" data-dropdown-parent="#kt_modal_tambah_pegawai">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($dataRole as $dr)
								<option value="{{$dr->name}}">{{$dr->name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Password</span>
							</label>
							<input type="password" class="form-control form-control-solid" placeholder="" confirmed required minlength="8" name="new_password">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Konfirmasi Password</span>
							</label>
							<input type="password" class="form-control form-control-solid" placeholder="" required minlength="8" name="new_password_confirmation">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="notice align-items-center d-flex bg-light-primary rounded border-primary border border-dashed p-6">
								<i class="fa-solid fa-exclamation-circle fs-1 me-4 text-primary"></i>
								<div class="d-flex flex-stack flex-grow-1">
									<div class="fs-7">
										<h5 class="text-dark fw-bold mb-0">Perhatian</h5>
										<div class="text-dark">
											Password minimal memiliki <b>8</b> karakter
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					<div class="text-center mt-9">
						<button type="reset" id="kt_modal_tambah_pegawai_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" id="kt_modal_tambah_pegawai_submit" class="btn btn-sm btn-info w-lg-200px">
							<span class="indicator-label">Simpan</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>