<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Customer\CustomerProspect;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Services\Master\Inventory\InventoryService;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use Illuminate\Http\JsonResponse;

//use Your Model

/**
 * Class BoQDraftRepository.
 */
class BoQRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;
    protected $inventoryService;
    protected $customerProspect;
    protected $surveyRequest;

    function __construct(ItemableBillOfQuantity $model, CustomerProspect $customerProspect, InventoryService $inventoryService, SurveyRequest $surveyRequest){
        $this->model = $model;
        $this->inventoryService = $inventoryService;
        $this->customerProspect = $customerProspect;
        $this->surveyRequest = $surveyRequest;
    }

    function getAll(Request $request){
        $dataBoq = $this->model->with([  'sales', 'prospect.customer.customerContact' ,'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog', ]);

        if (isset($request->filters['is_draft']) && $request->filters['is_draft'] == 'true' ) {
            $dataBoq->where('is_draft',1)->wherenull('is_done');
        }

        if (isset($request->filters['is_draft']) && $request->filters['is_draft'] == 'false') {
            $dataBoq->where('is_draft',0)->where('is_final',0)->wherenull('is_done');
        }

        if (isset($request->filters['is_final']) && $request->filters['is_final'] == 'true') {
            $dataBoq->where('is_final',1)->whereNull('is_done');
        }

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == 'true') {
            $dataBoq->where('is_done',1);
        }

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == null) {
            $dataBoq->where('is_done',null);
        }
        if (isset($request->filters['is_done']) && $request->filters['is_done'] == 'false') {
            $dataBoq->where('is_done',0);
        }
        return $dataBoq;
    }    

    function saveItemsBoQ(Request $request) : JsonResponse{
        try {
            DB::beginTransaction();
            $boqData = [
                'prospect_id' => $request->input('boq.prospect_id'),
                'survey_request_id' => $request->input('boq.survey_request_id'),
            ];
            $itemableBoq = ItemableBillOfQuantity::updateOrCreate(
                ['prospect_id' => $boqData['prospect_id']],
                ['reference_boq_id' => $boqData['prospect_id']],
                $boqData
            );
            if (isset($itemableBoq->id)) {
                $itemIds = Item::where('itemable_id', $itemableBoq->id)->pluck('id')->toArray();
                Item::whereIn('id', $itemIds)->delete();
            }
            $itemsData = $request->input('items');
            foreach ($itemsData as $itemData) {
                $criteria = [
                    'itemable_id' => $itemableBoq->id,
                    'itemable_type' => $itemableBoq->itemable_type, 
                ];
                if (isset($itemData['id'])) {
                    $criteria['id'] = $itemData['id'];
                }
                $data = [
                    'quantity' => $itemData['quantity'],
                    'purchase_price' => $itemData['purchase_price'],
                    'total_price' => $itemData['total_price'],
                    'purchase_delivery_charge' => $itemData['purchase_delivery'],
                    'purchase_refrence' => $itemData['purchase_reference'],
                    'item_inventory_id' => $itemData['item_inventory_id'],
                    'item_detail' => $itemData['item_detail'],
                ];
                $itemableBoq->itemable()->updateOrCreate($criteria, $data);
            }
            DB::commit();
            return redirect()->route('com.boq.index')->with(response()->json(['message' => 'BoQ berhasil disimpan.'], 200));
            
        } catch (Exception $e) { 
            DB::rollback();
            return response()->json(['error' => $e], 500);
        }
    }   
  
    function storeDataBoq(Request $request) : JsonResponse {
        $request->validate( [
            'prospect_id' => 'required',
            'sales_id' => 'required',
            'technician_id' => 'required',
            'procurement_id' => 'required',
            'gpm' => 'required|numeric',
            'modal' => 'required|numeric',
            'npm' => 'required|numeric',
            'percentage' => 'required|integer',
            'manpower' => 'required|integer',
        ]);

        $prospect_id = $request->input('prospect_id');
        $itemableBoq = ItemableBillOfQuantity::where('prospect_id', $prospect_id)->first();
    
        if ($itemableBoq) {
            $itemableBoq->survey_request_id = $request->input('survey_request_id');
            $itemableBoq->sales_id = $request->input('sales_id');
            $itemableBoq->technician_id = $request->input('technician_id');
            $itemableBoq->procurement_id = $request->input('procurement_id');
            $itemableBoq->gpm = $request->input('gpm');
            $itemableBoq->modal = $request->input('modal');
            $itemableBoq->npm = $request->input('npm');
            $itemableBoq->percentage = $request->input('percentage');
            $itemableBoq->manpower = $request->input('manpower');
            $itemableBoq->manpower = $request->input('is_draft');
            $itemableBoq->approval_manager = $request->input('approval_manager');
            $itemableBoq->approval_manager_date = $request->input('approval_manager_date');
            $itemableBoq->approval_director = $request->input('approval_director');
            $itemableBoq->approval_director_date = $request->input('approval_director_date');
            $itemableBoq->approval_finman = $request->input('approval_finman');
            $itemableBoq->approval_finman_date = $request->input('approval_finman_date');
            $itemableBoq->reference_boq_id = $itemableBoq->id;
            
            if ($itemableBoq->approval_manager === null || $itemableBoq->approval_director === null || $itemableBoq->approval_finman === null) {
                $itemableBoq->is_done = null;
            } else {
                if ($itemableBoq->approval_manager == 1 && $itemableBoq->approval_director == 1 && $itemableBoq->approval_finman == 1) {
                    $itemableBoq->is_done = 1;
                } else {
                    $itemableBoq->is_done = 0;
                }
            }
            
            $itemableBoq->save();
            return response()->json(['message' => 'BoQ berhasil diperbarui.'], 200);
        } else {
            return response()->json(['message' => 'BoQ not found.'], 404);
        }
    }

    function createRevisionBoq(Request $request) : JsonResponse{

        $rejectedBoq = ItemableBillOfQuantity::findOrFail($request->query('id'));
        $copyBoq = $rejectedBoq->toArray();
        unset($copyBoq['id']); 

        $revisionBoq = ItemableBillOfQuantity::create($copyBoq);

        foreach ($rejectedBoq->itemable as $item) {
            $newItems = $item->toArray();
            unset($newItems['id']); 
            $revisionBoq->itemable()->create($newItems);
        }

        return response()->json(['message' => 'Boq Berhasil Dibuat Kembali.'], 200);
    }

    function createDraftBoq(Request $request){
        $prospectId = $request->query('prospect_id');
        $surveyRequestId = $request->query('survey_request_id');
    
        if ($prospectId && $surveyRequestId) { 
            $dataForm = $this->inventoryService->getDataForm(); 
            $dataProspect = $this->customerProspect->doesntHave('itemableBillOfQuantity')->where('id', $prospectId)->first();
            $dataCompany = $this->customerProspect->with(['customer.customerContact', 'customer.bussinesType'])
            ->where('id', $prospectId)
            ->first();
            $dataSurvey = $this->surveyRequest->with(['customerProspect'])
            ->where('id', $surveyRequestId)
            ->where('customer_prospect_id', $prospectId)
            ->first();    
             return view('cmt-opportunity.boq.pages.form-boq', compact('dataProspect', 'dataSurvey', 'dataForm','dataCompany'));

        } elseif ($prospectId) {
            $dataProspect = $this->customerProspect->doesntHave('itemableBillOfQuantity')->where('id', $prospectId)->first();
            $dataForm = $this->inventoryService->getDataForm(); 
            $dataCompany = $this->customerProspect->with(['customer.customerContact', 'customer.bussinesType'])
                ->where('id', $prospectId)
                ->doesntHave('itemableBillOfQuantity')
                ->first();
            $dataSurvey = $this->surveyRequest->with(['customerProspect'])
            ->where('customer_prospect_id', $prospectId)
            ->get();
            return view('cmt-opportunity.boq.pages.form-boq', compact('dataCompany', 'dataProspect', 'dataSurvey', 'dataForm'));

        } else {
            $dataForm = $this->inventoryService->getDataForm(); 
            $dataProspect = $this->customerProspect->doesntHave('itemableBillOfQuantity')->get();
            $dataSurvey = $this->surveyRequest->with(['customerProspect'])->get();
            return view('cmt-opportunity.boq.pages.form-boq', compact('dataProspect', 'dataSurvey', 'dataForm'));
        }
    }
    
    function updateDraftBoq(Request $request){
        $boqId = $request->query('boq_id');
        $surveyRequestId = $request->query('survey_request_id');

        $prospectId = $this->model->where('id', $boqId)->first();

        $dataItems = $this->model->with('itemable.inventoryGood')->where("prospect_id",$prospectId->prospect_id)->get();
        $dataCompany = $this->customerProspect->with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospectId->prospect_id)->first();
        $dataForm = $this->inventoryService->getDataForm();
    
        return view('cmt-opportunity.boq.pages.form-update-boq', compact('dataItems', 'dataForm', 'dataCompany'));
    }
}
