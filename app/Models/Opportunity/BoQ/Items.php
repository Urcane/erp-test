<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Opportunity\Quotation\ItemableQuotationParts;
use App\Models\Inventory\InventoryGood;

class Items extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemable() : MorphTo{
        return $this->morphTo('itemable');
    }

    function inventoryGood() : BelongsTo{
        return $this->belongsTo(InventoryGood::class, 'item_inventory_id', 'id');
    }

    function itemableId() : BelongsTo {
        return $this->belongsTo(ItemableQuotationParts::class, 'itemable_id', 'id');
    }

    function parentItems() : BelongsTo{
        return $this->belongsTo(this::class, 'itemable_id', 'id');
    }

    function childItems() : HasOne{
        return $this->hasOne(this::class, 'itemable_id', 'id');
    }
}
