
<div class="modal fade" id="kt_modal_tambah_lead" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
			<div class="modal-header py-3">
				<h5 class="fw-bolder">Tambah Lead Baru</h5>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<i class="fas fa-times"></i>
				</div>
			</div>
			<div class="modal-body mx-5 mx-lg-15 my-7">
				<form id="kt_modal_tambah_lead_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
					@csrf
					<div class="scroll-y me-n10 pe-10" id="kt_modal_tambah_lead_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_tambah_lead_header" data-kt-scroll-wrappers="#kt_modal_tambah_lead_scroll" data-kt-scroll-offset="300px">
					<div class="row mb-9">
						<div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Nama Perusahaan/Badan Usaha</span>
							</label>
							<input type="text" class="form-control form-control-solid" placeholder="" required name="customer_name">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Jenis Bisnis</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="bussines_type_id" id="bussines_type_id" data-dropdown-parent="#kt_modal_tambah_lead">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($getBussines as $gb)
								<option value="{{$gb->id}}">{{$gb->type_name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Referensi Dari</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="lead_reference_id" id="lead_reference_id" data-dropdown-parent="#kt_modal_tambah_lead">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($getLead as $gl)
								<option value="{{$gl->id}}">{{$gl->lead_reference_name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-12 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Alamat</span>
							</label>
							<textarea class="form-control form-control-solid" placeholder="" rows="2" required name="customer_address" style="resize:none"></textarea>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Kota/Kabupaten</span>
							</label>
							<select class="drop-data form-select form-select-solid" data-control="select2" required name="city_id" id="city_id" data-dropdown-parent="#kt_modal_tambah_lead">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($getCity as $gc)
								<option value="{{$gc->id}}">{{$gc->city_name}}</option>									
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-6 col-6 mb-3">
									<label class="d-flex align-items-center fs-6 form-label mb-2">
										<span class="fw-bold">Lat</span>
									</label>
									<input type="text" class="form-control form-control-solid" placeholder="" name="lat">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
								<div class="col-lg-6 col-6 mb-3">
									<label class="d-flex align-items-center fs-6 form-label mb-2">
										<span class="fw-bold">Lng</span>
									</label>
									<input type="text" class="form-control form-control-solid" placeholder="" name="lng">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="separator my-3"></div>
						</div>
						<div class="col-lg-8 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Nama Kontak</span>
							</label>
							<input type="text" class="form-control form-control-solid" placeholder="" required name="customer_contact_name">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-4 col-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Jabatan</span>
							</label>
							<input type="text" class="form-control form-control-solid" placeholder="" required name="customer_contact_job">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="fw-bold">Email</span>
							</label>
							<input type="email" class="form-control form-control-solid" placeholder="" name="customer_contact_email">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-lg-6 col-4 mb-3">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold text-dark">Telepon</span>
							</label>
							<div class="input-group">
								<span class="input-group-text border-0">+62</span>
								<input type="number" class="form-control form-control-solid" required minlength="9" maxlength="13" name="customer_contact_phone"/>
							</div>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
					</div>
				</div>
					<div class="text-center mt-9">
						<button type="reset" id="kt_modal_tambah_lead_cancel" class="btn btn-sm btn-light me-3 w-lg-200px" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" id="kt_modal_tambah_lead_submit" class="btn btn-sm btn-info w-lg-200px">
							<span class="indicator-label">Simpan</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>