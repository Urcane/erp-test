<?php

namespace App\Services\Master\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\Master\Inventory\InventoryRepository;

/**
 * Class InventoryService
 * @package App\Services
 */
class InventoryService
{
    protected $inventoryRepository;

    function __construct(inventoryRepository $inventoryRepository) {
        $this->inventoryRepository = $inventoryRepository;
    }

    function getDataForm()  {
        $dataFormInventory = $this->inventoryRepository->getAllData()->with(['inventoryGoodCategory.inventoryGood'])->where('good_category_id', '!=', 3)->get();
        return $dataFormInventory;
    }
    
    function getMerkType(Request $request) {
        $itemId = $request->input('item_id') ?? $request->item_id; 
        $itemData = $this->inventoryRepository->getMerkTypeByItemId($itemId);
        return response()->json($itemData);
    }

    function getInternetBundling() : JsonResponse  {
        $dataBundling = $this->inventoryRepository->getAllData()->where('good_category_id',3)->get();
        return response()->json($dataBundling);
    }

    function updateInternetBundling(Request $request) : JsonResponse {
        return $this->inventoryRepository->updateInternetBundling($request);
    }
}
