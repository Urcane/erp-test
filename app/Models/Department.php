<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'department_alias',
        'parent_id',
    ];

    public function parent() {
        return $this->belongsTo(Department::class, "parent_id");
    }

    public function divisions() {
        return $this->hasMany(Division::class, "parent_id");
    }

    public function children() {
        return $this->hasMany(Department::class, "parent_id");
    }

    public function users() {
        return $this->hasMany(User::class, "department_id");
    }
}
