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
        $admitted = $student->admitedStudent;
        return view('frontend.theme.clasic.student.profile.index', compact('student', 'admitted'));
    }

    /**
     * Show student profile edit form
     */
    public function edit()
    {
        $student = Auth::guard('student')->user();
        $admitted = $student->admitedStudent;
        return view('frontend.theme.clasic.student.profile.edit', compact('student', 'admitted'));
    }

    /**
     * Update student profile details
     */
    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:student_accounts,email,' . $student->id,
            'phone' => 'required|string|max:25|unique:student_accounts,phone,' . $student->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
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

        $student->update($updateData);

        // Sync with linked admitted student record if present
        if ($student->admitedStudent) {
            $admittedData = [
                'student_name' => $request->name,
                'email' => $request->email,
                'personal_call_no' => $request->phone,
            ];
            if (isset($updateData['avatar'])) {
                $admittedData['student_photo'] = $updateData['avatar'];
            }
            if ($request->filled('present_address')) {
                $admittedData['present_address'] = $request->present_address;
            }
            if ($request->filled('permanent_address')) {
                $admittedData['permanent_address'] = $request->permanent_address;
            }
            $student->admitedStudent->update($admittedData);
        }

        return redirect()->route('student.profile.index')->with([
            'success' => 'Your profile has been successfully updated.',
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
