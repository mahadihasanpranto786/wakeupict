<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class StudentProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Show student profile view
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $studentMaster = $student->student ?: \App\model\Student::where('personal_call_no', $student->phone)->first();
        $admitted = $student->admitedStudent ?: \App\model\AdmitedStudent::where('personal_call_no', $student->phone)->first();
        $courses = $student->full_courses_list;
        $enrollments = $student->enrollments()->with(['course', 'batch'])->latest()->get();
        return view('frontend.theme.clasic.student.profile.index', compact('student', 'studentMaster', 'admitted', 'courses', 'enrollments'));
    }

    /**
     * Show student profile edit form
     */
    public function edit()
    {
        $student = Auth::guard('student')->user();
        $studentMaster = $student->student ?: \App\model\Student::where('personal_call_no', $student->phone)->first();
        $admitted = $student->admitedStudent ?: \App\model\AdmitedStudent::where('personal_call_no', $student->phone)->first();
        return view('frontend.theme.clasic.student.profile.edit', compact('student', 'studentMaster', 'admitted'));
    }

    /**
     * Update student profile details & other background information
     */
    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:student_accounts,email,' . $student->id,
            'phone' => 'required|string|max:25|unique:student_accounts,phone,' . $student->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'fathers_name' => 'nullable|string|max:191',
            'mothers_name' => 'nullable|string|max:191',
            'gander' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:50',
            'national_id_no' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'age' => 'nullable|string|max:50',
            'educational_qualification' => 'nullable|string|max:191',
            'result' => 'nullable|string|max:50',
            'passing_year' => 'nullable|string|max:20',
            'present_address' => 'nullable|string|max:500',
            'permanent_address' => 'nullable|string|max:500',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email ? strtolower(trim($request->email)) : null,
            'phone' => trim($request->phone),
        ];

        // Process avatar upload
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $uploadDir = public_path('uploads/student/avatars');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $fileName = hexdec(uniqid()) . '.' . $avatarFile->getClientOriginalExtension();
            $destinationPath = $uploadDir . '/' . $fileName;

            Image::make($avatarFile)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath);

            $updateData['avatar'] = 'public/uploads/student/avatars/' . $fileName;
        }

        // Additional profile meta stored directly on student account
        $meta = is_array($student->meta) ? $student->meta : [];
        $meta['fathers_name'] = $request->fathers_name;
        $meta['mothers_name'] = $request->mothers_name;
        $meta['gander'] = $request->gander;
        $meta['nationality'] = $request->nationality ?: 'Bangladeshi';
        $meta['national_id_no'] = $request->national_id_no;
        $meta['religion'] = $request->religion;
        $meta['occupation'] = $request->occupation;
        $meta['age'] = $request->age;
        $meta['educational_qualification'] = $request->educational_qualification;
        $meta['result'] = $request->result;
        $meta['passing_year'] = $request->passing_year;
        $meta['present_address'] = $request->present_address;
        $meta['permanent_address'] = $request->permanent_address;
        $updateData['meta'] = $meta;

        $student->update($updateData);

        // Common details payload for student master and admitted records
        $commonData = [
            'student_name' => $request->name,
            'email' => $request->email ?: '',
            'personal_call_no' => $request->phone,
            'fathers_name' => $request->fathers_name ?: '',
            'mothers_name' => $request->mothers_name ?: '',
            'gander' => $request->gander ?: 'other',
            'nationality' => $request->nationality ?: 'Bangladeshi',
            'national_id_no' => $request->national_id_no ?: '',
            'religion' => $request->religion ?: 'Islam',
            'occupation' => $request->occupation ?: 'Student',
            'age' => $request->age ?: '',
            'educational_qualification' => $request->educational_qualification ?: '',
            'result' => $request->result ?: '',
            'passing_year' => $request->passing_year ?: '',
            'present_address' => $request->present_address ?: '',
            'permanent_address' => $request->permanent_address ?: '',
        ];
        if (isset($updateData['avatar'])) {
            $commonData['student_photo'] = $updateData['avatar'];
        }

        // Sync with parent Student master record
        $studentMaster = $student->student ?: \App\model\Student::where('personal_call_no', $student->phone)->first();
        if ($studentMaster) {
            $studentMaster->update($commonData);
            if (!$student->student_id) {
                $student->update(['student_id' => $studentMaster->id]);
            }
        }

        // Sync with linked admitted student record if present
        $admitted = $student->admitedStudent ?: \App\model\AdmitedStudent::where('personal_call_no', $student->phone)->first();
        if ($admitted) {
            $admitted->update($commonData);
            if (!$student->admited_student_id) {
                $student->update(['admited_student_id' => $admitted->id]);
            }
        }

        return redirect()->route('student.profile.index')->with([
            'success' => 'Your profile and additional information have been successfully updated.',
        ]);
    }

    /**
     * Update student password
     */
    public function updatePassword(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Please enter your current password.',
            'password.min' => 'New password must be at least 6 characters.',
            'password.confirmed' => 'New password confirmation does not match.',
        ]);

        if (!Hash::check($request->current_password, $student->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match our records.']);
        }

        $student->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('student.profile.index')->with([
            'success' => 'Your password has been changed successfully.',
        ]);
    }
}
