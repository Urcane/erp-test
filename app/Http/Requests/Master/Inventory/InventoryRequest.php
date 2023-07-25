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
            'item_inventory_id' => 'required | exists:inventory_goods,id' ,
            'item_detail' => 'required | max:255',
            'quantity' => 'reqeuired | numeric',
            'purchase_price' => 'required | numeric',
            'purchase_delivery_charge' => 'required | numeric',
            'purchase_refrence' => 'required',
        ];
    }
}
