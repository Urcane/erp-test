<?php

namespace App\Models;

use App\Traits\HasProject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function division(): HasOne
    {
        return $this->hasOne(Division::class);
    }

    public function team(): HasOne
    {
        return $this->hasOne(Team\Team::class, "id", "team_id");
    }

    public function userBank(): HasOne
    {
        return $this->hasOne(Employee\UserBank::class);
    }

    public function userBpjs(): HasOne
    {
        return $this->hasOne(Employee\UserBpjs::class);
    }

    public function userEmployment(): HasOne
    {
        return $this->hasOne(Employee\UserEmployment::class);
    }

    public function userIdentity(): HasOne
    {
        return $this->hasOne(Employee\UserIdentity::class);
    }

    public function userPersonalData(): HasOne
    {
        return $this->hasOne(Employee\UserPersonalData::class);
    }

    public function userSalary(): HasOne
    {
        return $this->hasOne(Employee\UserSalary::class);
    }

    public function userTax(): HasOne
    {
        return $this->hasOne(Employee\UserTax::class);
    }

    public function userFamily(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserFamily::class);
    }

    public function userEmegencyContact(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserEmergencyContact::class);
    }

    public function userAdditionalInformation(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserAdditionalInformation::class);
    }

    public function userFormalEducation(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserFormalEducation::class);
    }

    public function userNonFormalEducation(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserNonFormalEducation::class);
    }

    public function userWorkingExperience(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserWorkingExperience::class);
    }

    public function userAttendance(): HasMany
    {
        return $this->hasMany(Attendance\UserAttendance::class);
    }
}
