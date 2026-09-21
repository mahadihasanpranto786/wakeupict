<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Blog;
use App\model\BlogCategory;
use App\model\DevelopmentProject;
use App\model\DevelopmentProjectHeader;
use App\model\HomeSlider;
use App\model\InternationalProjectHeader;
use App\model\InternationalWork;
use App\model\LocalProject;
use App\model\LocalProjectHeader;
use App\model\NationalWork;
use App\model\NationalWorkHeader;
use App\model\Page;
use App\model\Visitor;

class HomeController extends Controller
{
    function index()
    {
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $UserIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $UserIP = $_SERVER['REMOTE_ADDR'];
        }

        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        Visitor::create(['ip_address' => $UserIP,'visit_time' =>$timeDate]);

        $nationalWork=NationalWork::where("active_project", 1)->take(3)->get();
        $nationalWorkHeader = NationalWorkHeader::latest()->first();
        $content_list = Page::where('page_name', '=', 'Home')->get();
        $homeSliders = HomeSlider::where("slider_active", 1)->latest()->get();
        $homeSlider = HomeSlider::where("slider_active", 1)->first();
        $projects = DevelopmentProject::where("active_project", 1)->take(3)->get();
        $internationalWorks = InternationalWork::where("active_work", 1)->take(3)->get();
        $localProjects = LocalProject::where("active_local", 1)->take(3)->get();
        $developmentProjectHeader = DevelopmentProjectHeader::latest()->first();
        $internationalProjectHeader = InternationalProjectHeader::latest()->first();
        $localProjectHeader = LocalProjectHeader::latest()->first();


        return view('frontend.theme.clasic.frontend_layouts.home_page',
         compact(
                'content_list',
                'homeSliders',
                'homeSlider',
                'projects',
                'internationalWorks',
                'localProjects',
                'developmentProjectHeader',
                'internationalProjectHeader',
                'localProjectHeader',
                'nationalWork',
                'nationalWorkHeader'
            ));
    }


    //view blog

    function viewBlog($blog_title)
    {
        $blog_t =   str_replace("-", ' ', $blog_title);
        $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->where('status',1)->get();
        $content_list = Page::where('page_name', '=', 'Blog')->get();
        $blogs = Blog::orderBy('id', 'DESC')->where('active_blog',1)->where('status',1)->paginate(6);

        $resentBlogs = Blog::latest()->where('active_blog',1)->where('status',1)->take(5)->get();
        $blogs = Blog::where("blog_title", $blog_t)->where('active_blog',1)->where('status',1)->paginate(1);
        return view('frontend.theme.clasic.our_blogs.our_blogs', compact('content_list', 'blogs', 'blogCategory', 'resentBlogs'));
    }
}
