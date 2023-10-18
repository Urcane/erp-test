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

    public function warehouseGoodStock(): BelongsTo
    {
        return $this->belongsTo(WarehouseGoodStock::class);
    }
}
