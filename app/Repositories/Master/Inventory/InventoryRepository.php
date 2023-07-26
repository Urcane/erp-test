<?php

namespace App\Repositories\Master\Inventory;

use Yajra\DataTables\Utilities\Request;
use App\Models\Inventory\InventoryGood;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class InventoryRepository.
 */
class InventoryRepository
{
    /**
     * @return string
     *  Return the model
     */

     protected $model;

     function __construct(InventoryGood $model ) {
        $this->model = $model;
     }

     function getAllData() {
        $dataFormInventory = $this->model->with(['inventoryGoodCategory.inventoryGood']);
        return $dataFormInventory;
     }

   public function getMerkTypeByItemId(int $itemId)
    {
        // Fetch "jenis" (good_type) and "merek" (merk) data based on the item ID
        $itemData = InventoryGood::select('good_type', 'merk')->where('id', $itemId)->first();
        return $itemData;
    }
}
