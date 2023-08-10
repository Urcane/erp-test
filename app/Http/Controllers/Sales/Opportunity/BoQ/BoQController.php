<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Inventory\InventoryGood;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Customer\CustomerProspect;
use App\Services\Master\Item\ItemService;
use App\Services\Sales\Opportunity\BoQ\BoQService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Master\Inventory\InventoryService;
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Http\Requests\Opportunity\Survey\SurveyRequestRequest;
use App\Http\Controllers\Controller;

use App\Models\Inventory\InventoryGood;
use App\Models\Opportunity\BoQ\Items;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantities;
use App\Models\Customer\CustomerProspect;
use App\Models\Opportunity\Survey\SurveyRequest;

use Yajra\DataTables\Facades\DataTables;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Services\Master\Inventory\InventoryService;
use App\Services\Master\Item\ItemService;
use App\Services\Sales\Opportunity\BoQ\BoQService;
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;


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
        ) {
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

            // Ambil nilai prospect_id dari query string
            $prospectId = $request->query('prospect_id');
            $surveyRequestId = $request->query('survey_request_id');



            // Jika ada prospect_id dari query string, gunakan untuk mendapatkan semua data Company dan semua prospect id
            if ($prospectId || $surveyRequestId) {
                // kondisi url ada

                // Retrieve the items related to the specified prospectId
                $dataItems = ItemableBillOfQuantities::with('itemableBillOfQuantities','itemableBillOfQuantities.inventoryGood')->where("prospect_id", $prospectId)->get();
            
                $dataProspect = CustomerProspect::doesntHave('itemableBillOfQuantities')->get();
                $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospectId)->first();
                $dataForm = $this->InventoryService->getDataForm();
            
                // Pass all the required data to the view
                return view('cmt-opportunity.boq.pages.form-boq', compact('dataItems', 'dataForm', 'dataCompany', 'dataProspect'));
    
            } else {
                // Jika tidak ada prospect_id dari query string, gunakan inputan prospect_title untuk mendapatkan data company yang relevan
                $dataProspect = CustomerProspect::doesntHave('itemableBillOfQuantities')->get();
                $dataForm = $this->InventoryService->getDataForm();
                // dd($dataProspect);
                
                return view('cmt-opportunity.boq.pages.form-boq', compact('dataProspect','dataForm'));
            }
        }
        
        function formUpdateBoQ(Request $request)
        {
            // Ambil nilai prospect_id dari query string
            $prospectId = $request->query('prospect_id');
            $surveyRequestId = $request->query('survey_request_id');
            $surveyRequestId = $request->query('survey_request_id');

            // Jika ada prospect_id dari query string, gunakan untuk mendapatkan semua data Company dan semua prospect id
            if ($prospectId || $surveyRequestId) {
                // kondisi url ada

                // Retrieve the items related to the specified prospectId
                $dataItems = ItemableBillOfQuantities::with('itemableBillOfQuantities','itemableBillOfQuantities.inventoryGood')->where("prospect_id", $prospectId)->get();
            
                $dataProspect = CustomerProspect::doesntHave('itemableBillOfQuantities')->get();
                $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospectId)->first();
                $dataForm = $this->InventoryService->getDataForm();
            
                // Pass all the required data to the view
                return view('cmt-opportunity.boq.pages.form-update-boq', compact('dataItems', 'dataForm', 'dataCompany', 'dataProspect'));
            } 
        }


        public function getSurveyCompanyItemInventory(Request $request)
        {
            try {
                // Your existing code...
                if ($request->ajax()) {
                    $prospect_id = $request->query('prospect_id');
                    // dd($prospect_id);
                    // Get the primary key (id) in SurveyRequest based on the foreign key prospect_id
                    $surveyId = SurveyRequest::where('customer_prospect_id', $prospect_id);
                    
                    // If no matching SurveyRequest found, return null or handle it as needed
                    if (!$surveyId) {
                        $surveyId = null;
                    }
                    
                    $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospect_id)->first();
                    
                    $dataItems = ItemableBillOfQuantities::with('itemableBillOfQuantities','itemableBillOfQuantities.inventoryGood')->where("prospect_id", $prospect_id)->get();
                    // Gabungkan data dari 3 database ke dalam satu array
                    $combinedData = [
                        'survey' => $surveyId,
                        'dataCompany' => $dataCompany,
                        'dataItems' => $dataItems
                    ];
                    return response()->json($combinedData);
                }
            } catch (Exception $e) {
                // Log the error for debugging purposes
                \Log::error('Error in getSurveyCompanyItemInventory: ' . $e->getMessage());
                
                // Return an error response (optional)
                return response()->json(['error' => 'An error occurred'], 500);
            }
        }
        
        function saveItemsBoQ(Request $request) : JsonResponse{
            if ($request->ajax()) {
                return $this->BoqService->saveItemsBoQ($request);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
        function createNewBoQ(Request $request) : JsonResponse {
            if ($request->ajax()) {
                return $this->BoqService->createNewBoQ($request);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
        public function getMerkType(Request $request) {
            if ($request->ajax()) {
                $itemId = $request->input('item_id') ?? $request->item_id;
                $itemData = $this->InventoryService->getMerkType($itemId);
                return response()->json($itemData);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
        function getDatatableDraft(Request $request) : JsonResponse {
            if ($request->ajax()) {
                return $this->BoqService->renderDatatable($request);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
        
        function cancelBoQ(Request $request) : JsonResponse {
            if ($request->ajax()) {
                return $this->BoqService->cancelBoQ($request);
            }
            return response()->json('Oops, Somethin\' Just Broke :(');
        }
    }
