<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveQuota extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "leave_quota";
}
