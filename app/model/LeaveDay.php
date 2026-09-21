<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    protected $guarded = [];

    
    public function leaveCat()
    {
        return $this->belongsTo(LeaveCategory::class, 'id');
    }
}
