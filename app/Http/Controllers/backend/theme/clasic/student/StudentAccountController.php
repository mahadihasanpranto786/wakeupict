<?php

namespace App\Http\Controllers\backend\theme\clasic\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\StudentAccount;
use App\model\Student;
use App\model\Course;
use App\model\Batch;
use Illuminate\Support\Facades\DB;

class StudentAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display listing of registered student accounts
     */
    public function index(Request $request)
    {
        $query = StudentAccount::with([
            'student',
            'admitedStudent.batch',
            'admitedStudent.course',
            'enrollments.course',
            'enrollments.batch'
        ])->latest('id');

        // Search by keyword (Name, Phone, Email, Student ID Code)
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('student_id_code', 'like', "%{$search}%");
            });
        }

        // Filter by Registration Source
        if ($request->filled('source')) {
            $src = $request->source;
            if ($src === 'portal') {
                $query->where(function ($q) {
                    $q->where('meta->registered_from', 'portal_registration')
                      ->orWhere('meta->registration_source', 'portal_registration')
                      ->orWhere(function ($sub) {
                          $sub->whereNull('admited_student_id')
                              ->whereNull('meta->registered_from');
                      });
                });
            } elseif ($src === 'admission') {
                $query->where(function ($q) {
                    $q->where('meta->registered_from', 'online_admission_form')
                      ->orWhere('meta->registration_source', 'admission_application')
                      ->orWhereNotNull('admited_student_id');
                });
            }
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', (int)$request->status);
        }

        // Filter by Course
        if ($request->filled('course_id')) {
            $courseId = (int)$request->course_id;
            $query->where(function ($q) use ($courseId) {
                $q->whereHas('enrollments', function ($eq) use ($courseId) {
                    $eq->where('course_id', $courseId);
                })->orWhereHas('admitedStudent', function ($aq) use ($courseId) {
                    $aq->where('course_id', $courseId);
                })->orWhereHas('student', function ($sq) use ($courseId) {
                    $sq->where('course_id', $courseId);
                });
            });
        }

        $accounts = $query->paginate(20)->appends($request->all());

        // Quick Stats
        $stats = [
            'total'     => StudentAccount::count(),
            'active'    => StudentAccount::where('status', 1)->count(),
            'portal'    => StudentAccount::where(function ($q) {
                $q->where('meta->registered_from', 'portal_registration')
                  ->orWhere('meta->registration_source', 'portal_registration')
                  ->orWhere(function ($sub) {
                      $sub->whereNull('admited_student_id')
                          ->whereNull('meta->registered_from');
                  });
            })->count(),
            'admission' => StudentAccount::where(function ($q) {
                $q->where('meta->registered_from', 'online_admission_form')
                  ->orWhere('meta->registration_source', 'admission_application')
                  ->orWhereNotNull('admited_student_id');
            })->count(),
        ];

        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();

        return view('backend.theme.clasic.student.student_accounts', compact('accounts', 'stats', 'courses'));
    }

    /**
     * Toggle Account Active/Suspended Status
     */
    public function toggleStatus($id)
    {
        $account = StudentAccount::findOrFail($id);
        $newStatus = ($account->status == 1) ? 0 : 1;
        $account->update(['status' => $newStatus]);

        $msg = $newStatus == 1 
            ? "শিক্ষার্থী অ্যাকাউন্ট ({$account->name}) সফলভাবে সক্রিয় করা হয়েছে।" 
            : "শিক্ষার্থী অ্যাকাউন্ট ({$account->name}) সফলভাবে স্থগিত (Suspended) করা হয়েছে।";

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Delete student account
     */
    public function destroy($id)
    {
        $account = StudentAccount::findOrFail($id);
        $name = $account->name;
        $account->enrollments()->delete();
        $account->delete();

        return redirect()->back()->with('success', "শিক্ষার্থী অ্যাকাউন্ট ({$name}) সফলভাবে মুছে ফেলা হয়েছে।");
    }
}

