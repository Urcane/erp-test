<?php

namespace App\Repositories\ProjectManagement;

use App\Models\ProjectManagement\WorkOrder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;

class WorkOrderRepository
{
    protected $model;

    public function __construct(WorkOrder $model) {
        $this->model = $model;
    }

    function getAll() : EloquentBuilder {
        return $this->model->with(['surveyRequest']);
    }

    function getById(int $id) : EloquentBuilder {
        return $this->model->where('id', $id)->with(['surveyRequest']);
    }

    function saveWOSurvey($data) : WorkOrder {
        return $this->model->updateOrCreate([
            'id' => $data->work_order_id,
            'survey_request_id' => $data->survey_request_id,
        ], [
            'survey_request_id' => $data->survey_request_id,
            'no_wo' => $data->no_wo,
            'task_description' => $data->task_description,
            'start_date' => $data->start_date_carbon,
            'planning_due_date' => $data->planning_due_date_carbon,
            'status' => "PR",
            'type_of_wo' => "SR",
        ]);
    }

    function getAllSurveyWO(Request $request) : EloquentBuilder {
        return $this->model->where('type_of_wo', 'SR')->whereHas('surveyRequest', function($surveyRequest) use ($request){
            $surveyRequest->where('service_type_id', $request->filters['service_type_id']);
        });
    }

    // function save($data) : WorkOrder {
        
    // }
}
