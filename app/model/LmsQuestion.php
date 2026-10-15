<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestion extends Model
{
    protected $table = 'lms_questions';

    protected $guarded = [];

    protected $casts = [
        'marks'          => 'float',
        'negative_marks' => 'float',
        'order_index'    => 'integer',
        'is_active'      => 'boolean',
        'is_archived'    => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function quiz()
    {
        return $this->belongsTo(LmsQuiz::class, 'quiz_id');
    }

    public function options()
    {
        return $this->hasMany(LmsQuestionOption::class, 'question_id')->orderBy('order_index', 'asc');
    }

    public function paperItems()
    {
        return $this->hasMany(LmsQuestionPaperItem::class, 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(LmsQuizAnswer::class, 'question_id');
    }

    /**
     * Return Bengali option letter corresponding to 0, 1, 2, 3
     */
    public static function getBengaliOptionLetter($index)
    {
        $letters = ['ক', 'খ', 'গ', 'ঘ', 'ঙ'];
        return isset($letters[$index]) ? $letters[$index] : (string)($index + 1);
    }

    /**
     * Get readable question type label
     */
    public function getTypeLabel()
    {
        $types = [
            'mcq_single'   => 'MCQ (একক নির্বাচন)',
            'mcq_multi'    => 'বহুপদী সমাপ্তিসূচক (Multiple Select)',
            'true_false'   => 'সত্য / মিথ্যা (True/False)',
            'short_answer' => 'সংক্ষিপ্ত উত্তর (Short Answer)',
            'descriptive'  => 'রচনামূলক / বর্ণনামূলক (Descriptive)',
            'fill_blanks'  => 'শূন্যস্থান পূরণ (Fill in Blanks)',
            'creative'     => 'সৃজনশীল প্রশ্ন (Creative CQ)',
        ];

        return isset($types[$this->question_type]) ? $types[$this->question_type] : strtoupper($this->question_type);
    }

    /**
     * Get difficulty badge HTML or text
     */
    public function getDifficultyBadge()
    {
        switch (strtolower($this->difficulty)) {
            case 'easy':
                return '<span class="badge badge-success">সহজ (Easy)</span>';
            case 'hard':
                return '<span class="badge badge-danger">কঠিন (Hard)</span>';
            case 'medium':
            default:
                return '<span class="badge badge-warning text-dark">মাঝারি (Medium)</span>';
        }
    }
}
