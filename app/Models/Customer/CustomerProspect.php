<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerProspectLog;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantities;

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

    function itemableBillOfQuantities() : HasOne {
        return $this->hasOne(ItemableBillOfQuantities::class);
    }
}
