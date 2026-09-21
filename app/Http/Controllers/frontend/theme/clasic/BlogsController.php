<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Blog;
use App\model\BlogCategory;
use App\model\BlogContent;
use App\model\Page;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    function index()
    {
        $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->where('status', 1)->get();
        $content_list = Page::where('page_name', '=', 'Blog')->get();
        $blogs = Blog::where('active_blog', 1)->where('status', 1)->orderBy('id', 'DESC')->paginate(6);

        $resentBlogs = Blog::latest()->where('active_blog', 1)->where('status', 1)->take(5)->get();

        return view('frontend.theme.clasic.our_blogs.our_blogs', compact('content_list', 'blogs', 'blogCategory', 'resentBlogs'));
    }

    // blog details

    function blogDetails($blog_slug)
    {
        $blogData = DB::table('blogs')->where('slug_title', $blog_slug)->first();
        // dd($blogData);
        if ($blogData == null) {
            $cat_slug_get = str_replace('-', ' ', $blog_slug);
            $blogCategoryGet = BlogCategory::where("category_name", $cat_slug_get)->where('status',1)->first();
            $cat_id = $blogCategoryGet->id;
            $content_list = Page::where('page_name', '=', 'Blog')->get();
            $resentBlogs = Blog::latest()->where('active_blog', 1)->where('status',1)->take(5)->get();
            $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->get();
            $MoreBlog = Blog::where('category_id', $cat_id)->where('status', 1)->where('active_blog', 1)->get();
            $blogs = Blog::where("category_id", $cat_id)->where("status", 1)->where('active_blog', 1)->paginate(6);
    
                if ($blogs->isEmpty()) {
                    return view('frontend.theme.clasic.our_blogs.empty_blog', compact('content_list', 'blogs', 'blogCategory', 'resentBlogs', 'MoreBlog'));
                } else {
                    return view('frontend.theme.clasic.our_blogs.our_blogs', compact('content_list', 'blogs', 'blogCategory', 'resentBlogs', 'MoreBlog'));
                }
        } else{
            $blog =  Blog::findOrFail($blogData->id);
            $blogContent = $blog->blogContent()->where('status', 1)->orderBy("order", 'ASC')->get();
            $MoreBlog = Blog::where('id', '!=', $blogData->id)->where('category_id', $blog->category_id)->where('status', 1)->get();

            $blogTitle = $blog->blog_title;
            // dd($blogTitle);
            $page_content = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$blogTitle]);
            return view('frontend.theme.clasic.our_blogs.blog_details.blog_details', compact('blog', 'page_content', 'blogContent', 'MoreBlog'));
    
        }
 }

    //more blog details
    function moreBlogDetails($blog_slug, $id)
    {
        // return 'wow';
        $blogData = DB::table('blogs')->where('slug_title', $blog_slug)->first();
        $blog =  Blog::findOrFail($blogData->id);
        $blogContent = $blog->blogContent()->where('status', 1)->orderBy("order", 'ASC')->get();
        $MoreBlog = Blog::where('id', '!=', $id)->where('category_id', $blog->category_id)->where('status', 1)->get();
        // dd($MoreBlog);
        $blogTitle = $blog->blog_title;

        $page_content = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$blogTitle]);
        return view('frontend.theme.clasic.our_blogs.blog_details.blog_details', compact('blog', 'page_content', 'blogContent', 'MoreBlog'));
    }
    //resent blog details
    function resentblog($blog_slug)
    {

        $blog_slug_get = str_replace('-', ' ', $blog_slug);

        $blogGet = Blog::where('blog_title', $blog_slug_get)->where('active_blog', 1)->first();
        $blog_id = $blogGet->id;
        $blog = Blog::findOrFail($blog_id);
        $blogContent = $blog->blogContent()->where('status', 1)->orderBy("order", 'ASC')->get();
        $MoreBlog = Blog::where('id', '!=', $blog_id)->where('category_id', $blog->category_id)->where('active_blog', 1)->where('status', 1)->get();

        $blogTitle = $blog->blog_title;
        $page_content = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$blogTitle]);
        return view('frontend.theme.clasic.our_blogs.blog_details.blog_details', compact('blog', 'page_content', 'blogContent', 'MoreBlog'));
    }
    //category wise blog
    function catWiseBlog($cat_slug)
    {

        $cat_slug_get = str_replace('-', ' ', $cat_slug);
        $blogCategoryGet = BlogCategory::where("category_name", $cat_slug_get)->where('status',1)->first();
        $cat_id = $blogCategoryGet->id;
        $content_list = Page::where('page_name', '=', 'Blog')->get();
        $resentBlogs = Blog::latest()->where('active_blog', 1)->where('status',1)->take(5)->get();
        $blogCategory = BlogCategory::orderBy("category_name", 'ASC')->get();
        $MoreBlog = Blog::where('category_id', $cat_id)->where('status', 1)->where('active_blog', 1)->get();
        $blogs = Blog::where("category_id", $cat_id)->where("status", 1)->where('active_blog', 1)->paginate(6);

            if ($blogs->isEmpty()) {
                return view('frontend.theme.clasic.our_blogs.empty_blog', compact('content_list', 'blogs', 'blogCategory', 'resentBlogs', 'MoreBlog'));
            } else {
                return view('frontend.theme.clasic.our_blogs.our_blogs', compact('content_list', 'blogs', 'blogCategory', 'resentBlogs', 'MoreBlog'));
            }

    }
    //resent blog details

    function resentBlogDetails($resentId, $blog_id)
    {
        $blog =  Blog::findOrFail($blog_id);

        $blogContent = $blog->blogContent()->where('status', 1)->orderBy("order", 'ASC')->get();

        $MoreBlog = Blog::where('id', '!=', $blog_id)->where('category_id', $blog->category_id)->where('active_blog', 1)->where('status', 1)->get();

        $blogTitle = $blog->blog_title;
        // dd($blogTitle);
        $page_content = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$blogTitle]);
        return view('frontend.theme.clasic.our_blogs.blog_details.blog_details', compact('blog', 'page_content', 'blogContent', 'MoreBlog'));
    }
}
