<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\StudentAccount;
use App\model\AdmitedStudent;
use App\model\Student;
use App\model\Course;
use App\model\Batch;
use App\model\LmsEnrollment;
use App\Services\RegistrationNumberService;
use App\Services\StudentEnrollmentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StudentAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except(['logout', 'showRegistrationConfirmation']);
    }

    /**
     * Show student login form
     */
    public function showLoginForm()
    {
        $activeCourses = Course::where('status', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $activeBatches = Batch::where('status', 1)->where('active_batch', 1)->with('course')->orderBy('id', 'desc')->get();

        return view('frontend.theme.clasic.student.auth.login', compact('activeCourses', 'activeBatches'));
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

        // Locate student account by Registration Number, Student ID Code, Email, or Phone
        $student = StudentAccount::where(function ($q) use ($loginInput) {
            $q->where('registration_number', $loginInput)
              ->orWhere('student_id_code', $loginInput)
              ->orWhere('email', $loginInput)
              ->orWhere('phone', $loginInput);
        })->first();

        if (!$student) {
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'login_id' => 'No student account found matching these credentials.',
            ]);
        }

        // Strict Registration Status Access Control
        if ($student->registration_status === 'pending') {
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'login_id' => 'আপনার রেজিস্ট্রেশনটি বর্তমানে অ্যাডমিন ভেরিফিকেশনের জন্য অপেক্ষমাণ (Pending) রয়েছে। অ্যাডমিন অনুমোদন করার পর স্টুডেন্ট পোর্টাল অ্যাক্সেস সক্রিয় হবে। অনুগ্রহ করে অপেক্ষা করুন অথবা হেল্পলাইন 01791612121 নম্বরে যোগাযোগ করুন।',
            ]);
        }

        if ($student->registration_status === 'rejected') {
            $reason = !empty($student->rejection_reason) ? ' (কারণ: ' . $student->rejection_reason . ')' : '';
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'login_id' => 'আপনার রেজিস্ট্রেশন আবেদনটি অ্যাডমিন কর্তৃক বাতিল (Rejected) করা হয়েছে' . $reason . '। স্টুডেন্ট পোর্টাল অ্যাক্সেস বন্ধ রয়েছে।',
            ]);
        }

        // Check if student's batch has expired (End Date Over)
        $batch = $student->batch;
        if ($batch && $batch->end_date && Carbon::parse($batch->end_date)->endOfDay()->isPast()) {
            $batchName = $batch->batch_number ?: 'ব্যাচ';
            $endDateStr = Carbon::parse($batch->end_date)->format('d M, Y');
            return back()->withInput($request->only('login_id', 'remember'))->withErrors([
                'login_id' => "আপনার {$batchName}-এর নির্ধারিত মেয়াদ ({$endDateStr}) সমাপ্ত হয়েছে। স্টুডেন্ট পোর্টাল অ্যাক্সেস বন্ধ রয়েছে। বিস্তারিত তথ্যের জন্য হেল্পলাইন 01791612121 নম্বরে যোগাযোগ করুন।",
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
        $activeCourses = Course::where('status', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $activeBatches = Batch::where('status', 1)->where('active_batch', 1)->with('course')->orderBy('id', 'desc')->get();

        return view('frontend.theme.clasic.student.auth.register', compact('activeCourses', 'activeBatches'));
    }

    /**
     * Get active batches for a selected course via AJAX
     */
    public function getBatchesForCourse($course_id)
    {
        $batches = Batch::where('course_id', $course_id)
            ->where('status', 1)
            ->where('active_batch', 1)
            ->orderBy('id', 'desc')
            ->select('id', 'batch_number', 'batch_code', 'academic_year')
            ->get();

        return response()->json($batches);
    }

    /**
     * Handle student registration submission
     */
    public function register(Request $request)
    {
        // Graceful defaults if course_id / batch_id not passed in simplified submission
        if (!$request->filled('course_id')) {
            $defaultCourse = Course::where('status', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->first();
            if ($defaultCourse) {
                $request->merge(['course_id' => $defaultCourse->id]);
            }
        }

        if (!$request->filled('batch_id')) {
            $defaultBatch = null;
            if ($request->filled('course_id')) {
                $defaultBatch = Batch::where('course_id', $request->course_id)->where('status', 1)->where('active_batch', 1)->first();
            }
            if (!$defaultBatch && $request->filled('course_id')) {
                $nextBatchCode = (string)((int)Batch::max('id') + 1);
                $cleanCode = str_pad($nextBatchCode, 2, '0', STR_PAD_LEFT);
                $defaultBatch = Batch::create([
                    'batch_number' => 'Batch-' . $cleanCode,
                    'batch_code' => $cleanCode,
                    'academic_year' => date('Y'),
                    'course_id' => $request->course_id,
                    'batch_type' => 'Local',
                    'title_id' => 1,
                    'active_batch' => 1,
                    'status' => 1,
                ]);
            }
            if ($defaultBatch) {
                $request->merge(['batch_id' => $defaultBatch->id]);
            }
        }

        $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:25',
            'email' => 'nullable|email|max:191',
            'course_id' => 'required|integer|exists:courses,id',
            'batch_id' => 'required|integer|exists:batches,id',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Please enter your full name.',
            'phone.required' => 'Please enter your mobile phone number.',
            'course_id.required' => 'Please select a course.',
            'course_id.exists' => 'The selected course does not exist.',
            'batch_id.required' => 'Please select a batch.',
            'batch_id.exists' => 'The selected batch does not exist.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $rawPhone = trim($request->phone ?: '');
        $cleanPhone = StudentEnrollmentService::normalizePhone($rawPhone);
        $rawEmail = $request->email ? strtolower(trim($request->email)) : null;

        // Verify that the course and batch are ACTIVE
        $course = Course::where('id', $request->course_id)->where('status', 1)->first();
        if (!$course) {
            return back()->withInput()->withErrors([
                'course_id' => 'The selected course is inactive or not currently accepting registrations.',
            ]);
        }

        $batch = Batch::where('id', $request->batch_id)->where('status', 1)->where('active_batch', 1)->first();
        if (!$batch) {
            return back()->withInput()->withErrors([
                'batch_id' => 'The selected batch is inactive or full. Please choose an active batch.',
            ]);
        }

        // Verify that the batch actually belongs to the course (or allow flexible assignment)
        if (!empty($batch->course_id) && (int)$batch->course_id !== (int)$course->id) {
            return back()->withInput()->withErrors([
                'batch_id' => 'The selected batch does not belong to the chosen course.',
            ]);
        }

        // Check Identity Conflict between phone and email across accounts
        $conflictCheck = StudentEnrollmentService::checkIdentityConflict($rawPhone, $rawEmail);
        if ($conflictCheck['has_conflict']) {
            return back()->withInput()->withErrors([
                'phone' => $conflictCheck['message'],
            ]);
        }

        DB::beginTransaction();
        try {
            // 1. Generate unique, concurrency-locked Registration Number
            $academicYear = $batch->academic_year ?: date('Y');
            $regNumber = RegistrationNumberService::generate($academicYear, $batch->batch_code, $course->course_code);

            // 2. Parent Student record
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
                    'course_id' => $course->id,
                    'batch_id' => $batch->id,
                    'registration_number' => $regNumber,
                    'registration_status' => 'pending',
                    'course_fee' => $course->price ?: '0',
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
            } else {
                $parentStudent->update([
                    'course_id' => $course->id,
                    'batch_id' => $batch->id,
                    'registration_number' => $parentStudent->registration_number ?: $regNumber,
                    'registration_status' => 'pending',
                ]);
                $regNumber = $parentStudent->registration_number;
            }

            // 3. StudentAccount record
            $account = StudentAccount::where('phone', $rawPhone)
                ->orWhere('phone', $cleanPhone)
                ->orWhere('phone', 'LIKE', '%' . substr($cleanPhone, -10))
                ->first();

            if (!$account && !empty($rawEmail)) {
                $account = StudentAccount::where('email', $rawEmail)->first();
            }

            if ($account) {
                $account->update([
                    'name' => $request->name ?: $account->name,
                    'email' => $rawEmail ?: $account->email,
                    'password' => Hash::make($request->password),
                    'registration_number' => $account->registration_number ?: $regNumber,
                    'registration_status' => 'pending',
                ]);
            } else {
                $account = StudentAccount::create([
                    'student_id' => $parentStudent->id,
                    'student_id_code' => $regNumber,
                    'registration_number' => $regNumber,
                    'registration_status' => 'pending',
                    'name' => $request->name,
                    'email' => $rawEmail,
                    'phone' => $rawPhone,
                    'password' => Hash::make($request->password),
                    'status' => 1,
                    'meta' => [
                        'registered_from' => 'student_registration',
                        'registration_source' => 'portal_registration',
                        'course_id' => $course->id,
                        'batch_id' => $batch ? $batch->id : null,
                    ],
                ]);
            }

            // 4. Create LMS Enrollment entry (pending approval)
            LmsEnrollment::updateOrCreate(
                [
                    'student_account_id' => $account->id,
                    'course_id' => $course->id,
                ],
                [
                    'batch_id' => $batch->id,
                    'enrollment_type' => 'applied',
                    'status' => 'pending',
                ]
            );

            DB::commit();

            // DO NOT LOGIN!
            // Store registration confirmation payload in session for dedicated confirmation view
            $confirmationData = [
                'student_name' => $request->name,
                'registration_number' => $regNumber,
                'course_title' => $course->course_title,
                'course_code' => $course->course_code,
                'batch_number' => $batch->batch_number,
                'batch_code' => $batch->batch_code,
                'academic_year' => $academicYear,
                'phone' => $rawPhone,
                'submission_status' => 'Pending Admin Verification',
                'created_at' => Carbon::now()->format('d M, Y h:i A'),
            ];

            session()->put('registration_confirmation_data', $confirmationData);

            return redirect()->route('student.registration.confirmation');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Registration could not be completed: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the dedicated Registration Confirmation Screen
     */
    public function showRegistrationConfirmation(Request $request)
    {
        $confirmationData = session('registration_confirmation_data');

        if (!$confirmationData) {
            return redirect()->route('student.login')->with([
                'info' => 'If you have recently registered, you may verify your registration number or check status below.',
            ]);
        }

        return view('frontend.theme.clasic.student.auth.confirmation', compact('confirmationData'));
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
