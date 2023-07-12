<?php

namespace App\Http\Requests\Opportunity\Survey\SurveyResult;

use Illuminate\Foundation\Http\FormRequest;

class SurveyResultInternetRequest extends FormRequest
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
            'quantity_service_use' => 'required|numeric',
            'user_needs' => 'required',
            'bandwith_needs' => 'required|numeric',
            'special_request' => 'max:255',
        ];
    }
}
