<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\model\AccountCategory', 'title_id');
    }
}
