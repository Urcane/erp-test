<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Master\File;
use App\Models\MasterData\CameraType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SiteSurveyCCTV extends Model
{
    use HasFactory;

    protected $guarded = [];

    function siteSurveys() : BelongsTo {
        return $this->belongsTo(SiteSurvey::class);
    }

    function cameraTypes() : BelongsTo {
        return $this->belongsTo(CameraType::class);
    }
}
