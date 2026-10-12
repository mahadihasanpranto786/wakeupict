<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestion extends Model
{
    protected $table = 'lms_questions';

    protected $guarded = [];

    protected $casts = [
        'marks' => 'float',
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
}
