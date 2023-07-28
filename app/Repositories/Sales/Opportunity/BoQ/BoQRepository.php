<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use App\Models\Opportunity\BoQ\Items;
use App\Models\Customer\CustomerProspect;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantities;
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

    function createBoQ($request) {
        $newBoq = $this->model->updateOrCreate([
             'prospect_id' => $request->prospect_id, // input blade di isi dengan id prospect ($dataCompany->id) yang hidden
            ],[
             'survey_request_id' => $request->survey_request_id,
             'sales_id' => $request->sales_id,
             'technician_id' => $request->technician_id,
             'procurement_id' => $request->procurement_id,
             'gpm' => $request->gpm,
             'modal' => $request->modal,
             'npm' => $request->npm,
             'percentage' => $request->percentage,
             'manpower' => $request->manpower,
             'is_draft' => $request->is_draft,
             'approval_manager' => $request->approval_manager,
             'approval_manager_date' => $request->approval_manager_date,
             'approval_director' => $request->approval_director,
             'approval_director_date' => $request->approval_director_date,
             'approval_finman' => $request->approval_finman,
             'approval_finman_date' => $request->approval_finman_date,
         ]);

         return $this->modelLog->updateOrCreate([
             'bill_of_quantities_id' => $newBoq->id,
             'bill_of_quantity_update' => $request->bill_of_quantity_update,
             'bill_of_quantity_next_action' => $request->bill_of_quantity_next_action,
             'next_action_plan_date' => $request->next_action_plan_date,
             'status' => $request->status,
         ]);
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
}
