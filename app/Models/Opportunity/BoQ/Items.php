<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Items extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemable() : MorphTo{
        return $this->morphTo('itemable');
    }
}
