<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseGoodStockLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function warehouseGoodLog(): BelongsTo
    {
        return $this->belongsTo(WarehouseGoodLog::class);
    }

    public function inventoryUnitMaster(): BelongsTo
    {
        return $this->belongsTo(InventoryUnitMaster::class);
    }

    public function inventoryGoodStatus(): BelongsTo
    {
        return $this->belongsTo(InventoryGoodStatus::class);
    }

    public function inventoryGoodCondition(): BelongsTo
    {
        return $this->belongsTo(InventoryGoodCondition::class);
    }
}
