<?php

namespace App\Models\Opportunity\Survey;

use App\Models\User;
use App\Models\Master\ServiceType;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\CustomerProspect;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantities;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\ProjectManagement\WorkOrder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurveyRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    function softSurveys() : HasMany {
        return $this->hasMany(SoftSurvey::class);
    }

    function siteSurveyInternets() : HasMany {
        return $this->hasMany(SiteSurveyInternet::class);
    }

    function siteSurveyCCTVs() : HasMany {
        return $this->hasMany(SiteSurveyCCTV::class);
    }
    
    function siteSurveyGSMBoosters() : HasMany {
        return $this->hasMany(SiteSurveyGSMBooster::class);
    }

    function workOrders() : HasMany {
        return $this->hasMany(WorkOrder::class);
    }

    function customerProspect() : BelongsTo {
        return $this->belongsTo(CustomerProspect::class);
    }

    function serviceType() : BelongsTo {
        return $this->belongsTo(ServiceType::class);
    }

    function typeOfSurvey() : BelongsTo {
        return $this->belongsTo(TypeOfSurvey::class);
    }

    function softSurveyedBy() : BelongsTo {
        return $this->belongsTo(User::class, 'soft_surveyed_by', 'id');
    }

    function scopeUnProcess($query) {
        return $query->doesnthave('workOrders')->doesnthave('softSurveys');
    }

    function scopeOnProcess($query) {
        return $query->whereHas('workOrders', function($q) {
            $q->where('status', 'PR');
        });
    }

    function scopeDone($query) {
        return $query->has('softSurveys')->orWhereHas('workOrders', function($q) {
            $q->where('status', 'DN');
        });
    }
    
    function itemableBillOfQuantity() : HasOne {
        return $this->hasOne(ItemableBillOfQuantity::class);
    }
}