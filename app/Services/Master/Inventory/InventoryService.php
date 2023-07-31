<?php

namespace App\Services\Master\Inventory;

use Carbon\Carbon;
use Yajra\DataTables\Utilities\Request;
use App\Repositories\Master\Inventory\InventoryRepository;
use Illuminate\Http\JsonResponse;

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

    public function getSurveyCompany(int $prospect_id)
    {
        $surveyCompanyData = $this->InventoryRepository->getSurveyCompanyByProspectId($prospect_id);
        return $surveyCompanyData;
    }
}
