<?php

namespace App\Http\Requests\ProjectManagement;

use Illuminate\Foundation\Http\FormRequest;

class WorkOrderApprovalRequest extends FormRequest
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
            'approved_status' => 'required|boolean',
            'work_order_id' => 'required',
            'work_order_id.*' => 'required|exists:work_orders,id' 
        ];
    }
}
