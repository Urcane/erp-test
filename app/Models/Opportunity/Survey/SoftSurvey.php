<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Master\File;
use App\Models\ProjectManagement\WorkOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SoftSurvey extends Model
{
    use HasFactory;

    protected $guarded = [];

    function files() : MorphMany {
        return $this->morphMany(File::class, 'fileable');
    }

    function surveyRequests() : BelongsTo {
        return $this->belongsTo(SurveyRequest::class);
    }

    function workOrders() : BelongsTo {
        return $this->belongsTo(WorkOrder::class);
    }
}
