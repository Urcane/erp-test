<?php

namespace App\Models\Customer;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\CustomerProspectLog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;

class CustomerProspect extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function customerProspectLogs() : HasMany {
        return $this->hasMany(CustomerProspectLog::class);
    }

    function latestCustomerProspectLog() : HasOne {
        return $this->hasOne(CustomerProspectLog::class)->latest();
    }

    function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    function itemableBillOfQuantity() : HasOne {
        return $this->hasOne(ItemableBillOfQuantity::class,'prospect_id');
    }
}
