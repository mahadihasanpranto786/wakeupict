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
            'view_mode'        => 'nullable|in:all_questions,one_by_one',
            'subject_code'     => 'nullable|string|max:20',
            'board_name'       => 'nullable|string|max:100',
            'question_set'     => 'nullable|string|max:20',
            'negative_marks'   => 'nullable|numeric|min:0',
            'result_release_policy' => 'nullable|in:immediate,after_deadline,admin_publish',
            'locking_policy'   => 'nullable|in:mode_default,instant_lock,confirm_lock',
        ]);

        $quiz = LmsQuiz::create([
            'course_id'             => $request->course_id,
            'title'                 => $request->title,
            'description'           => $request->description,
            'quiz_type'             => $request->quiz_type,
            'duration_minutes'      => (int)$request->duration_minutes,
            'total_marks'           => 0, // auto-calculated from questions
            'pass_marks'            => $request->pass_marks ?: 5.0,
            'shuffle_questions'     => true,
            'shuffle_options'       => true,
            'max_attempts'          => 0, // unlimited
            'is_published'          => $request->has('is_published') ? (bool)$request->is_published : true,
            'view_mode'             => $request->input('view_mode', 'all_questions'),
            'subject_code'          => $request->input('subject_code', '101'),
            'board_name'            => $request->input('board_name', 'ঢাকা শিক্ষা বোর্ড'),
            'question_set'          => $request->input('question_set', 'Set A'),
            'negative_marks'        => (float)$request->input('negative_marks', 0.0),
            'result_release_policy' => $request->input('result_release_policy', 'immediate'),
            'locking_policy'        => $request->input('locking_policy', 'mode_default'),
            'allow_question_flagging' => true,
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

    /**
     * Generate / Distribute Question Sets (Set A, Set B, Set C, Set D)
     */
    public function generateSets(Request $request, $id)
    {
        $quiz = LmsQuiz::findOrFail($id);
        $baseQuestions = LmsQuestion::where('quiz_id', $quiz->id)->with('options')->get();

        if ($baseQuestions->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'কুইজে কোনো প্রশ্ন নেই। প্রথমে এক্সেল থেকে প্রশ্ন আপলোড করুন।']);
        }

        $targetSets = $request->input('sets', ['Set A', 'Set B', 'Set C', 'Set D']);
        if (!is_array($targetSets)) {
            $targetSets = ['Set A', 'Set B', 'Set C', 'Set D'];
        }

        DB::beginTransaction();
        try {
            // Assign existing questions to Set A if not set
            foreach ($baseQuestions as $idx => $q) {
                if (empty($q->set_code) || $q->set_code === 'Set A') {
                    $q->update(['set_code' => 'Set A']);
                }
            }

            // Create variations for Set B, Set C, etc. with shuffled option order
            $currentOrder = LmsQuestion::where('quiz_id', $quiz->id)->max('order_index') ?: 0;
            foreach ($targetSets as $set) {
                if ($set === 'Set A') continue;

                // Check if this set already has questions
                $existingCount = LmsQuestion::where('quiz_id', $quiz->id)->where('set_code', $set)->count();
                if ($existingCount > 0) continue;

                $shuffledQuestions = $baseQuestions->shuffle();
                foreach ($shuffledQuestions as $bq) {
                    $currentOrder++;
                    $newQ = LmsQuestion::create([
                        'quiz_id'        => $quiz->id,
                        'question_text'  => $bq->question_text,
                        'question_type'  => $bq->question_type,
                        'marks'          => $bq->marks,
                        'negative_marks' => $bq->negative_marks,
                        'set_code'       => $set,
                        'category'       => $bq->category,
                        'chapter'        => $bq->chapter,
                        'topic'          => $bq->topic,
                        'difficulty'     => $bq->difficulty,
                        'stimulus'       => $bq->stimulus,
                        'explanation'    => $bq->explanation,
                        'order_index'    => $currentOrder,
                        'is_active'      => true,
                    ]);

                    // Shuffle options for this set
                    $opts = $bq->options->shuffle();
                    foreach ($opts as $oIdx => $opt) {
                        \App\model\LmsQuestionOption::create([
                            'question_id' => $newQ->id,
                            'option_text' => $opt->option_text,
                            'is_correct'  => $opt->is_correct,
                            'order_index' => $oIdx + 1,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', "সফলভাবে সেট " . implode(', ', $targetSets) . " তৈরি ও অপশন শাফলিং সম্পন্ন হয়েছে!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'সেট তৈরিতে সমস্যা হয়েছে: ' . $e->getMessage()]);
        }
    }

    /**
     * Admin Assessment Performance & Exam Reports
     */
    public function reports(Request $request)
    {
        $query = \App\model\LmsQuizAttempt::with(['quiz.course', 'student'])->latest('submitted_at');

        if ($request->filled('quiz_id')) {
            $query->where('quiz_id', $request->quiz_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('set')) {
            $query->where('question_set', $request->set);
        }

        $attempts = $query->paginate(25)->appends($request->all());
        $quizzes = LmsQuiz::orderBy('title', 'asc')->get();

        return view('backend.theme.clasic.lms.quizzes.reports', compact('attempts', 'quizzes'));
    }
}
