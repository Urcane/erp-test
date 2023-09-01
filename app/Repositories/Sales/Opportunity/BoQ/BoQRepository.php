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
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Nette\Utils\Json;

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
    protected $user;

    function __construct(ItemableBillOfQuantity $model, CustomerProspect $customerProspect, InventoryService $inventoryService, SurveyRequest $surveyRequest, User $user){
        $this->model = $model;
        $this->inventoryService = $inventoryService;
        $this->customerProspect = $customerProspect;
        $this->surveyRequest = $surveyRequest;
        $this->user = $user;
    }

    function getAll(Request $request){
        $dataBoq = $this->model->with(['sales', 'prospect.customer.customerContact' ,'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog', ])->doesntHave('itemableQuotationPart');

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
    
    function getProspect()  {
        return $this->customerProspect->with('customer.customerContact', 'customer.bussinesType','surveyRequest');
    }
    
    function getListItem()  {
        return $this->inventoryService->getDataForm();
    }

    function getSurvey() {
        return $this->surveyRequest;
    }

    function saveAndStoreBoq(Request $request) : JsonResponse {
        try {
            DB::beginTransaction();
            $prospect_id = $request->input('boq.prospect_id');
            $survey_request_id = $request->input('boq.survey_request_id');
            $is_draft = $request->input('boq.is_draft', 1);
            $sales_id = $request->input('boq.sales_id');
            $technician_id = $request->input('boq.technician_id');
            $procurement_id = $request->input('boq.procurement_id');
            $gpm = $request->input('boq.gpm');
            $modal = $request->input('boq.modal');
            $npm = $request->input('boq.npm');
            $percentage = $request->input('boq.percentage');
            $manpower = $request->input('boq.manpower');
            $is_final = $request->input('boq.is_final', 0);

            $itemableBoqIsDraft = ItemableBillOfQuantity::where([
                'prospect_id' => $prospect_id,
                'survey_request_id' => $survey_request_id,
            ])->first();

            if ($itemableBoqIsDraft) {
                if ($itemableBoqIsDraft->is_draft === 0) {
                    $is_draft = 0;
                }
            }

            $itemableBoq = ItemableBillOfQuantity::updateOrCreate(
                [
                    'prospect_id' => $prospect_id, 
                    'survey_request_id' => $survey_request_id,
                ],
                [
                    'sales_id' => $sales_id,
                    'technician_id' => $technician_id,
                    'procurement_id' => $procurement_id,
                    'gpm' => $gpm,
                    'modal' => $modal,
                    'npm' => $npm,
                    'percentage' => $percentage,
                    'manpower' => $manpower,
                    'is_final' => $is_final,
                    'is_draft' => $is_draft,
                    'reference_boq_id' => 1,
                ]
            );
            $itemableBoq->reference_boq_id = $itemableBoq->id;

            if (isset($itemableBoq->id)) {
                $itemIds = Item::where('itemable_id', $itemableBoq->id)->pluck('id')->toArray();
                Item::whereIn('id', $itemIds)->delete();
            }
            $itemsData = $request->input('items');

            if (!empty($itemsData)) {
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
            }
            $itemableBoq->save();
            DB::commit();
            return response()->json(['message' => 'BoQ berhasil disimpan.'], 200);
            
        }catch (\Exception $e) { 
            DB::rollback();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    function storeApprovalBoq(Request $request) : JsonResponse {
        // dd($request->input('boq.boq_id'));
        $boqId = $request->input('boq_id');
        $remark = $request->input('remark');
        $boqData = $this->model->where('id', $boqId)->first();
        
        if ($boqData) {
            $approval_manager = $request->input('is_approval_manager');
            $approval_director = $request->input('is_approval_director');
            $approval_finman = $request->input('is_approval_finman');
        
            if ($approval_manager !== null) {
                $boqData->approval_manager = $approval_manager;
                if (empty($boqData->approval_manager_date)) {
                    $boqData->approval_manager_date = date('Y-m-d H:i:s');
                }
            }
            if ($approval_director !== null) {
                $boqData->approval_director = $approval_director;
                if (empty($boqData->approval_director_date)) {
                    $boqData->approval_director_date = date('Y-m-d H:i:s');
                }
            }
            if ($approval_finman !== null) {
                $boqData->approval_finman = $approval_finman;
                if (empty($boqData->approval_finman_date)) {
                    $boqData->approval_finman_date = date('Y-m-d H:i:s');
                }
            }

            if ($boqData->approval_manager === null || $boqData->approval_director === null || $boqData->approval_finman === null) {
                $boqData->is_done = null;
                } else {
                    if ($boqData->approval_manager == 1 && $boqData->approval_director == 1 && $boqData->approval_finman == 1) {
                        $boqData->is_done = 1;
                        $boqData->is_draft = 0;
                    } else {
                        $boqData->is_done = 0;
                    }
            }
            if (isset($remark)) { 
                $boqData->remark = $remark;
            }
            
            $boqData->save();
            return response()->json(['message' => 'Approval & Reject berhasil disimpan.'], 200);
        }
        return response()->json(['error' => 'BoQ tidak ditemukan.'], 404);
    }

    function createRevisionBoq(Request $request) : JsonResponse {
        try {
            DB::beginTransaction();
    
            $rejectedBoq = $this->model->findOrFail($request->input('boq.boq_id'));
    
            $newBoq = $this->model->create([
                'prospect_id' => $rejectedBoq->prospect_id,
                'survey_request_id' => $rejectedBoq->survey_request_id,
                'sales_id' => $request->input('boq.sales_id'),
                'technician_id' => $request->input('boq.technician_id'),
                'procurement_id' => $request->input('boq.procurement_id'),
                'gpm' => $request->input('boq.gpm'),
                'modal' => $request->input('boq.modal'),
                'npm' => $request->input('boq.npm'),
                'percentage' => $request->input('boq.percentage'),
                'manpower' => $request->input('boq.manpower'),
                'approval_manager' => null,
                'approval_manager_date' => null,
                'approval_director' => null,
                'approval_director_date' => null,
                'approval_finman' => null,
                'approval_finman_date' => null,
                'is_draft' => 1,
                'is_final' => 0,
                'remark' => null,
            ]);
            $newBoq->reference_boq_id = $newBoq->id;
            $newBoq->save();
    
            $itemsData = $request->input('items');
    
            if (!empty($itemsData)) {
                foreach ($itemsData as $itemData) {
                    $newBoq->itemable()->create([
                        'quantity' => $itemData['quantity'],
                        'purchase_price' => $itemData['purchase_price'],
                        'total_price' => $itemData['total_price'],
                        'purchase_delivery_charge' => $itemData['purchase_delivery'],
                        'purchase_refrence' => $itemData['purchase_reference'],
                        'item_inventory_id' => $itemData['item_inventory_id'],
                        'item_detail' => $itemData['item_detail'],
                    ]);
                }
            }
    
            DB::commit();
            return response()->json(['message' => 'BOQ Baru Berhasil Dibuat.'], 200);
    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    function updateDraftBoq(Request $request){
        $boqId = $request->query('boq_id');
        $boqData = $this->model->where('id', $boqId)->first();

        $dataCompanyItem = $this->model->with('itemable.inventoryGood', 'customerProspect.customer.customerContact', 'customerProspect.customer.bussinesType')->where("prospect_id",$boqData->prospect_id)->get();
        $dataForm = $this->inventoryService->getDataForm();
        $dataSales = $this->user->where('department_id', 1)->get();
        $dataSalesSelected = $this->user->where('id', $boqData->sales_id)->first();
        $dataProcurement = $this->user->where('department_id', 2)->get();
        $dataProcurementSelected = $this->user->where('id', $boqData->procurement_id)->first();
        $dataTechnician = $this->user->where('department_id', 4)->get();
        $dataTechnicianSelected = $this->user->where('id', $boqData->technician_id)->first();

        return [
            'dataCompanyItem' => $dataCompanyItem,
            'dataForm' => $dataForm,
            'dataSales' => $dataSales,
            'dataSalesSelected' => $dataSalesSelected,
            'dataProcurement' => $dataProcurement,
            'dataProcurementSelected' => $dataProcurementSelected,
            'dataTechnician' => $dataTechnician,
            'dataTechnicianSelected' => $dataTechnicianSelected,
        ];
    }

    function onReviewBoq(Request $request){
        $boqId = $request->query('boq_id');
        $boqData = $this->model->where('id', $boqId)->first();

        $dataCompanyItem = $this->model->with('itemable.inventoryGood', 'customerProspect.customer.customerContact', 'customerProspect.customer.bussinesType')->where("prospect_id",$boqData->prospect_id)->get();       
        $dataSalesSelected = $this->user->where('id', $boqData->sales_id)->first(); 
        $dataProcurementSelected = $this->user->where('id', $boqData->procurement_id)->first(); 
        $dataTechnicianSelected = $this->user->where('id', $boqData->technician_id)->first();

        return [
            'dataCompanyItem' => $dataCompanyItem, 
            'dataSalesSelected' => $dataSalesSelected, 
            'dataProcurementSelected' => $dataProcurementSelected, 
            'dataTechnicianSelected' => $dataTechnicianSelected,
        ];
    }

}
