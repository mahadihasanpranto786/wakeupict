<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    protected $dates = [
        'salary_month',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
