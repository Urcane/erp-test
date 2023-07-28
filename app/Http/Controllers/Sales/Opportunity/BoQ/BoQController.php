<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
use App\Services\Sales\Opportunity\Survey\SurveyResultService;

class BoQController extends Controller
{

    protected $surveyResultService;
    protected 
    $BoqService;
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

    function index() {
        return view('cmt-opportunity.boq.index');
    }

    function formBoQ($id = null)
    {
        $dataForm = $this->InventoryService->getDataForm();  
        $salesEmployees =   $this->employees->where('department_id', 1)->get();
        $technicianEmployees =   $this->employees->where('department_id', 4)->get();
        $procurementEmployees =   $this->employees->where('department_id', 3)->get();
        if ($id === null) {
            $dataCompany = $this->BoqService->getFormWithoutID();
        }  else {
              $dataCompany = $this->BoqService->getFormWithID($id);
            if (!$dataCompany) {
                return response()->json("Oopss, ada yang salah nih!", 500);
            }
        }
        // dd($salesEmployees);
        return view('cmt-opportunity.boq.pages.form-boq', compact('dataForm', 'dataCompany', 'salesEmployees', 'technicianEmployees', 'procurementEmployees')); 
    }
    
    function createNewBoQ(Request $request) : JsonResponse {
        if ($request->ajax()) {
            if (!$this->customerProspect->where('id', $request->prospect_id)->exists()) {
                return response()->json(['Prospect ID Tidak Ditemukan 😥'], 404);
            }
            $this->BoqService->createNewBoQ($request);
            return response()->json('Data Tersimpan 🎂');
       }
       return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function getMerkType(Request $request)
    {
        if ($request->ajax()) {
             $itemId = $request->input('item_id');
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