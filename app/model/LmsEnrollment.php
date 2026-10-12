<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsEnrollment extends Model
{
    protected $table = 'lms_enrollments';

    protected $guarded = [];

    protected $casts = [
        'completed_at' => 'datetime',
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

    /**
     * Compute real-time progress percentage
     */
    public function getProgressPercentageAttribute()
    {
        $totalLessons = LmsLesson::where('course_id', $this->course_id)
            ->where('status', 1)
            ->count();

        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = LmsLessonProgress::where('student_account_id', $this->student_account_id)
            ->where('course_id', $this->course_id)
            ->where('is_completed', true)
            ->count();

        return min(100, (int) round(($completedLessons / $totalLessons) * 100));
    }
}
