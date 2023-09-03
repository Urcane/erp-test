<?php

namespace App\Models\PersonalInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class UserFile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userFileCategory(): BelongsTo
    {
        return $this->belongsTo(UserFileCategory::class, "user_file_category_id");
    }
}
