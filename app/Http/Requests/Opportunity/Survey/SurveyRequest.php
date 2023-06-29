<?php

namespace App\Http\Requests\Opportunity\Survey;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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
            'prospect_id.*' => 'required|exists:customer_prospects,id',
            'no_survey' => 'required|max:50',
            'service_type_id' => 'required|exists:service_types,id',
            'type_of_survey_id' => 'required|exists:type_of_surveys,id',
            'survey_date' => 'required|date',
            'survey_time' => 'required|date_format:H:i',
        ];
    }
}
