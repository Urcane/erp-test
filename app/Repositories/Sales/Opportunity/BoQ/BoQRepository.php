<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Nette\Utils\Json;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Inventory\InventoryGood;
use App\Models\Customer\CustomerProspect;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Services\Master\Inventory\InventoryService;
use App\Models\Opportunity\BoQ\ItemablePriceRequest;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Repositories\Sales\Opportunity\PriceRequest\PriceRequestRepository;

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

    function __construct(ItemableBillOfQuantity $model, CustomerProspect $customerProspect, InventoryService $inventoryService, SurveyRequest $surveyRequest, User $user)
    {
        $this->model = $model;
        $this->inventoryService = $inventoryService;
        $this->customerProspect = $customerProspect;
        $this->surveyRequest = $surveyRequest;
        $this->user = $user;
    }

    function getAll(Request $request)
    {
        $dataBoq = $this->model;

        if (isset($request->filters['is_draft']) && $request->filters['is_draft'] == 'true') {
            $dataBoq = $dataBoq->draft();
        }

        if (isset($request->filters['is_draft']) && $request->filters['is_draft'] == 'false') {
            $dataBoq = $dataBoq->publish();
        }

        if (isset($request->filters['is_final']) && $request->filters['is_final'] == 'true') {
            $dataBoq = $dataBoq->onReview();
        }

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == 'true') {
            $dataBoq = $dataBoq->done();
        }

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == null) {
            $dataBoq = $dataBoq->where('is_done', null);
        }

        if (isset($request->filters['is_done']) && $request->filters['is_done'] == 'false') {
            $dataBoq = $dataBoq->where('is_done', 0);
        }

        if (isset($request->filters['is_quotation']) && $request->filters['is_quotation'] == 'false') {
            $dataBoq->where('is_done', 1)->doesntHave('itemableQuotationPart');
        }
        return $dataBoq->with('sales', 'prospect.customer.customerContact', 'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog');
    }

    function getProspect()
    {
        return $this->customerProspect->with('customer.customerContact', 'customer.bussinesType', 'surveyRequest');
    }

    function getListItem()
    {
        return $this->inventoryService->getDataForm();
    }

    function getSurvey()
    {
        return $this->surveyRequest;
    }

    function saveAndStoreBoq(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $boq_id = $request->input('boq.boq_id');
            $prospect_id = $request->input('boq.prospect_id');
            $survey_request_id = $request->input('boq.survey_request_id');
            $is_draft = $request->input('boq.is_draft', 1);
            $sales_id = $request->input('boq.sales_id');
            $technician_id = $request->input('boq.technician_id');
            $procurement_id = $request->input('boq.procurement_id');
            $gpm = $request->input('boq.gpm', 0);
            $modal = $request->input('boq.modal', 0);
            $npm = $request->input('boq.npm', 0);
            $percentage = $request->input('boq.percentage', 0);
            // $manpower = $request->input('boq.manpower', 0);
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
                    'id' => $boq_id,
                ],
                [
                    'prospect_id' => $prospect_id,
                    'survey_request_id' => $survey_request_id,
                    'sales_id' => $sales_id,
                    'technician_id' => $technician_id,
                    'procurement_id' => $procurement_id,
                    'gpm' => $gpm,
                    'modal' => $modal,
                    'npm' => $npm,
                    'percentage' => $percentage,
                    // 'manpower' => $manpower,
                    'is_final' => $is_final,
                    // 'reference_boq_id' => $boq_id,
                    'is_draft' => $is_draft ?? 1,
                    // 'reference_boq_id' => 1,
                ]
            );

            $itemablePriceRequest = PriceRequestRepository::storeFromBoq($itemableBoq);
            // $itemableBoq->reference_boq_id = $itemableBoq->id;

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

                    Log::info($itemData);

                    $data = [
                        'quantity' => $itemData['quantity'],
                        'unit' => $itemData['unit'],
                        'purchase_price' => $itemData['purchase_price'] ?? 0,
                        'total_price' => (($itemData['purchase_price'] ?? 0) * $itemData['quantity']) + ($itemData['purchase_delivery'] ?? 0),
                        'purchase_delivery_charge' => $itemData['purchase_delivery'] ?? 0,
                        'purchase_reference' => $itemData['purchase_reference'] ?? null,
                        'delivery_route' => $itemData['delivery_route'] ?? null,
                        'delivery_type' => $itemData['delivery_type'] ?? null,
                        'purchase_from' => $itemData['purchase_from'] ?? null,
                        'payment_type' => $itemData['payment_type'] ?? null,
                        'purchase_validity' => $itemData['purchase_validity'] ?? null,
                        'inventory_good_id' => $itemData['item_inventory_id'],
                        'item_detail' => $itemData['item_detail'] ?? null,
                    ];
                    $itemableBoq->itemable()->updateOrCreate($criteria, $data);
                }
            }
            $itemableBoq->save();
            DB::commit();
            return response()->json(['message' => 'BoQ berhasil disimpan.', 'data' => $itemableBoq], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    function storeApprovalBoq(Request $request): JsonResponse
    {
        $boqId = $request->input('boq_id');
        $remark = $request->input('remark');
        $boqData = $this->model->where('id', $boqId)->first();

        if ($boqData) {
            $approval_manager_sales = $request->input('is_approval_manager_sales');
            $approval_manager_operation = $request->input('is_approval_manager_operation');
            $approval_director = $request->input('is_approval_director');
            $approval_finman = $request->input('is_approval_finman');

            if ($approval_manager_sales !== null) {
                $boqData->approval_manager_sales = $approval_manager_sales;
                if (empty($boqData->approval_manager_sales_date)) {
                    $boqData->approval_manager_sales_date = date('Y-m-d H:i:s');
                }
            }
            if ($approval_manager_operation !== null) {
                $boqData->approval_manager_operation = $approval_manager_operation;
                if (empty($boqData->approval_manager_operation_date)) {
                    $boqData->approval_manager_operation_date = date('Y-m-d H:i:s');
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

            if ($boqData->approval_manager_sales === null || $boqData->approval_manager_operation === null || $boqData->approval_director === null || $boqData->approval_finman === null) {
                $boqData->is_done = null;
            } else {
                if ($boqData->approval_manager_operation == 1 && $boqData->approval_manager_sales == 1 && $boqData->approval_director == 1 && $boqData->approval_finman == 1) {
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

    function createRevisionBoq(Request $request): JsonResponse
    {
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
                'approval_manager_sales' => null,
                'approval_manager_sales_date' => null,
                'approval_manager_operation' => null,
                'approval_manager_operation_date' => null,
                'approval_director' => null,
                'approval_director_date' => null,
                'approval_finman' => null,
                'approval_finman_date' => null,
                'is_draft' => 0,
                'is_final' => 0,
                'remark' => null,
            ]);
            $newBoq->reference_boq_id = $rejectedBoq->id;
            $newBoq->save();

            $itemablePriceRequest = PriceRequestRepository::storeFromBoq($newBoq);

            $itemsData = $request->input('items');

            if (!empty($itemsData)) {
                foreach ($itemsData as $itemData) {
                    $newBoq->itemable()->create([
                        'quantity' => $itemData['quantity'],
                        'unit' => $itemData['unit'],
                        'purchase_price' => $itemData['purchase_price'] ?? 0,
                        'total_price' => (($itemData['purchase_price'] ?? 0) * $itemData['quantity']) + ($itemData['purchase_delivery'] ?? 0),
                        'purchase_delivery_charge' => $itemData['purchase_delivery'] ?? 0,
                        'purchase_reference' => $itemData['purchase_reference'] ?? null,
                        'delivery_route' => $itemData['delivery_route'] ?? null,
                        'delivery_type' => $itemData['delivery_type'] ?? null,
                        'purchase_from' => $itemData['purchase_from'] ?? null,
                        'payment_type' => $itemData['payment_type'] ?? null,
                        'purchase_validity' => $itemData['purchase_validity'] ?? null,
                        'inventory_good_id' => $itemData['item_inventory_id'],
                        'item_detail' => $itemData['item_detail'],
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'BOQ Baru Berhasil Dibuat.', 'data' => $newBoq], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    function updateDraftBoq(Request $request)
    {
        $boqId = $request->query('boq_id');
        $boqData = $this->model->where('id', $boqId)->first();

        $dataCompanyItem = $this->model->with([
            'itemable' => function ($query) {
                $query->whereHas('inventoryGood', function ($subQuery) {
                    $subQuery->where('good_category_id', '!=', 3);
                });
            },
            'customerProspect.customer.customerContact',
            'customerProspect.customer.bussinesType',
            'surveyRequest'
        ])->where("prospect_id", $boqData->prospect_id)->get(); 
         
        $dataForm = $this->inventoryService->getDataForm(); 

        $quotationItem = Item::where('itemable_id', $boqId)
            ->whereHas('inventoryGood', function ($query) {
                $query->where('good_category_id', 3);
            })->get();

        $inventoryGoodInet = InventoryGood::whereNotIn('good_category_id', [1, 2])->get();
        
        $dataSales = $this->user->where('department_id', 1)->get();
        $dataSalesSelected = $this->user->where('id', $boqData->sales_id)->first();
        $dataProcurement = $this->user->where('department_id', 2)->get();
        $dataProcurementSelected = $this->user->where('id', $boqData->procurement_id)->first();
        $dataTechnician = $this->user->where('department_id', 4)->get();
        $dataTechnicianSelected = $this->user->where('id', $boqData->technician_id)->first();

        return [
            'dataCompanyItem' => $dataCompanyItem,
            'dataBoq' => $boqData,
            'dataForm' => $dataForm,

            'inventoryGoodInet' => $inventoryGoodInet,
            'quotationItem' => $quotationItem,
   
            'dataSales' => $dataSales,
            'dataSalesSelected' => $dataSalesSelected,
            'dataProcurement' => $dataProcurement,
            'dataProcurementSelected' => $dataProcurementSelected,
            'dataTechnician' => $dataTechnician,
            'dataTechnicianSelected' => $dataTechnicianSelected,
        ];
    }

    function reviewBoq(Request $request)
    {
        $boqId = $request->query('boq_id');
        $boqData = $this->model->where('id', $boqId)->first();
  
        $dataCompanyItem = $this->model->with([
            'itemable' => function ($query) {
                $query->whereHas('inventoryGood', function ($subQuery) {
                    $subQuery->where('good_category_id', '!=', 3);
                });
            },
            'customerProspect.customer.customerContact',
            'customerProspect.customer.bussinesType',
            'surveyRequest'
        ])->where("prospect_id", $boqData->prospect_id)->get(); 
            
        
        $inventoryGoodInet = InventoryGood::whereNotIn('good_category_id', [1, 2])->get();

        $quotationItem = Item::where('itemable_id', $boqId)
            ->whereHas('inventoryGood', function ($query) {
                $query->where('good_category_id', 3);
            })->get();

        
        $dataSalesSelected = $this->user->where('id', $boqData->sales_id)->first();
        $dataProcurementSelected = $this->user->where('id', $boqData->procurement_id)->first();
        $dataTechnicianSelected = $this->user->where('id', $boqData->technician_id)->first();

        return [
            'inventoryGoodInet' => $inventoryGoodInet,
            'quotationItem' => $quotationItem,

            'dataCompanyItem' => $dataCompanyItem,
            
            'dataSalesSelected' => $dataSalesSelected,
            'dataProcurementSelected' => $dataProcurementSelected,
            'dataTechnicianSelected' => $dataTechnicianSelected,
        ];
    }
}
