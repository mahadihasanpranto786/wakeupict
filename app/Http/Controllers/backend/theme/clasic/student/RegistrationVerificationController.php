<?php

namespace App\Http\Controllers\backend\theme\clasic\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\StudentAccount;
use App\model\Student;
use App\model\Course;
use App\model\Batch;
use App\model\LmsEnrollment;
use App\model\RegistrationVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistrationVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the Registration Verification Center with statistics, search, and filters
     */
    public function index(Request $request)
    {
        // 1. Calculate Real-time Statistics
        $totalRegistrations = StudentAccount::whereNotNull('registration_number')
            ->orWhereNotNull('student_id_code')
            ->count();

        $pendingRegistrations = StudentAccount::where('registration_status', 'pending')->count();
        $approvedRegistrations = StudentAccount::where('registration_status', 'approved')->count();
        $rejectedRegistrations = StudentAccount::where('registration_status', 'rejected')->count();

        $verificationRequests = RegistrationVerification::count();
        $blockedVerificationRequests = RegistrationVerification::where('status', 'blocked')->count();

        // 2. Query Builder for Student Registrations
        $query = StudentAccount::with(['student', 'admitedStudent', 'enrollments.course', 'enrollments.batch', 'verifiedBy'])
            ->latest('id');

        // Filter: Status (Pending, Approved, Rejected)
        if ($request->filled('status')) {
            $query->where('registration_status', $request->status);
        }

        // Filter: Search (Name, Phone, Registration Number, Student ID)
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('registration_number', 'LIKE', "%{$search}%")
                  ->orWhere('student_id_code', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter: Course
        if ($request->filled('course_id')) {
            $courseId = (int)$request->course_id;
            $query->where(function ($q) use ($courseId) {
                $q->whereHas('enrollments', function ($sub) use ($courseId) {
                    $sub->where('course_id', $courseId);
                })
                ->orWhereHas('admitedStudent', function ($sub) use ($courseId) {
                    $sub->where('course_id', $courseId);
                })
                ->orWhereHas('student', function ($sub) use ($courseId) {
                    $sub->where('course_id', $courseId);
                });
            });
        }

        // Filter: Batch
        if ($request->filled('batch_id')) {
            $batchId = (int)$request->batch_id;
            $query->where(function ($q) use ($batchId) {
                $q->whereHas('enrollments', function ($sub) use ($batchId) {
                    $sub->where('batch_id', $batchId);
                })
                ->orWhereHas('admitedStudent', function ($sub) use ($batchId) {
                    $sub->where('batch_id', $batchId);
                })
                ->orWhereHas('student', function ($sub) use ($batchId) {
                    $sub->where('batch_id', $batchId);
                });
            });
        }

        // Filter: Registration Year
        if ($request->filled('year')) {
            $year = trim($request->year);
            $query->where(function ($q) use ($year) {
                $q->where('registration_number', 'LIKE', "{$year}%")
                  ->orWhere('created_at', 'LIKE', "{$year}%");
            });
        }

        $registrations = $query->paginate(15)->appends($request->query());

        // 3. Query for Verification Logs / Blocked Requests (Forgot Number tab)
        $verificationLogs = RegistrationVerification::with(['studentAccount', 'admin'])
            ->latest('id')
            ->paginate(10, ['*'], 'verification_page');

        // Dropdown Data
        $courses = Course::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $batches = Batch::where('status', 1)->orderBy('id', 'desc')->get();
        $years = [date('Y'), date('Y') - 1, date('Y') + 1, '2025', '2024'];

        return view('backend.theme.clasic.student.verifications.index', compact(
            'registrations',
            'verificationLogs',
            'totalRegistrations',
            'pendingRegistrations',
            'approvedRegistrations',
            'rejectedRegistrations',
            'verificationRequests',
            'blockedVerificationRequests',
            'courses',
            'batches',
            'years'
        ));
    }

    /**
     * Approve a pending student registration, activating portal access
     */
    public function approveStudent($id)
    {
        $account = StudentAccount::findOrFail($id);

        DB::beginTransaction();
        try {
            $account->update([
                'registration_status' => 'approved',
                'status' => 1,
                'verified_by' => Auth::id(),
                'verified_at' => Carbon::now(),
                'rejection_reason' => null,
            ]);

            // Synchronize parent Student record
            if ($account->student_id) {
                Student::where('id', $account->student_id)->update([
                    'registration_status' => 'approved',
                    'verified_by' => Auth::id(),
                    'verified_at' => Carbon::now(),
                    'rejection_reason' => null,
                ]);
            }

            // Activate enrolled courses
            LmsEnrollment::where('student_account_id', $account->id)->update([
                'status' => 'active',
            ]);

            DB::commit();

            return redirect()->back()->with([
                'success' => "Student {$account->name} ({$account->registration_number}) has been APPROVED successfully. Student portal access is now active!",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => 'Approval failed: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Reject a student registration, blocking portal access
     */
    public function rejectStudent(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ], [
            'rejection_reason.required' => 'Please provide a reason for rejecting this registration.',
        ]);

        $account = StudentAccount::findOrFail($id);

        DB::beginTransaction();
        try {
            $account->update([
                'registration_status' => 'rejected',
                'status' => 0,
                'verified_by' => Auth::id(),
                'verified_at' => Carbon::now(),
                'rejection_reason' => $request->rejection_reason,
            ]);

            // Synchronize parent Student record
            if ($account->student_id) {
                Student::where('id', $account->student_id)->update([
                    'registration_status' => 'rejected',
                    'verified_by' => Auth::id(),
                    'verified_at' => Carbon::now(),
                    'rejection_reason' => $request->rejection_reason,
                ]);
            }

            // Block LMS Enrollments
            LmsEnrollment::where('student_account_id', $account->id)->update([
                'status' => 'cancelled',
            ]);

            DB::commit();

            return redirect()->back()->with([
                'success' => "Student {$account->name} ({$account->registration_number}) has been REJECTED. Student portal access remains blocked.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => 'Rejection failed: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Admin approves a restricted verification request (exceeded 3 attempts)
     */
    public function approveVerificationRequest(Request $request, $id)
    {
        $verification = RegistrationVerification::findOrFail($id);

        $payload = [
            'status' => 'admin_approved',
            'admin_notes' => $request->admin_notes ?: 'Approved by Administrator',
        ];
        if (\Illuminate\Support\Facades\Schema::hasColumn('registration_verifications', 'admin_id')) {
            $payload['admin_id'] = Auth::id();
        }
        if (\Illuminate\Support\Facades\Schema::hasColumn('registration_verifications', 'action_by')) {
            $payload['action_by'] = Auth::id();
        }
        if (\Illuminate\Support\Facades\Schema::hasColumn('registration_verifications', 'action_at')) {
            $payload['action_at'] = Carbon::now();
        }

        $verification->update($payload);

        return redirect()->back()->with([
            'success' => "Verification request for phone {$verification->phone} has been APPROVED. The student can now retrieve their registration number.",
        ]);
    }

    /**
     * Admin rejects a restricted verification request
     */
    public function rejectVerificationRequest(Request $request, $id)
    {
        $verification = RegistrationVerification::findOrFail($id);

        $payload = [
            'status' => 'admin_rejected',
            'admin_notes' => $request->admin_notes ?: 'Rejected by Administrator',
        ];
        if (\Illuminate\Support\Facades\Schema::hasColumn('registration_verifications', 'admin_id')) {
            $payload['admin_id'] = Auth::id();
        }
        if (\Illuminate\Support\Facades\Schema::hasColumn('registration_verifications', 'action_by')) {
            $payload['action_by'] = Auth::id();
        }
        if (\Illuminate\Support\Facades\Schema::hasColumn('registration_verifications', 'action_at')) {
            $payload['action_at'] = Carbon::now();
        }

        $verification->update($payload);

        return redirect()->back()->with([
            'success' => "Verification request for phone {$verification->phone} has been REJECTED.",
        ]);
    }
}

