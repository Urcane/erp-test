@extends('cmt-customer.promag.detail')

@section('promag-detail-content')
<div class="d-flex flex-wrap flex-stack my-5">
    <h3 class="fw-bold my-2">
        File Project
        <span class="fs-6 text-gray-400 fw-semibold ms-1">+14</span>
    </h3>

    <div class="d-flex my-2">
        <div class="d-flex align-items-center position-relative me-4">
            <i class="ki-outline ki-magnifier fs-3 position-absolute translate-middle-y top-50 ms-4"></i>            
            <input type="text" id="kt_filter_search" class="form-control form-control-sm form-control-solid bg-body fw-semibold fs-7 w-150px ps-11" placeholder="Search">
        </div>
    </div>
</div>
<div class="row g-6 g-xl-9 mb-6 mb-xl-9">    
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card h-100 ">
            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
                    <div class="symbol symbol-60px mb-5">
                        <img src="{{ asset('/sense/media/svg/files/pdf.svg')}}" class="theme-light-show" alt="">
                        <img src="{{ asset('/sense/media/svg/files/pdf-dark.svg')}}" class="theme-dark-show" alt="">
                    </div>
                    
                    <div class="fs-5 fw-bold mb-2">
                        Customer Document
                    </div>
                </a>
                
                <div class="fs-7 fw-semibold text-gray-400">
                    3 days ago
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card h-100 ">
            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
                    <div class="symbol symbol-60px mb-5">
                        <img src="{{ asset('/sense/media/svg/files/doc.svg')}}" class="theme-light-show" alt="">
                        <img src="{{ asset('/sense/media/svg/files/doc-dark.svg')}}" class="theme-dark-show" alt="">
                    </div>
                    
                    <div class="fs-5 fw-bold mb-2">
                        Draft Document
                    </div>
                </a>
                
                <div class="fs-7 fw-semibold text-gray-400">
                    3 days ago                        
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card h-100 flex-center bg-light-primary border-primary border border-dashed p-8">
            <img src="{{asset('/sense/media/svg/files/upload-primary.svg')}}" class="mb-5" alt="">
            
            <a href="#" class="text-hover-primary fs-5 fw-bold mb-2">
                File Upload
            </a>
            
            <div class="fs-7 fw-semibold text-gray-400">
                Drag and drop files here
            </div>
        </div>
    </div>
</div>
@endsection
