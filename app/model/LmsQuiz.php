<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuiz extends Model
{
    protected $table = 'lms_quizzes';

    protected $guarded = [];

    protected $casts = [
        'duration_minutes' => 'integer',
        'total_marks' => 'float',
        'pass_marks' => 'float',
        'shuffle_questions' => 'boolean',
        'shuffle_options' => 'boolean',
        'max_attempts' => 'integer',
        'is_published' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function chapter()
    {
        return $this->belongsTo(LmsChapter::class, 'chapter_id');
    }

    public function questions()
    {
        return $this->hasMany(LmsQuestion::class, 'quiz_id')->orderBy('order_index', 'asc');
    }

    public function activeQuestions()
    {
        return $this->hasMany(LmsQuestion::class, 'quiz_id')->where('is_active', true)->orderBy('order_index', 'asc');
    }

    public function attempts()
    {
        return $this->hasMany(LmsQuizAttempt::class, 'quiz_id')->orderBy('created_at', 'desc');
    }

    /**
     * Check if student can take/retake this quiz
     */
    public function canAttempt($studentAccountId)
    {
        if (!$this->is_published) {
            return false;
        }

        if ($this->max_attempts == 0) {
            return true; // unlimited
        }

        $taken = LmsQuizAttempt::where('quiz_id', $this->id)
            ->where('student_account_id', $studentAccountId)
            ->whereIn('status', ['submitted', 'graded'])
            ->count();

        return $taken < $this->max_attempts;
    }

    /**
     * Get student's best completed attempt
     */
    public function bestAttempt($studentAccountId)
    {
        return LmsQuizAttempt::where('quiz_id', $this->id)
            ->where('student_account_id', $studentAccountId)
            ->whereIn('status', ['submitted', 'graded'])
            ->orderBy('score', 'desc')
            ->first();
    }
}
