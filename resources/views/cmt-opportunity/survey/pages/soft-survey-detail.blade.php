@extends('cmt-opportunity.survey.index')

@section('survey-content')
@php
    $selected_side_bar_content = 'soft-survey'
@endphp
<div class="row mb-6 align-items-center">
    <div class="card-body d-flex flex-column flex-center">  
        <div class="mb-2">
            <h1 class="fw-semibold text-gray-800 text-center lh-lg">           
                Soft Survey<br>
                <span class="fw-bolder">{{$surveyRequest->no_survey}}</span>
            </h1>
        </div>
        @foreach ($surveyRequest->softSurveys as $softSurvey)        
        <div class="card card-shadow-sm m-1"> 
            <div class="card-header">
                <h2 class="card-title">Soft Survey Point ke - {{$loop->index + 1}}</h2>
            </div>
            <div class="card-body">
                <div class="py-10 text-center">
                    <img src="{{asset('filestorage') . '/'. $softSurvey->attachment->path}}" class="img-fluid" alt="">
                </div>
                <div class="py-5 text-dark">
                    <h3 class="fs-5">Description: </h3>
                    <p class="fs-6">{{$softSurvey->description}} </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    
</script>

@endsection
