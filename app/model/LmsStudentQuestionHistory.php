<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsStudentQuestionHistory extends Model
{
    protected $table = 'lms_student_question_histories';

    protected $fillable = [
        'student_account_id',
        'question_id',
        'attempt_id',
        'category',
        'course_id',
        'rotation_cycle',
        'is_correct',
        'selected_option_ids',
        'times_attempted',
        'last_attempted_at',
    ];

    protected $casts = [
        'rotation_cycle' => 'integer',
        'is_correct' => 'boolean',
        'times_attempted' => 'integer',
        'last_attempted_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(\App\model\StudentAccount::class, 'student_account_id');
    }

    public function question()
    {
        return $this->belongsTo(\App\model\LmsQuestion::class, 'question_id');
    }

    public function attempt()
    {
        return $this->belongsTo(\App\model\LmsQuizAttempt::class, 'attempt_id');
    }

    public function course()
    {
        return $this->belongsTo(\App\model\Course::class, 'course_id');
    }
}

