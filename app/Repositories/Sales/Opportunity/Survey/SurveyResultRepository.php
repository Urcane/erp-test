<?php

namespace App\Repositories\Sales\Opportunity\Survey;

use App\Http\Requests\Opportunity\Survey\SurveyResult\SurveyResultCCTVRequest;
use App\Http\Requests\Opportunity\Survey\SurveyResult\SurveyResultInternetRequest;
use App\Models\Opportunity\Survey\SiteSurvey;
use App\Models\Opportunity\Survey\SiteSurveyCCTV;
use App\Models\Opportunity\Survey\SiteSurveyInternet;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ReflectionClass;

class SurveyResultRepository
{
    protected $model;

    public function __construct(SiteSurvey $model) {
        $this->model = $model;
    }

    function save($data, $modelType) : EloquentBuilder {
        $siteSurvey = SiteSurvey::create([
            'survey_request_id' => $data->survey_request_id,
            'work_order_id' => $data->work_order_id,
            'service_type_id' => $data->service_type_id,
            'trans_media_id' => $data->trans_media_id,
            'internet_service_type_id' => $data->internet_service_type_id,
            'existing_connection' => $data->existing_connection,
            'transportation_access' => $data->transportation_access,
            'building_type' => $data->building_type,
            'building_height' => $data->building_height,
            'building_floor_count' => $data->building_floor_count,
            'building_rooftop_state' => $data->building_rooftop_state ?? 0,
            'building_electricity_state' => $data->building_electricity_state ?? 0,
            'building_electricity_time' => $data->building_electricity_time,
            'building_electricity_type' => $data->building_electricity_type,
        ]);

        $this->handleSaveChild($siteSurvey, $data, $modelType);
        
        $modelName = (new ReflectionClass($modelType))->getShortName();
        $modelName[0] = strtolower($modelName[0]);
        return $siteSurvey->with("$modelName");
    }

    private function handleSaveChild(SiteSurvey $siteSurvey, $data, $modelType) {
        if ($modelType instanceof SiteSurveyCCTV) {
            return $this->saveSiteSurveyCCTV($siteSurvey, SurveyResultCCTVRequest::createFrom($data));
        }
        return $siteSurveyInternet = $this->saveSiteSurveyInternet($siteSurvey, SurveyResultInternetRequest::createFrom($data));
    }

    function saveSiteSurveyCCTV(SiteSurvey $siteSurvey, SurveyResultCCTVRequest $data) : SiteSurveyCCTV {
        return $siteSurveyCCTV = SiteSurveyCCTV::create([
            'site_survey_id' => $siteSurvey->id,
            'camera_type_id' => $data->camera_type_id,
            'quantity_service_use' => $data->quantity_service_use,
            'record_duration' => $data->record_duration,
            'camera_storage' => $data->camera_storage,
            'camera_resolution' => $data->camera_resolution,
            'special_request' => $data->special_request,
        ]);
    }

    function saveSiteSurveyInternet(SiteSurvey $siteSurvey, SurveyResultInternetRequest $data) : SiteSurveyInternet {
        return $siteSurveyInternet = SiteSurveyInternet::create([
            'site_survey_id' => $siteSurvey->id,
            'quantity_service_use' => $data->quantity_service_use,
            'user_needs' => $data->user_needs,
            'bandwith_needs' => $data->bandwith_needs,
            'special_request' => $data->special_request,
        ]);
    }

    function getAll(Request $request) : EloquentBuilder {
        return SiteSurvey::with('surveyRequest', 'workOrder', 'transmissionMedia', 'internetServiceType', 'serviceType');
    }
}
