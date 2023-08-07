<?php

namespace App\Models\Employee;

use App\Models\Attendance\UserShiftRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkingShift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function workingSchedules(): BelongsToMany
    {
        return $this->belongsToMany(WorkingSchedule::class, 'working_schedule_shifts');
    }

    public function userShiftRequests(): HasMany
    {
        return $this->hasMany(UserShiftRequest::class);
    }
}
