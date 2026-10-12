<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsAssignmentSubmission extends Model
{
    protected $table = 'lms_assignment_submissions';

    protected $guarded = [];

    protected $casts = [
        'submitted_at' => 'datetime',
        'marks_obtained' => 'float',
        'graded_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(LmsAssignment::class, 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function grader()
    {
        return $this->belongsTo(\App\User::class, 'graded_by');
    }

    public function isPassed()
    {
        $assignment = $this->assignment;
        if (!$assignment || $this->marks_obtained === null) {
            return false;
        }

        return $this->marks_obtained >= $assignment->pass_marks;
    }
}
