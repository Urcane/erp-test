<?php

namespace App\Repositories\Sales\Opportunity\Survey;

use App\Models\Opportunity\Survey\SurveyRequest;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurveyRequestRepository
{
    protected $model;

    public function __construct(SurveyRequest $model) {
        $this->model = $model;
    }

    function save($data) : SurveyRequest {
        return SurveyRequest::updateOrCreate([
            'id' => $data->survey_request_id,
            'customer_prospect_id' => $data->prospectId,
        ], 
        [
            'customer_prospect_id' => $data->prospectId,
            'service_type_id' => $data->service_type_id,
            'type_of_survey_id' => $data->type_of_survey_id,
            'no_survey' => $data->no_survey,
            'survey_datetime' => $data->request_date,
            'lat' => $data->lat,
            'lang' => $data->lang,
            'closest_bts' => $data->closest_bts,
            'notes' => $data->notes,
        ]);
    }

    function getAll(Request $request) : EloquentBuilder {
        $filters = $request->filters;
        $model = $this->model;
        
        if ($filters['status'] == 'ST') {
            $model = $model->unProcess();
        }
        if ($filters['status'] == 'PR') {
            $model = $model->onProcess();
        }
        if ($filters['status'] == 'DN') {
            $model = $model->done();
        }

        if (isset($filters['only-soft-survey']) && $filters['only-soft-survey'] == 'true') {
            $model->where('type_of_survey_id', 1);
        }

        if (isset($filters['only-site-survey']) && $filters['only-site-survey'] == 'true') {
            $model->where('type_of_survey_id', 2);
        }

        return $model->with('customerProspect.customer', 'serviceType', 'typeOfSurvey');
    }

    function getById(int $id) : EloquentBuilder {
        return $this->getByIdWithoutRelationship($id)->with('customerProspect.customer.customerContact', 'serviceType', 'typeOfSurvey');
    }

    function getByIdWithoutRelationship(int $id) : EloquentBuilder {
        return SurveyRequest::where('id', $id);
    }
}
