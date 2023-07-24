<?php

namespace App\Repositories\Master\Inventory;

use Yajra\DataTables\Utilities\Request;
use App\Models\Inventory\InventoryGoods;
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

     function __construct(InventoryGoods $model ) {
        $this->model = $model;
     }

     function getAllData(Request $request) {
        $dataFormInventory = $this->model->with(['inventoryGoodCategories.inventoryGoods']);
        return $dataFormInventory;
     }
}
