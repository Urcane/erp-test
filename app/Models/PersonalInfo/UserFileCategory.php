<?php

namespace App\Models\PersonalInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserFileCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userFiles(): HasMany
    {
        return $this->hasMany(UserFile::class);
    }
}
