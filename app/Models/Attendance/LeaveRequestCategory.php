<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class LeaveRequestCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userLeaveRequests(): HasMany
    {
        return $this->hasMany(UserLeaveRequest::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_leave_request_categories');
    }

}
