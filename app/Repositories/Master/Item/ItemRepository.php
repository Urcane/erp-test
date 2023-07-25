<?php

namespace App\Repositories\Master\Item;

use App\Models\Opportunity\BoQ\Items;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ItemRepository.
 */
class ItemRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function model(Items $model)
    {
        $this->model = $model;
    }

    function saveItems($request) {
        return $this->model->updateOrCreate([
           //  'itemable_id' => $request->,
           //  'itemable_type' => $request->,
            'item_inventory_id' => $request->item_inventory_id,
            'item_detail' => $request->item_detail,
            'quantity' => $request->quantity,
            'purchase_price' => $request->purchase_price,
            'purchase_delivery_charge' => $request->purchase_delivery_charge,
            'purchase_refrence' => $request->purchase_refrence,
            'process_status' => $request->process_status,
            'is_monthly' => $request->is_monthly,
            'vendor_charge' => $request->vendor_charge,
        ]);
    }
}
