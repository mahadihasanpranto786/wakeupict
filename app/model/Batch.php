<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'active_batch' => 'integer',
        'status' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo('App\model\Course', 'course_id');
    }

    public function category()
    {
        return $this->belongsTo('App\model\AccountCategory', 'title_id');
    }

    public function students()
    {
        return $this->hasMany('App\model\Student', 'batch_id');
    }

    public function admitedStudents()
    {
        return $this->hasMany('App\model\AdmitedStudent', 'batch_id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\model\LmsEnrollment', 'batch_id');
    }

    /**
     * Scope for active batches available for student registration
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('active_batch', 1);
    }

    /**
     * Check if batch has any registered or admitted students
     */
    public function hasStudents()
    {
        return $this->students()->exists()
            || $this->admitedStudents()->exists()
            || $this->enrollments()->exists();
    }

    /**
     * Check if batch code has already been used in student registrations (immutable check)
     */
    public function isUsedInRegistration()
    {
        return $this->hasStudents();
    }

    /**
     * Standard formatted display label for dropdowns: batch-code-XX[YYYY]
     */
    public function getDisplayNameAttribute()
    {
        $code = $this->batch_code ?: $this->batch_number;
        $year = $this->academic_year ?: date('Y');
        return "batch-code-{$code}[{$year}]";
    }
}
