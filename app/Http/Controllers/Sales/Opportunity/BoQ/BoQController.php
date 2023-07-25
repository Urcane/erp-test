<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Customer\CustomerProspect;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Inventory\InventoryGood;
use App\Services\Master\Inventory\InventoryService;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;

class BoQController extends Controller
{

    protected $surveyResultService;
    protected $BoqDraftService;
    protected $InventoryService;

    public function __construct(
        SurveyResultService $surveyResultService,
        BoqDraftService $BoqDraftService,
        InventoryService $InventoryService
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
