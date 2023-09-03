<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmploymentStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userEmployments(): HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }
}
