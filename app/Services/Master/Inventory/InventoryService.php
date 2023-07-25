<?php

namespace App\Services\Master\Inventory;

use Yajra\DataTables\Utilities\Request;
use App\Repositories\Master\Inventory\InventoryRepository;

/**
 * Class InventoryService
 * @package App\Services
 */
class InventoryService
{
    protected $InventoryRepository;

    function __construct(InventoryRepository $InventoryRepository) {
        $this->InventoryRepository = $InventoryRepository;
    }

    function getDataForm() {
        $dataFormInventory = $this->InventoryRepository->getAllData()->get();
        return $dataFormInventory;
    }
    
    public function getMerkType(int $itemId)
    {
        $itemData = $this->InventoryRepository->getMerkTypeByItemId($itemId);
        return $itemData;
    }
}
