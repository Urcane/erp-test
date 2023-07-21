<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerContact extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function itemablePriceRequest() : HasOne{
        return $this->hasOne(ItemablePriceRequests::class, 'customer_contact_id', 'id');
    }
}
