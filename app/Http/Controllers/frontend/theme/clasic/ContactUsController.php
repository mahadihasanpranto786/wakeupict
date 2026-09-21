<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ContactUs;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\model\Page;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    function index()
    {
        $content_list = Page::where('page_name', '=', 'Contact')->get();
        return view('frontend.theme.clasic.contact_us.contact_us', compact('content_list'));
    }

    function contactUsStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'message' => 'required',
        ], [
            'name.required' => 'This Field Is Requited!',
            'phone.required' => 'This Field Is Requited!',
            'email.required' => 'This Field Is Requited!',
            'image.required' => 'This Field Is Requited!',
            'message.required' => 'This Field Is Requited!',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(590, 708)->save('public/uploads/contact_us/images/' . $name_gen);
        $save_url = 'public/uploads/contact_us/images/' . $name_gen;
        ContactUs::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => $save_url,
            'message' => $request->message,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Thanks For Your Contact',
        ]);
        return redirect()->back()->with($notification);
    }
}