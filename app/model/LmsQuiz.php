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
        'negative_marks' => 'float',
        'shuffle_questions' => 'boolean',
        'shuffle_options' => 'boolean',
        'max_attempts' => 'integer',
        'is_published' => 'boolean',
        'allow_question_flagging' => 'boolean',
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

    /**
     * Convert digits to Bengali numerals
     */
    public static function toBengaliNumber($number)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
        $bng = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '.'];
        return str_replace($eng, $bng, (string)$number);
    }

    /**
     * Convert English Set (A/B/C/D) to Bengali (ক/খ/গ/ঘ)
     */
    public static function getBengaliSetCode($setCode)
    {
        $map = [
            'A' => 'ক', 'B' => 'খ', 'C' => 'গ', 'D' => 'ঘ',
            'SET A' => 'ক', 'SET B' => 'খ', 'SET C' => 'গ', 'SET D' => 'ঘ',
            'Set A' => 'ক', 'Set B' => 'খ', 'Set C' => 'গ', 'Set D' => 'ঘ',
            'set a' => 'ক', 'set b' => 'খ', 'set c' => 'গ', 'set d' => 'ঘ',
        ];
        return isset($map[$setCode]) ? $map[$setCode] : ($setCode ?: 'ক');
    }

    /**
     * Get distinct sets for this quiz
     */
    public function getAvailableSets()
    {
        $sets = LmsQuestion::where('quiz_id', $this->id)
            ->whereNotNull('set_code')
            ->where('set_code', '!=', '')
            ->distinct()
            ->pluck('set_code')
            ->toArray();

        return !empty($sets) ? $sets : ['Set A'];
    }
}
