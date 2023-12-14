<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryGoodCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventoryGood(): HasMany
    {
        return $this->hasMany(InventoryGood::class, 'good_category_id', 'id');
    }
}
