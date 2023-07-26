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
use App\Services\Master\Item\ItemService;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use App\Services\Sales\Opportunity\BoQ\BoQService;

class BoQController extends Controller
{

    protected $surveyResultService;
    protected $BoqService;
    protected $InventoryService;
    protected $ItemService;

    public function __construct(
        SurveyResultService $surveyResultService,
        BoQService $BoqService,
        InventoryService $InventoryService,
        ItemService $ItemService
    ) {
        $this->surveyResultService = $surveyResultService;
        $this->BoqService = $BoqService;
        $this->InventoryService = $InventoryService;
        $this->ItemService = $ItemService;
    }

    function index() {
        return view('cmt-opportunity.boq.index');
    }

    function formBoQ($id){
        $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $id)->first();
        if (!$dataCompany) {
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
        $dataForm = $this->InventoryService->getDataForm();
        return view('cmt-opportunity.boq.pages.form-boq', compact('dataForm', 'dataCompany')); 
    }

    function saveItemsBoQ(Request $request) : JsonResponse{
        if ($request->ajax()) {
             $this->ItemService->saveItemsBoQ($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function createNewBoQ(Request $request) : JsonResponse {
        if ($request->ajax()) {
            $this->BoqService->createNewBoQ($request);
       }
       return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function getDatatableDraft(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->BoqService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }
}
