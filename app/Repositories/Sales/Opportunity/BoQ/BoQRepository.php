<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Customer\CustomerProspect;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantityLog;
use App\Models\Inventory\InventoryGood;

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
    protected $modelLog;
    protected $customerProspect;

    function __construct(ItemableBillOfQuantity $model, CustomerProspect $customerProspect, ItemableBillOfQuantityLog $modelLog){
        $this->model = $model;
        $this->modelLog = $modelLog;
        $this->customerProspect = $customerProspect;
    }

    function getAll(Request $request){
        $dataBoq = $this->model->with(['itemableBillOfQuantityLog' ,'itemableBillOfQuantity', 'sales', 'prospect.customer.customerContact' ,'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog', ]);
        return $dataBoq;
    }    
    public function saveItemsBoQ(Request $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get the data for the itemable boq from the request
            $boqData = [
                'prospect_id' => $request->input('boq.prospect_id'),
                'survey_request_id' => $request->input('boq.survey_request_id'),
                // Tambahkan properti lain untuk data itemable boq
            ];
            
            // Cari atau buat itemable boq berdasarkan 'prospect_id'
            $itemableBoq = ItemableBillOfQuantity::updateOrCreate(
                ['prospect_id' => $boqData['prospect_id']],
                $boqData
            );
            
            // // If provided, delete the associated items for the provided itemableBoqId
            if (isset($itemableBoq->id)) {
                // Get the IDs of items associated with the provided itemable boq ID
                $itemIds = Item::where('itemable_id', $itemableBoq->id)->pluck('id')->toArray();
                // Delete the associated items
                Item::whereIn('id', $itemIds)->delete();
            }

            // Dapatkan data untuk semua item dari request
            $itemsData = $request->input('items');

            foreach ($itemsData as $itemData) {
                // Buat array yang berisi kriteria pencarian berdasarkan 'id' (jika id ada dalam $itemData)
                $criteria = [
                    'itemable_id' => $itemableBoq->id,
                    'itemable_type' => $itemableBoq->itemable_type,
                    // dan lain-lain... (jika ada kriteria lainnya yang unik)
                ];

                // Jika id ada dalam $itemData, tambahkan 'id' ke dalam kriteria pencarian
                if (isset($itemData['id'])) {
                    $criteria['id'] = $itemData['id'];
                }
            
                // Buat array yang berisi data untuk menciptakan item baru atau data perubahan
                $data = [
                    'quantity' => $itemData['quantity'],
                    'purchase_price' => $itemData['purchase_price'],
                    'total_price' => $itemData['total_price'],
                    'purchase_delivery_charge' => $itemData['purchase_delivery'],
                    'purchase_refrence' => $itemData['purchase_reference'],
                    'item_inventory_id' => $itemData['item_inventory_id'],
                    'item_detail' => $itemData['item_detail'],
                    'itemable_id' => $itemableBoq->id,
                    'itemable_type' => 'App\Models\Opportunity\BoQ\ItemableBillOfQuantities',
                    // dan lain-lain...
                ];
            
                // Cari atau buat item berdasarkan kriteria, dan asosiasikan dengan itemable boq
                $item = Item::updateOrCreate($criteria, $data);
                // dd($item); aman
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'BoQ and items successfully created.'], 200);
        } catch (Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            return response()->json(['error' => $e], 500);
        }
    }   

    function getDataWithoutId()  {
        $dataWithId = $this->customerProspect->with(['customer.customerContact' ,'customer.bussinesType' ])();
        return $dataWithId;
    }

    function getDataWithId($id)  {
        $dataWithId = $this->customerProspect->with(['customer.customerContact' ,'customer.bussinesType' ]);
        return $dataWithId;
    }

    function cancelBoQ() {
        // $dataBoQ
    }

    function getItemName() {
        $item = $this->model->itemableBillOfQuantity;

        if ($item instanceof InventoryGoods) {
            $inventoryGoods = $item->name;
            return $inventoryGoods;
        }

        return null;
    }
}
