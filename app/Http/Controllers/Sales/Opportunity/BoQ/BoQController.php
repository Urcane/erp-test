<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use App\Models\Customer\CustomerProspect;
use App\Services\Master\Item\ItemService;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Services\Sales\Opportunity\BoQ\BoQService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Master\Inventory\InventoryService;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;

class BoQController extends Controller{
    
    protected $surveyResultService;
    protected $BoqService;
    protected $InventoryService;
    protected $ItemService;
    
    protected $references;
    protected $customerProspect;
    protected $employees;

    public function __construct(SurveyResultService $surveyResultService,BoQService $BoqService,InventoryService $InventoryService,ItemService $ItemService,CustomerProspect $customerProspect, User $employees ) {
            $this->surveyResultService = $surveyResultService;
            $this->BoqService = $BoqService;
            $this->InventoryService = $InventoryService;
            $this->ItemService = $ItemService;
            $this->customerProspect = $customerProspect;
            $this->employees = $employees;
    }
        
    function index() {
        return view('cmt-opportunity.boq.index');
    }
    
    function createDraftBoq(Request $request) {
        if ($request->ajax()) {
            return $this->BoqService->createDraftBoqAjax($request);
        } else if ($request->query()) {
            return $this->BoqService->createDraftBoqQuery($request);
        } else {
            return $this->BoqService->createDraftBoq();
        }
       return response()->json('Oops, Somethin\' Just Broke :(');
    }
    
    function updateDraftBoq(Request $request)  {
        if ($request->query()) {
            return $this->BoqService->updateDraftBoq($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function onReviewBoq(Request $request)  {
        if ($request->query()) {
            return $this->BoqService->onReviewBoq($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function getMerkType(Request $request) : JsonResponse  { 
        if ($request->ajax()) {
            return $this->InventoryService->getMerkType($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }
    
    function getDatatable(Request $request) : JsonResponse  {
        if ($request->ajax()) {
            return $this->BoqService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function saveAndStoreBoq(Request $request) {
        if ($request->ajax()) {
            return $this->BoqService->saveAndStoreBoq($request);
        }   
        return response()->json('Oops, Somethin\' Just Broke :('); 
    } 

    function createRevisionBoq(Request $request){
        if ($request->ajax()) {
            return $this->BoqService->createRevisionBoq($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function storeApprovalBoq(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->BoqService->storeApprovalBoq($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

}
    
