<?php

namespace App\Models\Opportunity\BoQ;

use App\Models\Inventory\InventoryGoods;
use App\Models\Opportunity\Quotation\ItemableQuotationParts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Items extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemable() : MorphTo{
        return $this->morphTo('itemable');
    }

    function itemInventory() : HasOne{
        return $this->hasOne(InventoryGoods::class, 'item_inventory_id', 'id');
    }

    function itemableId() : HasOne {
        return $this->hasOne(ItemableQuotationParts::class, 'itemable_id', 'id');
    }

    function parentItems() : BelongsTo{
        return $this->belongsTo(this::class, 'itemable_id', 'id');
    }

    function childItems() : HasOne{
        return $this->hasOne(this::class, 'itemable_id', 'id');
    }
}
