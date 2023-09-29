<?php

namespace App\Repositories\Sales\Opportunity\PriceRequest;

use App\Models\Opportunity\BoQ\ItemablePriceRequest;
use Carbon\Carbon;

//use Your Model

/**
 * Class BoQDraftRepository.
 */
class PriceRequestRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    function __construct(ItemablePriceRequest $model){
        $this->model = $model;
    }

    function store() : ItemablePriceRequest {
        return ItemablePriceRequest::get();
    }

    public static function storeFromBoq($itemableBoq) {
        $itemableBoq = $itemableBoq->load(['prospect.customer.customerContact']);

        if ($itemableBoq->is_draft == 1) {
            return;
        }

        return ItemablePriceRequest::create([
            'itemable_bill_of_quantity_id' => $itemableBoq->id,
            'customer_contact_id' =>  $itemableBoq->prospect->customer->customerContact->id,
            'customer_company_id' => $itemableBoq->prospect->customer_id,
            'no_ph' => '123',
            'release_date' => Carbon::now(),
        ]);
    }
}
