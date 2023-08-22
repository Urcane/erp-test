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
                    'reference_boq_id' => $prospect_id,
                    'is_draft' => $is_draft,
                ]
            );
    
            $itemsData = $request->input('items');
            foreach ($itemsData as $itemData) {
                $criteria = [
                    'itemable_id' => $itemableBoq->id,
                    'itemable_type' => $itemableBoq->itemable_type,
                ];
                if (isset($itemData['id'])) {
                    $criteria['id'] = $itemData['id'];
                }
                $itemData = [
                    'quantity' => $itemData['quantity'],
                    'purchase_price' => $itemData['purchase_price'],
                    'total_price' => $itemData['total_price'],
                    'purchase_delivery_charge' => $itemData['purchase_delivery'],
                    'purchase_refrence' => $itemData['purchase_reference'],
                    'item_inventory_id' => $itemData['item_inventory_id'],
                    'item_detail' => $itemData['item_detail'],
                ];
    
                $itemableBoq->itemable()->updateOrCreate($criteria, $itemData);
            }
    
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
            DB::commit();
            return response()->json(['message' => 'BoQ berhasil disimpan.'], 200);
            
        }catch (Exception $e) { 
            DB::rollback();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    function createRevisionBoq(Request $request) : JsonResponse{
        $rejectedBoq = ItemableBillOfQuantity::findOrFail($request->query('id'));
        $copyBoq = $rejectedBoq->toArray();
        unset($copyBoq['id']); 
        unset($copyBoq['created_at']); 
        unset($copyBoq['updated_at']); 
        $copyBoq['approval_manager'] = null;
        $copyBoq['approval_manager_date'] = null;
        $copyBoq['approval_director'] = null;
        $copyBoq['approval_director_date'] = null;
        $copyBoq['approval_finman'] = null;
        $copyBoq['approval_finman_date'] = null;
        $copyBoq['is_draft'] = 1;
        $copyBoq['is_final'] = 0;
        $copyBoq['remark'] = null;
        $copyBoq['reference_boq_id'] = null;

        $revisionBoq = ItemableBillOfQuantity::create($copyBoq);

        $revisionBoq['reference_boq_id'] = $revisionBoq['id'];

        foreach ($rejectedBoq->itemable as $item) {
            $newItems = $item->toArray();
            unset($newItems['id']); 
            $revisionBoq->itemable()->create($newItems);
        }

        return response()->json(['message' => 'Boq Berhasil Dibuat Kembali.'], 200);
    }

    function updateDraftBoq(Request $request){
        $boqId = $request->query('boq_id');
        $prospectId = $this->model->where('id', $boqId)->first();

        $dataCompanyItem = $this->model->with('itemable.inventoryGood', 'customerProspect.customer.customerContact', 'customerProspect.customer.bussinesType')->where("prospect_id",$prospectId->prospect_id)->get();
        $dataForm = $this->inventoryService->getDataForm();
        $dataSales = $this->user->where('department_id', 1)->get();
        $dataFinance = $this->user->where('department_id', 2)->get();
        $dataTechnician = $this->user->where('department_id', 4)->get();
        // dd($dataTechnician);
        return [
            'dataCompanyItem' => $dataCompanyItem,
            'dataForm' => $dataForm,
            'dataSales' => $dataSales,
            'dataFinance' => $dataFinance,
            'dataTechnician' => $dataTechnician,
        ];
    }

}
