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
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use App\Services\Master\Inventory\InventoryService;

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
    
    // public function getMerkType(Request $request)
    // {
    //     $itemId = $request->input('item_id');

    //     // Mengambil data jenis dan merek item berdasarkan item yang dipilih
    //     $itemData = InventoryGood::select('good_type', 'merk')->where('id', $itemId)->first();
    //     return response()->json($itemData);

        
    // }
    public function getMerkType(Request $request)
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
            return $this->BoqDraftService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }
}