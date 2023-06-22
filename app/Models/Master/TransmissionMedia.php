<?php

namespace App\Models\Master;

use App\Models\Opportunity\Survey\SiteSurvey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransmissionMedia extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function siteSurveys() : HasMany {
        return $this->hasMany(SiteSurvey::class);
    }
}
