<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsQuestionPaper extends Model
{
    protected $table = 'lms_question_papers';

    protected $guarded = [];

    protected $casts = [
        'duration_minutes' => 'integer',
        'total_marks'      => 'float',
        'pass_marks'       => 'float',
        'negative_marks'   => 'float',
        'version'          => 'integer',
        'exam_date'        => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sections()
    {
        return $this->hasMany(LmsQuestionPaperSection::class, 'paper_id')->orderBy('order_index', 'asc');
    }

    public function items()
    {
        return $this->hasMany(LmsQuestionPaperItem::class, 'paper_id')->orderBy('order_index', 'asc');
    }

    public function masterPaper()
    {
        return $this->belongsTo(LmsQuestionPaper::class, 'master_paper_id');
    }

    public function variants()
    {
        return $this->hasMany(LmsQuestionPaper::class, 'master_paper_id');
    }

    public function linkedQuiz()
    {
        return $this->belongsTo(LmsQuiz::class, 'linked_quiz_id');
    }

    /**
     * Generate unique paper code
     */
    public static function generatePaperCode($subjectCode = '154', $year = '2026')
    {
        $count = self::where('academic_year', $year)->count() + 1;
        return sprintf("QP-%s-%s-%03d", $year, $subjectCode ?: '101', $count);
    }

    /**
     * Recalculate totals from sections & items
     */
    public function recalculateTotals()
    {
        $calculatedMarks = $this->items()->sum('marks');
        $this->update(['total_marks' => $calculatedMarks]);

        foreach ($this->sections as $sec) {
            $secMarks = $sec->items()->sum('marks');
            $sec->update(['total_marks' => $secMarks]);
        }

        return $calculatedMarks;
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
     * Bengali translation of paper sets
     */
    public static function getBengaliSetCode($setCode)
    {
        $map = [
            'Set A' => 'ক-সেট', 'Set B' => 'খ-সেট', 'Set C' => 'গ-সেট', 'Set D' => 'ঘ-সেট',
            'A' => 'ক', 'B' => 'খ', 'C' => 'গ', 'D' => 'ঘ',
        ];
        return isset($map[$setCode]) ? $map[$setCode] : ($setCode ?: 'ক-সেট');
    }
}
