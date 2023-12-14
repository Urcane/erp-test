<?php

namespace App\Models\Opportunity\Survey\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSurveyServiceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
}
