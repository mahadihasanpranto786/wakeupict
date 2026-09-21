<?php

namespace App\Http\Controllers\backend\theme\clasic\courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Course;
use App\model\CourseBanner;
use App\model\CourseFassility;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\model\Page;
use Illuminate\Support\Facades\DB;
use App\model\CourseItem;
use App\model\CourseMember;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // ======================================== course start ============================================
    // course list
    function index()
    {
        $courses = Course::where('status', 1)->latest()->get();
        return view('backend.theme.clasic.courses.courses_list', compact('courses'));
    }

    // courser view page
    function courseView($course_id)
    {
        $courses = Course::where('id', $course_id)->get();
        // dd($courses);
        return view('backend.theme.clasic.courses.course_view', compact('courses'));
    }
    //create course
    function create()
    {
        return view('backend.theme.clasic.courses.create_course');
    }

    // store course

    function storeCourse(Request $request)
    {

        $request->validate([
            // 'page_name' => 'required',
            'course_title' => 'required',
            'course_slug' => 'required',
            'time_line' => 'required',
            'short_description' => 'required',
            'course_content' => 'required',
            'long_description' => 'required',
            'importents' => 'required',
            'student_quantity' => 'required',
            'price' => 'required',
            'future_of_this_course' => 'required',
            'possibilities_of_this_course' => 'required',
            'image' => 'required',
            
        ], [
            // 'page_name.required' => 'Please fill Page name!',
            'course_title.required' => 'Please Enter Course Title!',
            'course_slug.required' => 'Please Enter Course Slug!',
            'time_line.required' => 'Please Enter Time Line!',
            'short_description.required' => 'Please Enter Short Description!',
            'course_content.required' => 'Please Enter Course Content!',
            'long_description.required' => 'Please Enter Long Decription!',
            'importents.required' => 'Please Enter Inportents Of This Course!',
            'student_quantity.required' => 'Please Enter Student Qunatity!',
            'price.required' => 'Please Enter Price!',
            'future_of_this_course.required' => 'Please Enter Future Of This Course!',
            'possibilities_of_this_course.required' => 'Please Enter Possibilities Of This Course!',
            'image.required' => 'Please Upload Image!',
        ]);

        $save_url = '';
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(530, 370)->save('public/uploads/course/images/' . $name_gen);
            $save_url = 'public/uploads/course/images/' . $name_gen;
        }

        Course::insert([
            'course_title' => $request->course_title,
            'course_slug' => strtolower(str_replace(' ', '-', $request->course_slug)),
            'time_line' => $request->time_line,
            'short_description' => $request->short_description,
            'course_content' => $request->course_content,
            'long_description' => $request->long_description,
            'importents' => $request->importents,
            'student_quantity' => $request->student_quantity,
            'price' => $request->price,
            'future_of_this_course' => $request->future_of_this_course,
            'possibilities_of_this_course' => $request->possibilities_of_this_course,
            'image' => $save_url,
            'image_alt'=> $request->image_alt,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        Page::insert([
            'page_name' => $request->course_title,
        ]);

        $notification = ([
            'success' => 'Course Added Successfully',
        ]);
        return redirect()->route('courses-list')->with($notification);
    }

    // edit course
    function courseEdit($course_id)
    {
        $courses = Course::findOrFail($course_id);
        return view('backend.theme.clasic.courses.edit_course', compact('courses'));
    }

    // update course

    function updateCourse(Request $request)
    {
        $course_title = $request->old_title;

        $page_id = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$course_title]);
        $page_num = $page_id;
        foreach ($page_num as $id) {
            $page_id = $id->id;
        }

        Page::findOrFail($page_id)->update([
            'page_name' => $request->course_title,
        ]);

        $request->validate([
            // 'page_name' => 'required',
            'course_title' => 'required',
            'time_line' => 'required',
            'short_description' => 'required',
            'course_content' => 'required',
            'long_description' => 'required',
            'importents' => 'required',
            'student_quantity' => 'required',
            'price' => 'required',
            'future_of_this_course' => 'required',
            'possibilities_of_this_course' => 'required',
            
        ], [
            // 'page_name.required' => 'Please fill Page name!',
            'course_title.required' => 'Please Enter Course Title!',
            'time_line.required' => 'Please Enter Time Line!',
            'short_description.required' => 'Please Enter Short Description!',
            'course_content.required' => 'Please Enter Course Content!',
            'long_description.required' => 'Please Enter Long Decription!',
            'importents.required' => 'Please Enter Inportents Of This Course!',
            'student_quantity.required' => 'Please Enter Student Qunatity!',
            'price.required' => 'Please Enter Price!',
            'future_of_this_course.required' => 'Please Enter Future Of This Course!',
            'possibilities_of_this_course.required' => 'Please Enter Possibilities Of This Course!',
            
        ]);

        $course_id = $request->id;
        $course =  Course::findOrFail($course_id);
        $save_url = $course->image;
        if ($request->file('image')) {
            $old_image = $request->oldImg;
            File::delete($old_image);
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(530, 370)->save('public/uploads/course/images/' . $name_gen);
            $save_url = 'public/uploads/course/images/' . $name_gen;
        }


        Course::findOrFail($course_id)->update([
            'course_title' => $request->course_title,
            'course_slug' => strtolower(str_replace(' ', '-', $request->course_slug)),
            'time_line' => $request->time_line,
            'short_description' => $request->short_description,
            'course_content' => $request->course_content,
            'long_description' => $request->long_description,
            'importents' => $request->importents,
            'student_quantity' => $request->student_quantity,
            'price' => $request->price,
            'future_of_this_course' => $request->future_of_this_course,
            'possibilities_of_this_course' => $request->possibilities_of_this_course,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'Course Updated Successfully',
        ]);

        return redirect()->route('courses-list')->with($notification);
    }


    // delete course

    function deleteCourse($course_id)
    {

        $courseData = DB::select('SELECT * FROM `courses` WHERE id = ?', [$course_id]);

        foreach ($courseData as $c_data) {
            $courseTitle = $c_data->course_title;
        }

        $page_id = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$courseTitle]);
        $page_num = $page_id;
        foreach ($page_num as $id) {
            $page_id = $id->id;
        }
        // delete page
        $deletePage = Page::findOrFail($page_id);
        $deletePage->delete();
        // delete course
        $deleteCourse = Course::findOrFail($course_id);
        $deleteCourse->delete();

        //delete course item
        $course_item = CourseItem::where('course_id', $course_id)->delete();


        return redirect()->back();
    }

    //course slug

    function courseSlug($replace)
    {
        $courses = Course::where('course_slug', $replace)->first();
        $courses->course_slug;
        return response()->json(1);
    }

    function courseSlugEdit($replace, $course_id)
    {
        $courses = Course::where('course_slug', $replace)->where('id', '!=', $course_id)->first();
        $courses->course_slug;
        return response()->json(1);
    }

    // ======================================== course end ============================================

    // couse item

    // function addCourseItem(Request $request)
    // {

    //     dd($request->all());
    //     // $courses = Course::findOrFail($course_id);
    //     // return view('backend.theme.clasic.courses.course_item.add_course_item', compact('courses'));
    // }

    // store course item


    // ======================================== course item start ============================================

    function storeCourseItem(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'item_title' => 'required',
            'course_order' => 'required',
            'description' => 'required',
        ], [
            'item_title.required' => 'Please fill This Field!',
            'course_order.required' => 'Please fill This Field!',
            'description.required' => 'Please fill This Field!',
        ]);

        CourseItem::insert([
            'course_id' => $request->course_id,
            'item_title' => $request->item_title,
            'course_order' => $request->course_order,
            'description' => $request->description,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = ([
            'success' => 'Course Item Added Successfully',
        ]);
        return redirect()->back()->with($notification);;
    }

    // course item list
    function courseItemList($course_id)
    {
        $courses = Course::findOrFail($course_id);
        $course_items = CourseItem::orderBy("course_order", 'ASC')->where('course_id', $course_id)->get();
        return view('backend.theme.clasic.courses.course_item.course_item_list', compact('course_items', 'courses'));
    }


    // edit course item
    function editCourseItem($item_id)
    {
        $course_items = CourseItem::findOrFail($item_id);
        return view('backend.theme.clasic.courses.course_item.edit_course_item', compact('course_items'));
    }

    // update course item

    function updateCourseItem(Request $request)
    {
        $item_id = $request->item_id;
        $course_item =  CourseItem::findOrFail($item_id);
        $course_id = $course_item->course_id;
        $request->validate([
            'item_title' => 'required',
            'course_order' => 'required',
            'description' => 'required',
        ], [
            'item_title.required' => 'Please fill This Field!',
            'course_order.required' => 'Please fill This Field!',
            'description.required' => 'Please fill This Field!',
        ]);
        CourseItem::findOrFail($item_id)->update([
            'item_title' => $request->item_title,
            'course_order' => $request->course_order,
            'description' => $request->description,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'Course Item Updated Successfully',
        ]);
        return redirect('course-items-list/' . $course_id)->with($notification);
    }

    // delete course item
    function deleteCourseItem($item_id)
    {
        $course_item = CourseItem::findOrFail($item_id)->delete();

        return redirect()->back();
    }

    // ======================================== course item end ============================================

    // ======================================== course fassility start ============================================

    // course fassilities

    function courseFassilities($course_id)
    {
        $courses = Course::findOrFail($course_id);

        $course_fassilities = CourseFassility::orderBy("fassility_order", 'ASC')->where('course_id', $course_id)->get();
        // dd($courses);
        return view('backend.theme.clasic.courses.course_fassility.course_fassilities_list', compact('courses', 'course_fassilities'));
    }

    // store couse fassility

    function storeCourseFassility(Request $request)
    {
        // dd($request->all());
        $course_id = $request->course_id;

        $request->validate([
            'title' => 'required',
            'fassility_order' => 'required',
        ], [
            'title.required' => 'Please fill This Field!',
            'fassility_order.required' => 'Please fill This Field!',
        ]);

        CourseFassility::insert([
            'course_id' => $request->course_id,
            'fassility_order' => $request->fassility_order,
            'title' => $request->title,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = ([
            'success' => 'Course Fassility Added Successfully',
        ]);
        return redirect()->back()->with($notification);
    }


    // edit fassility

    function editCourseFassility($fassility_id)
    {
        // dd($fassility_id);

        $fassilities = CourseFassility::findOrFail($fassility_id);
        return view('backend.theme.clasic.courses.course_fassility.edit_course_fassility', compact('fassilities'));
    }

    // update course fassility
    function updateCourseFassility(Request $request)
    {
        $fassility_id = $request->fassility_id;

        $facilities =  CourseFassility::findOrFail($fassility_id);
        $course_id = $facilities->course_id;

        $request->validate([
            'title' => 'required',
            'fassility_order' => 'required',
        ], [
            'title.required' => 'Please fill This Field!',
            'fassility_order.required' => 'Please fill This Field!',
        ]);
        CourseFassility::findOrFail($fassility_id)->update([
            'title' => $request->title,
            'fassility_order' => $request->fassility_order,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = ([
            'success' => 'Course Fassility Updated Successfully',
        ]);
        return redirect('course-fassilities-list/' . $course_id)->with($notification);
    }


    // delete

    function deleteCourseFassility($fassility_id)
    {
        $fassilities = CourseFassility::findOrFail($fassility_id)->delete();
        return redirect()->back();
    }



    // ======================================== course fassility end ============================================

    //========================================= course member start =============================================

    // couse member list

    function courseMember($course_id)
    {
        $courseMembers = CourseMember::where("course_id", $course_id)->get();
        $course = Course::findOrFail($course_id);
        $members = User::orderBy("name", 'ASC')->get();
        return view('backend.theme.clasic.courses.course_member.course_member', compact('courseMembers', 'course', 'members'));
    }

    function storeCourseMember(Request $request)
    {
        $course_id = $request->id;


        $request->validate([
            'course_id' => 'required',
            'member_id' => 'required',
            'note' => 'required',
        ], [
            'course_id.required' => 'Please fill This Field!',
            'member_id.required' => 'Please fill This Field!',
            'note.required' => 'Please fill This Field!',
        ]);

        CourseMember::insert([
            'course_id' => $request->course_id,
            'member_id' => $request->member_id,
            'note' => $request->note,
        ]);
        $notification = ([
            'success' => 'Course Member Added Successfully',
        ]);
        return redirect()->back();
    }

    // edit course member

    function editCourseMember($member_id)
    {
        $members = User::orderBy("name", 'ASC')->get();
        $courseMember =  CourseMember::findOrFail($member_id);
        return view('backend.theme.clasic.courses.course_member.edit_course_member', compact('courseMember', 'members'));

    }

    function updateCourseMember(Request $request)
    {
        $member_id = $request->id;
        $members =  CourseMember::findOrFail($member_id);
        $course_id = $members->course_id;
        $request->validate([
            'member_id' => 'required',
            'note' => 'required',
        ], [
            'member_id.required' => 'Please fill This Field!',
            'note.required' => 'Please fill This Field!',
        ]);


        CourseMember::findOrFail($member_id)->update([
            'member_id' => $request->member_id,
            'note' => $request->note,
        ]);
        $notification = ([
            'success' => 'Course Member Update Successfully',
        ]);
        return redirect('course-member-list/' . $course_id)->with($notification);
    }

    // delete course member

    function deleteCourseMember($member_id)
    {

        CourseMember::findOrFail($member_id)->delete();
        $notification = ([
            'success' => 'Course Member Delete Successfully',
        ]);
        return redirect()->back();
    }

    //========================================= course member end =============================================

    //========================================= course member end =============================================
    function courseBanner(){
        $banners = CourseBanner::orderBy('id','desc')->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.courses.banner.banner_index',compact('banners'));
    }

    function tranningBannerStore(Request $request){
      
   
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
        Image::make($image)->resize(1350, 390)->save('public/uploads/course/banner/' . $name_gen);
        $save_url = 'public/uploads/course/banner/' . $name_gen;
        CourseBanner::create([
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
            'body_title' => $request->body_title,
            'body_description' => $request->body_description,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
        ]);
        $notification = ([
            'success' => 'Added Training Page Banner',
        ]);
        return redirect()->back()->with($notification);
    }

    function tranningBannerUpdate(Request $request){
        
   
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
        
        $banner =  CourseBanner::findOrFail($request->id);
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
        CourseBanner::findOrFail($banner_id)->update(['active_status'=>0 ]);
        return redirect()->back();
    }

    function activeBanner($banner_id){
        $history_row = CourseBanner::findOrFail($banner_id);
        $histories = CourseBanner::where('status', 1)->where('active_status', 1)->get();
        foreach($histories as $history){
            CourseBanner::where('id',$history->id)->update(['active_status'=> 0]);
        }
        $history_row->update(['active_status'=>1 ]);
        return redirect()->back();
    }

    function deleteBanner($banner_id){
        CourseBanner::findOrFail($banner_id)->update(['status'=>0 ]);
        return redirect()->back();
    }
    //========================================= course member end =============================================

}