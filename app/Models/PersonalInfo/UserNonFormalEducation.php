<?php

namespace App\Models\PersonalInfo;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNonFormalEducation extends Model
{
    use HasFactory;

    protected $table = 'user_non_formal_educations';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NonFormalEducationCategory::class);
    }
}
