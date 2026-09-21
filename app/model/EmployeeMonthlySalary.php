<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class EmployeeMonthlySalary extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo('App\User', 'employee_id');
    }
}
