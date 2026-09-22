<?php

namespace App\Http\Controllers\backend\theme\clasic\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Blog;
use App\model\DevelopmentProject;
use App\model\DevelopmentProjectHeader;
use App\model\Fontawesome;
use App\model\FooterContent;
use App\model\HomeSlider;
use App\model\InternationalProjectHeader;
use App\model\InternationalWork;
use App\model\LocalProject;
use App\model\LocalProjectHeader;
use App\model\NationalWork;
use App\model\NationalWorkHeader;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // ****************************************************** home slider start ******************************************

    // index or list slider

    function index()
    {
        $homeSliders = HomeSlider::latest()->get();
        return view('backend.theme.clasic.home.home_slider.home_slider_list', compact('homeSliders'));
    }

    //create slider
    function createSlider()
    {
        return view('backend.theme.clasic.home.home_slider.home_slider');
    }
    // store slider
    function storeSlider(Request $request)
    {

        $request->validate([
            'slider_image' => 'required',
            'slider_alt' => 'required',
        ], [
            'slider_image.required' => 'Please Upload Slider Image!',
            'slider_alt.required' => 'Please Enter Slider Alt!',
        ]);


        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $targetDir = public_path('uploads/slider_image/images');
        if (!file_exists($targetDir)) {
            @mkdir($targetDir, 0777, true);
        }
        Image::make($image)->resize(1130, 630)->save($targetDir . '/' . $name_gen);
        $save_url = 'uploads/slider_image/images/' . $name_gen;
        HomeSlider::insert([
            'slider_image' => $save_url,
            'slider_alt' => $request->slider_alt,
            'slider_active' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'Slider Added Successfully',
        ]);
        return redirect()->route('home-slider-list')->with($notification);
    }

    // edit slider

    function editSlider($slider_id)
    {
        $homeSilder = HomeSlider::findOrFail($slider_id);
        return view('backend.theme.clasic.home.home_slider.home_slider_edit', compact('homeSilder'));
    }

    //update slider

    function updateSlider(Request $request)
    {

        $request->validate([
            // 'slider_image' => 'required',
            'slider_alt' => 'required',
        ], [
            // 'slider_image.required' => 'Please Upload Slider Image!',
            'slider_alt.required' => 'Please Enter Slider Alt!',
        ]);

        $slider_id = $request->id;
        $slider = HomeSlider::findOrFail($slider_id);
        $save_url =  $slider->slider_image;
        if ($request->file('slider_image')) {
            $old_img = $request->old_img;
            if (!empty($old_img)) {
                $oldClean = public_path(ltrim(str_replace('public/', '', $old_img), '/\\'));
                if (file_exists($oldClean)) {
                    @unlink($oldClean);
                }
            }
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $targetDir = public_path('uploads/slider_image/images');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0777, true);
            }
            Image::make($image)->resize(1130, 630)->save($targetDir . '/' . $name_gen);
            $save_url = 'uploads/slider_image/images/' . $name_gen;
        }

        HomeSlider::findOrFail($slider_id)->update([
            'slider_image' => $save_url,
            'slider_alt' => $request->slider_alt,
            'slider_active' => 1,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Slider Updated Successfully',
        ]);
        return redirect()->route('home-slider-list')->with($notification);
    }

    // delete slider

    function deleteSlider($slider_id)
    {
        HomeSlider::findOrFail($slider_id)->delete();
        return redirect()->back();
    }

    //inactive slider

    function inactiveSlider($slider_id)
    {
        $slider = HomeSlider::findOrFail($slider_id)->update([
            'slider_active' => 0,
        ]);
        return redirect()->back();
    }

    //active slider

    function activeSlider($slider_id)
    {
        $slider = HomeSlider::findOrFail($slider_id)->update([
            'slider_active' => 1,
        ]);
        return redirect()->back();
    }

    // ****************************************************** home slider end ******************************************

    // ***************************************************** OUR NATIONAL WORK START ********************************************************

    public function indexNationalWork()
    {
        $nationalWorkHeader = NationalWorkHeader::latest()->first();
        $national_works = NationalWork::latest()->get();
        return view('backend.theme.clasic.home.nationalWork.indexNationalWork', compact('national_works','nationalWorkHeader'));
    }

    public function addNationalWork()
    {
        $blogs = Blog::latest()->get();
        $icons = Fontawesome::orderBy('icon', 'ASC')->get();
        return view('backend.theme.clasic.home.nationalWork.create_national_work', compact('blogs','icons'));
        
    }

    public function storeNationalWork(Request $request)
    {
       
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image_alt' => 'required',
            'logo' => 'required',
            'blog_id' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'This Field Is Requited!',
            'image.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
            'logo.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
            'description.required' => 'This Field Is Requited!',
        ]);


        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)->resize(320, 185)->save('public/uploads/national_work/images/' . $name_gen);
        $save_url = 'public/uploads/national_work/images/' . $name_gen;

        NationalWork::insert([
            'title' => $request->title,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
            'blog_id' => $request->blog_id,
            'logo' => $request->logo,
            'description' => $request->description,
            'active_project' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'National Work Added Successfully',
        ]);
        return redirect()->route('national-work')->with($notification);
    }

    public function editNationalWork($national_id)
    {
        $blogs = Blog::latest()->get();
        $icons = Fontawesome::orderBy('icon', 'ASC')->get();
        $national_data = NationalWork::findOrFail($national_id);
        return view('backend.theme.clasic.home.nationalWork.edit_national_work', compact('blogs','icons','national_data'));
    }

    public function updateNationalWork(Request $request)
    {
       
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image_alt' => 'required',
            'logo' => 'required',
            'blog_id' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'This Field Is Requited!',
            'image.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
            'logo.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
            'description.required' => 'This Field Is Requited!',
        ]);

        $project_id = $request->id;
        $project = NationalWork::findOrFail($project_id);
        $save_url = $project->image;
        if ($request->file('image')) {
            File::delete($project->image);
            
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(320, 185)->save('public/uploads/national_work/images/' . $name_gen);
            $save_url = 'public/uploads/national_work/images/' . $name_gen;
        }



        $project->update([
            'title' => $request->title,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
            'blog_id' => $request->blog_id,
            'logo' => $request->logo,
            'description' => $request->description,
            'active_project' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'National Work Updated Successfully',
        ]);
        return redirect()->route('national-work')->with($notification);
    }

    public function nationalWorkInactive($national_id)
    {
        $slider = NationalWork::findOrFail($national_id)->update([
            'active_project' => 0,
        ]);
        return redirect()->back();
    }

    public function nationalWorkActive($national_id)
    {
        $slider = NationalWork::findOrFail($national_id)->update([
            'active_project' => 1,
        ]);
        return redirect()->back();
    }

    public function nationalWorkDelete($national_id)
    {
        NationalWork::findOrFail($national_id)->delete();
        return redirect()->back();
    }

    // ***************************************************** OUR NATIONAL WORK END ********************************************************


    // ***************************************************** OUR NATIONAL WORK HEADER START ********************************************************

    public function nationalWorkHeaderUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
    
        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);
    
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }
    
        NationalWorkHeader::findOrFail($request->id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);
        
        $notification = ([
            'success' => 'Updated National Work Header',
        ]);
        return redirect()->back()->with($notification);
    }
    // ***************************************************** OUR NATIONAL WORK HEADER END ********************************************************

    // ************************************************ Our Ongoing Developments start ******************************************

    // create on going projects

    function indexDevelopmentProject()
    {   $developmentProjectHeader = DevelopmentProjectHeader::latest()->first();
        $projects = DevelopmentProject::latest()->get();
        return view('backend.theme.clasic.home.development_project.development_project_list', compact('projects', 'developmentProjectHeader'));
    }

    function createDevelopmentProject()
    {
        $blogs = Blog::latest()->get();
        $icons = Fontawesome::orderBy('icon', 'ASC')->get();
        return view('backend.theme.clasic.home.development_project.create_development_project', compact('icons', 'blogs'));
    }

    // store development project

    function storeDevelopmentProject(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image_alt' => 'required',
            'logo' => 'required',
            'blog_id' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'This Field Is Requited!',
            'image.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
            'logo.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
            'description.required' => 'This Field Is Requited!',
        ]);


        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)->resize(320, 185)->save('public/uploads/development_project/images/' . $name_gen);
        $save_url = 'public/uploads/development_project/images/' . $name_gen;

        DevelopmentProject::insert([
            'title' => $request->title,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
            'blog_id' => $request->blog_id,
            'logo' => $request->logo,
            'description' => $request->description,
            'active_project' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'Development Project Added Successfully',
        ]);
        return redirect()->route('development-project-list')->with($notification);
    }

    // edit development project

    function editDevelopmentProject($project_id)
    {
        $blogs = Blog::latest()->get();
        $icons = Fontawesome::orderBy('icon', 'ASC')->get();
        $project = DevelopmentProject::findOrFail($project_id);
        return view('backend.theme.clasic.home.development_project.edit_development_project', compact('project', 'icons', 'blogs'));
    }

    // update developer project

    function updateDevelopmentProject(Request $request)
    {

        $request->validate([
            'title' => 'required',
            // 'image' => 'required',
            'image_alt' => 'required',
            'blog_id' => 'required',
            'logo' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'This Field Is Requited!',
            'logo.required' => 'This Field Is Requited!',
            // 'image.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
            'logo.required' => 'This Field Is Requited!',
            'description.required' => 'This Field Is Requited!',
        ]);

        $project_id = $request->id;
        $project = DevelopmentProject::findOrFail($project_id);
        $save_url = $project->image;
        if ($request->file('image')) {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(320, 185)->save('public/uploads/development_project/images/' . $name_gen);
            $save_url = 'public/uploads/development_project/images/' . $name_gen;
        }


        DevelopmentProject::findOrFail($project_id)->update([
            'title' => $request->title,
            'blog_id' => $request->blog_id,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
            'logo' => $request->logo,
            'description' => $request->description,
            'active_project' => 1,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'Development Project Updated Successfully',
        ]);
        return redirect()->route('development-project-list')->with($notification);
    }

    // delete development project

    function deleteDevelopmentProject($project_id)
    {
        DevelopmentProject::findOrFail($project_id)->delete();
        return redirect()->back();
    }

    // active project

    function inactiveProject($project_id)
    {
        $slider = DevelopmentProject::findOrFail($project_id)->update([
            'active_project' => 0,
        ]);
        return redirect()->back();
    }

    //active slider

    function activeProject($project_id)
    {
        $slider = DevelopmentProject::findOrFail($project_id)->update([
            'active_project' => 1,
        ]);
        return redirect()->back();
    }

    // fontawesome icon list


    function fontawesomeIcon()
    {
        $fontawesomes =  Fontawesome::latest()->get();
        return view('backend.theme.clasic.home.fontawesome.fontawesomeIcon', compact('fontawesomes'));
    }

    // insert fontawesome

    function fontawesomeIconStore(Request $request)
    {
        $request->validate([
            'icon_name' => 'required',
            'icon' => 'required',
        ], [
            'icon_name.required' => 'This Field Is Requited!',
            'icon.required' => 'This Field Is Requited!',
        ]);

        Fontawesome::insert([
            'icon_name' => $request->icon_name,
            'icon' => $request->icon,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = ([
            'success' => 'Icon Insert Successfully',
        ]);
        return redirect()->back()->with($notification);;
    }


    //  edit fontawesome

    function editFontawesome($id)
    {
        $fontawesomes =  Fontawesome::latest()->get();
        $fontawesome_edit = Fontawesome::findOrFail($id);
        return view('backend.theme.clasic.home.fontawesome.edit_fontawesome', compact('fontawesomes', 'fontawesome_edit'));
    }

    // update fontawesome

    function fontawesomeIconUpdata(Request $request)
    {
        $font_id = $request->id;
        $request->validate([
            'icon_name' => 'required',
            'icon' => 'required',
        ], [
            'icon_name.required' => 'This Field Is Requited!',
            'icon.required' => 'This Field Is Requited!',
        ]);

        Fontawesome::findOrFail($font_id)->update([
            'icon_name' => $request->icon_name,
            'icon' => $request->icon,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = ([
            'success' => 'Icon Insert Successfully',
        ]);
        return redirect()->route("fontawesome-icon")->with($notification);;;
    }

    //  delete icon
    function deleteFontawesome($id)
    {
        $data = Fontawesome::findOrFail($id)->delete();

        return redirect()->back();
    }

    //development-project-header-update

    function developmentProjectHeaderUpdate(Request $request){
                
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
    ]);

    if ($validator->fails()) {
        
        $notification = ([
            'error' => 'Something is wrong. Please Fill all the fill carefully',
        ]);

        return redirect()->back()
        ->withErrors($validator)
        ->withInput()->with($notification);
    }

    DevelopmentProjectHeader::findOrFail($request->id)->update([
        'title'=> $request->title,
        'description'=> $request->description,
    ]);
    
    $notification = ([
        'success' => 'Updated Development Project Header',
    ]);
    return redirect()->back()->with($notification);
    }

    // ************************************************ Our Ongoing Developments end ******************************************


    // ************************************************ International work start ******************************************

    function internationalIndex()
    {
        $blogs = Blog::latest()->get();
        $works =  InternationalWork::latest()->get();
        $internationalProjectHeader = InternationalProjectHeader::latest()->first();
        return view('backend.theme.clasic.home.internationalWork.index_internationalWork', compact('works', 'blogs','internationalProjectHeader'));
    }
    // read data

    function internationalWork()
    {
        $works =  InternationalWork::latest()->get();
        return response()->json($works);
    }
    //store

    function internationalStore(Request $request)
    {

        $request->validate([
            'image' => 'required',
            'blog_id' => 'required',
            'image_alt' => 'required',
        ], [
            'image.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
        ]);

        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)->resize(350, 220)->save('public/uploads/international_work/images/' . $name_gen);
        $save_url = 'public/uploads/international_work/images/' . $name_gen;

        $data =  InternationalWork::insert([
            'image' =>  $save_url,
            'blog_id' => $request->blog_id,
            'image_alt' => $request->image_alt,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'International Work Added Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    // edit international work
    function editInternatonalWork($work_id)
    {
        $blogs = Blog::latest()->get();
        $works =  InternationalWork::latest()->get();
        $work =  InternationalWork::findOrFail($work_id);
        return view('backend.theme.clasic.home.internationalWork.edit_internationalWork', compact('works', 'work', 'blogs'));
    }
    // update international work

    function internationalUpdate(Request $request)
    {
        $request->validate([
            // 'image' => 'required',
            'image_alt' => 'required',
            'blog_id' => 'required',
        ], [
            // 'image.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
        ]);


        $work_id = $request->id;
        $work = InternationalWork::findOrFail($work_id);
        $save_url = $work->image;
        if ($request->file('image')) {

            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('image');
            $name_gen =  $image->getClientOriginalName();
            Image::make($image)->resize(350, 220)->save('public/uploads/international_work/images/' . $name_gen);
            $save_url = 'public/uploads/international_work/images/' . $name_gen;

        }


        InternationalWork::findOrFail($work_id)->update([
            'image' =>  $save_url,
            'image_alt' => $request->image_alt,
            'blog_id' => $request->blog_id,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'International Work Updated Successfully',
        ]);
        return redirect()->route('international-work')->with($notification);
    }

    //delele international work

    function deleteInternatonalWork($work_id)
    {
        InternationalWork::findOrfail($work_id)->delete();
        $notification = ([
            'success' => 'International Work Deleted Successfully',
        ]);
        return redirect()->route('international-work')->with($notification);
    }

    function inactiveWork($work_id)
    {
        $slider = InternationalWork::findOrFail($work_id)->update([
            'active_work' => 0,
        ]);
        return redirect()->back();
    }

    //active slider

    function activeWork($work_id)
    {
        $slider = InternationalWork::findOrFail($work_id)->update([
            'active_work' => 1,
        ]);
        return redirect()->back();
    }

    // header international project 
    function internationalProjectHeaderUpdate(Request $request){
                        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }

        InternationalProjectHeader::findOrFail($request->id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);
        
        $notification = ([
            'success' => 'Updated International Project Header',
        ]);
        return redirect()->back()->with($notification);
    }

    // ************************************************ International work end ******************************************


    // ************************************************ local project start ******************************************
    function indexLocalProject()
    {
        $blogs = Blog::latest()->get();
        $localProjects = LocalProject::latest()->get();
        $localProjectHeader = LocalProjectHeader::latest()->first();
        return view('backend.theme.clasic.home.localProject.index_local_project', compact('localProjects', 'blogs', 'localProjectHeader'));
    }
    // store local project

    function localProjectStore(Request $request)
    {

        $request->validate([
            'image' => 'required',
            'blog_id' => 'required',
            'image_alt' => 'required',
        ], [
            'image.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
        ]);

        $image = $request->file('image');
        $name_gen =  $image->getClientOriginalName();
        Image::make($image)->resize(350, 220)->save('public/uploads/localProject/images/' . $name_gen);
        $save_url = 'public/uploads/localProject/images/' . $name_gen;

        $data =  LocalProject::insert([
            'image' =>  $save_url,
            'image_alt' => $request->image_alt,
            'blog_id' => $request->blog_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Local Project Added Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    //edit local project

    function localProjectEdit($local_id)
    {
        $blogs = Blog::latest()->get();
        $localProjects = LocalProject::latest()->get();
        $localProject = LocalProject::findOrFail($local_id);
        return view('backend.theme.clasic.home.localProject.edit_local_project', compact('localProjects', 'localProject', 'blogs'));
    }

    //update local project

    function updateLocalProject(Request $request)
    {
        $request->validate([
            // 'image' => 'required',
            'image_alt' => 'required',
            'blog_id' => 'required',
        ], [
            // 'image.required' => 'This Field Is Requited!',
            'image_alt.required' => 'This Field Is Requited!',
            'blog_id.required' => 'This Field Is Requited!',
        ]);



        $local_id = $request->id;
        $local = LocalProject::findOrFail($local_id);
        $save_url = $local->image;
        if ($request->file('image')) {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('image');
            $name_gen =  $image->getClientOriginalName();
            Image::make($image)->resize(350, 220)->save('public/uploads/localProject/images/' . $name_gen);
            $save_url = 'public/uploads/localProject/images/' . $name_gen;
        }

        $data =  LocalProject::findOrFail($local_id)->update([
            'image' =>  $save_url,
            'image_alt' => $request->image_alt,
            'blog_id' => $request->blog_id,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Local Project Updated Successfully',
        ]);
        return redirect()->route('local-project')->with($notification);
    }



    //delete local projcet



    function localProjectDelete($local_id)
    {
        LocalProject::findOrFail($local_id)->delete();

        return redirect()->route('local-project');
    }




    function inactiveLocal($local_id)
    {
        $slider = LocalProject::findOrFail($local_id)->update([
            'active_local' => 0,
        ]);
        return redirect()->back();
    }

    //active slider

    function activeLocal($local_id)
    {
        $slider = LocalProject::findOrFail($local_id)->update([
            'active_local' => 1,
        ]);
        return redirect()->back();
    }

    // local project header update

    function localProjectHeaderUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }

        LocalProjectHeader::findOrFail($request->id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);
        
        $notification = ([
            'success' => 'Updated Local Project Header',
        ]);
        return redirect()->back()->with($notification);
    }
    // ************************************************ local project end ******************************************

    // ************************************************ footer start ******************************************
    function createFooter(){
        $footers = FooterContent::orderBy('id', 'desc')->where('status',1)->get();
        return view('backend.theme.clasic.home.footer.create_footer', compact('footers'));
    }

    function store_footer(Request $request){
        $request->validate([
            'footer_header' => 'required',
            'footer_content' => 'required',
            'footer_backgroud' => 'required',
        ], [
            'footer_header.required' => 'This Field Is Requited!',
            'footer_content.required' => 'This Field Is Requited!',
            'footer_backgroud.required' => 'This Field Is Requited!',
        ]);
        
            $image = $request->file('footer_backgroud');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(1920, 500)->save('public/uploads/footer/' . $name_gen);
            $save_url = 'public/uploads/footer/' . $name_gen;

        FooterContent::create([
            'footer_header'=> $request->footer_header,
            'footer_content'=> $request->footer_content,
            'footer_backgroud'=> $save_url,
            'status'=> 1,
        ]);

        

        $notification = ([
            'success' => 'Footer Content Created Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    function update_footer(Request $request){
        
        $request->validate([
            'footer_header' => 'required',
            'footer_content' => 'required',
            'footer_backgroud' => 'required',
        ], [
            'footer_header.required' => 'This Field Is Requited!',
            'footer_content.required' => 'This Field Is Requited!',
            'footer_backgroud.required' => 'This Field Is Requited!',
        ]);
        
      
        $footer_id = $request->id;
        $footer = FooterContent::findOrFail($footer_id);
        $save_url = $footer->footer_backgroud;

        if ($request->file('footer_backgroud')) {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('footer_backgroud');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(1920, 500)->save('public/uploads/footer/' . $name_gen);
            $save_url = 'public/uploads/footer/' . $name_gen;
        }
        $footer->update([
            'footer_header'=> $request->footer_header,
            'footer_content'=> $request->footer_content,
            'footer_backgroud'=> $save_url,
            'status'=> 1,
        ]);

    

    $notification = ([
        'success' => 'Footer Content Updated Successfully',
    ]);
    return redirect()->back()->with($notification);
    }

    function inActiveFooter($footer_id){
        FooterContent::findOrFail($footer_id)->update(['active_status'=>0]);
        return redirect()->back();
    }
    function activeFooter($footer_id){
        $activedFooters =  FooterContent::where('status',1)->where('active_status', 1)->get();

        foreach($activedFooters as $footer){
            FooterContent::where('id', $footer->id)->update(['active_status'=>0]);
        }
        FooterContent::findOrFail($footer_id)->update(['active_status'=>1]);
        return redirect()->back();
    }
    function deleteFooter($footer_id){
        FooterContent::findOrFail($footer_id)->update(['status'=>0]);
        return redirect()->back();
    }
    
    // ************************************************ footer end ******************************************

}