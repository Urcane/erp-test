<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Customer\CustomerProspect;
use App\Models\Master\ServiceType;
use App\Models\ProjectManagement\WorkOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    function softSurveys() : HasMany {
        return $this->hasMany(SoftSurvey::class);
    }

    function siteSurveys() : HasMany {
        return $this->hasMany(SoftSurvey::class);
    }

    function workOrders() : HasMany {
        return $this->hasMany(WorkOrder::class);
    }

    function customerProspect() : BelongsTo {
        return $this->belongsTo(CustomerProspect::class);
    }

    function serviceTypes() : BelongsTo {
        return $this->belongsTo(ServiceType::class);
    }

    function typeOfSurveys() : BelongsTo {
        return $this->belongsTo(TypeOfSurvey::class);
    }

    function softSurveyedBy() : BelongsTo {
        return $this->belongsTo(User::class, 'soft_surveyed_by', 'id');
    }
}
