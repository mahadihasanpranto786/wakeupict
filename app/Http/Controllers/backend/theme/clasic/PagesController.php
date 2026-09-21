<?php

namespace App\Http\Controllers\backend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use Illuminate\Support\Facades\File;
use Alert;



class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index($id)
    {
        $single_content = Page::where('id', $id)->get();
        // dd($contents);
        return view('backend.theme.clasic.pages.seo_content_list', compact('single_content'));
    }
    //add page name
    function addPageName(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
        ], [
            'page_name.required' => 'Please fill Page name!',
        ]);

        Page::insert([
            'page_name' => $request->page_name,
        ]);

        $notification = ([
            'success' => 'Page Created Successfully',
        ]);
        return redirect()->back()->with($notification);
    }
    function pageList()
    {
        $pages = Page::where('page_name', '!=', null)->paginate(10);
        // dd($pages);
        return view('backend.theme.clasic.pages.page_list', compact('pages'));
    }
    function seoPage($id)
    {
        $title = Page::findOrFail($id);
        if ($title->title == null) {
            $pages = Page::findOrFail($id);
            return view('backend.theme.clasic.pages.pages', compact('pages'));
        } else {
            $pages = Page::findOrFail($id);
            return view('backend.theme.clasic.pages.update_pages', compact('pages'));
        }
    }


    function store(Request $request)
    {
        // dd($save_url);


        // $request->validate([
        //     // 'page_name' => 'required',
        //     'title' => 'required',
        //     'link_canonical' => 'required',
        //     'og_locale' => 'required',
        //     'og_type' => 'required',
        //     'og_url' => 'required',
        //     'og_site_name' => 'required',
        //     'msvalidate' => 'required',
        //     'description' => 'required',
        //     'article_publisher' => 'required',
        //     'article_modified_time' => 'required',
        //     'image' => 'required',
        //     'og_image_width' => 'required',
        //     'og_image_height' => 'required',
        //     'twitter_card' => 'required',
        //     'twitter_label1' => 'required',
        //     'twitter_data1' => 'required',
        //     'google_site_verification' => 'required',
        // ], [
        //     // 'page_name.required' => 'Please fill Page name!',
        //     'title.required' => 'Please fill Title!',
        //     'link_canonical.required' => 'Please fill Page name!',
        //     'og_locale.required' => 'Please fill OG Locale!',
        //     'og_type.required' => 'Please fill OG Type!',
        //     'og_url.required' => 'Please fill OG URL!',
        //     'og_site_name.required' => 'Please fill OG Site Name!',
        //     'msvalidate.required' => 'Please fill MSVALIDATE!',
        //     'description.required' => 'Please fill Description!',
        //     'article_publisher.required' => 'Please fill Article Publisher!',
        //     'article_modified_time.required' => 'Please fill Article Modified Time!',
        //     'image.required' => 'Please Upload Image!',
        //     'og_image_width.required' => 'Please fill OG Image Width!',
        //     'twitter_card.required' => 'Please fill Twitter Card!',
        //     'twitter_label1.required' => 'Please fill Twitter Label 1!',
        //     'twitter_data1.required' => 'Please fill Twitter Data 1!',
        //     'google_site_verification.required' => 'Please fill Google Site Varification!',
        // ]);

        // $title = Page::where('title', '!=' , null)->where('status', '=', 1);

        // dd($old_img);
        $pages_id = $request->id;
        $page =   Page::findOrFail($pages_id);
        $save_url =  $page->image;
        if ($request->file('image')) {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('image');
            $name_gen =  $image->getClientOriginalName();
            Image::make($image)->resize(400, 400)->save('public/uploads/SEO/images/' . $name_gen);
            $save_url = 'public/uploads/SEO/images/' . $name_gen;
        }
 

        Page::findOrFail($pages_id)->update([
            // 'page_name' => $request->page_name,
            'title' => $request->title,
            'link_canonical' => $request->link_canonical,
            'og_locale' => $request->og_locale,
            'og_type' => $request->og_type,
            'og_url' => $request->og_url,
            'og_site_name' => $request->og_site_name,
            'msvalidate' => $request->msvalidate,
            'description' => $request->description,
            'article_publisher' => $request->article_publisher,
            'article_modified_time' => $request->article_modified_time,
            'image' => $save_url,
            'og_image_width' => $request->og_image_width,
            'og_image_height' => $request->og_image_height,
            'twitter_card' => $request->twitter_card,
            'twitter_label1' => $request->twitter_label1,
            'twitter_data1' => $request->twitter_data1,
            'google_site_verification' => $request->google_site_verification,
            'status' => 1,
            'created_at' =>  Carbon::now(),
        ]);


        // $notification = array([
        //     'message' => 'Updated Your Profile',
        //     'alert-type' => 'success',
        // ]);

        $notification = ([
            'success' => 'Page Updated Successfully',
        ]);

        return redirect('page-content/' . $pages_id)->with($notification);
    }
}
