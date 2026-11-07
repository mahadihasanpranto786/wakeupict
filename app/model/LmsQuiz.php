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

    /**
     * Set the start_time attribute safely supporting HTML5 datetime-local formats
     */
    public function setStartTimeAttribute($value)
    {
        if (empty($value) || (is_string($value) && trim($value) === '')) {
            $this->attributes['start_time'] = null;
            return;
        }

        try {
            $this->attributes['start_time'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Set the end_time attribute safely supporting HTML5 datetime-local formats
     */
    public function setEndTimeAttribute($value)
    {
        if (empty($value) || (is_string($value) && trim($value) === '')) {
            $this->attributes['end_time'] = null;
            return;
        }

        try {
            $this->attributes['end_time'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            $this->attributes['end_time'] = null;
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function chapter()
    {
        return $this->belongsTo(LmsChapter::class, 'chapter_id');
    }

    public function paper()
    {
        return $this->belongsTo(LmsQuestionPaper::class, 'paper_id');
    }

    public function questions()
    {
        return $this->hasMany(LmsQuestion::class, 'quiz_id')->orderBy('order_index', 'asc');
    }

    public function activeQuestions()
    {
        return $this->hasMany(LmsQuestion::class, 'quiz_id')->where('is_active', true)->orderBy('order_index', 'asc');
    }

    /**
     * Get all questions for this quiz, whether directly attached or through a Question Paper
     */
    public function getExamQuestions()
    {
        if ($this->paper_id && $this->paper && $this->paper->items()->exists()) {
            $paperItems = $this->paper->items()
                ->with(['masterQuestion.options', 'section'])
                ->orderBy('order_index', 'asc')
                ->get();

            return $paperItems->map(function ($item) {
                $q = $item->masterQuestion;
                if ($q) {
                    $q = clone $q;
                    $q->paper_item_id = $item->id;
                    $q->section_id = $item->section_id;
                    $q->section_title = $item->section ? $item->section->title : null;
                    $q->section_instructions = $item->section ? $item->section->instructions : null;
                    $q->section_code = $item->section ? $item->section->section_code : null;
                    $q->custom_question_number = $item->custom_question_number;
                    if ($item->marks) {
                        $q->marks = (float)$item->marks;
                    }
                    if ($item->negative_marks !== null) {
                        $q->negative_marks = (float)$item->negative_marks;
                    }
                }
                return $q;
            })->filter()->values();
        }

        return $this->activeQuestions()->with('options')->get();
    }

    public function attempts()
    {
        return $this->hasMany(LmsQuizAttempt::class, 'quiz_id')->orderBy('created_at', 'desc');
    }

    /**
     * Check if quiz is a formal live exam
     */
    public function isLiveExam()
    {
        return $this->quiz_type === 'exam';
    }

    /**
     * Check if quiz has a scheduled start time
     */
    public function isScheduled()
    {
        return !empty($this->start_time);
    }

    /**
     * Check if exam is scheduled for future
     */
    public function isUpcoming()
    {
        return $this->start_time && \Carbon\Carbon::now()->lt($this->start_time);
    }

    /**
     * Check if exam has expired (passed end_time)
     */
    public function isExpired()
    {
        return $this->end_time && \Carbon\Carbon::now()->gt($this->end_time);
    }

    /**
     * Check if exam is active and can be taken right now
     */
    public function isLiveNow()
    {
        if (!$this->is_published) {
            return false;
        }

        $now = \Carbon\Carbon::now();
        if ($this->start_time && $now->lt($this->start_time)) {
            return false;
        }
        if ($this->end_time && $now->gt($this->end_time)) {
            return false;
        }

        return true;
    }

    /**
     * Remaining seconds until exam starts
     */
    public function getRemainingSeconds()
    {
        if (!$this->start_time) {
            return 0;
        }
        $now = \Carbon\Carbon::now();
        return $now->lt($this->start_time) ? $now->diffInSeconds($this->start_time) : 0;
    }

    /**
     * Remaining full days count
     */
    public function getRemainingDaysCount()
    {
        if (!$this->start_time) {
            return 0;
        }
        $now = \Carbon\Carbon::now();
        if ($now->gte($this->start_time)) {
            return 0;
        }
        return (int)$now->diffInDays($this->start_time);
    }

    /**
     * Human-friendly remaining time text (Bengali + English)
     */
    public function getRemainingTimeForHumans()
    {
        if (!$this->start_time) {
            return 'যেকোনো সময় উন্মুক্ত (Open)';
        }

        $now = \Carbon\Carbon::now();
        if ($now->gte($this->start_time)) {
            if ($this->end_time && $now->gt($this->end_time)) {
                return 'সময় সমাপ্ত (Closed)';
            }
            return 'লাইভ চলমান (Live Now)';
        }

        $diff = $now->diff($this->start_time);
        $parts = [];
        if ($diff->days > 0) {
            $parts[] = self::toBengaliNumber($diff->days) . ' দিন';
        }
        if ($diff->h > 0) {
            $parts[] = self::toBengaliNumber($diff->h) . ' ঘণ্টা';
        }
        if ($diff->days == 0 && $diff->i > 0) {
            $parts[] = self::toBengaliNumber($diff->i) . ' মিনিট';
        }
        if (empty($parts)) {
            $parts[] = self::toBengaliNumber(max(1, $diff->s)) . ' সেকেন্ড';
        }

        return implode(' ', $parts) . ' বাকি (' . ($diff->days > 0 ? $diff->days . 'd ' : '') . ($diff->h > 0 ? $diff->h . 'h ' : '') . ($diff->days == 0 && $diff->i > 0 ? $diff->i . 'm ' : '') . 'remaining)';
    }

    /**
     * Get formatted start time in English and Bengali
     */
    public function getFormattedStartTime()
    {
        if (!$this->start_time) {
            return 'সময় নির্ধারণ করা নেই';
        }
        return $this->start_time->format('d M Y, h:i A');
    }

    /**
     * Check if student can take/retake this quiz
     */
    public function canAttempt($studentAccountId)
    {
        if (!$this->is_published) {
            return false;
        }

        // If exam is scheduled for future, cannot attempt yet
        if ($this->isUpcoming()) {
            return false;
        }

        // If exam deadline has passed, cannot attempt
        if ($this->isExpired()) {
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
    /**
     * Normalize Set Code to canonical letter (e.g. 'Set A' -> 'A', 'SET B' -> 'B', 'ক' -> 'A')
     */
    public static function normalizeSetCode($setCode)
    {
        $clean = strtoupper(trim((string)$setCode));
        $clean = str_replace('SET ', '', $clean);
        $clean = str_replace('SET', '', $clean);
        $clean = trim($clean);

        $bngToEng = [
            'ক' => 'A',
            'খ' => 'B',
            'গ' => 'C',
            'ঘ' => 'D',
        ];

        return isset($bngToEng[$clean]) ? $bngToEng[$clean] : ($clean ?: 'A');
    }

    /**
     * Get all database alias representations of a set code
     */
    public static function getEquivalentSetCodes($setCode)
    {
        $norm = self::normalizeSetCode($setCode);
        return [
            $norm,
            'Set ' . $norm,
            'SET ' . $norm,
            'set ' . strtolower($norm),
            self::getBengaliSetCode($norm),
        ];
    }

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
        $rawSets = LmsQuestion::where('quiz_id', $this->id)
            ->whereNotNull('set_code')
            ->where('set_code', '!=', '')
            ->distinct()
            ->pluck('set_code')
            ->toArray();

        $normalized = [];
        foreach ($rawSets as $s) {
            $norm = self::normalizeSetCode($s);
            if (!in_array($norm, $normalized)) {
                $normalized[] = $norm;
            }
        }

        return !empty($normalized) ? $normalized : ['A'];
    }
}
