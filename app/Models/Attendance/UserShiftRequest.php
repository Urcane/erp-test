<?php

namespace App\Models\Attendance;

use App\Models\Employee\WorkingShift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;

class UserShiftRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvalLine(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approval_line');
    }

    public function workingShift(): BelongsTo
    {
        return $this->belongsTo(WorkingShift::class);
    }
}
