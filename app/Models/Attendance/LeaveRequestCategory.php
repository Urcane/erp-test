<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveRequestCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userLeaveRequests(): HasMany
    {
        return $this->hasMany(UserLeaveRequest::class);
    }
}
