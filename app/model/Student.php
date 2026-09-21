<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo('App\model\Batch', 'batch_id');
    }
}
