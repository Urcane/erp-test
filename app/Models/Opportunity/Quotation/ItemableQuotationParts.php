<?php

namespace App\Models\Opportunity\Quotation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ItemableQuotationParts extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemableQuotation() : MorphMany{
        return $this->morphMany(Items::class, 'itemable');
    }

    function items() : HasOne{
        return $this->hasOne(Items::class);
    }

    function parentItemableQuotationParts() : BelongsTo{
        return $this->BelongsTo(this::class, 'referenced_quotation_id', 'id');
    }

    function childrenItemableQuotationParts() : BelongsTo{
        return $this->belongsTo(this::class, 'referenced_quotation_id', 'id');
    }
}
