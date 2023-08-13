<?php

namespace App\Http\Controllers\Sales\Opportunity\Survey;

use App\Http\Controllers\Controller;
use App\Http\Requests\Opportunity\Survey\SoftSurveyRequest;
use App\Http\Requests\Opportunity\Survey\SurveyRequest as SurveyFormRequest;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Opportunity\Survey\Master\SiteSurveyServiceType;
use App\Models\Master\ServiceType;
use App\Models\Opportunity\Survey\SoftSurvey;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use App\Models\ProjectManagement\WorkOrderCategory;
use App\Services\Sales\Opportunity\Survey\SoftSurveyService;
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
    protected $softSurveyService;

    public function __construct(
        SurveyRequestService $surveyRequestService, 
        SurveyResultService $surveyResultService,
        SoftSurveyService $softSurveyService
    ) {
        $this->surveyRequestService = $surveyRequestService;
        $this->surveyResultService = $surveyResultService;
        $this->softSurveyService = $softSurveyService;
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
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();

        return view('cmt-opportunity.survey.pages.survey-request', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
            'siteSurveyServiceTypes',
        ));
    }

    /**
     * Show index of soft survey page
     * 
     * @return Illuminate\Contracts\View\View
     */
    function indexSoftSurvey() : View {
        $serviceTypes = ServiceType::get();
        $typeOfSurveys = TypeOfSurvey::get();
        $typeOfWOs = WorkOrderCategory::get();
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();

        return view('cmt-opportunity.survey.pages.soft-survey', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
            'siteSurveyServiceTypes',
        ));
    }

    /**
     * Show index of site survey internet page
     * 
     * @return Illuminate\Contracts\View\View
     */
    function indexSurveyResultInternet() : View {
        $serviceTypes = ServiceType::get();
        $typeOfSurveys = TypeOfSurvey::get();
        $typeOfWOs = WorkOrderCategory::get();
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();

        return view('cmt-opportunity.survey.pages.site-survey.internet', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
            'siteSurveyServiceTypes',
        ));
    }
    
    /**
     * Show index of site survey cctv page
     * 
     * @return Illuminate\Contracts\View\View
     */
    function indexSurveyResultCctv() : View {
        $serviceTypes = ServiceType::get();
        $typeOfSurveys = TypeOfSurvey::get();
        $typeOfWOs = WorkOrderCategory::get();
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();

        return view('cmt-opportunity.survey.pages.site-survey.cctv', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
            'siteSurveyServiceTypes',
        ));
    }

    /**
     * Show index of site survey cctv page
     * 
     * @return Illuminate\Contracts\View\View
     */
    function indexSurveyResultGb() : View {
        $serviceTypes = ServiceType::get();
        $typeOfSurveys = TypeOfSurvey::get();
        $typeOfWOs = WorkOrderCategory::get();
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();

        return view('cmt-opportunity.survey.pages.site-survey.gsm-booster', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
            'siteSurveyServiceTypes',
        ));
    }

    /**
     * Show detail page of survey
     * 
     * @return Illuminate\Contracts\View\View
     */
    function detail(Request $request, int $id) : View {
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();
        $query = $this->surveyResultService->getSurveyResultById($request, $id)->first();
        
        return view('cmt-opportunity.survey.pages.detail', compact(
            'SiteSurveyServiceTypes',
            'query'
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

    /**
     * Get Datatable Survey Result
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Yajra\DataTables\Facades\DataTables Return Datatables Yajra
     */
    function getDataTableSurveyResult(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->surveyResultService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    /**
     * Get Survey Request By Id
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */

    function getSurveyRequestById(Request $request, int $id) : JsonResponse {
        if ($request->ajax()) {
            return response()->json($this->surveyRequestService->getSurveyRequestById($request, $id)->first(), 200);
        }
        return response()->json('Oops, Somethin\' Just Broke :(', 403);
    }

    function storeSoftSurvey(SoftSurveyRequest $request) {
        try {
            $result = $this->softSurveyService->storeSoftSurvey($request);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    function detailSoftSurvey(Request $request, SurveyRequest $surveyRequest) : View {
        $surveyRequest = $surveyRequest->with('softSurveys.attachment')->first();
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();
        
        return view('cmt-opportunity.survey.pages.soft-survey-detail', compact(
            'siteSurveyServiceTypes',
            'surveyRequest'
        ));
    }
}
