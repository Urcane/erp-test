<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\BussinesType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function customerContact() : HasOne {
        return $this->hasOne(CustomerContact::class)->latest();
    }

    function userFollowUp() : BelongsTo {
        return $this->belongsTo(User::class, 'user_follow_up', 'id');
    }

    function bussinesType(): BelongsTo{
        return $this->belongsTo(BussinesType::class, 'bussines_type_id', 'id');
    }
}
