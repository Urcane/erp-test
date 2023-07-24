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

    function getDataForm(Request $request) {
        $dataFormInventory = $this->InventoryRepository->getAllData($request);
        return $dataFormInventory;
    }
}
