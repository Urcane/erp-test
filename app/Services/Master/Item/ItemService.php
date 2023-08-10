<?php

namespace App\Services\Master\Item;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\Master\Inventory\InventoryRequest as SaveItemsRequest;
use App\Repositories\Master\Item\ItemRepository;

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

    // function saveItemsBoQ(SaveItemsRequest $request) : JsonResponse{
    //     $saveItemsBoQ = $this->ItemRepository->saveItems($request);
    //     return $saveItemsBoQ;
    // }
}
