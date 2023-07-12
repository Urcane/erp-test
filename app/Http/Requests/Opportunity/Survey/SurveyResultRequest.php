<?php

namespace App\Http\Requests\Opportunity\Survey;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SurveyResultRequest extends FormRequest
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
        $base_rules = [
            'survey_request_id' => 'required|exists:survey_requests,id',
            'work_order_id' => 'required|exists:work_orders,id',
            'trans_media_id' => 'required|exists:transmission_medias,id',
            'internet_service_type_id' => 'exists:internet_service_types,id',
            'existing_connection' => 'max:255',
            'transportation_access' => 'required|max:255',
            'building_type' => 'required|max:255',
            'building_height' => 'required|numeric',
            'building_floor_count' => 'numeric',
            'building_rooftop_state' => 'boolean',
            'building_electricity_state' => 'boolean',
            'building_electricity_time' => 'max:24',
            'building_electricity_type' => Rule::in(['PLN', 'GENSET', 'SOLARCELL'])
        ];

        return $base_rules;
    }
}
