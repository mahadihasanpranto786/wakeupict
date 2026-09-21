<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\AboutBanner;
use App\model\AboutHistory;
use App\model\AboutUs;
use App\model\Page;

class AboutUsController extends Controller
{

    function index()
    {
        $content_list = Page::where('page_name', '=', 'About')->get();
        $abouts = AboutUs::where('active_who', 1)->where('is_intern', "!=", 1)->where('status',1)->where('type', 'employee')->get();
        $oldEmployees = AboutUs::where('active_who', 0)->where('status',1)->where('type', 'employee')->get();
        $interns = AboutUs::where('is_intern',1)->where('active_who', '!=', 0)->where('type', 'employee')->get();
        $chairmanSir = AboutUs::where('active_who', 1)->where('status',1)->where('type', 'chairman')->first();

        $history = AboutHistory::where('status',1)->where('active_status',1)->first();
        $banner = AboutBanner::where('status',1)->where('active_status',1)->first();
        return view('frontend.theme.clasic.about_us.about_us', compact('content_list', 'abouts','chairmanSir','history','banner', 'oldEmployees', 'interns'));
    }

    
    public function SingleHrCardDetails($slug = null) 
    {
        if ($slug == null) {
            return redirect('about-us');
        }
        $about = AboutUs::where('slug', $slug)->first();
        return view('frontend.theme.clasic.about_us.about_card_details', compact('about'));
    }


}
