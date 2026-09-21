<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];


    public function blogContent()
    {
        return $this->hasMany('App\model\BlogContent', 'blog_id');
    }

}