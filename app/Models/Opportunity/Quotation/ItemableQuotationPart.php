<?php

namespace App\Models\Opportunity\Quotation;

use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ItemableQuotationPart extends Model
{
    use HasFactory, HasFile;
    protected $guarded = [];

    function itemableQuotation() : MorphMany{
        return $this->morphMany(Item::class, 'itemable');
    }

    function parentItemableQuotationPart() : BelongsTo{
        return $this->BelongsTo(this::class, 'referenced_quotation_id', 'id');
    }

    function childrenItemableQuotationPart() : HasOne{
        return $this->hasOne(this::class, 'referenced_quotation_id', 'id');
    }
}
