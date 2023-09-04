<?php

namespace App\Models\Opportunity\Quotation;

use App\Traits\HasFile;
use App\Models\Opportunity\BoQ\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemableQuotationPart extends Model
{
    use HasFactory, HasFile;
    protected $guarded = [];

    function itemableQuotation() : MorphMany{
        return $this->morphMany(Item::class, 'itemable');
    }

    function ItemableBillOfQuantity() : hasOne {
        return $this->hasOne(ItemableBillOfQuantity::class,  'id', 'boq_id');
    }

    function parentItemableQuotationPart() : BelongsTo{
        return $this->BelongsTo(this::class, 'referenced_quotation_id', 'id');
    }

    function childrenItemableQuotationPart() : HasOne{
        return $this->hasOne(this::class, 'referenced_quotation_id', 'id');
    }
}
