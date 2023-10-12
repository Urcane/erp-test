<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\InventoryGoodCategory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryGood extends Model
{
    use HasFactory;
    protected $guarded = [];

    function inventoryGoodCategory() : BelongsTo
    {
        return $this->belongsTo(InventoryGoodCategory::class, 'good_category_id');
    }
}
