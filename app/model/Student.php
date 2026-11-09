<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function verifiedBy()
    {
        return $this->belongsTo(\App\User::class, 'verified_by');
    }

    public function scopePending($query)
    {
        return $query->where('registration_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('registration_status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('registration_status', 'rejected');
    }

    public function batch()
    {
        return $this->belongsTo('App\model\Batch', 'batch_id');
    }

    public function course()
    {
        return $this->belongsTo('App\model\Course', 'course_id');
    }

    public function account()
    {
        return $this->hasOne('App\model\StudentAccount', 'student_id');
    }

    public function studentAccount()
    {
        return $this->belongsTo('App\model\StudentAccount', 'personal_call_no', 'phone');
    }

    public function getStudentIdCodeAttribute()
    {
        return $this->registration_number;
    }

    /**
     * Get all courses associated with this student (from selected_courses JSON or primary course_id)
     */
    public function getCoursesListAttribute()
    {
        $courses = collect();

        // 1. From selected_courses JSON
        if (!empty($this->selected_courses)) {
            $decoded = is_array($this->selected_courses) 
                ? $this->selected_courses 
                : json_decode($this->selected_courses, true);
            if (is_array($decoded)) {
                foreach ($decoded as $item) {
                    if (isset($item['title'])) {
                        $courses->push([
                            'id' => $item['id'] ?? null,
                            'title' => $item['title'],
                            'price' => $item['price'] ?? 0,
                        ]);
                    }
                }
            }
        }

        // 2. From primary course_id if not already present in the list
        if ($this->course_id) {
            $alreadyIncluded = $courses->contains(function ($item) {
                return isset($item['id']) && (int)$item['id'] === (int)$this->course_id;
            });

            if (!$alreadyIncluded) {
                $primaryCourse = Course::find($this->course_id);
                if ($primaryCourse) {
                    $courses->prepend([
                        'id' => $primaryCourse->id,
                        'title' => $primaryCourse->course_title,
                        'price' => $primaryCourse->price,
                    ]);
                }
            }
        }

        return $courses;
    }

    /**
     * Total number of courses applied for
     */
    public function getCoursesCountAttribute()
    {
        return $this->courses_list->count();
    }
}
