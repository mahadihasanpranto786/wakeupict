<?php

namespace App\Http\Controllers\backend\theme\clasic\service;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Fontawesome;
use App\model\Service;
use Intervention\Image\Facades\Image;
use App\model\ServiceBanner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    //list of service
    function indexService(){
        $services = Service::latest()->get();
        return view('backend.theme.clasic.service.service_list',compact('services'));
    }

    //insert service
    function insertService(){
        $icons = Fontawesome::orderBy('icon', 'ASC')->get();
        return view('backend.theme.clasic.service.insertService', compact('icons'));
    }
    //store service

    function storeService(Request $request){

        $request->validate([
            'logo' => 'required',
            'title' => 'required',
            'order_service' => 'required',
            'description' => 'required',
        ], [
            'logo.required' => 'Please Fill This Fields!',
            'title.required' => 'Please Fill This Fields!',
            'order_service.required' => 'Please Fill This Fields!',
            'description.required' => 'Please Fill This Fields!',
        ]);


        Service::insert([
            'logo' => $request->logo,
            'title' => $request->title,
            'order_service' => $request->order_service,
            'description' => $request->description,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Service Added Successfully',
        ]);
        return redirect()->route('service-list')->with($notification);

    }

    //edit service

    function editService($service_id){
        $icons = Fontawesome::orderBy('icon', 'ASC')->get();
        $service = Service::findOrFail($service_id);
        return view('backend.theme.clasic.service.edit_service',compact('service','icons'));

    }

    // update service

    function updateService(Request $request){

        $request->validate([
            'logo' => 'required',
            'title' => 'required',
            'order_service' => 'required',
            'description' => 'required',
        ], [
            'logo.required' => 'Please Fill This Fields!',
            'title.required' => 'Please Fill This Fields!',
            'order_service.required' => 'Please Fill This Fields!',
            'description.required' => 'Please Fill This Fields!',
        ]);

        $service_id  = $request->id;
        Service::findOrFail($service_id)->update([
            'logo' => $request->logo,
            'title' => $request->title,
            'order_service' => $request->order_service,
            'description' => $request->description,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Service Updated Successfully',
        ]);
        return redirect()->route('service-list')->with($notification);
    }

    // delete service

    function deleteService($service_id){
        Service::findOrFail($service_id)->delete();
        return redirect()->back();
    }

    //********************************************************banner start********************************************* */
    function serviceBanner(){
        $banners = ServiceBanner::orderBy("id", 'desc')->where("status", 1)->paginate(10);
        return view('backend.theme.clasic.service.banner.index_banner',compact('banners'));
    }

    function serviceBannerStore(Request $request){
      
   
        $validator = Validator::make($request->all(), [
            'banner_title' => 'required',
            'banner_description' => 'required',
            'body_title' => 'required',
            'body_description' => 'required',
            'image' => 'required',
            'image_alt' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }
        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)->resize(1350, 390)->save('public/uploads/service/banner/' . $name_gen);
        $save_url = 'public/uploads/service/banner/' . $name_gen;
        ServiceBanner::create([
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
            'body_title' => $request->body_title,
            'body_description' => $request->body_description,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
        ]);
        $notification = ([
            'success' => 'Added Service Page Banner',
        ]);
        return redirect()->back()->with($notification);
    }

           
    function serviceBannerUpdate(Request $request){
        
    $validator = Validator::make($request->all(), [
        'banner_title' => 'required',
        'banner_description' => 'required',
        'body_title' => 'required',
        'body_description' => 'required',
        'image_alt' => 'required',
    ]);

    if ($validator->fails()) {
        
        $notification = ([
            'error' => 'Something is wrong. Please Fill all the fill carefully',
        ]);

        return redirect()->back()
        ->withErrors($validator)
        ->withInput()->with($notification);
    }
    
    $banner =  ServiceBanner::findOrFail($request->id);
    $save_url = $banner->image;
    if ($request->file('image')) {
        $old_img = $request->old_img;
        File::delete($old_img);
        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)->resize(1350, 390)->save('public/uploads/course/banner/' . $name_gen);
        $save_url = 'public/uploads/course/banner/' . $name_gen;
    }


    $banner->update([
        'banner_title' => $request->banner_title,
        'banner_description' => $request->banner_description,
        'body_title' => $request->body_title,
        'body_description' => $request->body_description,
        'image' => $save_url,
        'image_alt' => $request->image_alt,
    ]);
    $notification = ([
        'success' => 'Updated Training Page Banner',
    ]);
    return redirect()->back()->with($notification);
}

function inactiveBanner($banner_id){
    ServiceBanner::findOrFail($banner_id)->update(['active_status'=>0 ]);
    return redirect()->back();
}

function activeBanner($banner_id){
    $history_row = ServiceBanner::findOrFail($banner_id);
    $histories = ServiceBanner::where('status', 1)->where('active_status', 1)->get();
    foreach($histories as $history){
        ServiceBanner::where('id',$history->id)->update(['active_status'=> 0]);
    }
    $history_row->update(['active_status'=>1 ]);
    return redirect()->back();
}

function deleteBanner($banner_id){
    ServiceBanner::findOrFail($banner_id)->update(['status'=>0 ]);
    return redirect()->back();
}

    //********************************************************banner end********************************************* */

}
