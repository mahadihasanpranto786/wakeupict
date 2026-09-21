<?php

namespace App\model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AssignStack extends Model
{
    protected $guarded = [];

    public function stack()
    {
        return $this->belongsTo(Stack::class, 'stack_id');
    }

    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class, 'about_id');
    }
}
