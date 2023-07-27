<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use App\Models\Opportunity\BoQ\Items;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantities;


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

    function __construct(ItemableBillOfQuantities $model){
        $this->model = $model;
    }

    function getAll(Request $request){
        $dataBoq = $this->model->with(['itemableBillOfQuantities', 'sales', 'prospect.customer.customerContact' ,'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog', ]);
        return $dataBoq;
    }

    function createBoQ($request) {
        return $this->model->updateOrCreate([
             'prospect_id' => $request->prospect_id, // input blade di isi dengan id prospect ($dataCompany->id) yang di hidden
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
    }
}
