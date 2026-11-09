<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function courseItem()
    {
        return $this->hasMany('App\model\CourseItem', 'course_id');
    }

    public function courseFassility()
    {
        return $this->hasMany('App\model\CourseFassility', 'course_id');
    }

    public function courseMember()
    {
        return $this->hasMany('App\model\CourseMember', 'course_id');
    }

    public function batches()
    {
        return $this->hasMany('App\model\Batch', 'course_id');
    }

    public function activeBatches()
    {
        return $this->hasMany('App\model\Batch', 'course_id')
            ->where('status', 1)
            ->where('active_batch', 1);
    }

    public function students()
    {
        return $this->hasMany('App\model\Student', 'course_id');
    }

    public function admitedStudents()
    {
        return $this->hasMany('App\model\AdmitedStudent', 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\model\LmsEnrollment', 'course_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Check if course has registered students or enrollments
     */
    public function hasStudents()
    {
        return $this->students()->exists()
            || $this->admitedStudents()->exists()
            || $this->enrollments()->exists();
    }

    /**
     * Check if course code is used in registrations (immutable check)
     */
    public function isUsedInRegistration()
    {
        return $this->hasStudents();
    }
}
