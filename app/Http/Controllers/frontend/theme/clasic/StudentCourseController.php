<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\Course;
use App\model\LmsChapter;
use App\model\LmsLesson;
use App\model\LmsEnrollment;
use App\model\LmsLessonProgress;
use Carbon\Carbon;

class StudentCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Display student's enrolled courses
     */
    public function myCourses()
    {
        $student = Auth::guard('student')->user();
        $this->syncStudentEnrollment($student);

        $enrollments = LmsEnrollment::where('student_account_id', $student->id)
            ->where('status', 'active')
            ->with(['course', 'batch'])
            ->get();

        return view('frontend.theme.clasic.student.courses.my_courses', compact('student', 'enrollments'));
    }

    /**
     * Browse all available training programs
     */
    public function browseCourses(Request $request)
    {
        $student = Auth::guard('student')->user();
        $query = Course::where('status', 1);

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('course_title', 'LIKE', "%{$search}%")
                  ->orWhere('short_description', 'LIKE', "%{$search}%");
            });
        }

        $activeCategory = $request->get('category', 'all');
        if ($activeCategory !== 'all') {
            $query->where(function ($q) use ($activeCategory) {
                switch ($activeCategory) {
                    case 'graphics':
                        $q->where('course_title', 'LIKE', '%Graphic%')
                          ->orWhere('course_title', 'LIKE', '%Design%')
                          ->orWhere('course_title', 'LIKE', '%গ্রাফিক্স%');
                        break;
                    case 'web':
                        $q->where('course_title', 'LIKE', '%Web%')
                          ->orWhere('course_title', 'LIKE', '%Dev%')
                          ->orWhere('course_title', 'LIKE', '%ওয়েব%')
                          ->orWhere('course_title', 'LIKE', '%PHP%')
                          ->orWhere('course_title', 'LIKE', '%Laravel%');
                        break;
                    case 'ict':
                        $q->where('course_title', 'LIKE', '%ICT%')
                          ->orWhere('course_title', 'LIKE', '%আইসিটি%')
                          ->orWhere('course_title', 'LIKE', '%Class%');
                        break;
                    case 'marketing':
                        $q->where('course_title', 'LIKE', '%Market%')
                          ->orWhere('course_title', 'LIKE', '%মার্কেটিং%')
                          ->orWhere('course_title', 'LIKE', '%SEO%');
                        break;
                    case 'office':
                        $q->where('course_title', 'LIKE', '%Office%')
                          ->orWhere('course_title', 'LIKE', '%Excel%')
                          ->orWhere('course_title', 'LIKE', '%Word%')
                          ->orWhere('course_title', 'LIKE', '%কম্পিউটার%');
                        break;
                    case 'ai':
                        $q->where('course_title', 'LIKE', '%AI%')
                          ->orWhere('course_title', 'LIKE', '%Data%')
                          ->orWhere('course_title', 'LIKE', '%Python%');
                        break;
                }
            });
        }

        $courses = $query->paginate(9)->appends($request->all());
        $enrolledCourseIds = LmsEnrollment::where('student_account_id', $student->id)
            ->pluck('course_id')
            ->toArray();

        return view('frontend.theme.clasic.student.courses.browse', compact('courses', 'enrolledCourseIds', 'activeCategory'));
    }

    /**
     * View detailed course syllabus and curriculum
     */
    public function courseDetails($id)
    {
        $student = Auth::guard('student')->user();
        $course = is_numeric($id) 
            ? Course::findOrFail($id) 
            : Course::where('course_slug', $id)->firstOrFail();

        $chapters = LmsChapter::where('course_id', $course->id)
            ->where('status', 1)
            ->with(['activeLessons'])
            ->orderBy('order_index', 'asc')
            ->get();

        $isEnrolled = LmsEnrollment::where('student_account_id', $student->id)
            ->where('course_id', $course->id)
            ->exists();

        // Calculate progress if enrolled
        $completedLessonIds = LmsLessonProgress::where('student_account_id', $student->id)
            ->where('course_id', $course->id)
            ->where('is_completed', true)
            ->pluck('lesson_id')
            ->toArray();

        return view('frontend.theme.clasic.student.courses.details', compact(
            'course', 'chapters', 'isEnrolled', 'completedLessonIds'
        ));
    }

    /**
     * Self-enroll into a published course
     */
    public function enroll($courseId)
    {
        $student = Auth::guard('student')->user();
        $course = Course::findOrFail($courseId);

        $enrollment = LmsEnrollment::firstOrCreate([
            'student_account_id' => $student->id,
            'course_id' => $course->id,
        ], [
            'batch_id' => $student->admitedStudent ? $student->admitedStudent->batch_id : null,
            'enrollment_type' => 'self_enrolled',
            'status' => 'active',
        ]);

        return redirect()->route('student.courses.learn', $course->id)->with([
            'success' => 'Successfully enrolled in ' . $course->course_title . '! Happy learning.',
        ]);
    }

    /**
     * Interactive LMS Lesson Player
     */
    public function learn($courseId, $lessonId = null)
    {
        $student = Auth::guard('student')->user();
        $this->syncStudentEnrollment($student);

        $course = is_numeric($courseId) 
            ? Course::findOrFail($courseId) 
            : Course::where('course_slug', $courseId)->firstOrFail();

        // Verify or create enrollment
        $isEnrolled = LmsEnrollment::where('student_account_id', $student->id)
            ->where('course_id', $course->id)
            ->exists();

        if (!$isEnrolled) {
            LmsEnrollment::create([
                'student_account_id' => $student->id,
                'course_id' => $course->id,
                'batch_id' => $student->admitedStudent ? $student->admitedStudent->batch_id : null,
                'enrollment_type' => 'self_enrolled',
                'status' => 'active',
            ]);
        }

        $chapters = LmsChapter::where('course_id', $course->id)
            ->where('status', 1)
            ->with(['activeLessons'])
            ->orderBy('order_index', 'asc')
            ->get();

        // Determine active lesson
        $currentLesson = null;
        if ($lessonId) {
            $currentLesson = LmsLesson::where('course_id', $course->id)->findOrFail($lessonId);
        } else {
            // Find first incomplete lesson, or default to first lesson
            $completedLessonIds = LmsLessonProgress::where('student_account_id', $student->id)
                ->where('course_id', $course->id)
                ->where('is_completed', true)
                ->pluck('lesson_id')
                ->toArray();

            foreach ($chapters as $chapter) {
                foreach ($chapter->activeLessons as $lesson) {
                    if (!in_array($lesson->id, $completedLessonIds)) {
                        $currentLesson = $lesson;
                        break 2;
                    }
                }
            }

            // Fallback to absolute first lesson if all completed
            if (!$currentLesson && $chapters->isNotEmpty() && $chapters->first()->activeLessons->isNotEmpty()) {
                $currentLesson = $chapters->first()->activeLessons->first();
            }
        }

        $completedLessonIds = LmsLessonProgress::where('student_account_id', $student->id)
            ->where('course_id', $course->id)
            ->where('is_completed', true)
            ->pluck('lesson_id')
            ->toArray();

        // Compute total progress
        $totalLessons = LmsLesson::where('course_id', $course->id)->where('status', 1)->count();
        $progressPercent = $totalLessons > 0 ? (int) round((count($completedLessonIds) / $totalLessons) * 100) : 0;

        // Next & Previous lessons
        $allLessons = LmsLesson::where('course_id', $course->id)
            ->where('status', 1)
            ->orderBy('chapter_id', 'asc')
            ->orderBy('order_index', 'asc')
            ->get();

        $currentIndex = $currentLesson ? $allLessons->search(function ($item) use ($currentLesson) {
            return $item->id == $currentLesson->id;
        }) : false;

        $prevLesson = ($currentIndex !== false && $currentIndex > 0) ? $allLessons->get($currentIndex - 1) : null;
        $nextLesson = ($currentIndex !== false && $currentIndex < $allLessons->count() - 1) ? $allLessons->get($currentIndex + 1) : null;

        return view('frontend.theme.clasic.student.courses.learn', compact(
            'course', 'chapters', 'currentLesson', 'completedLessonIds', 'progressPercent', 'prevLesson', 'nextLesson'
        ));
    }

    /**
     * Toggle lesson completion status via AJAX
     */
    public function toggleLessonComplete(Request $request, $lessonId)
    {
        $student = Auth::guard('student')->user();
        $lesson = LmsLesson::findOrFail($lessonId);

        $progress = LmsLessonProgress::firstOrNew([
            'student_account_id' => $student->id,
            'lesson_id' => $lesson->id,
        ], [
            'course_id' => $lesson->course_id,
        ]);

        $progress->is_completed = !$progress->is_completed;
        $progress->completed_at = $progress->is_completed ? Carbon::now() : null;
        $progress->save();

        // Calculate updated course completion
        $totalLessons = LmsLesson::where('course_id', $lesson->course_id)->where('status', 1)->count();
        $completedLessons = LmsLessonProgress::where('student_account_id', $student->id)
            ->where('course_id', $lesson->course_id)
            ->where('is_completed', true)
            ->count();

        $progressPercent = $totalLessons > 0 ? (int) round(($completedLessons / $totalLessons) * 100) : 0;

        return response()->json([
            'status' => 'success',
            'is_completed' => $progress->is_completed,
            'progress_percent' => $progressPercent,
            'completed_count' => $completedLessons,
            'total_count' => $totalLessons,
            'message' => $progress->is_completed ? 'Lesson marked as completed!' : 'Lesson marked as incomplete.',
        ]);
    }

    /**
     * Learning Materials repository
     */
    public function materials()
    {
        $student = Auth::guard('student')->user();
        $this->syncStudentEnrollment($student);

        $enrolledCourseIds = LmsEnrollment::where('student_account_id', $student->id)
            ->where('status', 'active')
            ->pluck('course_id')
            ->toArray();

        $materials = LmsLesson::whereIn('course_id', $enrolledCourseIds)
            ->where('status', 1)
            ->whereNotNull('pdf_file')
            ->with(['course', 'chapter'])
            ->get();

        return view('frontend.theme.clasic.student.courses.materials', compact('student', 'materials'));
    }

    /**
     * Comprehensive Student Learning Progress
     */
    public function progress()
    {
        $student = Auth::guard('student')->user();
        $this->syncStudentEnrollment($student);

        $enrollments = LmsEnrollment::where('student_account_id', $student->id)
            ->with(['course', 'batch'])
            ->get();

        return view('frontend.theme.clasic.student.courses.progress', compact('student', 'enrollments'));
    }

    /**
     * Helper to auto-sync admission with LMS enrollment
     */
    protected function syncStudentEnrollment($student)
    {
        if ($student->admitedStudent && $student->admitedStudent->course_id) {
            LmsEnrollment::firstOrCreate([
                'student_account_id' => $student->id,
                'course_id' => $student->admitedStudent->course_id,
            ], [
                'batch_id' => $student->admitedStudent->batch_id,
                'enrollment_type' => 'admitted',
                'status' => 'active',
            ]);
        }
    }
}
