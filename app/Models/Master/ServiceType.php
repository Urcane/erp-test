<?php

namespace App\Models\Master;

use App\Models\Opportunity\Survey\SurveyRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function surveyRequests() : HasMany {
        return $this->hasMany(SurveyRequest::class);
    }
}
