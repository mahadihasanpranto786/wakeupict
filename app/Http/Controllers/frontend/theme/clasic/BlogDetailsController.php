<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Page;

class BlogDetailsController extends Controller
{
    function index()
    {
        $content_list = Page::where('page_name', '=', 'Blog Details')->get();
        return view('frontend.theme.clasic.our_blogs.blog_details.blog_details', compact('content_list'));
    }
}
