<?php

namespace App\Http\Requests\Opportunity\Survey\SurveyResult;

use Illuminate\Foundation\Http\FormRequest;

class SurveyResultCCTVRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'camera_type_id' => 'required|exists:camera_types,id',
            'quantity_service_use' => 'required|numeric',
            'record_duration' => 'required|numeric',
            'camera_storage' => 'required|max:255',
            'camera_resolution' => 'required|max:255',
            'special_request' => 'max:255'
        ];
    }
}
