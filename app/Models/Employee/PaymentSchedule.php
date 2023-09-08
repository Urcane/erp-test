<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function userSalaries(): HasMany
    {
        return $this->hasMany(UserSalary::class);
    }
}
