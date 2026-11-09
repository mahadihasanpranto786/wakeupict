<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class RegistrationVerification extends Model
{
    protected $table = 'registration_verifications';

    protected $guarded = [];

    protected $casts = [
        'is_otp_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'action_at' => 'datetime',
        'attempts_count' => 'integer',
    ];

    public function studentAccount()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }

    public function scopeAdminApproved($query)
    {
        return $query->where('status', 'admin_approved');
    }
}

