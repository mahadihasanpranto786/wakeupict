<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\LmsCertificate;
use App\model\LmsEnrollment;
use App\model\LmsLesson;
use App\model\LmsLessonProgress;
use App\model\LmsQuizAttempt;
use App\model\LmsPaymentSubmission;
use Carbon\Carbon;

class StudentCertificateController extends Controller
{
    /**
     * Certificates & Achievements Center (Student Protected)
     */
    public function certificates()
    {
        $student = Auth::guard('student')->user();

        // 1. Get ONLY certificates published/issued by admin
        $certificates = LmsCertificate::where('student_account_id', $student->id)
            ->where('status', 'issued')
            ->with('course')
            ->orderBy('issue_date', 'desc')
            ->get();

        // 2. Fetch enrolled courses
        $enrollments = LmsEnrollment::where('student_account_id', $student->id)
            ->where('status', 'active')
            ->with(['course', 'batch'])
            ->get();

        $eligibilityList = [];
        foreach ($enrollments as $enr) {
            $course = $enr->course;
            if (!$course) continue;

            // Check if certificate has been explicitly issued/published by Admin
            $publishedCert = $certificates->where('course_id', $course->id)->first();

            // Check if there is an unissued / draft certificate by admin
            $pendingCert = LmsCertificate::where('student_account_id', $student->id)
                ->where('course_id', $course->id)
                ->where('status', '!=', 'issued')
                ->first();

            $totalLessons = LmsLesson::where('course_id', $course->id)->where('status', 1)->count();
            $completedLessons = LmsLessonProgress::where('student_account_id', $student->id)
                ->where('course_id', $course->id)
                ->where('is_completed', true)
                ->count();

            $progressPct = $totalLessons > 0 ? (int) round(($completedLessons / $totalLessons) * 100) : 0;

            // Passed quiz count
            $passedQuizzes = LmsQuizAttempt::where('student_account_id', $student->id)
                ->whereHas('quiz', function ($q) use ($course) {
                    $q->where('course_id', $course->id);
                })
                ->where('status', 'graded')
                ->count();

            $eligibilityList[] = [
                'course' => $course,
                'enrollment' => $enr,
                'progress_percentage' => $progressPct,
                'passed_quizzes' => $passedQuizzes,
                'certificate' => $publishedCert,
                'is_published' => ($publishedCert !== null),
                'is_pending_review' => ($pendingCert !== null),
            ];
        }

        return view('frontend.theme.clasic.student.certificates.index', compact(
            'student', 'certificates', 'eligibilityList'
        ));
    }

    /**
     * View and Print Certificate
     */
    public function viewCertificate($certificateCode)
    {
        $student = Auth::guard('student')->user();

        $certificate = LmsCertificate::where('certificate_code', $certificateCode)
            ->where('student_account_id', $student->id)
            ->where('status', 'issued')
            ->with(['course', 'student'])
            ->firstOrFail();

        return view('frontend.theme.clasic.student.certificates.view', compact('student', 'certificate'));
    }

    /**
     * Public Certificate Verification Screen
     */
    public function verifyCertificate($hash)
    {
        $certificate = LmsCertificate::where('verification_hash', $hash)
            ->where('status', 'issued')
            ->with(['course', 'student'])
            ->first();

        return view('frontend.theme.clasic.student.certificates.verify_public', compact('certificate', 'hash'));
    }
}
