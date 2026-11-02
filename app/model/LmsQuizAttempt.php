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

    public function getPassMarksAttribute()
    {
        $quiz = $this->quiz;
        if (!$quiz) {
            return 0.0;
        }
        if ($this->total_marks > 0 && $quiz->total_marks > 0 && $quiz->pass_marks > 0) {
            return round($this->total_marks * ($quiz->pass_marks / $quiz->total_marks), 2);
        }
        return (float)($quiz->pass_marks ?: 0.0);
    }

    public function isPassed()
    {
        return $this->score >= $this->pass_marks;
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

    public function getTotalQuestionsAttribute()
    {
        if (isset($this->attributes['total_questions']) && $this->attributes['total_questions'] !== null) {
            return (int)$this->attributes['total_questions'];
        }
        if (!empty($this->questions_snapshot) && is_array($this->questions_snapshot)) {
            return count($this->questions_snapshot);
        }
        return $this->quiz ? (int)$this->quiz->total_questions : 0;
    }
}
