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
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Models\Inventory\InventoryGood;
use App\Services\Master\Inventory\InventoryService;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use App\Services\Sales\Opportunity\BoQ\BoQService;
use App\Services\Master\Item\ItemService;
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

    function index()
    {
        return view('cmt-opportunity.boq.index');
    }

    function formBoQ(Request $request)
    {

        // mau ada url atau engga tetap kirim tabel prospect berdasarkan id


        $id = $request->query('prospect_id');
        // kondisi url ada
        $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $id)->first();
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
    
    public function getMerkType(Request $request)
    {
        if ($request->ajax()) {
             $itemId = $request->input('item_id');
        $itemData = $this->InventoryService->getMerkType($itemId);
        return response()->json($itemData);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    public function getSurveyCompany(Request $request)
    {
        if ($request->ajax()) {
             $prospectId = $request->input('prospect_Id');
        $allData = $this->InventoryService->getSurveyCompany($prospectId);
        return response()->json($allData);
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