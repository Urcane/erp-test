<?php

namespace App\Repositories\Sales\Opportunity\Survey;

use App\Http\Requests\Opportunity\Survey\SurveyResult\SurveyResultCCTVRequest;
use App\Http\Requests\Opportunity\Survey\SurveyResult\SurveyResultInternetRequest;
use App\Models\Master\ServiceType;
use App\Models\Opportunity\Survey\SiteSurvey;
use App\Models\Opportunity\Survey\SiteSurveyCCTV;
use App\Models\Opportunity\Survey\SiteSurveyGSMBooster;
use App\Models\Opportunity\Survey\SiteSurveyIndoorArea;
use App\Models\Opportunity\Survey\SiteSurveyInternet;
use App\Models\Opportunity\Survey\SiteSurveyOtherArea;
use App\Models\Opportunity\Survey\SiteSurveyOutdoorArea;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\ProjectManagement\WorkOrder;
use Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Array_;
use ReflectionClass;

class SurveyResultRepository
{
    protected $model;

    public function __construct(SiteSurvey $model) {
        $this->model = $model;
    }

    function save($data, $modelType) {
        $result = $this->handleSave($data, $modelType);

        $workOrder = WorkOrder::where('id', $data->work_order_id)->update([
            'status' => 'DN'
        ]);

        return $result;
    }

    private function handleSave($data, $modelType) {
        $model = new $modelType;
        $additionalTableData = $this->handleSavingOtherSurveyResultTable($data, $model);

        $data = $data->merge($additionalTableData);

        if ($modelType instanceof SiteSurveyCCTV) {
            return $this->saveSiteSurveyCCTV(Request::createFrom($data));
        }

        if ($modelType instanceof SiteSurveyGSMBooster) {
            return $this->saveSiteSurveyGSMBooster(Request::createFrom($data));
        }

        return $siteSurveyInternet = $this->saveSiteSurveyInternet(Request::createFrom($data));
    }

    function saveSiteSurveyGSMBooster(Request $data) : SiteSurveyGSMBooster {

        return $siteSurveyGSMBooster = SiteSurveyGSMBooster::updateOrCreate([
            'id' => $data->id
        ],[
            'survey_request_id' => $data->survey_request_id,
            'customer_id' => $data->customer_id,
            'customer_contact_id' => $data->customer_contact_id,
            'work_order_id' => $data->work_order_id,
            'gb_natural_frequency_id' => $data->gb_natural_frequency_id,
            'natural_signal_rsrp' => $data->natural_signal_rsrp,
            'natural_signal_rsrq' => $data->natural_signal_rsrq,
            'gb_repeater_type_id' => $data->gb_repeater_type_id,
            'anthena_donor_type' => $data->anthena_donor_type,
            'anthena_service' => $data->anthena_service,
            'gb_connectivity_data_id' => $data->gb_connectivity_data_id,
            'survey_date' => $data->survey_date,
            'site_survey_outdoor_area_id' => $data->site_survey_outdoor_area->id, 
            'site_survey_indoor_area_id' => $data->site_survey_indoor_area->id, 
            'site_survey_other_area_id' => $data->site_survey_other_area->id, 
            'survey_executor_id' => Auth::user()->id,
        ]);
    }

    function saveSiteSurveyCCTV(Request $data) : SiteSurveyCCTV {

        return $siteSurveyCCTV = SiteSurveyCCTV::updateOrCreate([
            'id' => $data->id
        ],[
            'survey_request_id' => $data->survey_request_id,
            'customer_id' => $data->customer_id,
            'customer_contact_id' => $data->customer_contact_id,
            'work_order_id' => $data->work_order_id,
            'site_survey_service_type_id' => $data->site_survey_service_type_id,
            'quantity' => $data->quantity,
            'local_acceses' => $data->local_access,
            'cctv_record_duration_id' => $data->cctv_record_duration_id,
            'cctv_storage_capacity_id' => $data->cctv_storage_capacity_id,
            'site_survey_interface_id' => $data->site_survey_interface_id,
            'survey_date' => $data->survey_date,
            'site_survey_outdoor_area_id' => $data->site_survey_outdoor_area->id, 
            'site_survey_indoor_area_id' => $data->site_survey_indoor_area->id, 
            'site_survey_other_area_id' => $data->site_survey_other_area->id, 
            'survey_executor_id' => Auth::user()->id,
        ]);
    }

    function saveSiteSurveyInternet(Request $data) : SiteSurveyInternet {              
        return $siteSurveyInternet = SiteSurveyInternet::updateOrCreate([
            'id' => $data->id
        ],[
            'survey_request_id' => $data->survey_request_id,
            'customer_id' => $data->customer_id,
            'customer_contact_id' => $data->customer_contact_id,
            'work_order_id' => $data->work_order_id,
            'site_survey_service_type_id' => $data->site_survey_service_type_id,
            'local_acceses' => $data->local_access,
            'internet_bandwidth_id' => $data->internet_bandwidth_id,
            'site_survey_interface_id' => $data->site_survey_interface_id,
            'survey_date' => $data->survey_date,
            'site_survey_outdoor_area_id' => $data->site_survey_outdoor_area->id, 
            'site_survey_indoor_area_id' => $data->site_survey_indoor_area->id, 
            'site_survey_other_area_id' => $data->site_survey_other_area->id, 
            'survey_executor_id' => Auth::user()->id,
        ]);
    }

    function getAll(Request $request) : EloquentBuilder {
        $model = ServiceType::find($request->filters['service_type_id'])->model_name;
        if ($model == null) {
            throw new Exception("Model not found", 403);
        }

        $model = new $model;
        
        return $model::with('surveyRequest', 'workOrder', 'customerContact', 'customer', 'siteSurveyServiceType');
    }

    function getById(Request $request, int $id) : EloquentBuilder {
        return $this->getByIdWithoutRelationship($request, $id)->with('siteSurveyCCTV','siteSurveyInternet', 'surveyRequest.customerProspect.customer.customerContact', 'surveyRequest.customerProspect.customer.city', 'workOrder', 'siteSurveyServiceType', 'serviceType');
    }

    function getByIdWithoutRelationship(Request $request, int $id) : EloquentBuilder {
        return SiteSurvey::where('id', $id);
    }

    function handleSavingOtherSurveyResultTable(Request $data, $model) {
        if (isset($data->id)) {
            $model = $model->find($data->id);

            $data = $data->merge([
                'site_survey_outdoor_area_id' => $model->site_survey_outdoor_area_id ?? NULL,
                'site_survey_indoor_area_id' => $model->site_survey_indoor_area_id ?? NULL,
                'site_survey_other_area_id' => $model->site_survey_other_area_id ?? NULL,
            ]);

            $data = Request::createFrom($data);
        }
        
        $outdoor = $this->handleOutdoorSave($data);
        $indoor = $this->handleIndoorSave($data);
        $other = $this->handleOtherSave($data);

        return [
            'site_survey_outdoor_area' => $outdoor, 
            'site_survey_indoor_area' => $indoor, 
            'site_survey_other_area' => $other
        ];
    }

    function handleOutdoorSave(Request $data) : SiteSurveyOutdoorArea {        
        return $siteSurveyOutdoorArea = SiteSurveyOutdoorArea::updateOrCreate([
            'id' => $data->site_survey_outdoor_area_id,
        ], [
            'tower_available_status' => $data->tower_available_status,
            'tower_available_status_note' => $data->tower_available_status_note,
            'closest_site_range' => $data->closest_site_range,
            'closest_site_range_note' => $data->closest_site_range_note,
            'closest_tower_status' => $data->closest_tower_status,
            'closest_tower_status_note' => $data->closest_tower_status_note,
            'thunder_protector_status' => $data->thunder_protector_status,
            'thunder_protector_status_note' => $data->thunder_protector_status_note,
            'grounding_status' => $data->grounding_status,
            'grounding_status_note' => $data->grounding_status_note,
            'cable_tray_status' => $data->cable_tray_status,
            'cable_tray_status_note' => $data->cable_tray_status_note,
            'pondation_status' => $data->pondation_status,
            'pondation_status_note' => $data->pondation_status_note,
        ]);
    }

    function handleIndoorSave(Request $data) : SiteSurveyIndoorArea {
        return $siteSurveyIndoorArea = SiteSurveyIndoorArea::updateOrCreate([
            'id' => $data->site_survey_indoor_area_id,
        ], [
            'room_status' => $data->room_status,
            'room_status_note' => $data->room_status_note,
            'air_conditioning_status' => $data->air_conditioning_status,
            'air_conditioning_status_note' => $data->air_conditioning_status_note,
            'power_source_id' => $data->power_source_id,
            'power_source_note' => $data->power_source_note,
            'mcb_status' => $data->mcb_status,
            'mcb_status_note' => $data->mcb_status_note,
            'mcb_type' => $data->mcb_type,
            'mcb_type_note' => $data->mcb_type_note,
            'voltage_phase_to_neutral' => $data->voltage_phase_to_neutral,
            'voltage_phase_to_ground' => $data->voltage_phase_to_ground,
            'voltage_neutral_to_ground' => $data->voltage_neutral_to_ground,
            'voltage_frequency' => $data->voltage_frequency,
            'voltage_note' => $data->voltage_note,
            'ups_regulator_status' => $data->ups_regulator_status,
            'ups_regulator_status_note' => $data->ups_regulator_status_note,
            'table_status' => $data->table_status,
            'table_status_note' => $data->table_status_note,
        ]);
    }

    function handleOtherSave(Request $data) : SiteSurveyOtherArea {
        return $siteSurveyOtherArea = SiteSurveyOtherArea::updateOrCreate([
            'id' => $data->site_survey_other_area_id,
        ], [
            'outdoor_cable_type_id' => $data->outdoor_cable_type_id,
            'cable_power_type' => $data->cable_power_type,
            'grounding_cable_type' => $data->grounding_cable_type,
            'connection_configuration_status' => $data->connection_configuration_status,
            'transportation_access_id' => $data->transportation_access_id,
            'building_type_id' => $data->building_type_id,
            'notes' => $data->other_area_notes,
        ]);
    }
}
