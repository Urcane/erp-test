<?php

namespace App\Models;

use App\Traits\HasProject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function team(): HasOne
    {
        return $this->hasOne(Team\Team::class, "id", "team_id");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
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

    public function userFamilies(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserFamily::class);
    }

    public function userEmegencyContacts(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserEmergencyContact::class);
    }

    public function userAdditionalInformations(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserAdditionalInformation::class);
    }

    public function userFormalEducations(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserFormalEducation::class);
    }

    public function userNonFormalEducations(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserNonFormalEducation::class);
    }

    public function userWorkingExperiences(): HasMany
    {
        return $this->hasMany(PersonalInfo\UserWorkingExperience::class);
    }

    public function userAttendances(): HasMany
    {
        return $this->hasMany(Attendance\UserAttendance::class);
    }

    public function userAttendanceRequests(): HasMany
    {
        return $this->hasMany(Attendance\UserAttendanceRequest::class);
    }

    public function userLeaveQuotas(): HasMany
    {
        return $this->hasMany(Attendance\UserLeaveQuota::class);
    }

    public function userLeaveQuotaHistories(): HasMany
    {
        return $this->hasMany(Attendance\UserLeaveQuotaHistory::class);
    }

    public function userLeaveRequests(): HasMany
    {
        return $this->hasMany(Attendance\UserLeaveRequest::class);
    }

    public function userOvertimeRequests(): HasMany
    {
        return $this->hasMany(Attendance\UserOvertimeRequest::class);
    }

    public function userShiftRequests(): HasMany
    {
        return $this->hasMany(Attendance\UserShiftRequest::class);
    }

    public function leaveRequestCategory(): BelongsToMany
    {
        return $this->belongsToMany(Attendance\LeaveRequestCategory::class, 'user_leave_request_categories');
    }
}
