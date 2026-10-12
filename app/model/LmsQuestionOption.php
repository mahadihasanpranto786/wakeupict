<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestionOption extends Model
{
    protected $table = 'lms_question_options';

    protected $guarded = [];

    protected $casts = [
        'is_correct' => 'boolean',
        'order_index' => 'integer',
    ];

    public function question()
    {
        return $this->belongsTo(LmsQuestion::class, 'question_id');
    }
}
