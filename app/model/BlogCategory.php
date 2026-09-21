<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //
    protected $guarded = [];
    public function blogCount()
    {
        return $this->hasMany('App\model\Blog', 'category_id');
    }

    public function blogRelation()
    {
        return $this->belongsTo('App\model\Blog');
    }
}