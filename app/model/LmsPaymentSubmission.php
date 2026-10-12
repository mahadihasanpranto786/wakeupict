<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsPaymentSubmission extends Model
{
    protected $table = 'lms_payment_submissions';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float',
        'verified_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function verifier()
    {
        return $this->belongsTo(\App\User::class, 'verified_by');
    }

    public static function generateReceiptNumber()
    {
        $year = date('Y');
        $random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
        return "REC-{$year}-{$random}";
    }
}
