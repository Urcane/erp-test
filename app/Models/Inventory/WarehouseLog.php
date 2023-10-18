<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function warehouseGood(): BelongsTo
    {
        return $this->belongsTo(WarehouseGood::class);
    }

    public function warehouseGoodLog(): HasMany
    {
        return $this->hasMany(WarehouseGoodLog::class);
    }
}
