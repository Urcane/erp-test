<?php

namespace App\Repositories\Master\Inventory;

use App\Models\Inventory\Survey;
use App\Models\Inventory\InventoryGood;
use Yajra\DataTables\Utilities\Request;
use App\Models\Customer\CustomerProspect;
use App\Models\Opportunity\Survey\SurveyRequest;
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

     function getMerkTypeByItemId(int $itemId) {
        $itemData = InventoryGood::select('good_type', 'merk','description')->where('id', $itemId)->first();
        return $itemData;
     }

     function getSurveyCompanyByProspectId(int $prospect_id) {
        // Get the primary key (id) in SurveyRequest based on the foreign key prospect_id
        $surveyId = SurveyRequest::where('customer_prospect_id', $prospect_id)->pluck('id')->first();

        // If no matching SurveyRequest found, return null or handle it as needed
        if (!$surveyId) {
            return null;
        }

        // Get the SurveyRequest record based on the primary key
        $survey = SurveyRequest::find($surveyId);

        $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospect_id)->first();

        // Gabungkan data dari dua database ke dalam satu array
        $combinedData = [
            'survey' => $survey,
            'dataCompany' => $dataCompany,
        ];

        return $combinedData;
     }
}
