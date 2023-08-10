<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemableBillOfQuantityLog extends Model
{
    use HasFactory;
    protected $table = 'itemable_bill_of_quantities_logs';
    protected $guarded = [];

    function itemableBillOfQuantity() : BelongsTo{
        return $this->belongsTo(ItemableBillOfQuantity::class, 'itemable_bill_of_quantity_id', 'id');
    } 
}
