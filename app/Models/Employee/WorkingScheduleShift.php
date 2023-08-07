<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkingScheduleShift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function workingSchedule(): BelongsTo
    {
        return $this->belongsTo(WorkingSchedule::class);
    }

    public function workingShift(): BelongsTo
    {
        return $this->belongsTo(WorkingShift::class);
    }

    public function userEmployments(): HasMany
    {
        return $this->hasMany(UserEmployment::class, 'working_schedule_shift_id');
    }
}
