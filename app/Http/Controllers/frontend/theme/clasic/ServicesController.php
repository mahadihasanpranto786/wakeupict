<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Page;
use App\model\Service;
use App\model\ServiceBanner;

class ServicesController extends Controller
{

    function index()
    {
        $content_list = Page::where('page_name', '=', 'Services')->get();
        $services = Service::where('status', 1)->orderBy('order_service', 'ASC')->get();

        $banner = ServiceBanner::where("status", 1)->where("active_status", 1)->first();
        return view('frontend.theme.clasic.services.services', compact('content_list','services','banner'));
    }
}