<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\model\Student;
use App\model\Course;
use App\model\CourseFassility;
use App\model\CourseMember;
use App\model\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    function addstudent($course_slug)
    {
        $courseData = DB::table('courses')->where('course_slug', $course_slug)->first();

        $course = Course::findOrFail($courseData->id);

        $page_content  = Page::where('page_name', '=', 'Student Registration page')->get();

        $Courseitem = $course->courseItem()->where('status', 1)->orderBy("course_order", 'ASC')->get();

        $course_fassilities = $course->courseFassility()->where('status', 1)->orderBy("fassility_order", 'ASC')->get();

        $course_members = $course->courseMember()->where('status', 1)->orderBy("member_id", 'ASC')->get();

        return view('frontend.theme.clasic.student.student_registration', compact('course', 'page_content', 'course_members', 'course_fassilities'));
    }

    function storeStudnet(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'gander' => 'required',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'nationality' => 'required',
            'national_id_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'personal_call_no' => 'required',
            'email' => 'required',
            'religion' => 'required',
            'occupation' => 'required',
            'age' => 'required',
            'educational_qualification' => 'required',
            'result' => 'required',
            'passing_year' => 'required',
            // 'student_photo' => 'required',
        ], [
            'student_name.required' => 'Please Enter This Field!',
            'gander.required' => 'Please Enter This Field!',
            'fathers_name.required' => 'Please Enter This Field!',
            'mothers_name.required' => 'Please Enter This Field!',
            'nationality.required' => 'Please Enter This Field!',
            'national_id_no.required' => 'Please Enter This Field!',
            'present_address.required' => 'Please Enter This Field!',
            'permanent_address.required' => 'Please Enter This Field!',
            'personal_call_no.required' => 'Please Enter This Field!',
            'email.required' => 'Please Enter This Field!',
            'religion.required' => 'Please Enter This Field!',
            'occupation.required' => 'Please Enter This Field!',
            'age.required' => 'Please Enter This Field!',
            'educational_qualification.required' => 'Please Enter This Field!',
            'result.required' => 'Please Enter This Field!',
            'passing_year.required' => 'Please Enter This Field!',
            // 'student_photo.required' => 'Please Enter This Field!',
        ]);

        // $image = $request->file('student_photo');
        // $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // Image::make($image)->resize(180, 250)->save('public/uploads/student/images/' . $name_gen);
        // $save_url = 'public/uploads/student/images/' . $name_gen;


        Student::insert([
            'course_id' => $request->course_id,
            'course_fee' => $request->course_fee,
            'student_name' => $request->student_name,
            'gander' => $request->gander,
            'fathers_name' => $request->fathers_name,
            'mothers_name' => $request->mothers_name,
            'nationality' => $request->nationality,
            'national_id_no' => $request->national_id_no,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'personal_call_no' => $request->personal_call_no,
            'email' => $request->email,
            'religion' => $request->religion,
            'occupation' => $request->occupation,
            'age' => $request->age,
            'educational_qualification' => $request->educational_qualification,
            'result' => $request->result,
            'passing_year' => $request->passing_year,
            // 'student_photo' => $save_url,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $student_name = $request->student_name;
        $notification = ([
            'success' => 'Your Form Registered Successfully',
        ]);
        return view('frontend.theme.clasic.student.student_notification', compact('student_name'));
    }
}
