<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryGoodCategories extends Model
{
    use HasFactory;
    protected $guarded = [];

    function inventoryGoods(){
        return $this->hasMany(InventoryGoods::class, 'good_category_id', 'id');
    }
}
