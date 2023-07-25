<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use App\Models\Team\City;
use App\Models\BussinesType;
use Illuminate\Http\Request;
use App\Models\LeadReference;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Customer\CustomerProspect;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Inventory\InventoryGoods;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;

class BoQController extends Controller
{

    protected $surveyResultService;
    protected $BoqDraftService;
    protected $InventoryService;

    public function __construct(
        SurveyResultService $surveyResultService,
        BoqDraftService $BoqDraftService,
        InventoryGoods $InventoryGoods
    ) {
        $this->surveyResultService = $surveyResultService;
        $this->BoqDraftService = $BoqDraftService;
        $this->InventoryService = $InventoryService;
    }

    function index()
    {
        return view('cmt-opportunity.boq.index');
    }

    function formBoQ()
    {
        $dataForm = $this->InventoryService->getDataForm();
        return view('cmt-opportunity.boq.pages.form-boq',compact('dataForm'));
    }

    function getDatatableDraft(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->BoqDraftService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }
}