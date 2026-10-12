<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LmsFeeInstallment extends Model
{
    protected $table = 'lms_fee_installments';

    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'float',
        'paid_amount' => 'float',
    ];

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function dueAmount()
    {
        return max(0, $this->amount - $this->paid_amount);
    }

    public function isOverdue()
    {
        return $this->status !== 'paid' && $this->due_date && Carbon::today()->greaterThan($this->due_date);
    }
}
