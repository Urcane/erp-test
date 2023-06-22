<?php

namespace App\Models\Opportunity\Survey;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeOfSurvey extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function surveyRequests() : HasMany {
        return $this->hasMany(SurveyRequest::class);
    }
}
