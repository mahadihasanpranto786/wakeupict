<?php

namespace App\Http\Controllers\backend\theme\clasic\blogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Blog;
use App\model\BlogContent;
use App\model\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\model\BlogCategory;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // ========================================= blog category start =============================================
    //category list
    function blogCategory()
    {
        $blog_Category = BlogCategory::latest()->get();
        return view('backend.theme.clasic.blog.blog_category.blog_category', compact('blog_Category'));
    }
    // store category
    function blogCategoryStore(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'short_description' => 'required',
        ], [
            'category_name.required' => 'Please Enter Blog Category!',
            'short_description.required' => 'Please Enter Description!',
        ]);

        BlogCategory::insert([
            'category_name' => $request->category_name,
            'short_description' => $request->short_description,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Category Added Successfully',
        ]);
        return redirect()->back()->with($notification);
    }
    // edit blog category

    function blogCategoryEdit($blogCategory_id)
    {
        $blog_Category = BlogCategory::findOrFail($blogCategory_id);
        return view('backend.theme.clasic.blog.blog_category.blog_category_edit', compact('blog_Category'));
    }


    function blogCategoryUpdate(Request $request)
    {
        $blogCategoryId = $request->id;
        $request->validate([
            'category_name' => 'required',
            'short_description' => 'required',
        ], [
            'category_name.required' => 'Please Enter Blog Category!',
            'short_description.required' => 'Please Enter Description!',
        ]);
        BlogCategory::findOrFail($blogCategoryId)->update([
            'category_name' => $request->category_name,
            'short_description' => $request->short_description,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Category Update Successfully',
        ]);
        return redirect()->route('blog-category')->with($notification);
    }


    function blogCategoryDelete($blogCategory_id)
    {
        $blogCategory = BlogCategory::findOrFail($blogCategory_id)->delete();
        return redirect()->back();
    }
    // ========================================= blog category end =============================================


    // index of blog  list
    // ========================================= blog start =============================================
    function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.theme.clasic.blog.blogs_list', compact('blogs'));
    }
    //create blogs
    function create()
    {
        $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->get();
        return view('backend.theme.clasic.blog.create_blog', compact('blogCategory'));
    }

    //store blogs
    function storeBlog(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'slug_title' =>  'required',
            'creator_name' =>  'required',
            'image_alt' =>  'required',
            'category_id' => 'required',
            'blog_title' => 'required',
            'short_description' => 'required',
            'update_time' => 'required',
            'blog_image' => 'required',
            'footer_title' => 'required',
            'header_image' => 'required',
            // 'templete_name' => 'required',
        ], [
            'slug_title.required' => 'Please fill Page name!',
            'creator_name.required' => 'Please fill Page name!',
            'image_alt.required' => 'Please fill Page name!',
            'category_id.required' => 'Please fill Page name!',
            'blog_title.required' => 'Please Enter Course Title!',
            'short_description.required' => 'Please Enter Time Line!',
            'update_time.required' => 'Please Enter Time Line!',
            'blog_image.required' => 'Please Enter Course Content!',
            'footer_title.required' => 'Please Enter Long Decription!',
            'header_image.required' => 'Please Enter Long Decription!',
            // 'templete_name.required' => 'Please Enter Long Decription!',
        ]);
        // blog thumbnail
        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen =  $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url = 'public/uploads/blog/images/' . $name_gen;
        }
        //next page header
        if ($request->file('header_image')) {
            $image = $request->file('header_image');
            $name_gen =  $image->getClientOriginalName();
            Image::make($image)->resize(960, 510)->save('public/uploads/blog/images/' . $name_gen);
            $header_image = 'public/uploads/blog/images/' . $name_gen;   
        }
      

        // blogs unique slug

        $slug_title = str_replace(' ', '-', $request->slug_title);

        $blogs = Blog::where("slug_title", $slug_title)->first();

        $slug_title2 = str_replace(' ', '-', $request->slug_title);

        if ($blogs == null) {
            Blog::insert([
                'category_id' => $request->category_id,
                'blog_title' => $request->blog_title,
                'creator_name' => $request->creator_name,
                'image_alt' => $request->image_alt,
                'slug_title' => str_replace(' ', '-', $request->slug_title),
                'short_description' => $request->short_description,
                'update_time' => $request->update_time,
                'blog_image' =>  $save_url,
                'header_image' =>  $header_image,
                'footer_title' => $request->footer_title,
                'templete_name' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);

            Page::insert([
                'page_name' => $request->blog_title,
            ]);

            $notification = ([
                'success' => 'Blog Added Successfully',
            ]);
            return redirect()->route('blogs-list')->with($notification);
        } elseif ($blogs->slug_title == $slug_title2) {
            $notification = ([
                'error_slug' => 'Your Slug Is Not Unique',
            ]);
            return redirect()->back()->with($notification);
        } else {
            Blog::insert([
                'category_id' => $request->category_id,
                'blog_title' => $request->blog_title,


                'creator_name' => $request->creator_name,
                'image_alt' => $request->image_alt,


                'slug_title' => str_replace(' ', '-', $request->slug_title),
                'short_description' => $request->short_description,
                'update_time' => $request->update_time,
                'blog_image' =>  $save_url,
                'footer_title' => $request->footer_title,
                'templete_name' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);

            Page::insert([
                'page_name' => $request->blog_title,
            ]);
            $notification = ([
                'success' => 'Blog Added Successfully',
            ]);
            return redirect()->route('blogs-list')->with($notification);
        }


        $notification = ([
            'success' => 'Blog Added Successfully',
        ]);
        return redirect()->route('blogs-list')->with($notification);
    }




    // edit blogs

    function editblog($blog_id)
    {
        // dd($blog_id);

        $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->get();
        $blogs = Blog::findOrFail($blog_id);
        return view('backend.theme.clasic.blog.edit_blog', compact('blogs', 'blogCategory'));
    }

    // update blogs

    function updateBlog(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'blog_title' => 'required',
            'creator_name' =>  'required',
            'image_alt' =>  'required',
            'short_description' => 'required',
            'update_time' => 'required',
            // 'blog_image' => 'required',
            'footer_title' => 'required',
            // 'templete_name' => 'required',
        ], [
            'category_id.required' => 'Please fill Page name!',
            'blog_title.required' => 'Please Enter Course Title!',
            'creator_name.required' => 'Please fill Page name!',
            'image_alt.required' => 'Please fill Page name!',
            'short_description.required' => 'Please Enter Time Line!',
            'update_time.required' => 'Please Enter Time Line!',
            // 'blog_image.required' => 'Please Enter Course Content!',
            'footer_title.required' => 'Please Enter Long Decription!',
            // 'templete_name.required' => 'Please Enter Long Decription!',
        ]);
        //blog id and page id start
        $blog_id = $request->id;
        $blog_row = Blog::findOrFail($blog_id);
        $blog_title = $request->old_title;
        $page_id = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$blog_title]);
        $page_num = $page_id;
        foreach ($page_num as $id) {
            $page_id = $id->id;
        }
        //blog id and page id end
        
        $blog_thumbnail = $blog_row->blog_image; // blog thumbnail
        if ($request->blog_image != '') {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('blog_image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $blog_thumbnail = 'public/uploads/blog/images/' . $name_gen;
        }
      
        $header_image = $blog_row->header_image; // blog thumbnail
        if ($request->header_image != '') {
            $old_img_header = $request->old_img_header;
            File::delete($old_img_header);
            $image = $request->file('header_image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $header_image = 'public/uploads/blog/images/' . $name_gen;
        }


        $slug_title = str_replace(' ', '-', $request->slug_title);
        $blogs = Blog::where("slug_title", $slug_title)->where('id', '!=', $blog_id)->first();
        $slug_title2 = str_replace(' ', '-', $request->slug_title);

        // dd($db_slug_title);
        if ($blogs == null) {
            Blog::findOrFail($blog_id)->update([
                'category_id' => $request->category_id,
                'creator_name' => $request->creator_name,
                'image_alt' => $request->image_alt,
                'blog_image' => $blog_thumbnail, // blog thumbnail
                'header_image' => $header_image, // header thumbnail
                'blog_title' => $request->blog_title,
                'slug_title' => str_replace(' ', '-', $request->slug_title),
                'short_description' => $request->short_description,
                'update_time' => $request->update_time,
                'footer_title' => $request->footer_title,
                'templete_name' => 1,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);


            Page::findOrFail($page_id)->update([
                'page_name' => $request->blog_title,
            ]);


            $notification = ([
                'success' => 'Blog Updated Successfully',
            ]);
            return redirect()->route('blogs-list')->with($notification);
        } elseif ($blogs->slug_title  == $slug_title2) {
            $notification = ([
                'error_slug' => 'Your Slug Is Not Unique',
            ]);
            return redirect()->back()->with($notification);
        } else {
            Blog::findOrFail($blog_id)->update([
                'category_id' => $request->category_id,
                'blog_title' => $request->blog_title,
                'blog_image' => $blog_thumbnail, // blog thumbnail
                'header_image' => $header_image, // header thumbnail
                'creator_name' => $request->creator_name,
                'image_alt' => $request->image_alt,
                'slug_title' => str_replace(' ', '-', $request->slug_title),
                'short_description' => $request->short_description,
                'update_time' => $request->update_time,
                'footer_title' => $request->footer_title,
                'templete_name' => 1,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);

            $notification = ([
                'success' => 'Blog Updated Successfully',
            ]);
            return redirect()->route('blogs-list')->with($notification);
        }
    }
    // delete blog
    function deleteBlog($blog_id)
    {
        $blogs = DB::select('SELECT * FROM `blogs` WHERE id = ?', [$blog_id]);

        foreach ($blogs as $blog) {
            $blog_title = $blog->blog_title;
        }
        // $pageData = DB::select('SELECT * FROM `pages`');
        $page_id = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$blog_title]);
        $page_num = $page_id;
        foreach ($page_num as $id) {
            $page_id = $id->id;
        }
        // delete page
        $deletePage = Page::findOrFail($page_id)->delete();

        BlogContent::where("blog_id", $blog_id)->delete();

        $blog = Blog::findOrFail($blog_id);
        $blog->delete();
        return redirect()->route('blogs-list');
    }



    // blog short description

    function viewBlog($blog_id)
    {
        $blogs = Blog::where('id', $blog_id)->paginate(6);
        $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->get();
        $content_list = Page::where('page_name', '=', 'Blog')->get();
        $resentBlogs = Blog::latest()->take(5)->get();
        return view('backend.theme.clasic.blog.blog_view', compact('blogs', 'blogCategory', 'content_list', 'resentBlogs'));
    }


    // blog slug
    function blogSlug($blog_slug)
    {
        $blogs = Blog::where("slug_title", $blog_slug)->first();
        $blogs->slug_title;
        return response()->json(1);
    }


    // blog slug edit
    function blogSlugEdit($blog_slug, $blog_id)
    {
        $blogs = Blog::where("slug_title", $blog_slug)->where('id', '!=', $blog_id)->first();
        $blogs->slug_title;
        return response()->json(1);
    }


    //inactive blog
    function blogInactive($blog_id)
    {
        $slider = Blog::findOrFail($blog_id)->update([
            'active_blog' => 0,
        ]);
        return redirect()->back();
    }

    //active blog
    function blogActive($blog_id)
    {
        $slider = Blog::findOrFail($blog_id)->update([
            'active_blog' => 1,
        ]);
        return redirect()->back();
    }


    // ========================================= blog end =============================================


    // ========================================= blog content start =============================================

    // add blog content
    function indexBlogContent($blog_id)
    {

        $blogs = Blog::findOrFail($blog_id);
        $blogContents = BlogContent::where('blog_id', $blog_id)->orderBy('order', 'ASC')->paginate(10);

        return view('backend.theme.clasic.blog.blog_content_list', compact('blogContents', 'blogs'));
    }

    function addBlogContent($blog_id)
    {
        $blogs = Blog::findOrFail($blog_id);
        return view('backend.theme.clasic.blog.blog_content', compact('blogs'));
    }


    function storeBlogContent(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'content_design' => 'required',
            'short_description' => 'required',
            'order' => 'required',
        ], [
            'content_design.required' => 'Please Fill This Field',
            'short_description.required' => 'Please Fill This Field',
            'order.required' => 'Please Fill This Field',
        ]);

        $save_url = NULL;
        $save_url_1 = NULL;
        $save_url_2 = NULL;
      
        if ($request->file('file')) {
            $image = $request->file('file');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url = 'public/uploads/blog/images/' . $name_gen;
            // dd($save_url);
        }

        if($request->file('file_1') != null && $request->file('file_2') != null){

            $image = $request->file('file_1');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url_1 = 'public/uploads/blog/images/' . $name_gen;


            $image = $request->file('file_2');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url_2 = 'public/uploads/blog/images/' . $name_gen;
        }


        BlogContent::insert([
            'blog_id' =>  $request->id,
            'title' => $request->title,
            'templete_name' => 1,
            'content_design' => $request->content_design,
            'image_alt' => $request->image_alt,
            'file_type' =>  $request->file_type,
            'file' => $save_url,
            'file_1' => $save_url_1,
            'file_2' => $save_url_2,
            'short_description' => $request->short_description,
            'order' => $request->order,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = ([
            'success' => 'Blog Content Added Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    function editBlogContent($blogContent_id)
    {

        $blogContent =  BlogContent::findOrFail($blogContent_id);
        return view('backend.theme.clasic.blog.edit_blog_content', compact('blogContent'));
    }

    function updateBlogContent(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'content_design' => 'required',
            'short_description' => 'required',
            'order' => 'required',

        ], [
            'content_design.required' => 'Please Fill This Field',
            'short_description.required' => 'Please Fill This Field',
            'order.required' => 'Please Fill This Field',
        ]);

        $blog_content_id = $request->blog_id;
        $blog_contants = BlogContent::findOrFail($blog_content_id);
        $blog_id = $blog_contants->blog_id;

        $save_url =  $blog_contants->file;
        $save_url_1 =  $blog_contants->file_1;
        $save_url_2 =  $blog_contants->file_2;

        

        if ($request->file != '') {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('file');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url = 'public/uploads/blog/images/' . $name_gen;
        }

        if ($request->file_1 != '') {

            $old_img_1 = $request->old_img_1;
            File::delete($old_img_1);
            $image = $request->file('file_1');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url_1 = 'public/uploads/blog/images/' . $name_gen;
        }

        if ($request->file_2 != '') {
            $old_img_2 = $request->old_img_2;
            File::delete($old_img_2);
            $image = $request->file('file_2');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(542, 400)->save('public/uploads/blog/images/' . $name_gen);
            $save_url_2 = 'public/uploads/blog/images/' . $name_gen;
        }


        BlogContent::findOrFail($blog_content_id)->update([
            'title' => $request->title,
            'templete_name' => 1,
            'content_design' => $request->content_design,
            'image_alt' => $request->image_alt,
            'file_type' =>  $request->file_type,
            'short_description' => $request->short_description,
            'order' => $request->order,
            'status' => 1,
            'file' => $save_url,
            'file_1' => $save_url_1,
            'file_2' => $save_url_2,
            'updated_at' => Carbon::now(),
        ]);

        $notification = ([
            'success' => 'Blog Content Updated Successfully',
        ]);
        // return 'save';
        return redirect('/blog-content-list' .  '/' . $blog_id)->with($notification);
    }


    // delete blog contente
    function deleteBlogContent($blogContent_id)
    {
        BlogContent::findOrFail($blogContent_id)->delete();
        return redirect()->back();
    }


    //view blog content

    function viewBlogContent($blogContent_id)
    {
        $blogContent =   BlogContent::findOrFail($blogContent_id);
        return view('backend.theme.clasic.blog.blog_content_view', compact('blogContent'));
    }

    // ========================================= blog content end =============================================

}