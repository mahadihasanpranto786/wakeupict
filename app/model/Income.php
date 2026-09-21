<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    //

    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo('App\model\AccountCategory', 'title_id');
    }
}
