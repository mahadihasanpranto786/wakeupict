<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\model\Student;
use App\model\StudentAccount;
use App\model\Course;
use App\model\CourseFassility;
use App\model\CourseMember;
use App\model\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function addstudent($course_slug)
    {
        $decoded = urldecode($course_slug);
        $normalizedSlug = str_replace(' ', '-', strtolower(trim($decoded)));

        $course = null;
        if (is_numeric($course_slug)) {
            $course = Course::find((int)$course_slug);
        }

        if (!$course) {
            $course = Course::where('course_slug', $course_slug)
                ->orWhere('course_slug', $normalizedSlug)
                ->orWhere('course_slug', 'like', '%' . $normalizedSlug . '%')
                ->first();
        }

        if (!$course) {
            $course = Course::where('course_title', 'like', '%' . $decoded . '%')->first();
        }

        // If still not found, check partial key words (e.g. microsoft-office)
        if (!$course) {
            if (strpos($normalizedSlug, 'office') !== false || strpos($normalizedSlug, 'microsoft') !== false) {
                $course = Course::where('course_slug', 'microsoft-office-course-bteb')->first();
            }
        }

        // Fallback to first active course to avoid breaking user experience
        if (!$course) {
            $course = Course::where('status', 1)->firstOrFail();
        }


        $allCourses = Course::where('status', 1)->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC')->get();
        $page_content  = Page::where('page_name', '=', 'Student Registration page')->get();
        $Courseitem = $course->courseItem()->where('status', 1)->orderBy("course_order", 'ASC')->get();
        $course_fassilities = $course->courseFassility()->where('status', 1)->orderBy("fassility_order", 'ASC')->get();
        $course_members = $course->courseMember()->where('status', 1)->orderBy("member_id", 'ASC')->get();

        return view('frontend.theme.clasic.student.student_registration', compact('course', 'allCourses', 'page_content', 'course_members', 'course_fassilities'));
    }

    public function storeStudnet(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'gander' => 'required|string|max:50',
            'date_of_birth' => 'nullable|date',
            'fathers_name' => 'required|string|max:255',
            'mothers_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:100',
            'national_id_no' => 'required|string|max:100',
            'present_address' => 'required|string',
            'permanent_address' => 'required|string',
            'personal_call_no' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'religion' => 'required|string|max:100',
            'occupation' => 'required|string|max:100',
            'age' => 'required|string|max:20',
            'rules_agreed' => 'required|accepted',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'student_name.required' => 'Student name is mandatory.',
            'gander.required' => 'Please select your gender.',
            'fathers_name.required' => 'Father\'s name is mandatory.',
            'mothers_name.required' => 'Mother\'s name is mandatory.',
            'nationality.required' => 'Nationality is mandatory.',
            'national_id_no.required' => 'National ID or Birth Certificate number is required.',
            'present_address.required' => 'Present address is required.',
            'permanent_address.required' => 'Permanent address is required.',
            'personal_call_no.required' => 'Student mobile number is required for portal account access.',
            'email.required' => 'A valid email address is required.',
            'religion.required' => 'Religion is required.',
            'occupation.required' => 'Occupation is required.',
            'age.required' => 'Age is required (calculated from Date of Birth).',
            'rules_agreed.accepted' => 'You must read and accept the Academy Rules & Regulations before submitting.',
        ]);

        // 1. Process Student Photo
        $save_photo_url = null;
        if ($request->hasFile('student_photo')) {
            $imageDir = public_path('uploads/student/images');
            if (!File::exists($imageDir)) {
                File::makeDirectory($imageDir, 0755, true, true);
            }

            $image = $request->file('student_photo');
            $filename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            try {
                Image::make($image)->resize(300, 350, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($imageDir . '/' . $filename);
                $save_photo_url = 'public/uploads/student/images/' . $filename;
            } catch (\Exception $e) {
                // Fallback direct move if Intervention fails on raw stream
                $image->move($imageDir, $filename);
                $save_photo_url = 'public/uploads/student/images/' . $filename;
            }
        }

        // 2. Process Educational Qualifications Repeater
        $qualifications = [];
        $degrees = $request->input('degrees', []);
        $boards = $request->input('boards', []);
        $results = $request->input('results', []);
        $years = $request->input('passing_years', []);

        if (is_array($degrees) && count($degrees) > 0) {
            foreach ($degrees as $idx => $deg) {
                if (!empty($deg)) {
                    $qualifications[] = [
                        'degree' => trim($deg),
                        'board_university' => trim($boards[$idx] ?? ''),
                        'result' => trim($results[$idx] ?? ''),
                        'passing_year' => trim($years[$idx] ?? ''),
                    ];
                }
            }
        }

        $primaryDegree = !empty($qualifications) ? $qualifications[0]['degree'] : ($request->input('educational_qualification') ?? 'N/A');
        $primaryResult = !empty($qualifications) ? $qualifications[0]['result'] : ($request->input('result') ?? 'N/A');
        $primaryYear = !empty($qualifications) ? $qualifications[0]['passing_year'] : ($request->input('passing_year') ?? 'N/A');

        // 3. Process Selected Courses
        $selectedCourseIds = $request->input('selected_courses', []);
        if (empty($selectedCourseIds) && $request->filled('course_id')) {
            $selectedCourseIds = [(int)$request->course_id];
        }

        $selectedCoursesData = [];
        $totalCalculatedFee = 0;
        if (!empty($selectedCourseIds)) {
            $fetchedCourses = Course::whereIn('id', $selectedCourseIds)->get();
            foreach ($fetchedCourses as $fc) {
                $feeVal = is_numeric($fc->price) ? (float)$fc->price : (float)preg_replace('/[^\d.]/', '', (string)$fc->price);
                $totalCalculatedFee += $feeVal;
                $selectedCoursesData[] = [
                    'id' => $fc->id,
                    'title' => $fc->course_title,
                    'price' => $fc->price,
                ];
            }
        }

        $primaryCourseId = !empty($selectedCourseIds) ? $selectedCourseIds[0] : (int)$request->input('course_id', 1);
        $finalFee = $totalCalculatedFee > 0 ? (string)$totalCalculatedFee : (string)$request->input('course_fee', 0);

        // 4. Process Dynamic Attachments
        $attachmentsData = [];
        $attTitles = $request->input('attachment_titles', []);
        $attFiles = $request->file('attachment_files', []);

        if (is_array($attFiles) && count($attFiles) > 0) {
            $attDir = public_path('uploads/student/attachments');
            if (!File::exists($attDir)) {
                File::makeDirectory($attDir, 0755, true, true);
            }

            foreach ($attFiles as $key => $file) {
                if ($file && $file->isValid()) {
                    $attFileName = hexdec(uniqid()) . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                    $file->move($attDir, $attFileName);
                    $attachmentsData[] = [
                        'title' => trim($attTitles[$key] ?? 'Attachment ' . ($key + 1)),
                        'path' => 'public/uploads/student/attachments/' . $attFileName,
                        'original_name' => $file->getClientOriginalName(),
                    ];
                }
            }
        }

        // 5. Insert Student Admission Record
        $studentNameUpper = mb_strtoupper(trim($request->student_name));

        $studentId = Student::insertGetId([
            'course_id' => $primaryCourseId,
            'course_fee' => $finalFee,
            'selected_courses' => !empty($selectedCoursesData) ? json_encode($selectedCoursesData, JSON_UNESCAPED_UNICODE) : null,
            'student_name' => $studentNameUpper,
            'gander' => $request->gander,
            'date_of_birth' => $request->filled('date_of_birth') ? $request->date_of_birth : null,
            'fathers_name' => $request->fathers_name,
            'mothers_name' => $request->mothers_name,
            'nationality' => $request->nationality,
            'national_id_no' => ($request->filled('id_type') ? '[' . $request->id_type . '] ' : '') . $request->national_id_no,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'personal_call_no' => $request->personal_call_no,
            'guardian_call_no' => $request->guardian_call_no,
            'email' => $request->email,
            'religion' => $request->religion,
            'occupation' => $request->occupation,
            'age' => $request->age,
            'educational_qualification' => $primaryDegree,
            'result' => $primaryResult,
            'passing_year' => $primaryYear,
            'qualifications_data' => !empty($qualifications) ? json_encode($qualifications, JSON_UNESCAPED_UNICODE) : null,
            'student_photo' => $save_photo_url,
            'attachments_data' => !empty($attachmentsData) ? json_encode($attachmentsData, JSON_UNESCAPED_UNICODE) : null,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 6. Automatically Provision Student LMS Account using Student Phone Number
        $cleanPhone = preg_replace('/[^\d]/', '', (string)$request->personal_call_no);
        $lastDigits = strlen($cleanPhone) >= 6 ? substr($cleanPhone, -6) : '123456';
        $tempPassword = $lastDigits;

        $studentAccount = StudentAccount::where('phone', $request->personal_call_no)
            ->orWhere('phone', $cleanPhone)
            ->orWhere('email', $request->email)
            ->first();

        $accountCreated = false;
        if (!$studentAccount) {
            $studentAccount = StudentAccount::create([
                'name' => $studentNameUpper,
                'email' => $request->email,
                'phone' => $request->personal_call_no,
                'password' => Hash::make($lastDigits),
                'avatar' => $save_photo_url,
                'status' => 1,
                'meta' => [
                    'registered_from' => 'online_admission_form',
                    'student_record_id' => $studentId,
                    'temp_initial_pass' => true,
                ],
            ]);
            $accountCreated = true;
        } else {
            // Update password to predictable last 6 digits so applicant is never locked out
            $studentAccount->update([
                'name' => $studentNameUpper,
                'password' => Hash::make($lastDigits),
                'avatar' => $save_photo_url ?: $studentAccount->avatar,
                'status' => 1,
            ]);
            $accountCreated = true;
        }

        $student_name = $studentNameUpper;
        $studentIdCode = $studentAccount ? $studentAccount->student_id_code : null;

        return view('frontend.theme.clasic.student.student_notification', compact(
            'student_name',
            'studentAccount',
            'accountCreated',
            'tempPassword',
            'studentIdCode'
        ));
    }
}
