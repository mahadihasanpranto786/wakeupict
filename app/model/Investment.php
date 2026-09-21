<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
   
    protected $guarded = [];

    
    public function investor()
    {
        return $this->belongsTo('App\model\Investor', 'investor_id');
    }
    
    public function investorType()
    {
        return $this->belongsTo('App\model\InvestorType', 'investment_type_id');
    }
}
