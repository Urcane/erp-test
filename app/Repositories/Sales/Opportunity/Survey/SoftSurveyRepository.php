<?php

namespace App\Repositories\Sales\Opportunity\Survey;

use App\Models\Opportunity\Survey\SoftSurvey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SoftSurveyRepository
{
    protected $model;

    public function __construct(SoftSurvey $model) {
        $this->model = $model;
    }

    function save(Collection $data) : SoftSurvey {
        return SoftSurvey::updateOrCreate([
            'id' => $data['soft_survey_id'],
        ], 
        [
            'survey_request_id' => $data['survey_request_id'],
            'description' => $data['description'],
            'attachment_url' => $data['file_soft_survey_internet'],
        ]);
    }

    function getAll(Request $request) : Builder {
        return SoftSurvey::with('survey_request', 'attachments');
    }
}
