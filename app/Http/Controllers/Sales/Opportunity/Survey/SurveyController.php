<?php

namespace App\Http\Controllers\Sales\Opportunity\Survey;

use App\Http\Controllers\Controller;
use App\Http\Requests\Opportunity\Survey\SurveyRequest as SurveyFormRequest;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Master\CameraType;
use App\Models\Master\InternetServiceType;
use App\Models\Master\ServiceType;
use App\Models\Master\TransmissionMedia;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use App\Models\ProjectManagement\WorkOrderCategory;
use App\Services\Sales\Opportunity\Survey\SurveyRequestService;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{

    protected $surveyRequestService;
    protected $surveyResultService;

    public function __construct(
        SurveyRequestService $surveyRequestService, 
        SurveyResultService $surveyResultService
    ) {
        $this->surveyRequestService = $surveyRequestService;
        $this->surveyResultService = $surveyResultService;
    }

    /**
     * Show index of survey page
     * 
     * @return Illuminate\Contracts\View\View
     */
    function index() : View {
        $serviceTypes = ServiceType::get();
        $typeOfSurveys = TypeOfSurvey::get();
        $typeOfWOs = WorkOrderCategory::get();
        $transMedias = TransmissionMedia::get();
        $internetServiceTypes = InternetServiceType::get();
        $cameraTypes = CameraType::get();

        return view('cmt-opportunity.survey.index', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
            'transMedias',
            'internetServiceTypes',
            'cameraTypes'
        ));
    }

    /**
     * Store Survey Request from opportunities
     * 
     * @param  \App\Http\Requests\Opportunity\Survey\SurveyRequest $request
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */
    function storeSurveyRequest(SurveyFormRequest $request) : JsonResponse {
        try {
            $result = $this->surveyRequestService->storeSurveyRequestData($request);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    /**
     * Get Datatable Survey Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Yajra\DataTables\Facades\DataTables Return Datatables Yajra
     */
    function getDataTableSurveyRequest(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->surveyRequestService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    /**
     * Store Survey Result From Survey Request with WO
     * 
     * @param \App\Http\Requests\Opportunity\Survey\SurveyResultRequest $request
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */
    function storeSurveyResult(SurveyResultRequest $request) : JsonResponse {
        try {
            $result = $this->surveyResultService->storeSurveyResultData($request);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }
}