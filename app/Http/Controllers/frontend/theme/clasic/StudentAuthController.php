<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\StudentAccount;
use App\model\AdmitedStudent;
use App\model\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StudentAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    /**
     * Show student login form
     */
    public function showLoginForm()
    {
        return view('frontend.theme.clasic.student.auth.login');
    }

    /**
     * Handle student login submission
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ], [
            'login_id.required' => 'Please enter your Student ID, Email, or Phone number.',
            'password.required' => 'Please enter your password.',
        ]);

        $loginInput = trim($request->input('login_id'));
        $password = $request->input('password');
        $remember = $request->has('remember');

        // Locate student account by Student ID, Email, or Phone
        $student = StudentAccount::where(function ($q) use ($loginInput) {
            $q->where('student_id_code', $loginInput)
              ->orWhere('email', $loginInput)
              ->orWhere('phone', $loginInput);
        })->first();

        if (!$student) {
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'login_id' => 'No student account found matching these credentials.',
            ]);
        }

        if ($student->status != 1) {
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'login_id' => 'Your student account is currently suspended or inactive. Please contact Wake Up ICT administration.',
            ]);
        }

        if (!Hash::check($password, $student->password)) {
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'password' => 'Incorrect password. Please try again or reset your password.',
            ]);
        }

        // Login via student guard
        Auth::guard('student')->login($student, $remember);

        // Update login audit timestamp and IP
        $student->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip' => $request->ip(),
        ]);

        return redirect()->intended(route('student.dashboard'))->with([
            'success' => 'Welcome back, ' . $student->name . '!',
        ]);
    }

    /**
     * Show student registration / account creation form
     */
    public function showRegisterForm()
    {
        return view('frontend.theme.clasic.student.auth.register');
    }

    /**
     * Handle student registration submission
     */
    public function register(Request $request)
    {
        $rawPhone = trim($request->phone ?: '');
        $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
        $rawEmail = $request->email ? strtolower(trim($request->email)) : null;

        // Check if an existing student account already exists with this phone or email
        $existingAccount = null;
        if (!empty($cleanPhone)) {
            $existingAccount = StudentAccount::where('phone', $rawPhone)
                ->orWhere('phone', $cleanPhone)
                ->orWhere('phone', 'LIKE', '%' . substr($cleanPhone, -10))
                ->first();
        }
        if (!$existingAccount && !empty($rawEmail)) {
            $existingAccount = StudentAccount::where('email', $rawEmail)->first();
        }

        // If existing account exists (e.g. from prior course application or enrollment), reuse it seamlessly!
        if ($existingAccount) {
            $request->validate([
                'name' => 'required|string|max:191',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'name.required' => 'Please enter your full name.',
                'password.min' => 'Password must be at least 6 characters.',
                'password.confirmed' => 'Password confirmation does not match.',
            ]);

            DB::beginTransaction();
            try {
                $existingAccount->name = $request->name ?: $existingAccount->name;
                if ($rawEmail && empty($existingAccount->email)) {
                    $existingAccount->email = $rawEmail;
                }
                $existingAccount->password = Hash::make($request->password);
                $existingAccount->status = 1;
                $existingAccount->last_login_at = Carbon::now();
                $existingAccount->last_login_ip = $request->ip();
                $existingAccount->save();

                DB::commit();

                Auth::guard('student')->login($existingAccount);

                return redirect()->route('student.dashboard')->with([
                    'success' => 'আপনার বিদ্যমান স্টুডেন্ট অ্যাকাউন্ট সফলভাবে সক্রিয় করা হয়েছে এবং লগইন সম্পন্ন হয়েছে!',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withInput()->withErrors(['error' => 'নিবন্ধন সম্পন্ন করতে ব্যর্থ: ' . $e->getMessage()]);
            }
        }

        // Otherwise, validate fresh account registration
        $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:25|unique:student_accounts,phone',
            'email' => 'nullable|email|max:191|unique:student_accounts,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Please enter your full name.',
            'phone.required' => 'Please enter your mobile phone number.',
            'phone.unique' => 'This phone number is already registered. Please login instead.',
            'email.unique' => 'This email address is already in use by another student account.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Locate or create parent Student record in master `students` table
            $parentStudent = Student::where('personal_call_no', $rawPhone)
                ->orWhere('personal_call_no', $cleanPhone)
                ->orWhere('personal_call_no', 'LIKE', '%' . substr($cleanPhone, -10))
                ->first();

            if (!$parentStudent && !empty($rawEmail)) {
                $parentStudent = Student::where('email', $rawEmail)->first();
            }

            if (!$parentStudent) {
                $parentStudent = Student::create([
                    'student_name' => $request->name,
                    'personal_call_no' => $rawPhone,
                    'email' => $rawEmail ?: '',
                    'course_id' => 0,
                    'course_fee' => '0',
                    'status' => 1,
                    'gander' => 'other',
                    'fathers_name' => '',
                    'mothers_name' => '',
                    'nationality' => 'Bangladeshi',
                    'national_id_no' => '',
                    'present_address' => '',
                    'permanent_address' => '',
                    'religion' => 'Islam',
                    'occupation' => 'student',
                    'age' => '',
                    'educational_qualification' => '',
                    'result' => '',
                    'passing_year' => '',
                ]);
            }

            // Attempt automatic linking with formally admitted student record
            $linkedStudent = AdmitedStudent::where('personal_call_no', $rawPhone)
                ->orWhere('personal_call_no', 'LIKE', '%' . substr($cleanPhone, -10))
                ->orderBy('id', 'desc')
                ->first();

            // Generate unique Student ID
            $studentIdCode = StudentAccount::generateUniqueStudentId();

            $account = StudentAccount::create([
                'student_id' => $parentStudent->id,
                'student_id_code' => $studentIdCode,
                'admited_student_id' => $linkedStudent ? $linkedStudent->id : null,
                'name' => $request->name,
                'email' => $rawEmail,
                'phone' => $rawPhone,
                'password' => Hash::make($request->password),
                'avatar' => $linkedStudent ? $linkedStudent->student_photo : ($parentStudent->student_photo ?: null),
                'status' => 1,
                'meta' => [
                    'registered_from' => 'portal_registration',
                    'registration_source' => 'portal_registration',
                    'student_record_id' => $parentStudent->id,
                ],
                'last_login_at' => Carbon::now(),
                'last_login_ip' => $request->ip(),
            ]);

            DB::commit();

            Auth::guard('student')->login($account);

            return redirect()->route('student.dashboard')->with([
                'success' => 'Account created successfully! Your unique Student ID is ' . $studentIdCode . '.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Registration could not be completed: ' . $e->getMessage()]);
        }
    }

    /**
     * Log out student session
     */
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login')->with([
            'info' => 'You have been safely logged out.',
        ]);
    }
}
