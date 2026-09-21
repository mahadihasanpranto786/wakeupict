<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\TalentHunt;

class TalentHuntControllerFrontend extends Controller
{
    public function index()
    {
        $data['post'] = TalentHunt::orderBy('id', 'asc')->first();
        return view('frontend.theme.clasic.talent_hunt.index', $data);
    }

}
