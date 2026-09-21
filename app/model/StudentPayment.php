<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $guarded = [];
    public function batch()
    {
        return $this->belongsTo('App\model\Batch', 'batch_id');
    }
    public function student()
    {
        return $this->belongsTo(AdmitedStudent::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
