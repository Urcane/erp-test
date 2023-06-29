<?php

namespace App\Http\Requests\ProjectManagement;

use Illuminate\Foundation\Http\FormRequest;

class WorkOrderRequest extends FormRequest
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
            "work_list_id" => 'exists:work_lists,id',
            "survey_request_id.*" => 'exists:survey_requests,id',
            "no_wo" => 'required|max:50',
            "task_description" => 'required|max:255',
            "start_date" => 'required|date',
            "planning_due_date" => 'required|date',
            "type_of_wo" => 'required|exists:work_order_categories,code',
        ];
    }
}
