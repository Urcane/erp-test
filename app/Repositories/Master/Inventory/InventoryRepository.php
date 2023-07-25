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
    
}
