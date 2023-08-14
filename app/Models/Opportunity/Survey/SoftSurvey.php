<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Master\File;
use App\Models\ProjectManagement\WorkOrder;
use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SoftSurvey extends Model
{
    use HasFactory, HasFile;

    protected $guarded = [];

    function surveyRequests() : BelongsTo {
        return $this->belongsTo(SurveyRequest::class);
    }
}
