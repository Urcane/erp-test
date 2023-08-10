<?php

namespace App\Models\Customer;

use App\Models\User;
use App\Models\BussinesType;
use App\Models\Team\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    function bussinesType() : BelongsTo {
        return $this->belongsTo(BussinesType::class, 'bussines_type_id', 'id');
    }
    
    function city() : BelongsTo {
        return $this->belongsTo(City::class);
    }
}
