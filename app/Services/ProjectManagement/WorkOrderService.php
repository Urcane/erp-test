<?php

namespace App\Services\ProjectManagement;

use App\Http\Requests\ProjectManagement\WorkOrderRequest;
use App\Repositories\ProjectManagement\WorkOrderRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class WorkOrderService
{
    protected $workOrderRepository;

    public function __construct(WorkOrderRepository $workOrderRepository) {
        $this->workOrderRepository = $workOrderRepository;
    }

    function storeWorkOrderSurvey(WorkOrderRequest $request) : Collection {
        $start_date = Carbon::parse($request->start_date)->toDateString();
        $planning_due_date = Carbon::parse($request->planning_due_date)->toDateString();

        Log::info($request->all());

        $result = collect($request->survey_request_id)
            ->map(function($survey_request_id) use($request, $start_date, $planning_due_date) {
                $data = $request->merge(["survey_request_id" => $survey_request_id])->merge(["start_date_carbon" => $start_date, "planning_due_date_carbon" => $planning_due_date]);

                return $this->workOrderRepository->saveWOSurvey($data);
            });

        return $result;
    }

    function renderDatatable() : JsonResponse {
        $data = $this->workOrderRepository->getAll();

        return DataTables::of($data)
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('action', function ($query) {
                $additionalMenu = "";

                // if ($query->type_of_survey_id == 2) {
                //     $additionalMenu .= "<li><a href=\"#kt_modal_create_wo_survey\" class=\"dropdown-item py-2 btn_create_wo_survey\" data-bs-toggle=\"modal\" data-id=\"'.$query->id.'\"><i class=\"fa-solid fa-list-check me-3\"></i>Terbit WO Survey</a></li>";
                // }

                return "
                <button type=\"button\" class=\"btn btn-secondary btn-icon btn-sm\" data-kt-menu-placement=\"bottom-end\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa-solid fa-ellipsis-vertical\"></i></button>
                <ul class=\"dropdown-menu\">
                    <li><a href=\"#kt_modal_request_survey\" class=\"dropdown-item py-2 btn_request_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Edit</a></li>
                </ul>
                ";
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action', 'covered_status_pretified'])
            ->make(true);
    }
}
