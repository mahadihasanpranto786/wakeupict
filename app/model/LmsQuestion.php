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

    public function parentQuestion()
    {
        return $this->belongsTo(LmsQuestion::class, 'parent_question_id');
    }

    public function derivedQuestions()
    {
        return $this->hasMany(LmsQuestion::class, 'parent_question_id');
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

    public function isOriginal()
    {
        return is_null($this->parent_question_id);
    }

    public function isDerived()
    {
        return !is_null($this->parent_question_id);
    }

    public function getCqSubquestionsDecodedAttribute()
    {
        if ($this->cq_subquestions) {
            $decoded = json_decode($this->cq_subquestions, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    public function getMatchingPairsDecodedAttribute()
    {
        if ($this->matching_pairs) {
            $decoded = json_decode($this->matching_pairs, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
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
            'fill_blanks'  => 'শূন্যস্থান পূরণ (Fill in Blanks)',
            'short_answer' => 'অতি সংক্ষেপে উত্তর (Short Question)',
            'creative'     => 'সৃজনশীল প্রশ্ন (Creative CQ)',
            'descriptive'  => 'রচনামূলক / বর্ণনামূলক (Descriptive)',
            'translation'  => 'ইংরেজি অনুবাদ (Translation)',
            'matching'     => 'বাম-ডান মিলকরণ (Matching)',
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

    /**
     * Get explanation status badge
     */
    public function getExplanationStatusBadge()
    {
        $status = $this->explanation_status ?: 'verified';
        switch ($status) {
            case 'verified':
                return '<span class="badge badge-success font-weight-bold" style="background-color:#10b981; color:#ffffff;"><i class="fa fa-check-circle"></i> যাচাইকৃত (Verified)</span>';
            case 'pending_review':
                return '<span class="badge badge-warning text-dark font-weight-bold"><i class="fa fa-clock-o"></i> পর্যালোচনাধীন (Pending)</span>';
            case 'draft':
            default:
                return '<span class="badge badge-secondary font-weight-bold"><i class="fa fa-pencil"></i> খসড়া (Draft)</span>';
        }
    }

    /**
     * Effective Concept Title (uses own or inherits from parent)
     */
    public function getEffectiveConceptTitle()
    {
        if (!empty($this->concept_title)) {
            return $this->concept_title;
        }
        if ($this->parentQuestion && !empty($this->parentQuestion->concept_title)) {
            return $this->parentQuestion->concept_title;
        }
        return $this->topic ? $this->topic : ($this->chapter ? $this->chapter : null);
    }

    /**
     * Effective Conceptual Explanation (uses own or inherits from parent)
     */
    public function getEffectiveConceptExplanation()
    {
        if (!empty($this->concept_explanation)) {
            return $this->concept_explanation;
        }
        if ($this->parentQuestion && !empty($this->parentQuestion->concept_explanation)) {
            return $this->parentQuestion->concept_explanation;
        }
        return null;
    }

    /**
     * Effective Step by Step Solution / Reasoning
     */
    public function getEffectiveStepByStepSolution()
    {
        if (!empty($this->step_by_step_solution)) {
            return $this->step_by_step_solution;
        }
        if ($this->parentQuestion && !empty($this->parentQuestion->step_by_step_solution)) {
            return $this->parentQuestion->step_by_step_solution;
        }
        return null;
    }

    /**
     * Effective Important Rules / Formulas
     */
    public function getEffectiveImportantRules()
    {
        if (!empty($this->important_rules)) {
            return $this->important_rules;
        }
        if ($this->parentQuestion && !empty($this->parentQuestion->important_rules)) {
            return $this->parentQuestion->important_rules;
        }
        return null;
    }

    /**
     * Effective Common Mistakes / Traps
     */
    public function getEffectiveCommonMistakes()
    {
        if (!empty($this->common_mistakes)) {
            return $this->common_mistakes;
        }
        if ($this->parentQuestion && !empty($this->parentQuestion->common_mistakes)) {
            return $this->parentQuestion->common_mistakes;
        }
        return null;
    }

    /**
     * Effective Memory Aid / Mnemonics
     */
    public function getEffectiveMemoryAid()
    {
        if (!empty($this->memory_aid)) {
            return $this->memory_aid;
        }
        if ($this->parentQuestion && !empty($this->parentQuestion->memory_aid)) {
            return $this->parentQuestion->memory_aid;
        }
        return null;
    }

    /**
     * Effective Why Other Options Are Wrong
     */
    public function getEffectiveWhyOtherOptionsWrong()
    {
        if (!empty($this->why_other_options_wrong)) {
            return $this->why_other_options_wrong;
        }
        return null;
    }

    /**
     * Check if question has any educational explanation available
     */
    public function hasEducationalExplanation()
    {
        return !empty($this->explanation) ||
               !empty($this->getEffectiveConceptExplanation()) ||
               !empty($this->getEffectiveStepByStepSolution()) ||
               !empty($this->getEffectiveImportantRules()) ||
               !empty($this->getEffectiveWhyOtherOptionsWrong()) ||
               !empty($this->getEffectiveCommonMistakes()) ||
               !empty($this->getEffectiveMemoryAid());
    }

    /**
     * Get a clean, human-readable correct answer string for display
     */
    public function getFormattedCorrectAnswer()
    {
        if ($this->question_type === 'true_false') {
            $ans = strtolower(trim((string)$this->correct_answer_text));
            if (in_array($ans, ['true', '1', 't', 'স', 'সত্য'])) {
                return 'সত্য (True)';
            }
            if (in_array($ans, ['false', '0', 'f', 'মি', 'মিথ্যা'])) {
                return 'মিথ্যা (False)';
            }
            if (!empty($this->correct_answer_text)) {
                return $this->correct_answer_text;
            }
            $correctOpt = $this->options ? $this->options->where('is_correct', true)->first() : null;
            return $correctOpt ? $correctOpt->option_text : 'সত্য';
        }

        if (!empty($this->correct_answer_text)) {
            return $this->correct_answer_text;
        }

        $correctOpt = $this->options ? $this->options->where('is_correct', true)->first() : null;
        if ($correctOpt) {
            return $correctOpt->option_text;
        }

        return 'উপলব্ধ নয়';
    }

    /**
     * Normalize question text for comparing variations and eliminating duplicates
     */
    public static function normalizeQuestionText($text)
    {
        $text = mb_strtolower(trim((string)$text), 'UTF-8');
        // Strip question marks, punctuation, multiple spaces, and special symbols
        $text = preg_replace('/[?।,\.\-_:;!~`#\$%^&*+=\|\/\\\\\(\)\[\]\{\}"\'\s]+/u', ' ', $text);
        return trim($text);
    }

    /**
     * Find related questions sharing the same concept or parent,
     * guaranteeing diverse question formats, zero duplicate questions,
     * and excluding the current question text.
     */
    public function getRelatedConceptQuestions($limit = 6)
    {
        $currentId = $this->id;
        $parentId = $this->parent_question_id;
        $conceptTitle = trim((string)$this->getEffectiveConceptTitle());

        $currentNorm = self::normalizeQuestionText($this->question_text);
        $seenTexts = [$currentNorm => true];
        $results = collect();

        // 1. Direct children & parent/siblings (highest priority: true format derivations)
        $family = self::where('id', '!=', $currentId)
            ->where('is_active', true)
            ->where(function($query) use ($currentId, $parentId) {
                $query->where('parent_question_id', $currentId);
                if ($parentId) {
                    $query->orWhere('id', $parentId)
                          ->orWhere('parent_question_id', $parentId);
                }
            })
            ->orderByRaw("CASE WHEN question_type != ? THEN 0 ELSE 1 END", [$this->question_type])
            ->with('options')
            ->get();

        foreach ($family as $item) {
            $norm = self::normalizeQuestionText($item->question_text);
            if ($norm !== '' && !isset($seenTexts[$norm])) {
                $seenTexts[$norm] = true;
                $results->push($item);
            }
        }

        // 2. Questions with exact same Concept Title
        if ($conceptTitle !== '' && $results->count() < $limit) {
            $conceptMatches = self::where('id', '!=', $currentId)
                ->where('is_active', true)
                ->where('concept_title', $conceptTitle)
                ->whereNotIn('id', $results->pluck('id')->push($currentId)->all())
                ->orderByRaw("CASE WHEN question_type != ? THEN 0 ELSE 1 END", [$this->question_type])
                ->with('options')
                ->get();

            foreach ($conceptMatches as $item) {
                $norm = self::normalizeQuestionText($item->question_text);
                if ($norm !== '' && !isset($seenTexts[$norm])) {
                    $seenTexts[$norm] = true;
                    $results->push($item);
                }
            }
        }

        // 3. Related Concept Keywords & Chapter (e.g. computer meaning, origin, fundamentals)
        if ($results->count() < $limit) {
            $rawWords = array_merge(
                explode(' ', $conceptTitle),
                explode(' ', (string)$this->question_text)
            );
            $stopWords = ['এবং', 'ও', 'বা', 'কী', 'কি', 'কোনটি', 'হলো', 'করে', 'থেকে', 'এর', 'কে', 'হলে', 'না', 'হচ্ছে', 'হবে', 'বলা'];
            $cleanWords = [];
            foreach ($rawWords as $w) {
                $clean = preg_replace('/[?।,\.\-_:;\s\(\)\[\]"\']+/u', '', $w);
                if (mb_strlen($clean, 'UTF-8') >= 3 && !in_array($clean, $stopWords)) {
                    $cleanWords[] = $clean;
                }
            }
            $cleanWords = array_unique(array_slice($cleanWords, 0, 4));

            if (!empty($cleanWords)) {
                $keywordMatches = self::where('id', '!=', $currentId)
                    ->where('is_active', true)
                    ->whereNotIn('id', $results->pluck('id')->push($currentId)->all())
                    ->where(function($sub) use ($cleanWords) {
                        foreach ($cleanWords as $cw) {
                            $sub->orWhere('concept_title', 'LIKE', "%{$cw}%")
                                ->orWhere('question_text', 'LIKE', "%{$cw}%");
                        }
                        if (!empty($this->chapter)) {
                            $sub->orWhere('chapter', $this->chapter);
                        }
                    })
                    ->orderByRaw("CASE WHEN question_type != ? THEN 0 ELSE 1 END", [$this->question_type])
                    ->take(30)
                    ->with('options')
                    ->get();

                foreach ($keywordMatches as $item) {
                    if ($results->count() >= $limit) break;
                    $norm = self::normalizeQuestionText($item->question_text);
                    if ($norm !== '' && !isset($seenTexts[$norm])) {
                        $seenTexts[$norm] = true;
                        $results->push($item);
                    }
                }
            }
        }

        // Return collection prioritized by format diversity (non-matching types first)
        return $results->sortBy(function($item) {
            return ($item->question_type !== $this->question_type) ? 0 : 1;
        })->take($limit)->values();
    }
}
