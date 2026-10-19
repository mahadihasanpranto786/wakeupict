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
        $courseData = Course::where('status', 1)->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC')->get();
        $banner = CourseBanner::where('status',1)->where('active_status',1)->first();
        return view('frontend.theme.clasic.academic_training.academic_training', compact('content_list', 'courseData', 'banner'));
    }


    // course details

    function courseDetails($course_id)
    {
        $courses = is_numeric($course_id)
            ? Course::where('id', $course_id)->first()
            : Course::where('course_slug', $course_id)->first();

        if (!$courses) {
            $courses = Course::where('course_slug', $course_id)
                ->orWhere('id', $course_id)
                ->firstOrFail();
        }

        $Courseitem = $courses->courseItem()->where('status', 1)->orderBy("course_order", 'ASC')->get();

        $course_fassilities = $courses->courseFassility()->where('status', 1)->orderBy("fassility_order", 'ASC')->get();

        $course_members = $courses->courseMember()->where('status', 1)->orderBy("member_id", 'ASC')->get();

        $course_title = $courses->course_title;
        $page_content = DB::select('SELECT * FROM `pages` WHERE page_name = ?', [$course_title]);

        $moreCourses = Course::where('id', '!=', $courses->id)->where('status', 1)->get();

        return view('frontend.theme.clasic.academic_training.course_details.course_details', compact('courses', 'page_content', 'Courseitem', 'course_fassilities', 'course_members', 'moreCourses'));
    }
}
