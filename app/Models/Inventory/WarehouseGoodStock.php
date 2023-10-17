<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseGoodStock extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function warehouseGood(): BelongsTo
    {
        return $this->belongsTo(WarehouseGood::class);
    }

    public function warehouseGoodStatus(): BelongsTo
    {
        return $this->belongsTo(WarehouseGoodStatus::class);
    }

    public function warehouseGoodCondition(): BelongsTo
    {
        return $this->belongsTo(WarehouseGoodCondition::class);
    }
}
