<?php

namespace App\Http\Requests\Opportunity\Survey;

use Illuminate\Foundation\Http\FormRequest;

class SoftSurveyRequest extends FormRequest
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
            'survey_request_id' => 'required',
            'survey_request_id.*' => 'required|exists:survey_requests,id',
            'content' => 'array',
            'content.*.description' => 'required',
            'content.*.file_soft_survey_internet' => 'required|image|mimes:jpeg,jpg,png,gif'
        ];
    }
}
