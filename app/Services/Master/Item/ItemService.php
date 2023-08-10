<?php

namespace App\Services\Master\Item;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\Master\Inventory\InventoryRequest as SaveItemsRequest;
use App\Repositories\Master\Item\ItemRepository;
use Illuminate\Http\Request;

/**
 * Class ItemService
 * @package App\Services
 */


class ItemService
{
    protected $ItemRepository;

    function __construct(ItemRepository $ItemRepository) {
        $this->ItemRepository = $ItemRepository;
    }

    function saveItems(Request $request, $references) : JsonResponse{ //$itemableBillOfQuantitiesId ATAU itemableBillOfQuantities
        $saveItemsBoQ = $this->ItemRepository->saveItems($request, $references);
        return new JsonResponse(['message' => 'Data berhasil disimpan'], 200);
    }
}
