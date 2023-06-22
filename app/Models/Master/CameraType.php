<?php

namespace App\Models\MasterData;

use App\Models\Opportunity\Survey\SiteSurveyCCTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CameraType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function siteSurveyCCTVs() : HasMany {
        return $this->hasMany(SiteSurveyCCTV::class);
    }
}
