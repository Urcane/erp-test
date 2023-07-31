<?php

namespace App\Repositories\Master\Inventory;

use Yajra\DataTables\Utilities\Request;
use App\Models\Inventory\InventoryGood;
use App\Models\Inventory\Survey;
use App\Models\Customer\CustomerProspect;
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
        $itemData = InventoryGood::select('good_type', 'merk','description')->where('id', $itemId)->first();
        return $itemData;
    }

    public function getSurveyCompanyByProspectId(int $prospect_id)
    {
        // Gunakan method find() untuk mencari data berdasarkan survey_id
        $survey = Survey::find($surveyId);

        // Jika data dengan survey_id tersebut tidak ditemukan
        if (!$survey) {
            // Berikan nilai null atau lakukan sesuai kebutuhan Anda
            $survey = null;
        }

        $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $id)->first();

        // Gabungkan data dari dua database ke dalam satu array
        $combinedData = [
            'survey' => $survey,
            'dataCompany' => $dataCompany,
        ];

        return $combinedData;
    }
}
