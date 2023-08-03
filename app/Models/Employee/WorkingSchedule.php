<?php

namespace App\Models\Employee;

use App\Models\Attendance\UserAttendance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkingSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userEmployment(): HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function userAttendance(): HasMany
    {
        return $this->hasMany(UserAttendance::class);
    }
}
