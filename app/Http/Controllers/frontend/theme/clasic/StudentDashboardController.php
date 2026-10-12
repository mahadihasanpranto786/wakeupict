<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\Course;
use App\model\StudentPayment;

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
            'featuredCourses'
        ));
    }
}
