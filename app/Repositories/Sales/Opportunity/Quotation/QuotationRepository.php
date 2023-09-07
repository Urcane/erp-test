<?php

namespace App\Repositories\Sales\Opportunity\Quotation;

use App\Models\Inventory\InventoryGood;
use App\Models\Opportunity\BoQ\Item;
use Illuminate\Http\Request;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\Quotation\ItemableQuotationPart;
use Illuminate\Http\JsonResponse;

class QuotationRepository
{
    protected $model;
    protected $boqData;
    protected $item;

    function __construct(ItemableQuotationPart $model, ItemableBillOfQuantity $boqData) {
        $this->model = $model;
        $this->boqData = $boqData;
    }


    function getAll(Request $request) {
        $dataQuotation = $this->model->with('itemableBillOfQuantity.customerProspect.customer.customerContact', 'itemableBillOfQuantity.customerProspect.customer.customerContact');

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == 'true') {
            $dataQuotation->where('is_done',1);
        }

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == 'false') {
            $dataQuotation->where('is_done',0);
        }

        if (isset($request->filters['is_progress']) && $request->filters['is_progress'] == 'true') {
            $dataQuotation->where('is_done', null);
        }

        return ($dataQuotation);
    }

    function createQuotation(Request $request) {
        $boqId = $request->query('boq_id');
        $boqData = $this->boqData->where('id', $boqId)->first();
        $inventoryGoodInet = InventoryGood::whereNotIn('good_category_id', [1,2])->get();
        $boqFinalData = $this->boqData->with('itemable.inventoryGood', 'customerProspect.customer.customerContact',)->where("prospect_id",$boqData->prospect_id)->get();        
        return [
            'boqFinalData' => $boqFinalData,
            'inventoryGoodInet' => $inventoryGoodInet,
        ];
    }

    function updateQuotation(Request $request) {
        $quotationId = $request->query('quotation_id');
        $quotationData = $this->model->where('id', $quotationId)->first();
        $quotationItem = Item::where('itemable_id', $quotationId)
        ->whereHas('inventoryGood', function($query){
            $query->where('good_category_id', 3);
       })->get();
        $inventoryGoodInet = InventoryGood::whereNotIn('good_category_id', [1,2])->get();
        $boqData = $this->boqData->where('id', $quotationData->boq_id)->first();
        $boqFinalData = $this->boqData->with('itemable.inventoryGood', 'customerProspect.customer.customerContact',)->where("prospect_id",$boqData->prospect_id)->get();         
        return [
            'quotationData' => $quotationData,
            'boqFinalData' => $boqFinalData,
            'quotationItem' => $quotationItem,
            'inventoryGoodInet' => $inventoryGoodInet,
        ];
    }

    function saveAndStoreQuotation(Request $request)  {
        $quotationData = $this->model->updateOrCreate(
            [
                'id' => $request->input('quotation.boq_id') //jika quotation sudah ada, maka update, jika belum ada, maka create
            ],
            [
                'boq_id' => $request->input('quotation.boq_id'), //ini wajib selalu di isi
                'no_quotation' => $request->input('quotation.no_quotation'),
                'description' => $request->input('quotation.description'),
                
                'total_price' => $request->input('quotation.total_price'),
                'remark' => $request->input('quotation.remark'),
                'is_done' => $request->input('quotation.is_done', null), //kondisi jika quotation di cancel, request is_done = 0
            ]
        );        
        $quotationData->referenced_quotation_id = $quotationData->id;

        if (isset($quotationData->id)) {
            $itemIds = Item::where('itemable_id', $quotationData->id)
                            ->whereHas('inventoryGood', function ($query) {
                                $query->where('good_category_id', 3);
                            })
                            ->pluck('id')
                            ->toArray();
                            
            Item::whereIn('id', $itemIds)->delete();
        }
        $bundles = $request->input('bundle');

        if (!empty($bundles)) {
            foreach ($bundles as $bundle) {
                $data = [
                    'itemable_id' => $quotationData->id,
                    'itemable_type' => $quotationData->itemable_type, 
                    'item_inventory_id' => $bundle['id'],
                    'quantity' => $bundle['quantity'],
                    'purchase_price' => $bundle['purchase_price'],
                    'total_price' => $bundle['total_price'],
                ];
                $quotationData->itemableQuotation()->create( $data);
            }
        }
        $quotationData->save();
        return $quotationData;
    }

    function storePurchaseOrder(Request $request){ 
        $quotationId = $request->input('quotation_id');
        $quotationData = $this->model->where('id', $quotationId)->first();
        
        if (!$quotationData) {
            return response()->json(['message' => 'Quotation not found'], 404);
        }
        return $quotationData;
    }
    
    function revisionQuotation(Request $request){
        //dipanggil pada tombol revision quotation
        $revisionQuotation = $this->model->findOrFail($request->input('quotation.id'));
        $revisionQuotation->remark = $request->input('quotation.remark');
        $revisionQuotation->is_done = 0;
        $revisionQuotation->save();
    
        $newBoq = $this->model->create([
            'boq_id' => $request()->input('quotation.boq_id'),
            'no_quotation' => $request()->input('quotation.no_quotation'),
            'description' => $request()->input('quotation.description'),
            'total_price' => $request()->input('quotation.total_price'),
            'remark' => null,
            'is_done' => null,
        ]);
        $newBoq->reference_boq_id = $newBoq->id;
        $newBoq->save();
    }

    function exportQuotationResult($isQuotation, $id) {
        $dataQuotation = $this->model->where('id', $id)->first();
    
        if (!$dataQuotation) {
            return response()->json(['message' => 'Sayang Sekali :( Quotation tidak ditemukan'], 404);
        }
    
        $dataBoq = $this->boqData->where('id', $dataQuotation->boq_id)->first();
    
        if (!$dataBoq) {
            return response()->json(['message' => 'Sayang Sekali :( BoQ tidak ditemukan'], 404);
        }
    
        $dataFinalBoq = $this->boqData->with('itemable.inventoryGood', 'customerProspect.customer.customerContact')
            ->where('prospect_id', $dataBoq->prospect_id)
            ->get();

        $index = 1;
        $finalPrice = 0;

        $view = "cmt-opportunity.quotation.pages.print.$isQuotation-print";
        $compact = [
            'dataQuotation',
            'dataFinalBoq',
            'index',
            'finalPrice'
        ];

        return view($view, compact(
            ...$compact
        ));
    }    

    function cancelQuotation(Request $request) : JsonResponse {
        // dd($request->quotation_id2);
        $quotationId = $request->quotation_id2;
        $quotationData = $this->model->where('id', $quotationId)->first();
        $quotationData->is_done = 0;
        $quotationData->save();
        return response()->json(['message' => 'Quotation has been canceled'], 200);
    }
}
