<?php

namespace App\Models\Opportunity\BoQ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemablePriceRequests extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemablePriceRequest() : MorphMany{
        return $this->morphMany(Items::class, 'itemable');
    }

    function workList() : BelongsTo{
        return $this->belongsTo(WorkList::class, 'work_list_id', 'id');
    }

    function customerContact(): BelongsTo{
        return $this->belongsTo(CustomerContact::class, 'customer_contact_id', 'id');
    }

    function customerCompany() :BelongsTo {
        return $this->belongsTo(CustomerCompany::class, 'customer_company_id', 'id');
    }

    function parentItemablePriceRequest() : BelongsTo{
        return $this->belongsTo(this::class, 'reference_price_request_id', 'id');
    }

    function childItemablePriceRequest() : HasOne{
        return $this->hasOne(this::class, 'reference_price_request_id', 'id');
    }
}
