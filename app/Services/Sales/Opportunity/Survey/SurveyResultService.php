<?php

namespace App\Services\Sales\Opportunity\Survey;

use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Master\ServiceType;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Repositories\Sales\Opportunity\Survey\SurveyRequestRepository;
use App\Repositories\Sales\Opportunity\Survey\SurveyResultRepository;
use App\Services\Master\FileService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyResultService
{
    protected $surveyResultRepository;
    protected $surveyRequestRepository;
    protected $fileService;

    public function __construct(
        SurveyResultRepository $surveyResultRepository, 
        SurveyRequestRepository $surveyRequestRepository,
        FileService $fileService
    ) {
        $this->fileService = $fileService;
        $this->surveyResultRepository = $surveyResultRepository;
        $this->surveyRequestRepository = $surveyRequestRepository;
    }

    function storeSurveyResultData(Request $request) {
        $serviceType = ServiceType::find($request->service_type_id);
        $modelType = new $serviceType->model_name;

        $surveyResult = $this->surveyResultRepository->save( $request, $modelType);

        if (isset($request->customer_sign_url)) {
            $file = $this->fileService->storeFile($surveyResult, [
                'file' => $this->fileService->fromBase64($request->customer_sign_url),
                'filePath' => 'sign-customer',
                'fileName' => 'File Tanda Tangan Site Survey',
                'additional' => 'site-survey/customer_sign'
            ]);
        }

        return ['data' => $surveyResult, 'serviceTypeId' => $serviceType->id];
    }

    function renderDatatable(Request $request) : JsonResponse {
        $query = $this->surveyResultRepository->getAll($request);

        return DataTables::of($query)
            // ->addColumn('DT_RowChecklist', function($check) {
            //     return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            // })
            ->addColumn('action', function ($query) {
                $id = $query->id;
                $serviceTypeId = $query->surveyRequest->service_type_id;
                $additionalMenu = "";
                
                return "
                <button type=\"button\" class=\"btn btn-secondary btn-icon btn-sm\" data-kt-menu-placement=\"bottom-end\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa-solid fa-ellipsis-vertical\"></i></button>
                <ul class=\"dropdown-menu\">
                $additionalMenu
                <li><a href=\"/cmt-survey/detail/$serviceTypeId/$id\" class=\"dropdown-item py-2 btn_detail_survey\"><i class=\"fa-solid fa-list-check me-3\"></i>Detail</a></li>
                </ul>
                ";
                // <li><a href=\"#kt_modal_request_survey\" class=\"dropdown-item py-2 btn_request_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Edit</a></li>
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action'])
            ->make(true);
    }

    function getSurveyResultById(Request $request, int $id) : Builder {
        return $this->surveyResultRepository->getById($request, $id);
    }
}