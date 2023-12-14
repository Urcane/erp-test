<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryUnitMaster extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function warehouseGoods(): HasMany
    {
        return $this->hasMany(WarehouseGood::class);
    }
}
