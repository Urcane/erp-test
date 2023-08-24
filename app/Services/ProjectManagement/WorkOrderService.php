<?php

namespace App\Services\ProjectManagement;

use App\Http\Requests\ProjectManagement\WorkOrderApprovalRequest;
use App\Http\Requests\ProjectManagement\WorkOrderRequest;
use App\Models\ProjectManagement\WorkOrder;
use App\Repositories\ProjectManagement\WorkOrderRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

    function renderDatatable(Request $request) : JsonResponse {
        $data = $this->workOrderRepository->getAll($request);

        return DataTables::of($data)
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->editColumn('approved_status', function($query) {
                if ($query->approved_status != null) {
                    return $query->approved_status == 1 ? 'Approved' : 'Rejected';
                }
                return 'On Review...';
            })
            ->addColumn('action', function ($query) {
                $additionalMenu = "";

                if ($query->approved_status == 1) {
                    if ($query->surveyRequest->service_type_id == 1) {
                        $additionalMenu .= "<li><a href=\"#kt_modal_create_survey_result_internet\" class=\"dropdown-item py-2 btn_create_survey_result_internet\" data-bs-toggle=\"modal\" data-id=\"$query->id\" data-surveyid=\"$query->survey_request_id\"><i class=\"fa-solid fa-list-check me-3\"></i>Create Survey Result Internet</a></li>";
                    }

                    if ($query->surveyRequest->service_type_id == 2) {
                        $additionalMenu .= "<li><a href=\"#kt_modal_create_survey_result_cctv\" class=\"dropdown-item py-2 btn_create_survey_result_cctv\" data-bs-toggle=\"modal\" data-id=\"$query->id\" data-surveyid=\"$query->survey_request_id\"><i class=\"fa-solid fa-list-check me-3\"></i>Create Survey Result CCTV</a></li>";
                    }
                }

                return "
                <button type=\"button\" class=\"btn btn-secondary btn-icon btn-sm\" data-kt-menu-placement=\"bottom-end\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa-solid fa-ellipsis-vertical\"></i></button>
                <ul class=\"dropdown-menu\">
                    $additionalMenu
                    <li><a href=\"#kt_modal_create_wo_survey\" class=\"dropdown-item py-2 btn_edit_wo_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Edit</a></li>
                </ul>
                ";
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action', 'covered_status_pretified'])
            ->make(true);
    }

    function renderDatatableSurveyWO(Request $request) : JsonResponse {
        $data = $this->workOrderRepository->getAllSurveyWO($request);

        return DataTables::of($data)
            ->addColumn('DT_RowChecklist', function($check) {
                if (!isset($check->approved_status)) {
                    return '<div class="text-center w-50px"><input name="checkbox_work_order_ids" type="checkbox" value="'.$check->id.'"></div>';
                }
                return '';
            })
            ->editColumn('approved_status', function($query) {
                if (isset($query->approved_status)) {
                    return $query->approved_status == 1 ? 'Approved' : 'Rejected';
                }
                return 'On Review...';
            })
            ->addColumn('action', function ($query) {
                $additionalMenu = "";

                if ($query->approved_status == 1) {
                    if ($query->surveyRequest->service_type_id == 1) {
                        // $additionalMenu .= "<li><a href=\"#kt_modal_create_survey_result_internet\" class=\"dropdown-item py-2 btn_create_survey_result_internet\" data-bs-toggle=\"modal\" data-id=\"$query->id\" data-surveyid=\"$query->survey_request_id\"><i class=\"fa-solid fa-list-check me-3\"></i>Create Survey Result Internet</a></li>";
                        $additionalMenu .= "<li><a href=\"". route('com.survey-result.create', ['workOrder' => $query->id, 'surveyRequestId' => $query->survey_request_id]) ."\" class=\"dropdown-item py-2\"><i class=\"fa-solid fa-list-check me-3\"></i>Create Survey Result Internet</a></li>";
                    }

                    if ($query->surveyRequest->service_type_id == 2) {
                        $additionalMenu .= "<li><a href=\"". route('com.survey-result.create', ['workOrder' => $query->id, 'surveyRequestId' => $query->survey_request_id]) ."\" class=\"dropdown-item py-2\"><i class=\"fa-solid fa-list-check me-3\"></i>Create Survey Result CCTV</a></li>";
                    }

                    if ($query->surveyRequest->service_type_id == 3) {
                        $additionalMenu .= "<li><a href=\"". route('com.survey-result.create', ['workOrder' => $query->id, 'surveyRequestId' => $query->survey_request_id]) ."\" class=\"dropdown-item py-2\"><i class=\"fa-solid fa-list-check me-3\"></i>Create Survey Result GSM Booster</a></li>";
                    }
                }

                return "
                <button type=\"button\" class=\"btn btn-secondary btn-icon btn-sm\" data-kt-menu-placement=\"bottom-end\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa-solid fa-ellipsis-vertical\"></i></button>
                <ul class=\"dropdown-menu\">
                    $additionalMenu
                    <li><a href=\"#kt_modal_create_wo_survey\" class=\"dropdown-item py-2 btn_edit_wo_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Edit</a></li>
                </ul>
                ";
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action', 'covered_status_pretified'])
            ->make(true);
    }

    function getWorkOrderById(Request $request, int $id) : Builder {
        return $this->workOrderRepository->getById($id);
    }

    function updateApprove(WorkOrderApprovalRequest $request) : Collection {
        $result = collect($request->work_order_id)->map(function($id) use($request) {
            return $this->workOrderRepository->updateApprove($request, $id);
        });

        return $result;
    }
}
