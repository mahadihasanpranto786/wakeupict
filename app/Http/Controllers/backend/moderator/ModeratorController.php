<?php

namespace App\Http\Controllers\backend\moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorController extends Controller
{
    function index()
    {
        return view('backend.theme.clasic.moderator_layouts.moderator');
        // dd('moderator');
    }
}
