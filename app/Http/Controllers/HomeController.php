<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::user()->type == 'Admin') {

            return redirect()->route('admin');
        }
        elseif (Auth::user()->type == 'Moderator') {

            return redirect()->route('admin');
        }
        elseif (Auth::user()->type == 'Employee') {

            return redirect()->route('admin');
        }  
        else {
            return redirect('/');
        }
    }
}