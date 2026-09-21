<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserRoll extends Model
{
    
    protected $guarded = array();
    
	public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    
	public function module()
    {
        return $this->belongsTo(Module::class,'module_id');
    }
}
