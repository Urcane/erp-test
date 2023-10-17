<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseGood extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function inventoryGood(): BelongsTo
    {
        return $this->belongsTo(InventoryGood::class);
    }

    public function inventoryUnitMaster(): BelongsTo
    {
        return $this->belongsTo(InventoryUnitMaster::class);
    }

    public function warehouseGoodStocks(): HasMany
    {
        return $this->hasMany(WarehouseGoodStock::class);
    }
}
