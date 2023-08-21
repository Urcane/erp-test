<?php

namespace App\Services\Sales\Opportunity\Survey;

use App\Http\Requests\Opportunity\Survey\SurveyRequest as SurveyFormRequest;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Repositories\Sales\Opportunity\Survey\SurveyRequestRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyRequestService 
{
    protected $surveyRequestRepository;

    public function __construct(SurveyRequestRepository $surveyRequestRepository) {
        $this->surveyRequestRepository = $surveyRequestRepository;
    }

    function storeSurveyRequestData(SurveyFormRequest $request) {
        $request_date = Carbon::parse($request->survey_date . ' ' . $request->survey_time)->toDateTimeString();

        $surveyRequest = collect($request->prospect_id)
            ->map(function($prospectId) use($request, $request_date) {
                $data = $request->merge(["prospectId" => $prospectId])->merge(["request_date" => $request_date]);

                return $this->surveyRequestRepository->save($data);
            });

        return $surveyRequest;
    }

    function renderDatatable(Request $request) : JsonResponse {
        $query = $this->surveyRequestRepository->getAll($request);

        return DataTables::of($query)
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('covered_status_pretified', function($query) {
                if ($query->covered_status) {
                    return '<span class="badge badge-light-success">Covered</span>';
                }
                return '<span class="badge badge-light-warning">Belum Tercover</span>';
            })
            ->addColumn('action', function ($query) use($request) {
                $additionalMenu = "";

                if ($request->filters['status'] == 'ST') {
                    if ($query->type_of_survey_id == 2) {
                        $additionalMenu .= "<li><a href=\"#kt_modal_create_wo_survey\" class=\"dropdown-item py-2 btn_create_wo_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Terbit WO Survey</a></li>";
                    } else {
                        $additionalMenu .= "<li><a href=\"#kt_modal_create_soft_survey\" class=\"dropdown-item py-2 btn_create_soft_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Buat Soft Survey</a></li>";
                    }
                } else {
                    if ($query->type_of_survey_id == 2) {
                        $additionalMenu .= "<li><a href=\"". route('com.survey.detail', ['id' => 1, 'serviceType' => $query->service_type_id])  ."\" class=\"dropdown-item py-2 \"><i class=\"fa-solid fa-list-check me-3\"></i>Detail</a></li>";
                    } else {
                        $additionalMenu .= "<li><a href=\"". route('com.soft-survey.detail', ['surveyRequest' => $query->id]) ."\" class=\"dropdown-item py-2 \"><i class=\"fa-solid fa-list-check me-3\"></i>Detail</a></li>";
                    }
                }

                return "
                <button type=\"button\" class=\"btn btn-secondary btn-icon btn-sm\" data-kt-menu-placement=\"bottom-end\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa-solid fa-ellipsis-vertical\"></i></button>
                <ul class=\"dropdown-menu\">
                    $additionalMenu
                    <li><a href=\"#kt_modal_request_survey\" class=\"dropdown-item py-2 btn_edit_request_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Edit</a></li>
                </ul>
                ";
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action', 'covered_status_pretified'])
            ->make(true);
    }

    function getSurveyRequestById(Request $request, int $id) : Builder {
        return $this->surveyRequestRepository->getById($id);
    }
}