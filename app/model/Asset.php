<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $guarded = [];

    function assetType(){
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }
}
