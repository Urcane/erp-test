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
use App\Models\Inventory\InventoryGoods;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;

class BoQController extends Controller
{

    protected $surveyResultService;
    protected $BoqDraftService;
    protected $InventoryGoods;

    public function __construct(
        SurveyResultService $surveyResultService,
        BoqDraftService $BoqDraftService,
        InventoryGoods $InventoryGoods
    ) {
        $this->surveyResultService = $surveyResultService;
        $this->BoqDraftService = $BoqDraftService;
        $this->InventoryGoods = $InventoryGoods;
    }

    function index()
    {
        return view('cmt-opportunity.boq.index');
    }

    function formBoQ()
    {
        $dataForm = $this->InventoryGoods->getDataForm();
        $dataCompany = $this->BoqDraftService->getDataCompany();
        return view('cmt-opportunity.boq.pages.form-boq',compact('dataForm'));
    }

    function getDatatableDraft(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->BoqDraftService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }
}
