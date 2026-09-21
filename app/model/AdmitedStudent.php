<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AdmitedStudent extends Model
{

    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo('App\model\Batch', 'batch_id');
    }

    public function course()
    {
        return $this->belongsTo('App\model\Course', 'course_id');
    }

}
