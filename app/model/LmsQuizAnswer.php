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
        'is_finalized' => 'boolean',
        'finalized_at' => 'datetime',
        'is_flagged' => 'boolean',
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

    /**
     * Decode CQ answers array (subquestions a, b, c, d)
     */
    public function getCqAnswersDecodedAttribute()
    {
        if (empty($this->cq_answers)) {
            return [];
        }

        $decoded = json_decode($this->cq_answers, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Check if answer is locked
     */
    public function isLocked()
    {
        return (bool)$this->is_finalized;
    }
}
