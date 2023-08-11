<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Inventory\InventoryGood;
use App\Models\Customer\CustomerProspect;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\Facades\DataTables;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Services\Master\Item\ItemService;
use App\Services\Master\Inventory\InventoryService;
use App\Services\Sales\Opportunity\BoQ\BoQService;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Http\Requests\Opportunity\Survey\SurveyRequestRequest;


class BoQController extends Controller
{
    
    protected $surveyResultService;
    protected $BoqService;
    protected $InventoryService;
    protected $ItemService;
    
    protected $references;
    protected $customerProspect;
    protected $employees;

    public function __construct(
        SurveyResultService $surveyResultService,
        BoQService $BoqService,
        InventoryService $InventoryService,
        ItemService $ItemService,
        CustomerProspect $customerProspect,
        User $employees
        ) 
    {
            $this->surveyResultService = $surveyResultService;
            $this->BoqService = $BoqService;
            $this->InventoryService = $InventoryService;
            $this->ItemService = $ItemService;
            $this->customerProspect = $customerProspect;
            $this->employees = $employees;
    }
        
        function index() 
        {
            return view('cmt-opportunity.boq.index');
        }
        
        function formBoQ(Request $request) 
        {
            // punya kepin
            // $dataForm = $this->InventoryService->getDataForm();  
            // $salesEmployees =   $this->employees->where('department_id', 1)->get();
            // $technicianEmployees =   $this->employees->where('department_id', 4)->get();
            // $procurementEmployees =   $this->employees->where('department_id', 3)->get();
            // if ($id === null) {
            //     $dataCompany = $this->BoqService->getFormWithoutID();
            // }  else {
            //       $dataCompany = $this->BoqService->getFormWithID($id);
            //     if (!$dataCompany) {
            //         return response()->json("Oopss, ada yang salah nih!", 500);
            //     }

            $prospectId = $request->query('prospect_id');
            $surveyRequestId = $request->query('survey_request_id');

            if ($prospectId || $surveyRequestId) { 
                $dataProspect = CustomerProspect::doesntHave('itemableBillOfQuantity')->get();
                $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospectId)->first();
                $dataForm = $this->InventoryService->getDataForm(); 
                return view('cmt-opportunity.boq.pages.form-boq', compact('dataForm', 'dataCompany', 'dataProspect'));
            } else { 
                $dataProspect = CustomerProspect::doesntHave('itemableBillOfQuantity')->get();
                $dataForm = $this->InventoryService->getDataForm(); 
                return view('cmt-opportunity.boq.pages.form-boq', compact('dataProspect','dataForm'));
            }
        }

        function saveItemsBoQ(Request $request) : JsonResponse 
        {
            if ($request->ajax()) {
                return $this->BoqService->saveItemsBoQ($request);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
        function formUpdateBoQ(Request $request) 
        {
            // Ambil nilai prospect_id dari query string
            $prospectId = $request->query('prospect_id');
            $surveyRequestId = $request->query('survey_request_id');

            $dataItems = ItemableBillOfQuantity::with('itemable.inventoryGood')->where("prospect_id",$prospectId)->get();
            $dataProspect = CustomerProspect::doesntHave('itemableBillOfQuantity')->get();
            $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospectId)->first();
            $dataForm = $this->InventoryService->getDataForm();
        
            // Pass all the required data to the view
            return view('cmt-opportunity.boq.pages.form-update-boq', compact('dataItems', 'dataForm', 'dataCompany', 'dataProspect'));
        }

        public function getSurveyCompanyItemInventory(Request $request) 
        {
            try {
                // Your existing code...
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

        public function getMerkType(Request $request) 
        { 
            if ($request->ajax()) {
                $itemId = $request->input('item_id') ?? $request->item_id; 
                $itemData = $this->InventoryService->getMerkType($itemId);
                return response()->json($itemData);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
        function getDatatable(Request $request) : JsonResponse 
        {
            if ($request->ajax()) {
                return $this->BoqService->renderDatatable($request);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
    }
    
