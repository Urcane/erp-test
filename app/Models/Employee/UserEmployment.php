<?php

namespace App\Models\Employee;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEmployment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_employment';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function subBranch(): BelongsTo
    {
        return $this->belongsTo(SubBranch::class);
    }

    public function workingScheduleShift(): BelongsTo
    {
        return $this->belongsTo(WorkingScheduleShift::class, 'working_schedule_shift_id');
    }

    public function approvalLine(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approval_line');
    }
}
