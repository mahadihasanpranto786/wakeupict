<?php

namespace App\Http\Controllers\backend\theme\clasic\lms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\Course;
use App\Services\QuizExcelImportService;
use Illuminate\Support\Facades\DB;

class AdminQuizController extends Controller
{
    protected $importService;

    public function __construct(QuizExcelImportService $importService)
    {
        $this->middleware('auth');
        $this->importService = $importService;
    }

    /**
     * Display all quizzes with Course/Category filters and Excel import controls
     */
    public function index(Request $request)
    {
        $query = LmsQuiz::with(['course'])->withCount(['questions', 'attempts'])->latest();

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by quiz type
        if ($request->filled('quiz_type')) {
            $query->where('quiz_type', $request->quiz_type);
        }

        // Search by title
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $quizzes = $query->paginate(20)->appends($request->all());

        // Stats
        $totalQuizzes = LmsQuiz::count();
        $totalQuestions = LmsQuestion::count();
        $publishedQuizzes = LmsQuiz::where('is_published', true)->count();

        // Dropdown Courses
        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();

        return view('backend.theme.clasic.lms.quizzes.index', compact(
            'quizzes', 'courses', 'totalQuizzes', 'totalQuestions', 'publishedQuizzes'
        ));
    }

    /**
     * Create a new Quiz
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'title'            => 'required|string|max:191',
            'description'      => 'nullable|string',
            'quiz_type'        => 'required|in:practice,exam,class_test',
            'duration_minutes' => 'required|integer|min:1|max:300',
            'pass_marks'       => 'nullable|numeric|min:0',
            'is_published'     => 'nullable|boolean',
        ]);

        $quiz = LmsQuiz::create([
            'course_id'         => $request->course_id,
            'title'             => $request->title,
            'description'       => $request->description,
            'quiz_type'         => $request->quiz_type,
            'duration_minutes'  => (int)$request->duration_minutes,
            'total_marks'       => 0, // auto-calculated from questions
            'pass_marks'        => $request->pass_marks ?: 5.0,
            'shuffle_questions' => true,
            'shuffle_options'   => true,
            'max_attempts'      => 0, // unlimited
            'is_published'      => $request->has('is_published') ? (bool)$request->is_published : true,
        ]);

        return redirect()->back()->with('success', "Quiz '{$quiz->title}' created successfully! You can now import MCQs via Excel.");
    }

    /**
     * Import Questions into Quiz via Excel or CSV file
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|max:10240', // 10MB max
            'quiz_id'    => 'nullable|exists:lms_quizzes,id',
            'course_id'  => 'required_without:quiz_id|nullable|exists:courses,id',
            'new_quiz_title' => 'required_without:quiz_id|nullable|string|max:191',
        ]);

        $file = $request->file('excel_file');
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, ['xlsx', 'xls', 'csv', 'txt'])) {
            return redirect()->back()->withErrors(['excel_file' => 'Only .xlsx, .xls, and .csv spreadsheet files are allowed.']);
        }

        // Target Quiz resolution
        if ($request->filled('quiz_id')) {
            $quiz = LmsQuiz::findOrFail($request->quiz_id);
        } else {
            // Auto-create new Quiz for the selected Course/Category
            $course = Course::findOrFail($request->course_id);
            $quizTitle = $request->new_quiz_title ?: ('Offline MCQ Assessment: ' . $course->course_title);

            $quiz = LmsQuiz::create([
                'course_id'         => $course->id,
                'title'             => $quizTitle,
                'description'       => 'Imported from Excel spreadsheet for ' . $course->course_title,
                'quiz_type'         => $request->input('quiz_type', 'practice'),
                'duration_minutes'  => (int)$request->input('duration_minutes', 20),
                'total_marks'       => 0,
                'pass_marks'        => 5.0,
                'shuffle_questions' => true,
                'shuffle_options'   => true,
                'max_attempts'      => 0,
                'is_published'      => true,
            ]);
        }

        $result = $this->importService->importFromFile($file->getRealPath(), $quiz->id);

        if (!$result['success'] || $result['imported_count'] === 0) {
            $errMsg = !empty($result['errors']) ? implode(' ', $result['errors']) : 'Failed to import questions from Excel.';
            return redirect()->back()->withErrors(['excel_file' => $errMsg]);
        }

        $msg = "Excel Import Successful! Imported {$result['imported_count']} MCQ questions into '{$quiz->title}'. Total Quiz Marks: {$result['total_marks']}.";
        if (!empty($result['errors'])) {
            $msg .= ' (Note: ' . count($result['errors']) . ' row(s) had warnings).';
        }

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Download Sample Excel/CSV Template with bilingual instructions and sample rows
     */
    public function downloadSample()
    {
        $csvContent = $this->importService->generateSampleCsv();

        return response($csvContent, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="WakeUpICT_Quiz_MCQ_Sample_Template.csv"',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ]);
    }

    /**
     * Toggle Quiz Published status
     */
    public function togglePublish($id)
    {
        $quiz = LmsQuiz::findOrFail($id);
        $quiz->is_published = !$quiz->is_published;
        $quiz->save();

        $status = $quiz->is_published ? 'PUBLISHED' : 'UNPUBLISHED (Draft)';
        return redirect()->back()->with('success', "Quiz '{$quiz->title}' is now {$status}.");
    }

    /**
     * Delete Quiz and all its questions
     */
    public function destroy($id)
    {
        $quiz = LmsQuiz::findOrFail($id);
        $title = $quiz->title;

        DB::transaction(function () use ($quiz) {
            // Delete child questions options & questions
            $questions = LmsQuestion::where('quiz_id', $quiz->id)->get();
            foreach ($questions as $q) {
                $q->options()->delete();
                $q->answers()->delete();
                $q->delete();
            }
            $quiz->delete();
        });

        return redirect()->back()->with('success', "Quiz '{$title}' and its questions were deleted successfully.");
    }
}
