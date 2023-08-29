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

    public function model(Item $model)
    {
        $this->model = $model;
    }

    function saveItems($request, $references) {

        $allItems = $request->input('items');
        
        if (!is_array($allItems) ) {
            return response()->json('Oopss, ada yang salah nih!', 500);
        }

        foreach ($allItems as $item) {
            $this->model->updateOrCreate([
                'item_inventory_id' => $item['item_inventory_id'],
                'item_detail' => $item['item_detail'],
                'quantity' => $item['quantity'],
                'purchase_price' => $item['purchase_price'],
                'purchase_delivery_charge' => $item['purchase_delivery_charge'],
                'purchase_reference' => $item['purchase_reference'],
                'process_status' => $item['process_status'],
                'is_monthly' => $item['is_monthly'],
                'vendor_charge' => $item['vendor_charge'],
            ]);
        }
    }
}
