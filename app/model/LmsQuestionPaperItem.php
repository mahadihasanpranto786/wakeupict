<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestionPaperItem extends Model
{
    protected $table = 'lms_question_paper_items';

    protected $guarded = [];

    protected $casts = [
        'order_index'    => 'integer',
        'marks'          => 'float',
        'negative_marks' => 'float',
    ];

    public function paper()
    {
        return $this->belongsTo(LmsQuestionPaper::class, 'paper_id');
    }

    public function section()
    {
        return $this->belongsTo(LmsQuestionPaperSection::class, 'section_id');
    }

    public function masterQuestion()
    {
        return $this->belongsTo(LmsQuestion::class, 'question_id');
    }

    /**
     * Get snapshot array
     */
    public function getSnapshotAttribute()
    {
        if ($this->snapshot_data) {
            $decoded = json_decode($this->snapshot_data, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }
        return null;
    }

    /**
     * Build frozen snapshot from master question and save it
     */
    public function freezeSnapshot()
    {
        $q = $this->masterQuestion()->with('options')->first();
        if (!$q) {
            return;
        }

        $options = [];
        foreach ($q->options as $opt) {
            $options[] = [
                'id'          => $opt->id,
                'option_text' => $opt->option_text,
                'is_correct'  => (bool)$opt->is_correct,
                'order_index' => (int)$opt->order_index,
            ];
        }

        $data = [
            'id'                  => $q->id,
            'question_text'       => $q->question_text,
            'question_type'       => $q->question_type,
            'correct_answer_text' => $q->correct_answer_text,
            'cq_subquestions'     => $q->cq_subquestions_decoded,
            'matching_pairs'      => $q->matching_pairs_decoded,
            'hints'               => $q->hints,
            'source_reference'    => $q->source_reference,
            'stimulus'            => $q->stimulus,
            'explanation'         => $q->explanation,
            'category'            => $q->category,
            'chapter'             => $q->chapter,
            'topic'               => $q->topic,
            'difficulty'          => $q->difficulty,
            'marks'               => $this->marks ?: $q->marks,
            'negative_marks'      => $this->negative_marks ?: $q->negative_marks,
            'options'             => $options,
            'frozen_at'           => now()->toDateTimeString(),
        ];

        $this->update(['snapshot_data' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
    }

    public function getCorrectAnswerText()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['correct_answer_text'])) {
            return $snapshot['correct_answer_text'];
        }
        return $this->masterQuestion ? $this->masterQuestion->correct_answer_text : null;
    }

    public function getCqSubquestions()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['cq_subquestions'])) {
            return is_array($snapshot['cq_subquestions']) ? $snapshot['cq_subquestions'] : [];
        }
        return $this->masterQuestion ? $this->masterQuestion->cq_subquestions_decoded : [];
    }

    public function getHints()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['hints'])) {
            return $snapshot['hints'];
        }
        return $this->masterQuestion ? $this->masterQuestion->hints : null;
    }

    public function getMatchingPairs()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['matching_pairs'])) {
            return is_array($snapshot['matching_pairs']) ? $snapshot['matching_pairs'] : [];
        }
        return $this->masterQuestion ? $this->masterQuestion->matching_pairs_decoded : [];
    }

    /**
     * Get question text from snapshot or master
     */
    public function getQuestionText()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['question_text'])) {
            return $snapshot['question_text'];
        }
        return $this->masterQuestion ? $this->masterQuestion->question_text : 'N/A';
    }

    /**
     * Get question options from snapshot or master
     */
    public function getQuestionOptions()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['options'])) {
            return $snapshot['options'];
        }
        if ($this->masterQuestion) {
            return $this->masterQuestion->options->toArray();
        }
        return [];
    }

    /**
     * Get stimulus text
     */
    public function getStimulus()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['stimulus'])) {
            return $snapshot['stimulus'];
        }
        return $this->masterQuestion ? $this->masterQuestion->stimulus : null;
    }

    /**
     * Get question type
     */
    public function getQuestionType()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['question_type'])) {
            return $snapshot['question_type'];
        }
        return $this->masterQuestion ? $this->masterQuestion->question_type : 'mcq_single';
    }

    /**
     * Get explanation
     */
    public function getExplanation()
    {
        $snapshot = $this->snapshot;
        if ($snapshot && isset($snapshot['explanation'])) {
            return $snapshot['explanation'];
        }
        return $this->masterQuestion ? $this->masterQuestion->explanation : null;
    }
}
