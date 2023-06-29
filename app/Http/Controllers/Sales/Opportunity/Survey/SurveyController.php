<?php

namespace App\Http\Controllers\Sales\Opportunity\Survey;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectManagement\ProjectManagementController;
use App\Http\Requests\Opportunity\Survey\SurveyRequest as SurveyFormRequest;
use App\Http\Requests\ProjectManagement\WorkOrderRequest;
use App\Models\Master\ServiceType;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use App\Models\ProjectManagement\WorkOrderCategory;
use App\Services\Sales\Opportunity\Survey\SurveyRequestService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends Controller
{

    protected $surveyRequestService;

    public function __construct(SurveyRequestService $surveyRequestService) {
        $this->surveyRequestService = $surveyRequestService;
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

        return view('cmt-opportunity.survey.index', compact(
            'serviceTypes',
            'typeOfSurveys',
            'typeOfWOs',
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
}
