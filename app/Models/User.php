<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'role_id',
        'full_name',
        'email',
        'country_code',
        'mobile',
        'password',
        'whatsapp_no',
        'profile_image',
        'dob',
        'employee_code',
        'current_latitude',
        'current_longitude',
        'zone',
        'otp',
        'otp_expires_at',
        'mobile_verified',
        'email_verified',
        'status',
        'created_by',
        'referral_code',
        'license_key',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    protected $casts = [
        'dob' => 'date',
        'otp_expires_at' => 'datetime',
        'mobile_verified' => 'boolean',
        'email_verified' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
