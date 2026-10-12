<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuizAnswer extends Model
{
    protected $table = 'lms_quiz_answers';

    protected $guarded = [];

    protected $casts = [
        'is_correct' => 'boolean',
        'marks_obtained' => 'float',
    ];

    public function attempt()
    {
        return $this->belongsTo(LmsQuizAttempt::class, 'attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(LmsQuestion::class, 'question_id');
    }

    /**
     * Decode selected options array
     */
    public function getSelectedOptionIdsArrayAttribute()
    {
        if (empty($this->selected_option_ids)) {
            return [];
        }

        $decoded = json_decode($this->selected_option_ids, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        return array_filter(explode(',', $this->selected_option_ids));
    }
}
