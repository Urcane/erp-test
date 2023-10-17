<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryGoodCondition extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function warehouseGoods(): HasMany
    {
        return $this->hasMany(WarehouseGood::class);
    }
}
