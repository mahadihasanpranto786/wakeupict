<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuizAttempt extends Model
{
    protected $table = 'lms_quiz_attempts';

    protected $guarded = [];

    protected $casts = [
        'parent_attempt_id' => 'integer',
        'attempt_number' => 'integer',
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'score' => 'float',
        'total_marks' => 'float',
        'pass_marks' => 'float',
        'percentage' => 'float',
        'time_spent_seconds' => 'integer',
        'negative_marks_deducted' => 'float',
        'questions_snapshot' => 'array',
        'flagged_question_ids' => 'array',
        'security_violations_log' => 'array',
        'security_violations_count' => 'integer',
    ];

    public function quiz()
    {
        return $this->belongsTo(LmsQuiz::class, 'quiz_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function parentAttempt()
    {
        return $this->belongsTo(LmsQuizAttempt::class, 'parent_attempt_id');
    }

    public function retakes()
    {
        return $this->hasMany(LmsQuizAttempt::class, 'parent_attempt_id')->orderBy('id', 'asc');
    }

    public function answers()
    {
        return $this->hasMany(LmsQuizAnswer::class, 'attempt_id');
    }

    public function violations()
    {
        return $this->hasMany(LmsExamViolation::class, 'attempt_id');
    }

    public function getPassMarksAttribute($value = null)
    {
        // 1. If explicit pass_marks is stored on attempt, always prioritize it
        if ($value !== null && $value !== '') {
            return (float)$value;
        }

        if (isset($this->attributes['pass_marks']) && $this->attributes['pass_marks'] !== null && $this->attributes['pass_marks'] !== '') {
            return (float)$this->attributes['pass_marks'];
        }

        // 2. Tier-based lookup for practice exams from snapshot question count
        if (!empty($this->questions_snapshot) && is_array($this->questions_snapshot)) {
            $qCount = count($this->questions_snapshot);
            $settings = \App\Services\PracticeQuestionRotationService::getSettings();
            if (!empty($settings['tiers'])) {
                $matchedTier = collect($settings['tiers'])->firstWhere('questions', $qCount);
                if ($matchedTier && isset($matchedTier['pass_marks'])) {
                    return (float)\App\Services\PracticeQuestionRotationService::toEnglishDigits($matchedTier['pass_marks']);
                }
            }
        }

        // 3. Fallback to quiz pass marks
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
        return (float)$this->score >= (float)$this->pass_marks;
    }

    /**
     * Get letter grade based on marks and pass status
     * If student failed (score < pass_marks), grade is strictly 'F'
     */
    public function getGrade()
    {
        if (!$this->isPassed()) {
            return 'F';
        }

        $pct = (float)$this->percentage;
        if ($pct >= 80) {
            return 'A+';
        } elseif ($pct >= 70) {
            return 'A';
        } elseif ($pct >= 60) {
            return 'A-';
        } elseif ($pct >= 50) {
            return 'B';
        } elseif ($pct >= 40) {
            return 'C';
        } elseif ($pct >= 33) {
            return 'D';
        }

        return 'F';
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
