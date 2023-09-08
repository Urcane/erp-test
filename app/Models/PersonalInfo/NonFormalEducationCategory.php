<?php

namespace App\Models\PersonalInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NonFormalEducationCategory extends Model
{
    use HasFactory;

    protected $table = 'non_formal_education_categories';
    protected $guarded = [];

    public function userNonFormalEducation(): HasMany
    {
        return $this->hasMany(UserNonFormalEducation::class);
    }
}
