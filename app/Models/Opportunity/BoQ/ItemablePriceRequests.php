<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ItemablePriceRequests extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemablePriceRequest() : MorphMany{
        return $this->morphMany(Items::class, 'itemable');
    }
}
