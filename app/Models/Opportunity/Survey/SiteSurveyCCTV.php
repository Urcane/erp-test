<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Master\CameraType;
use App\Models\Master\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SiteSurveyCCTV extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'site_survey_cctvs';

    function siteSurvey() : BelongsTo {
        return $this->belongsTo(SiteSurvey::class);
    }

    function cameraType() : BelongsTo {
        return $this->belongsTo(CameraType::class);
    }
}
