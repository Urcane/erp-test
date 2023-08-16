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
        return $this->BoqService->createDraftBoq($request);
    }
    
    function updateDraftBoq(Request $request)  {
        if ($request->query()) {
            return $this->BoqService->updateDraftBoq($request);
        }

        function getSurveyCompanyItemInventory(Request $request) : JsonResponse {
            try {
                if ($request->ajax()) {
                    $prospect_id = $request->query('prospect_id');
                    $surveyId = SurveyRequest::where('customer_prospect_id', $prospect_id);
                    
                    if (!$surveyId) {
                        $surveyId = null;
                    }
                    
                    $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospect_id)->first();
                    $dataItems = ItemableBillOfQuantity::with('itemableBillOfQuantity','itemableBillOfQuantity.inventoryGood')->where("prospect_id", $prospect_id)->get();
           
                    $combinedData = [
                        'survey' => $surveyId,
                        'dataCompany' => $dataCompany,
                        'dataItems' => $dataItems
                    ];
                    return response()->json($combinedData);
                }
            } catch (Exception $e) {
                Log::error('Error in getSurveyCompanyItemInventory: ' . $e->getMessage());
                return response()->json(['error' => 'An error occurred'], 500);
            }
        }

        function saveItemsBoQ(Request $request) : JsonResponse   {
            if ($request->ajax()) {
                return $this->BoqService->saveItemsBoQ($request);
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

        function storeDataBoq(Request $request) {
           if ($request->ajax()) {
                return $this->BoqService->storeDataBoq($request);
            }   
            return response()->json('Oops, Somethin\' Just Broke :('); 
        } 
    function index() {
        return view('cmt-opportunity.boq.index');
    }
    
    function createDraftBoq(Request $request) {
        return $this->BoqService->createDraftBoq($request);
    }
    
    function updateDraftBoq(Request $request)  {
        if ($request->query()) {
            return $this->BoqService->updateDraftBoq($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function saveItemsBoQ(Request $request) : JsonResponse   {
        if ($request->ajax()) {
            return $this->BoqService->saveItemsBoQ($request);
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

    function storeDataBoq(Request $request) {
        if ($request->ajax()) {
            return $this->BoqService->storeDataBoq($request);
        }   
        return response()->json('Oops, Somethin\' Just Broke :('); 
    } 

    function createRevisionBoq(Request $request){
        if ($request->ajax()) {
            return $this->BoqService->createRevisionBoq($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    // Terrano Code
        // function getSurveyCompanyItemInventory(Request $request) : JsonResponse {
    //     try {
    //         if ($request->ajax()) {
    //             $prospect_id = $request->query('prospect_id');
    //             $surveyId = SurveyRequest::where('customer_prospect_id', $prospect_id);
                
    //             if (!$surveyId) {
    //                 $surveyId = null;
    //             }
                
    //             $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospect_id)->first();
    //             $dataItems = ItemableBillOfQuantity::with('itemableBillOfQuantity','itemableBillOfQuantity.inventoryGood')->where("prospect_id", $prospect_id)->get();
        
    //             $combinedData = [
    //                 'survey' => $surveyId,
    //                 'dataCompany' => $dataCompany,
    //                 'dataItems' => $dataItems
    //             ];
    //             return response()->json($combinedData);
    //         }
    //     } catch (Exception $e) {
    //         Log::error('Error in getSurveyCompanyItemInventory: ' . $e->getMessage());
    //         return response()->json(['error' => 'An error occurred'], 500);
    //     }
    // }

    }
    
