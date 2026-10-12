<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsCertificate extends Model
{
    protected $table = 'lms_certificates';

    protected $guarded = [];

    protected $casts = [
        'issue_date' => 'date',
        'score_percentage' => 'float',
    ];

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public static function generateCertificateCode()
    {
        $year = date('Y');
        do {
            $num = str_pad(mt_rand(1000, 99999), 5, '0', STR_PAD_LEFT);
            $code = "CERT-WUICT-{$year}-{$num}";
        } while (static::where('certificate_code', $code)->exists());

        return $code;
    }

    public static function generateVerificationHash()
    {
        return hash('sha256', uniqid(mt_rand(), true));
    }

    public function getVerificationUrlAttribute()
    {
        return url('/verify/certificate/' . $this->verification_hash);
    }
}
