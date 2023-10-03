<?php

namespace App\Http\Controllers\Sales\Opportunity\Survey;

use App\Http\Controllers\Controller;
use App\Http\Requests\Opportunity\Survey\SoftSurveyRequest;
use App\Http\Requests\Opportunity\Survey\SurveyRequest as SurveyFormRequest;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Master\BuildingType;
use App\Models\Master\CctvRecordDuration;
use App\Models\Master\CctvStorageCapacity;
use App\Models\Master\GbConnectivityData;
use App\Models\Master\GbNaturalFrequency;
use App\Models\Master\GbRepeaterType;
use App\Models\Master\InternetBandwidth;
use App\Models\Master\OutdoorCableType;
use App\Models\Master\PowerSource;
use App\Models\Opportunity\Survey\Master\SiteSurveyServiceType;
use App\Models\Master\ServiceType;
use App\Models\Master\TransportationAccess;
use App\Models\Opportunity\Survey\Master\SiteSurveyInterface;
use App\Models\Opportunity\Survey\SiteSurveyInternet;
use App\Models\Opportunity\Survey\SoftSurvey;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use App\Models\ProjectManagement\WorkOrder;
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
     * Show index of site survey GSM Booster page
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
    function detail(Request $request, ServiceType $serviceType, int $id) : View {
        if ($serviceType->model_name == NULL) {
            abort(404, 'Model Name tidak ditemukan');
        }

        $model_name = new $serviceType->model_name;

        $surveyResult = (new $model_name)->with('siteSurveyOutdoorArea', 'siteSurveyIndoorArea', 'siteSurveyOtherArea', 'customerSignFile')->findOrFail($id);
        $surveyRequest = SurveyRequest::with('customerProspect.customer', 'serviceType', 'typeOfSurvey')->findOrFail($surveyResult->survey_request_id);
        $workOrder = WorkOrder::findOrFail($surveyResult->work_order_id);
        $compact = [
            'surveyResult',
            'surveyRequest',
            'workOrder',
            'siteSurveyServiceTypes',
            'siteSurveyInterfaces',
            'powerSources',
            'outdoorCableTypes',
            'transportationAccesses',
            'buildingTypes'
        ];


        if ($surveyRequest->service_type_id == 2) {
            $cctvRecordDurations = CctvRecordDuration::get();
            $cctvStorageCapacities = CctvStorageCapacity::get();

            array_push($compact, ['cctvRecordDurations', 'cctvStorageCapacities']);
        }

        if ($surveyRequest->service_type_id == 3) {
            $gbNaturalFrequencies = GbNaturalFrequency::get();
            $gbRepeaterTypes = GbRepeaterType::get();
            $gbConnectivityDatas = GbConnectivityData::get();

            array_push($compact, ['gbNaturalFrequencies', 'gbRepeaterTypes', 'gbConnectivityDatas']);
        }
        
        if ($surveyRequest->service_type_id == 1) {
            $internetBandwidths = InternetBandwidth::get();
            array_push($compact, ['internetBandwidths']);
        }

        $serviceTypes = ServiceType::get();
        $powerSources = PowerSource::get();
        $outdoorCableTypes = OutdoorCableType::get();
        $transportationAccesses = TransportationAccess::get();
        $buildingTypes = BuildingType::get();
        
        foreach ($serviceTypes as $serviceType) {
            if ($serviceType->model_name != NULL) {
                if ($surveyRequest->service_type_id == $serviceType->id) {
                    $lower = strtolower($serviceType->name);
                    $bladefy = collect(explode(' ', $lower))->implode('-');
                    
                    $siteSurveyServiceTypes = SiteSurveyServiceType::where('category', strtoupper($lower))->get();
                    $siteSurveyInterfaces = SiteSurveyInterface::where('category', strtoupper($lower))->get();
                    $view = "cmt-opportunity.survey.pages.site-survey.detail.$bladefy-form";
                }
            }
        }
        return view($view, compact(
            ...$compact
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
     * View Create Survey Result From Survey Request with WO
     * 
     * @param \App\Http\Requests\Opportunity\Survey\SurveyResultRequest $request
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */
    function createSurveyResult(Request $request, WorkOrder $workOrder) : View {
        $surveyRequest = SurveyRequest::with('customerProspect.customer', 'serviceType', 'typeOfSurvey')->findOrFail($request->query('surveyRequestId'));
        $compact = [
            'surveyRequest',
            'workOrder',
            'siteSurveyServiceTypes',
            'siteSurveyInterfaces',
            'powerSources',
            'outdoorCableTypes',
            'transportationAccesses',
            'buildingTypes'
        ];


        if ($surveyRequest->service_type_id == 2) {
            $cctvRecordDurations = CctvRecordDuration::get();
            $cctvStorageCapacities = CctvStorageCapacity::get();

            array_push($compact, ['cctvRecordDurations', 'cctvStorageCapacities']);
        }

        if ($surveyRequest->service_type_id == 3) {
            $gbNaturalFrequencies = GbNaturalFrequency::get();
            $gbRepeaterTypes = GbRepeaterType::get();
            $gbConnectivityDatas = GbConnectivityData::get();

            array_push($compact, ['gbNaturalFrequencies', 'gbRepeaterTypes', 'gbConnectivityDatas']);
        }
        
        if ($surveyRequest->service_type_id == 1) {
            $internetBandwidths = InternetBandwidth::get();
            array_push($compact, ['internetBandwidths']);
        }

        $serviceTypes = ServiceType::get();
        $powerSources = PowerSource::get();
        $outdoorCableTypes = OutdoorCableType::get();
        $transportationAccesses = TransportationAccess::get();
        $buildingTypes = BuildingType::get();
        
        foreach ($serviceTypes as $serviceType) {
            if ($serviceType->model_name != NULL) {
                if ($surveyRequest->service_type_id == $serviceType->id) {
                    $lower = strtolower($serviceType->name);
                    $bladefy = collect(explode(' ', $lower))->implode('-');
                    
                    $siteSurveyServiceTypes = SiteSurveyServiceType::where('category', strtoupper($lower))->get();
                    $siteSurveyInterfaces = SiteSurveyInterface::where('category', strtoupper($lower))->get();
                    $view = "cmt-opportunity.survey.pages.site-survey.detail.$bladefy-form";
                }
            }
        }
        return view($view, compact(
            ...$compact
        ));
    }

    /**
     * Draft Survey Result From Survey Request with WO
     * 
     * @param \App\Http\Requests\Opportunity\Survey\SurveyResultRequest $request
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */
    function draftSurveyResult(Request $request) : JsonResponse {
        try {
            $result = $request->session()->put('surveyResultTemp', $request->all());

            return response()->json([
                "sessionData" => $request->session()->get('surveyResultTemp'),
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    /**
     * Store Survey Result From Survey Request with WO
     * 
     * @param \App\Http\Requests\Opportunity\Survey\SurveyResultRequest $request
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */
    function storeSurveyResult(Request $request) : JsonResponse {
        try {
            $result = $this->surveyResultService->storeSurveyResultData($request);
            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
                "data" => [
                    'serviceTypeId' => $result['serviceTypeId'],
                    'surveyResultId' => $result['data']->id
                ]
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

    /**
     * Store Soft Survey
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\JsonResponse Returning JSON Response Data
     */
    function storeSoftSurvey(SoftSurveyRequest $request) : JsonResponse {
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

    /**
     * detail Soft Survey
     * 
     * @param \Illuminate\Http\Request $request
     * @param App\Models\Opportunity\Survey\SurveyRequest $surveyRequest
     * 
     * @return Illuminate\Contracts\View\View Returning JSON Response Data
     */
    function detailSoftSurvey(Request $request, int $surveyRequest) : View {
        $surveyRequest = SurveyRequest::with('softSurveys.attachment')->where('id', $surveyRequest)->first();
        $siteSurveyServiceTypes = SiteSurveyServiceType::get();
        
        return view('cmt-opportunity.survey.pages.soft-survey-detail', compact(
            'siteSurveyServiceTypes',
            'surveyRequest'
        ));
    }

    function exportSurveyResult(Request $request, ServiceType $serviceType, int $id) : View {
        if ($serviceType->model_name == NULL) {
            abort(404, 'Model Name tidak ditemukan');
        }

        $model_name = new $serviceType->model_name;

        $surveyResult = (new $model_name)->with('siteSurveyOutdoorArea', 'siteSurveyIndoorArea', 'siteSurveyOtherArea', 'customerSignFile')->findOrFail($id);
        $surveyRequest = SurveyRequest::with('customerProspect.customer', 'serviceType', 'typeOfSurvey')->findOrFail($surveyResult->survey_request_id);
        $workOrder = WorkOrder::findOrFail($surveyResult->work_order_id);
        $compact = [
            'surveyResult',
            'surveyRequest',
            'workOrder',
            'siteSurveyServiceTypes',
            'siteSurveyInterfaces',
            'powerSources',
            'outdoorCableTypes',
            'transportationAccesses',
            'buildingTypes'
        ];


        if ($surveyRequest->service_type_id == 2) {
            $cctvRecordDurations = CctvRecordDuration::get();
            $cctvStorageCapacities = CctvStorageCapacity::get();

            array_push($compact, ['cctvRecordDurations', 'cctvStorageCapacities']);
        }

        if ($surveyRequest->service_type_id == 3) {
            $gbNaturalFrequencies = GbNaturalFrequency::get();
            $gbRepeaterTypes = GbRepeaterType::get();
            $gbConnectivityDatas = GbConnectivityData::get();

            array_push($compact, ['gbNaturalFrequencies', 'gbRepeaterTypes', 'gbConnectivityDatas']);
        }
        
        if ($surveyRequest->service_type_id == 1) {
            $internetBandwidths = InternetBandwidth::get();
            array_push($compact, ['internetBandwidths']);
        }

        $serviceTypes = ServiceType::get();
        $powerSources = PowerSource::get();
        $outdoorCableTypes = OutdoorCableType::get();
        $transportationAccesses = TransportationAccess::get();
        $buildingTypes = BuildingType::get();
        
        foreach ($serviceTypes as $serviceType) {
            if ($serviceType->model_name != NULL) {
                if ($surveyRequest->service_type_id == $serviceType->id) {
                    $lower = strtolower($serviceType->name);
                    $bladefy = collect(explode(' ', $lower))->implode('-');
                    
                    $siteSurveyServiceTypes = SiteSurveyServiceType::where('category', strtoupper($lower))->get();
                    $siteSurveyInterfaces = SiteSurveyInterface::where('category', strtoupper($lower))->get();
                    $view = "cmt-opportunity.survey.pages.site-survey.print.$bladefy-print";
                }
            }
        }
        return view($view, compact(
            ...$compact
        ));
    }
}
