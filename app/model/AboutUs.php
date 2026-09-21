<?php

namespace App\model;

use App\ProjectCompletedByEmployee;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $guarded = [];

    public function singleAboutDetail()
    {
        return $this->hasOne(SingleAboutCardDetails::class, 'about_card_id');
    }

    public function projects()
    {
        return $this->hasMany(ProjectCompletedByEmployee::class, 'about_card_id');
    }

    public function assign_stacks()
    {
        return $this->hasMany(AssignStack::class, 'about_id');
    }
}
