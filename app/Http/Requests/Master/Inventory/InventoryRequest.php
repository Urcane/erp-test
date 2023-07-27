<?php

namespace App\Http\Requests\Master\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             //  'itemable_id' => $data->,
            //  'itemable_type' => $data->,
            'item_inventory_id' => 'exists:inventory_goods,id' ,
            'item_detail' => 'max:255',
            'quantity' => 'numeric',
            'purchase_price' => 'numeric',
            'purchase_delivery_charge' => 'numeric',
        ];
    }
}
