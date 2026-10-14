<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestion extends Model
{
    protected $table = 'lms_questions';

    protected $guarded = [];

    protected $casts = [
        'marks' => 'float',
        'negative_marks' => 'float',
        'order_index' => 'integer',
        'is_active' => 'boolean',
    ];

    public function quiz()
    {
        return $this->belongsTo(LmsQuiz::class, 'quiz_id');
    }

    public function options()
    {
        return $this->hasMany(LmsQuestionOption::class, 'question_id')->orderBy('order_index', 'asc');
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
}
