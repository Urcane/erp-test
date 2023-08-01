<?php

namespace App\Models\Employee;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTax extends Model
{
    use HasFactory;

    protected $table = 'user_tax';
    protected $guarded = [];

    function user() : BelongsTo {
        return $this->BelongsTo(User::class);
    }
}