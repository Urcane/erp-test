<?php

namespace App\Traits;

use App\Models\Opportunity\Survey\SiteSurveyIndoorArea;
use App\Models\Opportunity\Survey\SiteSurveyOtherArea;
use App\Models\Opportunity\Survey\SiteSurveyOutdoorArea;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAdditionalSurveyForm
{
    function siteSurveyOutdoorArea() : BelongsTo {
        return $this->belongsTo(SiteSurveyOutdoorArea::class);
    }

    function siteSurveyIndoorArea() : BelongsTo {
        return $this->belongsTo(SiteSurveyIndoorArea::class);
    }

    function siteSurveyOtherArea() : BelongsTo {
        return $this->belongsTo(SiteSurveyOtherArea::class);
    }
}
