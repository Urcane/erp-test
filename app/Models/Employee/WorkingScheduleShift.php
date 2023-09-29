<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function nextSchedule(): BelongsTo
    {
        return $this->belongsTo(WorkingScheduleShift::class, 'next');
    }

    public function beforeSchedule(): HasOne
    {
        return $this->hasOne(WorkingScheduleShift::class, 'next');
    }

    public function userCurrentShifts(): HasMany
    {
        return $this->hasMany(UserCurrentShift::class);
    }

}
