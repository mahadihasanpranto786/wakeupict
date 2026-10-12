<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LmsAssignment extends Model
{
    protected $table = 'lms_assignments';

    protected $guarded = [];

    protected $casts = [
        'total_marks' => 'float',
        'pass_marks' => 'float',
        'due_date' => 'datetime',
        'max_file_size_mb' => 'integer',
        'is_published' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function chapter()
    {
        return $this->belongsTo(LmsChapter::class, 'chapter_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function submissions()
    {
        return $this->hasMany(LmsAssignmentSubmission::class, 'assignment_id');
    }

    /**
     * Get student's submission for this assignment
     */
    public function studentSubmission($studentAccountId)
    {
        return LmsAssignmentSubmission::where('assignment_id', $this->id)
            ->where('student_account_id', $studentAccountId)
            ->first();
    }

    public function isPastDue()
    {
        return $this->due_date ? Carbon::now()->greaterThan($this->due_date) : false;
    }
}
