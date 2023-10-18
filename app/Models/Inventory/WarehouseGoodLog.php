<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseGoodLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function warehousLog(): BelongsTo
    {
        return $this->belongsTo(WarehouseLog::class);
    }

    public function inventoryGood(): BelongsTo
    {
        return $this->belongsTo(InventoryGood::class);
    }

    public function inventoryUnitMaster(): BelongsTo
    {
        return $this->belongsTo(InventoryUnitMaster::class);
    }
}
