<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsExamViolation extends Model
{
    protected $table = 'lms_exam_violations';

    protected $guarded = [];

    /**
     * Relationship to exam attempt
     */
    public function attempt()
    {
        return $this->belongsTo(LmsQuizAttempt::class, 'attempt_id');
    }

    /**
     * Relationship to student account
     */
    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    /**
     * Relationship to quiz / exam
     */
    public function quiz()
    {
        return $this->belongsTo(LmsQuiz::class, 'quiz_id');
    }

    /**
     * Human readable Bangla title for violation type
     */
    public function getViolationTitleAttribute()
    {
        return static::translateViolationType($this->violation_type);
    }

    /**
     * Translate violation type to Bengali
     */
    public static function translateViolationType($type)
    {
        switch ($type) {
            case 'tab_switch':
                return 'ট্যাব পরিবর্তন (Tab Switching)';
            case 'window_blur':
                return 'উইন্ডো ফোকাস হারানো (Window Blur)';
            case 'copy_attempt':
                return 'টেক্সট কপি করার চেষ্টা (Copy Protection)';
            case 'cut_attempt':
                return 'টেক্সট কাট করার চেষ্টা (Cut Protection)';
            case 'paste_attempt':
                return 'টেক্সট পেস্ট করার চেষ্টা (Paste Protection)';
            case 'right_click':
                return 'মাউস রাইট ক্লিক (Context Menu)';
            case 'restricted_shortcut':
                return 'নিষিদ্ধ কিবোর্ড শর্টকাট (Keyboard Violation)';
            case 'dev_tools':
                return 'ডেভেলপার টুলস / F12 (Inspect Element)';
            default:
                return ucfirst(str_replace('_', ' ', (string)$type));
        }
    }
}

