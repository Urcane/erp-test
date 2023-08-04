<?php

namespace App\Models\PersonalInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NonFormalEducationCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userNonFormalEducation(): HasMany
    {
        return $this->hasMany(UserNonFormalEducation::class);
    }
}
