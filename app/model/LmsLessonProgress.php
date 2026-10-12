<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsLessonProgress extends Model
{
    protected $table = 'lms_lesson_progress';

    protected $guarded = [];

    protected $casts = [
        'is_completed' => 'boolean',
        'last_watched_seconds' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function lesson()
    {
        return $this->belongsTo(LmsLesson::class, 'lesson_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }
}
