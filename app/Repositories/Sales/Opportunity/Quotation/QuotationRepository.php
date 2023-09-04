<?php

namespace App\Repositories\Sales\Opportunity\Quotation;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Master\Inventory\InventoryService;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\Quotation\ItemableQuotationPart;

class QuotationRepository
{
    protected $model;
    protected $boqData;

    function __construct(ItemableQuotationPart $model, ItemableBillOfQuantity $boqData, InventoryService $inventoryService) {
        $this->model = $model;
        $this->boqData = $boqData;
    }

    function getAll() : JsonResponse {
        $dataQuotation = $this->model->with('ItemableQuotationPart')->get();
        return response()->json($dataQuotation);
    }

    function createQuotation(Request $request) {
        $boqId = $request->query('boq_id');
        $boqData = $this->boqData->where('id', $boqId)->first();
        $boqFinalData = $this->boqData->with('itemable.inventoryGood', 'customerProspect.customer.customerContact',)->where("prospect_id",$boqData->prospect_id)->get();        
        return [
            'boqFinalData' => $boqFinalData
        ];
    }

    function updateQuotation(Request $request) {
        $quotationId = $request->query('quotation_id');
        $quotationData = $this->model->where('id', $quotationId)->first();
        $boqData = $this->boqData->where('id', $quotationData->boq_id)->first();
        $boqFinalData = $this->boqData->with('itemable.inventoryGood', 'customerProspect.customer.customerContact',)->where("prospect_id",$boqData->prospect_id)->get();         
        return [
            'quotationData' => $quotationData,
            'boqFinalData' => $boqFinalData
        ];
    }

    function saveAndStoreQuotation(Request $request)  {
        $quotationData = $this->model->updateOrCreate(
            [
                'id' => $request->input('quotation.id') //jika quotation sudah ada, maka update, jika belum ada, maka create
            ],
            [
                'boq_id' => $request->input('quotation.boq_id'), //ini wajib selalu di isi
                'no_quotation' => $request->input('quotation.no_quotation'),
                'description' => $request->input('quotation.description'),
                
                'total_price' => $request->input('quotation.total_price'),
                'remark' => $request->input('quotation.remark'),
                'is_done' => $request->input('quotation.is_done'), //kondisi jika quotation di cancel, request is_done = 0
            ]
        );        
        $quotationData->referenced_quotation_id = $quotationData->id;
        $quotationData->save();
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
}
