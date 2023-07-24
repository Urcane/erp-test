<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BussinesType extends Model
{
    use HasFactory;
    protected $guarded = [];

    function customer() : HasOne {
        return $this->hasOne(Customer::class, 'id', 'bussines_type_id');
    }
}
