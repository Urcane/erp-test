<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Master\File;
use App\Models\Master\InternetServiceType;
use App\Models\Master\ServiceType;
use App\Models\Master\TransmissionMedia;
use App\Models\ProjectManagement\WorkOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SiteSurvey extends Model
{
    use HasFactory;

    protected $guarded = [];

    function files() : MorphMany {
        return $this->morphMany(File::class, 'fileable');
    }

    function siteSurveyCCTV() : HasOne {
        return $this->hasOne(SiteSurveyCCTV::class); 
    }

    function siteSurveyInternet() : HasOne {
        return $this->hasOne(SiteSurveyInternet::class);
    }

    function surveyRequest() : BelongsTo {
        return $this->belongsTo(SurveyRequest::class);
    }

    function workOrder() : BelongsTo {
        return $this->belongsTo(WorkOrder::class);
    }

    function transmissionMedia() : BelongsTo {
        return $this->belongsTo(TransmissionMedia::class, 'trans_media_id');
    }

    function internetServiceType() : BelongsTo {
        return $this->belongsTo(InternetServiceType::class);
    }

    function serviceType() : BelongsTo {
        return $this->belongsTo(ServiceType::class);
    }
}
