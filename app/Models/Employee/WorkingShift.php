<?php

namespace App\Models\Employee;

use App\Models\Attendance\UserShiftRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingShift extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function workingSchedules(): BelongsToMany
    {
        return $this->belongsToMany(WorkingSchedule::class, 'working_schedule_shifts');
    }

    public function workingScheduleShifts(): HasMany
    {
        return $this->hasMany(WorkingScheduleShift::class);
    }

    public function userShiftRequests(): HasMany
    {
        return $this->hasMany(UserShiftRequest::class);
    }
}
