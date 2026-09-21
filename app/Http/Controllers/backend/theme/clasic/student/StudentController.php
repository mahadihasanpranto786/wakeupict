<?php

namespace App\Http\Controllers\backend\theme\clasic\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\AdmitedStudent;
use App\model\Batch;
use App\model\Course;
use App\model\Income;
use Intervention\Image\Facades\Image;
use App\model\Student;
use App\model\StudentPayment;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    //******************************************************* batch curd start************************************************ */
    //batch index

    function indexBatch()
    {
        
        $courses = Course::latest()->where('status', 1)->get();
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $batches = Batch::latest()
                    ->with('course')
                    ->where(["status"=> 1, 'batch_type'=> 'Local'])
                    ->get();
        } 
        elseif ($user->excess_type == 2) {
            $batches = Batch::latest()
                    ->with('course')
                    ->where(["status"=> 1, 'batch_type'=> 'Global'])
                    ->get();
        }
        else {
            $batches = Batch::latest()->with('course')->where('status', 1)->get();
        }
        return view('backend.theme.clasic.student.batch.batch', compact('batches','courses'));
    }
    //store student batch

    function storeBatch(Request $request)
    {
        
        $request->validate([
            'batch_number' => 'required',
            'course_id' => 'required',
            'batch_type' => 'required',
            'title_id' => 'required',
        ], [
            'batch_number.required' => 'Please Enter This Field!',
            'course_id.required' => 'Please Enter This Field!',
            'batch_type.required' => 'Please Enter This Field!',
            'title_id.required' => 'Please Enter This Field!',
        ]);

        $batch_id = $request->batch_id;
        if ($batch_id) {

            Batch::findOrFail($batch_id)->update([
                'batch_number' => $request->batch_number,
                'course_id' => $request->course_id,
                'batch_type' => $request->batch_type,
                'title_id' => $request->title_id,
                'active_batch' => 1,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);


            $notification = ([
                'success' => 'Batch Updated Successfully',
            ]);
            return redirect()->route('batch-list')->with($notification);
        } else {
            Batch::insert([
                'batch_number' => $request->batch_number,
                'course_id' => $request->course_id,
                'batch_type' => $request->batch_type,
                'title_id' => $request->title_id,
                'active_batch' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);


            $notification = ([
                'success' => 'Batch Created Successfully',
            ]);
            return redirect()->route('batch-list')->with($notification);
        }
    }

    //delete batch

    function deleteBatch($batch_id)
    {

        Batch::findOrFail($batch_id)->update(['status'=> 0]);

        return redirect()->route('batch-list');
    }

    //inactive batch

    function inactiveBatch($batch_id)
    {
        Batch::findOrFail($batch_id)->update(["active_batch" => 0]);

        return redirect()->route('batch-list');
    }


    //active batch

    function activeBatch($batch_id)
    {
        Batch::findOrFail($batch_id)->update(["active_batch" => 1]);

        return redirect()->route('batch-list');
    }


    //******************************************************* batch curd end************************************************ */


    //******************************************************* student curd start************************************************ */

    //insert student

    function insertStudent()
    {
        $notification = 0;
        $courses = Course::latest()->get();
        $batches = Batch::where("active_batch", 1)->where('status', 1)->get();
        return view('backend.theme.clasic.student.student_insert', compact('courses', 'batches', 'notification'));
    }

    // store student

    function storeStudent(Request $request)
    {

        $request->validate([
            'student_name' => 'required',
            'batch_id' => 'required',
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
            'student_photo' => 'required',
        ], [
            'student_name.required' => 'Please Enter This Field!',
            'batch_id.required' => 'Please Enter This Field!',
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
            'student_photo.required' => 'Please Enter This Field!',
        ]);

        $image = $request->file('student_photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(180, 250)->save('public/uploads/student/images/' . $name_gen);
        $save_url = 'public/uploads/student/images/' . $name_gen;


        Student::insert([
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
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
            'student_photo' => $save_url,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Student Registered Successfully',
        ]);
        return redirect()->route('students-list')->with($notification);
    }

    // course fee ajax 

    function courseFeeAjax(Request $request){
        $courseFee =  Course::where("id", $request->course_id)->where("status", 1)->value("price");
        return response()->json($courseFee);
    }

    //search applied student
    function searchAppliedStudent(Request $request){
        $students =  Student::where('personal_call_no', $request->search)->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.student.student_list', compact('students'));
    }




    //student list
    function studentList()
    {
        $students =  Student::latest()->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.student.student_list', compact('students'));
    }
    //student invoice
    function studentPrint($student_id)
    {
        $student = Student::findOrFail($student_id);
        return view('backend.theme.clasic.student.student_invoice', compact('student'));
    }
    //student view
    function studentView($student_id)
    {
        $student = Student::findOrFail($student_id);
        return view('backend.theme.clasic.student.student_view', compact('student'));
    }

    //edit student
    function editStudent($student_id)
    {
        $courses = Course::latest()->where('status', 1)->get();
        $batches = Batch::where("active_batch", 1)->where('status', 1)->get();
        $student = Student::findOrFail($student_id);
        return view('backend.theme.clasic.student.student_edit', compact('student', 'batches', 'courses'));
    }

    //delete student
    function deleteStudent($student_id)
    {
        $student = Student::findOrFail($student_id)->update(['status'=> 0]);

        return redirect()->back();
    }
    //update student
    function updateStudent(Request $request)
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
        $studnet_id =  $request->id;

        Student::findOrFail($studnet_id)->update([
            'course_id' => $request->course_id,
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


            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Student Updated Successfully',
        ]);
        return redirect()->route('students-list')->with($notification);
    }



    //******************************************************* student curd end************************************************ */

    //******************************************************* student search start************************************************ */

    function searchStudent(Request $request)
    {
        $phone = $request->search;
        $courses = Course::latest()->get();
        $batches = Batch::where("active_batch", 1)->where('status', 1)->get();
        $student = Student::where('personal_call_no', $phone)->first();
        if ($student == null) {
            $notification = 1;
            $courses = Course::latest()->get();
            $batches = Batch::where("active_batch", 1)->where('status', 1)->get();
            return view('backend.theme.clasic.student.student_insert', compact('courses', 'batches', 'notification'));
        } else {
            $notification = 1;
            return view('backend.theme.clasic.student.registered_student', compact('student', 'batches', 'courses', 'notification'));
        }
    }

    //admitted student details 
    function admittedStudentDetails(Request $request){
        $batch = Batch::findOrFail($request->batchId);
        if (user(Auth::id()) == 1) {
            $admittedStudents = AdmitedStudent::where([
                "batch_id" => $request->batchId,
                'course_id'=> $request->course_id,
                'student_type' => 'Local'
                 ])->get();
        }
        elseif(user(Auth::id()) == 2) {
            $admittedStudents = AdmitedStudent::where([
                "batch_id" => $request->batchId,
                'course_id'=> $request->course_id,
                'student_type' => 'Global'
                 ])->get();
        }
        else {
            $admittedStudents = AdmitedStudent::where([
                "batch_id" => $request->batchId,
                'course_id'=> $request->course_id,
                 ])->get();
        }
        
       
        $courseAfterDiscount = 0;
        $totalstudentPayment = 0;
        foreach ($admittedStudents as $student) {
            $courseAfterDiscount += $student->course_after_discount;
            $studentPayments = StudentPayment::where("student_id", $student->id)->get();
            foreach ($studentPayments as $payment) {
                $totalstudentPayment += (int)$payment->paid - (int)$payment->return_money;
            }
        }
        $course = Course::findOrFail($batch->course_id);
        $data =[
            'batchNong' => $batch->batch_number,
            'courseName'=> $course->course_title,
            'total_course_after_discount' => $courseAfterDiscount,
            'totalStudent' => count($admittedStudents),
            'totalPaid' => $totalstudentPayment,
            'totalDue' => $courseAfterDiscount - $totalstudentPayment,
        ];
        return response()->json($data);
    }


    //******************************************************* student search end************************************************ */


    //******************************************************* admited student start************************************************* */
    function registerStudent(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'course_fee' => 'required',
            'course_after_discount' => 'required',
            'batch_id' => 'required',
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
            'course_fee.required' => 'Please Enter This Field!',
            'course_after_discount.required' => 'Please Enter This Field!',
            'batch_id.required' => 'Please Enter This Field!',
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
        $save_url = $request->oldImg;
        if ($request->student_photo != null) {
            $image = $request->file('student_photo');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(180, 250)->save('public/uploads/student/images/' . $name_gen);
            $save_url = 'public/uploads/student/images/' . $name_gen;
        }
 
        
        $existsStudent =  Student::where("personal_call_no", $request->personal_call_no)->where('status', 1)->first();
        if (empty($existsStudent)) {
        Student::insert([
            'course_id' => $request->course_id,
            'course_fee' => $request->course_fee,
            'batch_id' => $request->batch_id,
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
            'student_photo' => $save_url,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        }
        if (!empty($request->discount_amount)) {
            $discount_amount = $request->discount_amount;
        } else {
            $discount_amount = 0;
        }

        $batch =  Batch::findOrFail($request->batch_id);
        AdmitedStudent::insert([
            'course_id' => $request->course_id,
            'course_fee' => $request->course_fee,
            'course_after_discount' => $request->course_after_discount,
            'discount_amount' => $discount_amount,
            'batch_id' => $request->batch_id,
            'student_type' => $batch->batch_type,
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
            'student_photo' => $save_url,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

     

        $notification = ([
            'success' => 'Student Registered Successfully',
        ]);
        return redirect()->route('admited-students-list')->with($notification);
    }


    //admited student index

    function admitedStudentIndex()
    {
        
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $students =  AdmitedStudent::orderBy('id', 'desc')
            ->where(['status'=> 1, 'student_type'=> 'Local'])
            ->paginate(10);
        } 
        elseif ($user->excess_type == 2) {
            $students =  AdmitedStudent::orderBy('id', 'desc')
            ->where(['status'=> 1, 'student_type'=> 'Global'])
            ->paginate(10);
        }
        else {
            $students =  AdmitedStudent::orderBy('id', 'desc')->where('status', 1)->paginate(10);
        }
        return view('backend.theme.clasic.student.admited_student_list', compact('students'));
    }

    //edit admited student

    function admitedStudentEdit($student_id)
    {

        $courses = Course::latest()->get();
        $batches = Batch::where("active_batch", 1)->where('status', 1)->get();
        $student = AdmitedStudent::findOrFail($student_id);
        return view('backend.theme.clasic.student.admited_student_edit', compact('student', 'batches', 'courses'));
    }

    function updateAdmitedStudent(Request $request)
    {

        
        $request->validate([
            'student_name' => 'required',
            'course_fee' => 'required',
            'course_after_discount' => 'required',
            'discount_amount' => 'required',
            'batch_id' => 'required',
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
            'course_fee.required' => 'Please Enter This Field!',
            'course_after_discount.required' => 'Please Enter This Field!',
            'discount_amount.required' => 'Please Enter This Field!',
            'batch_id.required' => 'Please Enter This Field!',
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
     


        $studnet_id =  $request->id;
        $student = AdmitedStudent::findOrFail($studnet_id)->student_photo;
        $save_url = $student;
        if ($request->file('student_photo')) {
            $old_image = $request->oldImg;
            File::delete($old_image);
            $image = $request->file('student_photo');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(180, 250)->save('public/uploads/student/images/' . $name_gen);
            $save_url = 'public/uploads/student/images/' . $name_gen;
        }

        $batch =  Batch::findOrFail($request->batch_id);

        AdmitedStudent::findOrFail($studnet_id)->update([
            'course_id' => $request->course_id,
            'course_fee' => $request->course_fee,
            'course_after_discount' => $request->course_after_discount,
            'discount_amount' => $request->discount_amount,
            'student_name' => $request->student_name,
            'batch_id' => $request->batch_id,
            'student_type' => $batch->batch_type,
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
            'student_photo' => $save_url,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Admited Student Updated Successfully',
        ]);
        return redirect()->route('admited-students-list')->with($notification);
    }

    //delete admited student


    //delete student
    function deleteAdmitedStudent($student_id)
    {
        $studentPayments = StudentPayment::where("student_id",$student_id)->get();
        if (count($studentPayments) > 0) {   
            foreach ($studentPayments as $payment) {
                Income::findOrFail($payment->income_id)->update(['status'=> 0]);
                $payment->update(['status'=> 0]);
            }
        }
        $student = AdmitedStudent::findOrFail($student_id)->update(['status'=> 0]);
        return redirect()->back();
    
    }

    //admited student view
    function studentAdmitedView($student_id)
    {
        $student = AdmitedStudent::findOrFail($student_id);
        return view('backend.theme.clasic.student.student_view', compact('student'));
    }
    //admited student invoice
    function studentAdmitedPrint($student_id)
    {
        $student = AdmitedStudent::findOrFail($student_id);
        return view('backend.theme.clasic.student.admitted-student-print', compact('student'));
    }

    //search admitted student 
    function searchAdmittedStudent(Request $request){
        $searchNumber= $request->search;
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            
            $students =  AdmitedStudent::where('personal_call_no', $request->search)
            ->where(['status'=> 1, 'student_type'=> 'Local'])
            ->paginate(10);

        }
        elseif ($user->excess_type == 2) {
            $students =  AdmitedStudent::where('personal_call_no', $request->search)
            ->where(['status'=> 1, 'student_type'=> 'Global'])
            ->paginate(10);
        }
         else {
            $students =  AdmitedStudent::where('personal_call_no', $request->search)
            ->where('status', 1)->paginate(10);
        }
        
        return view('backend.theme.clasic.student.admited_student_list', compact('students', 'searchNumber'));
    }


    // student payment with list
    function batchWiseStudent(Request $request){
        $batch = Batch::findOrFail($request->batch_id);
        
        if (user(Auth::id()) == 1) {
            $admittedStudents = AdmitedStudent::where([
                "batch_id" => $request->batch_id,
                'course_id'=> $request->course_id,
                'student_type'=> 'Local',
                ])->get();
        }
        elseif (user(Auth::id()) == 2) {
            $admittedStudents = AdmitedStudent::where([
                "batch_id" => $request->batch_id,
                'course_id'=> $request->course_id,
                'student_type'=> 'Global',
                ])->get();
        }
         else {  
          $admittedStudents = AdmitedStudent::where([
            "batch_id" => $request->batch_id,
            'course_id'=> $request->course_id
            ])->get();
        }
      
        $courseAfterDiscount = 0;
        $totalstudentPayment = 0;
        foreach ($admittedStudents as $student) {
            $courseAfterDiscount += $student->course_after_discount;
            $studentPayments = StudentPayment::where("student_id", $student->id)->get();
            foreach ($studentPayments as $payment) {
                $totalstudentPayment += (int)$payment->paid - (int)$payment->return_money;
            }
        }
        $course = Course::findOrFail($batch->course_id);
        $studentInfo =[
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'batchNong' => $batch->batch_number,
            'courseName'=> $course->course_title,
            'total_course_after_discount' => $courseAfterDiscount,
            'totalStudent' => count($admittedStudents),
            'totalPaid' => $totalstudentPayment,
            'totalDue' => $courseAfterDiscount - $totalstudentPayment,
        ];

        if (user(Auth::id()) == 1) {

            $students =  AdmitedStudent::with('batch', 'course')
            ->where([
                'course_id' => $request->course_id,
                'batch_id'=> $request->batch_id,
                'student_type'=> 'Local',
                ])
            ->where('status', 1)
            ->paginate(10);

        }
        elseif (user(Auth::id()) == 2) {

            $students =  AdmitedStudent::with('batch', 'course')
            ->where([
                'course_id' => $request->course_id,
                'batch_id'=> $request->batch_id,
                'student_type'=> 'Global',
                ])
            ->where('status', 1)
            ->paginate(10);

        }
         else {  

            $students =  AdmitedStudent::with('batch', 'course')
            ->where(['course_id' => $request->course_id, 'batch_id'=> $request->batch_id])
            ->where('status', 1)
            ->paginate(10);

        }
         return view('backend.theme.clasic.student.batch_and_course_admited_student_list', compact('students','studentInfo'));
          
           
    }

    // course wise batch
    function courseWiseBatchAjax(Request $request){
        
        if (user(Auth::id()) == 1) {

            $batches =  Batch::with('course')
            ->where([
                "course_id"=> $request->courseId,
                'status'=> 1,
                'batch_type'=> 'Local',
                ])
            ->get();
        }
         elseif (user(Auth::id()) == 2) {
            $batches =  Batch::with('course')
            ->where([
                "course_id"=> $request->courseId,
                'status'=> 1,
                'batch_type'=> 'Global',
                ])
            ->get();
        }
        else {
            $batches =  Batch::with('course')
            ->where("course_id", $request->courseId)
            ->where('status', 1)
            ->get();
          }
     
        return response()->json($batches);
    }

    //print all student 
    function printAllStudent(){
        
        if (user(Auth::id()) == 1) {
            $students=  AdmitedStudent::orderBy("id", 'desc')
            ->where("status", 1)
            ->where("student_type", 'Local')
            ->get();
        }
         elseif (user(Auth::id()) == 2) {
            $students=  AdmitedStudent::orderBy("id", 'desc')
            ->where("status", 1)
            ->where("student_type", 'Global')
            ->get();
        }
        else {
            $students=  AdmitedStudent::orderBy("id", 'desc')
            ->where("status", 1)
            ->get();
        }
       return view('backend.theme.clasic.student.printStudentInfo', compact('students'));
    }

    //print searched student
    function printSearchedStudent($studend_number){
        if (user(Auth::id()) == 1) {
            $students=  AdmitedStudent::where('personal_call_no',$studend_number)
            ->where("status", 1)
            ->where("student_type", 'Local')
            ->orderBy("id", 'desc')->get();
        }
        elseif (user(Auth::id()) == 2) {
            $students=  AdmitedStudent::where('personal_call_no',$studend_number)
            ->where("status", 1)
            ->where("student_type", 'Global')
            ->orderBy("id", 'desc')->get();
        }
        else {
            $students=  AdmitedStudent::where('personal_call_no',$studend_number)
                        ->where("status", 1)
                        ->orderBy("id", 'desc')->get();
        }
        
        return view('backend.theme.clasic.student.printStudentInfo', compact('students'));
    }

    // course and batch wise student print
    function courseAndBatchWiseStudentPrint(Request $request){
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $students=  AdmitedStudent::where([
            'course_id'=>$request->course_id,
            'batch_id'=>$request->batch_id,
            'student_type'=> 'Local',
            "status"=> 1
            ])
            ->orderBy("id", 'desc')
            ->get();
        }
         elseif ($user->excess_type == 2) {
            $students=  AdmitedStudent::where([
            'course_id'=>$request->course_id,
            'batch_id'=>$request->batch_id,
            'student_type'=> 'Global',
            "status"=> 1
            ])
            ->orderBy("id", 'desc')
            ->get();
        }
        else {
            $students=  AdmitedStudent::where([
            'course_id'=>$request->course_id,
            'batch_id'=>$request->batch_id,
            "status"=> 1
            ])
            ->orderBy("id", 'desc')
            ->get();
          }
        
        return view('backend.theme.clasic.student.printStudentInfo', compact('students'));
    }
    //******************************************************* admited student end************************************************* */

    //*******************************************************  student payment start************************************************* */

    function studentPayment($student_id){

        $student = AdmitedStudent::findOrFail($student_id);
        return view('backend.theme.clasic.student.payment.student_payment', compact('student'));
    }
    // student payment
    function studentPaymentStore(Request $request){

        $request->validate([
            'date' => 'required',
            'remark' => 'required',
            'amount' => 'required',
        ], [
            'date.required' => 'Please Enter This Field!',
            'remark.required' => 'Please Enter This Field!',
            'amount.required' => 'Please Enter This Field!',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        $income_id =  Income::insertGetId([
            'title_id' => $batch->title_id, //dynamic category
            'title' => "Student Admission Fee",
            'income_type' => $batch->batch_type, //category type
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        StudentPayment::create([
            'income_id' => $income_id,
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'mobile' => $request->mobile,
            'date' => $request->date,
            'remark' => $request->remark,
            'paid' => $request->amount,
            'created_by' => Auth::id(),
        ]);


        $notification = ([
            'success' => 'Student Paid Successfully',
        ]);
        return redirect()->route('admited-students-list')->with($notification);
    }

    //paid details 
    function paidDetails($student_id){
        $paymentDetails = StudentPayment::with('batch')
                        ->with('student')->with('batch')
                        ->where("student_id", $student_id)
                        ->where("status", 1)->orderBy('id', 'desc')
                        ->paginate(10);
        return view('backend.theme.clasic.student.payment.payment_details', compact('paymentDetails'));
    }
    //payment edit

    function student_payment_update(Request $request){
        $request->validate([
            'date' => 'required',
            'remark' => 'required',
            'amount' => 'required',
        ], [
            'date.required' => 'Please Enter This Field!',
            'remark.required' => 'Please Enter This Field!',
            'amount.required' => 'Please Enter This Field!',
        ]);
        $paymentMoney =  StudentPayment::findOrFail($request->id);
        $returnTotal = (int)$paymentMoney->return_money;
        $haveMoney =  (int)$request->amount - (int)$returnTotal;
        $batch = Batch::findOrFail($paymentMoney->batch_id);
        

        if ($haveMoney > 0 || $haveMoney == 0) { 

        $income_id =  StudentPayment::where("id", $request->id)->select("income_id")->first();
         Income::findOrFail($income_id->income_id)->update([
            'title_id' => $batch->title_id, //dynamic category
            'title' => "Student Admission Fee",
            'income_type' => $batch->batch_type, // category type
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $haveMoney,
            'status' => 1,
        ]);

        StudentPayment::findOrFail($request->id)->update([
            'date' => $request->date,
            'remark' => $request->remark,
            'paid' => $request->amount,
            'created_by' => Auth::id(),
        ]);
        } else {
            $notification = ([
                'error' => 'Please Check The Paid Money First!',
            ]);
            return redirect()->back()->with($notification);
        }

        $notification = ([
            'success' => 'Payment Updated Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    // student payment delete
    function paymentDelete($payment_id){
        $student = StudentPayment::findOrFail($payment_id);
        $income = Income::findOrFail($student->income_id);
        if ($income) {
            $income->update(['status'=> 0]);
            $student->update(['status'=> 0]);
        } else {
            $student->update(['status'=> 0]);
        }
        return redirect()->back();
    }
    //student payment view
    function studentPaymentView($payment_id){
        $payment = StudentPayment::with('course')->with('student')->findOrFail($payment_id);
        $previousPaid = StudentPayment::where('id', '<', $payment->id)
                    ->where('student_id', $payment->student_id)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->limit(1)
                    ->first();
        if ($previousPaid == null) {
            return view('backend.theme.clasic.student.payment.payment_view', compact('payment'));
        } else {
            return view('backend.theme.clasic.student.payment.repayment_view', compact('payment'));
        }
        
    }

    //admitted student inactive with delete this student all payment
    function admittedStudentInactive($student_id){
        $payments = StudentPayment::where('student_id',$student_id)->get();
        foreach($payments as $payment){
            dd($payment);
        }
        // $income = Income::findOrFail($student->income_id);
        // if ($income) {
        //     $income->update(['status'=> 0]);
        //     $student->update(['status'=> 0]);
        // } else {
        //     $student->update(['status'=> 0]);
        // }
        // return redirect()->back();
    }

    // active admitted student 
    function admittedStudentActive($student_id){
        dd( 'admitted student_id' );
    }

    // return money of the student
    function student_payment_return(Request $request){
                               
        $validator = Validator::make($request->all(), [
            'return_date' => 'required',
            'return_money' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }
        
        $paymentMoney =  StudentPayment::findOrFail($request->id);
        $returnTotal = (int)$paymentMoney->return_money + (int)$request->return_money;
        $haveMoney =  (int)$paymentMoney->paid - (int)$returnTotal;
       
        if ($haveMoney > 0 || $haveMoney == 0) { 
             Income::findOrFail($paymentMoney->income_id)->update([
            'amount' => $haveMoney,
            ]);
            StudentPayment::findOrFail($request->id)->update([
                'return_date' => $request->return_date,
                'return_money' => $returnTotal,
                'return_reason' => $request->return_reason,
            ]);
        } else {
            $notification = ([
                'error' => 'Please Check The Paid Money First!',
            ]);
            return redirect()->back()->with($notification);
        }
        
        return redirect()->back();
    }


    //*******************************************************  student payment end************************************************* */

}