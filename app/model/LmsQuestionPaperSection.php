<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestionPaperSection extends Model
{
    protected $table = 'lms_question_paper_sections';

    protected $guarded = [];

    protected $casts = [
        'order_index'              => 'integer',
        'marks_per_question'       => 'float',
        'total_marks'              => 'float',
        'required_questions_count' => 'integer',
    ];

    public function paper()
    {
        return $this->belongsTo(LmsQuestionPaper::class, 'paper_id');
    }

    public function items()
    {
        return $this->hasMany(LmsQuestionPaperItem::class, 'section_id')->orderBy('order_index', 'asc');
    }
}
