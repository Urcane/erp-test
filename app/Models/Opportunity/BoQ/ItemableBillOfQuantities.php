<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ItemableBillOfQuantities extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemableBillOfQuantities() : MorphMany{
        return $this->morphMany(Items::class, 'itemable');
    }

    function prospect() : BelongsTo {
        return $this->belongsTo(Prospect::class);
    }

    function sales() : BelongsTo {
        return $this->belongsTo(User::class, 'sales_id', 'id');
    }
}
