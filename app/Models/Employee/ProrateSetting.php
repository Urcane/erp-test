<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProrateSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userSalary(): HasMany
    {
        return $this->hasMany(UserSalary::class);
    }
}
