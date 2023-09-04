<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Inventory\InventoryGood;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function itemable(): MorphTo {
        return $this->morphTo();
    }

    public function inventoryGood(): BelongsTo {
        return $this->belongsTo(InventoryGood::class, 'item_inventory_id', 'id');
    }

    // function itemable() : MorphTo {
    //     return $this->morphTo('itemable');
    // }

    // function inventoryGood() : BelongsTo{
    //     return $this->belongsTo(InventoryGood::class, 'item_inventory_id', 'id');
    // }

    function parentItem() : BelongsTo {
        return $this->belongsTo(this::class, 'itemable_id', 'id');
    }

    function childItem() : HasOne {
        return $this->hasOne(this::class, 'itemable_id', 'id');
    }
}
