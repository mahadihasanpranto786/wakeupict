<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuizAttempt extends Model
{
    protected $table = 'lms_quiz_attempts';

    protected $guarded = [];

    protected $casts = [
        'attempt_number' => 'integer',
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'score' => 'float',
        'total_marks' => 'float',
        'percentage' => 'float',
        'time_spent_seconds' => 'integer',
        'negative_marks_deducted' => 'float',
        'questions_snapshot' => 'array',
        'flagged_question_ids' => 'array',
    ];

    public function quiz()
    {
        return $this->belongsTo(LmsQuiz::class, 'quiz_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function answers()
    {
        return $this->hasMany(LmsQuizAnswer::class, 'attempt_id');
    }

    public function isPassed()
    {
        $quiz = $this->quiz;
        if (!$quiz) {
            return false;
        }
        return $this->score >= $quiz->pass_marks;
    }

    public function getFormattedTimeSpentAttribute()
    {
        $seconds = $this->time_spent_seconds ?: 0;
        $mins = floor($seconds / 60);
        $secs = $seconds % 60;
        return sprintf('%02d:%02d', $mins, $secs);
    }

    public function getFlaggedIdsArrayAttribute()
    {
        if (is_array($this->flagged_question_ids)) {
            return $this->flagged_question_ids;
        }
        if (empty($this->flagged_question_ids)) {
            return [];
        }
        $decoded = json_decode($this->flagged_question_ids, true);
        return is_array($decoded) ? $decoded : [];
    }

    public function isQuestionFlagged($questionId)
    {
        return in_array($questionId, $this->flagged_ids_array);
    }
}
