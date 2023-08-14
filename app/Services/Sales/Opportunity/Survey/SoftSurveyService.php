<?php

namespace App\Services\Sales\Opportunity\Survey;

use App\Http\Requests\Opportunity\Survey\SoftSurveyRequest;
use App\Models\Opportunity\Survey\SoftSurvey;
use App\Repositories\Sales\Opportunity\Survey\SoftSurveyRepository;
use App\Services\Master\FileService;

class SoftSurveyService 
{
    protected $softSurveyRepository;
    protected $fileService;

    public function __construct(SoftSurveyRepository $softSurveyRepository, FileService $fileService) {
        $this->softSurveyRepository = $softSurveyRepository;
        $this->fileService = $fileService;
    }

    function storeSoftSurvey(SoftSurveyRequest $request) {
        $result = collect($request->content)->map(function ($item) use($request) {
            $item['survey_request_id'] = $request->input('survey_request_id')[0];
            $item['soft_survey_id'] = $request->soft_survey_id;

            $softSurvey = $this->softSurveyRepository->save(collect($item));

            if (isset($item['file_soft_survey_internet'])) {
                $file = $this->fileService->storeFile($softSurvey, [
                    'file' => $item['file_soft_survey_internet'],
                    'filePath' => 'soft-survey',
                    'fileName' => 'File Soft Survey',
                ]);
            }

            return $softSurvey;
        });

        return $result;
    }
}