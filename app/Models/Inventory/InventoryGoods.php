<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryGoods extends Model
{
    use HasFactory;
    protected $guarded = [];

    function inventoryGoodCategories() {
        return $this->hasMany(InventoryGoodCategories::class);
    }
}
