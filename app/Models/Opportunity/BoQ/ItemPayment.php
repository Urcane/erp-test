<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    function item() : BelongsTo {
        return $this->belongsTo(Item::class);
    }
}
