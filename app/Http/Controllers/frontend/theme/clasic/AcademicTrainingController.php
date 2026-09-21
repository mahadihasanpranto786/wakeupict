<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Course;
use App\model\CourseBanner;
use App\model\Page;
use Illuminate\Support\Facades\DB;

class AcademicTrainingController extends Controller
{

    function index()
    {
        $content_list = Page::where('page_name', '=', 'Academic')->get();
        $courseData = Course::latest()->get();
        $banner = CourseBanner::where('status',1)->where('active_status',1)->first();
        return view('frontend.theme.clasic.academic_training.academic_training', compact('content_list', 'courseData', 'banner'));
    }


    // course details

    function courseDetails($course_id)
    {
        $courseData = Course::where('course_slug', $course_id)->first();
        $courses = Course::findOrFail($courseData->id);

        $Courseitem = $courses->courseItem()->where('status', 1)->orderBy("course_order", 'ASC')->get();

        $course_fassilities = $courses->courseFassility()->where('status', 1)->orderBy("fassility_order", 'ASC')->get();

        $course_members = $courses->courseMember()->where('status', 1)->orderBy("member_id", 'ASC')->get();

        $course_title = $courses->course_title;
        $page_content = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$course_title]);

        $moreCourses = Course::where('id', '!=', $course_id)->where('status', 1)->get();

        return view('frontend.theme.clasic.academic_training.course_details.course_details', compact('courses', 'page_content', 'Courseitem', 'course_fassilities', 'course_members', 'moreCourses'));
    }
}
