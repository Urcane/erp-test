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

    function saveItems($request, $references) {
        // 'itemable_id' => $request->itemable_bill_of_quantities_id, // prospect_id di ambil dari input blade yg di hidden, sehingga data tetap terpassing namun tidak mengubah tampilan
        // 'itemable_type' => $request->itemable_type, //itemable_type di ambil dari input blade itemable_bill_of_quantities yg di hidden, sehingga data tetap terpassing namun tidak mengubah tampilan
        return $references->updateOrCreate([
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
