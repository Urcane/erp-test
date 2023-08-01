<?php

namespace App\Models\Employee;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPersonalData extends Model
{
    use HasFactory;

    protected $table = 'user_personal_data';
    protected $guarded = [];

    function user() : BelongsTo {
        return $this->BelongsTo(User::class);
    }
}
