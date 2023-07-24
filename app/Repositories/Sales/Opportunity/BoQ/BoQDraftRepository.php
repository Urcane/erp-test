<?php

namespace App\Repositories\Sales\Opportunity\BoQ;

use App\Models\Opportunity\BoQ\ItemableBillOfQuantities;
use App\Models\Opportunity\BoQ\Items;
use Illuminate\Http\Request;


//use Your Model

/**
 * Class BoQDraftRepository.
 */
class BoQDraftRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function __construct(ItemableBillOfQuantities $model){
        $this->model = $model;
    }

    public function getAll(Request $request){
        $dataDraftBoq = $this->model->with(['itemableBillOfQuantities', 'sales', 'prospect.customer.customerContact' ,'prospect.customer.bussinesType', 'prospect.latestCustomerProspectLog']);

        return $dataDraftBoq;
    }

}
