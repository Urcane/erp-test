<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Inventory\InventoryGood;
use App\Models\Customer\CustomerProspect;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantityLog;

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

    protected $customerProspect;

    function __construct(ItemableBillOfQuantity $model, CustomerProspect $customerProspect )
    {
        $this->model = $model;
        $this->customerProspect = $customerProspect;
    }

    function getAll(Request $request){
        $dataBoq = $this->model->with([  'sales', 'prospect.customer.customerContact' ,'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog', ]);

        if (isset($request->filters['is_draft']) && $request->filters['is_draft'] == 'true' ) {
            $dataBoq->where('is_draft',1)->wherenull('is_done');
        }

        if (isset($request->filters['is_draft']) && $request->filters['is_draft'] == 'false') {
            $dataBoq->where('is_draft',0)->wherenull('is_done');
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

    function saveItemsBoQ(Request $request){
        try {
            DB::beginTransaction();
            $boqData = [
                'prospect_id' => $request->input('boq.prospect_id'),
                'survey_request_id' => $request->input('boq.survey_request_id'),
            ];
            $itemableBoq = ItemableBillOfQuantity::updateOrCreate(
                ['prospect_id' => $boqData['prospect_id']],
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
            return response()->json(['message' => 'BoQ and items successfully created.'], 200);
        } catch (Exception $e) { 
            DB::rollback();
            return response()->json(['error' => $e], 500);
        }
    }   

    function getDataWithoutId(){
        $dataWithId = $this->customerProspect->with(['customer.customerContact' ,'customer.bussinesType' ])();
        return $dataWithId;
    }

    function getDataWithId($id){
        $dataWithId = $this->customerProspect->with(['customer.customerContact' ,'customer.bussinesType' ]);
        return $dataWithId;
    }
  
    function storeDataBoq(Request $request) {
        $prospect_id = $request->input('prospect_id');
        $itemableBoq = ItemableBillOfQuantity::where('prospect_id', $prospect_id)->first();
        if ($itemableBoq) {
            [
                'survey_request_id' => $request->input('survey_request_id'),
                'sales_id' => $request->input('sales_id'),
                'technician_id' => $request->input('technician_id'),
                'procurement_id' => $request->input('procurement_id'),
                'gpm' => $request->input('gpm'),
                'modal' => $request->input('modal'),
                'npm' => $request->input('npm'),
                'percentage' => $request->input('percentage'),
                'manpower' => $request->input('manpower'),
                'approval_manager' => $request->input('approval_manager'),
                'approval_manager_date' => $request->input('approval_manager_date'),
                'approval_director' => $request->input('approval_director'),
                'approval_director_date' => $request->input('approval_director_date'),
                'approval_finman' => $request->input('approval_finman'),
                'approval_finman_date' => $request->input('approval_finman_date'),
                $itemableBoq->save(),
            ];
            return response()->json(['message' => 'BoQ successfully updated.'], 200);
        } else {
            return response()->json(['message' => 'BoQ not found.'], 404);
        }
    }
}
