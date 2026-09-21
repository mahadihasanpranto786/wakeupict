<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Offer extends Controller
{
    function index()
    {
        return view('frontend.theme.clasic.offer.offer');
    }
}
