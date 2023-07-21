<?php

namespace App\Models\Opportunity\Quotation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ItemableQuotationParts extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemableQuotation() : MorphMany{
        return $this->morphMany(Items::class, 'itemable');
    }
}
