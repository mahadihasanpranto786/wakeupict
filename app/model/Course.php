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
}
