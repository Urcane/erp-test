<?php

namespace App\Repositories\Master\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Inventory\InventoryGood;
use App\Models\Customer\CustomerProspect;
use Illuminate\Support\Facades\Validator;
use App\Models\Opportunity\Survey\SurveyRequest;

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
        $dataFormInventory = $this->model;
        return $dataFormInventory;
     }

     function getMerkTypeByItemId(int $itemId)  {
        $itemData = InventoryGood::select('good_type', 'merk','description')->where('id', $itemId)->first();
        return $itemData;
     }

     function getSurveyCompanyByProspectId(int $prospect_id) {
        $surveyId = SurveyRequest::where('customer_prospect_id', $prospect_id)->pluck('id')->first();
        if (!$surveyId) {
            return null;
        }
        $survey = SurveyRequest::find($surveyId);
        $dataCompany = CustomerProspect::with(['customer.customerContact', 'customer.bussinesType'])->where('id', $prospect_id)->first();
        $combinedData = [
            'survey' => $survey,
            'dataCompany' => $dataCompany,
        ];
        return $combinedData;
     }

     function updateInternetBundling(Request $request) : JsonResponse {
      $validator = Validator::make($request->all(), [
        'good_category_id' => 'required|string',
        'good_name' => 'required|string',
         'code_name' => 'required|string',
         'merk' => 'required|string',
         'good_type' => 'required|string',
        //  'description' => 'required|string',
     ]);
 
     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 422); // Unprocessable Entity
     }
 
     $dataBundling = $this->model->create([
         'good_category_id' => 3,
         'good_name' => $request->input('good_name'),
         'code_name' => $request->input('code_name'),
         'merk' => $request->input('merk'),
         'good_type' => $request->input('good_type'),
         'description' => $request->input('description') ?? '-',
     ]);
 
     return response()->json(['message' => 'Quotation berhasil disimpan.', 'item' => $dataBundling], 200);

     }
}
