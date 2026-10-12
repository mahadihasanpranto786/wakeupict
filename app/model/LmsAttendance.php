<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsAttendance extends Model
{
    protected $table = 'lms_attendances';

    protected $guarded = [];

    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function schedule()
    {
        return $this->belongsTo(LmsClassSchedule::class, 'schedule_id');
    }

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
}
