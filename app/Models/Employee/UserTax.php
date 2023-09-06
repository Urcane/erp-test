<?php

namespace App\Models\Employee;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTax extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_tax';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function taxStatus(): BelongsTo
    {
        return $this->belongsTo(TaxStatus::class);
    }
}
