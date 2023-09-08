<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOvertimeRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvalLine(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approval_line');
    }
}
