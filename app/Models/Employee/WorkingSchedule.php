<?php

namespace App\Models\Employee;

use App\Models\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function workingShifts(): BelongsToMany
    {
        return $this->belongsToMany(WorkingShift::class, 'working_schedule_shifts');
    }

    public function workingScheduleShifts(): HasMany
    {
        return $this->hasMany(WorkingScheduleShift::class);
    }

    public function dayOffs(): HasMany
    {
        return $this->hasMany(WorkingScheduleDayOff::class);
    }
}
