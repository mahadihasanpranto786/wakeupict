<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\Course;
use App\model\StudentPayment;
use App\model\LmsQuizAttempt;
use App\model\LmsQuiz;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
        $this->middleware('student.feature:dashboard');
    }

    /**
     * Display student portal dashboard
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $admitted = $student->admitedStudent;

        $course = null;
        $batch = null;
        $payments = collect();
        $totalPaid = 0;
        $courseFee = 0;
        $dueFee = 0;

        if ($admitted) {
            $course = $admitted->course;
            $batch = $admitted->batch;
            $courseFee = (float) ($admitted->course_after_discount ?: $admitted->course_fee ?: 0);
            $payments = StudentPayment::where('student_id', $admitted->id)->where('status', 1)->get();
            foreach ($payments as $p) {
                $totalPaid += ((float)$p->paid - (float)$p->return_money);
            }
            $dueFee = max(0, $courseFee - $totalPaid);
        }

        // Recent Quiz Attempts & Performance Stats
        $recentAttempts = LmsQuizAttempt::where('student_account_id', $student->id)
            ->with('quiz')
            ->latest('id')
            ->take(5)
            ->get();

        $totalAttemptsCount = LmsQuizAttempt::where('student_account_id', $student->id)->count();
        $passedAttemptsCount = LmsQuizAttempt::where('student_account_id', $student->id)
            ->where('status', 'graded')
            ->get()
            ->filter(function ($att) {
                return $att->isPassed();
            })
            ->count();

        // Available published quizzes for quick drill
        $availableQuizzes = LmsQuiz::where('is_published', true)
            ->latest('id')
            ->take(4)
            ->get();

        // Available published courses for exploration
        $featuredCourses = Course::where('status', 1)->take(4)->get();

        return view('frontend.theme.clasic.student.dashboard', compact(
            'student',
            'admitted',
            'course',
            'batch',
            'payments',
            'courseFee',
            'totalPaid',
            'dueFee',
            'recentAttempts',
            'totalAttemptsCount',
            'passedAttemptsCount',
            'availableQuizzes',
            'featuredCourses'
        ));
    }
}