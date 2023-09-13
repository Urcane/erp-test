<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $guraded = [];


    public function parent() {
        return $this->belongsTo(Division::class, "parent_id");
    }

    public function children() {
        return $this->hasMany(Division::class, "parent_id");
    }

    public function users() {
        return $this->hasMany(User::class, "division_id");
    }
}
