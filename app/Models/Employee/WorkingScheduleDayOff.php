<?php

namespace App\Models\Employee;

use App\Models\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkingScheduleDayOff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function workingSchedule(): BelongsTo
    {
        return $this->belongsTo(WorkingSchedule::class);
    }
}
