<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = [];
    
    public function course()
    {
        return $this->belongsTo('App\model\Course', 'course_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\model\AccountCategory', 'title_id');
    }
}
