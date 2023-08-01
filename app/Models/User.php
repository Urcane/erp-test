<?php

namespace App\Models;

use App\Traits\HasProject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasProject;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function userBank(): HasOne
    {
        return $this->hasOne(Employee\UserBank::class);
    }

    function userBpjs(): HasOne
    {
        return $this->hasOne(Employee\UserBpjs::class);
    }

    function userEmployment(): HasOne
    {
        return $this->hasOne(Employee\UserEmployment::class);
    }

    function userIdentity(): HasOne
    {
        return $this->hasOne(Employee\userIdentity::class);
    }

    function userPersonalData(): HasOne
    {
        return $this->hasOne(Employee\userPersonalData::class);
    }

    function userSalary(): HasOne
    {
        return $this->hasOne(Employee\userSalary::class);
    }

    function userTax(): HasOne
    {
        return $this->hasOne(Employee\userTax::class);
    }
}
