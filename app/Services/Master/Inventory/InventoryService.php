<?php

namespace App\Services\Master\Inventory;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    function getDataForm()  {
        $dataFormInventory = $this->InventoryRepository->getAllData()->get();
        return $dataFormInventory;
    }
    
    function getMerkType(Request $request) {
        $itemId = $request->input('item_id') ?? $request->item_id; 
        $itemData = $this->InventoryRepository->getMerkTypeByItemId($itemId);
        return response()->json($itemData);
    }
}
